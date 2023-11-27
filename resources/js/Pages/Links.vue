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
    console.log(date)
    const formattedTimestamp = date.toISOString().replace(/T/, ' ').replace(/\..+/, '');
    return formattedTimestamp;
}

async function createLink() {
    timestamp = makeTimestamp(date.value, hour.value, minute.value)
    await useApi('POST', `links`, {
        'lineId': line.value,
        'departureDate': timestamp
    })
    //location.reload()
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
        </v-container>
    </div>
</template>
