<script setup>
import "../sections/HelpCharacter.vue";
import HelpCharacter from "../sections/HelpCharacter.vue";
import ItemPalette from "../sections/ItemPalette.vue";
import ProgressBar from "../sections/ProgressBar.vue";
import WinView from "../templates/WinView.vue";
import {
  types,
  localHost,
  getSelectItem,
  playAudio, cleanBox, winCoinCheckLevel,
} from '../../use';
import {onMounted, ref} from "vue";
import IconArrowRight from "../icons/IconArrowRight.vue"
import IconPaintBrush from "../icons/IconPaintBrush.vue"
import Swal from "sweetalert2";
import {defineProps} from 'vue';
import BackgroundActivities from "../background/BackgroundActivities.vue";
import CoinChangerVortex from "./Coin Changer/CoinChangerVortex.vue";
import CoinChanger from "./Coin Changer/CoinChanger.vue";
import WinCoin from "../templates/WinCoin/WinCoin.vue";

const props = defineProps({
  size: {type: Array},
  fill_sample: {type: Array},
  solution: {type: Array},
  level: {type: Array},
  items: {type: Array},
  rotate: {type: Boolean},
  fake_items: {type: Array},
  create_audio_1: {type: String},
  create_audio_2: {type: String},
  create_audio_3: {type: String},
  phase: {type: Number},
  draw: {type: String},
})

const items = props.items
const talkBool = ref(false)
const levelComplete = ref(false)
let isMouseDown = ref(false);
let calibrateSound = ref(false);
let calibrateSoundBlom = ref(false);
const coinChangerVortexRef = ref(false);
const vortexType = ref("");
const selectedLevelVortex = ref(false);
const selectedCoinChanger = ref(false);
const coinChangerCloseUser = ref(false);
const updateCoins = ref(false);
const inTutorial = ref(false);
const winCoinRef = ref(false);//Creado para determinar si el nivel se reclaman monedas y que tipo de moneda
const winCoinViewAnimation = ref(false);//Creado para mostrar animacion si se cumplen requisitos


//Establecemos la ubicacion actual del software en el storage
localStorage.setItem('currentLocation', `${localHost}/level${props.level[0]}/${props.level[1]}`);

let totalActivities = ref(0)
onMounted(async () => {
  winCoinRef.value = winCoinCheckLevel(props.level[0], props.level[1]); //Determinamos si el componente da una moneda o no.
  await axios.get('/activityCount/' + props.level[0])
      .then(response => totalActivities.value = response.data);
});

const playPaintSound = () => {
  if (calibrateSound.value) {
    return;
  }

  // playAudio(`/audios/effects/sprayPaint.mp3`);
  playAudio(`/audios/effects/wood.wav`);
  calibrateSound.value = true;

  setTimeout(() => {
    calibrateSound.value = false;
  }, 250);
};

const playBlomSound = () => {
  if (calibrateSoundBlom.value) {
    return;
  }

  let blomSound = playAudio(`/audios/effects/blom.mp3`);
  calibrateSoundBlom.value = true;

  setTimeout(() => {
    calibrateSoundBlom.value = false;
  }, 250);
};

const playEraserSound = () => {
  if (calibrateSound.value) {
    return;
  }

  playAudio(`/audios/effects/bookSlide.mp3`);
  calibrateSound.value = true;

  setTimeout(() => {
    calibrateSound.value = false;
  }, 250);
};

const handleMouseDown = () => {
  isMouseDown.value = true;
};

const handleMouseUp = () => {
  isMouseDown.value = false;
  nicePaint.value = 'Sin pintar';
};

let prepare = ref(false);
let nicePaint = ref('Sin pintar');

let pixelsCompleted = ref([]);
let pixelsError = ref([]);
const paint = (id, hex) => {
  if (!isMouseDown.value || levelComplete.value) {
    return;
  }

  let itemSelected = getSelectItem()
  let pixel = document.getElementById(id)
  if (pixel.classList.contains('opacity-80')) {
    pixel.classList.add('bg-gray-400')
  }

  const removeItemFromArray = (array, item) => {
    const index = array.value.indexOf(item);
    if (index !== -1) {
      array.value.splice(index, 1);
    }
  };

  if (itemSelected.type === types.eraser) {
    removeItemFromArray(pixelsError, pixel.id);
    removeItemFromArray(pixelsCompleted, pixel.id);

    pixel.classList.remove('rounded', 'zoom-box');
    pixel.style.backgroundColor = pixel.style.opacity === '0.8' ? '' : bgSilhouette.value;

    playEraserSound();
    if (pixelsCompleted.value.length === totalPixels.value && pixelsError.value.length === 0 && !levelComplete.value) {
      win()
    }

    return;
  }

  if (hex) {
    pixel.style.backgroundColor = hex;
  } else {

    let dataColor = pixel.getAttribute('data-color')

    if (dataColor === itemSelected.hex) {

      if (!pixelsCompleted.value.includes(pixel.id)) {
        pixelsCompleted.value.push(pixel.id)
        playBlomSound();
      }

      if (pixelsError.value.includes(pixel.id)) {
        removeItemFromArray(pixelsError, pixel.id)
      }

      pixel.style.backgroundColor = '';


      nicePaint.value = 'BIEN!';
      pixel.style.backgroundColor = itemSelected.hex;
      if (pixel.classList.contains('rounded')) {
        pixel.classList.remove('rounded', 'zoom-box')
      }

    } else {

      if (pixelsCompleted.value.includes(pixel.id)) {
        removeItemFromArray(pixelsCompleted, pixel.id);
      }

      if (!pixelsError.value.includes(pixel.id)) {
        pixelsError.value.push(pixel.id)
      }

      playPaintSound();
      nicePaint.value = 'ERROR';
      pixel.classList.add('brush-fail')
      pixel.classList.add('rounded', 'zoom-box')
      setTimeout(() => {
        pixel.classList.remove('brush-fail')
      }, 100)
      pixel.style.backgroundColor = '#7f1d1d';
      setTimeout(() => {
        pixel.style.backgroundColor = '';
      }, 100)
      setTimeout(() => {
        pixel.style.backgroundColor = itemSelected.hex;
      }, 101)

    }
  }

  if (pixelsCompleted.value.length === totalPixels.value && pixelsError.value.length === 0 && !levelComplete.value) {
    win()
  }

}

let bgSilhouette = ref('#94a3b8');
const paintRow = (rowNumber, item, guide) => {

  isMouseDown.value = true;
  prepare.value = true;

  for (let i = 1; i <= 9; i++) {
    if (guide) {
      let id = `muestra${rowNumber}-${i}`;
      let pixel = document.getElementById(id)
      pixel.style.backgroundColor = items[item].hex
      continue;
    }
    let id = `caja${rowNumber}-${i}`;
    localStorage.setItem('itemSelected', JSON.stringify(items[item]))
    paint(id, bgSilhouette.value);
    document.getElementById(id).style.opacity = ""
    document.getElementById(id).setAttribute('data-color', items[item].hex)
  }
  isMouseDown.value = false;
  prepare.value = false;

};

// import {cat, mouse, heart, turtle, hat, smile} from '../../use';

import { drawsArray } from "../../use"; //Importación del array que contiene los dibujos


// const drawOptions = {
//   cat: cat,
//   mouse: mouse,
//   heart: heart,
//   turtle: turtle,
//   hat: hat,
//   smile: smile
// };

let totalPixels = ref(drawsArray[props.draw].length / 2 * 9);

// let totalPixels = ref((drawOptions[props.draw].length / 2) * 9)
let i = 0

setTimeout(function () {
  // Itera sobre el array paintData y llama a paintRow para cada fila
  drawsArray[props.draw].forEach(({row, color, guide}) => {
    paintRow(row, color, guide);
  });


  // drawOptions[props.draw].forEach(({row, color, guide}) => {
  //   paintRow(row, color, guide);
  // });
}, 500);

let level = ref(props.level)
let showProgressBar = ref(true)
const win = async () => {
  levelComplete.value = true
  playAudio(`${localHost}/audios/effects/levelUp.mp3`)
  let progressBar = document.getElementById('progressBar')

  let staticBar = document.getElementById('staticBar')

  let animated = document.getElementById('test2')

  let station = document.getElementById('station')

  let board = document.getElementById('board')

  let winView = document.getElementById('winView')

  staticBar.classList.replace('opacity-100', 'opacity-0')
  progressBar.classList.replace('border-black', 'border-yellow-400')
  animated.classList.replace('opacity-0', 'opacity-100')
  station.classList.add('moveLeftInOut')

  board.classList.replace('bg-red-200', 'bg-green-300')

  let button = document.getElementById('nextLevelButton')

  if (totalActivities.value === level.value[1]) {
    button.classList.remove('hidden')
    return
  }


  winView.classList.remove('hidden')

  setTimeout(function () {
    board.classList.replace('bg-green-300', 'bg-red-200')
    winView.classList.replace('opacity-0', 'opacity-100')

    setTimeout(function () {
      staticBar.classList.replace('opacity-0', 'opacity-100')
      animated.classList.replace('opacity-100', 'opacity-0')
      button.classList.remove('hidden')
      showProgressBar.value = false
      level.value[1] = level.value[1] + 1
      setTimeout(function () {
        showProgressBar.value = true
      }, 100)
    }, 1000)
  }, 2000)

  setTimeout(function () {
    winView.classList.replace('opacity-100', 'opacity-0')
    setTimeout(function () {
      winView.classList.add('hidden');
      if(winCoinRef.value){
        console.log("win", winCoinRef.value);
        winCoinViewAnimation.value = true;

        setTimeout(() => {
          winCoinViewAnimation.value = false;
        }, 15000);
      };
    }, 200)
  }, 4000)
};



//Funcion que controla los emits que activan el vortice
const coinChangerVortexActivate = (event) => {
  coinChangerVortexRef.value = event;
};


//Funcion que controla el tipo de vortice si es a coin changer o a la store
const vortexTypeFunction = (event) => {
  vortexType.value = event;
};

//Funcion que controla cuando el usuario da click para mostrar la animacion de la nave viajando al portal.
const selectedLevelVortexFunction= (event) => {
  selectedLevelVortex.value = event;
};

//Funcion que controla si se abre el coinChanger
const selectedCoinChangerFunction = (event) => {
  selectedCoinChanger.value = event;
};
//Funcion para controlar el cierre del cambiador de monedas
const coinChangerClose = (event) => {
  selectedCoinChanger.value = event;
  selectedLevelVortex.value = event;
  coinChangerVortexRef.value = event;
  coinChangerCloseUser.value = true;
};

//Funcion que controla la actualizacion de las monedas para mostrar en el componente de monedas.
const updateCoinsFunction = (event) => {
  updateCoins.value = event;
};


</script>
<template>

  <BackgroundActivities/>

  <WinView id="winView" class="hidden opacity-0 duration-300"/>
  <CoinChangerVortex v-if="coinChangerVortexRef || selectedLevelVortex" :type="vortexType" :selected="selectedLevelVortex"/>
  <WinCoin v-if="winCoinViewAnimation" :type_coin="winCoinRef" @updateCoins="updateCoinsFunction"/>

  <div class="flex flex-col h-[90%]" @mousedown="handleMouseDown" @mouseup="handleMouseUp">
    <div class="mx-auto flex-1 container flex justify-center">
      <div class="flex  p-6 w-full gap-5 rounded-md">

        <div id="board" class="w-[84%] bg-red-200 bg-opacity-70 h-[100%] p-5 grid relative">
          <div v-if="selectedCoinChanger" class="w-full h-full absolute top-0 left-0 z-30" >
            <CoinChanger :storageBronze="'bronzeCoins'" :storageSilver="'silverCoins'" :storageGold="'goldCoins'" :goldenExchange="3" :silverExchange="3" :guide="true" @coinChangerClose="coinChangerClose" @updateCoins="updateCoinsFunction"/>
          </div>
          <div style="height: 150px; position: relative">
            <ProgressBar v-if="showProgressBar" class="select-none" :planet_1="`${localHost}/images/planets/tierra.svg`"
                         :planet_2="`${localHost}/images/planets/rojo.svg`"
                         :rocket="`${localHost}/images/rockets/1.svg`"
                         :level="props.level"
            />
          </div>

          <div class="flex justify-center items-center">
            <div>
              <div class="my-6 flex justify-center gap-5">

                <div class="flex justify-center border-black border-4">
                  <div class="grid grid-cols-11 bg-white w-full">
                    <!-- linea1 -->
                    <div v-for="i in 99" :key="`i-${i}`" class="grid grid-cols-3 border border-black">
                      <span id="showIDs" v-if="false" class="absolute select-none">{{ i }}</span>
                      <div :id="`muestra${i}-${n}`"
                           class="select-none hover:bg-gray-300" style="width: 14px; height: 14px;" v-for="n in 9"
                           :key="`n-${n}`">
                      </div>
                    </div>
                  </div>
                </div>


<!--                <span class="font-bold text-2xl absolute translate-x-[250px] translate-y-[-100px]">{{-->
<!--                    nicePaint-->
<!--                  }}-->
<!--                ,  {{ pixelsCompleted.length }} / {{ totalPixels }} //// Errores: {{ pixelsError.length }}-->
<!--                </span>-->

                <div class="flex justify-center border-black border-4">
                  <div class="grid grid-cols-11 bg-white w-full">
                    <!-- linea1 -->
                    <div v-for="i in 99" :key="`i-${i}`" class="grid grid-cols-3 border border-black cursor-cell">
                      <div @mousemove="paint(`caja${i}-${n}`, null)" @click="paint(`caja${i}-${n}`, 'click')" :id="`caja${i}-${n}`"
                           class="select-none duration-100"
                           style="width: 14px; height: 14px; opacity: 0.8" v-for="n in 9"
                           :key="`n-${n}`">
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>

        <div class="w-[16%]">
          <ItemPalette
            :level="props.level"
            :items="items"
            :currentAudio="currentAudio"
            :updateCoins="updateCoins"
            :coinChangerClose="coinChangerCloseUser"
            @closeAnimation="coinChangerVortexActivate"
            @openAnimation="coinChangerVortexActivate"
            @vortexType="vortexTypeFunction"
            @selected="selectedLevelVortexFunction"
            @selectedCoinChanger="selectedCoinChangerFunction"
          />
        </div>
      </div>
    </div>
  </div>


</template>
<style scoped>

.brush-fail {
  animation: move-right 100ms linear infinite;
  fill: red;
}

@keyframes move-right {
  0% {
    transform: translateX(0);
  }
  50% {
    transform: translateX(10px);
  }
  100% {
    transform: translateX(0);
  }
}

.zoom-box {
  animation: zoom-out 1500ms linear infinite;
}

@keyframes zoom-out {
  /*0% {*/
  /*    transform: scale(.1);*/
  /*}*/
  50% {
    transform: scale(.75);
  }
  /*100% {*/
  /*    transform: scale(.1);*/
  /*}*/
}
</style>
