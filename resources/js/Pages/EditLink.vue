<script setup>
import { ref, computed } from 'vue'
import useApi from "@/Composables/useApi.js";
import useRedirect from "@/Composables/useRedirect.js";
import {Head} from "@inertiajs/vue3";

const link = ref(null)
const lines = ref(null)
const date = ref(null)
const hour = ref(null)
const minute = ref(null)
let timestamp = null
const newLine = ref(null)

const props = defineProps({
    args: Object
})

// Fetch user data from API
const {response, error} = await useApi('GET', `links/${props.args.linkId}`)
if (response) {
    link.value = response.data.data[0]
    console.log(link.value)
}
if (error) {
    console.log(error.value)
}

const {response: response2, error: error2} = await useApi('GET', `search-lines`)
if (response2) {
    lines.value = response2.data.lineList.original.data
}
if (error2) {
    console.log(error2.value)
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

async function saveLink(id) {
    timestamp = makeTimestamp(date.value, hour.value, minute.value)
    const {response: response3, error: error3} = await useApi('PATCH', `links/${id}`, {
        'linkId': id,
        'lineId': newLine.value,
        'departureDate': timestamp
    })
    if (response3) {
        useRedirect.links()
    }
    if (error3) {
        console.log(error3.value)
    }
}

newLine.value = link.value.LineId


</script>


<template>
        <Head title="Link edit" />

        <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h1 class="text-3xl font-bold leading-tight text-gray-900">
                                Edit link
                        </h1>
                </div>
        </header>

        <div>
            <v-container>
                <v-card>
                    <h2 class="card_header">
                        Edit link at {{ link.DepartureDate }} on line {{ link.LineName }}
                    </h2>
                    <v-card-text>
                        <v-form>
                        <v-select
                            v-model="newLine"
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
                            @click="saveLink(link.LinkId)"
                        >
                            Save
                        </v-btn>
                    </v-form>
                    </v-card-text>
                </v-card>
            </v-container>
        </div>
</template>
