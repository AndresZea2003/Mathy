<script setup>

import {onMounted, ref} from "vue";

const props = defineProps({
    rocket: {type: String},
    planet_1: {type: String},
    planet_2: {type: String},
    activity_number: {type: Number},
})

let activityNumber = ref(0)

onMounted(() => {
    activityNumber.value = props.activity_number
});


let totalActivities = 10
</script>

<template>
    <div class="bg-space px-5 rounded-md border-black border-2 flex items-center justify-center">
        <div class="grid grid-cols-1">
            <div class="flex justify-center">
                <span class="font-bold text-white">PROGRESO DEL VIAJE</span>
            </div>
            <div class="flex justify-center items-center mt-1 gap-5">
                <div>
                    <img :src="props.planet_1" width="50" alt="">
                </div>
                <div class="flex w-[80%] justify-center bg-gray-400 rounded-full border-2 border-gray-300">
                    <div v-for="i in totalActivities" :key="i" :id="`bar${i}`"
                         :class="['w-full h-5', 'bg-gray-400',
                                                 { 'bg-green-400' : i < activityNumber},
                                                 { 'border-l-4 border-black' : i !== 1 },
                                                 { 'rounded-l-full' : i === 1},
                                                 { 'rounded-r-full' : i === totalActivities},
                                                 ]">
                        {{ null }}
                    </div>
                </div>
                <div>
                    <img :src="props.planet_2" width="50" alt="">
                </div>
            </div>

            <div class="flex justify-center items-center mt-1 gap-5">
                <div class="flex w-[80%] grid"
                     :style="`grid-template-columns: repeat(${totalActivities}, minmax(0, 1fr));`">
                    <div id="naveDiv" :style="`grid-column: ${activityNumber};`"
                         class="flex justify-center duration-300">
                        <img id="nave" class="" :src="props.rocket"
                             width="60" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
