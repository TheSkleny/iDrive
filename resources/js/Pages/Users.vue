<script setup>
import { ref, computed } from 'vue'
import useApi from "@/Composables/useApi.js";
import useRedirect from "@/Composables/useRedirect.js";
import {Head} from "@inertiajs/vue3";

const {response, error} = await useApi('GET', `users`)
if (response) {
    console.log(response.data)
}
if (error) {
    console.log(error.value)
}


</script>


<template>
    <Head title="Users" />

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Users
            </h1>
        </div>
    </header>

    <div>
        <v-card>
            something
        </v-card>
    </div>
</template>
