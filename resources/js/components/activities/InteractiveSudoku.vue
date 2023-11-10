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
    level_number: {type: Number}
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
        console.log(item)

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
    {name: 'Balon dorado', type: types.image, content: `${localHost}/images/objects/ballon-dorado.svg`, size: sizes.big},
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
            step.value++
        } else {
            errorPaint(id)
        }
    } else {
        errorPaint(id)
    }

}

</script>
<template>
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
