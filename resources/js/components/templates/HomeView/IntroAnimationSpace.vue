<script setup>
import { ref } from 'vue';

//Imagenes
import mainLogo from '../../../../../public/images/globals/main-logo.png';
import galaxy from '../../../../../public/images/home/galaxy.jpg';
import robot from '../../../../../public/images/characters/robot/robot.png';
import conection from '../../../../../public/images/home/conection.png';
import asteroidBelt from '../../../../../public/images/home/asteroid-belt.png';
import satelite from '../../../../../public/images/home/satelite.png';

import ship1 from '../../../../../public/images/rockets/Cohetes-13.gif';
import ship from '../../../../../public/images/rockets/Cohetes-13.svg';

//Componentes
import AnimatedStars from '../../activities/DrawActivity/AnimatedStars.vue';
import WelcomeName from './WelcomeName.vue';

//Ref
const logoAnimation = ref(false); //true
const galaxyAnimationRef = ref(false); //false
const welcomeName = ref(true);
const title = ref(false);
const ship1Ref = ref(true);




// //Desmontaje de animacion del logo
// setTimeout(() => {
//     logoAnimation.value = false;
// }, 7000);

// //Montaje de animacion de galaxia
// setTimeout(() => {
//     galaxyAnimationRef.value = true;
//     title.value = true;
//     titleText.value = 'via lactea';

//     //Desmontaje de galaxia
//     setTimeout(() => {
//         galaxyAnimationRef.value = false;
//         title.value = false;
//     }, 10000);
// }, 6000);





</script>

<template>
    <div class="intro-animation__div--background w-full h-full flex justify-center items-center overflow-hidden">
        <!-- <h2 v-if="title" class="intro-animation__h2--title absolute text-white top-12 border border-white rounded-full px-4 text-2xl z-20">{{ titleText }}</h2> -->
        <img v-if="logoAnimation" class="intro-animation__img--logo" :src="mainLogo" alt="logo"/>
        <WelcomeName/>
        <div v-if="galaxyAnimationRef" class="intro-animation__img--galaxy w-full h-full overflow-hidden">
            <AnimatedStars/>
            <div class="intro-animation__div--robot-rocket w-60 absolute m-auto left-0 right-0">
                <img class="intro-animation__img--conection w-28 absolute  bottom-14 left-10 xl:w-40" :src="conection" alt="conection"/>
                <img class="intro-animation__img--ship w-60 absolute" :src="ship" alt="ship"/>
                <img class="intro-animation__img--robot w-40 relative bottom-4 left-24 xl:w-60" :src="robot" alt="robot"/>
            </div>

            <img class="intro-animation__img--satelite w-16 absolute" :src="satelite" alt="satelite"/>

            <img class="intro-animation__img--belt-asteroids overflow-hidden" :src="asteroidBelt" alt="asteroid-belt"/>
            <!-- <img class="intro-animation__img--ship1 w-32 absolute top-6" v-if="ship1Ref" :src="ship1" alt="ship-1"/> -->
        </div>
    </div>
</template>

<style scoped>
.intro-animation__div--background {
    animation: backgroundAnimation 25s linear;
}

@keyframes backgroundAnimation {
    0%{
        background-color: rgba(9, 0, 185, 0);
    }

    22%{
        background-color: rgba(0, 0, 0, 0);
    }

    24%{
        background-color: rgb(0, 0, 0);
    }

    30%{
        background-color: rgb(0, 0, 0);
    }
}


.intro-animation__img--logo  {
    width: 200px;
    z-index: 11;
    animation: mainLogoAnimation 6s linear;
    animation-fill-mode: forwards;
}

@media screen and (min-width: 1300px) {
    .intro-animation__img--logo  {
        width: 500px;
    }
}

@keyframes mainLogoAnimation {
    0% {
        transform: scale(1);
        opacity: 100%;
    }

    5% {
        transform: scale(1);
        opacity: 100%;
    }

    80% {
        opacity: 100%;
    }

    100% {
        transform: scale(2) rotate(25deg);
        opacity: 0%;
    }
}

/* titulo */
.intro-animation__h2--title {
    font-family: 'julius sans one';
}

/* Galaxia */
.intro-animation__img--galaxy {
    overflow: hidden;
    background-image: url('../../../../../public/images/backgrounds/space.jpg');
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

.intro-animation__div--robot-rocket {
    top: 450px;
}


.intro-animation__img--robot {
    animation: robotAnimation 6s infinite linear;
}


@keyframes robotAnimation {
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

.intro-animation__img--conection {
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

.intro-animation__img--belt-asteroids {
    width: 3500px;
    max-width: none;
    position: relative;
    top: 150px;
    overflow: hidden;
    animation: asteroidAnimation 120s infinite linear;
}

@keyframes asteroidAnimation {
    0% {
        transform: translateX(0);
    }

    50% {
        transform: translateX(-500px);
    }

    100% {
        transform: translateX(0);
    }
}

/* ship1 */
.intro-animation__img--ship{
    transform: rotate(-45deg);
    left: -80px;
    bottom: -40px;
    animation: shipAnimation 6s infinite linear;
}


@keyframes shipAnimation {
    0% {
        transform: translate(0px, -10px) rotate(-45deg);
    }

    40% {
        transform: translate(0px, 0px) rotate(-45deg);
    }

    60% {
        transform: translate(0px, 0px) rotate(-45deg);
    }

    100% {
        transform: translate(0px, -10px) rotate(-45deg);
    }
}

.intro-animation__img--satelite {
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

</style>