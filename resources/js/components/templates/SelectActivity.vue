<script setup>
import CurvesColor from "../loaders/CurvesColor.vue";
import {
    localHost,
} from '../../use';

const props = defineProps({
    level: {type: Array},
})
</script>
<template>

    <div class="bg-space rounded-md flex justify-center items-center h-full">
        <div class="flex-col">
            <div class="flex justify-center">
                <span class="bg-gray-200 text-6xl font-bold p-2 rounded-md">Nivel 1</span>
            </div>
            <div class="scale-75 flex gap-16 items-center grid grid-cols-4">
                <a :href="`${localHost}/level${props.level[0]}/${i}`" :id="i" v-for="i in 7" :key="i">
                    <CurvesColor :number="i"/>
                </a>
            </div>
        </div>
    </div>

</template>
