<script setup>
import {ref} from "vue";
import useApi from "@/Composables/useApi.js";
import useRedirect from "@/Composables/useRedirect.js";

/**
 *
 * @type {Ref<UnwrapRef<Shift[]>>}
 */
const shifts = ref([])

const {response, error} = await useApi('GET', 'driver/9c0d1e2f-3a4b-5c6d-7e8f-9a0b1c2d3e4f')
if (response.data) {
    shifts.value = response.data.data
}
if (error) {
    console.log(error.value)
}

const routeToLine = (id) => {
    useRedirect.line(id)
}

</script>

<template>
    <div>
        <v-container>
            <h1>Driver shifts</h1>
            <v-table fixed-header>
                <thead>
                <tr>
                    <th>Line name</th>
                    <th>Vehicle type</th>
                    <th>Vehicle name</th>
                    <th>Departure Time</th>
                    <th>First stop</th>
                    <th>Last stop</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="shift in shifts" :key="shift.LinkId">
                    <td>
                        <v-btn @click="() => routeToLine(shift.LineId)" variant="text">{{ shift.LineName }}</v-btn>
                    </td>
                    <td>
                        <v-icon>{{ shift.VehicleIcon }}</v-icon>
                    </td>
                    <td>
                        <v-btn variant="text">{{ shift.VehicleName }}</v-btn>
                    </td>
                    <td>{{ shift.DepartureTime }}</td>
                    <td>{{ shift.FirstStop }}</td>
                    <td>{{ shift.LastStop }}</td>
                </tr>
                </tbody>
            </v-table>
        </v-container>
    </div>
</template>
