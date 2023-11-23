<script setup>
import useApi from "@/Composables/useApi.js";
import {ref} from "vue";
import useRedirect from "@/Composables/useRedirect.js";

const reports = ref([])

const {response, error} = await useApi('GET', 'reports_with_vehicle_info/1')
if (response.data) {
    reports.value = response.data.data
}
if (error) {
    console.log(error.value)
}

const routeToReport = (id) => {
    useRedirect.report(id)
}

</script>

<template>
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
                        <td>View report</td>
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
                        <td>View report</td>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </v-table>
            </v-card>
            <v-card style="margin-top: 50px">
                <h2 class="card_header">
                    Out-of-order vehicles
                </h2>
                <v-table fixed-header>
                    <thead>
                    <tr>
                        <td>Vehicle type</td>
                        <td>Vehicle name / licence plate</td>
                        <td>Last maintenance</td>
                        <td>View report</td>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </v-table>
            </v-card>
        </v-container>
    </div>
</template>

<style scoped>

</style>
