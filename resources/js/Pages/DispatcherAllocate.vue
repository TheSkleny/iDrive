<script setup>

import {ref} from "vue";
import useApi from "@/Composables/useApi.js";

const allocatedLinks = ref([])
const nonAllocatedLinks = ref([])
const drivers = ref([])
const vehicles = ref([])

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
    const {response, error} = await useApi('PATCH', `allocations/${}`, {
        LinkId: 1,
        VehicleId: 1,
        UserId: 1
    })
    if (response) {
        console.log(response.data)
    }
    if (error) {
        console.log(error.value)
    }
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
                    prdel
                </h2>
                <v-form>
                    <v-row>
                        <v-col>
                            <v-select
                                label="Departure time"
                                required
                                :items="nonAllocatedLinks"
                            />
                        </v-col>
                        <v-col>
                            <v-select
                                label="Vehicle"
                                required
                                :items="vehicles"
                            />
                        </v-col>
                        <v-col>
                            <v-select
                                label="Driver"
                                required
                                :items="drivers"
                            />
                        </v-col>
                        <v-col>
                            <v-btn
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
                    prdel
                </h2>
                <v-data-table :headers="headers" :items="allocatedLinks">

                </v-data-table>
            </v-card>
        </v-container>
    </div>
</template>

<style scoped>

</style>
