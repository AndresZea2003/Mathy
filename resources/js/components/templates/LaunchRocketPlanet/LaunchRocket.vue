<script setup>
import { onBeforeMount, ref } from 'vue';

//Nave modelo
import robot from '../../../../../public/images/characters/robot/robot.png';
import robotTalking from '../../../../../public/images/characters/robot/talk-animation.gif';
import marsBackground from '../../../../../public/images/backgrounds/marte-background.png';
import uranoBackground from '../../../../../public/images/backgrounds/urano-background.png';
import saturnoBackground from '../../../../../public/images/backgrounds/saturno-background.png';
import jupiterBackground from '../../../../../public/images/backgrounds/jupiter-background.png';
import neptunoBackground from '../../../../../public/images/backgrounds/neptuno-background.png';
import venusBackground from '../../../../../public/images/backgrounds/venus-background.png';
import mercurioBackground from '../../../../../public/images/backgrounds/mercurio-background.png';
import galaxyIMG from '../../../../../public/images/launch-rocket/galaxy.png';
import moon from '../../../../../public/images/launch-rocket/moon.png';
import nebulosa from '../../../../../public/images/launch-rocket/nebulosa.png';
import cometaGif from '../../../../../public/images/home/asteroid gif.gif';
import earthBackground from '../../../../../public/images/backgrounds/tierra-background-beta.png';
import uranusTerrain from '../../../../../public/images/launch-rocket/uranus/uranusTerrain.png';
import saturnoTerrain from '../../../../../public/images/launch-rocket/saturn/saturn-terrain.png';
import jupiterTerrain from '../../../../../public/images/launch-rocket/jupiter/jupiter-terrain.png';
import saturnoMoon from '../../../../../public/images/launch-rocket/saturn/saturn-moon.png';
import uranoMoon from '../../../../../public/images/launch-rocket/uranus/moon-1.png';
import uranoMoon2 from '../../../../../public/images/launch-rocket/uranus/moon-2.png';
import jupiterMoon from '../../../../../public/images/launch-rocket/jupiter/jupiter-moon.png';
import { getUsersLocalStorage } from '../../../use';
import { store_data } from '../../../use/store_data';



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
        terrain2: "#337709",//Color secundario de la base
        terrainIMG: false,
        moon: false,
        moon2: false
    },
    {
        background: "launch-rocket__div--container-animation-mars",
        img:  `url(${marsBackground})`,
        terrain: "#39211B",
        terrain2: "#A04A2E",
        terrainIMG: false,
        moon: false,
        moon2: false
    },
    {
        background: "launch-rocket__div--container-animation-venus",
        img: `url(${venusBackground})`,
        terrain: "#D19F16",
        terrain2: "#B48321",
        terrainIMG: false,
        moon: false,
        moon2: false
    },
    {
        background: "launch-rocket__div--container-animation-urano",
        img: `url(${uranoBackground})`,
        terrain: "#5C6277",
        terrain2: "#9DA1B0",
        terrainIMG: `url(${uranusTerrain})`,
        moon: uranoMoon,
        moon2: uranoMoon2
    },
    {
        background: "launch-rocket__div--container-animation-jupiter",
        img: `url(${jupiterBackground})`,
        terrain: "#565354",
        terrain2: "#898283",
        terrainIMG: `url(${jupiterTerrain})`,
        moon: jupiterMoon,
        moon2: false
    },
    {
        background: "launch-rocket__div--container-animation-saturno",
        img: `url(${saturnoBackground})`,
        terrain: "#C48850",
        terrain2: "#8b6036",
        terrainIMG: `url(${saturnoTerrain})`,
        moon: saturnoMoon,
        moon2: false
    },
    {
        background: "launch-rocket__div--container-animation-neptuno",
        img: `url(${neptunoBackground})`,
        terrain: "#D4D2DC",
        terrain2: "#9AB9E6",
        terrainIMG: false,
        moon: false,
        moon2: false
    },
    {
        background: "launch-rocket__div--container-animation-mercurio",
        img: `url(${mercurioBackground})`,
        terrain: "#59525A",
        terrain2: "#2F1C1E",
        terrainIMG: false,
        moon: false,
        moon2: false
    },
];

let styleWorldsClass = [
    //Volar hacia arriba
    {
        stars: "launch-rocket__div--stars-upwards",
        ship: "launch-rocket__img--ship-animated-upwards",
        element1: "launch-rocket__img--galaxy",
        element2: "launch-rocket__img--element2",
        element3: "launch-rocket__img--element3",
        moon: "launch-rocket__img--moon"
    },
    // //Volar hacia diagonal izquierda
    {
        stars: "launch-rocket__div--stars-left-diagonal",
        ship: "launch-rocket__img--ship-animated-left-diagonal",
        element1: "launch-rocket__img--galaxy-left",
        element2: "launch-rocket__img--element2-left-diagonal",
        element3: "launch-rocket__img--element3-left-diagonal",
        moon: "launch-rocket__img--moon-left-diagonal"
    },
    // //Volar hacia izquierda
    {
        stars: "launch-rocket__div--stars-left",
        ship: "launch-rocket__img--ship-animated-left",
        element1: "launch-rocket__img--galaxy-left",
        element2: "launch-rocket__img--element2-left",
        element3: "launch-rocket__img--element3-left",
        moon: "launch-rocket__img--moon-left"
    },
    //Volar hacia diagonal derecha
    {
        stars: "launch-rocket__div--stars-right-diagonal",
        ship: "launch-rocket__img--ship-animated-right-diagonal",
        element1: "launch-rocket__img--galaxy-rigth",
        element2: "launch-rocket__img--element2-right-diagonal",
        element3: "launch-rocket__img--element3-right-diagonal",
        moon: "launch-rocket__img--moon-right-diagonal"
    },
    //Volar hacia derecha
    {
        stars: "launch-rocket__div--stars-right",
        ship: "launch-rocket__img--ship-animated-right",
        element1: "launch-rocket__img--galaxy-rigth",
        element2: "launch-rocket__img--element2-right",
        element3: "launch-rocket__img--element3-right",
        moon: "launch-rocket__img--moon-right"
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

//Traer nave actual
const actualRocket = (type) => {
    let result;
    let idRocket = getUsersLocalStorage().shipSelected;
    if(type === "static"){
        result = store_data[idRocket - 1].staticAnimation;
    }else if("animated"){
        result = store_data[idRocket - 1].gif;
    };
    return result;
};

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
        <img v-if="galaxyRef && !levelWorlds[props.planet - 1].terrainIMG" :class="`${typeDirectionShipRef.element1} absolute top-20 right-0`" :src="galaxyIMG" alt="galaxy"/>
        <img v-if="galaxyRef" :class="`${typeDirectionShipRef.element2} w-20 absolute left-10 xl:left-80`" :src="moon" alt="moon"/>
        <img v-if="nebulosaRef" :class="`${typeDirectionShipRef.element3} w-80 absolute left-10 xl:left-80`" :src="nebulosa" alt="nebulosa"/>
        <img v-if="cometaRef" class="launch-rocket__img--cometa w-80 absolute left-10 xl:left-80" :src="cometaGif" alt="cometa"/>
        <div :class="`${classBackgroundImageRef} w-full h-full flex justify-center items-center overflow-hidden`" :style="{backgroundImage: levelWorlds[props.planet - 1].img, }">
        <div v-if="levelWorlds[props.planet - 1].terrainIMG" :class="`${classBackgroundImageRef} w-full h-full z-30`" :style="{backgroundImage: levelWorlds[props.planet - 1].terrainIMG}"></div>
        <img v-if="levelWorlds[props.planet - 1].moon" :class="`${typeDirectionShipRef.moon} absolute z-20`" :src="levelWorlds[props.planet - 1].moon" alt="jupiter-moon"/>
        <img v-if="levelWorlds[props.planet - 1].moon2" :class="`${typeDirectionShipRef.moon} w-5 absolute left-10 z-20`" :style="{width: '300px'}" :src="levelWorlds[props.planet - 1].moon2" alt="jupiter-moon"/>
            <div class="flex items-center justify-center w-72 xl:w-96 absolute z-40 bottom-14">
                <img v-if="shipStaticRef" class="launch-rocket__div--ship relative z-40 w-96" :src="actualRocket('static')" alt="ship"/>
                <img v-if="shipAnimatedRef" :class="`${typeDirectionShipRef.ship} absolute z-50`" :src="actualRocket('animated')" alt="ship-animated"/>
                <img v-if="robotStaticRef" :class="`${classRobotRef} w-28 xl:w-32 absolute bottom-8 right-2 z-50`" :src="robot" alt="robot"/>
                <img v-if="robotTalkingRef" class="w-32 xl:w-36 absolute right-0 bottom-6 z-50" :src="robotTalking" alt="robot"/>
            </div>
            <div :class="`${classTerrainRef} rounded-full flex justify-center items-center z-30`" :style="{backgroundColor: levelWorlds[props.planet - 1].terrain}">
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
    background-size: cover;
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
        background-color: #F4906C;
    }

    60%{
        background-color: #F4906C;
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
        background-color: #A66F0C;
    }

    60%{
        background-color: #A66F0C;
    }

    100%{
        background-color: #000000;
    }
}

/* Planeta Jupiter */
.launch-rocket__div--container-animation-jupiter {
    animation: containerBackgroundJupiterAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundJupiterAnimation {
    0%{
        background-color: #000101;
    }

    60%{
        background-color: #000101;
    }

    100%{
        background-color: #000000;
    }
}

/* Planeta urano */
.launch-rocket__div--container-animation-urano {
    animation: containerBackgroundUranoAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundUranoAnimation {
    0%{
        background-color: #160D2F;
    }

    60%{
        background-color: #160D2F;
    }

    100%{
        background-color: #000000;
    }
}

/* Planeta neptuno */
.launch-rocket__div--container-animation-neptuno {
    animation: containerBackgroundNeptunoAnimation  10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundNeptunoAnimation {
    0%{
        background-color: #888383;
    }

    60%{
        background-color: #888383;
    }

    100%{
        background-color: #000000;
    }
}

/* Planeta saturno */
.launch-rocket__div--container-animation-saturno {
    animation: containerBackgroundSaturnoAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundSaturnoAnimation {
    0%{
        background-color: #C3864F;
    }

    60%{
        background-color: #C3864F;
    }

    100%{
        background-color: #000000;
    }
}

/* Planeta saturno */
.launch-rocket__div--container-animation-mercurio {
    animation: containerBackgroundMercurioAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundMercurioAnimation {
    0%{
        background-color: #53332E;
    }

    60%{
        background-color: #53332E;
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
    position: relative;
    /* background-color: rgba(255, 0, 0, 0.562); */
    transform: scale(1.0);
    top: 290px;
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
    top: -390px;
    left: 15px;
    width: 384px;
    animation: shipupwardsLaunchAnimation 10s linear;
    animation-fill-mode: forwards;
    /* transform: scale(1.4); */
}

/*Arriba*/
@keyframes shipupwardsLaunchAnimation {
    0%{
        transform: translate(-15px,  0px) scale(1.0);
    }

    100%{
        transform: translate(-15px, -180px) scale(1.0);
    }
}

/*Diagonal izquierda*/
.launch-rocket__img--ship-animated-left-diagonal {
    top: -390px;
    left: 15px;
    width: 384px;
    animation: shipLaunchAnimationLeftDiagonal 10s linear;
    animation-fill-mode: forwards;
    /* transform: scale(1.4); */
}

/*Diagonal izquierda*/
@keyframes shipLaunchAnimationLeftDiagonal {
    0%{
        transform: translate(-15px, 0px) scale(1.0) rotate(0deg);
    }

    50%{
        transform: translate(-15px, -180px) scale(1.0) rotate(0deg);
    }

    100%{
        transform: translate(-15px, -180px) scale(1.0) rotate(-35deg);
    }
}


/*Diagonal derecha*/
.launch-rocket__img--ship-animated-right-diagonal {
    top: -390px;
    left: 15px;
    width: 384px;
    animation: shipLaunchAnimationRightDiagonal 10s linear;
    animation-fill-mode: forwards;
    /* transform: scale(1.4); */
}

/*Diagonal derecha*/
@keyframes shipLaunchAnimationRightDiagonal {
    0%{
        transform: translate(-15px,  0px) scale(1.0) rotate(0deg);
    }

    50%{
        transform: translate(-15px,  -180px) scale(1.0) rotate(0deg);
    }

    100%{
        transform: translate(-15px,  -180px) scale(1.0) rotate(35deg);
    }
}


.launch-rocket__img--ship-animated-right {
    top: -390px;
    left: 15px;
    width: 384px;
    animation: shipLaunchAnimationRight 10s linear;
    animation-fill-mode: forwards;
    /* transform: scale(1.4); */
}

/*Derecha*/
@keyframes shipLaunchAnimationRight {
    0%{
        transform: translate(-15px,  0px) scale(1.0) rotate(0deg);
    }

    50%{
        transform: translate(-15px, -180px) scale(1.0) rotate(0deg);
    }

    100%{
        transform: translate(-15px,  -180px) scale(1.0) rotate(90deg);
    }
}



.launch-rocket__img--ship-animated-left {
    top: -390px;
    left: 15px;
    width: 384px;
    animation: shipLaunchAnimationLeft 10s linear;
    animation-fill-mode: forwards;
    /* transform: scale(1.4); */
}

/*Izquierda*/
@keyframes shipLaunchAnimationLeft {
    0%{
        transform: translate(-15px, 0px) scale(1.0) rotate(0deg);
    }

    50%{
        transform: translate(-15px, -180px) scale(1.0) rotate(0deg);
    }

    100%{
        transform: translate(-15px, -180px) scale(1.0) rotate(-90deg);
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

/*Aniamcion luna hacia arriba */
.launch-rocket__img--moon {
    width: 800px;
    right: 20px;
    top: 100px;
    opacity:50%;
    animation: moonAnimation 20s linear;
    animation-delay: 22s;
    animation-fill-mode: forwards;
}

@keyframes moonAnimation  {
    0%{
        transform: translateY(0px);
        opacity: 50%;
    }

    100%{
        transform: translateY(300px);
        opacity: 100%;
    }
}

/*Aniamcion luna diagonal izquierda */
.launch-rocket__img--moon-left-diagonal{
    width: 800px;
    right: 20px;
    top: 100px;
    opacity:50%;
    animation: moonAnimationLeftDiagonal 20s linear;
    animation-delay: 22s;
    animation-fill-mode: forwards;
}

@keyframes moonAnimationLeftDiagonal  {
    0%{
        transform: translate(0px, 0px);
        opacity: 50%;
    }

    100%{
        transform: translate(300px, 300px);
        opacity: 100%;
    }
}

/*Aniamcion luna diagonal derecha */
.launch-rocket__img--moon-right-diagonal{
    width: 800px;
    right: 20px;
    top: 100px;
    opacity:50%;
    animation: moonAnimationRightDiagonal 20s linear;
    animation-delay: 22s;
    animation-fill-mode: forwards;
}

@keyframes moonAnimationRightDiagonal   {
    0%{
        transform: translate(0px, 0px);
        opacity: 50%;
    }

    100%{
        transform: translate(-300px, 300px);
        opacity: 100%;
    }
}


/*Aniamcion luna izquierda */
.launch-rocket__img--moon-left{
    width: 800px;
    right: 20px;
    top: 100px;
    opacity:50%;
    animation: moonAnimationLeft 20s linear;
    animation-delay: 22s;
    animation-fill-mode: forwards;
}

@keyframes moonAnimationLeft   {
    0%{
        transform: translateX(0px);
        opacity: 50%;
    }

    100%{
        transform: translateX(300px);
        opacity: 100%;
    }
}


/*Aniamcion luna izquierda */
.launch-rocket__img--moon-right{
    width: 800px;
    right: 20px;
    top: 100px;
    opacity:50%;
    animation: moonAnimationRight 20s linear;
    animation-delay: 22s;
    animation-fill-mode: forwards;
}

@keyframes moonAnimationRight   {
    0%{
        transform: translateX(0px);
        opacity: 50%;
    }

    100%{
        transform: translateX(-300px);
        opacity: 100%;
    }
}
</style>