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

async function sendReport() {
    const {response, error} = await useApi('POST', `reports`, {'submitterId':props.args.submitterId, 'description': props.args.description, 'vehicleId': props.args.vehicleId})
}

</script>

<template>
    <div>
        <h1>
            <v-icon>{{ vehicle.VehicleTypeIcon }}</v-icon>
            Vehicle {{ vehicle.VehicleLicensePlate }} "{{ vehicle.VehicleName }}"
        </h1>
        <!--        {{ vehicle }}-->
        <div class="parent">
            <div class="child">
                <v-img :src="vehicle.VehicleImageUri" width="300"></v-img>
            </div>
            <div class="child">
                <ul>
                    <li>Brand: {{ vehicle.VehicleBrand }}</li>
                    <li>Capacity: {{ vehicle.VehicleCapacity }}</li>
                    <li>Speed limit: {{ vehicle.VehicleSpeedLimit }}</li>
                    <li>Last maintenance: {{ vehicle.VehicleLastMaintenance }}</li>
                </ul>
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