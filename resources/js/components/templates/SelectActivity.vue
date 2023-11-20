<script setup>
import CurvesColor from "../loaders/CurvesColor.vue";
import {
    localHost,
} from '../../use';

const props = defineProps({
    level: {type: Array},
    planet: {type: String},
})
</script>
<template>

    <div class="bg-space rounded-md flex justify-center items-center h-full">
        <div class="flex-col">
            <div class="flex justify-center items-center">
                <div>
                    <div class="text-white text-6xl font-bold my-6 rounded-md flex justify-center">Nivel {{ props.level[0] }}</div>
                    <div class="flex justify-center">
                        <img :src="props.planet" width="80" alt="">
                    </div>
                    <div class="text-white text-xl font-bold mt-6 rounded-md flex justify-center bg-orange-700 px-2 py-1 border border-orange-400">Selecciona una actividad</div>
                </div>
            </div>
            <div class="scale-75 flex gap-16 items-center grid grid-cols-4">
                <a :href="`${localHost}/level${props.level[0]}/${i}`" :id="i" v-for="i in 8" :key="i">
                    <CurvesColor :number="i"/>
                </a>
            </div>
        </div>
    </div>

</template>
