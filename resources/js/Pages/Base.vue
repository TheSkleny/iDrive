<script setup>
import {ref} from 'vue';
import ApplicationLogo from '@/Components/Default/ApplicationLogo.vue';
import Dropdown from '@/Components/Default/Dropdown.vue';
import DropdownLink from '@/Components/Default/DropdownLink.vue';
import NavLink from '@/Components/Default/NavLink.vue';
import ResponsiveNavLink from '@/Components/Default/ResponsiveNavLink.vue';
import {Link} from '@inertiajs/vue3';
import DriverShifts from "@/Pages/DriverShifts.vue";
import SearchLine from "@/Pages/SearchLine.vue";
import ReportTypes from "@/Pages/ReportTypes.vue";
import LineDetail from "@/Pages/LineDetail.vue";
import VehicleDetail from "@/Pages/VehicleDetail.vue";
import Edit from "@/Pages/Edit.vue";
import Vehicles from "@/Pages/Vehicles.vue";
import ReportDetail from "@/Pages/ReportDetail.vue";
import Repairs from "@/Pages/Repairs.vue";
import DispatcherAllocate from "@/Pages/DispatcherAllocate.vue";
import Users from "@/Pages/Users.vue";
import EditUser from "@/Pages/EditUser.vue";
import VehicleEdit from "@/Pages/VehicleEdit.vue";
import Lines from "@/Pages/Lines.vue";
import Links from "@/Pages/Links.vue";
import EditLink from "@/Pages/EditLink.vue";
import AddVehicle from "@/Pages/AddVehicle.vue";



const showingNavigationDropdown = ref(false);

const props = defineProps({
    c: String,
    args: Object,
})

const comp = () => {
    switch (props.c) {
        case 'DriverShifts':
            return DriverShifts
        case 'SearchLine':
            return SearchLine
        case 'ReportTypes':
            return ReportTypes
        case 'LineDetail':
            return LineDetail
        case 'VehicleDetail':
            return VehicleDetail
        case 'Edit':
            return Edit
        case 'Vehicles':
            return Vehicles
        case 'ReportDetail':
            return ReportDetail
        case 'Repairs':
            return Repairs
        case 'Users':
            return Users
        case 'DispatcherAllocate':
            return DispatcherAllocate
        case 'VehicleEdit':
            return VehicleEdit
        case 'EditUser':
            return EditUser
        case 'Lines':
            return Lines
        case 'Links':
            return Links
        case 'EditLink':
            return EditLink
        case 'AddVehicle':
            return AddVehicle
        default:
            return SearchLine
    }
}

const nav_items = [
    [
        //index 0
    ],
    [
        //index 1
        {
            title: 'Shifts',
            link: 'shifts',
            icon: 'mdi-clock-time-eight-outline',
        }
    ],
    [
        //index 2
        {
            title: 'Allocations',
            link: 'allocate',
            icon: 'mdi-bus-clock',
        }
    ],
    [
        //index 3
        {
            title: 'Repairs',
            link: 'repairs',
            icon: 'mdi-wrench',
        }
    ],
    [
        //index 4
        {
            title: 'Vehicles',
            link: 'vehicles',
            icon: 'mdi-bus',
        },
        {
            title: 'Lines',
            link: 'lines',
            icon: 'mdi-bus-multiple',
        },
        {
            title: 'Links',
            link: 'links',
            icon: 'mdi-link-variant-plus',
        }
    ],
    [
        //index 5
        {
            title: 'Shifts',
            link: 'shifts',
            icon: 'mdi-clock-time-eight-outline',
        },
        {
            title: 'Allocations',
            link: 'allocate',
            icon: 'mdi-bus-clock',
        },
        {
            title: 'Repairs',
            link: 'repairs',
            icon: 'mdi-wrench',
        },
        {
            title: 'Vehicles',
            link: 'vehicles',
            icon: 'mdi-bus',
        },
        {
            title: 'Links',
            link: 'links',
            icon: 'mdi-link-variant-plus',
        },
        {
            title: 'Users',
            link: 'users',
            icon: 'mdi-account',
        },
        {
            title: 'Lines',
            link: 'lines',
            icon: 'mdi-bus-multiple',
        }
    ]
]

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('search-lines')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink :href="route('search-lines')" :active="route().current('search-lines')">
                                    <v-icon style="margin-right: 5px">
                                        mdi-magnify
                                    </v-icon>
                                    Search line
                                </NavLink>
                                <NavLink v-for="item in nav_items[props.args.UserType]" :key="item.title" :href="route(item.link)"
                                         :active="route().current(item.link)">
                                    <v-icon style="margin-right: 5px">
                                        {{ item.icon }}
                                    </v-icon>
                                    {{ item.title }}
                                </NavLink>

                            </div>
                        </div>
                        <div v-if="$page.props.auth.user">
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <!-- Settings Dropdown -->
                                <div class="ms-3 relative">
                                    <Dropdown align="right" width="48" style="margin-top: 15px">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                                >
                                                    {{ $page.props.auth.user.name }}

                                                    <svg
                                                        class="ms-2 -me-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('profile')"> Profile</DropdownLink>
                                            <DropdownLink :href="route('logout')" method="post" as="button">
                                                Log Out
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <v-container>
                                <v-row>
                                    <v-col>
                                        <v-btn :href="route('login')" variant="text">Login</v-btn>
                                    </v-col>
                                    <v-col>
                                        <v-btn :href="route('register')" variant="text">Register</v-btn>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('search-lines')" :active="route().current('search-lines')">
                            <v-icon style="margin-right: 5px">
                                mdi-magnify
                            </v-icon>
                            Search line
                        </ResponsiveNavLink>
                        <ResponsiveNavLink v-for="item in nav_items[props.args.UserType]" :key="item.title" :href="route(item.link)"
                                 :active="route().current(item.link)">
                            <v-icon style="margin-right: 5px">
                                {{ item.icon }}
                            </v-icon>
                            {{ item.title }}
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200" v-if="$page.props.auth.user">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile')"> Profile</ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->


            <!-- Page Content -->
            <main>
                <Suspense style="flex: 100">
                    <component :is="comp()" :args="args"/>
                    <template #fallback>
                        <div class="center">
                            <h1 style="font-weight: bold; font-size: larger">Loading</h1>
                            <br>
                            <v-progress-circular color="teal" style="display: block;
                                                margin-left: auto;
                                                margin-right: auto;"
                                                 indeterminate
                            />
                        </div>
                    </template>
                </Suspense>
            </main>
        </div>
    </div>
</template>
