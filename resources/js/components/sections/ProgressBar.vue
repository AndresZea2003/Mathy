<script setup>

import {onMounted, ref} from "vue";
import {store_data} from "../../use/store_data";
import {localHost} from "../../use/index.js";
import axios from 'axios';


const props = defineProps({
  rocket: {type: String},
  planet_1: {type: String},
  planet_2: {type: String},
  level: {type: Array},
})

let activityNumber = ref(0);
let level = ref(0);
const currentShip = ref(0);
let totalActivities = ref(12);
let showStation = ref(Math.floor(Math.random() * 2) + 1)
onMounted(async () => {
  currentShip.value = store_data[localStorage.getItem('shipSelected') - 1].img;
  level.value = props.level[0];
  activityNumber.value = props.level[1]

  const response = await axios.get('/activityCount/' + level.value);
  if (response.data === props.level[1]) {
    showStation.value = 3;
  }
  if (response.data > 10) {
    totalActivities.value = response.data;
  }
});


</script>

<template>
  <div id="progressBar"
       class="bg-space px-5 rounded-md flex items-center justify-center h-full opacity-100
       duration-300 border-black border-4">
    <div id="staticBar" class="grid grid-cols-1 duration-300 opacity-100">
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
               class="flex justify-center duration-300 scale-150">
            <img id="nave" class="rotate-45" :src="currentShip" width="100" alt="rocket">

          </div>
        </div>
      </div>
    </div>

    <div id="test2" class="grid grid-cols-1 absolute duration-300 opacity-0">
      <div class="flex justify-center items-center mt-1 gap-5">
        <div class="w-[80%] grid">
          <div id="naveDiv"
               class="flex justify-center duration-300 scale-150 bg-red-700 w-[200px]">
            <!--            <img id="nave" class="rotate-45 absolute" :src="currentShip" width="100" alt="rocket">-->
            <!--            <img id="naveFire" class="rotate-90 duration-300 absolute translate-y-[-180px] translate-x-[-170px]"-->
            <!--                 :src="localHost + '/images/rockets/Cohetes-13.gif'" width="180" alt="rocket">-->

            <div id="naveFire" class="flex justify-center moveRight">
              <!--              <img id="nave" class="rotate-45 absolute translate-y-[-120px] translate-x-[-170px]"-->
              <!--                 :src="currentShip" width="100" alt="rocket">-->
              <img class="rotate-90 duration-300 absolute translate-y-[-180px] translate-x-[-300px]"
                   :src="localHost + '/images/rockets/Cohetes-13.gif'" width="180" alt="rocket">
            </div>


            <!--            <img id="nave" class="absolute duration-300 translate-y-[-80px] translate-x-[90px]"-->
            <!--                 :src="localHost + '/images/objects/spaceStop.png'" width="100" alt="rocket">-->

            <div v-if="showStation === 1" id="station" class="absolute duration-300 translate-y-[-80px] translate-x-[90px]">
              <img id="sat" class="opacity-100 duration-300"
                   :src="localHost + '/images/objects/test1.png'" width="100" alt="rocket">
            </div>

            <div v-if="showStation === 2" id="station" class="absolute duration-300 translate-y-[-70px] translate-x-[90px]">
              <img id="sat2" class=""
                   :src="localHost + '/images/objects/test2.png'" width="80" alt="rocket">
            </div>

            <div v-if="showStation === 3" id="station" class="absolute duration-300 translate-y-[-70px] translate-x-[90px]">
              <img id="sat2" class=""
                   :src="props.planet_2" width="80" alt="rocket">
            </div>


          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<style scoped>

#test2 {
  position: absolute;
  left: 64%;
  padding-top: 80px;
  transform: translate(-64%);
}

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

#progressBar2 {
  animation: moveRightLeft 60s linear infinite;
  background-repeat: repeat-x;
}

@keyframes moveRightLeft {
  0% {
    background-position: 0 0;
  }
  50% {
    background-position: 100% 0;
  }
  100% {
    background-position: 0 0;
  }
}

#sat {
  animation: rotateBackground 30s linear infinite;
}

@keyframes rotateBackground {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

#sat2 {
  animation: balance 10s linear infinite;
}

@keyframes balance {
  0% {
    transform: rotate(0deg);
  }
  50% {
    transform: rotate(40deg);
  }
  100% {
    transform: rotate(0deg);
  }
}

@keyframes moveLeft {
  0% {
    transform: translateY(-70px) translateX(0) scale(0.1);
  }
  100% {
    transform: translateY(-70px) translateX(-140px) scale(1);
  }
}

.moveLeftInOut {
  animation: moveLeft 2s ease-in-out forwards;
}
</style>
