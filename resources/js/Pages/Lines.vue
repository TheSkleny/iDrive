<template>
  <div>
    <h1>Lines List</h1>
    <ul>
      <li v-for="line in lines" :key="line.Id">
        {{ line.VehicleTypeId }}
        {{ line.Name }}
        {{ line.Description }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      lines: []
    }
  },
  mounted() {
    axios.get('http://127.0.0.1:8000/api/lines')
      .then(response => {
        this.lines = response.data.data
      })
      .catch(error => {
        console.log(error)
      })
  }
}
</script>
