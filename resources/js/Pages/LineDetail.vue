<script setup>
    import {ref, computed} from 'vue'
    import useApi from "@/Composables/useApi.js";

    /**
     *
     * @type {Prettify<Readonly<ExtractPropTypes<{args: ObjectConstructor<{lineId:string}>}>>>}
     */
    const props = defineProps({
        args: Object}
    )

    /**
     *
     * @type {Ref<UnwrapRef<Line>>}
     */
    const line = ref(null)
    const matrix = ref(null)

    const {response, error} = await useApi('GET', `lines/${props.args.lineId}`)
    if (response) {
        line.value = response.data.lineStops.original.data
        matrix.value = response.data.lineMatrixData.original.data
    }
    if (error) {
        console.log(error.value)
    }
    // Unique stops for the line
    const stops = computed(() => {
        return [...new Set(matrix.value.map(item => item.CurrStop))];
    });
    // Unique departures for the line
    const departures = computed(() => {
        return [...new Set(matrix.value.map(item => item.DepartureDate))];
    });
    // Column headers for the table
    const headers = computed(() => [
        { title: 'Departure Time', align: 'start', sortable: false, key: 'DepartureDate' },
        ...stops.value.map(stop => ({ title: stop, align: 'start', key: stop }))
    ]);

    const addMinutes = (time, minutes) => {
        // Split the time into hours and minutes
        const [hours, initialMinutes] = time.split(':').map(Number);
        // Calculate the total minutes
        const totalMinutes = hours * 60 + initialMinutes + minutes;
        const newHours = Math.floor(totalMinutes / 60);
        const newMinutes = totalMinutes % 60;
        // Time is returned in the format HH:MM
        return `${newHours.toString().padStart(2, '0')}:${newMinutes.toString().padStart(2, '0')}`;
    };
    const getTime = (datetime) => {
        // Get the time from the datetime string
        return datetime.split(' ')[1].slice(0, 5);
    };

    const formattedMatrix = computed(() => {
        return departures.value.map(departure => {
            // Get the departure time for the current departure
            let cumulativeTime = getTime(departure);
            // Get the stops data for the current departure
            const stopsData = stops.value.reduce((acc, stop, index) => {
                // Find the stop data for the current stop and departure
                const stopData = matrix.value.find(
                stopItem =>
                    stopItem.CurrStop === stop && stopItem.DepartureDate === departure
                );
                // Check if the stop exists
                if (stopData) {
                    // If the stop is not the first one, add the previous TTNS to the cumulative time
                    const previousTTNS = index === 0 ? 0 : matrix.value.find(
                        stopItem =>
                            stopItem.CurrStop === stops.value[index - 1] && stopItem.DepartureDate === departure
                    ).TTNS;
                    // Add the current TTNS to the cumulative time
                    cumulativeTime = addMinutes(cumulativeTime, previousTTNS);
                    acc[stop] = cumulativeTime;
                }
                else {
                    acc[stop] = '';
                }
                return acc;
            }, {});
            // Return the departure time and the stops data
            return {
                DepartureDate: departure,
                ...stopsData,
            };
        });
    });
</script>

<template>
    <header class="bg-white shadow">
        <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8/">
            <v-row style="margin-left: 50px">
                <v-icon size="50px">{{ line.VehicleTypeIcon }}</v-icon>
                <h1 class="text-3xl font-bold leading-tight text-gray-900"
                    style="margin-left: 20px; margin-top: 7px"
                >
                    Line {{ line.LineName }}
                </h1>
            </v-row>

        </div>
    </header>
    <v-container>
        <v-timeline direction="horizontal" side="end" truncate-line="both">
            <v-timeline-item v-for="stop in line.Stops"
                             icon="mdi-map-marker"
                             dot-color="teal">
                {{ stop.Name }}
            </v-timeline-item>
        </v-timeline>
        <v-spacer style="margin: 20px"/>
        <v-data-table :headers="headers" :items="formattedMatrix">
            <template v-slot:item="{ item }">
                <tr>
                <td>{{ item.DepartureDate }}</td>
                <td v-for="stop in stops" :key="stop">{{ item[stop] }}</td>
                </tr>
            </template>
        </v-data-table>
    </v-container>
</template>
