<script setup>
import "../sections/HelpCharacter.vue";
import HelpCharacter from "../sections/HelpCharacter.vue";
import ItemPalette from "../sections/ItemPalette.vue";
import ProgressBar from "../sections/ProgressBar.vue";
import WinView from "../templates/WinView.vue";
import {
  types,
  localHost,
  sizes,
  getSelectItem,
  talk,
  talkCharacter,
  paintItem,
  errorPaint,
  updateCoins, getCoins
} from '../../use';
import {onMounted, ref} from "vue";
import IconArrowRight from "../icons/IconArrowRight.vue"
import IconPaintBrush from "../icons/IconPaintBrush.vue"
import Swal from "sweetalert2";
import BackgroundActivities from "../background/BackgroundActivities.vue";

const props = defineProps({
  size: {type: Array},
  fill_sample: {type: Array},
  solution: {type: Array},
  level: {type: Array},
  items: {type: Array},
  rotate: {type: Boolean},
})

let talkBool = ref(false)
let boxSize = ref(0)
let boxes = ref([])

const generateAudios = (audioNumber) => {
  switch (audioNumber) {
    case 1:
      resolveAudio('¡Bienvenidos al emocionante viaje por el espacio! ,  ¡Vamos a empezar con algo divertido!, ', '1', 'start/pattern', '0.9');
      break;
    case 2:
      resolveAudio('Observa que el cuadrado de la izquierda esta pintado con los colores. ', '2', 'start/pattern', '0.9');
      break;
    case 3:
      resolveAudio('Pinta de forma idéntica el cuadrado de la derecha utilizando tus pinceles de colores. ', '3', 'start/pattern', '0.9');
      break;
  }
}

verifyAudiosNumber(3)

function verifyAudiosNumber(number) {
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

onMounted(() => {
  // validateAudiosOfPositions(props.selectors)
  if (props.size[0] * props.size[1] < 5) {
    boxSize.value = 36
  } else if (props.size[0] * props.size[1] > 5 && props.size[0] * props.size[1] < 10) {
    boxSize.value = 24
  } else if (props.size[0] * props.size[1] > 10 && props.size[0] * props.size[1] < 26) {
    boxSize.value = 20
  } else if (props.size[0] * props.size[1] > 26) {
    boxSize.value = 12
  }

  document.getElementById('coinsCount').innerText = `x ${getCoins()}`
  talk(false)

  for (let i = 0; i < props.size[0] * props.size[1]; i++) {
    boxes.value.push(false)
  }

  for (let i = 0; i < items.length; i++) {
    const item = items[i];

    let audioPath = `${localHost}/audios/items/${item.name}.m4a`;

    verifyFileExistence(audioPath, function (exist) {
      if (exist) {
        console.log('El archivo existe.');
      } else {
        resolveAudio(item.name, item.name, 'items', '0.8')
        console.log('El archivo no existe.');
      }
    });
  }

});

const resolveAudio = (text, name, path, speed) => {
  axios.post(`${localHost}/loadAudio`, {
    text: text,
    name: name,
    path: path,
    speed: speed,
  }).then(response => {
    console.log(response.data)
  })

}


function verifyFileExistence(url, callback) {
  let xhr = new XMLHttpRequest();
  xhr.open('HEAD', url, true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      // 200 OK indica que el archivo existe
      if (xhr.status === 200) {
        callback(true);
      } else {
        callback(false);
      }
    }
  };

  xhr.send();
}


const items = props.items

let paintImage = ref(false)

const intro = () => {
  let audio1 = new Audio(`${localHost}/audios/start/pattern/1.m4a`)
  audio1.play()
  talkBool.value = true

  talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`)

  let audio2 = new Audio(`${localHost}/audios/start/pattern/2.m4a`)

  audio1.onended = function () {
    audio2.play()
  }
  audio2.onended = function () {
    showItemsPresentation()
  }
}

const showHelp = () => {

  if (talkBool.value) {
    return
  }

  talkBool.value = true
  let indication1 = new Audio(`${localHost}/audios/start/pattern/help/observa-colorea.m4a`)
  indication1.play()

  talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`)

  indication1.onended = function () {
    talkBool.value = false
    talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`)
  }

  document.getElementById('fig1').classList.add('animate-pulse')
  document.getElementById('arrow').classList.add('scale-50')
  document.getElementById('fig2').classList.add('scale-50')

  setTimeout(function () {
    document.getElementById('fig1').classList.remove('animate-pulse')
    document.getElementById('arrow').classList.remove('scale-50')
    document.getElementById('fig2').classList.remove('scale-50')

    document.getElementById('fig2').classList.add('animate-pulse')
    document.getElementById('fig1').classList.add('scale-50')
    document.getElementById('arrow-right').style.fill = 'green';

    setTimeout(function () {
      document.getElementById('fig2').classList.remove('animate-pulse')
      document.getElementById('fig1').classList.remove('scale-50')
      document.getElementById('arrow-right').style.fill = '#9ca3af';
    }, 2000)
  }, 2000)
}

const showFocusBox = (id) => {
  document.getElementById(id).classList.add('animate-pulse', 'zoom-box')

  setTimeout(function () {
    document.getElementById(id).classList.remove('zoom-box')
  }, 3000)
}

setTimeout(function () {
  Swal.fire({
    title: `Actividad ${props.level[1]}`,
    text: 'Llegamos a los Sudokus! Aqui veremos un poco de pensamiento combinatorio, filas y muchos colores!',
    icon: 'warning',
    confirmButtonText: 'Comenzar'
  }).then((result) => {
    intro();
    prepare()
  });
}, 500)

setTimeout(function () {
  // intro();
  prepare()
}, 500)

const prepare = () => {

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

let step = ref(0)
let focusBox = ref()


const validateOrder = (id) => {

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

    document.getElementById(id).classList.remove('animate-pulse', 'scale-95')

    boxes.value[id - 1] = true

    for (let i = 0; i < props.size[0] * props.size[1]; i++) {
      if (boxes.value[i] === true) {
        step.value++
      }
    }
    console.log(step.value)

    if (step.value === props.size[0] * props.size[1]) {
      win()
    }
    step.value = 0

  } else {
    paintItem(id, items)

    let bubble = new Audio()
    bubble.src = `${localHost}/audios/effects/wood.wav`
    bubble.play()

    boxes.value[id - 1] = false

    document.getElementById(id).innerText = 'X'
    document.getElementById(id).classList.add('animate-pulse', 'scale-95', 'zoom-box')

    setTimeout(function () {
      document.getElementById(id).classList.remove('zoom-box')
    }, 3000)
  }
}


const selector = (row, col, nextBox, item, isError) => {
  let sudokuIds = []
  let time = 2000

  for (let i = 1; i <= (props.size * props.size); i++) {
    sudokuIds.push(i)
  }

  let sudokuArray = convertInArray(sudokuIds, props.size, props.size);

  let rowsAndCols = getRowsAndCols(sudokuArray)

  let audio1 = new Audio()
  let audio2 = new Audio()

  if (row) {
    audio1.src = `${localHost}/audios/positions/rows/${row}.m4a`

    if (col) {
      audio2.src = `${localHost}/audios/positions/cols/extensions/${col}.m4a`
    }

  } else {
    audio1.src = `${localHost}/audios/positions/cols/${col}.m4a`
  }

  for (let i = 0; i <= props.size - 1; i++) {
    const selectRow = () => {
      if (row) {
        if (isError) {
          setTimeout(function () {
            document.getElementById(rowsAndCols[0][row - 1][i]).classList.add('duration-300', 'animate-bounce')
            setTimeout(function () {
              document.getElementById(rowsAndCols[0][row - 1][i]).classList.remove('animate-bounce')
            }, time)
          }, 100)

        } else {
          document.getElementById(rowsAndCols[0][row - 1][i]).classList.add('duration-300', 'scale-75')
          setTimeout(function () {
            document.getElementById(rowsAndCols[0][row - 1][i]).classList.remove('scale-75')
          }, time)
        }
      }
    }

    const selectCol = () => {
      if (col) {
        if (isError) {
          setTimeout(function () {
            document.getElementById(rowsAndCols[1][col - 1][i]).classList.add('duration-300', 'animate-bounce')
            setTimeout(function () {
              document.getElementById(rowsAndCols[1][col - 1][i]).classList.remove('animate-bounce')
            }, time)
          }, 100)

        } else {
          document.getElementById(rowsAndCols[1][col - 1][i]).classList.add('duration-300', 'scale-75')
          setTimeout(function () {
            document.getElementById(rowsAndCols[1][col - 1][i]).classList.remove('scale-75')
          }, time)
        }
      }
    }

    if (row) {
      selectRow()
      audio1.play()

      if (col) {
        setTimeout(function () {
          selectCol()
          audio2.play()
          setTimeout(function () {
            if (i === props.size - 1 && isError === false) {
              nextStep()
            } else if (isError) {
              talkBool.value = false
              talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`)
            }
          }, time)
        }, time + 500)
      } else {
        setTimeout(function () {
          if (i === props.size - 1 && isError === false) {
            nextStep()
          } else if (isError) {
            talkBool.value = false
            talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`)
          }
        }, time)
      }

    } else {
      selectCol()
      audio1.play()
      setTimeout(function () {
        if (i === props.size - 1 && isError === false) {
          nextStep()
        } else if (isError) {
          talkBool.value = false
          talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`)
        }
      }, time)
    }

  }

  const nextStep = () => {

    let nextAudio = new Audio()

    if (nextBox) {
      nextAudio.src = `${localHost}/audios/explanations/nextPositionFocus/${item.group}.m4a`
      nextAudio.play()

      nextAudio.onended = function () {
        talkBool.value = false
        talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`)
        if (nextBox) {
          showFocusBox(`${props.order_to_resolve[step.value]}`)
          nextBox.classList.add('animate-pulse')
        } else {
          win(true)
        }
      }
    } else {
      talkBool.value = false
      talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`)
      win(true)
    }
  }
}

const win = (coinAdd) => {

  if (coinAdd) {
    let winView = document.getElementById('winView')

    winView.classList.remove('hidden')

    setTimeout(function () {
      winView.classList.replace('opacity-0', 'opacity-100')
    }, 500)

    setTimeout(function () {
      winView.classList.replace('opacity-100', 'opacity-0')
    }, 3000)

    setTimeout(function () {
      winView.classList.add('hidden')
    }, 3500)
    setTimeout(function () {
      addCoinWin()
      setTimeout(function () {
        document.getElementById('nextLevelButton').classList.remove('hidden')
      }, 2800)
    }, 3600)
  } else {
    let winView = document.getElementById('winView')

    winView.classList.remove('hidden')

    setTimeout(function () {
      winView.classList.replace('opacity-0', 'opacity-100')
    }, 500)

    setTimeout(function () {
      winView.classList.replace('opacity-100', 'opacity-0')
    }, 3000)

    setTimeout(function () {
      winView.classList.add('hidden')
    }, 3500)
    setTimeout(function () {
      document.getElementById('nextLevelButton').classList.remove('hidden')
    }, 2000)
  }


  const addCoinWin = () => {
    let coinSound = new Audio(`${localHost}/audios/effects/simpleCoin.wav`)
    coinSound.play()

    document.getElementById('coins').classList.add('opacity-0')

    setTimeout(function () {
      document.getElementById('coins').classList.add('hidden')
      document.getElementById('addCoin').classList.remove('hidden')
    }, 300)

    setTimeout(function () {
      document.getElementById('addCoin').classList.replace('opacity-0', 'opacity-100')
    }, 400)

    setTimeout(function () {
      document.getElementById('addCoin').classList.replace('opacity-100', 'opacity-0')
    }, 2000)

    setTimeout(function () {
      document.getElementById('addCoin').classList.add('hidden')
      document.getElementById('coins').classList.remove('hidden')
    }, 2600)

    setTimeout(function () {
      document.getElementById('coins').classList.replace('opacity-0', 'opacity-100')
    }, 2700)

    setTimeout(function () {
      document.getElementById('coinsCount').innerText = `x ${updateCoins(1)}`
    }, 2700)
  }
}

function convertInArray(sudokuIds, rows, cols) {
  let array = [];
  for (let i = 0; i < rows; i++) {
    let row = [];
    for (let j = 0; j < cols; j++) {
      row.push(sudokuIds[i * cols + j]);
    }
    array.push(row);
  }
  return array;
}


function getRowsAndCols(sudokuIds) {

  let getRows = sudokuIds.length;
  let getCol = sudokuIds[0].length;

  let rows = []
  let cols = []

  for (let i = 0; i < getRows; i++) {
    rows.push(sudokuIds[i])
  }

  for (let j = 0; j < getCol; j++) {
    let col = [];
    for (let i = 0; i < getRows; i++) {
      col.push(sudokuIds[i][j]);
    }
    cols.push(col)
  }

  return [rows, cols]
}

const validateAudiosOfPositions = (selector) => {

  for (let i = 0; i < items.length; i++) {

    let nextFocus = `${localHost}/audios/explanations/nextPositionFocus/${items[i].group}.m4a`;

    let oration = `Sigamos, que ${items[i].group} debe ir en el siguiente Lugar`

    verifyFileExistence(nextFocus, function (exist) {
      if (exist) {
        console.log(`El nextFocus existe.`);
      } else {

        resolveAudio(oration, items[i].group, 'explanations/nextPositionFocus', '0.8')
        console.log(`El nextFocus no existe.`);
      }
    });
  }

  for (let i = 0; i < selector.length; i++) {

    let row = selector[i][0]
    let col = selector[i][1]

    let rowPath = `${localHost}/audios/positions/rows/${row}.m4a`;
    let colPath = `${localHost}/audios/positions/cols/${col}.m4a`;
    let colExtPath = `${localHost}/audios/positions/cols/extensions/${col}.m4a`;

    let rowText = [
      'La primera fila',
      'La Segunda fila',
      'La tercera fila',
      'La cuarta fila',
      'La quinta fila',
      'La sexta fila'
    ]

    let colText = [
      'La primera columna',
      'La Segunda columna',
      'La tercera columna',
      'La cuarta columna',
      'La quinta columna',
      'La sexta columna'
    ]

    if (row !== 0) {
      verifyFileExistence(rowPath, function (exist) {
        if (exist) {
          console.log(`El ROW ${row} existe.`);
        } else {


          resolveAudio(rowText[row - 1], row, 'positions/rows', '0.8')
          console.log(`El ROW ${row} no existe.`);
        }
      });

      if (col !== 0) {
        verifyFileExistence(colExtPath, function (exist) {
          if (exist) {
            console.log(`El COL ${col} existe.`);
          } else {

            resolveAudio('y ' + colText[col - 1], col, 'positions/cols/extensions', '0.8')
            console.log(`El COL ${row} no existe.`);
          }
        });
      }
    } else {
      if (col !== 0) {
        verifyFileExistence(colPath, function (exist) {
          if (exist) {
            console.log(`El COL ${col} existe.`);
          } else {

            resolveAudio(colText[col - 1], col, 'positions/cols', '0.8')
            console.log(`El COL ${row} no existe.`);
          }
        });
      }
    }

  }
}

const showItemsPresentation = () => {
  let box = document.getElementById('itemPresentation')

  box.classList.remove('hidden')

  for (let i = 0; i < items.length; i++) {
    let time = 0

    if (i === 1) {
      time = 2000
    } else if (i === 2) {
      time = time + 4000
    } else if (i === 3) {
      time = time + 6000
    } else if (i === 4) {
      time = time + 8000
    } else if (i === 5) {
      time = time + 10000
    }

    let itemSound = new Audio(`${localHost}/audios/items/${items[i].name}.m4a`)

    if (items[i].type === types.image) {

      setTimeout(function () {
        itemSound.play()
        box = document.getElementById('itemPresentation');

        let img = document.createElement('img');

        img.src = items[i].content;
        img.alt = 'Descripción de la imagen';

        box.appendChild(img);
      }, time)

      setTimeout(function () {
        let imgExt = box.getElementsByTagName('img')[0];

        if (imgExt) {
          box.removeChild(imgExt);
        }
      }, time + 2000)

    } else if (items[i].type === types.letter || items[i].type === types.number) {

      let imgExt = box.getElementsByTagName('img')[0];

      if (imgExt) {
        box.removeChild(imgExt);
      }

      setTimeout(function () {
        itemSound.play()
        box.innerText = items[i].name
      }, time)

      setTimeout(function () {
        box.innerText = null
      }, time + 2000)
    } else if (items[i].type === types.color) {

      let imgExt = box.getElementsByTagName('img')[0];

      if (imgExt) {
        box.removeChild(imgExt);
      }

      setTimeout(function () {
        itemSound.play()
        box.classList.replace('bg-gray-200', items[i].content)
      }, time)

      setTimeout(function () {
        box.classList.replace(items[i].content, 'bg-gray-200')
      }, time + 2000)
    } else if (items[i].type === types.eraser) {
      setTimeout(function () {
        box.classList.add('hidden')
      }, time)
      continue
    }

    if (i === items.length - 1) {
      setTimeout(function () {
        box.classList.add('hidden')
        let audio3 = new Audio(`${localHost}/audios/start/pattern/3.m4a`)
        audio3.play()
        audio3.onended = function () {
          talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`)
          showHelp()
          talkBool.value = false
        }
      }, time + 2000)

    }
  }
}

</script>
<template>
  <div id="loadStyles" :class="`h-36 w-36 h-24 w-24 h-20 w-20 grid grid-cols-3 grid-cols-4 grid-cols-5 hidden
    grid-cols-6 grid-cols-7 grid-cols-8 grid-cols-9 grid-cols-10 grid-cols-11 grid-cols-12
     ${items[0].content} ${items[1].content} ${items[2].content} ${items[3].content}`

"></div>

  <BackgroundActivities/>

  <WinView id="winView" class="hidden opacity-0 duration-300"/>

  <div class="flex flex-col min-h-screen">
    <div class="mx-auto flex-1 container flex justify-center">
      <div class="flex  p-6 w-full gap-5 rounded-md">
        <div class="w-[16%] ">
          <HelpCharacter @click="showHelp()"
                         :image="`${localHost}/images/characters/robot/normal.png`"
                         :image_2="`${localHost}/images/characters/robot/talk.gif`"
          />
        </div>
        <div id="dat" class="w-[68%] bg-red-200 p-5 grid grid-rows-4">
          <ProgressBar :planet_1="`${localHost}/images/planets/tierra.svg`"
                       :planet_2="`${localHost}/images/planets/rojo.svg`"
                       :rocket="`${localHost}/images/rockets/1.svg`"
                       :activity_number="props.level[1]"
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
                    <div :id="`sample-${i}`" @click="validateOrder(i)"
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
                    <div :id="i" @click="validateOrder(i)"
                         v-for="i in (props.size[0] * props.size[1])"
                         :key="i"
                         :class="`bg-white border border-black hover:opacity-75
                                          flex justify-center items-center font-bold text-6xl select-none h-${boxSize} w-${boxSize}`">
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>

        <div class="w-[16%]">
          <ItemPalette :level="props.level" :items="items"/>
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
