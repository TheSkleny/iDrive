<script setup>
import {ref} from "vue";
import useApi from "@/Composables/useApi.js";

const shifts = ref([])

const {response, error} = await useApi('GET', 'driver/3')
if (response.data) {
    shifts.value = response.data.data
}
if (error) {
    console.log(error.value)
}

</script>

<template>
    <div>
        <v-container>
            <h1>Driver shifts</h1>
            <v-icon icon="mdi-home"/>
            <v-icon icon="$calendar" color="red"/>
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
                    <td>{{ shift.LineName }}</td>
                    <td><v-icon icon="{{ shift.VehicleIcon }}"/></td>
                    <td>{{ shift.VehicleName }}</td>
                    <td>{{ shift.DepartureTime }}</td>
                    <td>{{ shift.FirstStop }}</td>
                    <td>{{ shift.LastStop }}</td>
                </tr>
                </tbody>
            </v-table>
        </v-container>
    </div>
</template>
