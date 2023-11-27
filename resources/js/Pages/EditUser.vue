<script setup>
import { ref, computed } from 'vue'
import useApi from "@/Composables/useApi.js";
import useRedirect from "@/Composables/useRedirect.js";
import {Head} from "@inertiajs/vue3";



</script>


<template>
    <Head title="User" />

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Edit user {{  }}
            </h1>
        </div>
    </header>

    <div>
        <v-container>
            <v-card>
                TODO
            </v-card>
        </v-container>
    </div>
</template>
