<script setup>
import { ref, computed } from 'vue'
import useApi from "@/Composables/useApi.js";
import useRedirect from "@/Composables/useRedirect.js";
import {Head} from "@inertiajs/vue3";

const user = ref(null)
const types = ref(null)
const newName = ref(null)
const newRole = ref(null)

const props = defineProps({
    args: Object
})


// Fetch user data from API
const {response, error} = await useApi('GET', `users/${props.args.UserId}`)
if (response) {
    user.value = response.data.userInfo.original.data[0]
    types.value = response.data.userTypes.original.data
}
if (error) {
    console.log(error.value)
}

const rolesList = []
types.value.forEach(type => {
    rolesList.push({
        title: type.UserType,
        value: type.UserTypeId
    })
})

// Set the default values for the form
newName.value = user.value.UserName
newRole.value = user.value.UserTypeId

// Edit the user
async function editUser(id) {
    await useApi('PATCH', `users/${id}`, {
        'userId': id,
        'name': newName.value,
        'typeId': newRole.value
    })
    useRedirect.users()
}

</script>


<template>
        <Head title="User" />

        <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h1 class="text-3xl font-bold leading-tight text-gray-900">
                                Edit user {{ user.UserName }}
                        </h1>
                </div>
        </header>

        <div>
            <v-container>
                <v-card>
                    <h2 class="card_header">
                        Edit user
                    </h2>
                    <v-card-text>
                        <v-form>
                            <v-row>
                                    <v-text-field
                                        v-model="newName"
                                        label="Name"
                                        required
                                    >
                                    </v-text-field>
                            </v-row>
                            <v-row>
                                
                                    <v-select
                                        v-model="newRole"
                                        :items="rolesList"
                                        label="Role"
                                        required
                                    ></v-select>
                                
                            </v-row>
                            <v-row>
                                <v-col cols="12" sm="6">
                                    <v-btn
                                        
                                        @click="editUser(user.UserId)"
                                    >
                                        Save
                                    </v-btn>
                                </v-col>
                            </v-row>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-container>
        </div>
</template>
