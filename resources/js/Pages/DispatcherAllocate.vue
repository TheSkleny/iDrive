<script setup>

import {ref} from "vue";
import useApi from "@/Composables/useApi.js";

const links = ref(null)

const {response, error} = await useApi('GET', `links`)
if (response) {
    links.value = response.data.data
}
if (error) {
    console.log(error.value)
}

const headers = ref([]);
headers.value = [
    {title: 'Line', key: 'LineName'},
    {title: 'Departure', key: 'DepartureDate'},
    {title: 'Vehicle', key: 'VehicleName'},
    {title: 'Driver', key: 'DriverName'},
]

const item = {
    LineName: 'Line 1',
    DepartureDate: '2021-05-05 12:00:00',
    VehicleName: 'Vehicle 1',
    DriverName: 'Driver 1',
    ArrivalDate: '2021-05-05 12:00:00',
}

const items = [
    item]

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
                                label="Link departure time"
                                required
                            />
                        </v-col>
                        <v-col>
                            <v-select
                                label="Vehicle"
                                required
                            />
                        </v-col>
                        <v-col>
                            <v-select
                                label="Driver"
                                required
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
                <v-data-table :headers="headers" :items="links">

                </v-data-table>
            </v-card>
        </v-container>
    </div>
</template>

<style scoped>

</style>
