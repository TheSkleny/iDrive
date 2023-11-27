<script setup>
import useApi from "@/Composables/useApi.js";
import {ref} from "vue";
import useRedirect from "@/Composables/useRedirect.js";
import {Head} from "@inertiajs/vue3";

const reports = ref([])
const operationalVehicles = ref([])
const outOfServiceVehicles = ref([])

const props = defineProps({
    args: Object}
)

const {response, error} = await useApi('GET', `vehicles`)
if (response) {
    operationalVehicles.value = response.data.operationalVehicles.original.data
    outOfServiceVehicles.value = response.data.outOfServiceVehicles.original.data
    reports.value = response.data.vehicleReports.original.data
}
if (error) {
    console.log(error.value)
}

const routeToReport = (id) => {
    useRedirect.report(id)
}
const routeToVehicle = (id) => {
    useRedirect.vehicle(id)
}

const headers = ref([])

headers.value = [
    {title: 'Report date', value: 'ReportDate'},
    {title: 'Submitter', value: 'SubmitterName'},
    {title: 'Vehicle type', value: 'VehicleIcon'},
    {title: 'Vehicle name', value: 'VehicleName'},
    {title: 'Vehicle licence plate', value: 'VehicleLicensePlate'},
    {title: 'Last maintenance', value: 'VehicleLastMaintenance'},
]

</script>

<template>
    <Head title="Vehicles" />

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Vehicle list
            </h1>
        </div>
    </header>
    <div>
        <v-container>
            <v-card>
                <h2 class="card_header">
                    Reports
                </h2>
                <v-table fixed-header>
                    <thead>
                    <tr>
                        <td>Report date</td>
                        <td>Submitter</td>
                        <td>Vehicle type</td>
                        <td>Vehicle name / licence plate</td>
                        <td>Last maintenance</td>
                        <td>Report Detail</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="report in reports" :key="report.ReportId">
                        <td>{{ report.ReportDate }}</td>
                        <td>{{ report.SubmitterName }}</td>
                        <td>
                            <v-icon>
                                {{ report.VehicleIcon }}
                            </v-icon>
                        </td>
                        <td>{{ report.VehicleName }} / {{ report.VehicleLicensePlate }}</td>
                        <td>{{ report.VehicleLastMaintenance }}</td>
                        <td>
                            <v-btn @click="() => routeToReport(report.ReportId)" variant="tonal">
                                View report
                            </v-btn>
                        </td>
                    </tr>
                    </tbody>
                </v-table>
            </v-card>
            <v-card style="margin-top: 50px">
                <h2 class="card_header">
                    Operational vehicles
                </h2>
                <v-table fixed-header>
                    <thead>
                    <tr>
                        <td>Vehicle type</td>
                        <td>Vehicle name / licence plate</td>
                        <td>Last maintenance</td>
                        <td>Vehicle Detail</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="col in operationalVehicles" :key="col.VehicleId">
                        <td>
                            <v-icon>{{ col.VehicleIcon }}</v-icon>
                        </td>
                        <td>
                            {{ col.VehicleName }} / {{ col.VehicleLicensePlate }}
                        </td>
                        <td>
                            {{ col.VehicleLastMaintenance }}
                        </td>
                        <td>
                            <v-btn @click="() => routeToVehicle(col.VehicleId)" variant="tonal">
                                View vehicle
                            </v-btn>
                        </td>
                    </tr>
                    </tbody>
                </v-table>
            </v-card>
            <v-card style="margin-top: 50px">
                <h2 class="card_header">
                    Out of order vehicles
                </h2>
                <v-table fixed-header>
                    <thead>
                    <tr>
                        <td>Vehicle type</td>
                        <td>Vehicle name / licence plate</td>
                        <td>Last maintenance</td>
                        <td>Vehicle Detail</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="col in outOfServiceVehicles" :key="col.VehicleId">
                        <td>
                            <v-icon>{{ col.VehicleIcon }}</v-icon>
                        </td>
                        <td>
                            {{ col.VehicleName }} / {{ col.VehicleLicensePlate }}
                        </td>
                        <td>
                            {{ col.VehicleLastMaintenance }}
                        </td>
                        <td>
                            <v-btn @click="() => routeToVehicle(col.VehicleId)" variant="tonal">
                                View vehicle
                            </v-btn>
                        </td>
                    </tr>
                    </tbody>
                </v-table>
            </v-card>
        </v-container>
    </div>
</template>

<style scoped>

</style>
