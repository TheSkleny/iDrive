<script setup>
import {ref} from 'vue'
import useApi from "@/Composables/useApi.js";

const lines = ref([])

const {response, error} = await useApi('GET', 'lines')
if (response.data) {
    lines.value = response.data.data
}
if (error) {
    console.log(error.value)
}


</script>

<template>
    <div>
        <v-btn>Penis</v-btn>
        <h1>Lines List</h1>
        <ul>
            <li v-for="line in lines" :key="line.Id">
                {{ line.VehicleTypeId }}
                {{ line.Name }}
                {{ line.Description }}
            </li>
        </ul>
    </div>
</template>


