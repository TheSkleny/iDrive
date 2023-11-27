<script setup>
import {ref} from 'vue'
import useApi from "@/Composables/useApi.js";
import {Head} from "@inertiajs/vue3";
import useRedirect from "@/Composables/useRedirect.js";

const props = defineProps({
        args: Object,
    }
)


const vehicleTypes = ref([])

const {response, error} = await useApi('GET', `vehicles`)
if (response) {
    vehicleTypes.value = response.data.vehicleTypes.original.data
}
if (error) {
    console.log(error.value)
}

const vehicleType_list = []
vehicleTypes.value.forEach(vehicleType => {
    vehicleType_list.push({
        title: vehicleType.Description,
        value: vehicleType.Id
    })
})

const vehicleName = ref(null)
const vehicleBrand = ref(null)
const vehicleImage = ref(null)
const vehicleCapacity = ref(null)
const vehicleSpeedLimit = ref(null)
const vehicleLicensePlate = ref(null)
const vehicleType = ref(null)

async function sendAdd() {
    console.log(vehicleName.value)
    console.log(vehicleBrand.value)
    console.log(vehicleImage.value)
    console.log(vehicleCapacity.value)
    console.log(vehicleSpeedLimit.value)
    console.log(vehicleLicensePlate.value)
    console.log(vehicleType.value)

    await useApi('POST', `vehicles`, {
        'name': vehicleName.value,
        'brand': vehicleBrand.value,
        'imageUri': vehicleImage.value,
        'capacity': vehicleCapacity.value,
        'speedLimit': vehicleSpeedLimit.value,
        'licensePlate': vehicleLicensePlate.value,
        'typeId': vehicleType.value
    })
    redirectToVehicles()

}
const redirectToVehicles = () => {
    useRedirect.vehicles()
}



</script>

<template>
    <Head title="Edit vehicle" />

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Add new vehicle
            </h1>
        </div>
    </header>
    <div>
        <v-container>
            <v-card style="padding: 30px">
                <v-form @submit.prevent="() => sendAdd()">
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
                            @click="() => sendAdd()"
                        >
                            Save
                        </v-btn>
                        <v-btn
                            @click="() => redirectToVehicles()"
                        >
                            Cancel
                        </v-btn>
                    </v-row>
                </v-form>
            </v-card>
        </v-container>
    </div>

</template>

<style scoped>

</style>
