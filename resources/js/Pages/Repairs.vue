<script setup>
import useApi from "@/Composables/useApi.js";
import {ref} from "vue";
import useRedirect from "@/Composables/useRedirect.js";
import {Head} from "@inertiajs/vue3";

const props = defineProps({
        args: Object,
    }
)

const malfunctions = ref([])
const maintenances = ref([])
const technicians = ref([])

async function getRepairs(technicianId) {
    const {response, error} = await useApi('GET', `repairs/${technicianId}`)
    if (response.data) {
        malfunctions.value = []
        maintenances.value = []
        response.data.repairsList.original.data.forEach(report => {
            if (report.ReportTypeId === 1) {    
                malfunctions.value.push(report)
            } else {
                maintenances.value.push(report)
            }
        })
        technicians.value = response.data.techniciansList.original.data
        console.log(technicians.value)
    }
    if (error) {
        console.log(error.value)
    }
}

await getRepairs(props.args.technicianId)

const routeToReport = (id) => {
    useRedirect.report(id)
}

const technicianList = []
technicians.value.forEach(technician => {
    technicianList.push({
        title: technician.UserName,
        value: technician.UserId
    })
})
const adminCard = props.args.UserType === 5

</script>

<template>
    <Head title="Repairs" />

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Repairs
            </h1>
        </div>
    </header>
    <div>
        <v-container>
            <v-card v-if="adminCard">
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
                                      :items="technicianList"
                                      v-model="props.args.adminTechnicianId"
                                      required
                            />
                        </v-col>
                        <v-col>
                            <v-btn @click="() => getRepairs(props.args.adminTechnicianId)"
                                   variant="tonal"
                                      style="margin-top: 30px; margin-right: 20px"
                            >
                                Display technician's reports
                            </v-btn>

                        </v-col>
                    </v-row>
                </v-form>

            </v-card>


            <v-card style="margin-top: 50px">
                <h2 class="card_header">
                    Malfunctions
                </h2>
                <v-table>
                    <thead>
                    <tr>
                        <td>Report date</td>
                        <td>Maintenance date</td>
                        <td>Vehicle type</td>
                        <td>Vehicle licence plate</td>
                        <td>Last maintenance</td>
                        <td>Report detail</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="report in malfunctions" :key="report.ReportId">
                        <td>{{ report.ReportDate }}</td>
                        <td>{{ report.ReportMaintenanceDate }}</td>
                        <td>
                            <v-icon>
                                {{ report.VehicleIcon }}
                            </v-icon>
                        </td>
                        <td>{{ report.VehicleLicensePlate }}</td>
                        <td>{{ report.VehicleLastMaintenance }}</td>
                        <td>
                            <v-btn @click="() => routeToReport(report.ReportId)" variant="tonal">
                                Show report
                            </v-btn>
                        </td>
                    </tr>
                    </tbody>
                </v-table>
            </v-card>
            <v-card style="margin-top: 50px">
                <h2 class="card_header">
                    Maintenance
                </h2>
                <v-table>
                    <thead>
                    <tr>
                        <td>Report date</td>
                        <td>Maintenance date</td>
                        <td>Vehicle type</td>
                        <td>Vehicle licence plate</td>
                        <td>Last maintenance</td>
                        <td>Report detail</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="report in maintenances" :key="report.ReportId">
                        <td>{{ report.ReportDate }}</td>
                        <td>{{ report.ReportMaintenanceDate }}</td>
                        <td>
                            <v-icon>
                                {{ report.VehicleIcon }}
                            </v-icon>
                        </td>
                        <td>{{ report.VehicleLicensePlate }}</td>
                        <td>{{ report.VehicleLastMaintenance }}</td>
                        <td>
                            <v-btn @click="() => routeToReport(report.ReportId)" variant="tonal">
                                Show report
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
