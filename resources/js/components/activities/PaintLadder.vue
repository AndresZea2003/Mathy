<script setup>
import HelpCharacter from "../sections/HelpCharacter.vue";
import ItemPalette from "../sections/ItemPalette.vue";
import ProgressBar from "../sections/ProgressBar.vue";
import WinView from "../templates/WinView.vue";
import IntroLevel from "../templates/IntroLevel/IntroLevel.vue";
import {
  types,
  localHost,
  sizes,
  getSelectItem,
  talk,
  talkCharacter,
  paintItem,
  errorPaint,
  // updateCoins,
  getCoins,
  playAudio,
  setOnEnded,
  showItemsPresentation,
  showCheckIcon,
  playSuccessShortRandom,
  showErrorIcon,
  cleanBox,
  winCoinCheckLevel
} from '../../use';
import {onMounted, ref, onUnmounted} from "vue";
import IconArrowRight from "../icons/IconArrowRight.vue"
import Swal from "sweetalert2";
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
  order_to_resolve: {type: Array},
  select_cols: {type: Array},
  fake_items: {type: Array},
  show_ids: {type: Boolean},
})

const items = props.items
const talkBool = ref(false)
const levelComplete = ref(false)
const inTutorial = ref(false)
let currentAudio = ref(null);
const coinChangerVortexRef = ref(false);
const vortexType = ref("");
const selectedLevelVortex = ref(false);
const selectedCoinChanger = ref(false);
const coinChangerCloseUser = ref(false);
const updateCoins = ref(false);
const winCoinRef = ref(false);//Creado para determinar si el nivel se reclaman monedas y que tipo de moneda
const winCoinViewAnimation = ref(false);//Creado para mostrar animacion si se cumplen requisitos
const backgroundSelectedRef = ref();//Creado para controlar el emit de fondo para la intro
const introActivated = ref(true); //Controla cuando se abre y se cierra el componente

//Establecemos la ubicacion actual del software en el storage
localStorage.setItem('currentLocation', `${localHost}/level${props.level[0]}/${props.level[1]}`);

const showInitialAlert = () => {
  Swal.fire({
    title: `Actividad ${props.level[1]}`,
    text: 'Descripcion para el nivel 1',
    icon: 'warning',
    confirmButtonText: 'Comenzar'
  }).then((result) => {
    intro(3);
    // prepareActivity()
  });
}

// Inicializacion de la actividad

let boxSize = ref(0)
let arrowSize = ref(0)

const updateBoxSize = () => {
  if (window.innerWidth <= 1024) {
    // Para pantallas menores a 1024px
    boxSize.value = 48
    arrowSize.value = 50;
    if (props.size[0] * props.size[1] < 31) {
      arrowSize.value = arrowSize.value + 10
    } else if (props.size[0] * props.size[1] > 31 && props.size[0] * props.size[1] < 65) {
      arrowSize.value = arrowSize.value - 24
      boxSize.value = boxSize.value - 16
    } else if (props.size[0] * props.size[1] > 65) {
      arrowSize.value = arrowSize.value - 28
      boxSize.value = boxSize.value - 24
    }
  } else if (window.innerWidth <= 1440 && window.innerWidth > 1024) {
    // Para pantallas mayores a 1024px y menor igual a 1440px
    boxSize.value = 60
    arrowSize.value = 50;
    if (props.size[0] * props.size[1] < 31) {
      arrowSize.value = arrowSize.value + 10
    } else if (props.size[0] * props.size[1] > 31 && props.size[0] * props.size[1] < 65) {
      arrowSize.value = arrowSize.value - 10
      boxSize.value = boxSize.value - 18
    } else if (props.size[0] * props.size[1] > 65) {
      arrowSize.value = arrowSize.value - 30
      boxSize.value = boxSize.value - 24
    }
  } else {
    // Para pantallas mayores a 1440px
    boxSize.value = 70;
    arrowSize.value = 70;
    if (props.size[0] * props.size[1] < 31) {
      arrowSize.value = arrowSize.value + 40
    } else if (props.size[0] * props.size[1] > 31 && props.size[0] * props.size[1] < 65) {
      arrowSize.value = arrowSize.value + 20
      boxSize.value = boxSize.value - 20
    } else if (props.size[0] * props.size[1] > 65) {
      arrowSize.value = arrowSize.value - 30
      boxSize.value = boxSize.value - 30
    }
  }
}
let totalActivities = ref(0)
onMounted(async () => {
  winCoinRef.value = winCoinCheckLevel(props.level[0], props.level[1]); //Determinamos si el componente da una moneda o no.
  await axios.get('/activityCount/' + props.level[0])
      .then(response => totalActivities.value = response.data);
  updateBoxSize();
  window.addEventListener('resize', updateBoxSize);
  if (props.show_ids) {

    const orderArray = getOrderArray();
    for (let i = 0; i <= orderArray.length - 1; i++) {
      if (orderArray[i] === -1) {
        continue
      }
      let item = items[orderArray[i]]
      localStorage.setItem('itemSelected', JSON.stringify(item))

      paintItem(`sample-${i + 1}`, items)
      paintItem(`${i + 1}`, items)

      localStorage.setItem('itemSelected', null)
    }


    props.solution.forEach(id => {
      const box = document.getElementById(id);
      if (box) {
        box.classList.remove('bg-white', items[0].content);
        box.classList.add('bg-red-600', 'text-xl'); // Asume que 'bg-red-600' es la clase para el color rojo
        box.innerText = id;
      }
    });

    return
  }
  showInitialAlert();
})

onUnmounted(() => {
  window.removeEventListener('resize', updateBoxSize);
})

const intro = (phase) => {

  let audio1Route = `${localHost}/audios/start/linePattern/1.m4a`
  let audio2Route = `${localHost}/audios/start/linePattern/2.m4a`
  let audio3Route = `${localHost}/audios/start/linePattern/3.m4a`
  let audio4Route = `${localHost}/audios/start/linePattern/4.m4a`

  console.log(audio2Route)

  if (props.type === 'number') {
    audio1Route = `${localHost}/audios/start/linePattern/numbers/1.m4a`
    audio2Route = `${localHost}/audios/start/linePattern/numbers/2.m4a`
    audio3Route = `${localHost}/audios/start/linePattern/numbers/3.m4a`
    audio4Route = `${localHost}/audios/start/linePattern/numbers/4.m4a`
  } else if (props.type === 'figures') {
    audio1Route = `${localHost}/audios/start/linePattern/figures/1.m4a`
    audio2Route = `${localHost}/audios/start/linePattern/figures/2.m4a`
    audio3Route = `${localHost}/audios/start/linePattern/figures/3.m4a`
    audio4Route = `${localHost}/audios/start/linePattern/figures/4.m4a`
  } else if (props.type === 'letters') {
    audio1Route = `${localHost}/audios/start/linePattern/letters/1.m4a`
    audio2Route = `${localHost}/audios/start/linePattern/letters/2.m4a`
    audio3Route = `${localHost}/audios/start/linePattern/letters/3.m4a`
    audio4Route = `${localHost}/audios/start/linePattern/letters/4.m4a`
  } else if (props.type === 'colors') {
    audio1Route = `${localHost}/audios/start/linePattern/colors/1.m4a`
    audio2Route = `${localHost}/audios/start/linePattern/colors/2.m4a`
    audio3Route = `${localHost}/audios/start/linePattern/colors/3.m4a`
    audio4Route = `${localHost}/audios/start/linePattern/colors/4.m4a`
  } else if (props.type === 'animals') {
    audio1Route = `${localHost}/audios/start/linePattern/animals/1.m4a`
    audio2Route = `${localHost}/audios/start/linePattern/animals/2.m4a`
    audio3Route = `${localHost}/audios/start/linePattern/animals/3.m4a`
    audio4Route = `${localHost}/audios/start/linePattern/animals/4.m4a`
  } else if (props.type === 'fruits') {
    audio1Route = `${localHost}/audios/start/linePattern/fruits/1.m4a`
    audio2Route = `${localHost}/audios/start/linePattern/fruits/2.m4a`
    audio3Route = `${localHost}/audios/start/linePattern/fruits/3.m4a`
    audio4Route = `${localHost}/audios/start/linePattern/fruits/4.m4a`
  }

  if (props.create_audio_1) {
    audio1Route = `${localHost}/audios/start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}/1.m4a`
  }
  if (props.create_audio_2) {
    audio2Route = `${localHost}/audios/start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}/2.m4a`
  }
  if (props.create_audio_3) {
    audio3Route = `${localHost}/audios/start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}/3.m4a`
  }
  if (props.create_audio_4) {
    audio4Route = `${localHost}/audios/start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}/4.m4a`
  }

  if (phase === 1) {
    inTutorial.value = true
    // showBlackScreen()
    // showIntroductionHelp()
    return;
  }

  if (phase === 2) {
    // prepareActivity()
    talkBool.value = true
    talkCharacter(
        `${localHost}/images/characters/robot/normal.png`,
        `${localHost}/images/characters/robot/talk.gif`
    );
    // showBlackScreen()
    let audio2 = playAudio(audio2Route)
    setOnEnded(audio2, () => {
      showItemsPresentation(items, removeBlackScreen, props.fake_items, audio4Route, currentAudio);
    });
    return;
  }

  if (phase === 3) {
    prepare()
    return;
  }

  if (phase === -1) {
    // win()
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
    audio2.play();
    currentAudio.value = audio2;
    // showBlackScreen();
  });
  // setOnEnded(audio2, showItemsPresentation(items, showHelp));
  setOnEnded(audio2, () => {
    talkBool.value = false;
    showItemsPresentation(items, showIntroductionHelp, props.fake_items, audio3Route, currentAudio);
  });
}

const showIntroductionHelp = () => {

}

const prepare = () => {
  const orderArray = getOrderArray();
  const ladderIds = getLadderIds();
  const time = 2000; // Declarado como constante

  const ladderArray = convertInArray(ladderIds, props.size[1], props.size[0]);
  const rowsAndCols = getRowsAndCols(ladderArray);

  const eraser = {
    "name": "Borrador",
    "type": "ERASER",
    "content": '/images/items/tools/eraser.png',
    "size": "BIG",
    "group": "Borrador"
  }

  prepareItems(orderArray, rowsAndCols, eraser);

  props.select_cols.forEach(col => {
    rowsAndCols[1][col - 1].forEach(index => {
      boxes.value[index - 1] = false;
    });
  });

  console.log('Boxes', boxes.value);
}

const getOrderArray = () => {
  const orderArray = [];
  for (let i = 0; i <= props.fill_sample.length - 1; i++) {
    let order = props.fill_sample[i] - 1
    orderArray.push(order)
  }
  return orderArray;
}

const getLadderIds = () => {
  const ladderIds = [];
  for (let i = 1; i <= (props.size[1] * props.size[0]); i++) {
    ladderIds.push(i)
  }
  return ladderIds;
}

function convertInArray(ladderIds, rows, cols) {
  let array = [];
  for (let i = 0; i < rows; i++) {
    let row = [];
    for (let j = 0; j < cols; j++) {
      row.push(ladderIds[i * cols + j]);
    }
    array.push(row);
  }
  return array;
}


function getRowsAndCols(ladderIds) {

  let getRows = ladderIds.length;
  let getCol = ladderIds[0].length;

  let rows = []
  let cols = []

  for (let i = 0; i < getRows; i++) {
    rows.push(ladderIds[i])
  }

  for (let j = 0; j < getCol; j++) {
    let col = [];
    for (let i = 0; i < getRows; i++) {
      col.push(ladderIds[i][j]);
    }
    cols.push(col)
  }

  return [rows, cols]
}

const prepareItems = (orderArray, rowsAndCols, eraser) => {
  for (let i = 0; i <= orderArray.length - 1; i++) {
    if (orderArray[i] === -1) {
      continue
    }
    let item = items[orderArray[i]]
    localStorage.setItem('itemSelected', JSON.stringify(item))

    paintItem(`sample-${i + 1}`, items)
    paintItem(`${i + 1}`, items)

    prepareColumns(rowsAndCols, i);

    localStorage.setItem('itemSelected', null)
  }
}

let focusCols = ref([])
const prepareColumns = (rowsAndCols, i) => {
  for (let colIndex = 0; colIndex <= props.select_cols.length - 1; colIndex++) {
    focusCols.value.push(rowsAndCols[1][props.select_cols[colIndex] - 1])
    for (let i = 0; i <= rowsAndCols[1][props.select_cols[colIndex] - 1].length - 1; i++) {
      try {
        prepareCell(rowsAndCols, colIndex, i);
      } catch (error) {
        console.error("Error al preparar la celda: ", error);
      }
    }
  }
}

const prepareCell = (rowsAndCols, colIndex, i) => {
  const cell = document.getElementById(rowsAndCols[1][props.select_cols[colIndex] - 1][i]);
  cell.classList.remove('bg-white')
  cell.classList.replace(getSelectItem().content, 'bg-white')
  cell.innerText = null
  cell.classList.add('bg-gray-200', 'border-dashed')
}

let boxes = ref([])
let step = ref(0)
let currentBgClass = 'bg-gray-200'

const paintBox = (id) => {
  if (levelComplete.value) {
    playAudio(`${localHost}/audios/effects/wood.wav`)
    return
  }

  let itemSelected = getSelectItem()

  if (itemSelected.type === types.eraser) {
    boxes.value[id - 1] = false

    if (document.getElementById(id).classList.contains('border-dashed')) {
      cleanBox(document.getElementById(id), items);
      document.getElementById(id).classList.add('bg-gray-200')
      document.getElementById(id).classList.remove('animate-pulse', 'scale-95', 'zoom-box')

      playAudio(`${localHost}/audios/effects/bookSlide.mp3`)
    }

    errorPaint(id)
    validateWin()
    return

  }

  const assertPaint = () => {
    document.getElementById(id).classList.remove('bg-gray-200')
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
  }

  const errorAssertPaint = () => {
    console.log('error')
    paintItem(id, items)

    showErrorIcon()

    let bubble = new Audio()
    bubble.src = `${localHost}/audios/effects/wood.wav`
    bubble.play()

    if (props.solution.includes(id)) {
      boxes.value[id - 1] = false
    } else {
      boxes.value[id - 1] = true
    }

    if (itemSelected.type === types.color) {
      let element = document.getElementById(id);
      let span = document.createElement('span');
      span.classList.add('font-bold', 'text-2xl', 'absolute',)
      span.innerText = 'X';
      if (props.rotate) {
        span.classList.add('-rotate-45')
      }
      element.classList.remove(currentBgClass)
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

  if (props.solution.includes(id) && itemSelected.content === items[0].content) {
    assertPaint()
  } else if (document.getElementById(id).classList.contains('border-dashed')) {
    errorAssertPaint()
  } else {
    playAudio(`${localHost}/audios/effects/wood.wav`)

    document.getElementById(id).classList.add('scale-50')

    setTimeout(function () {
      document.getElementById(id).classList.remove('scale-50')
    }, 1000)
  }

  step.value = 0

  validateWin()

}

const validateWin = () => {
  const winPositions = props.solution;
  const isWinConditionMet = boxes.value.every((value, index) =>
      winPositions.includes(index + 1) ? value : !value
  );

  if (isWinConditionMet) {
    win();
  }
}

// const win = () => {
//
//   levelComplete.value = true
//   let progressBar = document.getElementById('progressBar')
//
//   let animated = document.getElementById('animatedRocket')
//
//   progressBar.classList.add('hidden')
//   animated.classList.remove('hidden')
//
//   setTimeout(function () {
//     let winView = document.getElementById('winView')
//
//     winView.classList.remove('hidden')
//
//     setTimeout(function () {
//       winView.classList.replace('opacity-0', 'opacity-100')
//     }, 500)
//
//     setTimeout(function () {
//       progressBar.classList.remove('hidden')
//       animated.classList.add('hidden')
//     }, 1000)
//
//     setTimeout(function () {
//       winView.classList.replace('opacity-100', 'opacity-0')
//     }, 3000)
//
//     setTimeout(function () {
//       winView.classList.add('hidden')
//     }, 3500)
//     setTimeout(function () {
//       document.getElementById('nextLevelButton').classList.remove('hidden')
//     }, 2000)
//   }, 2600)
// }

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


//Funcion que toma el emit del fondo para la animacion de intro.
const backgroundSelecteFunction = (event) => {
  backgroundSelectedRef.value = event;
};

//Desactivar la intro de nivel
setTimeout(() => {
  introActivated.value = false;
}, 4000);


</script>
<template>
<!--  <div id="loadStyles" :class="`h-36 w-36 h-24 w-24 h-20 w-20 grid grid-cols-3 grid-cols-4 grid-cols-5 hidden w-10 h-10 w-9 h-9 w-8 h-8-->
<!--    grid-cols-6 grid-cols-7 grid-cols-8 grid-cols-9 grid-cols-10 grid-cols-11 grid-cols-12-->
<!--     ${items[0].content} ${items[1].content} ${items[2].content} ${items[3].content}`-->

<!--"></div>-->
  <IntroLevel v-if="introActivated" :background="backgroundSelectedRef" :level="props.level[1]"/>
  <BackgroundActivities @backgroundSelected="backgroundSelecteFunction"/>

  <WinView id="winView" class="hidden opacity-0 duration-300"/>
  <CoinChangerVortex v-if="coinChangerVortexRef || selectedLevelVortex" :type="vortexType" :selected="selectedLevelVortex"/>
  <WinCoin v-if="winCoinViewAnimation" :type_coin="winCoinRef" @updateCoins="updateCoinsFunction"/>

  <div class="flex flex-col min-h-screen">
    <div class="mx-auto flex-1 container flex justify-center">
      <div class="flex p-6 w-full gap-5 rounded-md">
        <div class="w-[16%] ">
          <HelpCharacter @click="showHelp()"
                         :image="`${localHost}/images/characters/robot/normal.png`"
                         :image_2="`${localHost}/images/characters/robot/talk.gif`"
          />
        </div>
        <div id="board" class="w-[68%] bg-red-200 p-5 grid grid-rows-4 relative">
          <div v-if="selectedCoinChanger" class="w-full h-full absolute top-0 left-0 z-30" >
            <CoinChanger :storageBronze="'bronzeCoins'" :storageSilver="'silverCoins'" :storageGold="'goldCoins'" :goldenExchange="3" :silverExchange="3" :guide="true" @coinChangerClose="coinChangerClose" @updateCoins="updateCoinsFunction"/>
          </div>
          <ProgressBar v-if="showProgressBar" :planet_1="`${localHost}/images/planets/tierra.svg`"
                       :planet_2="`${localHost}/images/planets/rojo.svg`"
                       :rocket="`${localHost}/images/rockets/1.svg`"
                       :level="props.level"
          />

          <div class="row-span-3 flex justify-center items-center">
            <div>
              <div class="my-6 flex justify-center items-center gap-5 ">

                <div id="fig1"
                     :class="`grid grid-cols-${props.size[0]} gap-x-2 flex items-center justify-center duration-300`">
                  <div :id="`sample-${i}`" @click="validateOrder(i)"
                       v-for="i in (props.size[0] * props.size[1])" :key="i"
                       :class="`bg-white border border-black hover:opacity-75
                                          flex justify-center items-center font-bold text-6xl select-none duration-300`"
                       :style="`width: ${boxSize}px; height: ${boxSize}px;`">
                  </div>
                </div>

                <div id="arrow" class="flex items-center duration-300"
                     :style="`width: ${arrowSize}px; height: ${arrowSize}px;`">
                  <IconArrowRight/>
                </div>

                <div id="fig2"
                     :class="`grid grid-cols-${props.size[0]} gap-x-2 flex items-center justify-center duration-300`">
                  <div :id="i" @click="paintBox(i)" v-for="i in (props.size[0] * props.size[1])"
                       :key="i"
                       :class="`bg-white border border-black hover:opacity-75 cursor-cell
                                          flex justify-center items-center font-bold text-6xl select-none duration-300`"
                       :style="`width: ${boxSize}px; height: ${boxSize}px;`">
                    <div v-if="props.show_ids" class="text-2xl">{{ i }}</div>
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
