<script setup>
import Driver from "@/Pages/Driver.vue";
import Lines from "@/Pages/Lines.vue";
import ReportTypes from "@/Pages/ReportTypes.vue";

const props = defineProps({
    c: String
})

const comp = () => {
    switch (props.c) {
        case 'Driver':
            return Driver
        case 'Lines':
            return Lines
        case 'ReportTypes':
            return ReportTypes
        default:
            return Driver
    }
}

</script>

<template>
    <v-app>
        <Suspense>
            <component :is="comp()" />
            <template #fallback>
                <h1>Loading...</h1>
            </template>
        </Suspense>
    </v-app>
</template>
