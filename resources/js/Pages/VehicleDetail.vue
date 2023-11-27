<script setup>
import {ref} from 'vue'
import useApi from "@/Composables/useApi.js";

const USER_TYPES = {
    DRIVER: 1,
    DISPATCHER: 2,
    TECHNICIAN: 3,
    MANAGER: 4,
    ADMIN: 5
}

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

const {response, error} = await useApi('GET', `vehicle/${props.args.vehicleId}`)
if (response) {
    vehicle.value = response.data.data[0]
}
if (error) {
    console.log(error.value)
}

if (vehicle.value.VehicleImageUri === null) {
    vehicle.value.VehicleImageUri = 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png'
}

async function sendReport() {
    await useApi('POST', `reports`, {
        'submitterId': props.args.submitterId,
        'description': report_description,
        'vehicleId': props.args.vehicleId
    })
}

async function createMaintenance() {
    await useApi('POST', 'reports/main', {
        'submitterId': props.args.submitterId,
        'vehicleId': props.args.vehicleId,
        'technicianId': technicianId,
        'maintenanceDate': maintenanceDate
    })
}


    const technicians = ref([])
    // TODO: 3 user.typeId = 'technician'
    const {response: responseTechnicians, error: errorTechnicians} = await useApi('GET', 'user-by-type/'.concat(USER_TYPES.TECHNICIAN))
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

const userType = props.args.UserType
const driver   = userType === USER_TYPES.DRIVER
const admin    = userType === USER_TYPES.ADMIN
const manager  = userType === USER_TYPES.MANAGER

</script>

<template>
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
                            <v-form @submit.prevent="sendReport">
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
                            <v-form @submit.prevent="createMaintenance">
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
