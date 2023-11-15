<template>
  <div>
    <h1>Report Types</h1>
    <ul>
      <li v-for="reportType in reportTypes" :key="reportType.Id">
        {{ reportType.Description }}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/api/report-types';

export default {
  data() {
    return {
      reportTypes: [],
    };
  },
  async created() {
    try {
      const response = await axios.get(API_URL);
      this.reportTypes = response.data.data;
    } catch (error) {
      console.error('Error fetching report types:', error);
      // Optionally, you can show an error message to the user
    }
  },
};
</script>
