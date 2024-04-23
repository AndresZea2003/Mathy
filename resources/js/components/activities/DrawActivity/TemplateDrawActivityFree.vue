<script setup>
import { onMounted, onUpdated, ref } from 'vue';

//Importacion componentes
import AnimatedStars from './AnimatedStars.vue';
import FinishedLevel from './FinishedLevel.vue';
import BackgroundActivities from '../../background/BackgroundActivities.vue';

//Importacion de imagenes
import line1 from '../../../../../public/images/draw-image/line1.png';
import line2 from '../../../../../public/images/draw-image/Line2.png';
import line3 from '../../../../../public/images/draw-image/line3.png';
import line4 from '../../../../../public/images/draw-image/line4.png';
import brush from '../../../../../public/images/draw-image/brush.png';
import eraser from '../../../../../public/images/draw-image/eraser.png';
import mainBorder from '../../../../../public/images/draw-image/main-border.png';



//Ref para definir el tamaño del div padre y convertirlo a tamaño de pantalla.
const responsiveScreen = ref(false);
const responsiveScreen900px = ref(false);
const responsiveExampleMobile = ref(false);
const widthRef = ref(null);


//Ref que controla si el borrador fue elegido o no
const eraserSelect = ref(false);


//Ref que controlan directamente el pintado

//Color de la brocha
const brushColor = ref('black');

//Tamaño de la brocha
const sizeBrush = ref(10);

//Color del fondo
const bgColorRef = ref(null);

//Porcentaje de pintado de la superficie
const porcentajePintado = ref(null);

//Ref que controla el aviso de que se pinto el dibujo
const finishedLevelActivate = ref(false);

//Ref que controla si el letrero de nivel pasado se activa de nuevo
const finishedLevel = ref(false);

//Ref que controla la paleta de colores para movil retractil
const openColor = ref(false);

//Indica si se esta pintando en ese momento
let isDrawing = false;

//variables creadas para indicar la ubicacion en donde se comienza a pintar
let initialX, initialY;

//Importacion configuracion de niveles
import { drawingDataFree } from '../../../use/drawingData';

let drawingData = drawingDataFree[props.level - 1];


//funcion que controla el tamaño de brocha
const sizeBrushSelection = (size) => {
    sizeBrush.value = size;
};

//ubicacion del canvas y el color de fondo
const canvasLocation = (bgColor, location) => {
    isDrawing = false;
    bgColorRef.value = bgColor;
    porcentajePintado.value = location;
};


const drawing = (cursorX, cursorY, canvas) => {
    if (isDrawing && canvas) {
        const ctx = canvas.getContext('2d');
        if (cursorX >= 0 && cursorX <= canvas.width && cursorY >= 0 && cursorY <= canvas.height) {
            ctx.beginPath();
            ctx.moveTo(initialX, initialY);
            ctx.lineWidth = sizeBrush.value;
            ctx.strokeStyle = brushColor.value;
            ctx.lineCap = "round";
            ctx.lineJoin = "round";
            ctx.lineTo(cursorX, cursorY);
            ctx.stroke();

            initialX = cursorX;
            initialY = cursorY;

            verificarSuperficie(ctx);
        }
    }
};


//codigo para el touch de movil
const touchStart = (event, bgColor, location) => {
    canvasLocation(bgColor, location);
    const canvas = event.target;
    const rect = canvas.getBoundingClientRect();
    const scaleX = canvas.width / rect.width;
    const scaleY = canvas.height / rect.height;
    const touch = event.touches[0];
    initialX = (touch.clientX - rect.left) * scaleX;
    initialY = (touch.clientY - rect.top) * scaleY;
    drawing(initialX, initialY, canvas);
    isDrawing = true;
};

const touchMove = (event) => {
    const canvas = event.target;
    const rect = canvas.getBoundingClientRect();
    const scaleX = canvas.width / rect.width;
    const scaleY = canvas.height / rect.height;
    const touch = event.touches[0];
    const adjustedX = (touch.clientX - rect.left) * scaleX;
    const adjustedY = (touch.clientY - rect.top) * scaleY;
    drawing(adjustedX, adjustedY, canvas);
};

const touchEnd = () => {
    isDrawing = false;
};



//Codigo para interacciones con mouse
const mouseDown = (event, canvasId) => {
    const canvas = document.getElementById(canvasId);
    const rect = canvas.getBoundingClientRect();
    const scaleX = canvas.width / rect.width;
    const scaleY = canvas.height / rect.height;
    initialX = (event.clientX - rect.left) * scaleX;
    initialY = (event.clientY - rect.top) * scaleY;
    drawing(initialX, initialY, canvas);

    isDrawing = true;
};



const mouseMoving = (event, canvasId) => {
    const canvas = document.getElementById(canvasId);
    const rect = canvas.getBoundingClientRect();
    const scaleX = canvas.width / rect.width;
    const scaleY = canvas.height / rect.height;
    const adjustedX = (event.clientX - rect.left) * scaleX;
    const adjustedY = (event.clientY - rect.top) * scaleY;

    drawing(adjustedX, adjustedY, canvas);
};


const mouseUp = () => {
    isDrawing = false;
};


const verificarSuperficie = (ctx) => {
    const imageData = ctx.getImageData(0, 0, ctx.canvas.width, ctx.canvas.height);
    const data = imageData.data;
    const bgColor = bgColorRef.value;
    let bgColorCount = 0;

    for (let i = 0; i < data.length; i += 4) {
        const pixelColor = `rgb(${data[i]}, ${data[i + 1]}, ${data[i + 2]})`;
        if (pixelColor === bgColor) {
            bgColorCount++;
        }
    }

    const totalPixels = data.length / 4;

    if(!finishedLevel.value){
        if (bgColorCount / totalPixels <= porcentajePintado.value) {
            finishedLevelActivate.value = true;
            finishedLevel.value = true;

            setTimeout(() => {
                finishedLevelActivate.value = false;
            }, 7000);
        }
    }
};




//Props
const props = defineProps({
    level: Number
});


//Width limite
let widthLimit = 1300;
let widthLimit900 = 900;


//Funcion que compara el tamaño con el tamaño limite para elegir el componente a mostrar.
const calculatedResponsive = () => {
    if (parseInt(widthRef.value) < widthLimit) {
        responsiveScreen.value = false;
    } else if (parseInt(widthRef.value) >= widthLimit) {
        responsiveScreen.value = true;
    };
};

//Funcion para calcular el momento de aparicion de la imagen para el tamaño de pantalla 900px
const calculated900pximg = () => {
    if (parseInt(widthRef.value) >= widthLimit900 && parseInt(widthRef.value) < widthLimit) {
        responsiveScreen900px.value = true;
    } else {
        responsiveScreen900px.value = false;
    }
}

//Funcion para calcular el momento de aparicion de la imagen ejemplo para movil
const calculatedMobileExampleImage = () => {
    if (parseInt(widthRef.value) < widthLimit900) {
        responsiveExampleMobile.value = true;
    } else {
        responsiveExampleMobile.value = false;
    }
}

//On mounted que se ejecuta antes de montar el componente que calcula el tamaño del componente padre.
onMounted(() => {
    let divClassWidth = document.querySelector('.template-draw__div--container');

    widthRef.value = divClassWidth.offsetWidth;

    calculatedResponsive();
    calculated900pximg();
    calculatedMobileExampleImage();
});


//on update que se ejecuta cuando se actualiza el tamaño del componente para cambiar a el componente que se debe mostrar.
onUpdated(() => {
    calculatedResponsive();
    calculated900pximg();
    calculatedMobileExampleImage();
});


//Funcion para cambiar el color de la brocha
const colorBrushFunction = (color, eraser) => {
    setTimeout(() => {
        exitColorFunction();
    }, 100);
    brushColor.value = color;
    eraserSelect.value = eraser;
};


//Funcion para abrir la paleta de colores en movil
const openColorFunction = () => {
    if(responsiveExampleMobile.value){
        openColor.value = true;
        console.log("verificando 900", responsiveExampleMobile.value);
        console.log("Entrando abrir");
    };
};

const exitColorFunction = () => {
    if(responsiveExampleMobile.value){
        openColor.value = false;
    };
};

console.log("reponsiveScreen", responsiveExampleMobile.value);
</script>

<template>
    <div class="template-draw__div--container">
        <BackgroundActivities/>
        <FinishedLevel v-if="finishedLevelActivate" :finishedLevels="false"/>
        <div
            class="template-draw__div--main-div w-full h-full fixed m-auto overflow-hidden xl:absolute xl:top-1/2 xl:left-1/2">
            <AnimatedStars />
            <!-- lineas del fondo -->
            <img class="template__img--line4 w-full absolute pointer-events-none select-none" :src="line4" alt="line" />
            <img class="template__img--line3 w-full absolute pointer-events-none select-none" :src="line3" alt="line" />
            <img class="template__img--line2 w-full absolute pointer-events-none select-none" :src="line2" alt="line" />
            <img class="template__img--line1 w-full absolute pointer-events-none select-none" :src="line1" alt="line" />
            <!-- efecto y brocha animada -->
            <div v-if="responsiveScreen" class="template__div--draw-effect absolute z-10 bottom-2.5 left-40"></div>
            <img v-if="responsiveScreen" class="template__img--brush absolute z-10 bottom-6 pointer-events-none select-none" :src="brush"
                alt="brush" />





            <!-- Codigo del pintado en canvas -->
            <div class="template__div--draw-container-canvas m-auto absolute inset-x-0 z-30 xl:m-auto xl:bottom-9">
                <canvas @touchstart.prevent="touchStart($event, 'rgb(0, 0, 0)', drawingData.correctPercentage)"
                    @touchmove.prevent="touchMove" @touchend.prevent="touchEnd" @mouseup="mouseUp"
                    @mouseenter="canvasLocation('rgb(0, 0, 0)', drawingData.correctPercentage)" @mousedown="mouseDown($event, `draw`)"
                    @mousemove="mouseMoving($event, `draw`)" :id="`draw`"
                    class="w-full h-full" :style="{backgroundColor: 'rgb(255, 255, 255)'}"></canvas>
                <div
                    class="template__div--draw-image w-full h-full absolute top-0 left-0 bg-cover bg-center pointer-events-none" :style="{backgroundImage: `url(${drawingData.drawImage})`}">
                </div>
            </div>



            <img class="template-draw__img--main-border absolute m-auto inset-x-0 z-40 pointer-events-none"
                :src="mainBorder" alt="main-border" />

        </div>
        <div class="template-draw__div--right-column absolute m-auto inset-x-0 flex items-center justify-center flex-col"
            :style="!responsiveScreen ? ({ border: `solid ${brushColor} 5px`, borderRadius: '10px' }) : ({})">


            <div
                @click="openColorFunction()"
                class="template-draw__div--container-color-button rounded-xl relative justify-around items-center"
                :style="{
                    display: openColor || !responsiveExampleMobile ? ('grid'):('flex'),
                    gridTemplateColumns: 'auto auto auto auto',
                    height: openColor || !responsiveExampleMobile ? ('200px'):('50px'),
                    bottom:  openColor || !responsiveExampleMobile ? ('150px'):('auto'),
                    position: openColor ? ('absolute'):('relative')
                }"
            >
                <button class="template-draw__button--color hover:scale-110"
                    @click="colorBrushFunction('rgb(255, 255, 255)', true)" :style="{pointerEvents: !openColor && responsiveExampleMobile ? ('none'):('auto')}"><img class="rounded-full" :src="eraser"
                        alt="eraser"
                        :style="{ border: eraserSelect ? ('solid 5px white') : ('solid 3px white') }" /></button>
                <button v-for="color, index in drawingData.colorPalette" :key="index"
                    class="template-draw__button--color hover:scale-110"
                    :style="{ backgroundColor: color, border: brushColor === color ? ('solid 5px white') : ('solid 3px white'), pointerEvents: !openColor && responsiveExampleMobile ? ('none'):('auto') }"
                    @click="colorBrushFunction(color, false)"></button>
            </div>


            <div
                class="template-draw__div--container-size-brush flex items-center justify-around rounded-xl">
                <button @click="sizeBrushSelection(5)"
                    class="w-10 h-10 bg-black rounded-full border-inherit border-8 hover:scale-110"></button>
                <button @click="sizeBrushSelection(10)"
                    class="w-10 h-10 bg-black rounded-full border-inherit border-4 hover:scale-110"></button>
                <button @click="sizeBrushSelection(20)"
                    class="w-10 h-10 bg-black rounded-full border-inherit border-2 hover:scale-110"></button>
            </div>
            <div v-if="responsiveScreen"
                class="w-11/12 h-12 relative top-36 rounded-xl flex justify-center items-center"
                :style="{ backgroundColor: brushColor }">
                <img v-if="eraserSelect" class="w-10" :src="eraser" alt="eraser" />
            </div>
        </div>
    </div>
</template>

<style scoped>
.template-draw__div--main-div {
    background-color: rgb(0, 18, 80);
}

@media screen and (min-width: 1300px) {
    .template-draw__div--main-div {
        background-color: rgb(0, 18, 80);
        width: 60%;
        height: 700px;
        transform: translate(-50%, -50%);
    }
}



.template__img--line1 {
    left: 20%;
    top: 40%;
    transform: translate(-50%, -50%) scale(1.5);
    filter: invert(90%) sepia(87%) saturate(2210%) hue-rotate(105deg) brightness(103%) contrast(106%);
    animation: line1Animation 10s infinite;
}

@media screen and (min-width: 600px) {
    .template__img--line1 {
        transform: translate(-50%, -50%) scale(1.2);
    }
}


@media screen and (min-width: 1300px) {
    .template__img--line1 {
        width: 680px;
        right: 40px;
        top: -160px;
        transform: translate(0%, 0%) scale(1);
        filter: invert(90%) sepia(87%) saturate(2210%) hue-rotate(105deg) brightness(103%) contrast(106%);
        animation: line1Animation 10s infinite;
    }
}



@keyframes line1Animation {
    0% {
        filter: invert(90%) sepia(87%) saturate(2210%) hue-rotate(105deg) brightness(103%) contrast(106%) drop-shadow(0 0 10px rgb(0, 255, 255));

    }

    50% {
        filter: invert(21%) sepia(100%) saturate(6245%) hue-rotate(295deg) brightness(118%) contrast(117%) drop-shadow(0 0 10px rgb(250, 0, 255));
    }

    100% {
        filter: invert(90%) sepia(87%) saturate(2210%) hue-rotate(105deg) brightness(103%) contrast(106%) drop-shadow(0 0 10px rgb(0, 255, 255));
    }
}

.template__img--line2 {
    left: 20%;
    top: 40%;
    transform: translate(-50%, -50%) scale(1.5);
    filter: invert(90%) sepia(87%) saturate(2210%) hue-rotate(105deg) brightness(103%) contrast(106%);
    animation: line2Animation 10s infinite;
}

@media screen and (min-width: 600px) {
    .template__img--line2 {
        transform: translate(-50%, -50%) scale(1.2);
    }
}


@media screen and (min-width: 1300px) {
    .template__img--line2 {
        width: 680px;
        right: 40px;
        top: -65px;
        filter: invert(90%) sepia(87%) saturate(2210%) hue-rotate(105deg) brightness(103%) contrast(106%);
        transform: translate(0%, 0%) scale(1);
        animation: line2Animation 10s infinite;
    }
}



@keyframes line2Animation {
    0% {
        filter: invert(100%) sepia(49%) saturate(6373%) hue-rotate(340deg) brightness(93%) contrast(120%) drop-shadow(0 0 10px rgb(255, 229, 0));

    }

    50% {
        filter: invert(26%) sepia(83%) saturate(7484%) hue-rotate(221deg) brightness(107%) contrast(101%) drop-shadow(0 0 10px rgb(0, 87, 255));
    }

    100% {
        filter: invert(100%) sepia(49%) saturate(6373%) hue-rotate(340deg) brightness(93%) contrast(120%) drop-shadow(0 0 10px rgb(255, 229, 0));
    }
}

.template__img--line3 {
    width: 100%;
    left: 0%;
    top: 55%;
    transform: translate(-50%, -50%) scale(1.9);
    filter: invert(90%) sepia(87%) saturate(2210%) hue-rotate(105deg) brightness(103%) contrast(106%);
    animation: line3Animation 10s infinite;
}

@media screen and (min-width: 600px) {
    .template__img--line3 {
        transform: translate(-50%, -50%) scale(1.2);
    }
}


@media screen and (min-width: 1300px) {
    .template__img--line3 {
        width: 680px;
        right: -25px;
        left: auto;
        top: -30px;
        filter: invert(90%) sepia(87%) saturate(2210%) hue-rotate(105deg) brightness(103%) contrast(106%);
        transform: translate(0%, 0%) scale(1);
        animation: line3Animation 10s infinite;
    }
}



@keyframes line3Animation {
    0% {
        filter: invert(12%) sepia(87%) saturate(7092%) hue-rotate(9deg) brightness(103%) contrast(119%) drop-shadow(0 0 10px rgb(255, 0, 0));
    }

    50% {
        filter: invert(33%) sepia(56%) saturate(2675%) hue-rotate(114deg) brightness(136%) contrast(129%) drop-shadow(0 0 10px rgb(0, 255, 10));
    }

    100% {
        filter: invert(12%) sepia(87%) saturate(7092%) hue-rotate(9deg) brightness(103%) contrast(119%) drop-shadow(0 0 10px rgb(255, 0, 0));
    }
}

.template__img--line4 {
    width: 100%;
    left: 20%;
    top: 50%;
    transform: translate(-50%, -50%) scale(1.5);
    filter: invert(90%) sepia(87%) saturate(2210%) hue-rotate(105deg) brightness(103%) contrast(106%);
    animation: line4Animation 10s infinite;
}

@media screen and (min-width: 600px) {
    .template__img--line4 {
        transform: translate(-50%, -50%) scale(1.2);
    }
}

@media screen and (min-width: 1300px) {
    .template__img--line4 {
        width: 680px;
        right: 55px;
        top: -15px;
        filter: invert(90%) sepia(87%) saturate(2210%) hue-rotate(105deg) brightness(103%) contrast(106%);
        transform: translate(0%, 0%) scale(1);
        animation: line4Animation 10s infinite;
    }
}

@keyframes line4Animation {
    0% {
        filter: invert(9%) sepia(85%) saturate(4078%) hue-rotate(236deg) brightness(84%) contrast(124%) drop-shadow(0 0 10px rgb(0, 5, 116));
    }

    50% {
        filter: invert(29%) sepia(26%) saturate(6627%) hue-rotate(239deg) brightness(101%) contrast(101%) drop-shadow(0 0 10px rgb(104, 80, 255));
    }

    100% {
        filter: invert(9%) sepia(85%) saturate(4078%) hue-rotate(236deg) brightness(84%) contrast(124%) drop-shadow(0 0 10px rgb(0, 5, 116));
    }
}


.template__div--draw-effect {
    width: 400px;
    height: 100px;
    background: linear-gradient(90deg, rgba(0, 18, 80, 1) 89%, rgba(0, 18, 80, 0) 100%);
    animation: drawEffectAnimation 4s linear;
    animation-fill-mode: forwards;
}


@keyframes drawEffectAnimation {
    0% {
        width: 450px;
    }

    100% {
        width: 0px;
    }
}


.template__img--brush {
    width: 200px;
    left: 155px;
    animation: brushAnimation 4s linear;
}

@keyframes brushAnimation {
    0% {
        left: 515px;
    }

    100% {
        left: 160px;
    }
}

.template__div--draw-container-canvas {
    width: 280px;
    height: 280px;
    top: 220px;
    animation: canvasAnimation 2s linear;
}

@media screen and (min-width: 900px) {
    .template__div--draw-container-canvas {
        width: 480px;
        height: 480px;
        position: absolute;
        left: 10%;
        right: auto;
        margin: none;
        top: 60%;
        transform: translateY(-50%);
        bottom: auto;
        z-index: 30;
        animation: canvasAnimation 2s linear;
    }
}

@media screen and (min-width: 1300px) {
    .template__div--draw-container-canvas {
        width: 540px;
        height: 73%;
        left: 0;
        right: 0;
        top: 170px;
        transform: translateY(0);
        animation: canvasAnimation 6s linear;
    }
}

@keyframes canvasAnimation {
    0% {
        opacity: 0%;
    }

    70% {
        opacity: 0%;
    }

    100% {
        opacity: 100%;
    }
}

/* .template__div--draw-image {
    background-image: url('../../img/Draw-image/draw-image-free.png');
} */


.template-draw__img--main-border {
    width: 315px;
    top: 205px;
    animation: canvasAnimation 2s linear;
}

@media screen and (min-width: 900px) {
    .template-draw__img--main-border {
        width: 542px;
        margin: none;
        left: 7.5%;
        right: auto;
        top: 60%;
        transform: translateY(-50%);
        bottom: auto;
        animation: canvasAnimation 2s linear;
    }
}

@media screen and (min-width: 1300px) {
    .template-draw__img--main-border {
        width: 600px;
        left: 0;
        right: 0;
        margin: auto;
        top: 145px;
        bottom: 0;
        transform: translateY(0);
        pointer-events: none;
        animation: canvasAnimation 6s linear;
    }
}



.template-draw__button--color {
    width: 40px;
    height: 40px;
    background-color: rgb(238, 238, 238);
    border-radius: 100%;
    border: white 3px solid;
}




.template-draw__div--right-column {
    background-color: rgb(0, 18, 80);
    height: 150px;
    width: 90%;
    top: 510px;
}

@media screen and (min-width: 900px) {
    .template-draw__div--right-column {
        height: 400px;
        width: 200px;
        top: 62.5%;
        right: 10%;
        transform: translate(0%, -50%);
        margin: 0;
        left: auto;
    }
}


@media screen and (min-width: 1300px) {
    .template-draw__div--right-column {
        height: 700px;
        width: 18%;
        top: 50%;
        right: 20px;
    }
}



.template-draw__div--container-size-brush{
    background-color: rgba(0, 0, 0, 0.522);
    width: 90%;
    height: 50px;
    margin: 5px 0;
}


@media screen and (min-width: 900px) {
    .template-draw__div--container-size-brush {
        position: relative;
        top: 50px;
    }
}

.template-draw__div--container-color-button {
    background-color: rgba(0, 0, 0, 0.522);
    width: 90%;
    height: 50px;
    margin: 5px 0;
    transition: ease-in-out .5s;
}

@media screen and (min-width: 900px) {
    .template-draw__div--container-color-button {
        position: relative;
        top: 50px;
        grid-template-columns: auto auto auto auto;
    }
}
</style>