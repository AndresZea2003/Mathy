<script setup>

import {onMounted, ref} from "vue";
import { store_data } from "../../use/store_data";
import { localHost } from "../../use/index.js";
import axios from 'axios';


const props = defineProps({
  rocket: {type: String},
  planet_1: {type: String},
  planet_2: {type: String},
  level: {type: Number},
})

let activityNumber = ref(0);
let level = ref(0);
const currentShip = ref(0);
let totalActivities = ref(12);
onMounted(async () => {
  currentShip.value = store_data[localStorage.getItem('shipSelected') - 1].img;
  level.value = props.level[0];
  activityNumber.value = props.level[1]

  const response = await axios.get('/activityCount/' + level.value);
  if (response.data > 10){
    totalActivities.value = response.data;
  }
});


</script>

<template>
  <div id="progressBar" class="bg-space px-5 rounded-md border-black border-2 flex items-center justify-center h-full">
    <div class="grid grid-cols-1">
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



  <div id="animatedRocket" class="bg-space px-5 rounded-md border-black border-2 flex items-center justify-start h-[80%] hidden">
    <img class="rocket-travel absolute" :src="localHost + '/images/rockets/Cohetes-13.gif'"
         width="100" alt="">
  </div>
</template>

<style scoped>

.rocket-travel {
  rotate: 90deg;
  animation: rocketMoveCombined 7s linear infinite;
}

@keyframes rocketMoveCombined {
  0% {
    transform: translateY(0) translateX(0);
  }
  25% {
    transform: translateY(-300px) translateX(-20px);
  }
  50% {
    transform: translateY(-800px) translateX(0);
  }
  75% {
    transform: translateY(-800px) translateX(-10px);
  }
  100% {
    transform: translateY(-800px) translateX(0);
  }
}
</style>
