<script setup>
import {ref} from 'vue'
import useApi from "@/Composables/useApi.js";

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
    const {response, error} = await useApi('POST', `reports`, {
        'submitterId': props.args.submitterId,
        'description': props.args.description,
        'vehicleId': props.args.vehicleId
    })
}

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
                <v-img :src="vehicle.VehicleImageUri" width="300" >
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
                <v-card style="margin: 100px; padding: 20px" width="500">
                    <v-card-title>
                        <span class="headline">Report</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-form @submit.prevent="sendReport">
                                <v-textarea
                                    label="Describe problem"
                                    v-model="props.args.description"
                                    required
                                />
                                <v-btn type="submit">Send report</v-btn>
                            </v-form>
                        </v-container>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col>
                <v-spacer/>
            </v-col>
        </v-row>
        <div class="parent">
            <div class="child">
            </div>
            <div class="child">


            </div>
            <div class="child">
            </div>
        </div>
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
