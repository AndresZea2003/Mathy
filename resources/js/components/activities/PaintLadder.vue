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
import Swal from "sweetalert2";

const props = defineProps({
    size: {type: Array},
    fill_sample: {type: Array},
    solution: {type: Array},
    level: {type: Array},
    items: {type: Array},
    rotate: {type: Boolean},
    order_to_resolve: {type: Array},
    select_cols: {type: Array},
})

let talkBool = ref(false)

let boxSize = ref(0)

let boxes = ref([])

onMounted(() => {
    // validateAudiosOfPositions(props.selectors)
    console.log('props.size', props.size[0] * props.size[1])
    if (props.size[0] * props.size[1] < 5) {
        boxSize.value = 36
    } else if (props.size[0] * props.size[1] > 5 && props.size[0] * props.size[1] < 31) {
        boxSize.value = '64px'
    } else if (props.size[0] * props.size[1] > 31 && props.size[0] * props.size[1] < 65) {
        boxSize.value = '48px'
    } else if (props.size[0] * props.size[1] > 65) {
        boxSize.value = '38px'
    }

    document.getElementById('coinsCount').innerText = `x ${getCoins()}`
    talk(false)

    for (let i = 0; i < props.size[0] * props.size[1]; i++) {
        boxes.value.push(false)
    }

    for (let i = 0; i < items.length; i++) {
        const item = items[i];

        let audioPath = `${localHost}/audios/items/${item.name}.m4a`;

        verificarExistenciaArchivo(audioPath, function (exist) {
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


function verificarExistenciaArchivo(url, callback) {
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
    showFocusBox(props.order_to_resolve[0])
}

const showFocusBox = (id) => {
    document.getElementById(id).classList.add('animate-pulse', 'zoom-box')

    setTimeout(function () {
        document.getElementById(id).classList.remove('zoom-box')
    }, 3000)
}

// setTimeout(function () {
//     Swal.fire({
//         title: `Actividad ${props.level[1]}`,
//         text: 'Llegamos a los Sudokus! Aqui veremos un poco de pensamiento combinatorio, filas y muchos colores!',
//         icon: 'warning',
//         confirmButtonText: 'Comenzar'
//     }).then((result) => {
//         // if (result.isConfirmed) {
//         //     initialAudio();
//         //     prepareSudoku()
//         // }
//         intro();
//         prepareSudoku()
//     });
// }, 500)

setTimeout(function () {
    // intro();
    prepare()
}, 500)

let focusCols = ref([])

const prepare = () => {

    let orderArray = []

    let sudokuIds = []
    let time = 2000

    for (let i = 1; i <= (props.size[1] * props.size[0]); i++) {
        sudokuIds.push(i)
    }

    let sudokuArray = convertInArray(sudokuIds, props.size[1], props.size[0]);

    let rowsAndCols = getRowsAndCols(sudokuArray)

    let eraser = {
        "name": "Borrador",
        "type": "ERASER",
        "content": '/images/items/tools/eraser.png',
        "size": "BIG",
        "group": "Borrador"
    }

    for (let i = 0; i <= props.fill_sample.length - 1; i++) {
        let order = props.fill_sample[i] - 1
        orderArray.push(order)
        if (orderArray[i] === -1) {
            continue
        }
        let item = items[orderArray[i]]
        localStorage.setItem('itemSelected', JSON.stringify(item))

        paintItem(`sample-${i + 1}`, items)

        paintItem(`${i + 1}`, items)

        for (let colIndex = 0; colIndex <= props.select_cols.length - 1; colIndex++) {

            focusCols.value.push(rowsAndCols[1][props.select_cols[colIndex] - 1])

            for (let i = 0; i <= rowsAndCols[1][props.select_cols[colIndex] - 1].length - 1; i++) {

                document.getElementById(rowsAndCols[1][props.select_cols[colIndex] - 1][i]).classList.remove('bg-white')
                document.getElementById(rowsAndCols[1][props.select_cols[colIndex] - 1][i]).classList.replace(getSelectItem().content, 'bg-white')
                document.getElementById(rowsAndCols[1][props.select_cols[colIndex] - 1][i]).innerText = null

                document.getElementById(rowsAndCols[1][props.select_cols[colIndex] - 1][i]).classList.add('bg-gray-200', 'border-dashed')

            }
        }

        localStorage.setItem('itemSelected', null)
    }
}


let step = ref(0)
let focusBox = ref()


const validateOrder = (id) => {

    if (props.solution.includes(id)) {
        console.log('NICE')
        paintItem(id, items)
        let bubble = new Audio()
        bubble.src = `${localHost}/audios/effects/soapBubble.wav`
        bubble.play()

        step.value++

        if (step.value === props.solution.length){
            win()
        }
    } else {
        console.log('BAD')
        // document.getElementById(id).classList.add('animate-pulse', 'scale-95')
        errorPaint(id)
        let wood = new Audio()
        wood.src = `${localHost}/audios/effects/wood.wav`
        wood.play()
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

        verificarExistenciaArchivo(nextFocus, function (exist) {
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
            verificarExistenciaArchivo(rowPath, function (exist) {
                if (exist) {
                    console.log(`El ROW ${row} existe.`);
                } else {


                    resolveAudio(rowText[row - 1], row, 'positions/rows', '0.8')
                    console.log(`El ROW ${row} no existe.`);
                }
            });

            if (col !== 0) {
                verificarExistenciaArchivo(colExtPath, function (exist) {
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
                verificarExistenciaArchivo(colPath, function (exist) {
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
            }, time + 2000)

        }
    }
}

const showHelp = () => {

    if (talkBool.value) {
        return
    }

    talkBool.value = true
    let indication1 = new Audio(`${localHost}/audios/start/pattern/help/observa-colorea.m4a`)
    indication1.play()

    indication1.onended = function () {
        talkBool.value = false
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

</script>
<template>
    <div id="loadStyles" :class="`h-36 w-36 h-24 w-24 h-20 w-20 grid grid-cols-3 grid-cols-4 grid-cols-5 hidden w-10 h-10 w-9 h-9 w-8 h-8
    grid-cols-6 grid-cols-7 grid-cols-8 grid-cols-9 grid-cols-10 grid-cols-11 grid-cols-12
     ${items[0].content} ${items[1].content} ${items[2].content} ${items[3].content}`

"></div>

    <WinView id="winView" class="hidden opacity-0 duration-300"/>

    <div class="flex flex-col min-h-screen bg-red-300">
        <div class="mx-auto flex-1 container flex justify-center">
            <div class="flex bg-red-500 p-6 w-full gap-5 rounded-md">
                <div class="w-[16%] bg-red-200">
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
                            <div class="my-6 flex justify-center items-center gap-5 ">

                                <div id="fig1" :class="`grid grid-cols-${props.size[0]} gap-x-2 flex items-center justify-center duration-300`">
                                    <div :id="`sample-${i}`" @click="validateOrder(i)"
                                         v-for="i in (props.size[0] * props.size[1])" :key="i"
                                         :class="`bg-white border border-black hover:opacity-75
                                          flex justify-center items-center font-bold text-6xl select-none`"
                                          :style="`width: ${boxSize}; height: ${boxSize};`">
                                    </div>
                                </div>

                                <div id="arrow" class="flex items-center duration-300">
                                    <IconArrowRight/>
                                </div>

                                <div id="fig2" :class="`grid grid-cols-${props.size[0]} gap-x-2 flex items-center justify-center duration-300`">
                                    <div :id="i" @click="validateOrder(i)" v-for="i in (props.size[0] * props.size[1])"
                                         :key="i"
                                         :class="`bg-white border border-black hover:opacity-75
                                          flex justify-center items-center font-bold text-6xl select-none`"
                                    :style="`width: ${boxSize}; height: ${boxSize};`">
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
