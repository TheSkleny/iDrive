<script setup>
    import {ref} from 'vue'
    import useApi from "@/Composables/useApi.js";

    /**
     *
     * @type {Prettify<Readonly<ExtractPropTypes<{args: ObjectConstructor<{lineId:string}>}>>>}
     */
    const props = defineProps({
        args: Object}
    )

    /**
     *
     * @type {Ref<UnwrapRef<Line>>}
     */
    const line = ref(null)

    const {response, error} = await useApi('GET', `line/${props.args.lineId}`)
    if (response) {
        line.value = response.data.data
    }
    if (error) {
        console.log(error.value)
    }
</script>

<template>
    <div>
        <div>
            <v-icon>{{ line.VehicleTypeIcon }}</v-icon>
            <h1>Line {{ line.LineName }}</h1>
        </div>
        <v-timeline direction="vertical" side="end" truncate-line="both">
            <v-timeline-item v-for="stop in line.Stops"
                             icon="mdi-map-marker"
                             dot-color="red">
                {{ stop.Name }}
            </v-timeline-item>
        </v-timeline>
    </div>
</template>
