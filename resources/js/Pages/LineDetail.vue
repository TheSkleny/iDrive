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
    <header class="bg-white shadow">
        <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8/">
            <v-row style="margin-left: 50px">
                <v-icon size="50px">{{ line.VehicleTypeIcon }}</v-icon>
                <h1 class="text-3xl font-bold leading-tight text-gray-900"
                    style="margin-left: 20px; margin-top: 7px"
                >
                    Line {{ line.LineName }}
                </h1>
            </v-row>

        </div>
    </header>
    <v-container>
        <v-timeline direction="vertical" side="end" truncate-line="both">
            <v-timeline-item v-for="stop in line.Stops"
                             icon="mdi-map-marker"
                             dot-color="teal">
                {{ stop.Name }}
            </v-timeline-item>
        </v-timeline>
    </v-container>
</template>
