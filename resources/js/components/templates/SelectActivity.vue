<script setup>
import CurvesColor from "../loaders/CurvesColor.vue";
import {
  localHost, playAudio,
} from '../../use';

import SpaceBg from "@/components/background/SpaceBg.vue";
import PerfectHusky from "@/components/ui/PerfectHusky.vue";
import CardRadar from "@/components/ui/CardRadar.vue";
import CardPlanet from "@/components/ui/CardPlanet.vue";
import DullShrimp from "@/components/ui/DullShrimp.vue";

const props = defineProps({
  level: {type: Array},
  planet: {type: String},
  color_text: {type: String},
  color_card: {type: String},
  planet_name: {type: String}
})

import {
  HomeIcon,
  ArrowLeftCircleIcon,
  ArrowRightCircleIcon,
  ChevronDoubleUpIcon,
  ChevronDoubleDownIcon
} from '@heroicons/vue/24/solid';


const up = () => {
  document.querySelector('.bg-pattern1').scrollBy(0, -100); // Cambia -100 a la cantidad de píxeles que deseas desplazar hacia arriba
};

const down = () => {
  document.querySelector('.bg-pattern1').scrollBy(0, 100); // Cambia 100 a la cantidad de píxeles que deseas desplazar hacia abajo
};


//Funcion para que te lleve al menu inicial
const returnHome = () => {
  window.location = `${localHost}/levels`;
};

//Funcion para que te lleve al nivel anterior
const previousLevel = () => {
  window.location = `${localHost}/levels/${props.level[0] - 1}`;
};

//Funcion para que te lleve al siguiente nivel
const nextLevel = () => {
  window.location = `${localHost}/levels/${props.level[0] + 1}`;
};

</script>
<template>

  <!--  <SpaceBg></SpaceBg>-->

  <div :class="[`fixed h-full w-full flex justify-center items-center`, color_card]"
       style="background-position: center; background-size: cover;">
    <div :class="[`flex rounded-lg shadow-2xl w-full container justify-center`]" style="background-size: cover;">

      <div class="flex justify-between fixed gap-x-10 translate-y-[-50px]">
        <div v-if="props.level[0] !== 1" class="flex">
          <button @click="previousLevel()" class="hover:scale-125 duration-300">
            <ArrowLeftCircleIcon
                :class="[`w-10 hover:text-white duration-300`, props.color_text]"></ArrowLeftCircleIcon>
          </button>
        </div>

        <div class="flex">
          <button @click="returnHome()" class="hover:scale-125 duration-300">
            <HomeIcon :class="[`w-10 hover:text-white duration-300`, props.color_text]"></HomeIcon>
          </button>
        </div>

        <div class="flex">
          <button @click="nextLevel()" class="hover:scale-125 duration-300">
            <ArrowRightCircleIcon
                :class="[`w-10 hover:text-white duration-300`, props.color_text]"></ArrowRightCircleIcon>
          </button>
        </div>
      </div>

      <div class="grid grid-cols-5 w-full bg-gray-700 p-4 rounded-3xl shadow-2xl">
        <div class="bg-pattern2 flex justify-center p-4">
          <div class="text-center">
            <span class="font-luckiest-guy text-gray-300 text-3xl">Planeta {{ props.planet_name }}</span>
            <div class="font-luckiest-guy text-gray-300 text-xl pt-4">
              Nivel {{ props.level[0] }}
            </div>

            <CardPlanet :planetUrl="localHost + `/images/planets/templates/${props.planet}`"
                        class="scale-75"></CardPlanet>

            <div class="flex justify-center border-b border-dashed">
              <img :src="localHost + '/images/characters/robot/stay1.gif'" width="160" alt="">
            </div>

          </div>
        </div>

        <div
            class="bg-pattern1 col-span-3 border-4 border-black h-[600px] overflow-auto grid grid-cols-4 p-12 gap-6 relative">
          <div :id="i" v-for="i, index in props.level[1]" :key="index" class="flex justify-center"
          >
            <a :href="`${localHost}/level${props.level[0]}/${i}`" :key="i">
              <PerfectHusky :activity="i" :color="color_card" :textColor="props.color_text"></PerfectHusky>
            </a>
          </div>
        </div>

        <div class="bg-pattern2 relative ">

          <div class="absolute w-[40px] top-0 py-2 h-full rounded-3xl ">

            <div
                :class="[`bg-orange-800 h-full rounded-3xl translate-x-[-40px] w-[36px] -z-10`, props.level[1] > 12 ? 'hidden' : '']">
            </div>


            <button @click="up" id="scrollUp"
                    class="bg-yellow-400 border-4 border-yellow-600 absolute translate-x-[-40px] w-[36px] top-0 py-2 rounded-t-xl translate-y-[4px]">
              <ChevronDoubleUpIcon class="w-7"></ChevronDoubleUpIcon>
            </button>


            <button @click="down" id="scrollDown"
                    class="bg-yellow-400 border-4 border-yellow-600 absolute translate-x-[-40px] w-[36px] bottom-0 py-2 rounded-b-xl translate-y-[-4px]">
              <ChevronDoubleDownIcon class="w-7"></ChevronDoubleDownIcon>
            </button>
          </div>

          <div class="p-2">
            <div class="flex p-6 bg-stone-700 rounded border-2 border-stone-500">
<!--              <span class="font-luckiest-guy font-luckiest-guy text-gray-300 text-3xl">Bronze:</span>-->
              <div :id="i" v-for="i in 5" :key="i" class="flex justify-center items-center ">
                <div class="loader border-2 rounded-full border-yellow-800 bg-[#dca570]
                  aspect-square w-8 flex justify-center items-center text-yellow-800"
                     :style="{transform: `translateX(${5 * i}px)`}">$
                </div>
              </div>
            </div>


            <div class="flex p-6 bg-gray-800 rounded border-2 border-gray-500 my-2">
<!--              <span class="font-luckiest-guy font-luckiest-guy text-gray-300 text-3xl">Plata:</span>-->
              <div :id="i" v-for="i in 3" :key="i" class="flex-col justify-start items-center ">
                <div class=" loader border-2 rounded-full border-gray-700 bg-gray-300
                  aspect-square w-8 flex justify-center items-center text-gray-700"
                     :style="{transform: `translateX(${5 * i}px)`}">$
                </div>
              </div>

            </div>

            <div class="flex p-6 bg-yellow-900 rounded border-2 border-yellow-500">
<!--              <span class="font-luckiest-guy font-luckiest-guy text-gray-300 text-3xl">Oro:</span>-->
              <div :id="i" v-for="i in 1" :key="i" class="flex-col justify-start items-center">
                <div class="loader border-2 rounded-full border-yellow-700 bg-yellow-300
                  aspect-square w-8 flex justify-center items-center text-yellow-700"
                     :style="{transform: `translateX(${5 * i}px)`}">$
                </div>
              </div>
            </div>

            <div class="h-[100px] flex justify-center">
              <CardRadar style="transform: scale(.6) translateY(-80px)"></CardRadar>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>

</template>

<style scoped>

.bg-pattern1 {
  background-color: #bbaa99;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='200' viewBox='0 0 160 80'%3E%3Cg fill='%23B0A090' %3E%3Cpolygon points='0 10 0 0 10 0'/%3E%3Cpolygon points='0 40 0 30 10 30'/%3E%3Cpolygon points='0 30 0 20 10 20'/%3E%3Cpolygon points='0 70 0 60 10 60'/%3E%3Cpolygon points='0 80 0 70 10 70'/%3E%3Cpolygon points='50 80 50 70 60 70'/%3E%3Cpolygon points='10 20 10 10 20 10'/%3E%3Cpolygon points='10 40 10 30 20 30'/%3E%3Cpolygon points='20 10 20 0 30 0'/%3E%3Cpolygon points='10 10 10 0 20 0'/%3E%3Cpolygon points='30 20 30 10 40 10'/%3E%3Cpolygon points='20 20 20 40 40 20'/%3E%3Cpolygon points='40 10 40 0 50 0'/%3E%3Cpolygon points='40 20 40 10 50 10'/%3E%3Cpolygon points='40 40 40 30 50 30'/%3E%3Cpolygon points='30 40 30 30 40 30'/%3E%3Cpolygon points='40 60 40 50 50 50'/%3E%3Cpolygon points='50 30 50 20 60 20'/%3E%3Cpolygon points='40 60 40 80 60 60'/%3E%3Cpolygon points='50 40 50 60 70 40'/%3E%3Cpolygon points='60 0 60 20 80 0'/%3E%3Cpolygon points='70 30 70 20 80 20'/%3E%3Cpolygon points='70 40 70 30 80 30'/%3E%3Cpolygon points='60 60 60 80 80 60'/%3E%3Cpolygon points='80 10 80 0 90 0'/%3E%3Cpolygon points='70 40 70 60 90 40'/%3E%3Cpolygon points='80 60 80 50 90 50'/%3E%3Cpolygon points='60 30 60 20 70 20'/%3E%3Cpolygon points='80 70 80 80 90 80 100 70'/%3E%3Cpolygon points='80 10 80 40 110 10'/%3E%3Cpolygon points='110 40 110 30 120 30'/%3E%3Cpolygon points='90 40 90 70 120 40'/%3E%3Cpolygon points='10 50 10 80 40 50'/%3E%3Cpolygon points='110 60 110 50 120 50'/%3E%3Cpolygon points='100 60 100 80 120 60'/%3E%3Cpolygon points='110 0 110 20 130 0'/%3E%3Cpolygon points='120 30 120 20 130 20'/%3E%3Cpolygon points='130 10 130 0 140 0'/%3E%3Cpolygon points='130 30 130 20 140 20'/%3E%3Cpolygon points='120 40 120 30 130 30'/%3E%3Cpolygon points='130 50 130 40 140 40'/%3E%3Cpolygon points='120 50 120 70 140 50'/%3E%3Cpolygon points='110 70 110 80 130 80 140 70'/%3E%3Cpolygon points='140 10 140 0 150 0'/%3E%3Cpolygon points='140 20 140 10 150 10'/%3E%3Cpolygon points='140 40 140 30 150 30'/%3E%3Cpolygon points='140 50 140 40 150 40'/%3E%3Cpolygon points='140 70 140 60 150 60'/%3E%3Cpolygon points='150 20 150 40 160 30 160 20'/%3E%3Cpolygon points='150 60 150 50 160 50'/%3E%3Cpolygon points='140 70 140 80 150 80 160 70'/%3E%3C/g%3E%3C/svg%3E");
}

.bg-pattern2 {
  background-color: #330033;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 800 800'%3E%3Cg fill='none' stroke='%23404' stroke-width='1'%3E%3Cpath d='M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63'/%3E%3Cpath d='M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764'/%3E%3Cpath d='M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880'/%3E%3Cpath d='M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382'/%3E%3Cpath d='M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269'/%3E%3C/g%3E%3Cg fill='%23505'%3E%3Ccircle cx='769' cy='229' r='5'/%3E%3Ccircle cx='539' cy='269' r='5'/%3E%3Ccircle cx='603' cy='493' r='5'/%3E%3Ccircle cx='731' cy='737' r='5'/%3E%3Ccircle cx='520' cy='660' r='5'/%3E%3Ccircle cx='309' cy='538' r='5'/%3E%3Ccircle cx='295' cy='764' r='5'/%3E%3Ccircle cx='40' cy='599' r='5'/%3E%3Ccircle cx='102' cy='382' r='5'/%3E%3Ccircle cx='127' cy='80' r='5'/%3E%3Ccircle cx='370' cy='105' r='5'/%3E%3Ccircle cx='578' cy='42' r='5'/%3E%3Ccircle cx='237' cy='261' r='5'/%3E%3Ccircle cx='390' cy='382' r='5'/%3E%3C/g%3E%3C/svg%3E");
}

.bg-pattern1::-webkit-scrollbar {
  width: 36px; /* Ancho de la barra de desplazamiento */
  transition-duration: 300ms;
}

.bg-pattern1::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  border-radius: 12px;
  background-color: #F5F5F5;
  transition-duration: 300ms;
}

.bg-pattern1::-webkit-scrollbar-thumb {
  border-radius: 14px;
  background: #9a3412; /* Color del deslizador */
  transition-duration: 300ms;
}

.bg-pattern1::-webkit-scrollbar-thumb:hover {
  background: #7c2d12; /* Color del deslizador al pasar el mouse */
  transition-duration: 300ms;
}
</style>
