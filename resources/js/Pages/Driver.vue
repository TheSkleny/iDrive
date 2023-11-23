<script setup>
import {ref} from "vue";
import useApi from "@/Composables/useApi.js";
import useRedirect from "@/Composables/useRedirect.js";

/**
 *
 * @type {Prettify<Readonly<ExtractPropTypes<{args: ObjectConstructor<{driverId:string}>}>>>}
 */
const props = defineProps({
        args: Object
    }
)

/**
 *
 * @type {Ref<UnwrapRef<Shift[]>>}
 */
const shifts = ref([])

const {response, error} = await useApi('GET', `shifts/${props.args.driverId}`)
if (response.data) {
    shifts.value = response.data.data
}
if (error) {
    console.log(error.value)
}

// Resulting data structure
const result = [];

// Loop through each shift
shifts.value.forEach(shift => {
    const [date, time] = shift.DepartureDate.split(' ');

    // Check if the date already exists in the result array
    const existingDateIndex = result.findIndex((entry) => entry.date === date);

    if (existingDateIndex !== -1) {
        // Date already exists, add time and data
        result[existingDateIndex].times.push({time, data: shift});
    } else {
        // Date doesn't exist, create a new entry
        result.push({date, times: [{time, data: shift}]});
    }
});

console.log(result);

const routeToLine = (id) => {
    useRedirect.line(id)
}

const routeToVehicle = (id) => {
    useRedirect.vehicle(id)
}

</script>

<template>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Driver shifts
            </h1>
        </div>
    </header>
    <div>
        <v-container>
            <!--            <div v-for="day in result" :key="day['date']" >-->
            <!--                {{ day.date }}-->
            <!--                <div v-for="time in day['times']" :key="time['time']">-->
            <!--                    {{ time.time }} : {{ time.data }}-->
            <!--                </div>-->
            <!--            </div>-->
            <div v-for="day in result" :key="day['date']" style="margin-bottom: 50px">
                <v-card>
                    <h2 style="margin-left: 10px; margin-top: 10px">{{ day.date }}</h2>
                    <v-table fixed-header>
                        <thead>
                        <tr>
                            <th class="text-center">Line name</th>
                            <th class="text-center">Vehicle type</th>
                            <th>Vehicle name</th>
                            <th>Departure time</th>
                            <th>First stop</th>
                            <th>Last stop</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="shift in day['times']" :key="shift['time']">
                            <td class="text-center">
                                <v-btn @click="() => routeToLine(shift.data.LineId)" variant="tonal">
                                    {{ shift.data.LineName }}
                                </v-btn>
                            </td>
                            <td class="text-center">
                                <v-icon>
                                    {{ shift.data.VehicleIcon }}
                                </v-icon>
                            </td>
                            <td>
                                <v-btn @click="() => routeToVehicle(shift.data.VehicleId)" variant="tonal">
                                    {{ shift.data.VehicleName }}
                                </v-btn>
                            </td>
                            <td>{{ shift.time }}</td>
                            <td>{{ shift.data.FirstStop }}</td>
                            <td>{{ shift.data.LastStop }}</td>
                        </tr>
                        </tbody>
                    </v-table>
                </v-card>

            </div>
        </v-container>
    </div>
</template>
