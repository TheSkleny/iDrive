<script setup>
import {ref} from 'vue'
import useApi from "@/Composables/useApi.js";
import {Head} from "@inertiajs/vue3";
import useRedirect from "@/Composables/useRedirect.js";

const props = defineProps({
        args: Object,
    }
)


const vehicle = ref(null)
const vehicleTypes = ref([])

const {response, error} = await useApi('GET', `vehicles/${props.args.vehicleId}`)
if (response) {
    vehicle.value = response.data.vehicleInfo.original.data[0]
    vehicleTypes.value = response.data.vehicleTypes.original.data
}
if (error) {
    console.log(error.value)
}

const vehicleName = ref(vehicle.value.VehicleName)
const vehicleBrand = ref(vehicle.value.VehicleBrand)
const vehicleImage = ref(vehicle.value.VehicleImageUri)
const vehicleCapacity = ref(vehicle.value.VehicleCapacity)
const vehicleSpeedLimit = ref(vehicle.value.VehicleSpeedLimit)
const vehicleLicensePlate = ref(vehicle.value.VehicleLicensePlate)
const vehicleType = {
    title: vehicle.value.VehicleTypeDescription,
    value: vehicle.value.VehicleTypeId
}

const vehicleType_list = []
vehicleTypes.value.forEach(vehicleType => {
    vehicleType_list.push({
        title: vehicleType.Description,
        value: vehicleType.Id
    })
})

async function sendEdit() {
    await useApi('PATCH', `vehicles/${props.args.vehicleId}`, {
        'vehicleId': props.args.vehicleId,
        'name': vehicleName.value,
        'brand': vehicleBrand.value,
        'imageUri': vehicleImage.value,
        'capacity': vehicleCapacity.value,
        'speedLimit': vehicleSpeedLimit.value,
        'licensePlate': vehicleLicensePlate.value,
        'typeId': vehicleType.value
    })
}

async function cancelEdit() {
    useRedirect.vehicle(props.args.vehicleId)
}

async function deleteVehicle() {
    const {response, error} = await useApi('DELETE', `vehicles/${props.args.vehicleId}`)
    if (response) {
        console.log(response.data)
    }
    if (error) {
        console.log(error.value)
    }
    await useRedirect.searchLine()
}

</script>

<template>
    <Head title="Edit vehicle" />

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Edit vehicle
            </h1>
        </div>
    </header>
    <div>
        <v-container>
            <v-card style="padding: 30px">
                <v-form @submit.prevent="() => sendEdit()">
                    <v-row>
                        <v-text-field
                            label="Name"
                            v-model="vehicleName"
                        />
                    </v-row>
                    <v-row>
                        <v-text-field
                            label="Brand"
                            v-model="vehicleBrand"
                        />
                    </v-row>
                    <v-row>
                        <v-text-field
                            label="Image"
                            v-model="vehicleImage"
                        />
                    </v-row>
                    <v-row>
                        <v-text-field
                            label="Capacity"
                            v-model="vehicleCapacity"
                        />
                    </v-row>
                    <v-row>
                        <v-text-field
                            label="Speed limit"
                            v-model="vehicleSpeedLimit"
                        />
                    </v-row>
                    <v-row>
                        <v-text-field
                            label="License plate"
                            v-model="vehicleLicensePlate"
                        />
                    </v-row>
                    <v-row>
                        <v-select
                            label="Vehicle type"
                            :items="vehicleType_list"
                            v-model="vehicleType"
                        />
                    </v-row>
                    <v-row>

                        <v-btn
                            style="margin-right: 20px"
                            color="teal"
                            type="submit"
                        >
                            Save
                        </v-btn>
                        <v-btn
                            @click="() => cancelEdit()"
                        >
                            Cancel
                        </v-btn>
                        <v-spacer/>
                        <v-btn
                            color="red"
                            @click="() => deleteVehicle()"
                        >
                            Delete vehicle
                        </v-btn>
                    </v-row>
                </v-form>
            </v-card>
        </v-container>
    </div>

</template>

<style scoped>

</style>
