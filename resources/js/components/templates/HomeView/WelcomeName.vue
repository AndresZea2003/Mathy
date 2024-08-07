<script setup>
import { onMounted, ref } from 'vue';

//Componentes
import AnimatedStars from '../../activities/DrawActivity/AnimatedStars.vue';

//Imagenes
import ship from '../../../../../public/images/rockets/cohetes-x-gif.gif';
import shipOrbit from '../../../../../public/images/rockets/Cohetes-23.png';
import shipOrbit2 from '../../../../../public/images/rockets/Cohetes-27.png';
import robot from '../../../../../public/images/characters/robot/robot.png';
import conection from '../../../../../public/images/home/conection.png';
import shipStatic from '../../../../../public/images/rockets/cohetes-x.gif';
import satelite from '../../../../../public/images/home/satelite.png';
import asteroidBelt from '../../../../../public/images/home/asteroid-belt.png';

//Gifs
import talkAnimationRobot from '../../../../../public/images/characters/robot/talk-animation.gif';
import asteroidAnimation from '../../../../../public/images/home/asteroid gif.gif';

//Video
import videoSrc from '../../../../../public/videos/home/background-animated-home.mp4';
import { getUsersLocalStorage } from '../../../use';
import { store_data } from '../../../use/store_data';

//Traemos datos del storage
let gamer = localStorage.getItem('gamer');

//Ref
const planetColor = ref('');
const shipAnimation1 = ref(true);
const shipAnimation2 = ref(false);
const robotRocket = ref(false);
const robotClass = ref('welcome-name__img--robot-arrived');
const conectionClass = ref('welcome-name__img--conection-arrived');
const sateliteRef = ref(false);
const typeRobot = ref(robot);
const shipOrbitRef = ref(false);
const shipOrbit2Ref = ref(false);
const shipAnimationLeft = ref(false);
const cometaRef = ref(false);
const shipIMG = ref("");
const shipGIF = ref("");

const props = defineProps({
    video: String,
});

const getPlanetColor = () => {
    let games = JSON.parse(localStorage.getItem('games'));

    for (let i = 0; i < games.length; i++) {
        if(gamer === games[i].name){
            planetColor.value = games[i].inputColor.background;
        }
    }
};


onMounted(() => {
    getPlanetColor();

    //Determinamos si el usuario ya ha hecho la intro y pondremos la nave que el usuario tiene si no sera la nave predeterminada del inicio
    if(getUsersLocalStorage().introduction){
        let numRocket = getUsersLocalStorage().shipSelected;
        shipIMG.value = store_data[numRocket - 1].staticAnimation;
        shipGIF.value = store_data[numRocket - 1].gif;
    }else if(!getUsersLocalStorage().introduction){
        // let numRocket = getUsersLocalStorage().shipSelected;
        shipIMG.value = shipStatic;
        shipGIF.value = ship;
    }
});


//Control de aapricion de nave principal
setTimeout(() => {
    shipAnimation1.value = false;
    shipAnimation2.value = true;

    // setTimeout(() => {
    //     shipAnimation2.value = ref(false);
    // }, 7000);

}, 5000);

setTimeout(() => {
    //Control de aparicion de nave estatica sin el motor y el robot
    robotRocket.value = true;
    sateliteRef.value = true;

    setTimeout(() => {
        sateliteRef.value = false;
    }, 20000);

    //Control de aparicion de las naves que aparecen volando por la parte trasera.
    //Ovni
    setTimeout(() => {
        shipOrbitRef.value = true;

        setTimeout(() => {
            shipOrbitRef.value = false;


        }, 12000);

        //nave de fondo
        setTimeout(() => {
            shipOrbit2Ref.value = true;

            setTimeout(() => {
                shipOrbit2Ref.value = false;
            }, 10000);
        }, 5000);
    }, 7000);

    //Controld de aparicion de la animacion del robot hablando.
    setTimeout(() => {
        typeRobot.value = talkAnimationRobot;
    }, 5000);

    //Control de animacion de las clases de robot y cable de coneccion apareciendo y flotando.
    setTimeout(() => {
        robotClass.value = 'welcome-name__img--robot-orbit';
        conectionClass.value = 'welcome-name__img--conection-orbit';
        cometaRef.value = true;

        //Control de clases en el momento donde se va el robot
        setTimeout(() => {
            robotClass.value = 'welcome-name__img--robot-left';
            conectionClass.value = 'welcome-name__img--conection-left';

            //Control de nave cuando se va despues de que el robot entre en la nave
            setTimeout(() => {
                robotRocket.value = false;
                shipAnimationLeft.value = true;
            }, 2800);
        }, 10000);
    }, 3200);

    //Desmontaje de animacion de nave con el motor dentras de la nave estatica.
    setTimeout(() => {
        shipAnimation2.value = false;
    }, 3000);
}, 8000);





</script>

<template>
    <div :class="video ? ('w-full h-full relative z-10'):('welcome-name__img--galaxy w-full h-full relative z-10')">
        <div v-if="video" class="video-container">
            <video v-if="video" :autoplay="true" loop="true">
                <source class="absolute" :src="videoSrc" type="video/mp4" />
                Tu navegador no soporta la reproducción de video.
            </video>
        </div>
        <AnimatedStars v-if="!video"/>
        <img v-if="!video" class="welcome-name__img--belt-asteroids overflow-hidden" :src="asteroidBelt" alt="asteroid-belt"/>
        <img v-if="shipAnimation1" class="welcome-name__img--ship w-80" :src="shipGIF" alt="ship"/>
        <div class="welcome-name__div--planet overflow-hidden" :style="{background: planetColor, boxShadow: `0px 0px 40px 3px ${planetColor}`}"></div>

        <img v-if="sateliteRef && !video" class="welcome-name__img--satelite w-16 absolute" :src="satelite" alt="satelite"/>
        <img v-if="shipOrbitRef && !video" class="welcome-name__img--ship-orbit w-32 absolute top-52" :src="shipOrbit" alt="ship"/>
        <img v-if="shipOrbit2Ref && !video" class="welcome-name__img--ship-2-orbit w-36 absolute top-52" :src="shipOrbit2" alt="ship"/>
        <img v-if="cometaRef && !video" class="welcome-name__img--asteroid w-40 absolute rotate-90 left-10 xl:left-60" :src="asteroidAnimation" alt="asteroid gif"/>


        <div class="welcome-name__div--robot-rocket w-60 absolute m-auto left-0 right-0">
            <img v-if="shipAnimation2" class="welcome-name__img--ship-2" :src="shipGIF" alt="ship-2"/>
            <img v-if="shipAnimationLeft" class="welcome-name__img--ship-left" :src="shipGIF" alt="ship-2"/>
            <img v-if="robotRocket" :class="`${conectionClass} w-28 absolute  bottom-14 left-10`" :src="conection" alt="conection"/>
            <img v-if="robotRocket" class="welcome-name__img--ship-static w-52 z-10 absolute" :src="shipIMG" alt="ship"/>
            <img v-if="robotRocket" :class="`${robotClass} w-40 relative bottom-4 z-0 left-24`" :src="typeRobot" alt="robot"/>
        </div>



    </div>
</template>

<style scoped>

/* Galaxia */
.welcome-name__img--galaxy {
    overflow: hidden;
    background-image: url('../../../../../public/images/backgrounds/space.jpg');
    opacity: 90%;
    background-size: cover;
    background-position: center;
    animation: galaxiaAnimation 1s linear;
}

@keyframes galaxiaAnimation {
    0% {
        opacity: 0%;
    }

    100% {
        opacity: 100%;
    }
}


.welcome-name__img--ship {
    transform: rotate(170deg);
    animation: shipAnimation 4s linear;
    animation-fill-mode: forwards;
}

@keyframes shipAnimation {
    0% {
        transform: translate(-260px, -240px) rotate(160deg);
        opacity: 100%;
    }

    80% {
        transform: translate(400px, 440px) rotate(125deg);
        opacity: 100%;
    }

    100% {
        transform: translate(860px, 870px)  rotate(130deg);
        opacity: 0%;
    }
}

.welcome-name__img--ship-2 {
    /* background-color: rgba(0, 0, 255, 0.486); */
    width: 490px;
    margin: auto;
    position: absolute;
    transform: translateY(200px);
    animation: ship2Animation 3.5s linear;
    animation-fill-mode: forwards;
}

@keyframes ship2Animation {
    0% {
        transform: translate(-76px, 680px) scale(1.4);
        opacity: 100%;
    }

    80% {
        transform: translate(-76px, -30px) scale(1.4);
        opacity: 100%;
    }

    100% {
        transform: translate(-76px, -30px) scale(1.4);
        opacity: 0%;
    }
}

.welcome-name__img--ship-left {
    width: 490px;
    margin: auto;
    position: absolute;
    transform: translateY(200px);
    animation: shipLeftAnimation 3.5s linear;
    animation-fill-mode: forwards;
}

@keyframes shipLeftAnimation {
    0% {
        transform: translate(-76px, -30px) scale(1.4) rotate(0deg);
        opacity: 0%;
    }

    10% {
        transform: translate(-76px, -30px) scale(1.4) rotate(0deg);
        opacity: 100%;
    }

    70% {
        transform: translate(-76px, -300px) scale(1.4) rotate(90deg);
        opacity: 100%;
    }

    100% {
        transform: translate(1800px, -300px) scale(1.4) rotate(90deg);
        opacity: 100%;
    }
}

.welcome-name__img--belt-asteroids {
    width: 3800px;
    opacity: 50%;
    max-width: none;
    position: relative;
    top: 450px;
    overflow: hidden;
    animation: asteroidBeltAnimation 120s infinite linear;
}

@keyframes asteroidBeltAnimation  {
    0% {
        transform: translateX(-100px) rotate(10deg);
        opacity: 50%;
    }

    20% {
        opacity: 0%;
    }

    50% {
        transform: translateX(-500px) rotate(10deg);
        opacity: 0%;
    }

    100% {
        transform: translateX(-100px) rotate(10deg);
        opacity: 0%;
    }
}

.welcome-name__div--planet {
    width: 800px;
    height: 800px;
    border-radius: 100%;
    position: absolute;
    top: -500px;
    right: -650px;
}

@media (min-width: 800px) {
    .welcome-name__div--planet {
        width: 800px;
        height: 800px;
        border-radius: 100%;
        position: absolute;
        top: -500px;
        right: -500px;
        animation: planetOrbitAnimation 10s infinite linear;
    }
}


@keyframes planetOrbitAnimation {
    0% {
        transform: translateX(0px);
    }

    50% {
        transform: translateX(20px);
    }

    100% {
        transform: translateX(0px);
    }
}


.welcome-name__div--robot-rocket  {
    top: 400px;
}


.welcome-name__img--conection-arrived {
    left: -150;
    animation: robotLineArrivedAnimation 3s linear;
}

@keyframes robotLineArrivedAnimation {
    0% {
        transform: translateX(-50px) scale(0.1);
    }

    100% {
        transform: translateX(0px) scale(1);
    }
}

@media (min-width: 800px) {
    .welcome-name__img--conection-arrived {
        animation: robotLineArrived800pxAnimation 3s linear;
    }
}

@keyframes robotLineArrived800pxAnimation {
    0% {
        transform: translateX(-50px) scale(0.1);
    }

    /* 80% {
        transform: translateX(-10px) scale(0.9);
    } */

    100% {
        transform: translateX(0px) scale(1);
    }
}

.welcome-name__img--conection-left {
    left: -150;
    animation: robotLineLeftAnimation 3s linear;
    animation-fill-mode: forwards;
}

@keyframes robotLineLeftAnimation {
    0% {
        transform: translateX(0px) scale(1);
    }

    100% {
        transform: translateX(-50px) scale(0.1);
    }
}

@media (min-width: 800px) {
    .welcome-name__img--conection-left {
        animation: robotLineLeft800pxAnimation 3s linear;
        animation-fill-mode: forwards;
    }
}

@keyframes robotLineLeft800pxAnimation {
    0% {
        transform: translate(0px, 0px) scale(1);
        /* opacity: 0%; */
    }

    /* 90%{
        transform: translate(-50px, 0px) scale(0.1);
        opacity: 100%;
    } */

    100% {
        transform: translate(-50px, -10px) scale(0.1);
        /* opacity: 0%; */
    }
}

.welcome-name__img--conection-orbit {
    left: -150;
    animation: robotLineAnimation 6s infinite linear;
}


@keyframes robotLineAnimation {
    0% {
        transform: translate(0px, -10px);
    }

    40% {
        transform: translate(0px, 0px);
    }

    60% {
        transform: translate(0px, 0px);
    }

    100% {
        transform: translate(0px, -10px);
    }
}

.welcome-name__img--ship-static {
    /* transform: rotate(-45deg); */
    /* background-color: rgba(255, 0, 0, 0.541); */
    left: -60px;
    bottom: -220px;
    animation: ship3Animation 6s infinite linear;
}

@keyframes ship3Animation {
    0% {
        transform: translate(0px, -10px) scale(1.6);
    }

    40% {
        transform: translate(0px, 0px) scale(1.6);
    }

    60% {
        transform: translate(0px, 0px) scale(1.6);
    }

    100% {
        transform: translate(0px, -10px) scale(1.6);
    }
}

.welcome-name__img--robot-arrived {
    animation: robotArrivedAnimation 3s linear;
}


@keyframes robotArrivedAnimation {
    0% {
        transform: translateX(-150px) scale(0.1);
    }

    100% {
        transform: translateX(0px) scale(1.1);
    }
}

.welcome-name__img--robot-left {
    /* background-color: aqua; */
    animation: robotLeftAnimation 3s linear;
    animation-fill-mode: forwards;
}


@keyframes robotLeftAnimation {
    0% {
        transform: translateX(0px) scale(1);
    }

    100% {
        transform: translateX(-150px) scale(0.1);
    }
}

.welcome-name__img--robot-orbit {
    /* background-color: red; */
    animation: robotOrbitAnimation 6s infinite linear;
}

@keyframes robotOrbitAnimation {
    0% {
        transform: rotate(0deg) translate(0px, -10px);
    }

    20% {
        transform: rotate(10deg) translate(0px, -5px);
    }

    80% {
        transform: rotate(-10deg) translate(0px, -5px);
    }

    100% {
        transform: rotate(0deg) translate(0px, -10px);
    }
}

.welcome-name__img--satelite {
    animation: sateliteAnimation 12s linear;
    animation-fill-mode: forwards;
}

@keyframes sateliteAnimation {
    0% {
        transform: translate(-100px, -100px);
    }

    100% {
        transform: translate(500px, 500px);
    }
}

@media (min-width: 800px) {
    .welcome-name__img--satelite {
        animation: satelite800pxAnimation 12s linear;
        animation-fill-mode: forwards;
    }
}

@keyframes satelite800pxAnimation {
    0% {
        transform: translate(100px, -200px);
    }

    100% {
        transform: translate(800px, 800px);
    }
}


.welcome-name__img--ship-orbit {
    transform: rotate(-90deg);
    animation: orbitShipAnimation 12s linear;
    animation-fill-mode: forwards;
}

@keyframes orbitShipAnimation {
    0% {
        transform: translateX(500px) rotate(0deg);
    }

    100% {
        transform: translateX(-200px) rotate(0deg);
    }
}


@media (min-width: 800px) {
    .welcome-name__img--ship-orbit {
        animation: orbitShip800pxAnimation 12s linear;
        animation-fill-mode: forwards;
    }
}


@keyframes orbitShip800pxAnimation {
    0% {
        transform: translateX(2500px) rotate(15deg);
    }

    50% {
        transform: translateX(-100px) rotate(-15deg);
    }

    100% {
        transform: translateX(-800px) rotate(15deg);
    }
}


.welcome-name__img--ship-2-orbit {
    transform: rotate(-90deg);
    animation: orbitShip2Animation 12s linear;
    animation-fill-mode: forwards;
}

@keyframes orbitShip2Animation {
    0% {
        transform: translate(-100px, -400px) rotate(140deg);
    }

    100% {
        transform: translate(500px, 500px) rotate(140deg);
    }
}

.welcome-name__img--asteroid {
    animation: cometaAnimation 15s linear;
    animation-fill-mode: forwards;
    z-index: -1;
}


@keyframes cometaAnimation{
    0%{
        transform: translate(-600px, 1000px) rotate(-70deg);
        opacity: 0%;
    }

    10%{
        opacity: 65%;
    }

    100%{
        transform: translate(800px, -500px) rotate(-70deg);
        opacity: 65%;
    }
}


.video-container {
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgb(182, 182, 182);
    overflow:hidden
}

video {
    width: 100%;
    height: 100%;
    overflow: hidden;
    object-fit: cover;
    transform: translate(-50%, -50%);
    position: absolute;
    top: 50%;
    left: 50%;
}
</style>