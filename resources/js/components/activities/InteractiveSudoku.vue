<script setup>
import "../sections/HelpCharacter.vue";
import HelpCharacter from "../sections/HelpCharacter.vue";
import ItemPalette from "../sections/ItemPalette.vue";
import ProgressBar from "../sections/ProgressBar.vue";
import {types, localHost, sizes, getSelectItem} from '../../use';
import {onMounted, ref} from "vue";

const props = defineProps({
    size: {type: Number, required: true},
    order_to_resolve: {type: Array},
    fill_sudoku: {type: Array},
    solution: {type: Array},
    level: {type: Array},
    activity_number: {type: Number},
    level_number: {type: Number},
    selectors: {type: Array},
})

let boxSize = ref(0)
onMounted(() => {
    if (props.size === 3) {
        boxSize.value = 36
    } else if (props.size === 4) {
        boxSize.value = 24
    } else if (props.size === 5) {
        boxSize.value = 20
    }

    for (let i = 0; i < items.length; i++) {
        const item = items[i];

        let audioPath = `${localHost}/audios/items/${item.name}.mp3`;

        verificarExistenciaArchivo(audioPath, function (exist) {
            if (exist) {
                console.log('El archivo existe.');
            } else {
                // resolveAudio(item.name, item.name, 'items')
                console.log('El archivo no existe.');
            }
        });
    }

});

const resolveAudio = (text, name, path) => {
    axios.post(`${localHost}/loadAudio`, {
        text: text,
        name: name,
        path: path,
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

const items = [
    {name: 'A', type: types.letter, content: 'a'},
    // {name: 'b', type: types.letter, content: 'b'},
    // {name: 'c', type: types.letter, content: 'c'},
    // {name: 'd', type: types.letter, content: 'd'},
    {name: 'Azul', type: types.color, content: 'bg-blue-600', hex: '#2563eb'},
    {name: 'Amarillo', type: types.color, content: 'bg-yellow-400', hex: '#facc15'},
    // {name: 'eraser', type: types.eraser, content: 'bg-white'},
    // {name: 'balloon', type: types.image, content: `${localHost}/images/objects/ballon-dorado.svg`, size: sizes.small},
    // {name: 'balloon', type: types.image, content: `${localHost}/images/objects/ballon-dorado.svg`, size: sizes.normal},
    {
        name: 'Balon dorado',
        type: types.image,
        content: `${localHost}/images/objects/ballon-dorado.svg`,
        size: sizes.big
    },
]

let paintImage = ref(false)

const paintItem = (id) => {

    let itemSelected = getSelectItem()

    if (itemSelected.type === types.letter || itemSelected.type === types.number) {
        for (let i = 0; i < items.length; i++) {
            const item = items[i];
            document.getElementById(id).classList.remove(item.content)
        }
        document.getElementById(id).classList.add('bg-white')
        document.getElementById(id).innerText = itemSelected.name;
    } else if (itemSelected.type === types.color) {
        for (let i = 0; i < items.length; i++) {
            const item = items[i];
            document.getElementById(id).classList.remove(item.content)
        }
        document.getElementById(id).classList.remove('bg-white')
        document.getElementById(id).classList.add(itemSelected.content)
        document.getElementById(id).innerText = null
    } else if (itemSelected.type === types.image) {
        for (let i = 0; i < items.length; i++) {
            const item = items[i];
            document.getElementById(id).classList.remove(item.content)
        }
        document.getElementById(id).classList.add('bg-white')
        document.getElementById(id).innerText = null

        let box = document.getElementById(id);

        let imgExisting = box.querySelector('img');

        if (!imgExisting) {
            let imgExisting = document.createElement('img');

            imgExisting.src = itemSelected.content;

            if (itemSelected.size === sizes.small) {
                imgExisting.width = 50;
            } else if (itemSelected.size === sizes.normal) {
                imgExisting.width = 100;
            }

            box.appendChild(imgExisting);
        }

    }
}

const intro = () => {
    document.getElementById(props.order_to_resolve[0]).classList.add('animate-pulse')
}

setTimeout(function () {
    intro()
    prepareSudoku()
}, 500)

const errorPaint = (id) => {
    let box = document.getElementById(id)
    box.classList.add('duration-300')
    box.classList.add('opacity-25')
    box.classList.add('brush-fail')
    setTimeout(function () {
        box.classList.remove('opacity-25')
        box.classList.remove('brush-fail')
    }, 500)
}

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
        paintItem(i + 1)
    }
}

let step = ref(0)
let focusBox = ref()
const validateOrder = (id) => {
    focusBox.value = props.order_to_resolve[step.value]

    let box = document.getElementById(`${props.order_to_resolve[step.value]}`)
    let nextBox = document.getElementById(`${props.order_to_resolve[step.value + 1]}`)

    if (focusBox.value === id) {

        let itemSelected = getSelectItem()

        let item = items[props.solution[step.value] - 1]


        if (item.name === itemSelected.name) {
            if (nextBox) {
                nextBox.classList.add('animate-pulse')
            } else {
                document.getElementById('nextLevelButton').classList.remove('hidden')
            }

            box.classList.remove('animate-pulse')

            let bubble = new Audio()
            bubble.src = `${localHost}/audios/effects/soapBubble.wav`
            bubble.play()

            paintItem(id)

            if (props.selectors) {
                selector(props.selectors[step.value][0], props.selectors[step.value][1], nextBox)
            }

            step.value++
        } else {
            errorPaint(id)
        }
    } else {
        errorPaint(id)
    }

}


const selector = (row, col, nextBox) => {

    nextBox.classList.remove('animate-pulse')
    let sudokuIds = []
    let time = 3000

    for (let i = 1; i <= (props.size * props.size); i++) {
        sudokuIds.push(i)
    }

    let sudokuArray = convertInArray(sudokuIds, props.size, props.size);

    let rowsAndCols = getRowsAndCols(sudokuArray)

    for (let i = 0; i <= props.size - 1; i++) {
        const selectRow = () => {
            if (row) {
                document.getElementById(rowsAndCols[0][row - 1][i]).classList.add('duration-300', 'scale-75')
                setTimeout(function () {
                    document.getElementById(rowsAndCols[0][row - 1][i]).classList.remove('scale-75')
                }, time)
            }
        }

        const selectCol = () => {
            if (col) {
                document.getElementById(rowsAndCols[1][col - 1][i]).classList.add('duration-300', 'scale-75')
                setTimeout(function () {
                    document.getElementById(rowsAndCols[1][col - 1][i]).classList.remove('scale-75')
                }, time)
            }
        }

        if (row) {
            selectRow()

            if (col) {
                setTimeout(function () {
                    selectCol()
                    setTimeout(function () {
                        nextBox.classList.add('animate-pulse')
                    }, time)
                }, time + 500)
            } else {
                setTimeout(function () {
                    nextBox.classList.add('animate-pulse')
                }, time)
            }

        } else {
            selectCol()
            setTimeout(function () {
                nextBox.classList.add('animate-pulse')
            }, time)
        }

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
                    <div class="bg-red-500 flex justify-center items-center row-span-3">
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
