<script setup>
import HelpCharacter from "../sections/HelpCharacter.vue";
import ItemPalette from "../sections/ItemPalette.vue";
import WinView from "../templates/WinView.vue";
import ProgressBar from "../sections/ProgressBar.vue";
import BackgroundActivities from "../background/BackgroundActivities.vue";
import {
  getSelectItem,
  localHost, paintItem, playAudio, types,
} from '../../use';
import {defineProps, ref, onMounted} from 'vue';

const GameModes = Object.freeze({
  SEQUENCE: 0,
  FREE: 1,
});

const GameSpeeds = Object.freeze({
  SLOW: 0,
  MEDIUM: 1,
  FAST: 2,
});

const props = defineProps({
  level: {type: Array, required: true},
  size: {type: Number, required: true},
  items: {type: Array, required: true},
  fill_sample: {type: Array, default: () => []},
  game_mode: {type: Number, default: 0},
  game_speed: {type: Number, default: 0},
  sequence: {type: Array, default: () => [1, 7, 6]},
});

const configSize = ref({
  sizeBox: 0,
});

const configAudio = ref({
  paintSound: `${localHost}/audios/effects/happyPop.mp3`,
  assertSound: `${localHost}/audios/effects/happyPop.mp3`,
  errorSound: `${localHost}/audios/effects/wood.wav`,
  guide: {
    errors: {
      row: `${localHost}/audios/guide/errors/row.mp3`,
      col: `${localHost}/audios/guide/errors/col.mp3`,
      box: `${localHost}/audios/guide/errors/box.mp3`,
      rowAndCol: `${localHost}/audios/guide/errors/rowAndCol.mp3`,
    },
    assert: {
      row: `${localHost}/audios/guide/assert/row.mp3`,
      col: `${localHost}/audios/guide/assert/col.mp3`,
      box: `${localHost}/audios/guide/assert/box.mp3`,
      rowAndCol: `${localHost}/audios/guide/assert/rowAndCol.mp3`,
    },
  }
});

const configSudoku = ref({
  size: props.size,
  table: [],
  blockedIds: [],
  rows: {
    ids: [],
    contents: [],
  },
  cols: {
    ids: [],
    contents: [],
  },
  errors:
      {
        row: [],
        col: [],
        box: [],
      },
});

const configGame = ref({
  items: props.items,
  currentAudio: '',
  inTutorial: false,
  win: false,
  winView: false,
  prepareActivity: false,
  gameMode: GameModes.FREE,
  gameSpeed: GameSpeeds.SLOW,
  sequence: props.sequence,
  levelComplete: false,
});

const configCharacter = ref({
  get: null,
  start: `${localHost}/images/characters/robot/v1/still/notFace.png`,
  image_2: `${localHost}/images/characters/robot/talk.gif`,
  assert: `${localHost}/images/characters/robot/v1/still/happy.png`,
  error: `${localHost}/images/characters/robot/v1/still/alert.png`,
  current: `${localHost}/images/characters/robot/v1/still/notFace.png`,
});

const sudokuTable = ref([]);

const createSudokuTable = (n) => {
  let table = new Array(n);
  for (let i = 0; i < n; i++) {
    table[i] = new Array(n).fill(false);
  }
  return table;
}

const hasDuplicates = (arr) => {
  let arrayFilter = arr.filter(item => typeof item !== 'boolean');
  let counts = {};

  for (let i = 0; i < arrayFilter.length; i++) {
    if (counts[arrayFilter[i]]) {
      counts[arrayFilter[i]] += 1;
    } else {
      counts[arrayFilter[i]] = 1;
    }
  }

  let duplicates = [];
  for (let item in counts) {
    if (counts[item] > 1) {
      duplicates.push(item);
    }
  }

  return duplicates;
}

const updateRowsAndCols = () => {
  // Actualizar ids, Ejemplo: ids rows seria = [['1','2','3','4'], ['5','6','7','8'], ['9','10','11','12'], ['13','14','15','16']]

  configSudoku.value.rows.ids = configSudoku.value.table.map((_, rowIndex) => configSudoku.value.table[rowIndex].map((_, colIndex) => `${rowIndex * props.size + colIndex + 1}`));
  configSudoku.value.cols.ids = configSudoku.value.table[0].map((_, colIndex) => configSudoku.value.table.map((_, rowIndex) => `${rowIndex * props.size + colIndex + 1}`));

  configSudoku.value.rows.contents = configSudoku.value.table;
  configSudoku.value.cols.contents = configSudoku.value.table[0].map((_, colIndex) => configSudoku.value.table.map(row => row[colIndex]));
}

onMounted(async () => {
  const sizeBoxValues = {
    3: 21, // ( 3x3 sudoku = 20 de size )
    4: 16, // ( 4x4 sudoku = 16 de size )
    5: 13, // ( 5x5 sudoku = 13 de size )
    6: 11, // ( 6x6 sudoku = 11 de size )
    7: 9, // ( 7x7 sudoku = 9 de size )
    8: 8, // ( 8x8 sudoku = 8 de size )
    9: 7, // ( 9x9 sudoku = 7 de size )
  };

  configSize.value.sizeBox = sizeBoxValues[props.size];

  configCharacter.value.get = document.getElementById('character');

  configSudoku.value.table = createSudokuTable(props.size);
  configGame.value.gameMode = props.game_mode;
  configGame.value.gameSpeed = props.game_speed;

  if (props.fill_sample.length > 0) {
    let orderArray = []
    for (let i = 0; i <= props.fill_sample.length - 1; i++) {
      let order = props.fill_sample[i] - 1
      orderArray.push(order)
      if (orderArray[i] === -1) {
        continue
      }
      let item = props.items[orderArray[i]]
      updateTable(`${i + 1}`, item);
      localStorage.setItem('itemSelected', JSON.stringify(item))
      configSudoku.value.blockedIds.push(i + 1)
      paintItem(`${i + 1}`, props.items)

      localStorage.setItem('itemSelected', JSON.stringify(null))
    }
  }

  // Modos de juego

  // Modo secuencia
  if (configGame.value.gameMode === GameModes.SEQUENCE) {

    // Seleccionar el primer item de la secuencia
    let initialBox = document.getElementById(`${configGame.value.sequence[0]}`);

    // configGame.value.sequence.shift()

    initialBox.classList.replace('bg-white', 'bg-blue-500')
    initialBox.classList.add('selected');


  } else if (configGame.value.gameMode === GameModes.FREE) {
    // Code for game mode with defaults
  } else {
    // Code for game mode without help
  }

  updateRowsAndCols();

});

const updateTable = (id, itemSelected) => {

  const row = Math.floor((id - 1) / props.size) + 1;
  const col = ((id - 1) % props.size) + 1;

  if (itemSelected.type === types.eraser) {
    configSudoku.value.table[row - 1][col - 1] = false;
  } else {
    configSudoku.value.table[row - 1][col - 1] = itemSelected.content;
  }

  updateRowsAndCols();
}

const handleRowErrors = (row) => {
  configSudoku.value.rows.contents[row - 1].forEach((item, index) => {
    let box = document.getElementById((row - 1) * props.size + index + 1);
    if (hasDuplicates(configSudoku.value.rows.contents[row - 1]).includes(item)) {
      box.classList.add('error');
    }
  });

  if (!configSudoku.value.errors.row.includes(row)) {
    configSudoku.value.errors.row.push(row);
  }
}

const handleColErrors = (col) => {
  configSudoku.value.cols.contents[col - 1].forEach((item, index) => {
    let box = document.getElementById(`${index * props.size + col}`);
    if (hasDuplicates(configSudoku.value.cols.contents[col - 1]).includes(item)) {
      box.classList.add('error');
    }
  });

  if (!configSudoku.value.errors.col.includes(col)) {
    configSudoku.value.errors.col.push(col);
  }
}

const checkWinCondition = () => {
  if (configSudoku.value.errors.row.length === 0 && configSudoku.value.errors.col.length === 0) {
    if (!configSudoku.value.table.flat().includes(false)) {
      win()
    }
  }
}

const clearRowErrors = (row) => {
  configSudoku.value.rows.contents[row - 1].forEach((item, index) => {
    let box = document.getElementById(`${(row - 1) * props.size + index + 1}`);
    const col = ((index) % props.size) + 1;
    if (!configSudoku.value.errors.col.includes(col)) {
      box.classList.remove('error');
    }
  });

  if (configSudoku.value.errors.row.includes(row)) {
    configSudoku.value.errors.row = configSudoku.value.errors.row.filter(item => item !== row);
  }
}

const clearColErrors = (col) => {
  configSudoku.value.cols.contents[col - 1].forEach((item, index) => {
    let box = document.getElementById(`${index * props.size + col}`);
    const row = Math.floor((box.id - 1) / props.size) + 1;
    if (!configSudoku.value.errors.row.includes(row)) {
      box.classList.remove('error');
    }
  });

  if (configSudoku.value.errors.col.includes(col)) {
    configSudoku.value.errors.col = configSudoku.value.errors.col.filter(item => item !== col);
  }
}


const paintBox = (id) => {
  if (configSudoku.value.blockedIds.indexOf(id) !== -1) {
    return;
  }

  const row = Math.floor((id - 1) / props.size) + 1;
  const col = ((id - 1) % props.size) + 1;

  if (configGame.value.gameMode === GameModes.SEQUENCE) {
    if (id !== configGame.value.sequence[0] || configGame.value.inTutorial) {
      return;
    }

    paintItem(id, configGame.value.items)
    const itemSelected = getSelectItem();

    updateTable(id, itemSelected);

    const hasRowError = !validateRow(configSudoku.value.rows.contents[row - 1]);
    const hasColError = !validateCol(configSudoku.value.cols.contents[col - 1]);

    validateTable();

    let box = document.getElementById(`${configGame.value.sequence[0]}`);

    if (!hasRowError && !hasColError) {
      configCharacter.value.get.src = configCharacter.value.assert;
      // configCharacter.value.current = configCharacter.value.assert;
      playAudio(configAudio.value.assertSound);
      // Reasignar el box seleccionado

      box.classList.remove('selected');
      box.classList.replace('bg-blue-500', 'bg-white');
      box.classList.remove('waiting-too-long');

      // Seleccionar el siguiente item de la secuencia

      configGame.value.sequence.shift();
      if (configGame.value.sequence.length === 0) {
        checkWinCondition();
        return;
      }

      let nextBox = document.getElementById(`${configGame.value.sequence[0]}`);
      nextBox.classList.replace('bg-white', 'bg-blue-500');
      nextBox.classList.add('selected');

    } else {

      configCharacter.value.get.src = configCharacter.value.error;
      // Configurar velocidades
      if (configGame.value.gameSpeed === GameSpeeds.SLOW) {
        configGame.value.inTutorial = true;
        // Animacion de explicacion de error

        if (hasRowError && !hasColError) {
          // Cambiar scale de la fila

          box.classList.remove('selected', 'waiting-too-long');
          selectRowOrCol(row, id, 'rows');

        } else if (hasColError && !hasRowError) {
          console.log('Error solo en columna');

          box.classList.remove('selected', 'waiting-too-long');

          selectRowOrCol(col, id, 'cols');

        } else if (hasRowError && hasColError) {
          box.classList.remove('selected', 'waiting-too-long');
          selectRowOrCol(row, id, 'rows');
          selectRowOrCol(col, id, 'cols');
        }

        // box.classList.add('waiting-too-long');
        playAudio(configAudio.value.errorSound);
        return;
      } else if (configGame.value.gameSpeed === GameSpeeds.MEDIUM) {
        box.classList.add('waiting-too-long');
        playAudio(configAudio.value.errorSound);
        return;
      } else if (configGame.value.gameSpeed === GameSpeeds.FAST) {
        box.classList.add('waiting-too-long');
        playAudio(configAudio.value.errorSound);
        return;
      }

      box.classList.add('waiting-too-long');
      playAudio(configAudio.value.errorSound);
    }


    return;

  } else if (configGame.value.gameMode === GameModes.FREE) {
    let box = document.getElementById(`${id}`);
    paintItem(id, configGame.value.items)
    const itemSelected = getSelectItem();

    updateTable(id, itemSelected);

    const hasRowError = !validateRow(configSudoku.value.rows.contents[row - 1]);
    const hasColError = !validateCol(configSudoku.value.cols.contents[col - 1]);
    console.log('hasRowError', hasRowError);

    validateTable();

    if (!hasRowError && !hasColError) {
      playAudio(configAudio.value.assertSound);
      box.classList.remove('waiting-too-long');
      checkWinCondition();
    } else {
      if (props.fill_sample.length > 0) {
        box.classList.add('waiting-too-long');
      }
      playAudio(configAudio.value.errorSound);
    }
  } else {
    // Code for game mode without help
  }

  if (configGame.value.gameSpeed === GameSpeeds.FAST) {
    // Code for fast game speed
  } else if (configGame.value.gameSpeed === GameSpeeds.MEDIUM) {
    // Code for medium game speed
  } else {
    // Code for slow game speed
  }

  paintItem(id, configGame.value.items)
  const itemSelected = getSelectItem();

  updateTable(id, itemSelected);


  console.log('hasRowError', hasRowError);
  console.log('hasColError', hasColError);

  validateTable();

  if (hasRowError && !hasColError) {
    console.log('Error solo en fila');
  }

  if (hasColError && !hasRowError) {
    console.log('Error solo en columna');

  }

  if (hasRowError && hasColError) {
    console.log('Error en fila y columna');
  }

  if (!hasRowError && !hasColError) {

    playAudio(configAudio.value.assertSound);
    checkWinCondition();
  } else {
    playAudio(configAudio.value.errorSound);
  }
}

const validateTable = () => {
  configSudoku.value.table.forEach((row, rowIndex) => {
    row.forEach((item, colIndex) => {
      let box = document.getElementById(`${rowIndex * props.size + colIndex + 1}`);
      box.classList.remove('error');
    });
  });

  configSudoku.value.errors.row = [];

  configSudoku.value.table[0].forEach((_, colIndex) => {
    configSudoku.value.errors.col = [];
  });

  configSudoku.value.table.forEach((row, rowIndex) => {
    if (!validateRow(row)) {
      handleRowErrors(rowIndex + 1);
    }
  });

  configSudoku.value.table[0].forEach((_, colIndex) => {
    if (!validateCol(configSudoku.value.cols.contents[colIndex])) {
      handleColErrors(colIndex + 1);
    }
  });
}

const validateRow = (row) => {
  const duplicates = hasDuplicates(row);
  return duplicates.length === 0;
}

const validateCol = (col) => {
  const duplicates = hasDuplicates(col);
  return duplicates.length === 0;
}

const selectRowOrCol = (ROC, id, type) => {

  let contents = null

  if (type === 'rows') {
    contents = configSudoku.value.rows.contents
  } else if (type === 'cols') {
    contents = configSudoku.value.cols.contents
  }

  contents[ROC - 1].forEach((item, index) => {
    let box = null;
    if (type === 'rows') {
      box = document.getElementById(`${(ROC - 1) * props.size + index + 1}`);
    } else if (type === 'cols') {
      box = document.getElementById(`${index * props.size + ROC}`);
    }

    setTimeout(() => {
      box.classList.add('scale-50');
    }, 1500);

    // Quitar la animacion cuando finalice el audio de explicacion
    setTimeout(() => {
      box.classList.remove('scale-50');
      configGame.value.inTutorial = false;
      document.getElementById(id).classList.add('waiting-too-long');
    }, 3000);
  });
}

let level = ref(props.level)
let showProgressBar = ref(true)
const win = () => {
  configGame.value.levelComplete = true
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
  winView.classList.remove('hidden')

  let button = document.getElementById('nextLevelButton')

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
      console.log("win tinme");
    }, 200)
  }, 4000)
}
</script>

<template>
  <BackgroundActivities/>
  <WinView id="winView" class="hidden opacity-0 duration-300"/>

  <div class="flex flex-col min-h-screen">
    <div class="mx-auto flex-1 container flex justify-center">
      <div class="flex p-6 w-full gap-5 rounded-md">
        <div class="w-[16%]">
          <HelpCharacter :image="configCharacter.current"
                         :image_2="`${localHost}/images/characters/robot/talk.gif`"
          />
        </div>
        <div id="board" class="w-[68%] bg-red-200 p-5 grid grid-rows-4">
          <ProgressBar :planet_1="`${localHost}/images/planets/tierra.svg`"
                       :planet_2="`${localHost}/images/planets/rojo.svg`"
                       :rocket="`${localHost}/images/rockets/1.svg`"
                       :level="props.level"
          />
          <!--          <span class="fixed text-white">TABLE: {{ configSudoku.table }}</span>-->
          <!--          <span class="fixed text-white translate-y-4">ROWS ID: {{ configSudoku.rows.ids }}</span>-->
          <!--          <span class="fixed text-white translate-y-8">ROWS: {{ configSudoku.rows.contents }}</span>-->
          <!--          <span class="fixed text-white translate-y-12">COLS ID: {{ configSudoku.cols.ids }}</span>-->
          <!--          <span class="fixed text-white translate-y-20">COLS ID: {{ configSudoku.cols.contents }}</span>-->
          <!--          <span class="fixed text-white translate-y-24">ERRORS ROWS: {{ configSudoku.errors.row }}</span>-->
          <!--          <span class="fixed text-white translate-y-28">ERRORS COLS: {{ configSudoku.errors.col }}</span>-->

          <div class="row-span-3 flex justify-center items-center">
            <div :class="`grid grid-cols-${props.size}`">
              <div :id="i"
                   @click="paintBox(i)"
                   v-for="i in props.size * props.size"
                   :key="`box-${i}`"
                   :style="`width: ${configSize.sizeBox}vmin; height: ${configSize.sizeBox}vmin;`"
                   :class="`bg-white border border-black hover:opacity-60 flex justify-center items-center
                        font-bold text-6xl select-none duration-300 cursor-cell rounded-md`">
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

@keyframes shake {
  0% {
    transform: translateX(0) rotate(0deg);
  }
  10% {
    transform: translateX(-5px) rotate(-5deg);
  }
  20% {
    transform: translateX(5px) rotate(5deg);
  }
  30% {
    transform: translateX(-5px) rotate(-5deg);
  }
  40% {
    transform: translateX(5px) rotate(5deg);
  }
  50% {
    transform: translateX(-5px) rotate(-5deg);
  }
  60% {
    transform: translateX(5px) rotate(5deg);
  }
  70% {
    transform: translateX(-5px) rotate(-5deg);
  }
  80% {
    transform: translateX(5px) rotate(5deg);
  }
  90% {
    transform: translateX(-5px) rotate(-5deg);
  }
  100% {
    transform: translateX(0) rotate(0deg);
  }
}

.error {
  background-color: red;
  animation: shake 1s;
}

//background-color: #f1c40f; /* Amarillo vibrante */
//background-color: #3498db; /* Azul vibrante */

.selected {
  display: inline-block;
  padding: 20px 40px;
  background-color: #3498db; /* Azul vibrante */
  color: white;
  font-size: 20px;
  font-weight: bold;
  text-align: center;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s, background-color 0.2s, box-shadow 0.2s;
  cursor: pointer;
}

.selected:hover {
  background-color: #2980b9; /* Azul más oscuro */
  transform: scale(.95);
  animation: glowing 1.5s infinite alternate;
}


/* Animación de resplandor */
@keyframes glowing {
  0% {
    box-shadow: 0 0 5px #f1c40f, 0 0 10px #f1c40f, 0 0 15px #f1c40f;
  }
  50% {
    box-shadow: 0 0 20px #f1c40f, 0 0 30px #f1c40f, 0 0 40px #f1c40f;
  }
  100% {
    box-shadow: 0 0 5px #f1c40f, 0 0 10px #f1c40f, 0 0 15px #f1c40f;
  }
}

/* Animación de tardanza */
@keyframes waiting {
  0% {
    opacity: 1;
  }
  50% {
    opacity: .5;
  }
  100% {
    opacity: 1;
  }
}

/* Estilo del div si se tarda mucho en hacer clic */
.waiting-too-long {
  animation: waiting 3s infinite;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  transform: scale(.80); /* Restablecer el tamaño */
}
</style>


<!--.selected {-->
<!--  display: inline-block;-->
<!--  background-color: #3498db; /* Azul vibrante */-->
<!--  color: white;-->
<!--  text-align: center;-->
<!--  border-radius: 10px;-->
<!--  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);-->
<!--  transition: transform 0.2s, background-color 0.2s, box-shadow 0.2s;-->
<!--}-->

<!--/* Animación de resplandor */-->
<!--@keyframes glowing {-->
<!--  0% {-->
<!--    box-shadow: 0 0 5px #3498db, 0 0 10px #3498db, 0 0 15px #3498db;-->
<!--  }-->
<!--  50% {-->
<!--    box-shadow: 0 0 20px #3498db, 0 0 30px #3498db, 0 0 40px #3498db;-->
<!--  }-->
<!--  100% {-->
<!--    box-shadow: 0 0 5px #3498db, 0 0 10px #3498db, 0 0 15px #3498db;-->
<!--  }-->
<!--}-->

<!--/* Estilo al pasar el cursor */-->
<!--.selected:hover {-->
<!--  background-color: #2980b9; /* Azul más oscuro */-->
<!--  transform: scale(.90);-->
<!--}-->