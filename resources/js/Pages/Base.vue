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
            <component :is="comp()"/>
            <template #fallback>
                <div class="center">
                    <h1 style="font-weight: bold; font-size: larger">Loading</h1>
                    <br>
                    <v-progress-circular style="display: block;
                                                margin-left: auto;
                                                margin-right: auto;"
                                         indeterminate
                    />
                </div>
            </template>
        </Suspense>
    </v-app>
</template>
