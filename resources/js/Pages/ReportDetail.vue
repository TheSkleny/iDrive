<script setup>
import useApi from "@/Composables/useApi.js";
import {ref} from "vue";

const props = defineProps({
        args: Object,
    }
)
const report = ref(null)

const {response, error} = await useApi('GET', `report/${props.args.reportId}`)
if (response.data) {
    report.value = response.data.data
}
if (error) {
    console.log(error.value)
}

</script>

<template>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Report
            </h1>
        </div>
    </header>
    <div>
        {{ report }}
    </div>
</template>

<style scoped>

</style>
