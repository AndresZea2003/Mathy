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
    size: {type: Number},
    fill_sample: {type: Array},
    solution: {type: Array},
    level: {type: Array},
    items: {type: Array},
    rotate: {type: Boolean},
})

let talkBool = ref(false)

let boxSize = ref(0)

let boxes = ref([])

onMounted(() => {
    // validateAudiosOfPositions(props.selectors)
    if (props.size < 5) {
        boxSize.value = 46
    } else if (props.size >= 5 && props.size < 10) {
        boxSize.value = 34
    } else if (props.size >= 10 && props.size < 12) {
        boxSize.value = 30
    } else if (props.size >= 12 && props.size < 20) {
        boxSize.value = 22
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
// const items = [
//
//     // {name: 'muy bien', type: types.letter, content: 'a'},
//     // {name: 'correcto', type: types.letter, content: 'a'},
//     // {name: 'exacto', type: types.letter, content: 'a'},
//     // {name: 'excelente', type: types.letter, content: 'a'},
//     // {name: 'Perfecto', type: types.letter, content: 'a'},
//     // {name: 'genial', type: types.letter, content: 'a'},
//     // {name: 'brillante', type: types.letter, content: 'a'},
//     // {name: 'fantastico', type: types.letter, content: 'a'},
//
//
//     // {name: '3', type: types.number, content: '3'},
//
//     {name: 'A', type: types.letter, content: 'a', group: 'Letra'},
//
//
//     // {name: 'B', type: types.letter, content: 'b'},
//     // {name: 'c', type: types.letter, content: 'c'},
//     // {name: 'd', type: types.letter, content: 'd'},
//
//     {name: 'Azul', type: types.color, content: 'bg-blue-600', hex: '#2563eb', group: 'Color'},
//     {name: 'Amarillo', type: types.color, content: 'bg-yellow-400', hex: '#facc15', group: 'Color'},
//
//
//     // {name: 'eraser', type: types.eraser, content: 'bg-white'},
//     // {name: 'balloon', type: types.image, content: `${localHost}/images/objects/ballon-dorado.svg`, size: sizes.small},
//     // {name: 'balloon', type: types.image, content: `${localHost}/images/objects/ballon-dorado.svg`, size: sizes.normal},
//
//
//     {
//         name: 'Balon dorado',
//         type: types.image,
//         content: `${localHost}/images/objects/ballon-dorado.svg`,
//         size: sizes.big,
//         group: 'Imagen'
//     },
// ]

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
        paintItem(`${i + 1}`, items)

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

    paintItem(id, items)

    // let itemSelected = getSelectItem()
    //
    // if (itemSelected.type === types.eraser) {
    //     errorPaint(id)
    //     return
    // }
    //
    // if (itemSelected.content === items[(props.fill_sample[id - 1]) - 1].content) {
    //     paintItem(id, items)
    //
    //     let bubble = new Audio()
    //     bubble.src = `${localHost}/audios/effects/soapBubble.wav`
    //     bubble.play()
    //
    //     document.getElementById(id).classList.remove('animate-pulse', 'scale-95')
    //
    //     boxes.value[id - 1] = true
    //
    //     for (let i = 0; i < props.size[0] * props.size[1]; i++) {
    //         if (boxes.value[i] === true) {
    //             row.value++
    //         }
    //     }
    //     console.log(row.value)
    //
    //     if (row.value === props.size[0] * props.size[1]) {
    //         win()
    //     }
    //     row.value = 0
    //
    // } else {
    //     paintItem(id, items)
    //
    //     let bubble = new Audio()
    //     bubble.src = `${localHost}/audios/effects/wood.wav`
    //     bubble.play()
    //
    //     boxes.value[id - 1] = false
    //
    //     document.getElementById(id).classList.add('animate-pulse', 'scale-95')
    // }
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

</script>
<template>
    <div id="loadStyles" :class="`h-36 w-36 h-24 w-24 h-20 w-20 grid grid-cols-3 grid-cols-4 grid-cols-5 hidden
    grid-cols-6 grid-cols-7 grid-cols-8 grid-cols-9 grid-cols-10 grid-cols-11 grid-cols-12
     ${items[0].content} ${items[1].content} ${items[2].content} ${items[3].content}`

"></div>

    <WinView id="winView" class="hidden opacity-0 duration-300"/>

    <div class="flex flex-col min-h-screen bg-green-300">
        <div class="mx-auto flex-1 container flex justify-center">
            <div class="flex bg-green-500 p-6 w-full gap-5 rounded-md grid grid-cols-5">
                <div class="col-span-4 grid grid-cols-4 gap-5 grid-rows-3">

                    <div class="flex col-span-4 gap-5 row-span-2 grid grid-cols-4">
                        <div @click="showItemsPresentation()" class="bg-red-200">
                            <HelpCharacter class="" :image="`${localHost}/images/characters/robot/normal.png`"
                                           :image_2="`${localHost}/images/characters/robot/talk.gif`"
                            />
                        </div>
                        <div id="dat" class="col-span-3 bg-red-200 p-5 grid flex">
                            <ProgressBar :planet_1="`${localHost}/images/planets/tierra.svg`"
                                         :planet_2="`${localHost}/images/planets/rojo.svg`"
                                         :rocket="`${localHost}/images/rockets/1.svg`"
                                         :activity_number="props.level[1]"
                            />
                        </div>
                    </div>

                    <div class="col-span-4 flex justify-center items-center bg-rose-200">
                        <div>
                            <div class="my-6 flex justify-center gap-5">
                                <div id="sample-img" :class="`flex`">
                                    <div :id="`${i}`" @click="validateOrder(i)"
                                         v-for="i in props.size" :key="i"
                                         :class="`bg-white border border-black hover:opacity-75 w-14 h-14
                                          flex justify-center items-center font-bold text-6xl select-none h-${boxSize} w-${boxSize}`">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="">
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
