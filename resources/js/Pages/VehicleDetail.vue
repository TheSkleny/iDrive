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

/**
 *
 * @type {Ref<UnwrapRef<Vehicle>>}
 */
const vehicle = ref(null)

const {response, error} = await useApi('GET', `vehicle/${props.args.vehicleId}`)
if (response) {
    vehicle.value = response.data.data[0]
}
if (error) {
    console.log(error.value)
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
                            <v-form>
                                <v-textarea label="Describe problem" required></v-textarea>
                            </v-form>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer/>
                        <v-btn @click="">Send report</v-btn>
                    </v-card-actions>
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

.parent {
//border: 1px solid black; margin: 1rem; padding: 2rem 2rem;
    text-align: left;
}

.child {
    display: inline-block;
//border: 1px solid red; padding: 1rem 1rem; vertical-align: top;
}
</style>
