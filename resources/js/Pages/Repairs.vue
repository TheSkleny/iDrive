<script setup>
import useApi from "@/Composables/useApi.js";
import {ref} from "vue";
import useRedirect from "@/Composables/useRedirect.js";

const props = defineProps({
        args: Object,
        UserType: Number
    }
)

const malfunctions = ref([])
const maintenances = ref([])

async function getReports(technicianId) {
     const {response, error} = await useApi('GET', `reports-by-technician/${technicianId}`)
    if (response.data) {
        response.data.data.forEach(report => {
            if (report.ReportTypeId === 1) {
                malfunctions.value.push(report)
            } else {
                maintenances.value.push(report)
            }
        })
    }
    if (error) {
        console.log(error.value)
    }
}

getReports(props.args.technicianId)

const routeToReport = (id) => {
    useRedirect.report(id)
}


const technicians = ref([])

// TODO: 3 user.typeId = 'technician'
const {response: responseTechnicians, error: errorTechnicians} = await useApi('GET', 'user-by-type/3')
if (responseTechnicians.data) {
    technicians.value = responseTechnicians.data.data
}
if (errorTechnicians) {
    console.log(errorTechnicians.value)
}

const technician_list = []
technicians.value.forEach(technician => {
    technician_list.push({
        title: technician.UserName,
        value: technician.UserId
    })
})

const admin_card = (props.UserType === 5)

</script>

<template>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Repairs
            </h1>
        </div>
    </header>
    <div>
        <v-container>
            <v-card v-if="admin_card">
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
                                      :items="technician_list"
                                      v-model="props.args.technicianId2"
                                      required
                            />
                        </v-col>
                        <v-col>
                            <v-btn @click="() => getReports(props.args.technicianId2)"
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
