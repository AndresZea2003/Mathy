<script setup>

import {onMounted, ref} from "vue";
import { store_data } from "../../use/store_data";

const props = defineProps({
  rocket: {type: String},
  planet_1: {type: String},
  planet_2: {type: String},
  activity_number: {type: Number},
})

let activityNumber = ref(0);
const currentShip = ref(0);

onMounted(() => {
  currentShip.value = store_data[localStorage.getItem('shipSelected') - 1].img;
  activityNumber.value = props.activity_number
});


let totalActivities = 12;


</script>

<template>
  <div id="progressBar" class="bg-space px-5 rounded-md border-black border-2 flex-col items-center justify-center h-full">
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
            <img id="nave" class="rotate-45" :src="currentShip" width="100" alt="rocket">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="animatedRocket" class="bg-space px-5 rounded-md border-black border-2 flex items-center justify-start h-full hidden">
    <img class="rocket-travel" :src="props.rocket"
         width="100" alt="">
  </div>
</template>

<style scoped>

.rocket-travel {
  animation: rocketMoveCombined 7s linear infinite;
}

@keyframes rocketMoveCombined {
  0% {
    transform: translateX(0) translateY(0);
  }
  25% {
    transform: translateX(300px) translateY(-20px);
  }
  50% {
    transform: translateX(800px) translateY(0);
  }
  75% {
    transform: translateX(800px) translateY(-10px);
  }
  100% {
    transform: translateX(800px) translateY(0);
  }
}
</style>
