<script setup>
import {ref} from 'vue'
import axios from 'axios'
import Base from '@/Pages/Base/App.vue'

const lines = ref([])
axios.get('http://127.0.0.1:8000/api/lines')
    .then(response => {
        this.lines.value = response.data.data
    })
    .catch(error => {
        console.log(error)
    })
</script>


<template>
    <Base>
        <div>
            <v-btn>Penis</v-btn>
            <h1>Lines List</h1>
            <ul>
                <li v-for="line in lines" :key="line.Id">
                    {{ line.VehicleTypeId }}
                    {{ line.Name }}
                    {{ line.Description }}
                </li>
            </ul>
        </div>
    </Base>
</template>


