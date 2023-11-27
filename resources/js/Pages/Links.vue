<script setup>
import { ref, computed } from 'vue'
import useApi from "@/Composables/useApi.js";
import useRedirect from "@/Composables/useRedirect.js";
import {Head} from "@inertiajs/vue3";

const lines = ref(null)
const line = ref(null)
const date = ref(null)
const hour = ref(null)
const minute = ref(null)
let timestamp = null

const links = ref(null)
const links2 = ref(null)

const props = defineProps({
    args: Object
})

const {response, error} = await useApi('GET', `search-lines`)
if (response) {
    lines.value = response.data.lineList.original.data
}
if (error) {
    console.log(error.value)
}

const {response: responseLinks, error: errorLinks} = await useApi('GET', `links`)
if (responseLinks) {
    links.value = responseLinks.data.unallocatedLinks.original.data
    links2.value = responseLinks.data.allocatedLinks.original.data
}
if (errorLinks) {
    console.log(errorLinks.value)
}

const linesList = []
lines.value.forEach(line => {
    linesList.push({
        title: line.Name,
        value: line.Id
    })
})

const hours = []
for (let i = 0; i < 24; i++) {
    hours.push(i)
}

const minutes = []
for (let i = 0; i < 60; i++) {
    minutes.push(i)
}

function makeTimestamp(dateString, hour, minute) {
    const date = new Date(dateString);
    date.setHours(hour);
    date.setMinutes(minute);
    date.setUTCHours(date.getUTCHours() + 1); // Set timezone to +01
    const formattedTimestamp = date.toISOString().replace(/T/, ' ').replace(/\..+/, '');
    return formattedTimestamp;
}

async function createLink() {
    timestamp = makeTimestamp(date.value, hour.value, minute.value)
    const {response: response3, error: error3} = await useApi('POST', `links`, {
        'lineId': line.value,
        'departureDate': timestamp
    })
    if (response3) {
        location.reload() // Reload the page
    }
    if (error3) {
        console.log(error3.value)
    }
}

const deleteLink = async (id) => {
    const {response: responseSend, error: errorSend} = await useApi('DELETE', `links/${id}`)
    if (responseSend) {
        location.reload() // Reload the page
    }
    if (errorSend) {
        console.log(errorSend.value)
    }
}

const routeToLink = (id) => {
    useRedirect.editLink(id)
}

</script>

<template>
    <Head title="Links" />

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Links
            </h1>
        </div>
    </header>

    <div>
        <v-container>
            <v-card>
                <h2 class="card_header">
                    Create link
                </h2>
                <v-card-text>
                    <v-form>
                        <v-select
                            v-model="line"
                            :items="linesList"
                            label="Line"
                            required
                        ></v-select>
                        <v-date-picker
                            v-model="date"
                            label="Date"
                            required
                        ></v-date-picker>

                        <v-select
                            v-model="hour"
                            :items="hours"
                            label="Hour"
                            required
                        ></v-select>

                        <v-select
                            v-model="minute"
                            :items="minutes"
                            label="Minute"
                            required
                        ></v-select>
                        <v-btn
                            color="primary"
                            @click="createLink"
                        >
                            Create
                        </v-btn>
                    </v-form>
                </v-card-text>
            </v-card>

            <v-card style="margin-top: 50px">
                <h2 class="card_header">
                    Unallocated Links
                </h2>
                <v-table fixed-header>
                    <thead>
                    <tr>
                        <td>Line</td>
                        <td>Departure date</td>
                        <td>Link detail</td>
                        <td>Delete link</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="link in links" :key="link.LinkId">
                        <td>{{ link.LineName }}</td>
                        <td>{{ link.DepartureDate }}</td>
                        <td>
                            <v-btn @click="() => routeToLink(link.LinkId)" variant="tonal">
                                Edit link
                            </v-btn>
                        </td>
                        <td>
                            <v-btn @click="() => deleteLink(link.LinkId)" color="red">
                                DELETE
                            </v-btn>
                        </td>
                    </tr>
                    </tbody>
                </v-table>
            </v-card>

            <v-card style="margin-top: 50px">
                <h2 class="card_header">
                    Allocated Links
                </h2>
                <v-table fixed-header>
                    <thead>
                    <tr>
                        <td>Line</td>
                        <td>Departure date</td>
                        <td>Vehicle name</td>
                        <td>Driver name</td>
                        <td>Link detail</td>
                        <td>Delete link</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="link in links2" :key="link.LinkId">
                        <td>{{ link.LineName }}</td>
                        <td>{{ link.DepartureDate }}</td>
                        <td>{{ link.VehicleName }}</td>
                        <td>{{ link.DriverName }}</td>
                        <td>
                            <v-btn @click="() => routeToLink(link.LinkId)" variant="tonal">
                                Edit link
                            </v-btn>
                        </td>
                        <td>
                            <v-btn @click="() => deleteLink(link.LinkId)" color="red">
                                DELETE
                            </v-btn>
                        </td>
                    </tr>
                    </tbody>
                </v-table>
            </v-card>
        </v-container>
    </div>
</template>
