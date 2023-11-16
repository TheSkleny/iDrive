<script setup>
import axios from 'axios';
import {ref} from "vue";

const API_URL = 'http://127.0.0.1:8000/api/driver/3';

const shifts = ref([])
axios.get(API_URL)
    .then(response => {
        shifts.value = response.data.data
    })
    .catch(error => {
        console.log(error)
    })

</script>

<template>
    <div>
        <h1>Driver shifts</h1>
        <ul>
            <li v-for="shift in shifts" :key="shift.LinkId">
                Line name: {{ shift.LineName }}
                <br>
                Vehicle type: {{ shift.Description }}
                <br>
                Vehicle name: {{ shift.Name }}
                <br>
                Departure time: {{ shift.DepartureTime }}
                <br>
                First stop: {{ shift.FirstStop }}
                <br>
                Last stop: {{ shift.LastStop }}
            </li>
        </ul>
    </div>
</template>
