<script setup>
import {ref} from "vue";
import useApi from "@/Composables/useApi.js";
import useRedirect from "@/Composables/useRedirect.js";
import {Head} from "@inertiajs/vue3";

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
const shifts = ref([]);
const result = ref([]);


async function getShifts(driverId) {
    const {response, error} = await useApi('GET', `shifts/${driverId}`)
    if (response.data) {
        shifts.value = response.data.data
    }
    if (error) {
        console.log(error.value)
    }
    result.value = [];
// Loop through each shift
    shifts.value.forEach(shift => {
        const [date, time] = shift.DepartureDate.split(' ');

        // Check if the date already exists in the result array
        const existingDateIndex = result.value.findIndex((entry) => entry.date === date);

        if (existingDateIndex !== -1) {
            // Date already exists, add time and data
            result.value[existingDateIndex].times.push({time, data: shift});
        } else {
            // Date doesn't exist, create a new entry
            result.value.push({date, times: [{time, data: shift}]});
        }
    });
    return result.value;
}
getShifts(props.args.driverId);
console.log('result');
console.log(result);

const routeToLine = (id) => {
    useRedirect.line(id)
}

const routeToVehicle = (id) => {
    useRedirect.vehicle(id)
}

const drivers = ref([])
const {response: responseDriver, error: errorDriver} = await useApi('GET', 'user-by-type/1')
if (responseDriver.data) {
    drivers.value = responseDriver.data.data
}
if (errorDriver) {
    console.log(errorDriver.value)
}

const driverList = []
drivers.value.forEach(driver => {
    driverList.push({
        title: driver.UserName,
        value: driver.UserId
    })
})
const adminCard = props.args.UserType === 5


</script>

<template>
    <Head title="Shifts" />

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Driver shifts
            </h1>
        </div>
    </header>
    <div>
        <v-container>
            <v-card v-if="adminCard" style="margin-bottom: 50px">
                <v-form>
                    <v-row>
                        <v-col>
                            <h2 style="margin-top: 25px; margin-left: 20px">
                                Admin
                            </h2>
                        </v-col>
                        <v-col>
                            <v-select style="width: 300px; margin-top: 20px"
                                      label="Select technician"
                                      :items="driverList"
                                      v-model="props.args.adminDriverId"
                                      required
                            />
                        </v-col>
                        <v-col>
                            <v-btn @click="() => getShifts(props.args.adminDriverId)"
                                   variant="tonal"
                                   style="margin-top: 30px; margin-right: 20px"
                            >
                                Display technician's reports
                            </v-btn>

                        </v-col>
                    </v-row>
                </v-form>

            </v-card>

            <div>
                <v-card v-for="day in result" :key="day['date']" style="margin-bottom: 50px">
                    <h2 class="card_header">{{ day.date }}</h2>
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
