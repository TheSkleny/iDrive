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
        <h1>Line {{ line.LineName }}</h1>
        <v-timeline direction="vertical" side="end" truncate-line="both">
            <v-timeline-item v-for="stop in line.Stops">
                {{ stop.Name }}
            </v-timeline-item>
        </v-timeline>
    </div>
</template>
