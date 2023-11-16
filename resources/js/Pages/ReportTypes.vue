<script setup>
import useApi from "@/Composables/useApi.js";
import {ref} from "vue";

const reportTypes = ref([])

const {response, error} = await useApi('GET', 'report-types')
if (response.data) {
    reportTypes.value = response.data.data
}
if (error) {
    console.log(error.value)
}
</script>

<template>
  <div>
    <h1>Report Types</h1>
    <ul>
      <li v-for="reportType in reportTypes" :key="reportType.Id">
        {{ reportType.Description }}
      </li>
    </ul>
  </div>
</template>
