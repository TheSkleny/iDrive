<script setup>
import useApi from "@/Composables/useApi.js";
import {ref} from "vue";

const props = defineProps({
        args: Object,
    }
)
const report = ref(null)
const technicians = ref([])

const {response, error} = await useApi('GET', `report/${props.args.reportId}`)
if (response.data) {
    report.value = response.data.data[0]
}
if (error) {
    console.log(error.value)
}

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

async function testReport($decision) {
    console.log(props.args)
    console.log($decision)
}
async function updateReport($decision) {
    const {response: responseSend, error: errorSend} = await useApi('PATCH', `handle-report/${props.args.reportId}`, {
        'reportId': props.args.reportId,
        'technicianId': props.args.technicianId,
        'maintenanceDate': props.args.maintenanceDate,
        'decision': $decision
    })
    if (responseSend) {
        console.log(responseSend.data)
    }
    if (errorSend) {
        console.log(errorSend.value)
    }
}
</script>

<template>
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
                <v-card width="900"
                        style="padding: 20px"
                >
                    <v-row style="margin: 10px">
                        <v-icon size="50px">{{ report.VehicleIcon }}</v-icon>
                        <h1 class="text-3xl font-bold leading-tight text-gray-900"
                            style="margin-left: 20px;
                                   margin-top: 7px"
                        >
                            {{ report.VehicleLicensePlate }} "{{ report.VehicleName }}"
                        </h1>
                    </v-row>
                    <v-card-text>
                        <v-row style="margin-top: 20px;
                                      margin-left: 20px">
                            <h3 style="margin-left: 15px;
                                       margin-top: 15px"
                            >
                                Last maintenance: {{ report.VehicleLastMaintenance }}
                            </h3>
                        </v-row>
                        <v-row style="margin-top: 20px; margin-left: 20px">
                            <h3 style="margin-left: 15px;
                            margin-top: 15px">
                                {{ report.SubmitterName }}'s report:
                            </h3>
                            <v-card color="grey-lighten-2"
                                    height="100"
                                    width="700"
                                    style=" margin-top: 10px; margin-left: 15px;
                                       padding: 15px">
                                {{ report.ReportDescription }}
                            </v-card>
                        </v-row>
                    </v-card-text>
                    <v-row>
                        <v-col>
                            <v-btn color="red"
                                   style="margin-left: 50px;
                                      margin-bottom: 15px"
                                   @click="() => updateReport('reject')"
                            >
                                Reject report
                            </v-btn>
                        </v-col>
                        <v-col>
                            <p v-for="technician in technician_list" :key="technician.text">
                                {{ technician }}
                            </p>
                            {{technician_list}}
                            <v-form @submit.prevent="() => updateReport('accept')">
                                <v-select style="width: 300px"
                                          label="Select technician"
                                          v-model="props.args.technicianId"
                                          :items="technician_list"
                                          required
                                >

                                </v-select>
                                <v-date-picker
                                    required
                                    v-model="props.args.maintenanceDate"
                                    label="Maintenance date"
                                    color="grey-lighten-2"
                                    style="width: 300px; border: 1px solid lightgrey"
                                />
                                <v-btn color="teal"
                                       style="margin-left: 50px;
                                      margin-bottom: 15px"
                                       type="submit"
                                >
                                    Accept report
                                </v-btn>
                            </v-form>
                        </v-col>
                        <v-col>

                        </v-col>
                    </v-row>
                    <v-row>


                    </v-row>
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
