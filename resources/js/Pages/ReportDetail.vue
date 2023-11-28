<script setup>
import useApi from "@/Composables/useApi.js";
import {ref} from "vue";
import {Head} from "@inertiajs/vue3";

const props = defineProps({
        args: Object,
    }
)
const reportInfo = ref(null)
const technicians = ref([])
const technicianId = ref(null)
const maintenanceDate = ref(null)
const technicianDescription = ref(null)

const userType = props.args.UserType
const technician = userType === 3
const manager = userType === 4
const admin = userType === 5

const {response, error} = await useApi('GET', `reports/${props.args.reportId}`)
if (response) {
    reportInfo.value = response.data.reportInfo.original.data[0]
    console.log(reportInfo.value)
    technicians.value = response.data.techniciansList.original.data
}
if (error) {
    console.log(error.value)
}


const technician_list = []
technicians.value.forEach(technician => {
    technician_list.push({
        title: technician.UserName,
        value: technician.UserId
    })
})

async function closeReport(decision) {
    console.log(props.args.reportId)
    console.log(props.args.technicianId)
    console.log(reportInfo.value.VehicleId)
    console.log(technicianDescription.value)
    console.log(decision)

    await useApi('PATCH', `close-report/${props.args.reportId}`, {
        'reportId': props.args.reportId,
        'technicianId': props.args.technicianId,
        'vehicleId': reportInfo.value.VehicleId,
        'technicianDescription': technicianDescription.value,
        'decision': decision
    })
}

async function updateReport(decision) {
    console.log(props.args.reportId)
    console.log(technicianId.value)
    console.log(reportInfo.value.VehicleId)
    console.log(maintenanceDate.value)
    console.log(decision)

    await useApi('PATCH', `handle-report/${props.args.reportId}`, {
        'reportId': props.args.reportId,
        'technicianId': technicianId.value,
        'vehicleId': reportInfo.value.VehicleId,
        'maintenanceDate': maintenanceDate.value.toISOString().split('T')[0],
        'decision': decision
    })
}
</script>

<template>
    <Head title="Report" />


    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Report
            </h1>
        </div>
    </header>
    <div style="margin-top: 20px">
        <v-row>
            <v-col>
                <v-spacer/>
            </v-col>
            <v-col>
                <v-card width="800" v-if="(manager || admin)">
                    <v-card-item>
                        <h3 style="margin-top: 10px">
                            {{ reportInfo.SubmitterName }}'s description:
                        </h3>
                        <v-card color="grey-lighten-2" style="padding: 15px; margin-top: 10px" min-height="50">
                            {{ reportInfo.ReportDescription }}
                        </v-card>
                        <v-form @submit.prevent="() => updateReport('accept')"
                                style="margin-top: 20px">
                            <v-row>
                                <v-col>
                                    <v-date-picker
                                        required
                                        v-model="maintenanceDate"
                                        label="Maintenance date"
                                        color="grey-lighten-2"
                                        style="border: 1px solid lightgrey"
                                    />
                                </v-col>
                                <v-col>
                                    <v-container content="center" style="margin-top: 20px">
                                        <v-row>
                                            <v-icon size="30px">{{ reportInfo.VehicleIcon }}</v-icon>
                                            <h3 style="margin-left: 20px">
                                                {{ reportInfo.VehicleLicensePlate }}
                                                "{{ reportInfo.VehicleName }}"
                                            </h3>
                                        </v-row>
                                        <v-row style="margin-top: 50px">
                                            <h4>
                                                Last maintenance: {{ reportInfo.VehicleLastMaintenance }}
                                            </h4>
                                        </v-row>
                                        <v-row>
                                            <h4>
                                                Report date: {{ reportInfo.ReportDate }}
                                            </h4>
                                        </v-row>
                                        <v-select style="width: 300px; margin-top: 100px"
                                                  label="Select technician"
                                                  v-model="technicianId"
                                                  :items="technician_list"
                                                  required
                                        />
                                        <v-btn color="teal"
                                               style="margin-left: 50px;
                                      margin-bottom: 15px"
                                               type="submit"
                                        >
                                            Accept report
                                        </v-btn>
                                        <v-btn color="red"
                                               style="margin-left: 50px;
                                      margin-bottom: 15px"
                                               @click="() => updateReport('reject')"
                                        >
                                            Reject report
                                        </v-btn>
                                    </v-container>
                                </v-col>
                            </v-row>
                        </v-form>
                    </v-card-item>
                </v-card>
                <v-card style="margin-top: 50px" v-if="(technician || admin)">
                    <v-card-item>
                        <v-row style="margin-top: 20px; margin-left: 10px">
                            <v-icon size="50px">{{ reportInfo.VehicleIcon }}</v-icon>
                            <h2 style="margin-left: 20px">
                                {{ reportInfo.VehicleLicensePlate }} "{{ reportInfo.VehicleName }}"
                            </h2>
                        </v-row>
                        <h4 style="margin-top: 25px; margin-left: 10px">
                            Last maintenance: {{ reportInfo.VehicleLastMaintenance }}
                        </h4>
                        <h4 style="; margin-left: 10px">
                            Report date: {{ reportInfo.ReportDate }}
                        </h4>
                        <h4 style="; margin-left: 10px">
                            Service date: {{ reportInfo.ReportMaintenanceDate }}
                        </h4>

                        <h3 style="margin-top: 10px">
                            {{ reportInfo.SubmitterName }}'s description:
                        </h3>
                        <v-card color="grey-lighten-2" style="padding: 15px; margin-top: 10px" min-height="50">
                            {{ reportInfo.ReportDescription }}
                        </v-card>
                        <h3 style="margin-top: 10px">
                            Your description:
                        </h3>
                        <v-form @submit.prevent>
                            <v-textarea v-model="technicianDescription">
                            </v-textarea>
                            <v-row>
                                <v-spacer/>
                                <v-btn color="teal"
                                       style="margin-right: 30px;
                                      margin-bottom: 15px"
                                       type="submit"
                                       @click="() => closeReport('operational')"
                                >
                                    Repaired
                                </v-btn>
                                <v-btn color="red"
                                       style="margin-right: 30px;
                                      margin-bottom: 15px"
                                       type="submit"
                                       @click="() => closeReport('kaputt')"
                                >
                                    Kaputt
                                </v-btn>
                            </v-row>
                        </v-form>
                    </v-card-item>
                </v-card>
            </v-col>
            <v-col>
                <v-spacer/>
            </v-col>
        </v-row>

    </div>
</template>

<style scoped>

</style>
