<script setup>
import { ref, computed } from 'vue'
import useApi from "@/Composables/useApi.js";
import useRedirect from "@/Composables/useRedirect.js";
import {Head} from "@inertiajs/vue3";

const users = ref([])

const props = defineProps({
    args: Object
})

const {response, error} = await useApi('GET', `users`)
if (response) {
    users.value = response.data.data
}
if (error) {
    console.log(error.value)
}

const deleteUser = async (id) => {
    const {response: responseSend, error: errorSend} = await useApi('DELETE', `users/${id}`)
    if (responseSend) {
        console.log(responseSend.data)
        location.reload() // Reload the page
    }
    if (errorSend) {
        console.log(errorSend.value)
    }
}

const editUser = (id) => {
    useRedirect.editUser(id)
}

const filteredUsers = computed(() => {
    // Filter the users array to exclude the currently logged user
    return users.value.filter(user => user.UserId !== props.args.UserId)
})


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
        <v-container>
            <v-card>
                <h2 class="card_header">
                    Users
                </h2>
                <v-table fixed-header>
                    <thead>
                    <tr>
                        <td>User name</td>
                        <td>Email</td>
                        <td>User role</td>
                        <td>Edit user</td>
                        <td>Delete user</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in filteredUsers" :key="user.UserId">
                        <td>{{ user.UserName }}</td>
                        <td>{{ user.UserEmail }}</td>
                        <td>{{ user.UserType }}</td>
                        <td>
                            <v-btn @click="() => editUser(user.UserId)" variant="tonal">
                                Edit
                            </v-btn>
                        </td>
                        <td>
                            <v-btn @click="() => deleteUser(user.UserId)" color="red">
                                DELETE
                            </v-btn>
                        </td>
                    </tr>
                    </tbody>
                </v-table>
            </v-card>
        </v-container>
    </div>
</template>
