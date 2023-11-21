<script setup>
import {ref} from "vue";
import useApi from "@/Composables/useApi.js";
import useRedirect from "@/Composables/useRedirect.js";

/**
     *
     * @type {Prettify<Readonly<ExtractPropTypes<{args: ObjectConstructor<{driverId:string}>}>>>}
     */
     const props = defineProps({
        args: Object}
    )

/**
 *
 * @type {Ref<UnwrapRef<Shift[]>>}
 */
const shifts = ref([])

const { response, error } = await useApi('GET', `driver/${props.args.driverId}`)
if (response.data) {
    shifts.value = response.data.data
}
if (error) {
    console.log(error.value)
}

const routeToLine = (id) => {
    useRedirect.line(id)
}

const routeToVehicle = (id) => {
    useRedirect.vehicle(id)
}

var h = window.innerWidth;

</script>

<template>
    <div>
        <v-container>
            <h1>Driver shifts</h1>
            <v-table fixed-header>
                <thead>
                <tr>
                    <th class="text-center">Line name</th>
                    <th class="text-center">Vehicle type</th>
                    <th>Vehicle name</th>
                    <th>Departure Time</th>
                    <th>First stop</th>
                    <th>Last stop</th>
                    <th class="text-center">Report malfunction</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="shift in shifts" :key="shift.LinkId">
                    <td class="text-center">
                        <v-btn @click="() => routeToLine(shift.LineId)" variant="tonal">{{ shift.LineName }}</v-btn>
                    </td>
                    <td class="text-center">
                        <v-icon>{{ shift.VehicleIcon }}</v-icon>
                    </td>
                    <td>
                        <v-btn @click="() => routeToVehicle(shift.VehicleId)" variant="tonal">{{ shift.VehicleName }}</v-btn>
                    </td>
                    <td>{{ shift.DepartureTime }}</td>
                    <td>{{ shift.FirstStop }}</td>
                    <td>{{ shift.LastStop }}</td>
                    <td class="text-center">
                        <v-btn variant="tonal" style="color: red">Report</v-btn>
                    </td>
                </tr>
                </tbody>
            </v-table>
        </v-container>
    </div>
</template>
