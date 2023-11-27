<script setup>

import {ref} from "vue";
import useApi from "@/Composables/useApi.js";
import {Head} from "@inertiajs/vue3";

const allocatedLinks = ref([])
const nonAllocatedLinks = ref([])
const drivers = ref([])
const vehicles = ref([])
const linkId = ref(null)
const vehicleId = ref(null)
const driverId = ref(null)

const {response, error} = await useApi('GET', 'allocations')
if (response) {
    allocatedLinks.value = response.data.allocatedLinks.original.data
    nonAllocatedLinks.value = response.data.nonAllocatedLinks.original.data
    drivers.value = response.data.drivers.original.data
    vehicles.value = response.data.vehicles.original.data

    nonAllocatedLinks.value = nonAllocatedLinks.value.map(link => {
        return {
            title: 'Line '.concat(link.LineName,': ', link.DepartureDate),
            value: link.LinkId
        }
    })

    drivers.value = drivers.value.map(driver => {
        return {
            title: driver.UserName,
            value: driver.UserId
        }
    })

    vehicles.value = vehicles.value.map(vehicle => {
        return {
            title: vehicle.VehicleName.concat(' / ', vehicle.VehicleLicensePlate),
            value: vehicle.VehicleId
        }
    })
}
if (error) {
    console.log(error.value)
}

async function allocate() {
    console.log(linkId.value)
    console.log(vehicleId.value)
    console.log(driverId.value)
    await useApi('PATCH', `allocations/${linkId.value}`, {
        linkId: linkId.value,
        vehicleId: vehicleId.value,
        driverId: driverId.value
    })
}

const headers = ref([]);
headers.value = [
    {title: 'Line', key: 'LineName'},
    {title: 'Departure', key: 'DepartureDate'},
    {title: 'Vehicle', key: 'VehicleName'},
    {title: 'Driver', key: 'DriverName'},
]

</script>

<template>
    <Head title="Allocate" />

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Allocate resources
            </h1>
        </div>
    </header>
    <div>
        <v-container>
            <v-card style="padding: 15px">
                <h2 class="card_header">
                    Allocate resources
                </h2>
                <v-form @submit.prevent="allocate">
                    <v-row>
                        <v-col>
                            <v-select
                                label="Departure time"
                                required
                                :items="nonAllocatedLinks"
                                v-model="linkId"
                            />
                        </v-col>
                        <v-col>
                            <v-select
                                label="Vehicle"
                                required
                                :items="vehicles"
                                v-model="vehicleId"
                            />
                        </v-col>
                        <v-col>
                            <v-select
                                label="Driver"
                                required
                                :items="drivers"
                                v-model="driverId"
                            />
                        </v-col>
                        <v-col>
                            <v-btn
                                type="submit"
                                class="center"
                                color="teal"
                            >
                                Allocate
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-form>
            </v-card>
            <v-card style="margin-top: 50px; padding: 15px">
                <h2 class="card_header">
                    Allocated links
                </h2>
                <v-data-table :headers="headers" :items="allocatedLinks">

                </v-data-table>
            </v-card>
        </v-container>
    </div>
</template>

<style scoped>

</style>
