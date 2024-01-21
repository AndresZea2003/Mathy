<script setup>
import Swal from 'sweetalert2'
import {ref, watch, computed} from "vue";
import ProgressBar from "../sections/ProgressBar.vue";
import IconShoppingCart from "../icons/IconShoppingCart.vue"
import {
    localHost,
    types,
    sizes,
} from '../../use';

import IconPaintBrush from "../icons/IconPaintBrush.vue"

let color = 'white';
let figura1 = 0;
let figura2 = 0;
let figura3 = 0;

const props = defineProps({
    route_back: {type: String, required: true},
    route_next: {type: String, required: true},
    asset_images: {type: String, required: true},
    asset_audio: {type: String, required: true},
    win_audio: {type: String, required: true},
    level: {type: Array},
    items: {type: Array},
})

let colorSelected = ref(0);

let talk = ref(false);

let ShowEraser = ref(false);

let winLevel = ref(false);

let eye = ref(`${props.asset_images}/characters/robot/eyes.png`)
let eraser = ref(`${props.asset_images}/items/tools/eraser.png`)
let mati = ref(`${props.asset_images}/characters/robot/normal.png`)
let widthMati = ref(150);

let selectFig1 = ref('');
let selectFig2 = ref('');
let selectFig3 = ref('');

let indexSquare = ref('');

let indexSquareFig = ref('');

let color1Error = ref(false);
let color2Error = ref(false);
let color3Error = ref(false);
let color4Error = ref(false);
let color5Error = ref(false);
let color6Error = ref(false);
let color7Error = ref(false);
let color8Error = ref(false);
let color9Error = ref(false);
let color10Error = ref(false);
let color11Error = ref(false);
let color12Error = ref(false);
let color13Error = ref(false);
let color14Error = ref(false);
let color15Error = ref(false);
let color16Error = ref(false);
let color17Error = ref(false);
let color18Error = ref(false);
let color19Error = ref(false);
let color20Error = ref(false);

let colorPainted1 = ref(false);
let colorPainted2 = ref(false);
let colorPainted3 = ref(false);
let colorPainted4 = ref(false);
let colorPainted5 = ref(false);
let colorPainted6 = ref(false);
let colorPainted7 = ref(false);
let colorPainted8 = ref(false);
let colorPainted9 = ref(false);
let colorPainted10 = ref(false);
let colorPainted11 = ref(false);
let colorPainted12 = ref(false);
let colorPainted13 = ref(false);
let colorPainted14 = ref(false);
let colorPainted15 = ref(false);
let colorPainted16 = ref(false);
let colorPainted17 = ref(false);
let colorPainted18 = ref(false);
let colorPainted19 = ref(false);
let colorPainted20 = ref(false);

let color1 = ref('');
let color2 = ref('');
let color3 = ref('');
let color4 = ref('');
let color5 = ref('');
let color6 = ref('');
let color7 = ref('');
let color8 = ref('');
let color9 = ref('');
let color10 = ref('');
let color11 = ref('');
let color12 = ref('');
let color13 = ref('');
let color14 = ref('');
let color15 = ref('');
let color16 = ref('');
let color17 = ref('');
let color18 = ref('');

// azul 1
// rojo 2
// verde 3

let combinations = ['123', '132', '213', '231', '312', '321']

let sequenceNumber = ref('')

let grupo1 = ref(color1.value + color2.value + color3.value);
let grupo2 = ref('');
let grupo3 = ref('');
let grupo4 = ref('');
let grupo5 = ref('');
let grupo6 = ref('');

let grupo1check = ref(false);
let grupo2check = ref(false);
let grupo3check = ref(false);
let grupo4check = ref(false);
let grupo5check = ref(false);
let grupo6check = ref(false);

let select1 = ref(false)
let select2 = ref(false)
let select3 = ref(false)
let select4 = ref(false)
let select5 = ref(false)
let select6 = ref(false)
let select7 = ref(false)
let select8 = ref(false)
let select9 = ref(false)


let filaFocus = ref(1)
const boxNumRange = [101, 118];

let focusId = ref('')

let canPaint = ref(true)

let filaExtra = ref(false)

setTimeout(function () {
    Swal.fire({
        title: 'Tutorial',
        text: 'Llegamos a las permutaciones! Aqui veremos un poco de pensamiento combinatorio, filas y muchos colores!',
        icon: 'warning',
        confirmButtonText: 'Comenzar'
    }).then((result) => {
        // La función dentro de then se ejecutará después de hacer clic en el botón OK
        if (result.isConfirmed) {
            initialAudio();
            // interactiveActivity()

            // test()

        }
    });
}, 500)


const test = () => {
    console.log(`${localHost}/audios/items/${props.items[0].name}.m4a`)
    audioColor1()
}

function initialAudio() {
    if (talk.value === false) {
        talk.value = true;

        let sound = new Audio();
        sound.src = `${props.asset_audio}/voz1/permutaciones/vamoscolores.m4a`;
        sound.play()

        showIndexSquare('bg-green-600', 'bg-blue-600', 'bg-red-600')

        setTimeout(function () {
            let sound = new Audio();
            sound.src = `${props.asset_audio}/voz1/permutaciones/filascolores.m4a`;
            sound.play()
        }, 8000)

        setTimeout(function () {
            let sound = new Audio();
            sound.src = `${props.asset_audio}/voz1/permutaciones/prestacolor.m4a`;
            sound.play()
        }, 12000)

        setTimeout(function () {
            interactiveActivity()
        }, 24000)

        widthMati.value = 160;
        setTimeout(resetMati, 24000);
        // setTimeout(function () {
        //     helpAudio()
        // }, 15000)
    }
}

const audioColor1 = () => {
    let sound = new Audio();
    sound.src = `${localHost}/audios/items/${props.items[0].name}.m4a`;
    sound.play()
}

const audioColor2 = () => {
    let sound = new Audio();
    sound.src = `${localHost}/audios/items/${props.items[1].name}.m4a`;
    sound.play()
}

const audioColor3 = () => {
    let sound = new Audio();
    sound.src = `${localHost}/audios/items/${props.items[2].name}.m4a`;
    sound.play()
}

const audioErrorFila = () => {
    let sound = new Audio();
    sound.src = `${props.asset_audio}/voz1/permutaciones/errorcolorfila.m4a`;
    sound.play();
}

const audioErrorBack = () => {
    let sound = new Audio();
    sound.src = `${props.asset_audio}/voz1/permutaciones/errorcolorback.m4a`;
    sound.play();
}

const audio2filas = () => {

    setTimeout(function () {
        document.getElementById('caja101').classList.add('bg-yellow-400')
        document.getElementById('caja102').classList.add('bg-yellow-400')
        document.getElementById('caja103').classList.add('bg-yellow-400')
        setTimeout(function () {
            document.getElementById('caja104').classList.add('bg-yellow-400')
            document.getElementById('caja105').classList.add('bg-yellow-400')
            document.getElementById('caja106').classList.add('bg-yellow-400')
        }, 500)
    }, 1000)

    setTimeout(function () {
        document.getElementById('caja101').classList.remove('bg-yellow-400')
        document.getElementById('caja102').classList.remove('bg-yellow-400')
        document.getElementById('caja103').classList.remove('bg-yellow-400')
        document.getElementById('caja104').classList.remove('bg-yellow-400')
        document.getElementById('caja105').classList.remove('bg-yellow-400')
        document.getElementById('caja106').classList.remove('bg-yellow-400')
    }, 2000)

    setTimeout(function () {
        document.getElementById('caja101').classList.add('opacity-50')
        document.getElementById('caja102').classList.add('opacity-50')
        document.getElementById('caja103').classList.add('opacity-50')
        document.getElementById('caja104').classList.add('opacity-50')
        document.getElementById('caja105').classList.add('opacity-50')
        document.getElementById('caja106').classList.add('opacity-50')
        setTimeout(function () {
            document.getElementById('caja101').classList.replace('opacity-50', 'opacity-100')
            setTimeout(function () {
                document.getElementById('caja102').classList.replace('opacity-50', 'opacity-100')
                setTimeout(function () {
                    document.getElementById('caja103').classList.replace('opacity-50', 'opacity-100')
                }, 1000)
            }, 500)
        }, 1000)
    }, 5000)

    setTimeout(function () {
        document.getElementById('caja104').classList.replace('opacity-50', 'opacity-100')
        setTimeout(function () {
            document.getElementById('caja105').classList.replace('opacity-50', 'opacity-100')
            setTimeout(function () {
                document.getElementById('caja106').classList.replace('opacity-50', 'opacity-100')
            }, 1000)
        }, 1000)
    }, 10000)

    let sound = new Audio();
    sound.src = `${props.asset_audio}/voz1/permutaciones/completado2filascolores.m4a`;
    sound.play();
}


const audio4filas = () => {

    setTimeout(function () {
        document.getElementById('caja101').classList.add('bg-yellow-400')
        document.getElementById('caja102').classList.add('bg-yellow-400')
        document.getElementById('caja103').classList.add('bg-yellow-400')
        document.getElementById('caja104').classList.add('bg-yellow-400')
        document.getElementById('caja105').classList.add('bg-yellow-400')
        document.getElementById('caja106').classList.add('bg-yellow-400')
        document.getElementById('caja107').classList.add('bg-yellow-400')
        document.getElementById('caja108').classList.add('bg-yellow-400')
        document.getElementById('caja109').classList.add('bg-yellow-400')
        document.getElementById('caja110').classList.add('bg-yellow-400')
        document.getElementById('caja111').classList.add('bg-yellow-400')
        document.getElementById('caja112').classList.add('bg-yellow-400')
    }, 2000)

    setTimeout(function () {
        document.getElementById('caja101').classList.remove('bg-yellow-400')
        document.getElementById('caja102').classList.remove('bg-yellow-400')
        document.getElementById('caja103').classList.remove('bg-yellow-400')
        document.getElementById('caja104').classList.remove('bg-yellow-400')
        document.getElementById('caja105').classList.remove('bg-yellow-400')
        document.getElementById('caja106').classList.remove('bg-yellow-400')
        document.getElementById('caja107').classList.remove('bg-yellow-400')
        document.getElementById('caja108').classList.remove('bg-yellow-400')
        document.getElementById('caja109').classList.remove('bg-yellow-400')
        document.getElementById('caja110').classList.remove('bg-yellow-400')
        document.getElementById('caja111').classList.remove('bg-yellow-400')
        document.getElementById('caja112').classList.remove('bg-yellow-400')
    }, 3000)

    let sound = new Audio();
    sound.src = `${props.asset_audio}/voz1/permutaciones/completado4filascolor.m4a`;
    sound.play();
}

function showIndexSquare(color1, color2, color3) {
    indexSquareFig.value = 'colors';
    setTimeout(function () {
        audioColor1()
        indexSquare.value = `border-black border-2 p-12 ${color1}`;
    }, 3000);
    setTimeout(function () {
        audioColor2()
        indexSquare.value = `border-black border-2 p-12 ${color2}`;
    }, 4500);
    setTimeout(function () {
        audioColor3()
        indexSquare.value = `border-black border-2 p-12 ${color3}`;
    }, 6000);
    setTimeout(function () {
        indexSquare.value = '';
    }, 7500);
}

function helpAudio() {
    if (talk.value === false) {
        helpFigures()
        talk.value = true;
        mati.value = `${props.asset_images}/robot/matiQuieto.gif`;
        let sound = new Audio();
        sound.src = `${props.asset_audio}/voz1/ayuda-nivel1.m4a`;
        sound.play()
        widthMati.value = 160;
        setTimeout(resetMati, 4000);
    }
}

function helpFigures() {
    selectFig1.value = 'rounded-md animate-pulse';
    eye.value = `${props.asset_images}/dog/ojos.gif`
    document.getElementById('eye').classList.remove('scale-50');
    document.getElementById('observa').classList.remove('text-xl');
    document.getElementById('observa').classList.add('text-3xl');
    document.getElementById('subVista').classList.add('scale-125');
    document.getElementById('subVista').classList.add('mt-5');

    setTimeout(function () {
        document.getElementById('eye').classList.add('scale-50');
        document.getElementById('observa').classList.add('text-xl');
        document.getElementById('observa').classList.remove('text-3xl');
        document.getElementById('subVista').classList.remove('scale-125');
        document.getElementById('subVista').classList.remove('mt-5');
        eye.value = `${props.asset_images}/dog/eyes.png`;
        selectFig1.value = '';
    }, 2000);
    setTimeout(function () {
        selectFig2.value = 'animate-pulse arrow';
        document.getElementById('arrow').setAttribute('fill', '#22c55e')
    }, 2000);
    setTimeout(function () {
        selectFig3.value = 'rounded-md animate-pulse scale-125';
    }, 2000);
}

const resetMati = () => {
    talk.value = false;
    selectFig1.value = '';
    selectFig2.value = '';
    selectFig3.value = '';
    indexSquare.value = '';
    document.getElementById('arrow').setAttribute('fill', '#9ca3af')
    mati.value = `${props.asset_images}/robot/mati.png`;
    widthMati.value = 150;
}


const paint = (id) => {

    if (canPaint.value === false) {
        return
    }

    if (document.getElementById(id).classList.contains('bg-gray-infinite')) {
        document.getElementById(id).classList.remove('bg-gray-infinite')
    }

    if (color === 'white' && colorSelected.value < 1) {
        let sound = new Audio();
        sound.src = `${props.asset_audio}/wood.wav`;
        sound.play()

        Swal.fire({
            icon: 'warning',
            title: 'Falta color!',
            text: 'Selecciona un color primero',
            showConfirmButton: true,
        })
        return
    }

    if (id !== focusId.value && filaExtra.value === false) {
        error(id)
        return;
    }

    if (filaExtra.value === true) {
        if (id === 'caja119' || id === 'caja120' || id === 'caja121') {

        } else {
            error(id)
        }
    }

    if (id === 'caja101' || id === 'caja102' || id === 'caja103') {
        if (grupo1check.value) {
            return;
        }
    } else if (id === 'caja104' || id === 'caja105' || id === 'caja106') {
        if (grupo2check.value) {
            return;
        }
    } else if (id === 'caja107' || id === 'caja108' || id === 'caja109') {
        if (grupo3check.value) {
            return;
        }
    } else if (id === 'caja110' || id === 'caja111' || id === 'caja112') {
        if (grupo4check.value) {
            return;
        }
    } else if (id === 'caja113' || id === 'caja114' || id === 'caja115') {
        if (grupo5check.value) {
            return;
        }
    } else if (id === 'caja116' || id === 'caja117' || id === 'caja118') {
        if (grupo6check.value) {
            return;
        }
    }

    document.getElementById(id).classList.remove('hover:bg-gray-400')
    document.getElementById(id).classList.remove('bg-white')
    document.getElementById(id).classList.remove('bg-blue-600')
    document.getElementById(id).classList.remove('bg-green-600')
    document.getElementById(id).classList.remove('bg-yellow-400')
    document.getElementById(id).classList.remove('bg-fuchsia-400')
    document.getElementById(id).classList.add(`bg-${color}`);


    if (color === 'yellow-400') {
        sequenceNumber = '1'
    } else if (color === 'blue-600') {
        sequenceNumber = '2'
    } else if (color === 'fuchsia-400') {
        sequenceNumber = '3'
    }


    const boxes = {
        'caja1': {
            num: 1,
            groupNum: 1,
            group: grupo1,
            groupCheck: grupo1check,
            classToAdd: 'scale-75',
            sec1: 'caja1',
            sec2: 'caja2',
            sec3: 'caja3',
            color: color1
        },
        'caja2': {
            num: 2,
            groupNum: 1,
            group: grupo1,
            groupCheck: grupo1check,
            classToAdd: 'scale-75',
            sec1: 'caja1',
            sec2: 'caja2',
            sec3: 'caja3',
            color: color2
        },
        'caja3': {
            num: 3,
            groupNum: 1,
            group: grupo1,
            groupCheck: grupo1check,
            classToAdd: 'scale-75',
            sec1: 'caja1',
            sec2: 'caja2',
            sec3: 'caja3',
            color: color3
        },
        'caja4': {
            num: 4,
            groupNum: 2,
            group: grupo2,
            groupCheck: grupo2check,
            classToAdd: 'scale-75',
            sec1: 'caja4',
            sec2: 'caja5',
            sec3: 'caja6',
            color: color4
        },
        'caja5': {
            num: 5,
            groupNum: 2,
            group: grupo2,
            groupCheck: grupo2check,
            classToAdd: 'scale-75',
            sec1: 'caja4',
            sec2: 'caja5',
            sec3: 'caja6',
            color: color5
        },
        'caja6': {
            num: 6,
            groupNum: 2,
            group: grupo2,
            groupCheck: grupo2check,
            classToAdd: 'scale-75',
            sec1: 'caja4',
            sec2: 'caja5',
            sec3: 'caja6',
            color: color6
        },
        'caja7': {
            num: 7,
            groupNum: 3,
            group: grupo3,
            groupCheck: grupo3check,
            classToAdd: 'scale-75',
            sec1: 'caja7',
            sec2: 'caja8',
            sec3: 'caja9',
            color: color7
        },
        'caja8': {
            num: 8,
            groupNum: 3,
            group: grupo3,
            groupCheck: grupo3check,
            classToAdd: 'scale-75',
            sec1: 'caja7',
            sec2: 'caja8',
            sec3: 'caja9',
            color: color8
        },
        'caja9': {
            num: 9,
            groupNum: 3,
            group: grupo3,
            groupCheck: grupo3check,
            classToAdd: 'scale-75',
            sec1: 'caja7',
            sec2: 'caja8',
            sec3: 'caja9',
            color: color9
        },
        'caja10': {
            num: 10,
            groupNum: 4,
            group: grupo4,
            groupCheck: grupo4check,
            classToAdd: 'scale-75',
            sec1: 'caja10',
            sec2: 'caja11',
            sec3: 'caja12',
            color: color10
        },
        'caja11': {
            num: 11,
            groupNum: 4,
            group: grupo4,
            groupCheck: grupo4check,
            classToAdd: 'scale-75',
            sec1: 'caja10',
            sec2: 'caja11',
            sec3: 'caja12',
            color: color11
        },
        'caja12': {
            num: 12,
            groupNum: 4,
            group: grupo4,
            groupCheck: grupo4check,
            classToAdd: 'scale-75',
            sec1: 'caja10',
            sec2: 'caja11',
            sec3: 'caja12',
            color: color12
        },
        'caja13': {
            num: 13,
            groupNum: 5,
            group: grupo5,
            groupCheck: grupo5check,
            classToAdd: 'scale-75',
            sec1: 'caja13',
            sec2: 'caja14',
            sec3: 'caja15',
            color: color13
        },
        'caja14': {
            num: 14,
            groupNum: 5,
            group: grupo5,
            groupCheck: grupo5check,
            classToAdd: 'scale-75',
            sec1: 'caja13',
            sec2: 'caja14',
            sec3: 'caja15',
            color: color14
        },
        'caja15': {
            num: 15,
            groupNum: 5,
            group: grupo5,
            groupCheck: grupo5check,
            classToAdd: 'scale-75',
            sec1: 'caja13',
            sec2: 'caja14',
            sec3: 'caja15',
            color: color15
        },
        'caja16': {
            num: 16,
            groupNum: 6,
            group: grupo6,
            groupCheck: grupo6check,
            classToAdd: 'scale-75',
            sec1: 'caja16',
            sec2: 'caja17',
            sec3: 'caja18',
            color: color16
        },
        'caja17': {
            num: 17,
            groupNum: 6,
            group: grupo6,
            groupCheck: grupo6check,
            classToAdd: 'scale-75',
            sec1: 'caja16',
            sec2: 'caja17',
            sec3: 'caja18',
            color: color17
        },
        'caja18': {
            num: 18,
            groupNum: 6,
            group: grupo6,
            groupCheck: grupo6check,
            classToAdd: 'scale-75',
            sec1: 'caja16',
            sec2: 'caja17',
            sec3: 'caja18',
            color: color18
        },
    };

    if (boxes.hasOwnProperty(id)) {
        boxes[id].color.value = sequenceNumber.value;
    }

    const playJumpSound = () => {
        const sound = new Audio();
        sound.src = `${props.asset_audio}/jumpCoin.wav`;
        sound.play();
    };

    const verifyCombinations = (boxNum, group, groupNum, groupCheck, classToAdd, sec1, sec2, sec3) => {

        grupo1.value = color1.value + color2.value + color3.value;
        grupo2.value = color4.value + color5.value + color6.value;
        grupo3.value = color7.value + color8.value + color9.value;
        grupo4.value = color10.value + color11.value + color12.value;
        grupo5.value = color13.value + color14.value + color15.value;
        grupo6.value = color16.value + color17.value + color18.value;

        const box = document.getElementById(`caja${boxNum}`);

        if (box.classList.contains('bg-white')) {
            document.getElementById(`error${groupNum}`).classList.replace('opacity-100', 'opacity-0')
            let sound = new Audio();
            sound.src = `${props.asset_audio}/eraser.mp3`;
            sound.play()
        } else {

        }

        if (combinations.includes(group.value)) {
            groupCheck.value = true
            document.getElementById(`error${groupNum}`).classList.replace('opacity-100', 'opacity-0')
            let index = combinations.indexOf(group.value)
            combinations.splice(index, 1)
            playJumpSound()

            document.getElementById(sec1).classList.add(classToAdd)
            document.getElementById(sec2).classList.add(classToAdd)
            document.getElementById(sec3).classList.add(classToAdd)

        } else {
            function validarString(str) {

                const uniqueDigits = new Set(str);
                return uniqueDigits.size === 3;
            }

            const miString = group.value; // Reemplaza esto con tu string
            const esValido = validarString(miString);

            let sound = new Audio();

            if (group.value.length === 3) {
                document.getElementById(`error${groupNum}`).classList.replace('opacity-0', 'opacity-100')
                sound.src = `${props.asset_audio}/wood.wav`;
                document.getElementById(sec1).classList.add('bg-red-800', 'brush-fail')
                document.getElementById(sec2).classList.add('bg-red-800', 'brush-fail')
                document.getElementById(sec3).classList.add('bg-red-800', 'brush-fail')
                setTimeout(function () {
                    document.getElementById(sec1).classList.remove('bg-red-800', 'brush-fail')
                    document.getElementById(sec2).classList.remove('bg-red-800', 'brush-fail')
                    document.getElementById(sec3).classList.remove('bg-red-800', 'brush-fail')
                }, 500)
            } else {
                sound.src = `${props.asset_audio}/paint.wav`;
            }

            sound.play();
        }

        if (combinations.length === 0) {
            win()
        }
    }

    if (id in boxes) {
        const {num, group, groupNum, groupCheck, classToAdd, sec1, sec2, sec3} = boxes[id];
        verifyCombinations(num, group, groupNum, groupCheck, classToAdd, sec1, sec2, sec3);
    }

    // Borrador
    const colorErrors = [color1Error, color2Error, color3Error, color4Error, color5Error, color6Error, color7Error,
        color8Error, color9Error, color10Error, color11Error, color12Error, color13Error, color14Error,
        color15Error, color16Error, color17Error, color18Error, color19Error, color20Error];


    function animateBrush(soundSrc, time, animateClass, BrushColor) {
        document.getElementById('brush').classList.add(animateClass);
        document.getElementById('brush').style.fill = BrushColor;
        setTimeout(() => {
            document.getElementById('brush').classList.remove(animateClass);
            document.getElementById('brush').style.fill = '#78716c';
        }, time);
        const sound = new Audio();
        sound.src = soundSrc;
        sound.play();
    }


    // Completar figura
    // if (document.getElementById('caja1').classList.contains('bg-blue-600') &&
    //     document.getElementById('caja2').classList.contains('bg-red-600') &&
    //     document.getElementById('caja3').classList.contains('bg-yellow-400') &&
    //     document.getElementById('caja4').classList.contains('bg-red-600')
    // ) {
    //     win()
    //     let sound = new Audio();
    //     sound.src = `${props.asset_audio}/correctVictory.wav`;
    //     sound.play()
    //     // Swal.fire({
    //     //     icon: 'success',
    //     //     title: 'Completado!',
    //     //     text: 'Felicidades! Has completado la actividad',
    //     //     showConfirmButton: true,
    //     // })
    // }

    // Interactivo sin refactorizar down

    if (filaFocus.value === 1) {

        let box1 = 'caja101'
        let box2 = 'caja102'
        let box3 = 'caja103'

        let nextBox1 = 'caja104'
        let nextBox2 = 'caja105'
        let nextBox3 = 'caja106'

        let boxNum1 = 101
        let boxNum3 = 103

        if (document.getElementById(box3).classList.contains('bg-green-600')) { // Si completa la primera fila

            filaFocus.value = 2

            successSound()
            document.getElementById(nextBox1).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')
            document.getElementById(nextBox2).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')

            // Audio bien

            setTimeout(function () {
                document.getElementById(nextBox1).classList.add('bg-blue-600')
                audioColor2()
                setTimeout(function () {
                    nextSelectSound(1)
                    bottonLigth(nextBox2)
                    focusId.value = nextBox2
                }, 1000)
            }, 1000)

            return;

        } else if (document.getElementById(box3).classList.contains('bg-blue-600')) {
            canPaint.value = false
            errorSound()
            audioErrorFila()
            let selectSquare = box3

            let yellowSquare = box1

            for (let i = 101; i <= 103; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    document.getElementById(yellowSquare).classList.add('bg-yellow-400');
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        document.getElementById(yellowSquare).classList.remove('bg-yellow-400');
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-blue-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        } else if (document.getElementById(box3).classList.contains('bg-red-600')) {
            canPaint.value = false
            errorSound()
            audioErrorFila()
            let selectSquare = box3

            let yellowSquare = box2


            for (let i = 101; i <= 103; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    document.getElementById(yellowSquare).classList.add('bg-yellow-400');
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        document.getElementById(yellowSquare).classList.remove('bg-yellow-400');
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-red-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        }
    }

    if (filaFocus.value === 2) {

        let box1 = 'caja104'
        let box2 = 'caja105'
        let box3 = 'caja106'

        let oldBoxNum1 = 101
        let oldBoxNum3 = 103

        let boxNum1 = 104
        let boxNum3 = 106


        if (document.getElementById(box2).classList.contains('bg-green-600')) { // Si completa la primera fila
            filaFocus.value = 3

            successSound()
            focusId.value = box3
            nextSelectSound(4)
            document.getElementById('caja106').classList.remove('scale-75', 'bg-gray-400', 'opacity-0')
            document.getElementById('caja106').classList.add('bg-gray-infinite')

        } else if (document.getElementById(box2).classList.contains('bg-blue-600')) {
            canPaint.value = false
            errorSound()
            audioErrorFila()
            let selectSquare = box2
            let yellowSquare = box1


            for (let i = boxNum1; i <= boxNum3; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    document.getElementById(yellowSquare).classList.add('bg-yellow-400');
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        document.getElementById(yellowSquare).classList.remove('bg-yellow-400');
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-blue-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        } else if (document.getElementById(box2).classList.contains('bg-red-600')) {
            canPaint.value = false
            errorSound()
            audioErrorBack()
            let selectSquare = box2

            for (let i = boxNum1; i <= boxNum3; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    for (let i = oldBoxNum1; i <= oldBoxNum3; i++) {
                        const elementId2 = `caja${i}`;
                        document.getElementById(elementId2).classList.add('opacity-50')
                    }
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        for (let i = oldBoxNum1; i <= oldBoxNum3; i++) {
                            const elementId2 = `caja${i}`;
                            document.getElementById(elementId2).classList.remove('opacity-50')
                        }
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-red-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        }
    }

    if (filaFocus.value === 3) {
        let box1 = 'caja104'
        let box2 = 'caja105'
        let box3 = 'caja106'

        let oldBoxNum1 = 101
        let oldBoxNum3 = 103

        let nextBox1 = 'caja107'
        let nextBox2 = 'caja108'
        let nextBox3 = 'caja109'

        let boxNum1 = 104
        let boxNum3 = 106

        if (document.getElementById(box3).classList.contains('bg-red-600')) { // Si completa la primera fila
            filaFocus.value = 4

            successSound()

            audio2filas()

            setTimeout(function () {
                document.getElementById(nextBox1).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')
                document.getElementById(nextBox2).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')
                document.getElementById(nextBox3).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')

                // Audio bien

                setTimeout(function () {
                    document.getElementById(nextBox1).classList.add('bg-red-600')
                    audioColor3()
                    setTimeout(function () {
                        document.getElementById(nextBox2).classList.add('bg-green-600')
                        audioColor1()
                        setTimeout(function () {
                            bottonLigth(nextBox3)
                            nextSelectSound(4)
                            focusId.value = nextBox3
                        }, 1000)
                    }, 1000)
                }, 1000)
            }, 20000)

        } else if (document.getElementById(box3).classList.contains('bg-blue-600')) {
            canPaint.value = false
            errorSound()
            let selectSquare = box3
            let yellowSquare = box1
            audioErrorFila()


            for (let i = boxNum1; i <= boxNum3; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    document.getElementById(yellowSquare).classList.add('bg-yellow-400');
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        document.getElementById(yellowSquare).classList.remove('bg-yellow-400');
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-blue-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        } else if (document.getElementById(box3).classList.contains('bg-green-600')) {
            canPaint.value = false
            errorSound()
            audioErrorFila()
            let selectSquare = box3

            let yellowSquare = box2


            for (let i = boxNum1; i <= boxNum3; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    document.getElementById(yellowSquare).classList.add('bg-yellow-400');
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        document.getElementById(yellowSquare).classList.remove('bg-yellow-400');
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-red-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        }


    }

    if (filaFocus.value === 4) {

        let box1 = 'caja107'
        let box2 = 'caja108'
        let box3 = 'caja109'

        let nextBox1 = 'caja110'
        let nextBox2 = 'caja111'
        let nextBox3 = 'caja112'

        let boxNum1 = 107
        let boxNum3 = 109

        if (document.getElementById(box3).classList.contains('bg-blue-600')) { // Si completa la primera fila

            filaFocus.value = 5

            successSound()
            document.getElementById(nextBox1).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')
            document.getElementById(nextBox2).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')

            // Audio bien

            setTimeout(function () {
                document.getElementById(nextBox1).classList.add('bg-red-600')
                audioColor3()
                setTimeout(function () {
                    nextSelectSound(1)
                    bottonLigth(nextBox2)
                    focusId.value = nextBox2
                }, 1000)
            }, 1000)

            return;

        } else if (document.getElementById(box3).classList.contains('bg-red-600') || document.getElementById(box3).classList.contains('bg-green-600')) {
            canPaint.value = false
            errorSound()
            audioErrorFila()
            let selectSquare = box3
            let yellowSquare = null

            if (document.getElementById(box3).classList.contains('bg-red-600')) {
                yellowSquare = box1
            } else if (document.getElementById(box3).classList.contains('bg-green-600')) {
                yellowSquare = box2
            }


            for (let i = boxNum1; i <= boxNum3; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    document.getElementById(yellowSquare).classList.add('bg-yellow-400');
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        document.getElementById(yellowSquare).classList.remove('bg-yellow-400');
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-green-600', 'bg-red-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        }
    }

    if (filaFocus.value === 5) {

        let box1 = 'caja110'
        let box2 = 'caja111'
        let box3 = 'caja112'

        let oldBoxNum1 = 107
        let oldBoxNum3 = 109

        let boxNum1 = 110
        let boxNum3 = 112


        if (document.getElementById(box2).classList.contains('bg-blue-600')) { // Si completa la primera fila
            filaFocus.value = 6

            successSound()
            focusId.value = box3
            document.getElementById(box3).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')
            document.getElementById(box3).classList.add('bg-gray-infinite')
            nextSelectSound(3)

        } else if (document.getElementById(box2).classList.contains('bg-red-600')) {
            canPaint.value = false
            errorSound()
            let selectSquare = box2
            let yellowSquare = box1
            audioErrorFila()


            for (let i = boxNum1; i <= boxNum3; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    document.getElementById(yellowSquare).classList.add('bg-yellow-400');
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        document.getElementById(yellowSquare).classList.remove('bg-yellow-400');
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-red-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        } else if (document.getElementById(box2).classList.contains('bg-green-600')) {
            canPaint.value = false
            errorSound()
            audioErrorBack()
            let selectSquare = box2

            for (let i = boxNum1; i <= boxNum3; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    for (let i = oldBoxNum1; i <= oldBoxNum3; i++) {
                        const elementId2 = `caja${i}`;
                        document.getElementById(elementId2).classList.add('opacity-50')
                    }
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        for (let i = oldBoxNum1; i <= oldBoxNum3; i++) {
                            const elementId2 = `caja${i}`;
                            document.getElementById(elementId2).classList.remove('opacity-50')
                        }
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-red-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        }
    }

    if (filaFocus.value === 6) {

        let box1 = 'caja110'
        let box2 = 'caja111'
        let box3 = 'caja112'

        let oldBoxNum1 = 107
        let oldBoxNum3 = 109

        let boxNum1 = 110
        let boxNum3 = 112

        let nextBox1 = 'caja113'
        let nextBox2 = 'caja114'
        let nextBox3 = 'caja115'


        if (document.getElementById(box3).classList.contains('bg-green-600')) { // Si completa la primera fila

            filaFocus.value = 7

            successSound()

            audio4filas()

            setTimeout(function () {
                document.getElementById(nextBox1).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')
                document.getElementById(nextBox2).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')
                document.getElementById(nextBox3).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')

                // Audio bien

                setTimeout(function () {
                    document.getElementById(nextBox1).classList.add('bg-green-600')
                    audioColor1()
                    setTimeout(function () {
                        document.getElementById(nextBox2).classList.add('bg-blue-600')
                        audioColor2()
                        setTimeout(function () {
                            nextSelectSound(4)
                            bottonLigth(nextBox3)
                            focusId.value = nextBox3
                        }, 1000)
                    }, 1000)
                }, 1000)

                return;
            }, 7000)

        } else if (document.getElementById(box3).classList.contains('bg-red-600') || document.getElementById(box3).classList.contains('bg-blue-600')) {
            canPaint.value = false
            errorSound()
            audioErrorFila()
            let selectSquare = box3
            let yellowSquare = null

            if (document.getElementById(box3).classList.contains('bg-red-600')) {
                yellowSquare = box1
            } else if (document.getElementById(box3).classList.contains('bg-blue-600')) {
                yellowSquare = box2
            }


            for (let i = boxNum1; i <= boxNum3; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    document.getElementById(yellowSquare).classList.add('bg-yellow-400');
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        document.getElementById(yellowSquare).classList.remove('bg-yellow-400');
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-blue-600', 'bg-red-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        }
    }

    if (filaFocus.value === 7) {

        let box1 = 'caja113'
        let box2 = 'caja114'
        let box3 = 'caja115'

        let oldBoxNum1 = 110
        let oldBoxNum3 = 112

        let boxNum1 = 113
        let boxNum3 = 115

        let nextBox1 = 'caja116'
        let nextBox2 = 'caja117'
        let nextBox3 = 'caja118'


        if (document.getElementById(box3).classList.contains('bg-red-600')) { // Si completa la primera fila
            filaFocus.value = 8

            successSound()

            document.getElementById(nextBox1).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')
            document.getElementById(nextBox2).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')

            setTimeout(function () {
                document.getElementById(nextBox1).classList.add('bg-green-600')
                audioColor1()
                setTimeout(function () {
                    nextSelectSound(1)
                    bottonLigth(nextBox2)
                    focusId.value = nextBox2
                }, 1000)
            }, 1000)

        } else if (document.getElementById(box3).classList.contains('bg-green-600') || document.getElementById(box3).classList.contains('bg-blue-600')) {
            canPaint.value = false
            errorSound()
            audioErrorFila()
            let selectSquare = box3
            let yellowSquare = null

            if (document.getElementById(box3).classList.contains('bg-green-600')) {
                yellowSquare = box1
            } else if (document.getElementById(box3).classList.contains('bg-blue-600')) {
                yellowSquare = box2
            }


            for (let i = boxNum1; i <= boxNum3; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    document.getElementById(yellowSquare).classList.add('bg-yellow-400');
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        document.getElementById(yellowSquare).classList.remove('bg-yellow-400');
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-blue-600', 'bg-green-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        }
    }

    if (filaFocus.value === 8) {

        let box1 = 'caja116'
        let box2 = 'caja117'
        let box3 = 'caja118'

        let oldBoxNum1 = 113
        let oldBoxNum3 = 115

        let boxNum1 = 116
        let boxNum3 = 118


        if (document.getElementById(box2).classList.contains('bg-red-600')) { // Si completa la primera fila
            filaFocus.value = 9

            successSound()
            focusId.value = box3
            document.getElementById(box3).classList.remove('scale-75', 'bg-gray-400', 'opacity-0')
            document.getElementById(box3).classList.add('bg-gray-infinite')
            nextSelectSound(4)

        } else if (document.getElementById(box2).classList.contains('bg-green-600')) {
            canPaint.value = false
            errorSound()
            let selectSquare = box2
            let yellowSquare = box1
            audioErrorFila()


            for (let i = boxNum1; i <= boxNum3; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    document.getElementById(yellowSquare).classList.add('bg-yellow-400');
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        document.getElementById(yellowSquare).classList.remove('bg-yellow-400');
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-red-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        } else if (document.getElementById(box2).classList.contains('bg-blue-600')) {
            canPaint.value = false
            errorSound()
            audioErrorBack()
            let selectSquare = box2

            for (let i = boxNum1; i <= boxNum3; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    for (let i = oldBoxNum1; i <= oldBoxNum3; i++) {
                        const elementId2 = `caja${i}`;
                        document.getElementById(elementId2).classList.add('opacity-50')
                    }
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        for (let i = oldBoxNum1; i <= oldBoxNum3; i++) {
                            const elementId2 = `caja${i}`;
                            document.getElementById(elementId2).classList.remove('opacity-50')
                        }
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-red-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        }
    }

    if (filaFocus.value === 9) {

        let box1 = 'caja116'
        let box2 = 'caja117'
        let box3 = 'caja118'

        let oldBoxNum1 = 113
        let oldBoxNum3 = 115

        let boxNum1 = 116
        let boxNum3 = 118

        let nextBox1 = 'caja119'
        let nextBox2 = 'caja120'
        let nextBox3 = 'caja121'


        if (document.getElementById(box3).classList.contains('bg-blue-600')) { // Si completa la primera fila
            filaFocus.value = 10

            successSound()

            filaExtra.value = true
            focusId.value = ''

            let sound = new Audio();
            sound.src = `${props.asset_audio}/voz1/permutaciones/extrafilacolor.m4a`;
            sound.play()

            // for (let i = 101; i <= 118; i++) {
            //     const elementId = `caja${i}`;
            //     document.getElementById(elementId).classList.add('brush-fail', 'bg-green-400');
            //     setTimeout(function () {
            //         document.getElementById(elementId).classList.remove('brush-fail', 'bg-green-400');
            //     }, 1000)
            // }

            setTimeout(function () {
                for (let i = 118; i <= 121; i++) {
                    const elementId = `caja${i}`;
                    document.getElementById(elementId).classList.remove('opacity-0');
                }
            }, 800)


        } else if (document.getElementById(box3).classList.contains('bg-green-600') || document.getElementById(box3).classList.contains('bg-red-600')) {
            canPaint.value = false
            errorSound()
            audioErrorFila()
            let selectSquare = box3
            let yellowSquare = null

            if (document.getElementById(box3).classList.contains('bg-green-600')) {
                yellowSquare = box1
            } else if (document.getElementById(box3).classList.contains('bg-red-600')) {
                yellowSquare = box2
            }


            for (let i = boxNum1; i <= boxNum3; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                }, 1000)
                setTimeout(function () {
                    // El color { color } ya se encuentra en esta fila
                    document.getElementById(yellowSquare).classList.add('bg-yellow-400');
                    document.getElementById(selectSquare).classList.add('bg-yellow-400');
                    setTimeout(function () {
                        document.getElementById(yellowSquare).classList.remove('bg-yellow-400');
                        document.getElementById(selectSquare).classList.remove('bg-yellow-400');
                    }, 1000)
                }, 2000)
                setTimeout(function () {
                    document.getElementById(selectSquare).classList.remove('bg-yellow-400', 'bg-red-600', 'bg-green-600');
                    setTimeout(function () {
                        document.getElementById(selectSquare).classList.add('bg-gray-infinite')
                        canPaint.value = true
                    }, 800)
                }, 3500)
            }
        }
    }

    if (filaFocus.value === 10) {

        let box1 = document.getElementById('caja119')
        let box2 = document.getElementById('caja120')
        let box3 = document.getElementById('caja121')

        if (box1.classList.contains('hover:bg-gray-400') || box2.classList.contains('hover:bg-gray-400') || box3.classList.contains('hover:bg-gray-400')) {

        } else {
            errorSound()
            for (let i = 119; i <= 121; i++) {
                const elementId = `caja${i}`;
                document.getElementById(elementId).classList.add('brush-fail', 'bg-red-800');
                setTimeout(function () {
                    document.getElementById(elementId).classList.remove('brush-fail', 'bg-red-800');
                    document.getElementById(elementId).classList.add('opacity-0');
                }, 1000)
            }
            let sound = new Audio();
            sound.src = `${props.asset_audio}/voz1/permutaciones/parecenocolores.m4a`;
            sound.play()
            setTimeout(function () {
                let sound = new Audio();
                sound.src = `${props.asset_audio}/coin.wav`;
                sound.play()
                win()
            }, 6200)

        }
    }
    // Interactivo sin refactorizar up
}

const successSound = () => {
    let sound = new Audio();
    sound.src = `${props.asset_audio}/success.wav`;
    sound.play()
}

const errorSound = () => {
    let sound = new Audio();
    sound.src = `${props.asset_audio}/wood.wav`;
    sound.play()
}

const nextSelectSound = (num) => {
    if (num === 1) {
        let sound = new Audio();
        sound.src = `${props.asset_audio}/voz1/permutaciones/colordebeseguir.m4a`;
        sound.play()
    }
    if (num === 2) {
        let sound = new Audio();
        sound.src = `${props.asset_audio}/voz1/permutaciones/quecoloresel.m4a`;
        sound.play()
    }
    if (num === 3) {
        let sound = new Audio();
        sound.src = `${props.asset_audio}/voz1/permutaciones/ahoracolor.m4a`;
        sound.play()
    }
    if (num === 4) {
        let sound = new Audio();
        sound.src = `${props.asset_audio}/voz1/permutaciones/quecolor.m4a`;
        sound.play()
    }
}

const selectColor = (bg, id) => {
    color = bg
    colorSelected.value++
    if (id === 1) {
        document.getElementById('muestra1').classList.remove('bg-blue-600', 'bg-red-600', 'bg-green-600', 'bg-white');
        document.getElementById('muestra1').classList.add(`bg-${bg}`);
    } else if (id === 2) {
        document.getElementById('muestra').classList.remove('bg-blue-600', 'bg-fuchsia-400', 'bg-yellow-400', 'bg-white');
        document.getElementById('muestra').classList.add(`bg-${bg}`);
    }
    const colors = {
        'blue-600': '#2563eb',
        'red-600': '#dc2626',
        'fuchsia-400': '#e879f9',
        'yellow-400': '#facc15',
        'red-500': '#22c55e',
        'white': '#78716c'
    };

    const brush = document.getElementById('brush');
    brush.style.fill = colors[bg] || colors['white'];

    let sound = new Audio();
    sound.src = `${props.asset_audio}/bubble.wav`;
    sound.play();
}

const error = (id) => {

    let sound = new Audio();
    sound.src = `${props.asset_audio}/wood.wav`;
    sound.play()
    document.getElementById(id).classList.remove('hover:bg-gray-400');
    document.getElementById(id).classList.remove('bg-white');
    document.getElementById(id).classList.add('bg-red-800');
    document.getElementById(id).classList.add('brush-fail');
    setTimeout(() => {
        document.getElementById(id).classList.remove('bg-red-800');
        document.getElementById(id).classList.remove('brush-fail');
        document.getElementById(id).classList.add('hover:bg-gray-400');
    }, 500);
}

const win = () => {
    let sound = new Audio();
    sound.src = `${props.asset_audio}${props.win_audio}`;
    sound.play();

    // document.getElementById('loader').classList.remove('hidden');
    // setTimeout(() => {
    //         document.getElementById('loader').classList.add('hidden');
    //         document.getElementById('loader').classList.remove('opacity-100');
    //         document.getElementById('loader').classList.add('opacity-0');
    // }, 2000);

    const loader = document.getElementById('loader');
    loader.classList.remove('hidden');

    setTimeout(() => {
        loader.classList.remove('opacity-0');
    }, 1)

    setTimeout(() => {
        loader.classList.add('opacity-0');
        setTimeout(() => {
            loader.classList.add('hidden');
            loader.classList.remove('opacity-0');
        }, 1500);
    }, 2500);


    setTimeout(() => {
        document.getElementById('nave').classList.add('avanzar');
        document.getElementById('b-1').classList.remove('bg-yellow-200');
        document.getElementById('fondoMati').classList.remove('bg-orange-200');
        document.getElementById('fondoMati').classList.add('bg-green-200');
        document.getElementById('b-1').classList.add('bg-red-400');

        document.getElementById('board').classList.remove('bg-white')
        document.getElementById('board').classList.add('bg-green-200')

        mati.value = `${props.asset_images}/dog/logrado.gif`
        widthMati.value = 200;
        talk.value = true;
        winLevel.value = true;
    }, 2500);
}

const boxClicked = (boxNumber) => {
    if (
        boxNumber === 3 || boxNumber === 13 || boxNumber === 23 ||
        boxNumber === 33 || boxNumber === 43 || boxNumber === 53 ||
        boxNumber === 63 || boxNumber === 73 || boxNumber === 83 ||
        boxNumber === 93 || boxNumber === 10 || boxNumber === 20 ||
        boxNumber === 30 || boxNumber === 40 || boxNumber === 50 ||
        boxNumber === 60 || boxNumber === 70 || boxNumber === 80 ||
        boxNumber === 90 || boxNumber === 100
    ) {
        paint(`caja${boxNumber}`)
    } else {
        error(`caja${boxNumber}`)
    }


}

const bottonLigth = (id) => {
    document.getElementById(id).classList.add('bg-gray-infinite')
}

const interactiveActivity = () => {

    for (let i = 101; i <= 103; i++) {
        const elementId = `caja${i}`;
        document.getElementById(elementId).classList.replace('opacity-0', 'opacity-100');
        setTimeout(function () {
            document.getElementById(elementId).classList.remove('scale-110', 'bg-red-500');
        }, 500)
    }

    // for (let i = 104; i <= 118; i++) {
    //     const elementId = `caja${i}`;
    //     document.getElementById(elementId).classList.add('scale-75', 'bg-gray-400', 'opacity-0');
    // }

    let myInterval = ''
    setTimeout(function () {
        document.getElementById('caja101').classList.add('bg-blue-600');
        audioColor2()
        setTimeout(function () {
            document.getElementById('caja102').classList.add('bg-red-600');
            audioColor3()
        }, 1000)
        setTimeout(function () {
            let sound = new Audio();
            sound.src = `${props.asset_audio}/voz1/permutaciones/ahoracolor.m4a`;
            sound.play();
            bottonLigth('caja103')
            focusId.value = 'caja103'
        }, 2000)
    }, 1000)

}

</script>

<template>
    <div id="loader"
         class="hidden fixed top-0 left-0 w-full h-full bg-black opacity-0 transition-opacity duration-500 z-50">
        <div class="flex items-center justify-center h-full">

            <div class="box-of-star1">
                <div class="star star-position1"></div>
                <div class="star star-position2"></div>
                <div class="star star-position3"></div>
                <div class="star star-position4"></div>
                <div class="star star-position5"></div>
                <div class="star star-position6"></div>
                <div class="star star-position7"></div>
            </div>
            <div class="box-of-star2">
                <div class="star star-position1"></div>
                <div class="star star-position2"></div>
                <div class="star star-position3"></div>
                <div class="star star-position4"></div>
                <div class="star star-position5"></div>
                <div class="star star-position6"></div>
                <div class="star star-position7"></div>
            </div>
            <div class="box-of-star3">
                <div class="star star-position1"></div>
                <div class="star star-position2"></div>
                <div class="star star-position3"></div>
                <div class="star star-position4"></div>
                <div class="star star-position5"></div>
                <div class="star star-position6"></div>
                <div class="star star-position7"></div>
            </div>
            <div class="box-of-star4">
                <div class="star star-position1"></div>
                <div class="star star-position2"></div>
                <div class="star star-position3"></div>
                <div class="star star-position4"></div>
                <div class="star star-position5"></div>
                <div class="star star-position6"></div>
                <div class="star star-position7"></div>
            </div>
            <div class="astronaut" data-js="astro">
                <div class="head"></div>
                <div class="arm arm-left"></div>
                <div class="arm arm-right"></div>
                <div class="body">
                    <div class="panel"></div>
                </div>
                <div class="leg leg-left"></div>
                <div class="leg leg-right"></div>
                <div class="schoolbag"></div>
            </div>
        </div>
    </div>


    <div class="min-h-full bg-space">
        <div class="container rounded-md">
            <div class="bg-orange-400 border-4 border-orange-600 flex-col rounded-md shadow-2xl">

                <div class="mx-5 grid md:grid-cols-12 gap-5">
                    <div id="fondoMati"
                         class="bg-orange-200 border-4 border-orange-600 rounded-md flex items-end justify-center col-span-2">
                        <div class="">

                            <div v-if="indexSquareFig === 'colors'" class="flex justify-center items-center mb-16">
                                <div :class="`${indexSquare}`">
                                    {{ null }}
                                </div>
                            </div>

                            <div v-if="indexSquareFig === 'eye'" class="flex justify-center items-center mb-16">
                                <div class="border-black border-2 p-2 bg-gray-200">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="90" height="90"
                                         viewBox="0 0 24 24">
                                        <path
                                            d="M12.015 7c4.751 0 8.063 3.012 9.504 4.636-1.401 1.837-4.713 5.364-9.504 5.364-4.42 0-7.93-3.536-9.478-5.407 1.493-1.647 4.817-4.593 9.478-4.593zm0-2c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 3c-2.21 0-4 1.791-4 4s1.79 4 4 4c2.209 0 4-1.791 4-4s-1.791-4-4-4zm-.004 3.999c-.564.564-1.479.564-2.044 0s-.565-1.48 0-2.044c.564-.564 1.479-.564 2.044 0s.565 1.479 0 2.044z"/>
                                    </svg>
                                </div>
                            </div>

                            <div v-if="indexSquareFig === 'paint'" class="flex justify-center items-center mb-16">
                                <div class="border-black border-2 p-2 bg-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90"
                                         viewBox="0 0 24 24">
                                        <path
                                            d="M18.58 0c-1.234 0-2.377.616-3.056 1.649-.897 1.37-.854 3.261-1.368 4.444-.741 1.708-3.873.343-5.532-.524-2.909 5.647-5.025 8.211-6.845 10.448 6.579 4.318 1.823 1.193 12.19 7.983 2.075-3.991 4.334-7.367 6.825-10.46-1.539-1.241-4.019-3.546-2.614-4.945 1-1 2.545-1.578 3.442-2.95 1.589-2.426-.174-5.645-3.042-5.645zm-5.348 21.138l-1.201-.763c0-.656.157-1.298.422-1.874-.609.202-1.074.482-1.618 1.043l-3.355-2.231c.531-.703.934-1.55.859-2.688-.482.824-1.521 1.621-2.331 1.745l-1.302-.815c1.136-1.467 2.241-3.086 3.257-4.728l8.299 5.462c-1.099 1.614-2.197 3.363-3.03 4.849zm6.724-16.584c-.457.7-2.445 1.894-3.184 2.632-.681.68-1.014 1.561-.961 2.548.071 1.354.852 2.781 2.218 4.085-.201.265-.408.543-.618.833l-8.428-5.548.504-.883c1.065.445 2.1.678 3.032.678 1.646 0 2.908-.733 3.464-2.012.459-1.058.751-3.448 1.206-4.145 1.206-1.833 3.964-.017 2.767 1.812zm-.644-.424c-.265.41-.813.523-1.22.257-.409-.267-.522-.814-.255-1.223.267-.409.813-.524 1.222-.257.408.266.521.817.253 1.223z"/>
                                    </svg>
                                </div>
                            </div>

                            <img @click="helpAudio" :src="mati" :width="widthMati" class="select-none"
                                 alt="">
                        </div>
                    </div>

                    <div id="board"
                         class="bg-white border-4 border-orange-600 rounded-md md:col-span-10 grid md:grid-cols-11 flex items-center">

                        <div :class="`${selectFig1} col-span-9 p-4`">
                            <ProgressBar :planet_1="`${localHost}/images/planets/tierra.svg`"
                                         :planet_2="`${localHost}/images/planets/rojo.svg`"
                                         :rocket="`${localHost}/images/rockets/1.svg`"
                                         :activity_number="props.level[1]"
                            />

                            <div id="vista" class="items-center justify-center p-2 mt-5 duration-300">
                                <div>
                                    <div class="">
                                        <div class="flex justify-center">
                                            <div class="grid grid-cols-3 gap-y-5 gap-x-1">

                                                <!--                                                <div v-for="i in 18" :key="i + 100" :id="`caja${i + 100}`"-->
                                                <!--                                                     :class="['p-6', 'border-black', 'border-2', 'cursor-cell', 'grid', 'hover:bg-gray-400', 'duration-300',-->
                                                <!--                                             { 'bg-red-600' : i + 100 === 102 || i + 100 === 106 || i + 100 === 107 || i + 100 === 110 || i + 100 === 115 || i + 100 === 117},-->
                                                <!--                                             { 'bg-blue-600': i + 100 === 101 || i + 100 === 104 || i + 100 === 109 || i + 100 === 111 || i + 100 === 114 || i + 100 === 118},-->
                                                <!--                                             { 'bg-green-500': i + 100 === 103 || i + 100 === 105 || i + 100 === 108 || i + 100 === 112 || i + 100 === 113 || i + 100 === 116}-->
                                                <!--                                             ]">-->
                                                <!--                                                    {{ null }}-->
                                                <!--                                                </div>-->
                                                <div v-for="i in 21" :key="i + 100" :id="`caja${i + 100}`"
                                                     @click="paint(`caja${i + 100}`)"
                                                     :class="['p-6', 'border-black', 'border-2', 'cursor-cell', 'grid', 'hover:bg-gray-400', 'duration-300', 'opacity-0'
                                             ]">
                                                    {{ null }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex justify-center items-center col-span-2 bg-rose-400 border-l-4 border-gray-200 h-full">
                            <div>

                                <div class="flex justify-center col-span-2 gap-10 py-[2%]">

                                    <button class="bg-gray-200 rounded-md py-[3%] px-[8%]">
                                        <IconShoppingCart/>
                                    </button>

                                    <button @click="pause()" class="bg-gray-200 rounded-md py-[3%] px-[8%]">
                                        <svg viewBox="-1 0 8 8" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                             width="26px"
                                             height="26px"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                               stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier"><title>pause [#1006]</title>
                                                <desc>Created with Sketch.</desc>
                                                <defs></defs>
                                                <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                   fill-rule="evenodd">
                                                    <g id="Dribbble-Light-Preview"
                                                       transform="translate(-227.000000, -3765.000000)"
                                                       fill="#000000">
                                                        <g id="icons" transform="translate(56.000000, 160.000000)">
                                                            <path
                                                                d="M172,3605 C171.448,3605 171,3605.448 171,3606 L171,3612 C171,3612.552 171.448,3613 172,3613 C172.552,3613 173,3612.552 173,3612 L173,3606 C173,3605.448 172.552,3605 172,3605 M177,3606 L177,3612 C177,3612.552 176.552,3613 176,3613 C175.448,3613 175,3612.552 175,3612 L175,3606 C175,3605.448 175.448,3605 176,3605 C176.552,3605 177,3605.448 177,3606"
                                                                id="pause-[#1006]"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>


                                <div class="flex justify-center col-span-2 items-center h-16">
                                    <div id="coins" class="flex gap-2 duration-300">
                                        <svg height="50px" width="50px" version="1.1" id="Layer_1"
                                             xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                             xml:space="preserve"
                                             fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                               stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier"> <path style="fill:#FFE14D;"
                                                                               d="M256,512C114.837,512,0,397.157,0,256S114.837,0,256,0s256,114.843,256,256S397.163,512,256,512z"></path>
                                                <path style="fill:#FFCC33;"
                                                      d="M512,256C512,114.843,397.163,0,256,0v512C397.163,512,512,397.157,512,256z"></path>
                                                <path style="fill:#FF9F19;"
                                                      d="M256,33.391C133.25,33.391,33.391,133.256,33.391,256S133.25,478.609,256,478.609 S478.609,378.744,478.609,256S378.75,33.391,256,33.391z M256,445.217c-104.337,0-189.217-84.881-189.217-189.217 S151.663,66.783,256,66.783S445.217,151.663,445.217,256S360.337,445.217,256,445.217z"></path>
                                                <path style="fill:#F28618;"
                                                      d="M445.217,256c0,104.337-84.881,189.217-189.217,189.217v33.391 c122.75,0,222.609-99.864,222.609-222.609S378.75,33.391,256,33.391v33.391C360.337,66.783,445.217,151.663,445.217,256z"></path>
                                                <path style="fill:#FF9F19;"
                                                      d="M317.217,300.522c0,27.937-18.922,51.534-44.522,58.88v7.903c0,9.238-7.456,16.696-16.696,16.696 s-16.696-7.457-16.696-16.696v-7.903c-25.6-7.346-44.522-30.943-44.522-58.88c0-9.238,7.456-16.696,16.696-16.696 c9.239,0,16.696,7.457,16.696,16.696c0,15.36,12.466,27.826,27.826,27.826s27.826-12.466,27.826-27.826 c0-0.779-0.111-1.224-0.223-1.558c-1.336-8.682-13.802-16.473-27.603-24.042c-2.56-1.337-5.231-2.783-7.791-4.119 c-23.82-12.576-53.426-28.27-53.426-59.324c0-27.937,18.922-51.534,44.522-58.88v-7.903c0-9.238,7.456-16.696,16.696-16.696 s16.696,7.457,16.696,16.696v7.903c25.6,7.346,44.522,30.943,44.522,58.88c0,9.238-7.456,16.696-16.696,16.696 s-16.696-7.457-16.696-16.696c0-15.36-12.466-27.826-27.826-27.826s-27.826,12.466-27.826,27.826c0,9.238,13.133,17.586,27.826,25.6 c2.56,1.336,5.231,2.783,7.791,4.118C287.612,253.774,317.217,269.468,317.217,300.522z"></path>
                                                <g> <path style="fill:#F28618;"
                                                          d="M317.217,300.522c0,27.937-18.922,51.534-44.522,58.88v7.903c0,9.238-7.456,16.696-16.696,16.696 v-55.652c15.36,0,27.826-12.466,27.826-27.826c0-0.779-0.111-1.224-0.223-1.558c-1.336-8.682-13.802-16.473-27.603-24.042v-37.843 c2.56,1.336,5.231,2.783,7.791,4.118C287.612,253.774,317.217,269.468,317.217,300.522z"></path>
                                                    <path style="fill:#F28618;"
                                                          d="M283.826,211.478c0,9.223,7.479,16.696,16.696,16.696c9.217,0,16.696-7.473,16.696-16.696 c0-27.961-18.869-51.551-44.522-58.843v-7.939c0-9.223-7.479-16.696-16.696-16.696v55.652 C271.348,183.652,283.826,196.136,283.826,211.478z"></path> </g> </g></svg>


                                        <!--                        <svg height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 488 488" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#F0F7F7;" cx="244" cy="244" r="244"></circle> <path style="fill:#B2CECE;" d="M488,244c0,134.4-109.6,244-244,244S0,378.4,0,244"></path> <path style="fill:#D1E7E8;" d="M488,244c0,134.4-109.6,228.8-244,228.8S0,378.4,0,244S109.6,15.2,244,15.2S488,109.6,488,244z"></path> <g> <path style="fill:#BFDBDB;" d="M244,15.2c134.4,0,244,93.6,244,228.8c0,134.4-109.6,228.8-244,228.8"></path> <path style="fill:#BFDBDB;" d="M428,244c0,101.6-82.4,172.8-184,172.8S60,345.6,60,244S142.4,58.4,244,58.4S428,142.4,428,244z"></path> <path style="fill:#BFDBDB;" d="M428,244c0,101.6-82.4,188-184,188S60,345.6,60,244S142.4,71.2,244,71.2S428,142.4,428,244z"></path> </g> <path style="fill:#DAEFEF;" d="M428,244c0,101.6-82.4,172.8-184,172.8S60,345.6,60,244S142.4,71.2,244,71.2S428,142.4,428,244z"></path> <path style="fill:#C5E2E2;" d="M244,71.2c101.6,0,184,71.2,184,172.8s-82.4,172.8-184,172.8"></path> <path style="fill:#F0F7F7;" d="M244,379.2c-81.6,0-142.4-57.6-142.4-133.6S162.4,111.2,244,111.2s142.4,57.6,142.4,133.6 S325.6,379.2,244,379.2z M244,126.4c-72.8,0-127.2,51.2-127.2,118.4c0,68,54.4,119.2,127.2,119.2s127.2-51.2,127.2-118.4 C371.2,177.6,316.8,126.4,244,126.4z"></path> <path style="fill:#E7F7F6;" d="M371.2,245.6c0,67.2-54.4,118.4-127.2,118.4v15.2c81.6,0,142.4-57.6,142.4-133.6 S325.6,111.2,244,111.2v15.2C316.8,126.4,371.2,177.6,371.2,245.6z"></path> </g></svg>-->
                                        <!--<svg height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 488 488" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#F0F7F7;" cx="244" cy="244" r="244"></circle> <path style="fill:#B2CECE;" d="M488,244c0,134.4-109.6,244-244,244S0,378.4,0,244"></path> <path style="fill:#D1E7E8;" d="M488,244c0,134.4-109.6,228.8-244,228.8S0,378.4,0,244S109.6,15.2,244,15.2S488,109.6,488,244z"></path> <g> <path style="fill:#BFDBDB;" d="M244,15.2c134.4,0,244,93.6,244,228.8c0,134.4-109.6,228.8-244,228.8"></path> <path style="fill:#BFDBDB;" d="M428,244c0,101.6-82.4,172.8-184,172.8S60,345.6,60,244S142.4,58.4,244,58.4S428,142.4,428,244z"></path> <path style="fill:#BFDBDB;" d="M428,244c0,101.6-82.4,188-184,188S60,345.6,60,244S142.4,71.2,244,71.2S428,142.4,428,244z"></path> </g> <path style="fill:#DAEFEF;" d="M428,244c0,101.6-82.4,172.8-184,172.8S60,345.6,60,244S142.4,71.2,244,71.2S428,142.4,428,244z"></path> <path style="fill:#C5E2E2;" d="M244,71.2c101.6,0,184,71.2,184,172.8s-82.4,172.8-184,172.8"></path> <path style="fill:#F0F7F7;" d="M244,379.2c-81.6,0-142.4-57.6-142.4-133.6S162.4,111.2,244,111.2s142.4,57.6,142.4,133.6 S325.6,379.2,244,379.2z M244,126.4c-72.8,0-127.2,51.2-127.2,118.4c0,68,54.4,119.2,127.2,119.2s127.2-51.2,127.2-118.4 C371.2,177.6,316.8,126.4,244,126.4z"></path> <path style="fill:#E7F7F6;" d="M371.2,245.6c0,67.2-54.4,118.4-127.2,118.4v15.2c81.6,0,142.4-57.6,142.4-133.6 S325.6,111.2,244,111.2v15.2C316.8,126.4,371.2,177.6,371.2,245.6z"></path> </g></svg>-->
                                        <!--<svg height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 488 488" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#F0F7F7;" cx="244" cy="244" r="244"></circle> <path style="fill:#B2CECE;" d="M488,244c0,134.4-109.6,244-244,244S0,378.4,0,244"></path> <path style="fill:#D1E7E8;" d="M488,244c0,134.4-109.6,228.8-244,228.8S0,378.4,0,244S109.6,15.2,244,15.2S488,109.6,488,244z"></path> <g> <path style="fill:#BFDBDB;" d="M244,15.2c134.4,0,244,93.6,244,228.8c0,134.4-109.6,228.8-244,228.8"></path> <path style="fill:#BFDBDB;" d="M428,244c0,101.6-82.4,172.8-184,172.8S60,345.6,60,244S142.4,58.4,244,58.4S428,142.4,428,244z"></path> <path style="fill:#BFDBDB;" d="M428,244c0,101.6-82.4,188-184,188S60,345.6,60,244S142.4,71.2,244,71.2S428,142.4,428,244z"></path> </g> <path style="fill:#DAEFEF;" d="M428,244c0,101.6-82.4,172.8-184,172.8S60,345.6,60,244S142.4,71.2,244,71.2S428,142.4,428,244z"></path> <path style="fill:#C5E2E2;" d="M244,71.2c101.6,0,184,71.2,184,172.8s-82.4,172.8-184,172.8"></path> <path style="fill:#F0F7F7;" d="M244,379.2c-81.6,0-142.4-57.6-142.4-133.6S162.4,111.2,244,111.2s142.4,57.6,142.4,133.6 S325.6,379.2,244,379.2z M244,126.4c-72.8,0-127.2,51.2-127.2,118.4c0,68,54.4,119.2,127.2,119.2s127.2-51.2,127.2-118.4 C371.2,177.6,316.8,126.4,244,126.4z"></path> <path style="fill:#E7F7F6;" d="M371.2,245.6c0,67.2-54.4,118.4-127.2,118.4v15.2c81.6,0,142.4-57.6,142.4-133.6 S325.6,111.2,244,111.2v15.2C316.8,126.4,371.2,177.6,371.2,245.6z"></path> </g></svg>-->


                                        <!--                                                <svg height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"-->
                                        <!--                             xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"-->
                                        <!--                             fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>-->
                                        <!--                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>-->
                                        <!--                            <g id="SVGRepo_iconCarrier"> <path style="fill:#FFE14D;"-->
                                        <!--                                                               d="M256,512C114.837,512,0,397.157,0,256S114.837,0,256,0s256,114.843,256,256S397.163,512,256,512z"></path>-->
                                        <!--                                <path style="fill:#FFCC33;"-->
                                        <!--                                      d="M512,256C512,114.843,397.163,0,256,0v512C397.163,512,512,397.157,512,256z"></path>-->
                                        <!--                                <path style="fill:#FF9F19;"-->
                                        <!--                                      d="M256,33.391C133.25,33.391,33.391,133.256,33.391,256S133.25,478.609,256,478.609 S478.609,378.744,478.609,256S378.75,33.391,256,33.391z M256,445.217c-104.337,0-189.217-84.881-189.217-189.217 S151.663,66.783,256,66.783S445.217,151.663,445.217,256S360.337,445.217,256,445.217z"></path>-->
                                        <!--                                <path style="fill:#F28618;"-->
                                        <!--                                      d="M445.217,256c0,104.337-84.881,189.217-189.217,189.217v33.391 c122.75,0,222.609-99.864,222.609-222.609S378.75,33.391,256,33.391v33.391C360.337,66.783,445.217,151.663,445.217,256z"></path>-->
                                        <!--                                <path style="fill:#FF9F19;"-->
                                        <!--                                      d="M317.217,300.522c0,27.937-18.922,51.534-44.522,58.88v7.903c0,9.238-7.456,16.696-16.696,16.696 s-16.696-7.457-16.696-16.696v-7.903c-25.6-7.346-44.522-30.943-44.522-58.88c0-9.238,7.456-16.696,16.696-16.696 c9.239,0,16.696,7.457,16.696,16.696c0,15.36,12.466,27.826,27.826,27.826s27.826-12.466,27.826-27.826 c0-0.779-0.111-1.224-0.223-1.558c-1.336-8.682-13.802-16.473-27.603-24.042c-2.56-1.337-5.231-2.783-7.791-4.119 c-23.82-12.576-53.426-28.27-53.426-59.324c0-27.937,18.922-51.534,44.522-58.88v-7.903c0-9.238,7.456-16.696,16.696-16.696 s16.696,7.457,16.696,16.696v7.903c25.6,7.346,44.522,30.943,44.522,58.88c0,9.238-7.456,16.696-16.696,16.696 s-16.696-7.457-16.696-16.696c0-15.36-12.466-27.826-27.826-27.826s-27.826,12.466-27.826,27.826c0,9.238,13.133,17.586,27.826,25.6 c2.56,1.336,5.231,2.783,7.791,4.118C287.612,253.774,317.217,269.468,317.217,300.522z"></path>-->
                                        <!--                                <g> <path style="fill:#F28618;"-->
                                        <!--                                          d="M317.217,300.522c0,27.937-18.922,51.534-44.522,58.88v7.903c0,9.238-7.456,16.696-16.696,16.696 v-55.652c15.36,0,27.826-12.466,27.826-27.826c0-0.779-0.111-1.224-0.223-1.558c-1.336-8.682-13.802-16.473-27.603-24.042v-37.843 c2.56,1.336,5.231,2.783,7.791,4.118C287.612,253.774,317.217,269.468,317.217,300.522z"></path>-->
                                        <!--                                    <path style="fill:#F28618;"-->
                                        <!--                                          d="M283.826,211.478c0,9.223,7.479,16.696,16.696,16.696c9.217,0,16.696-7.473,16.696-16.696 c0-27.961-18.869-51.551-44.522-58.843v-7.939c0-9.223-7.479-16.696-16.696-16.696v55.652 C271.348,183.652,283.826,196.136,283.826,211.478z"></path> </g> </g></svg>-->


                                        <span id="coinsCount" class="text-white font-bold text-4xl">x 0</span>

                                    </div>

                                    <div id="addCoin"
                                         class="flex justify-center col-span-2 items-center gap-2 hidden opacity-0 duration-300">
                                        <div class="loader border-r-2 rounded-full border-yellow-500 bg-yellow-300 animate-bounce shadow-xl shadow-yellow-400
                                aspect-square w-8 flex justify-center items-center text-yellow-700">$
                                        </div>
                                        <span class="text-white font-bold text-xl duration-300">+1</span>
                                    </div>
                                </div>

                                <div
                                    class="bg-red-100 col-span-2 flex justify-center m-3 p-2 rounded-md border-orange-400 border-4 border-dashed">
                                    <span class="font-semibold text-xl text-center">Paleta de colores</span>
                                </div>


                                <div class="flex justify-center col-span-2">
                                    <div>
                                        <div class="grid grid-cols-2 gap-5 mt-5">

                                            <div @click="selectColor(item)" v-for="item in props.items"
                                                 class="flex justify-center items-center w-full h-full">
                                                <button
                                                    :class="['bg-gray-100 shadow-md rounded-lg hover:opacity-75 hover:scale-95 duration-300 select-none font-bold text-6xl w-20 h-20 flex justify-center items-center' ,
                        ]">

                                                    {{
                                                        item.type === types.letter || item.type === types.number ? item.name : null
                                                    }}

                                                    <IconPaintBrush v-if="item.type === types.color" :hex="item.hex"/>

                                                    <img
                                                        v-if="item.type === types.image || item.type === types.figure || item.type === types.eraser"
                                                        :src="item.content" alt=""
                                                        :class="[
                                                         {'w-[30px]' : item.size === sizes.small},
                                                         {'w-[40px]' : item.size === sizes.normal},
                                                         {'w-[50px]' : item.size === sizes.big} ]">
                                                </button>
                                            </div>

                                            <div class="flex justify-center">
                                                <button @click="selectColor('green-600',1)"
                                                        class="rounded-md p-2 shadow-md bg-gray-300">
                                                    <svg class=""
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         width="50"
                                                         height="50"
                                                         viewBox="0 0 24 24">
                                                        <path
                                                            d="M0 21.398c5.504.456 3.533-5.392 8.626-5.445l2.206 1.841c.549 6.645-7.579 8.127-10.832 3.604zm16.878-8.538c1.713-2.687 7.016-11.698 7.016-11.698.423-.747-.515-1.528-1.17-.976 0 0-7.887 6.857-10.213 9.03-1.838 1.719-1.846 2.504-2.441 5.336l2.016 1.681c2.67-1.098 3.439-1.248 4.792-3.373z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <div class="flex justify-center">
                                                <button @click="selectColor('green-600',1)"
                                                        class="rounded-md p-2 shadow-md bg-gray-300">
                                                    <svg class="icon-green"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         width="50"
                                                         height="50"
                                                         viewBox="0 0 24 24">
                                                        <path
                                                            d="M0 21.398c5.504.456 3.533-5.392 8.626-5.445l2.206 1.841c.549 6.645-7.579 8.127-10.832 3.604zm16.878-8.538c1.713-2.687 7.016-11.698 7.016-11.698.423-.747-.515-1.528-1.17-.976 0 0-7.887 6.857-10.213 9.03-1.838 1.719-1.846 2.504-2.441 5.336l2.016 1.681c2.67-1.098 3.439-1.248 4.792-3.373z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <div class="flex justify-center">
                                                <button @click="selectColor('blue-600',1)"
                                                        class="rounded-md p-2 shadow-md bg-gray-300">
                                                    <svg class="icon-blue"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         width="50"
                                                         height="50" viewBox="0 0 24 24">
                                                        <path
                                                            d="M0 21.398c5.504.456 3.533-5.392 8.626-5.445l2.206 1.841c.549 6.645-7.579 8.127-10.832 3.604zm16.878-8.538c1.713-2.687 7.016-11.698 7.016-11.698.423-.747-.515-1.528-1.17-.976 0 0-7.887 6.857-10.213 9.03-1.838 1.719-1.846 2.504-2.441 5.336l2.016 1.681c2.67-1.098 3.439-1.248 4.792-3.373z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <div class="flex justify-center">
                                                <button @click="selectColor('red-600',1)"
                                                        class="rounded-md p-2 shadow-md bg-gray-300">
                                                    <svg class="icon-red"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         width="50"
                                                         height="50" viewBox="0 0 24 24">
                                                        <path
                                                            d="M0 21.398c5.504.456 3.533-5.392 8.626-5.445l2.206 1.841c.549 6.645-7.579 8.127-10.832 3.604zm16.878-8.538c1.713-2.687 7.016-11.698 7.016-11.698.423-.747-.515-1.528-1.17-.976 0 0-7.887 6.857-10.213 9.03-1.838 1.719-1.846 2.504-2.441 5.336l2.016 1.681c2.67-1.098 3.439-1.248 4.792-3.373z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <button @click="selectColor('white',1)"
                                                    class="relative rounded-md p-2 shadow-md bg-gray-300  flex justify-center select-none">
                                                <div class="relative">
                                                    <img :src="eraser" alt="borrador" width="50">
                                                </div>
                                            </button>

                                            <div id="muestra1"
                                                 class="border-2 border-black py-5 mt-5 bg-white col-span-2 shadow-2xl shadow-blue-900"></div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<style scoped>

.icon-green {
    fill: #16a34a;
}

.icon {
    fill: black;
}

.icon:hover {
    fill: white;
}

.icon-fuchsia {
    fill: #e879f9
}

.icon-fuchsia:hover {
    fill: #a855f7
}

.icon-blue {
    fill: #2563eb;
}

.icon-blue:hover {
    fill: #1d4ed8;
}

.icon-red {
    fill: #dc2626;
}

.icon-red:hover {
    fill: #b91c1c;
}

.icon-yellow {
    fill: #eab308;
}

.icon-yellow:hover {
    fill: #ca8a04;
}

.icon-pink {
    fill: #ec4899;
}

.icon-pink:hover {
    fill: #db2777;
}

.arrow {
    animation: move-right 800ms linear infinite;
}

@keyframes move-right {
    0% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(30px);
    }
    100% {
        transform: translateX(0);
    }
}

.brush {
    animation: move-right 300ms linear infinite;
    fill: #22c55e;
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

.eraser {
    animation: move-right 900ms linear infinite;
}

@keyframes move-right {
    0% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(5px);
    }
    100% {
        transform: translateX(0);
    }
}

.avanzar {
    transform: translateX(100px);
    transition: transform 0.5s ease-in-out;
}


/*Astronauta*/
@keyframes snow {
    0% {
        opacity: 0;
        transform: translateY(0px);
    }

    20% {
        opacity: 1;
    }

    100% {
        opacity: 1;
        transform: translateY(650px);
    }
}

@keyframes astronaut {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

.box-of-star1,
.box-of-star2,
.box-of-star3,
.box-of-star4 {
    width: 100%;
    position: absolute;
    z-index: 10;
    left: 0;
    transform: translateY(650px);
    height: 700px;
}

.box-of-star1 {
    animation: snow 5s linear infinite;
}

.box-of-star2 {
    animation: snow 5s -1.64s linear infinite;
}

.box-of-star3 {
    animation: snow 5s -2.30s linear infinite;
}

.box-of-star4 {
    animation: snow 5s -3.30s linear infinite;
}

.star {
    width: 3px;
    height: 3px;
    border-radius: 50%;
    background-color: #FFF;
    position: absolute;
    z-index: 10;
    opacity: 0.7;
}

.star:before {
    content: "";
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: #FFF;
    position: absolute;
    z-index: 10;
    top: 80px;
    left: 70px;
    opacity: .7;
}

.star:after {
    content: "";
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #FFF;
    position: absolute;
    z-index: 10;
    top: 8px;
    left: 170px;
    opacity: .9;
}

.star-position1 {
    top: 30px;
    left: 20px;
}

.star-position2 {
    top: 110px;
    left: 250px;
}

.star-position3 {
    top: 60px;
    left: 570px;
}

.star-position4 {
    top: 120px;
    left: 900px;
}

.star-position5 {
    top: 20px;
    left: 1120px;
}

.star-position6 {
    top: 90px;
    left: 1280px;
}

.star-position7 {
    top: 30px;
    left: 1480px;
}

.astronaut {
    width: 250px;
    height: 300px;
    position: absolute;
    z-index: 11;
    top: calc(50% - 150px);
    left: calc(50% - 125px);
    animation: astronaut 5s linear infinite;
}

.schoolbag {
    width: 100px;
    height: 150px;
    position: absolute;
    z-index: 1;
    top: calc(50% - 75px);
    left: calc(50% - 50px);
    background-color: #94b7ca;
    border-radius: 50px 50px 0 0 / 30px 30px 0 0;
}

.head {
    width: 97px;
    height: 80px;
    position: absolute;
    z-index: 3;
    background: -webkit-linear-gradient(left, #e3e8eb 0%, #e3e8eb 50%, #fbfdfa 50%, #fbfdfa 100%);
    border-radius: 50%;
    top: 34px;
    left: calc(50% - 47.5px);
}

.head:after {
    content: "";
    width: 60px;
    height: 50px;
    position: absolute;
    top: calc(50% - 25px);
    left: calc(50% - 30px);
    background: -webkit-linear-gradient(top, #15aece 0%, #15aece 50%, #0391bf 50%, #0391bf 100%);
    border-radius: 15px;
}

.head:before {
    content: "";
    width: 12px;
    height: 25px;
    position: absolute;
    top: calc(50% - 12.5px);
    left: -4px;
    background-color: #618095;
    border-radius: 5px;
    box-shadow: 92px 0px 0px #618095;
}

.body {
    width: 85px;
    height: 100px;
    position: absolute;
    z-index: 2;
    background-color: #fffbff;
    border-radius: 40px / 20px;
    top: 105px;
    left: calc(50% - 41px);
    background: -webkit-linear-gradient(left, #e3e8eb 0%, #e3e8eb 50%, #fbfdfa 50%, #fbfdfa 100%);
}

.panel {
    width: 60px;
    height: 40px;
    position: absolute;
    top: 20px;
    left: calc(50% - 30px);
    background-color: #b7cceb;
}

.panel:before {
    content: "";
    width: 30px;
    height: 5px;
    position: absolute;
    top: 9px;
    left: 7px;
    background-color: #fbfdfa;
    box-shadow: 0px 9px 0px #fbfdfa, 0px 18px 0px #fbfdfa;
}

.panel:after {
    content: "";
    width: 8px;
    height: 8px;
    position: absolute;
    top: 9px;
    right: 7px;
    background-color: #fbfdfa;
    border-radius: 50%;
    box-shadow: 0px 14px 0px 2px #fbfdfa;
}

.arm {
    width: 80px;
    height: 30px;
    position: absolute;
    top: 121px;
    z-index: 2;
}

.arm-left {
    left: 30px;
    background-color: #e3e8eb;
    border-radius: 0 0 0 39px;
}

.arm-right {
    right: 30px;
    background-color: #fbfdfa;
    border-radius: 0 0 39px 0;
}

.arm-left:before,
.arm-right:before {
    content: "";
    width: 30px;
    height: 70px;
    position: absolute;
    top: -40px;
}

.arm-left:before {
    border-radius: 50px 50px 0px 120px / 50px 50px 0 110px;
    left: 0;
    background-color: #e3e8eb;
}

.arm-right:before {
    border-radius: 50px 50px 120px 0 / 50px 50px 110px 0;
    right: 0;
    background-color: #fbfdfa;
}

.arm-left:after,
.arm-right:after {
    content: "";
    width: 30px;
    height: 10px;
    position: absolute;
    top: -24px;
}

.arm-left:after {
    background-color: #6e91a4;
    left: 0;
}

.arm-right:after {
    right: 0;
    background-color: #b6d2e0;
}

.leg {
    width: 30px;
    height: 40px;
    position: absolute;
    z-index: 2;
    bottom: 70px;
}

.leg-left {
    left: 76px;
    background-color: #e3e8eb;
    transform: rotate(20deg);
}

.leg-right {
    right: 73px;
    background-color: #fbfdfa;
    transform: rotate(-20deg);
}

.leg-left:before,
.leg-right:before {
    content: "";
    width: 50px;
    height: 25px;
    position: absolute;
    bottom: -26px;
}

.leg-left:before {
    left: -20px;
    background-color: #e3e8eb;
    border-radius: 30px 0 0 0;
    border-bottom: 10px solid #6d96ac;
}

.leg-right:before {
    right: -20px;
    background-color: #fbfdfa;
    border-radius: 0 30px 0 0;
    border-bottom: 10px solid #b0cfe4;
}

.bg-gray-infinite {
    animation: gray-infinite 2s infinite;
}

@keyframes gray-infinite {
    0% {
        background-color: white;
    }

    50% {
        background-color: gray;
    }

    100% {
        background-color: white;
    }
}
</style>
