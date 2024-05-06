<script setup>
import "../../sections/HelpCharacter.vue";
import HelpCharacter from "../../sections/HelpCharacter.vue";
import ItemPalette from "../../sections/ItemPalette.vue";
import ProgressBar from "../../sections/ProgressBar.vue";
import WinView from "../../templates/WinView.vue";
import {
  types,
  localHost,
  getSelectItem,
  talk,
  talkCharacter,
  setOnEnded,
  showErrorIcon, instruccionesTest, instrucciones, playAudio
} from '../../../use';
import {onMounted, ref} from "vue";
import {defineProps} from 'vue';
import BackgroundActivities from "../../background/BackgroundActivities.vue";

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
  phase: {type: Number}
})

const items = props.items
const talkBool = ref(false)
const levelComplete = ref(false)


// Inicializacion de la actividad


// Función para pausar todos los audios

let pixels = ref([]);
let tests = ref([]);

for (let i = 0; i < 40 * 60; i++) {
  pixels.value.push({id: i, color: 'blue'});
}

for (let i = 0; i < 40 * 60; i++) {
  tests.value.push({id: i, color: 'red'});
}


let isMouseDown = ref(false);

// const paintPixel = (pixel) => {
//   console.log(tests.value)
//
//   if (isMouseDown.value) {
//     pixel.color = 'black'; // Cambia esto al color que quieras
//   }
// };

let calibrateSound = ref(false);
// const paintPixel = (pixel) => {
//   if (isMouseDown.value) {
//     if (!calibrateSound.value) {
//       let paintSound = playAudio(`/audios/effects/sprayPaint.mp3`)
//       calibrateSound.value = true
//       setTimeout(function () {
//         calibrateSound.value = false
//       },250)
//       // setOnEnded(paintSound, () => {
//       //   calibrateSound.value = false
//       // })
//     }
//
//     let itemSelected = getSelectItem()
//
//
//     // Pinta el pixel actual
//     pixel.color = itemSelected.hex; // Cambia esto al color que quieras
//
//     // // Calcula los índices de los píxeles vecinos
//     // let currentIndex = pixels.value.indexOf(pixel);
//     // let indices = [];
//     //
//     // for (let i = -4; i <= 4; i++) {
//     //   for (let j = -4; j <= 4; j++) {
//     //     let index = currentIndex + i * 60 + j;
//     //     indices.push(index);
//     //   }
//     // }
//     //
//     // // Pinta los píxeles vecinos si existen
//     // indices.forEach(index => {
//     //   if (index >= 0 && index < pixels.value.length) {
//     //     pixels.value[index].color = 'black';
//     //   }
//     // });
//   }
// };

const paintPixel = (pixel) => {
  if (!isMouseDown.value) {
    return;
  }

  playPaintSound();

  let itemSelected = getSelectItem();
  paintCurrentPixel(pixel, itemSelected.hex);
};

const playPaintSound = () => {
  if (calibrateSound.value) {
    return;
  }

  let paintSound = playAudio(`/audios/effects/sprayPaint.mp3`);
  calibrateSound.value = true;

  setTimeout(() => {
    calibrateSound.value = false;
  }, 250);
};

const paintCurrentPixel = (pixel, color) => {
  pixel.color = color;
};

const pintarDibujo = (dibujo) => {
  for (let i = 0; i < dibujo.length; i++) {
    for (let j = 0; j < dibujo[i].length; j++) {
      // Calcula el índice del píxel central
      let centerIndex = i * 60 + j;

      // Calcula los índices de los píxeles en el cuadrado de 9x9
      let indices = [];
      for (let di = -4; di <= 4; di++) {
        for (let dj = -4; dj <= 4; dj++) {
          let index = centerIndex + di * 60 + dj;
          indices.push(index);
        }
      }

      // Pinta los píxeles en el cuadrado de 9x9
      indices.forEach(index => {
        if (index >= 0 && index < pixels.value.length) {
          pixels.value[index].color = dibujo[i][j];
        }
      });
    }
  }
};


// pintarDibujo(dibujo);

let cuadrantes = [];
let numColumns = 60;
//
for (let i = 0; i < numColumns; i += 3) {
  for (let j = 0; j < numColumns; j += 3) {
    let cuadrante = [
      i * numColumns + j,
      i * numColumns + j + 1,
      i * numColumns + j + 2,
      (i + 1) * numColumns + j,
      (i + 1) * numColumns + j + 1,
      (i + 1) * numColumns + j + 2,
      (i + 2) * numColumns + j,
      (i + 2) * numColumns + j + 1,
      (i + 2) * numColumns + j + 2
    ];
    cuadrantes.push(cuadrante);
  }
}
//
// // Asignar el color azul a los primeros cuatro cuadrantes
// for (let i = 0; i < 4; i++) {
//   cuadrantes[i].forEach(index => {
//     if (index >= 0 && index < pixels.value.length) {
//       pixels.value[index].color = 'blue';
//     }
//   });
// }

const pintarDibujoPorCuadrantes = (instrucciones, preview) => {
  instrucciones.forEach(instruccion => {
    // Calcula las coordenadas del cuadrante
    let cx = instruccion.x - 1;
    let cy = instruccion.y - 1;

    // Calcula el índice del cuadrante
    let cuadranteIndex = cy * (numColumns / 3) + cx;

    // Obtiene el cuadrante
    let cuadrante = cuadrantes[cuadranteIndex];

    // Pinta todos los píxeles en el cuadrante
    if (cuadrante) {
      cuadrante.forEach(index => {
        if (index >= 0 && index < pixels.value.length) {
          if (preview === true) {
            tests.value[index].color = instruccion.color;
          } else {
            pixels.value[index].color = instruccion.color;
          }

        }
      });
    } else {
      console.error(`Cuadrante at index ${cuadranteIndex} does not exist.`);
    }
  });
};


// let instrucciones = [];
//
// for (let i = 1; i <= 11; i++) {
//   for (let j = 1; j <= 13; j++) {
//     instrucciones.push({ x: j, y: i, color: 'gray' });
//   }
// }

pintarDibujoPorCuadrantes(instruccionesTest, true);
pintarDibujoPorCuadrantes(instrucciones, false);


const handleMouseDown = () => {
  isMouseDown.value = true;
};

const handleMouseUp = () => {
  isMouseDown.value = false;
};

const paint = (id) => {
  if (!isMouseDown.value) {
    return;
  }
  let itemSelected = getSelectItem()
  console.log('itemSelected', itemSelected)
  let pixel = document.getElementById(id)
  pixel.style.backgroundColor = itemSelected.hex
}

// pintar id de caja 1-2 y 5-6

const paintRow = (rowNumber, item) => {

  console.log('rowNumber', rowNumber)
  isMouseDown.value = true;

  for (let i = 1; i <= 9; i++) {
    let id = `caja${rowNumber}-${i}`;
    console.log('id', id)
    localStorage.setItem('itemSelected', JSON.stringify(items[item]))
    paint(id);
  }
  isMouseDown.value = false;

};

// setTimeout(function () {
//   // paintRow(15,3)
//
//   // Fila 1
//   paintRow(13,3)
//   paintRow(21,3)
//
//   // Fila 2
//   paintRow(24,3)
//   paintRow(25,3)
//   paintRow(31,3)
//   paintRow(32,3)
//
//   // Fila 3
//   paintRow(35,3)
//   paintRow(36,2)
//   paintRow(37,3)
//   paintRow(38,3)
//   paintRow(39,3)
//   paintRow(40,3)
//   paintRow(41,3)
//   paintRow(42,2)
//   paintRow(43,3)
//
//   // Fila 4
//   paintRow(46,3)
//   paintRow(47,2)
//   paintRow(48,1)
//   paintRow(49,1)
//   paintRow(50,1)
//   paintRow(51,1)
//   paintRow(52,1)
//   paintRow(53,2)
//   paintRow(54,3)
//
//   // Fila 5
//   paintRow(58,2)
//   paintRow(59,3)
//   paintRow(60,2)
//   paintRow(61,2)
//   paintRow(62,2)
//   paintRow(63,3)
//   paintRow(64,2)
//
//   // Fila 6
//   paintRow(69,2)
//   paintRow(70,2)
//   paintRow(71,2)
//   paintRow(72,3)
//   paintRow(73,2)
//   paintRow(74,2)
//   paintRow(75,2)
//
//   // Fila 7
//   paintRow(80,2)
//   paintRow(81,2)
//   paintRow(82,3)
//   paintRow(83,3)
//   paintRow(84,3)
//   paintRow(85,2)
//   paintRow(86,2)
//
//   // Fila 8
//   paintRow(92,0)
//   paintRow(93,0)
//   paintRow(94,0)
//   paintRow(95,0)
//   paintRow(96,0)
// }, 500)

</script>
<template>
  <!--  <div id="loadStyles" :class="`h-36 w-36 h-24 w-24 h-20 w-20 grid grid-cols-3 grid-cols-4 grid-cols-5 hidden-->
  <!--    grid-cols-6 grid-cols-7 grid-cols-8 grid-cols-9 grid-cols-10 grid-cols-11 grid-cols-12-->
  <!--     ${items[0].content} ${items[1].content} ${items[2].content} ${items[3].content}`-->

  <!--"></div>-->

  <!--  <button @click="handleButtonClick">dada</button>-->

  <BackgroundActivities/>

  <WinView id="winView" class="hidden opacity-0 duration-300"/>

  <div class="flex flex-col min-h-screen" @mousedown="handleMouseDown" @mouseup="handleMouseUp">
    <div class="mx-auto flex-1 container flex justify-center">
      <div class="flex  p-6 w-full gap-5 rounded-md">
        <!--        <div class="w-[16%] ">-->
        <!--          <HelpCharacter @click="showHelp()"-->
        <!--                         :image="`${localHost}/images/characters/robot/normal.png`"-->
        <!--                         :image_2="`${localHost}/images/characters/robot/talk.gif`"-->
        <!--          />-->
        <!--        </div>-->
        <div id="dat" class="w-[84%] bg-red-200 p-5 grid">
          <div style="height: 150px;">
            <ProgressBar class="select-none" :planet_1="`${localHost}/images/planets/tierra.svg`"
                         :planet_2="`${localHost}/images/planets/rojo.svg`"
                         :rocket="`${localHost}/images/rockets/1.svg`"
                         :activity_number="props.level[1]"
            />
          </div>

          <div class="row-span-3 flex justify-center items-center">
            <div>
              <div class="my-6 flex justify-center gap-5">

                <div id="" class="duration-300">
                  <div class="grid"
                       :style="{ gridTemplateColumns: `repeat(60, 10px)`, gridTemplateRows: `repeat(40, 10px)` }">
                    <div v-for="test in tests" :key="test.id" :id="test.id"
                         :style="{ backgroundColor: test.color }"
                         class="pixels hover:bg-purple-200 select-none cursor-cell"
                         @mousemove="paintPixel(test)"></div>
                  </div>
                </div>


                                <div id="lienzo" class="duration-300">
                                  <div class="grid"
                                       :style="{ gridTemplateColumns: `repeat(60, 10px)`, gridTemplateRows: `repeat(40, 10px)` }">
                                    <div v-for="pixel in pixels" :key="pixel.id" :id="pixel.id"
                                         :style="{ backgroundColor: pixel.color }"
                                         class="pixel hover:bg-purple-200 select-none cursor-cell"
                                         @mousemove="paintPixel(pixel)"></div>
                                  </div>
                                </div>

<!--                <div class="flex justify-center border-black border-4">-->
<!--                  <div class="grid grid-cols-11 bg-red-700 w-full">-->
<!--                    &lt;!&ndash; linea1 &ndash;&gt;-->
<!--                    <div v-for="i in 99" :key="`i-${i}`" class="grid grid-cols-3 border border-black">-->
<!--                      <span v-if="false" class="absolute select-none">{{ i }}</span>-->
<!--                      <div @mousemove="paint(`caja${i}-${n}`)" :id="`caja${i}-${n}`"-->
<!--                           class="select-none hover:bg-gray-300" style="width: 14px; height: 14px;" v-for="n in 9"-->
<!--                           :key="`n-${n}`">-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->

              </div>
            </div>
          </div>

        </div>

        <div class="w-[16%]">
          <ItemPalette :level="props.level" :items="items" :currentAudio="currentAudio"/>
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
