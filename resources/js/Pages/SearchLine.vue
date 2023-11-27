<script setup>
import { ref, computed } from 'vue'
import useApi from "@/Composables/useApi.js";
import useRedirect from "@/Composables/useRedirect.js";
import {Head} from "@inertiajs/vue3";

const lines = ref([])
const types = ref([])
const tab = ref(null)

const {response: responseLines, error: errorLines } = await useApi('GET', 'lines')
if (responseLines.data) {
    lines.value = responseLines.data.data
}
if (errorLines) {
    console.log(errorLines.value)
}

const { response: responseTypes, error: errorTypes } = await useApi('GET', 'line-types')
if (responseTypes.data) {
    types.value = responseTypes.data.data
}
if (errorTypes) {
    console.log(errorTypes.value)
}

const filteredLines = computed(() => {
    if (tab.value) {
        return lines.value.filter(line => line.VehicleTypeId === parseInt(tab.value))
    } else {
        return lines.value
    }
})

const routeToLine = (id) => {
    useRedirect.line(id)
}

</script>


<template>
    <Head title="Search line" />

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Search line
            </h1>
        </div>
    </header>

    <div>
        <v-container>
            <v-card>
                <v-tabs v-model="tab"
                        grow
                        color="teal">
                    <v-tab v-for="type in types" :key="type.Id" :value="type.Id">
                        {{ type.Description }}
                    </v-tab>
                </v-tabs>

                <v-card-text>
                    <v-window>
                        <v-window-item v-for="line in filteredLines" :key="line.Id">
                            <v-btn @click="() => routeToLine(line.Id)" variant="tonal">
                                {{ line.Name }}
                            </v-btn>
                        </v-window-item>
                    </v-window>
                </v-card-text>
            </v-card>
        </v-container>
    </div>
</template>
