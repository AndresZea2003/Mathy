<script setup>
import "../sections/HelpCharacter.vue";
import HelpCharacter from "../sections/HelpCharacter.vue";
import ItemPalette from "../sections/ItemPalette.vue";
import ProgressBar from "../sections/ProgressBar.vue";
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
import Swal from "sweetalert2";

const props = defineProps({
    size: {type: Number, required: true},
    order_to_resolve: {type: Array},
    fill_sudoku: {type: Array},
    solution: {type: Array},
    level: {type: Array},
    activity_number: {type: Number},
    level_number: {type: Number},
    selectors: {type: Array},
    items: {type: Array},
})

let talkBool = ref(false)

let boxSize = ref(0)

onMounted(() => {
    validateAudiosOfPositions(props.selectors)
    document.getElementById('coinsCount').innerText = `x ${getCoins()}`
    talk(false)
    if (props.size === 3) {
        boxSize.value = 36
    } else if (props.size === 4) {
        boxSize.value = 24
    } else if (props.size === 5) {
        boxSize.value = 20
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

    document.getElementById(props.order_to_resolve[0]).classList.add('animate-pulse')
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
    intro();
    prepareSudoku()
}, 500)

const prepareSudoku = () => {

    let orderArray = []
    for (let i = 0; i <= (props.size * props.size) - 1; i++) {
        let order = props.fill_sudoku[i] - 1
        orderArray.push(order)
        if (orderArray[i] === -1) {
            continue
        }
        let item = items[orderArray[i]]
        localStorage.setItem('itemSelected', JSON.stringify(item))
        paintItem(i + 1, items)
    }
}

let step = ref(0)
let focusBox = ref()
const validateOrder = (id) => {

    focusBox.value = props.order_to_resolve[step.value]

    let box = document.getElementById(`${props.order_to_resolve[step.value]}`)
    let nextBox = document.getElementById(`${props.order_to_resolve[step.value + 1]}`)

    if (focusBox.value === id && talkBool.value === false) {

        let itemSelected = getSelectItem()

        let item = items[props.solution[step.value] - 1]


        if (item.name === itemSelected.name) {

            let successes = new Audio(`${localHost}/audios/successes/muybien.m4a`)

            let ext = new Audio()
            let showExt = true

            if (item.type === types.letter) {
                ext.src = `${localHost}/audios/items/extensions/La letra.wav`
            } else if (item.type === types.number) {
                ext.src = `${localHost}/audios/items/extensions/El numero.wav`
            } else if (item.type === types.color) {
                ext.src = `${localHost}/audios/items/extensions/El color.wav`
            } else {
                showExt = false
            }


            let itemSound = new Audio(`${localHost}/audios/items/${item.name}.m4a`)
            let explainSound = new Audio(`${localHost}/audios/explanations/erafaltanteparacompletar.m4a`)

            talkBool.value = true
            talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`)

            successes.play()

            successes.onended = function () {
                if (showExt) {
                    ext.play()
                } else {
                    itemSound.play()
                }
            };

            ext.onended = function () {
                itemSound.play()
            };

            itemSound.onended = function () {
                explainSound.play()
            };

            explainSound.onended = function () {
                if (props.selectors) {
                    selector(props.selectors[step.value][0], props.selectors[step.value][1], nextBox, item, false)
                }
                step.value++

            }

            box.classList.remove('animate-pulse')

            let bubble = new Audio()
            bubble.src = `${localHost}/audios/effects/soapBubble.wav`
            bubble.play()

            paintItem(id, items)

        } else {
            errorPaint(id)
            let errorSound = new Audio(`${localHost}/audios/effects/wood.wav`)
            errorSound.play()

            talkBool.value = true
            talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`)

            let ext = new Audio()
            let showExt = true

            let itemError = getSelectItem()

            if (itemError.type === types.letter) {
                ext.src = `${localHost}/audios/items/extensions/La letra.wav`
            } else if (itemError.type === types.number) {
                ext.src = `${localHost}/audios/items/extensions/El numero.wav`
            } else if (itemError.type === types.color) {
                ext.src = `${localHost}/audios/items/extensions/El color.wav`
            } else {
                showExt = false
            }

            let failed = new Audio(`${localHost}/audios/failed/buenintentopero.m4a`)
            let itemSound = new Audio(`${localHost}/audios/items/${itemError.name}.m4a`)
            let failedExplainSound = new Audio(`${localHost}/audios/explanations/errors/yaseencuentra.m4a`)

            failed.play()

            failed.onended = function () {
                if (showExt) {
                    ext.play()
                } else {
                    itemSound.play()
                }
            };

            ext.onended = function () {
                itemSound.play()
            };

            itemSound.onended = function () {
                failedExplainSound.play()
            };

            failedExplainSound.onended = function () {
                if (props.selectors) {
                    selector(props.selectors[step.value][0], props.selectors[step.value][1], nextBox, item, true)
                } else {
                    errorPaint(id)
                }
            }


        }
    } else {
        errorPaint(id)
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
                    nextBox.classList.add('animate-pulse')
                } else {
                    win()
                }
            }
        } else {
            talkBool.value = false
            talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`)
            win()
        }
    }
}

const win = () => {

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

    setTimeout(function () {
        document.getElementById('nextLevelButton').classList.remove('hidden')
    }, 2800)
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
            time = time + 2000
        } else if (i === 3) {
            time = time + 4000
        } else if (i === 4) {
            time = time + 6000
        } else if (i === 5) {
            time = time + 8000
        }


        if (items[i].type === types.image) {

            setTimeout(function () {
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

            setTimeout(function () {
                box.innerText = items[i].name
            }, time)

            setTimeout(function () {
                box.innerText = null
            }, time + 2000)
        } else if (items[i].type === types.color) {
            setTimeout(function () {
                box.classList.replace('bg-gray-200', items[i].content)
            }, time)

            setTimeout(function () {
                box.classList.replace(items[i].content, 'bg-gray-200')
            }, time + 2000)
        }

        if (i === items.length - 1){
            box.classList.remove('hidden')
        }
    }

}

</script>
<template>
    <div id="loadStyles" :class="`h-36 w-36 h-24 w-24 h-20 w-20 grid grid-cols-3 grid-cols-4 grid-cols-5 hidden
    grid-cols-6 grid-cols-7 grid-cols-8 grid-cols-9 grid-cols-10 grid-cols-11 grid-cols-12
     ${items[0].content} ${items[1].content} ${items[2].content} ${items[3].content}`

"></div>
    <div class="flex flex-col min-h-screen bg-orange-300">
        <div class="mx-auto flex-1 container flex justify-center">
            <div class="flex bg-orange-600 p-6 w-full gap-5 rounded-md">
                <div class="w-[16%] bg-red-200">
                    <HelpCharacter :image="`${localHost}/images/characters/robot/normal.png`"
                                   :image_2="`${localHost}/images/characters/robot/talk.gif`" class=""/>
                </div>
                <div id="dat" class="w-[68%] bg-red-200 p-5 grid grid-rows-4">
                    <ProgressBar :planet_1="`${localHost}/images/planets/tierra.svg`"
                                 :planet_2="`${localHost}/images/planets/rojo.svg`"
                                 :rocket="`${localHost}/images/rockets/1.svg`"
                                 :activity_number="props.level[1]"
                    />
                    <div class="bg-red-400 flex justify-center items-center row-span-3">
                        <div>
                            <div class="my-6 flex justify-center">

                                <div :class="`grid grid-cols-${props.size}`">
                                    <div :id="i" @click="validateOrder(i)" v-for="i in props.size * props.size" :key="i"
                                         :class="`bg-white border border-black hover:opacity-75
                                          flex justify-center items-center font-bold text-6xl select-none h-${boxSize} w-${boxSize}`">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-[16%] bg-red-200">
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
</style>
