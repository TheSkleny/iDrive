<script setup>
import {ref} from 'vue'
import useApi from "@/Composables/useApi.js";

/**
 *
 * @type {Prettify<Readonly<ExtractPropTypes<{args: ObjectConstructor<{VehicleId:string}>}>>>}
 */
const props = defineProps({
        args: Object
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
                <v-btn style="margin-top: 50px">Report malfunction</v-btn>
            </div>
            <div class="child" >
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
    //border: 1px solid black;
    margin: 1rem;
    padding: 2rem 2rem;
    text-align: left;
}

.child {
    display: inline-block;
    //border: 1px solid red;
    padding: 1rem 1rem;
    vertical-align: top;
}
</style>
