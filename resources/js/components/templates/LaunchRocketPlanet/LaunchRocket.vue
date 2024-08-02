<script setup>
import { onBeforeMount, ref } from 'vue';

//Nave modelo
import ship from '../../../../../public/images/rockets/Cohetes-13.png';
import shipAnimated from '../../../../../public/images/rockets/Cohetes-13.gif';
import robot from '../../../../../public/images/characters/robot/robot.png';
import robotTalking from '../../../../../public/images/characters/robot/talk-animation.gif';
import marsBackground from '../../../../../public/images/backgrounds/marte-background.png';
import uranoBackground from '../../../../../public/images/backgrounds/urano-background.jpeg';
import jupiterBackground from '../../../../../public/images/backgrounds/jupiter-background.jpeg';
import saturnoBackground from '../../../../../public/images/backgrounds/saturno-background.jpeg';
import venusBackground from '../../../../../public/images/backgrounds/venus-background.jpeg';
import galaxyIMG from '../../../../../public/images/launch-rocket/galaxy.png';
import moon from '../../../../../public/images/launch-rocket/moon.png';
import nebulosa from '../../../../../public/images/launch-rocket/nebulosa.png';
import cometaGif from '../../../../../public/images/home/asteroid gif.gif';
import earthBackground from '../../../../../public/images/backgrounds/tierra-background-beta.png';



//Refs
const robotTalkingRef = ref(true);
const robotStaticRef = ref(true);
const classRobotRef = ref("");
const shipAnimatedRef = ref(false); //false
const shipStaticRef = ref(true); //true
const classBackgroundImageRef = ref("launch-rocket__div--image");
const classBackgroundImageContainerRef = ref("launch-rocket__div--container");
const classTerrainRef = ref("launch-rocket__div--terrain");
const planetSelectedAnimation = ref("");
const starsAnimationRef = ref(false);
const galaxyRef = ref(false);
const nebulosaRef = ref(false);
const cometaRef = ref(false);
const typeDirectionShipRef = ref("");


const levelWorlds = [
    {
        background: "launch-rocket__div--container-animation-earth",//Clase que se proporciona para la animacion de degradado del fondo
        // img: "url(https://cdn.pixabay.com/photo/2022/05/12/16/04/trees-7191822_1280.png)",//Imagen tomada apra representar el fondo
        img: `url(${earthBackground})`,
        terrain: "#BCDA4C",//Color de una de las bases donde van el robot y la nave
        terrain2: "#337709"//Color secundario de la base
    },
    {
        background: "launch-rocket__div--container-animation-mars",
        img:  `url(${marsBackground})`,
        terrain: "#39211B",
        terrain2: "#A04A2E"
    },
    {
        background: "launch-rocket__div--container-animation-venus",
        img: `url(${venusBackground})`,
        terrain: "#78BDBF",
        terrain2: "#1D3758"
    },
    {
        background: "launch-rocket__div--container-animation-jupiter",
        img: "url(https://cdn.pixabay.com/photo/2021/07/15/05/06/flowers-6467492_1280.jpg)",
        terrain: "#F4ACB4",
        terrain2: "#FEE3E1"
    },
    {
        background: "launch-rocket__div--container-animation-urano",
        img: `url(${uranoBackground})`,
        terrain: "#141D3A",
        terrain2: "#8896B3"
    },
    {
        background: "launch-rocket__div--container-animation-jupiter",
        img: `url(${jupiterBackground})`,
        terrain: "#5A617C",
        terrain2: "#151D32"
    },
    {
        background: "launch-rocket__div--container-animation-saturno",
        img: `url(${saturnoBackground})`,
        terrain: "#9F7C2F",
        terrain2: "#050927"
    },
];

let styleWorldsClass = [
    //Volar hacia arriba
    {
        stars: "launch-rocket__div--stars-upwards",
        ship: "launch-rocket__img--ship-animated-upwards",
        element1: "launch-rocket__img--galaxy",
        element2: "launch-rocket__img--element2",
        element3: "launch-rocket__img--element3"
    },
    // //Volar hacia diagonal izquierda
    {
        stars: "launch-rocket__div--stars-left-diagonal",
        ship: "launch-rocket__img--ship-animated-left-diagonal",
        element1: "launch-rocket__img--galaxy-left",
        element2: "launch-rocket__img--element2-left-diagonal",
        element3: "launch-rocket__img--element3-left-diagonal"
    },
    // //Volar hacia izquierda
    {
        stars: "launch-rocket__div--stars-left",
        ship: "launch-rocket__img--ship-animated-left",
        element1: "launch-rocket__img--galaxy-left",
        element2: "launch-rocket__img--element2-left",
        element3: "launch-rocket__img--element3-left"
    },
    //Volar hacia diagonal derecha
    {
        stars: "launch-rocket__div--stars-right-diagonal",
        ship: "launch-rocket__img--ship-animated-right-diagonal",
        element1: "launch-rocket__img--galaxy-rigth",
        element2: "launch-rocket__img--element2-right-diagonal",
        element3: "launch-rocket__img--element3-right-diagonal"
    },
    //Volar hacia derecha
    {
        stars: "launch-rocket__div--stars-right",
        ship: "launch-rocket__img--ship-animated-right",
        element1: "launch-rocket__img--galaxy-rigth",
        element2: "launch-rocket__img--element2-right",
        element3: "launch-rocket__img--element3-right"
    },
];

//Funcion para elegir la animacion
const typeDirectionShip = () => {
    let randomNum = Math.floor(Math.random() * styleWorldsClass.length);

    return styleWorldsClass[randomNum];
};

//Props
const props = defineProps({
    planet: Number
});

onBeforeMount(() => {
    planetSelectedAnimation.value = levelWorlds[props.planet - 1].background;
    typeDirectionShipRef.value = typeDirectionShip();
});


setTimeout(() => {
    robotStaticRef.value = false;
}, 4000);

setTimeout(() => {
    robotTalkingRef.value = false;
    robotStaticRef.value = true;
    setTimeout(() => {
        classRobotRef.value = "launch-rocket__div--robot-arrived";

        //Aniamcion de despegue de la nave
        setTimeout(() => {
            shipAnimatedRef.value = true;
            shipStaticRef.value = false;

            setTimeout(() => {
                classBackgroundImageRef.value = "launch-rocket__div--image-animation";
                classBackgroundImageContainerRef.value = planetSelectedAnimation.value;
                classTerrainRef.value = "launch-rocket__div--terrain-animated";

                setTimeout(() => {
                    starsAnimationRef.value = true;
                    galaxyRef.value = true;

                    setTimeout(() => {
                        nebulosaRef.value = true;
                        cometaRef.value = true;
                    }, 2000);
                }, 6000);
            }, 3000);
        }, 4000);
    }, 1000);
}, 10000);


</script>

<template>
    <div :class="`${classBackgroundImageContainerRef} w-full h-full relative overflow-hidden`">
        <div v-if="starsAnimationRef" :class="`launch-rocket__div--stars-background  w-full h-full absolute`"></div>
        <div v-if="starsAnimationRef" :class="`${typeDirectionShipRef.stars} launch-rocket__div--stars w-full h-full absolute`"></div>
        <img v-if="galaxyRef" :class="`${typeDirectionShipRef.element1} absolute top-20 right-0`" :src="galaxyIMG" alt="galaxy"/>
        <img v-if="galaxyRef" :class="`${typeDirectionShipRef.element2} w-20 absolute left-10 xl:left-80`" :src="moon" alt="moon"/>
        <img v-if="nebulosaRef" :class="`${typeDirectionShipRef.element3} w-80 absolute left-10 xl:left-80`" :src="nebulosa" alt="nebulosa"/>
        <img v-if="cometaRef" class="launch-rocket__img--cometa w-80 absolute left-10 xl:left-80" :src="cometaGif" alt="cometa"/>
        <div :class="`${classBackgroundImageRef} w-full h-full flex justify-center items-center overflow-hidden`" :style="{backgroundImage: levelWorlds[props.planet - 1].img}">
            <div class="flex items-center justify-center w-72 xl:w-96 absolute z-20 bottom-14">
                <img v-if="shipStaticRef" class="launch-rocket__div--ship relative z-40 w-96" :src="ship" alt="ship"/>
                <img v-if="shipAnimatedRef" :class="`${typeDirectionShipRef.ship} absolute z-50`" :src="shipAnimated" alt="ship-animated"/>
                <img v-if="robotStaticRef" :class="`${classRobotRef} w-28 xl:w-32 absolute bottom-8 right-2 z-50`" :src="robot" alt="robot"/>
                <img v-if="robotTalkingRef" class="w-32 xl:w-36 absolute right-0 bottom-6 z-50" :src="robotTalking" alt="robot"/>
            </div>
            <div :class="`${classTerrainRef} rounded-full flex justify-center items-center`" :style="{backgroundColor: levelWorlds[props.planet - 1].terrain}">
                <div class="launch-rocket__div--terrain-2 rounded-full" :style="{backgroundColor: levelWorlds[props.planet - 1].terrain2}"></div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.launch-rocket__div--image  {
    background-position: center;
    background-size:cover;
    background-repeat: no-repeat;
}


.launch-rocket__div--image-animation  {
    background-position: center;
    background-size:cover;
    background-repeat: no-repeat;
    animation: backgroundImgAnimation 7s linear;
    animation-fill-mode: forwards;

}

@keyframes backgroundImgAnimation  {
    0%{
        background-position-y: auto;
        /* opacity: 100%; */
    }

    5%{
        background-position-y: auto;
        /* opacity: 100%; */
    }

    100%{
        background-position-y: 1500px;
        /* opacity: 0%; */
    }
}

/* Planeta Tierra */
.launch-rocket__div--container-animation-earth {
    animation: containerBackgroundEarthAnimation 8s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundEarthAnimation {
    0%{
        background-color: #5593FC;
    }

    60%{
        background-color: #5593FC;
    }

    100%{
        background-color: #000000;
    }
}

/* @keyframes containerBackgroundEarthAnimation {
    0%{
        background-color: #68B9F0;
    }

    60%{
        background-color: #68B9F0;
    }

    100%{
        background-color: #000000;
    }
} */

/* Planeta Marte */
.launch-rocket__div--container-animation-mars {
    animation: containerBackgroundMarsAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundMarsAnimation {
    0%{
        background-color: #FFBF76;
    }

    60%{
        background-color: #FFBF76;
    }

    100%{
        background-color: #000000;
    }
}

/* Planeta Venus */
.launch-rocket__div--container-animation-venus {
    animation: containerBackgroundVenusAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundVenusAnimation {
    0%{
        background-color: #0A0E21;
    }

    60%{
        background-color: #0A0E21;
    }

    100%{
        background-color: #000000;
    }
}

/* Planeta Jupiter */
.launch-rocket__div--container-animation-jupiter {
    animation: containerBackgroundVenusAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundVenusAnimation {
    0%{
        background-color: #F4ACB4;
    }

    60%{
        background-color: #F4ACB4;
    }

    100%{
        background-color: #000000;
    }
}

/* Planeta urano */
.launch-rocket__div--container-animation-urano {
    animation: containerBackgroundVenusAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundVenusAnimation {
    0%{
        background-color: #060715;
    }

    60%{
        background-color: #060715;
    }

    100%{
        background-color: #000000;
    }
}

/* Planeta jupiter */
.launch-rocket__div--container-animation-jupiter {
    animation: containerBackgroundVenusAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundVenusAnimation {
    0%{
        background-color: #172237;
    }

    60%{
        background-color: #172237;
    }

    100%{
        background-color: #000000;
    }
}

/* Planeta saturno */
.launch-rocket__div--container-animation-saturno {
    animation: containerBackgroundVenusAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundVenusAnimation {
    0%{
        background-color: #2F3F4F;
    }

    60%{
        background-color: #2F3F4F;
    }

    100%{
        background-color: #000000;
    }
}


.launch-rocket__div--terrain {
    width: 1500px;
    height: 1500px;
    position: absolute;
    bottom: -1350px;
}

.launch-rocket__div--terrain-animated {
    width: 1500px;
    height: 1500px;
    position: absolute;
    bottom: -1350px;
    animation: terrainAnimation 3s linear;
    animation-fill-mode: forwards;
}

@keyframes terrainAnimation {
    0%{
        bottom: -1350px;
    }


    100%{
        bottom: -1550px;
    }
}

.launch-rocket__div--terrain-2 {
    width: 1450px;
    height: 1450px;
    position: absolute;
    transform: translateX(170px);
}

.launch-rocket__div--ship {
    transform: rotate(-45deg);
}

.launch-rocket__div--robot-arrived {
    animation: robotArrivedAnimation 3s linear;
    animation-fill-mode: forwards;
}

@media screen and (min-width: 1300px) {
    .launch-rocket__div--robot-arrived {
        animation: robotArrivedXLAnimation 3s linear;
        animation-fill-mode: forwards;
    }
}

@keyframes robotArrivedXLAnimation {
    0%{
        transform: translateX(0px) scale(1);
        z-index: 50;
    }

    20%{
        z-index: 10;
    }


    90%{
        transform: translateX(-150px) scale(0);
        z-index: 10;
    }

    100%{
        transform: translateX(-150px) scale(0);
        z-index: 10;
    }
}

@keyframes robotArrivedAnimation {
    0%{
        transform: translateX(0px) scale(1);
        z-index: 50;
    }

    20%{
        z-index: 10;
    }

    90%{
        transform: translateX(-100px) scale(0);
        z-index: 10;
    }

    100%{
        transform: translateX(-100px) scale(0);
        z-index: 10;
    }
}

/*Arriba*/
.launch-rocket__img--ship-animated-upwards {
    top: -320px;
    left: 15px;
    width: 600px;
    animation: shipupwardsLaunchAnimation 10s linear;
    animation-fill-mode: forwards;
    /* transform: scale(1.4); */
}

/*Arriba*/
@keyframes shipupwardsLaunchAnimation {
    0%{
        transform: translateY(0px) scale(1.5);
    }

    100%{
        transform: translateY(-180px) scale(1.5);
    }
}

/*Diagonal izquierda*/
.launch-rocket__img--ship-animated-left-diagonal {
    top: -320px;
    left: 15px;
    width: 600px;
    animation: shipLaunchAnimationLeftDiagonal 10s linear;
    animation-fill-mode: forwards;
    /* transform: scale(1.4); */
}

/*Diagonal izquierda*/
@keyframes shipLaunchAnimationLeftDiagonal {
    0%{
        transform: translate(0px, 0px) scale(1.5) rotate(0deg);
    }

    50%{
        transform: translate(0px, -180px) scale(1.5) rotate(0deg);
    }

    100%{
        transform: translate(0px, -180px) scale(1.5) rotate(-35deg);
    }
}


/*Diagonal derecha*/
.launch-rocket__img--ship-animated-right-diagonal {
    top: -320px;
    left: 15px;
    width: 600px;
    animation: shipLaunchAnimationRightDiagonal 10s linear;
    animation-fill-mode: forwards;
    /* transform: scale(1.4); */
}

/*Diagonal derecha*/
@keyframes shipLaunchAnimationRightDiagonal {
    0%{
        transform: translate(0px, 0px) scale(1.5) rotate(0deg);
    }

    50%{
        transform: translate(0px, -180px) scale(1.5) rotate(0deg);
    }

    100%{
        transform: translate(0px, -180px) scale(1.5) rotate(35deg);
    }
}


.launch-rocket__img--ship-animated-right {
    top: -320px;
    left: 15px;
    width: 600px;
    animation: shipLaunchAnimationRight 10s linear;
    animation-fill-mode: forwards;
    /* transform: scale(1.4); */
}

/*Derecha*/
@keyframes shipLaunchAnimationRight {
    0%{
        transform: translate(0px, 0px) scale(1.5) rotate(0deg);
    }

    50%{
        transform: translate(0px, -180px) scale(1.5) rotate(0deg);
    }

    100%{
        transform: translate(0px, -180px) scale(1.5) rotate(90deg);
    }
}



.launch-rocket__img--ship-animated-left {
    top: -320px;
    left: 15px;
    width: 600px;
    animation: shipLaunchAnimationLeft 10s linear;
    animation-fill-mode: forwards;
    /* transform: scale(1.4); */
}

/*Izquierda*/
@keyframes shipLaunchAnimationLeft {
    0%{
        transform: translate(0px, 0px) scale(1.5) rotate(0deg);
    }

    50%{
        transform: translate(0px, -180px) scale(1.5) rotate(0deg);
    }

    100%{
        transform: translate(0px, -180px) scale(1.5) rotate(-90deg);
    }
}

.launch-rocket__div--stars-upwards {
    background-image: url('../../../../../public/images/backgrounds/stars-background.png');
    animation: starsUpwardsAnimation 15s linear;
    position: relative;
    z-index: 5;
}

@media screen and (min-width: 1300px) {
    .launch-rocket__div--stars {
        background-size: cover;
    }
}


/*arriba*/
@keyframes starsUpwardsAnimation {
    0%{
        background-position-y: -3000px;
        opacity: 0%;
    }

    2%{
        background-position-y: -2800px;
        opacity: 100%;
    }

    100%{
        background-position-y: 5000px;
        opacity: 100%;
    }
}

.launch-rocket__div--stars-left-diagonal {
    background-image: url('../../../../../public/images/backgrounds/stars-background.png');
    animation: starsLeftDiagonalAnimation 15s linear;
    position: relative;
    z-index: 5;
}

/*Diagonal izquierda*/
@keyframes starsLeftDiagonalAnimation {
    0%{
        background-position-y: -3000px;
        background-position-x: -4000px;
        opacity: 0%;
    }

    2%{
        background-position-y: -2800px;
        opacity: 100%;
    }

    100%{
        background-position-y: 5000px;
        opacity: 100%;
    }
}

.launch-rocket__div--stars-right-diagonal {
    background-image: url('../../../../../public/images/backgrounds/stars-background.png');
    animation: starsRightDiagonalAnimation 15s linear;
    position: relative;
    z-index: 5;
}

/*Diagonal derecha*/
@keyframes starsRightDiagonalAnimation {
    0%{
        background-position-y: -3000px;
        background-position-x: 4000px;
        opacity: 0%;
    }

    2%{
        background-position-y: -2800px;
        opacity: 100%;
    }

    100%{
        background-position-y: 5000px;
        opacity: 100%;
    }
}

.launch-rocket__div--stars-right {
    background-image: url('../../../../../public/images/backgrounds/stars-background.png');
    animation: starsRightAnimation 15s linear;
    position: relative;
    z-index: 5;
}

/*Derecha*/
@keyframes starsRightAnimation {
    0%{
        background-position-y: -3000px;
        background-position-x: 0px;
        opacity: 0%;
    }

    10%{
        background-position-y: -2800px;
        background-position-x: 0px;
        opacity: 100%;
    }

    100%{
        background-position-y: -2800px;
        background-position-x: -8000px;
        opacity: 100%;
    }
}


.launch-rocket__div--stars-left {
    background-image: url('../../../../../public/images/backgrounds/stars-background.png');
    animation: starsLeftAnimation 15s linear;
    position: relative;
    z-index: 5;
}

/*Izquierda*/
@keyframes starsLeftAnimation {
    0%{
        background-position-y: -3000px;
        background-position-x: 0px;
        opacity: 0%;
    }

    10%{
        background-position-y: -2800px;
        background-position-x: 0px;
        opacity: 100%;
    }

    100%{
        background-position-y: -2800px;
        background-position-x: 8000px;
        opacity: 100%;
    }
}



.launch-rocket__div--stars-background {
    background-image: url('../../../../../public/images/backgrounds/stars-background-3.png');
    z-index: 10;
    /* background-color: #208A7D; */
    animation: starStaticAnimation 5s linear;
    animation-fill-mode: forwards;
}

@keyframes starStaticAnimation {
    0%{
        opacity: 0%;
    }

    100%{
        opacity: 65%;
    }
}

/*Arriba*/
.launch-rocket__img--galaxy {
    width: 500px;
    z-index: 1;
    animation: galaxyAnimation 15s linear;
    animation-fill-mode: forwards;
}

@keyframes galaxyAnimation {
    0%{
        transform: translateY(-150px);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translateY(200px);
        opacity: 65%;
    }
}


/*Derecha*/
.launch-rocket__img--galaxy-rigth {
    width: 500px;
    z-index: 1;
    animation: galaxyRigthAnimation 15s linear;
    animation-fill-mode: forwards;
}

@keyframes galaxyRigthAnimation {
    0%{
        transform: translateX(100px);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translateX(0px);
        opacity: 65%;
    }
}

/*Izquierda*/
.launch-rocket__img--galaxy-left {
    width: 500px;
    z-index: 1;
    animation: galaxyLeftAnimation 15s linear;
    animation-fill-mode: forwards;
}

@keyframes galaxyLeftAnimation {
    0%{
        transform: translateX(0px);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translateX(100px);
        opacity: 65%;
    }
}

/**Arriba*/
.launch-rocket__img--element2 {
    animation: element2Animation 5s linear;
    animation-fill-mode: forwards;
}

@keyframes element2Animation {
    0%{
        transform: translateY(-1550px);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translateY(500px);
        opacity: 65%;
    }
}

/*Izquierda*/
.launch-rocket__img--element2-left {
    animation: element2LeftAnimation 8s linear;
    animation-fill-mode: forwards;
}

@keyframes element2LeftAnimation {
    0%{
        transform: translate(-500px, -300px);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translate(1500px, -300px);
        opacity: 65%;
    }
}

/*Izquierda diagonal*/
.launch-rocket__img--element2-left-diagonal {
    animation: element2LeftAnimationDiagonal 8s linear;
    animation-fill-mode: forwards;
}

@keyframes element2LeftAnimationDiagonal {
    0%{
        transform: translate(-500px, -800px);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translate(500px, 500px);
        opacity: 65%;
    }
}

/*Derecha*/
.launch-rocket__img--element2-right {
    animation: element2RightAnimation 8s linear;
    animation-fill-mode: forwards;
}

@keyframes element2RightAnimation {
    0%{
        transform: translate(1500px, -300px);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translate(-800px, -300px);
        opacity: 65%;
    }
}

/*Derecha diagonal*/
.launch-rocket__img--element2-right-diagonal {
    animation: element2RightAnimationDiagonal 8s linear;
    animation-fill-mode: forwards;
}

@keyframes element2RightAnimationDiagonal {
    0%{
        transform: translate(500px, -800px);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translate(-500px, 500px);
        opacity: 65%;
    }
}

/*Arriba*/
.launch-rocket__img--element3 {
    animation: nebulosaAnimation 15s linear;
    animation-fill-mode: forwards;
}

@keyframes element3Animation {
    0%{
        transform: translateY(-1550px);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translateY(800px);
        opacity: 65%;
    }
}

/*Izquierda*/
.launch-rocket__img--element3-left {
    animation: element3LeftAnimation 15s linear;
    animation-fill-mode: forwards;
}

@keyframes element3LeftAnimation {
    0%{
        transform: translate(-500px, -600px);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translate(1500px, -600px);
        opacity: 65%;
    }
}

/*Izquierda diagonal*/
.launch-rocket__img--element3-left-diagonal {
    animation: element3LeftAnimationDiagonal 15s linear;
    animation-fill-mode: forwards;
}

@keyframes element3LeftAnimationDiagonal {
    0%{
        transform: translate(-400px, -1200px);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translate(800px, 1200px);
        opacity: 65%;
    }
}

/*Derecha*/
.launch-rocket__img--element3-right {
    animation: element3RightAnimation 15s linear;
    animation-fill-mode: forwards;
}

@keyframes element3RightAnimation {
    0%{
        transform: translate(1500px, -300px);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translate(-800px, -300px);
        opacity: 65%;
    }
}


/*Derecha diagonal*/
.launch-rocket__img--element3-right-diagonal {
    animation: element3RightAnimationDiagonal 15s linear;
    animation-fill-mode: forwards;
}

@keyframes element3RightAnimationDiagonal {
    0%{
        transform: translate(500px, -1200px);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translate(-800px, 1200px);
        opacity: 65%;
    }
}

.launch-rocket__img--cometa {
    animation: cometaAnimation 15s linear;
    animation-fill-mode: forwards;
}

.launch-rocket__img--cometa {
    animation: cometaAnimation 15s linear;
    animation-fill-mode: forwards;
}

@keyframes cometaAnimation  {
    0%{
        transform: translate(-1000px, 700px) rotate(-60deg);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translate(1000px, -1000px) rotate(-60deg);
        opacity: 65%;
    }
}
</style>