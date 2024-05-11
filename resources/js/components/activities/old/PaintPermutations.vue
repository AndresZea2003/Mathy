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
import BackgroundActivities from "../background/BackgroundActivities.vue";

const props = defineProps({
    size: {type: Array},
    solution: {type: Array},
    level: {type: Array},
    items: {type: Array},
    rotate: {type: Boolean},
    order_to_resolve: {type: Array},
    fill_sample: {type: Array},
})

let talkBool = ref(false)

let boxSize = ref(0)

let boxes = ref([false, false, false])

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

    // document.getElementById('coinsCount').innerText = `x ${getCoins()}`

    talk(false)

    // for (let i = 0; i < props.size[0] * props.size[1]; i++) {
    //     boxes.value.push(false)
    // }

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

    let introductionAudio = new Audio(`${localHost}/audios/start/permutations/introduction/vamosencontrarmanerasordenar.m4a`)

    introductionAudio.play()

    introductionAudio.onended = function () {
        showItemsPresentation(true)
    }
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
        text: 'Llegamos a los Permutaciones! Aqui veremos un poco de pensamiento combinatorio, filas y muchos colores!',
        icon: 'warning',
        confirmButtonText: 'Comenzar'
    }).then((result) => {
        // if (result.isConfirmed) {
        //     initialAudio();
        //     prepareSudoku()
        // }
        // intro();
        consoleLog()
        prepare()
    });
}, 500)

// setTimeout(function () {
//     intro();
//     prepare()
// }, 500)

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


        document.getElementById(`${i + 1}`).classList.replace(getSelectItem().content, 'bg-white')
        // if (props.order_to_resolve.includes(i + 1)) {
        //     document.getElementById(`${i + 1}`).classList.replace(getSelectItem().content, 'bg-white')
        // }else {
        //     paintItem(`${i + 1}`, items)
        // }

        localStorage.setItem('itemSelected', JSON.stringify(null))
        document.getElementById(`${i + 1}`).classList.add('duration-300')

        if (i > 2) {
            // Usar aqui para omitir los primeros 3
        }

        document.getElementById(`${i + 1}`).classList.replace('hover:opacity-75', 'opacity-0')
        document.getElementById(`${19}`).classList.replace('hover:opacity-75', 'opacity-0')
        document.getElementById(`${20}`).classList.replace('hover:opacity-75', 'opacity-0')
        document.getElementById(`${21}`).classList.replace('hover:opacity-75', 'opacity-0')
    }

    if (props.rotate) {
        document.getElementById('sample-img').classList.add('rotate-45', 'scale-75')

        document.getElementById('activity-img').classList.add('rotate-45', 'scale-75')
    }

}

let step = ref(0)
let focusBox = ref()
let trys = ref(0)
let focusLastRow = ref(false)

const validateOrder = (id) => {



    let itemSelected = getSelectItem()

    if (itemSelected.type === types.eraser) {
        errorPaint(id)
        return
    }


    if (focusLastRow.value) {

        console.log(id)
        if (id === 19) {
            boxes.value[0] = true
            paintItem(id, items)

        } else if (id === 20) {

            boxes.value[1] = true
            paintItem(id, items)

        } else if (id === 21) {

            paintItem(id, items)
            boxes.value[2] = true
        } else {
            errorPaint(id)
        }

        console.log(boxes.value)
        if (boxes.value[0] === true && boxes.value[1] === true && boxes.value[2] === true) {

            errorPaint(`${19}`)
            errorPaint(`${20}`)
            errorPaint(`${21}`)

            let wood = new Audio()
            wood.src = `${localHost}/audios/effects/wood.wav`
            wood.play()

            let error1 = new Audio(`${localHost}/audios/permutations/errors/1.m4a`)
            let error2 = new Audio(`${localHost}/audios/permutations/errors/2.m4a`)
            let error3 = new Audio(`${localHost}/audios/permutations/errors/3.m4a`)

            if (trys.value === 0) {
                console.log('nope')

                focusLastRow.value = false

                error1.play()

                error1.onended = function () {
                    boxes.value[0] = false
                    boxes.value[1] = false
                    boxes.value[2] = false

                    for (let i = 0; i < items.length; i++) {
                        const item = items[i];
                        document.getElementById(`${19}`).classList.remove(item.content)
                        document.getElementById(`${20}`).classList.remove(item.content)
                        document.getElementById(`${21}`).classList.remove(item.content)

                    }

                    document.getElementById(`${19}`).classList.add('bg-white')
                    document.getElementById(`${20}`).classList.add('bg-white')
                    document.getElementById(`${21}`).classList.add('bg-white')
                    focusLastRow.value = true
                }
            }

            if (trys.value === 1) {
                console.log('Casi')

                focusLastRow.value = false

                error2.play()

                error2.onended = function () {
                    boxes.value[0] = false
                    boxes.value[1] = false
                    boxes.value[2] = false

                    for (let i = 0; i < items.length; i++) {
                        const item = items[i];
                        document.getElementById(`${19}`).classList.remove(item.content)
                        document.getElementById(`${20}`).classList.remove(item.content)
                        document.getElementById(`${21}`).classList.remove(item.content)

                    }

                    document.getElementById(`${19}`).classList.add('bg-white')
                    document.getElementById(`${20}`).classList.add('bg-white')
                    document.getElementById(`${21}`).classList.add('bg-white')
                    focusLastRow.value = true
                }
            }

            if (trys.value === 2) {

                error3.play()

                focusLastRow.value = false

                error3.onended = function () {
                    win()
                }


            }

            trys.value++

        }

        return;

    }

    focusBox.value = props.order_to_resolve[step.value]

    let box = document.getElementById(`${props.order_to_resolve[step.value]}`)
    let nextBox = document.getElementById(`${props.order_to_resolve[step.value + 1]}`)

    let audioOk1 = new Audio(`${localHost}/audios/permutations/successes/1.m4a`)
    let audioOk2 = new Audio(`${localHost}/audios/successes/genial.m4a`)
    let audioOk3 = new Audio(`${localHost}/audios/successes/asisehace.m4a`)
    let audioOk4 = new Audio(`${localHost}/audios/permutations/successes/2.m4a`)
    let audioOk5 = new Audio(`${localHost}/audios/permutations/successes/3.m4a`)

    let audioItem1 = new Audio(`${localHost}/audios/items/${items[0].name}.m4a`)
    let audioItem2 = new Audio(`${localHost}/audios/items/${items[1].name}.m4a`)
    let audioItem3 = new Audio(`${localHost}/audios/items/${items[2].name}.m4a`)

    let question1 = new Audio(`${localHost}/audios/items/questions/${items[0].group}/1.m4a`)
    let question2 = new Audio(`${localHost}/audios/items/questions/${items[0].group}/2.m4a`)

    let explainAudio1 = new Audio(`${localHost}/audios/permutations/5.m4a`)
    let explainAudio2 = new Audio(`${localHost}/audios/permutations/6.m4a`)
    let explainAudio3 = new Audio(`${localHost}/audios/permutations/7.m4a`)
    let explainAudio4 = new Audio(`${localHost}/audios/permutations/8.m4a`)
    let explainAudio5 = new Audio(`${localHost}/audios/permutations/9.m4a`)

    let error1 = 'Error 1'
    let error2 = 'Error 2'

    let error = 'Sin asignar'

    if (focusBox.value === id && talkBool.value === false) {
        paintItem(id, items)

        let item = items[props.solution[step.value] - 1]


        if (item.name === itemSelected.name) {
            let bubble = new Audio()
            bubble.src = `${localHost}/audios/effects/soapBubble.wav`
            bubble.play()

            box.classList.remove('animate-pulse')


            setTimeout(function () {
                nextBox.classList.remove('zoom-box')
            }, 3000)

            step.value++

            if (step.value === 1) {

                audioOk1.play()

                audioOk1.onended = function () {
                    audioItem1.play()
                    document.getElementById(`${4}`).classList.replace('opacity-0', 'hover:opacity-75')
                    localStorage.setItem('itemSelected', JSON.stringify(items[0]))
                    paintItem(`${4}`, items)
                }

                audioItem1.onended = function () {
                    question2.play()
                    document.getElementById(`${5}`).classList.replace('opacity-0', 'hover:opacity-75')
                }

                question2.onended = function () {
                    showFocusBox(`${props.order_to_resolve[step.value]}`)
                }

            } else if (step.value === 2) {

                audioOk2.play()

                audioOk2.onended = function () {
                    question1.play()
                    showFocusBox(`${props.order_to_resolve[step.value]}`)
                    document.getElementById(`${6}`).classList.replace('opacity-0', 'hover:opacity-75')
                }

            } else if (step.value === 3) {

                audioOk3.play()

                audioOk3.onended = function () {
                    explainAudio1.play()

                    setTimeout(function () {
                        document.getElementById(`${1}`).classList.add('scale-75', 'opacity-75')
                        document.getElementById(`${2}`).classList.add('scale-75', 'opacity-75')
                        document.getElementById(`${3}`).classList.add('scale-75', 'opacity-75')
                    }, 1000)

                    setTimeout(function () {
                        document.getElementById(`${4}`).classList.add('scale-75', 'opacity-75')
                        document.getElementById(`${5}`).classList.add('scale-75', 'opacity-75')
                        document.getElementById(`${6}`).classList.add('scale-75', 'opacity-75')

                        setTimeout(function () {
                            document.getElementById(`${1}`).classList.remove('scale-75', 'opacity-75')
                            document.getElementById(`${2}`).classList.remove('scale-75', 'opacity-75')
                            document.getElementById(`${3}`).classList.remove('scale-75', 'opacity-75')
                            document.getElementById(`${4}`).classList.remove('scale-75', 'opacity-75')
                            document.getElementById(`${5}`).classList.remove('scale-75', 'opacity-75')
                            document.getElementById(`${6}`).classList.remove('scale-75', 'opacity-75')
                        }, 1400)
                    }, 1600)
                }

                explainAudio1.onended = function () {
                    audioItem1.play()
                    document.getElementById(`${1}`).classList.add('scale-75', 'opacity-75')
                }


                audioItem1.onended = function () {
                    document.getElementById(`${1}`).classList.remove('scale-75', 'opacity-75')
                    audioItem3.play()
                    document.getElementById(`${2}`).classList.add('scale-75', 'opacity-75')
                }

                audioItem3.onended = function () {
                    document.getElementById(`${2}`).classList.remove('scale-75', 'opacity-75')
                    audioItem2.play()
                    document.getElementById(`${3}`).classList.add('scale-75', 'opacity-75')
                }

                audioItem2.onended = function () {
                    document.getElementById(`${3}`).classList.remove('scale-75', 'opacity-75')
                    explainAudio2.play()
                }

                explainAudio2.onended = function () {
                    audioItem1.play()
                    document.getElementById(`${4}`).classList.add('scale-75', 'opacity-75')

                    audioItem1.onended = function () {
                        document.getElementById(`${4}`).classList.remove('scale-75', 'opacity-75')
                        audioItem2.play()
                        document.getElementById(`${5}`).classList.add('scale-75', 'opacity-75')
                    }

                    audioItem2.onended = function () {
                        document.getElementById(`${5}`).classList.remove('scale-75', 'opacity-75')
                        audioItem3.play()
                        document.getElementById(`${6}`).classList.add('scale-75', 'opacity-75')
                    }

                    audioItem3.onended = function () {
                        document.getElementById(`${6}`).classList.remove('scale-75', 'opacity-75')
                        explainAudio3.play()
                    }
                }

                explainAudio3.onended = function () {
                    audioItem3.play()
                    document.getElementById(`${7}`).classList.replace('opacity-0', 'hover:opacity-75')
                    localStorage.setItem('itemSelected', JSON.stringify(items[2]))
                    paintItem(`${7}`, items)

                    audioItem3.onended = function () {
                        localStorage.setItem('itemSelected', JSON.stringify(items[1]))
                        paintItem(`${8}`, items)
                        audioItem2.play()
                        document.getElementById(`${8}`).classList.replace('opacity-0', 'hover:opacity-75')

                    }

                    audioItem2.onended = function () {
                        question1.play()
                        document.getElementById(`${9}`).classList.replace('opacity-0', 'hover:opacity-75')
                        showFocusBox(`${props.order_to_resolve[step.value]}`)
                    }
                }

            } else if (step.value === 4) {

                audioOk4.play()

                audioOk4.onended = function () {
                    document.getElementById(`${10}`).classList.replace('opacity-0', 'hover:opacity-75')
                    audioItem3.play()
                    localStorage.setItem('itemSelected', JSON.stringify(items[2]))
                    paintItem(`${10}`, items)
                }

                audioItem3.onended = function () {
                    question2.play()
                    document.getElementById(`${11}`).classList.replace('opacity-0', 'hover:opacity-75')
                }

                question2.onended = function () {
                    showFocusBox(`${props.order_to_resolve[step.value]}`)
                }

            } else if (step.value === 5) {
                audioOk2.play()

                audioOk2.onended = function () {
                    question1.play()
                    document.getElementById(`${12}`).classList.replace('opacity-0', 'hover:opacity-75')
                }

                question1.onended = function () {
                    showFocusBox(`${props.order_to_resolve[step.value]}`)
                }

            } else if (step.value === 6) {

                explainAudio4.play()

                setTimeout(function () {
                    document.getElementById(`${1}`).classList.add('scale-75', 'opacity-75')
                    document.getElementById(`${2}`).classList.add('scale-75', 'opacity-75')
                    document.getElementById(`${3}`).classList.add('scale-75', 'opacity-75')
                    document.getElementById(`${4}`).classList.add('scale-75', 'opacity-75')
                    document.getElementById(`${5}`).classList.add('scale-75', 'opacity-75')
                    document.getElementById(`${6}`).classList.add('scale-75', 'opacity-75')
                    document.getElementById(`${7}`).classList.add('scale-75', 'opacity-75')
                    document.getElementById(`${8}`).classList.add('scale-75', 'opacity-75')
                    document.getElementById(`${9}`).classList.add('scale-75', 'opacity-75')
                    document.getElementById(`${10}`).classList.add('scale-75', 'opacity-75')
                    document.getElementById(`${11}`).classList.add('scale-75', 'opacity-75')
                    document.getElementById(`${12}`).classList.add('scale-75', 'opacity-75')

                    setTimeout(function () {
                        document.getElementById(`${1}`).classList.remove('scale-75', 'opacity-75')
                        document.getElementById(`${2}`).classList.remove('scale-75', 'opacity-75')
                        document.getElementById(`${3}`).classList.remove('scale-75', 'opacity-75')
                        document.getElementById(`${4}`).classList.remove('scale-75', 'opacity-75')
                        document.getElementById(`${5}`).classList.remove('scale-75', 'opacity-75')
                        document.getElementById(`${6}`).classList.remove('scale-75', 'opacity-75')
                        document.getElementById(`${7}`).classList.remove('scale-75', 'opacity-75')
                        document.getElementById(`${8}`).classList.remove('scale-75', 'opacity-75')
                        document.getElementById(`${9}`).classList.remove('scale-75', 'opacity-75')
                        document.getElementById(`${10}`).classList.remove('scale-75', 'opacity-75')
                        document.getElementById(`${11}`).classList.remove('scale-75', 'opacity-75')
                        document.getElementById(`${12}`).classList.remove('scale-75', 'opacity-75')
                    }, 1600)
                }, 1800)

                explainAudio4.onended = function () {
                    audioItem2.play()
                    document.getElementById(`${13}`).classList.replace('opacity-0', 'hover:opacity-75')
                    localStorage.setItem('itemSelected', JSON.stringify(items[1]))
                    paintItem(`${13}`, items)
                }

                audioItem2.onended = function () {
                    audioItem1.play()
                    document.getElementById(`${14}`).classList.replace('opacity-0', 'hover:opacity-75')
                    localStorage.setItem('itemSelected', JSON.stringify(items[0]))
                    paintItem(`${14}`, items)
                }

                audioItem1.onended = function () {
                    question1.play()
                    document.getElementById(`${15}`).classList.replace('opacity-0', 'hover:opacity-75')
                }

                question1.onended = function () {
                    showFocusBox(`${props.order_to_resolve[step.value]}`)
                }

            } else if (step.value === 7) {

                audioOk5.play()

                audioOk5.onended = function () {
                    audioItem2.play()
                    document.getElementById(`${16}`).classList.replace('opacity-0', 'hover:opacity-75')
                    localStorage.setItem('itemSelected', JSON.stringify(items[1]))
                    paintItem(`${16}`, items)
                }

                audioItem2.onended = function () {
                    question2.play()
                    document.getElementById(`${17}`).classList.replace('opacity-0', 'hover:opacity-75')
                }

                question2.onended = function () {
                    showFocusBox(`${props.order_to_resolve[step.value]}`)
                }
            } else if (step.value === 8) {

                audioOk2.play()

                audioOk2.onended = function () {
                    question1.play()
                    document.getElementById(`${18}`).classList.replace('opacity-0', 'hover:opacity-75')
                }
            } else if (step.value === 9) {
                explainAudio5.play()

                explainAudio5.onended = function () {
                    lastRow()
                }
            }

            // if (!nextBox) {
            //     lastRow()
            //     // win()
            // }

        } else {
            let wood = new Audio()
            wood.src = `${localHost}/audios/effects/wood.wav`
            wood.play()

            showError()
        }

    } else {
        errorPaint(id)

        let wood = new Audio()
        wood.src = `${localHost}/audios/effects/wood.wav`
        wood.play()
    }

    function showError() {

        console.log(error, `paso`, `${step.value}`)

        console.log('Items selected :', itemSelected.name, items[0].name)

        // azul item 0
        // verde item 1
        // rojo item 2

        let errorRow = new Audio(`${localHost}/audios/permutations/errors/color/row.m4a`)
        let errorBackRow = new Audio(`${localHost}/audios/permutations/errors/color/backrow.m4a`)

        let compareId = ref(null)
        if (step.value === 0) {
            talkBool.value = true
            if (itemSelected.name === items[0].name) {
                // [x, - , o]
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 1
            } else if (itemSelected.name === items[2].name) {
                // [-, x , o]
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 2
            }

        } else if (step.value === 1) {
            talkBool.value = true
            if (itemSelected.name === items[0].name) {
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                // [-, - , -]
                // [x, o , ?]
                compareId.value = 4
            } else if (itemSelected.name === items[2].name) {
                // [-, x , -]
                // [-, o , ?]
                // Compara con fila anterior
                errorBackRow.play()
                errorBackRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 2
            }

        } else if (step.value === 2) {
            talkBool.value = true
            if (itemSelected.name === items[0].name) {
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 4
            } else if (itemSelected.name === items[1].name) {
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 5
            }

        } else if (step.value === 3) {
            talkBool.value = true
            if (itemSelected.name === items[1].name) {
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 8
            } else if (itemSelected.name === items[2].name) {
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 7
            }
        } else if (step.value === 4) {
            talkBool.value = true
            if (itemSelected.name === items[1].name) {
                // Compara fila anterior
                errorBackRow.play()
                errorBackRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 8
            } else if (itemSelected.name === items[2].name) {
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 10
            }

        } else if (step.value === 5) {
            talkBool.value = true
            if (itemSelected.name === items[0].name) {
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 11
            } else if (itemSelected.name === items[2].name) {
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 10
            }

        } else if (step.value === 6) {
            talkBool.value = true
            if (itemSelected.name === items[0].name) {
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 14
            } else if (itemSelected.name === items[1].name) {
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 13
            }
        } else if (step.value === 7) {
            talkBool.value = true
            if (itemSelected.name === items[0].name) {
                // comparara con fila anterior
                errorBackRow.play()
                errorBackRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 14
            } else if (itemSelected.name === items[1].name) {
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 16
            }

        } else if (step.value === 8) {
            talkBool.value = true
            if (itemSelected.name === items[1].name) {
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 16
            } else if (itemSelected.name === items[2].name) {
                errorRow.play()
                errorRow.onended = function () {
                    talkBool.value = false
                }
                compareId.value = 17
            }
        }

        document.getElementById(id).classList.remove('animate-pulse')

        document.getElementById(id).classList.add('scale-75', 'opacity-75')
        document.getElementById(`${compareId.value}`).classList.add('scale-75', 'opacity-75')

        setTimeout(function () {
            document.getElementById(id).classList.remove('scale-75', 'opacity-75')
            document.getElementById(`${compareId.value}`).classList.remove('scale-75', 'opacity-75')
            document.getElementById(id).classList.add('animate-pulse')
        }, 2000)
    }

    function lastRow() {
        document.getElementById(`${19}`).classList.replace('opacity-0', 'hover:opacity-75')
        document.getElementById(`${20}`).classList.replace('opacity-0', 'hover:opacity-75')
        document.getElementById(`${21}`).classList.replace('opacity-0', 'hover:opacity-75')

        focusLastRow.value = true
        zoomLastRow()
    }

    function zoomLastRow() {
        document.getElementById(`${19}`).classList.add('animate-pulse', 'zoom-box')
        document.getElementById(`${20}`).classList.add('animate-pulse', 'zoom-box')
        document.getElementById(`${21}`).classList.add('animate-pulse', 'zoom-box')

        setTimeout(function () {
            document.getElementById(`${19}`).classList.remove('animate-pulse', 'zoom-box')
            document.getElementById(`${20}`).classList.remove('animate-pulse', 'zoom-box')
            document.getElementById(`${21}`).classList.remove('animate-pulse', 'zoom-box')
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

    let winAudio = new Audio(`${localHost}/audios/permutations/win/1.m4a`)
    winAudio.play()

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

const showItemsPresentation = (showFocus) => {

    let box = document.getElementById('itemPresentation')

    box.classList.remove('hidden')

    let time = 0
    for (let i = 0; i < items.length; i++) {
        time = 0

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
        let start = new Audio(`${localHost}/audios/start/sudoku/locate/${items[0].group}.m4a`)

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

    return time;
}

const consoleLog = () => {

    let audioItem1 = new Audio(`${localHost}/audios/items/${items[0].name}.m4a`)
    let audioItem2 = new Audio(`${localHost}/audios/items/${items[1].name}.m4a`)
    let audioItem3 = new Audio(`${localHost}/audios/items/${items[2].name}.m4a`)

    let question1 = new Audio(`${localHost}/audios/items/questions/${items[0].group}/1.m4a`)

    let audio1 = new Audio(`${localHost}/audios/permutations/1.m4a`)
    let audio2 = new Audio(`${localHost}/audios/groups/next/${items[0].group}.m4a`)
    let audio3 = new Audio(`${localHost}/audios/permutations/2.m4a`)
    let audio4 = new Audio(`${localHost}/audios/groups/none/${items[0].group}.m4a`)
    let audio5 = new Audio(`${localHost}/audios/permutations/3.m4a`)
    let audio6 = new Audio(`${localHost}/audios/permutations/4.m4a`)

    audio1.play()

    audio1.onended = function () {
        audio2.play()
        // showItemsPresentation(true)

    }

    audio2.onended = function () {
        // console.log(showItemsPresentation(true))
        setTimeout(function () {
            audio3.play()
        }, showItemsPresentation(true))
    }

    audio3.onended = function () {
        audio4.play()
    }

    audio4.onended = function () {
        audio5.play()
    }

    audio5.onended = function () {
        audio6.play()
        for (let i = 1; i <= 3; i++) {
            let element = document.getElementById(i.toString())
            if (element) {
                element.classList.remove('opacity-0')
            }
        }

    }

    audio6.onended = function () {
        audioItem1.play()
        localStorage.setItem('itemSelected', JSON.stringify(items[0]))
        paintItem(`${1}`, items)
    }


    audioItem1.onended = function () {
        audioItem3.play()

        localStorage.setItem('itemSelected', JSON.stringify(items[2]))
        paintItem(`${2}`, items)
    }

    audioItem3.onended = function () {
        question1.play()
    }

    question1.onended = function () {
        showFocusBox(props.order_to_resolve[0])
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
            <div class="flex p-6 w-full gap-5 rounded-md">
                <div @click="showItemsPresentation()" class="w-[16%]">
                    <HelpCharacter :image="`${localHost}/images/characters/robot/normal.png`"
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

                                <div id="activity" :class="[`grid grid-cols-3 gap-y-2 gap-x-1`, talkBool ? 'cursor-not-allowed' : 'cursor-cell']">
                                    <div :id="i" @click="validateOrder(i)" v-for="i in 21"
                                         :key="i"
                                         :class="`bg-white border border-black hover:opacity-75
                                          flex justify-center items-center font-bold text-6xl select-none h-14 w-14`">
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
