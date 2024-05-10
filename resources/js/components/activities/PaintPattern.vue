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
  talk,
  talkCharacter,
  paintItem,
  errorPaint,
  playAudio,
  setOnEnded,
  showItemsPresentation,
  verifyFileExistence,
  resolveAudio,
  playSuccessShortRandom,
  showCheckIcon,
  showErrorIcon
} from '../../use';
import {onMounted, ref} from "vue";
import IconArrowRight from "../icons/IconArrowRight.vue"
import IconPaintBrush from "../icons/IconPaintBrush.vue"
import Swal from "sweetalert2";
import {defineProps} from 'vue';
import BackgroundActivities from "../background/BackgroundActivities.vue";
import CoinChangerVortex from "./Coin Changer/CoinChangerVortex.vue";
import CoinChanger from "./Coin Changer/CoinChanger.vue";

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
  show_help: {type: Number}
})

const items = props.items;
const talkBool = ref(false);
const levelComplete = ref(false);
const coinChangerVortexRef = ref(false);
const vortexType = ref("");
const selectedLevelVortex = ref(false);
const selectedCoinChanger = ref(false);
const updateCoins = ref(false);
const inTutorial = ref(false)

//Establecemos la ubicacion actual del software en el storage
localStorage.setItem('currentLocation', `${localHost}/level${props.level[0]}/${props.level[1]}`);

// console.log("propsleve", );

// Alerta inicial
const showInitialAlert = () => {
  Swal.fire({
    showConfirmButton: false,
    html: swalHtml,
    width: "30rem",
  }).then((result) => {
    intro(props.phase);
    prepareActivity()
  });
}

const swalHtml = `
    <div class="flex justify-center items-center text-center">
                  <div>

                    <div
                        class="bg-[url('https://cdn.pixabay.com/photo/2020/09/28/16/29/leaves-5610361_640.png')] font-press-start rounded shadow-2xl border-4 border-yellow-700 border-dashed my-6 py-12" style="background-position: center; background-size: cover;">
                        <span class="border-4 border-yellow-700 border-dashed py-4 bg-yellow-500 pl-4 pr-4 text-yellow-800">RETO ${props.level[1]}</span> <br> <br> <br>
                      <span class="text-yellow-400">Pinta</span>
                      <span class="text-blue-400"> y </span>
                      <span class="text-red-400">Completa</span>
                      <br>
                      <br>
                      <span class="text-gray-200">¡Haz Brillar el Cuadro!</span>
                    </div>
                    <button onmouseenter="playHoverSound('svgPlay')" onmouseleave="leaveMouse('svgPlay')"
                            onclick="Swal.clickConfirm()" class="btn-frog"><i class="animation"></i>
                      <div class="translate-x-[10px]">
                        Comenzar
                      </div>
                      <div>
                        <svg id="svgPlay" width="20px" fill="#fff" viewBox="0 0 32 32" version="1.1"
                             xmlns="http://www.w3.org/2000/svg">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier"><title>play</title>
                            <path
                                d="M5.92 24.096q0 1.088 0.928 1.728 0.512 0.288 1.088 0.288 0.448 0 0.896-0.224l16.16-8.064q0.48-0.256 0.8-0.736t0.288-1.088-0.288-1.056-0.8-0.736l-16.16-8.064q-0.448-0.224-0.896-0.224-0.544 0-1.088 0.288-0.928 0.608-0.928 1.728v16.16z"></path>
                          </g>
                        </svg>
                      </div>
                      <i class="animation"></i>
                    </button>
                  </div>
                </div>
  `;

// Inicializacion de la actividad

let boxSize = ref(0)
onMounted(() => {
  showInitialAlert()

  // Calcular tamaño de las cajas
  if (props.size[0] * props.size[1] < 5) {
    boxSize.value = 36
  } else if (props.size[0] * props.size[1] > 5 && props.size[0] * props.size[1] < 10) {
    boxSize.value = 24
  } else if (props.size[0] * props.size[1] > 10 && props.size[0] * props.size[1] < 26) {
    boxSize.value = 20
  } else if (props.size[0] * props.size[1] > 26) {
    boxSize.value = 12
  }
})

let currentAudio = ref(null);

const intro = (phase) => {

  let audio1Route = `${localHost}/audios/start/pattern/1.m4a`
  let audio2Route = `${localHost}/audios/start/pattern/2.m4a`
  let audio3Route = `${localHost}/audios/start/pattern/3.m4a`


  if (props.create_audio_1) {
    audio1Route = `${localHost}/audios/start/pattern/personalized/level_${props.level[0]}-${props.level[1]}/1.m4a`
  }
  if (props.create_audio_2) {
    audio2Route = `${localHost}/audios/start/pattern/personalized/level_${props.level[0]}-${props.level[1]}/2.m4a`
  }
  if (props.create_audio_3) {
    audio3Route = `${localHost}/audios/start/pattern/personalized/level_${props.level[0]}-${props.level[1]}/3.m4a`
  }
  if (phase === 1) {
    talk(false)
    talkCharacter(
        `${localHost}/images/characters/robot/normal.png`,
        `${localHost}/images/characters/robot/talk.gif`
    );
    showItemsPresentation(items, () => showHelp(props.show_help), props.fake_items, audio3Route, currentAudio)
    return
  }

  if (phase === 2) {
    talk(true)
    talkCharacter(
        `${localHost}/images/characters/robot/normal.png`,
        `${localHost}/images/characters/robot/talk.gif`
    );
    showHelp(props.show_help)

    return
  }

  if (phase === 3) {
    talk(false)
    return
  }

  if (phase === -1) {
    win()
    return;
  }
  talk(false)

  // Comienza a reproducir el audio inicial
  inTutorial.value = true
  let audio1 = playAudio(audio1Route);
  currentAudio.value = audio1;
  talkBool.value = true

  // Muestra el personaje hablando
  talkCharacter(
      `${localHost}/images/characters/robot/normal.png`,
      `${localHost}/images/characters/robot/talk.gif`
  );

  // Cuando el audio 1 termina, reproduce el audio 2
  let audio2 = new Audio(audio2Route);

  // SetOnEnded es una funcion que se encarga de ejecutar una funcion cuando el audio termina el primer parametro es
  // el audio y el segundo es la funcion a ejecutar
  setOnEnded(audio1, () => {
    if (props.show_help === 3) {
      talkBool.value = false;
      inTutorial.value = false;
      talkCharacter(
          `${localHost}/images/characters/robot/normal.png`,
          `${localHost}/images/characters/robot/talk.gif`
      );
      return;
    }

    audio2.play();
    currentAudio.value = audio2;
  });
  // setOnEnded(audio2, showItemsPresentation(items, showHelp));
  setOnEnded(audio2, () => {
    talkBool.value = false;
    showItemsPresentation(items, () => showHelp(props.show_help), props.fake_items, audio3Route, currentAudio);
  });
}

const generateAudios = (audioNumber) => {
  switch (audioNumber) {
    case 1:
      resolveAudio('¡Listos para la próxima etapa de nuestra aventura espacial! Preparen sus habilidades y adéntrense en lo desconocido. ¡Que comience la exploración!, ', '1', 'start/pattern', '0.9');
      break;
    case 2:
      resolveAudio('Observa que el cuadrado de la izquierda esta pintado con los colores. ', '2', 'start/pattern', '0.9');
      break;
    case 3:
      resolveAudio('Pinta de forma idéntica el cuadrado de la derecha utilizando tus pinceles de colores. ', '3', 'start/pattern', '0.9');
      break;
  }
}

// resolveAudio('¡Espectacular!', 9, 'successes/shorts', '0.9');

let showIcon = ref(false)


verifyAudiosNumber(3)

function verifyAudiosNumber(number) {

  // Verificacion de archivos perzonaliados
  if (props.create_audio_1) {
    verifyFileExistence(`${localHost}/audios/start/pattern/personalized/level_${props.level[0]}-${props.level[1]}/1.m4a`, function (exist) {
      if (exist) {
        console.log(`El archivo persoanlizado 1.m4a existe.`);
      } else {
        resolveAudio(props.create_audio_1, '1', `start/pattern/personalized/level_${props.level[0]}-${props.level[1]}`, '0.9');
        console.log(`El archivo persoanlizado 1.m4a no existe.`);
      }
    });
  }

  if (props.create_audio_2) {
    verifyFileExistence(`${localHost}/audios/start/pattern/personalized/level_${props.level[0]}-${props.level[1]}/2.m4a`, function (exist) {
      if (exist) {
        console.log(`El archivo persoanlizado 2.m4a existe.`);
      } else {
        resolveAudio(props.create_audio_2, '2', `start/pattern/personalized/level_${props.level[0]}-${props.level[1]}`, '0.9');
        console.log(`El archivo persoanlizado 2.m4a no existe.`);
      }
    });
  }

  if (props.create_audio_3) {
    verifyFileExistence(`${localHost}/audios/start/pattern/personalized/level_${props.level[0]}-${props.level[1]}/3.m4a`, function (exist) {
      if (exist) {
        console.log(`El archivo persoanlizado 3.m4a existe.`);
      } else {
        resolveAudio(props.create_audio_3, '3', `start/pattern/personalized/level_${props.level[0]}-${props.level[1]}`, '0.9');
        console.log(`El archivo persoanlizado 3.m4a no existe.`);
      }
    });
  }

  // Verificacion de archivos generales
  for (let i = 1; i <= number; i++) {
    verifyFileExistence(`${localHost}/audios/start/pattern/${i}.m4a`, function (exist) {
      if (exist) {
        console.log(`El archivo ${i}.m4a existe.`);
      } else {
        generateAudios(i);
        console.log(`El archivo ${i}.m4a no existe.`);
      }
    });
  }
}

const playAudioAndAnimateCharacter = (audioPath, characterImg, characterImgTalk) => {
  let audio = new Audio(audioPath);
  audio.play();
  currentAudio.value = null;
  talkCharacter(characterImg, characterImgTalk);
  return audio;
};

const animateElement = (elementId, animationClass, delay) => {
  setTimeout(() => {
    document.getElementById(elementId).classList.add(animationClass);
  }, delay);
};

const removeAnimationFromElement = (elementId, animationClass, delay) => {
  setTimeout(() => {
    document.getElementById(elementId).classList.remove(animationClass);
  }, delay);
};

// resolveAudio('Colorea... Colorea.', 'colorea',`start/pattern/help`, '0.9');
const showHelp = (showHelp) => {

  if (talkBool.value) {
    return;
  }

  let indication1 = ""

  if (showHelp === 1) {
    indication1 = playAudioAndAnimateCharacter(`${localHost}/audios/start/pattern/help/colorea.m4a`, `${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`);
  } else if (showHelp === 2) {
    return;
  } else {
    indication1 = playAudioAndAnimateCharacter(`${localHost}/audios/start/pattern/help/observa-colorea.m4a`, `${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`);
  }

  talkBool.value = true;

  indication1.onended = function () {
    talkBool.value = false;
    talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`);
    inTutorial.value = false;
  };

  if (showHelp === 1) {
    animateElement('fig1', 'opacity-20', 0);
    removeAnimationFromElement('fig1', 'opacity-20', 2000);
    document.getElementById('arrow-right').style.fill = 'green';
    setTimeout(function () {
      document.getElementById('arrow-right').style.fill = '#9ca3af';
    }, 2000)
    return;
  }

  // animateElement('fig1', 'animate-pulse', 0);
  animateElement('arrow', 'scale-50', 0);
  animateElement('fig2', 'opacity-20', 0);

  // removeAnimationFromElement('fig1', 'animate-pulse', 2000);
  removeAnimationFromElement('arrow', 'scale-50', 2000);
  removeAnimationFromElement('fig2', 'opacity-20', 2000);

  // animateElement('fig2', 'animate-pulse', 2000);
  animateElement('fig1', 'opacity-20', 2000);
  setTimeout(function () {
    document.getElementById('arrow-right').style.fill = 'green';
  }, 2000)


  // removeAnimationFromElement('fig2', 'animate-pulse', 4000);
  removeAnimationFromElement('fig1', 'opacity-20', 4000);
  setTimeout(() => {
    document.getElementById('arrow-right').style.fill = '#9ca3af';
  }, 4000);
};

const prepareActivity = () => {
  let orderArray = []
  for (let i = 0; i <= props.fill_sample.length - 1; i++) {
    let order = props.fill_sample[i] - 1
    orderArray.push(order)
    if (orderArray[i] === -1) {
      continue
    }
    let item = items[orderArray[i]]
    localStorage.setItem('itemSelected', JSON.stringify(item))
    paintItem(`sample-${i + 1}`, items)

    localStorage.setItem('itemSelected', JSON.stringify(null))
  }

  if (props.rotate) {
    document.getElementById('sample-img').classList.add('rotate-45', 'scale-75')

    document.getElementById('activity-img').classList.add('rotate-45', 'scale-75')
  }
}

let boxes = ref([])
let step = ref(0)

const paintBox = (id) => {
  if (levelComplete.value || inTutorial.value) {
    playAudio(`${localHost}/audios/effects/wood.wav`)
    return
  }

  let itemSelected = getSelectItem()

  if (itemSelected.type === types.eraser) {
    errorPaint(id)
    return
  }

  if (itemSelected.content === items[(props.fill_sample[id - 1]) - 1].content) {
    paintItem(id, items)

    let bubble = new Audio()
    bubble.src = `${localHost}/audios/effects/soapBubble.wav`
    bubble.play()

    // playSuccessShortRandom()
    showCheckIcon()

    document.getElementById(id).classList.remove('animate-pulse', 'scale-95')

    boxes.value[id - 1] = true

    for (let i = 0; i < props.size[0] * props.size[1]; i++) {
      if (boxes.value[i] === true) {
        step.value++
      }
    }

    if (step.value === props.size[0] * props.size[1]) {
      win()
    }
    step.value = 0

  } else {
    paintItem(id, items)

    showErrorIcon()

    let bubble = new Audio()
    bubble.src = `${localHost}/audios/effects/wood.wav`
    bubble.play()

    boxes.value[id - 1] = false

    if (itemSelected.type === types.color) {
      let element = document.getElementById(id);
      let span = document.createElement('span');
      span.innerText = 'X';
      if (props.rotate) {
        span.classList.add('-rotate-45')
      }
      element.appendChild(span);
    } else if (itemSelected.type === types.letter || itemSelected.type === types.number) {
      let element = document.getElementById(id);
      element.classList.add('text-red-500')
    }

    document.getElementById(id).classList.add('animate-pulse', 'scale-95', 'zoom-box')

    setTimeout(function () {
      document.getElementById(id).classList.remove('zoom-box')
    }, 3000)
  }
}

const win = () => {

  levelComplete.value = true
  let progressBar = document.getElementById('progressBar')

  let animated = document.getElementById('animatedRocket')

  progressBar.classList.add('hidden')
  animated.classList.remove('hidden')

  setTimeout(function () {
    let winView = document.getElementById('winView')

    winView.classList.remove('hidden')

    setTimeout(function () {
      winView.classList.replace('opacity-0', 'opacity-100')
    }, 500)

    setTimeout(function () {
      progressBar.classList.remove('hidden')
      animated.classList.add('hidden')
    }, 1000)

    setTimeout(function () {
      winView.classList.replace('opacity-100', 'opacity-0')
    }, 3000)

    setTimeout(function () {
      winView.classList.add('hidden')
    }, 3500)
    setTimeout(function () {
      document.getElementById('nextLevelButton').classList.remove('hidden')
    }, 2000)
  }, 2600)
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

const coinChangerClose = (event) => {
  selectedCoinChanger.value = event;
  selectedLevelVortex.value = event;
  coinChangerVortexRef.value = event;
};

const updateCoinsFunction = (event) => {
  updateCoins.value = event;
  console.log("updatecoins ejecutandose");
};

</script>
<template>
  <!--  <div id="loadStyles" :class="`h-36 w-36 h-24 w-24 h-20 w-20 grid grid-cols-3 grid-cols-4 grid-cols-5 hidden-->
  <!--    grid-cols-6 grid-cols-7 grid-cols-8 grid-cols-9 grid-cols-10 grid-cols-11 grid-cols-12-->
  <!--     ${items[0].content} ${items[1].content} ${items[2].content} ${items[3].content}`-->

  <!--"></div>-->

  <!--  <button @click="handleButtonClick">dada</button>-->

  <BackgroundActivities/>

  <WinView id="winView" class="hidden opacity-0 duration-300"/>
  <CoinChangerVortex v-if="coinChangerVortexRef || selectedLevelVortex" :type="vortexType" :selected="selectedLevelVortex"/>

  <div class="flex flex-col min-h-screen">
    <div class="mx-auto flex-1 container flex justify-center">
      <div class="flex  p-6 w-full gap-5 rounded-md">
        <div class="w-[16%] ">
          <HelpCharacter @click="showHelp()"
                         :image="`${localHost}/images/characters/robot/normal.png`"
                         :image_2="`${localHost}/images/characters/robot/talk.gif`"
          />
        </div>
        <div id="dat" class="w-[68%] bg-red-200 p-5 grid grid-rows-4 relative">
          <div v-if="selectedCoinChanger" class="w-full h-full absolute top-0 left-0 z-30">
            <CoinChanger :storageBronze="'bronzeCoins'" :storageSilver="'silverCoins'" :storageGold="'goldCoins'" :goldenExchange="3" :silverExchange="3" :guide="true" @coinChangerClose="coinChangerClose" @updateCoins="updateCoinsFunction"/>
          </div>
          <ProgressBar :planet_1="`${localHost}/images/planets/tierra.svg`"
                       :planet_2="`${localHost}/images/planets/rojo.svg`"
                       :rocket="`${localHost}/images/rockets/1.svg`"
                       :level="props.level"
          />
          <div class="row-span-3 flex justify-center items-center">
            <div>
              <div class="my-6 flex justify-center gap-5">

                <div id="fig1" class="duration-300">
                  <div class="flex justify-center">
                    <div>
                      <div class="flex justify-center h-12">
                        <img :src="`${localHost}/images/characters/robot/eyes.png`" alt="">
                      </div>
                      <div class="font-bold text-3xl">OBSERVA</div>
                    </div>
                  </div>

                  <div id="sample-img" :class="`grid grid-cols-${props.size[0]} mt-5`">
                    <div :id="`sample-${i}`"
                         v-for="i in (props.size[0] * props.size[1])" :key="i"
                         :class="`bg-white border border-black hover:opacity-75
                                          flex justify-center items-center font-bold text-6xl select-none h-${boxSize} w-${boxSize}`">
                    </div>
                  </div>
                </div>

                <div id="arrow" class="flex items-center translate-y-[50px] duration-300">
                  <IconArrowRight/>
                </div>

                <div id="fig2" class="duration-300">
                  <div class="flex justify-center">
                    <div>
                      <div class="flex justify-center h-12">
                        <IconPaintBrush hex="#804000"/>
                      </div>
                      <div class="font-bold text-3xl">COLOREA</div>
                    </div>
                  </div>

                  <div id="activity-img" :class="`grid grid-cols-${props.size[0]} mt-5`">
                    <div :id="i" @click="paintBox(i)"
                         v-for="i in (props.size[0] * props.size[1])"
                         :key="i"
                         :class="`bg-white border border-black hover:opacity-75 flex justify-center cursor-cell
                         items-center font-bold text-6xl select-none h-${boxSize} w-${boxSize}`">
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
            :updateCoins="updateCoins"
            @closeAnimation="coinChangerVortexActivate"
            @openAnimation="coinChangerVortexActivate"
            @vortexType="vortexTypeFunction"
            @selected="selectedLevelVortexFunction"
            @selectedCoinChanger="selectedCoinChangerFunction"
            :currentAudio="currentAudio"
          />
        </div>
      </div>
    </div>
  </div>
</template>
<style>
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
