<script setup>
import {ref} from 'vue'
import useApi from "@/Composables/useApi.js";
import {Head} from "@inertiajs/vue3";

const maintenanceDate = ref(null);
const technicianId = ref(null);
const report_description = ref(null);

/**
 *
 * @type {Prettify<Readonly<ExtractPropTypes<{args: ObjectConstructor<{VehicleId:string}>}>>>}
 */
const props = defineProps({
        args: Object,
    }
)

const vehicle = ref(null)
const technicians = ref([])

const {response, error} = await useApi('GET', `vehicles/${props.args.vehicleId}`)
if (response) {
    vehicle.value = response.data.vehicleInfo.original.data[0]
    technicians.value = response.data.techniciansList.original.data
}
if (error) {
    console.log(error.value)
}

if (vehicle.value.VehicleImageUri === null) {
    vehicle.value.VehicleImageUri = 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png'
}

async function reportMalfunction() {
    await useApi('POST', `reports/malfunctions`, {
        'submitterId': props.args.submitterId,
        'description': report_description.value,
        'vehicleId': props.args.vehicleId
    })
}

async function reportMaintenance() {
    await useApi('POST', `reports/maintenances`, {
        'submitterId': props.args.submitterId,
        'vehicleId': props.args.vehicleId,
        'technicianId': technicianId.value,
        'maintenanceDate': maintenanceDate.value.toISOString().split('T')[0]
    })
}

const technician_list = []
technicians.value.forEach(technician => {
    technician_list.push({
        title: technician.UserName,
        value: technician.UserId
    })
})

const userType = props.args.UserType
const driver   = userType === 1
const admin    = userType === 5
const manager  = userType === 4

</script>

<template>
    <Head title="Vehicle" />

    <header class="bg-white shadow">
        <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8/">
            <v-row style="margin-left: 20px">
                <v-icon size="50px">{{ vehicle.VehicleTypeIcon }}</v-icon>
                <h1 class="text-3xl font-bold leading-tight text-gray-900"
                    style="margin-left: 20px; margin-top: 7px"
                >
                    Vehicle {{ vehicle.VehicleLicensePlate }} "{{ vehicle.VehicleName }}"
                </h1>
            </v-row>

        </div>
    </header>
    <div>
        <v-row style="margin: 20px">
            <v-col>
                <v-spacer/>
            </v-col>
            <v-col>
                <v-img :src="vehicle.VehicleImageUri" width="300">
                </v-img>

            </v-col>
            <v-col>
                <v-card>
                    <v-card-title>
                        <span class="headline">Vehicle info</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <ul>
                                <li>Brand: {{ vehicle.VehicleBrand }}</li>
                                <li>Capacity: {{ vehicle.VehicleCapacity }}</li>
                                <li>Speed limit: {{ vehicle.VehicleSpeedLimit }}</li>
                                <li>Last maintenance: {{ vehicle.VehicleLastMaintenance }}</li>
                            </ul>
                        </v-container>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col>
                <v-spacer/>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-spacer/>
            </v-col>
            <v-col>
                <v-card  v-if="driver || admin"
                    style="margin: 100px; padding: 20px" width="500">
                    <v-card-title>
                        <span class="headline">Create report</span>
                    </v-card-title>
                    <v-card-item>
                        <v-container>
                            <v-form @submit.prevent="reportMalfunction">
                                <v-textarea
                                    label="Describe problem"
                                    v-model="report_description"
                                    required
                                />
                                <v-btn type="submit">Send report</v-btn>
                            </v-form>
                        </v-container>
                    </v-card-item>
                </v-card>
                <v-card v-if="manager || admin"
                        style="margin: 100px; padding: 20px" width="500">
                    <v-card-title>
                        <span class="headline">Maintenance</span>
                    </v-card-title>
                    <v-card-item>
                        <v-container>
                            <v-form @submit.prevent="reportMaintenance">
                                <v-select style="width: 360px"
                                          label="Select technician"
                                          v-model="technicianId"
                                          :items="technician_list"
                                          required
                                />
                                <v-date-picker
                                    required
                                    v-model="maintenanceDate"
                                    label="Maintenance date"
                                    color="grey-lighten-2"
                                    style="border: 1px solid lightgrey"
                                />
                                <v-btn color="teal"
                                       type="submit"
                                       style="margin-top: 20px; "
                                >
                                    Send maintenance
                                </v-btn>
                            </v-form>
                        </v-container>
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
.center {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
</style>
