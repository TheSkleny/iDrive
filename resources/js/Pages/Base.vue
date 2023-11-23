<script setup>
import Driver from "@/Pages/Driver.vue";
import SearchLine from "@/Pages/SearchLine.vue";
import ReportTypes from "@/Pages/ReportTypes.vue";
import LineDetail from "@/Pages/LineDetail.vue";
import VehicleDetail from "@/Pages/VehicleDetail.vue";
import useRedirect from "@/Composables/useRedirect.js";

const props = defineProps({
    c: String,
    args: Object
})

const comp = () => {
    switch (props.c) {
        case 'Driver':
            return Driver
        case 'SearchLine':
            return SearchLine
        case 'ReportTypes':
            return ReportTypes
        case 'LineDetail':
            return LineDetail
        case 'VehicleDetail':
            return VehicleDetail
        default:
            return Driver //TODO: error page or home page
    }
}

const nav_items = [
    {
        icon: 'mdi-map-search-outline',
        title: 'Search line',
        route: 'search-line'
    },
    {
        icon: 'mdi-account-box',
        title: 'Account',
        route: 'account'
    },
    {
        icon: 'mdi-timetable',
        title: 'Shifts',
        route: 'shifts'
    }
]

const routeTo = (route) => {
    useRedirect.navbar(route)
}


</script>

<template>
    <v-app style="display: flex; flex-direction: row">
        <v-layout>
            <v-app-bar>
                <v-icon size="50px" style="margin: 10px">mdi-car-turbocharger</v-icon>
                <p style="margin: 20px; font-size: 26px; font-weight: bold">iDrive</p>
                <v-spacer/>
                <v-btn>BUTTON</v-btn>
                <v-btn>BUTTON</v-btn>
            </v-app-bar>
            <v-navigation-drawer style="flex: 10">
                <v-list color="transparent">
                    <v-list-item v-for="item in nav_items" :key="item.title"
                                    @click="routeTo(item.route)"
                    >
                        <v-icon>{{ item.icon }}</v-icon>
                        {{ item.title }}
                    </v-list-item>
                </v-list>
            </v-navigation-drawer>
            <v-main>
                <Suspense style="flex: 100">
                    <component :is="comp()" :args="args"/>
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
            </v-main>
        </v-layout>
    </v-app>
</template>
