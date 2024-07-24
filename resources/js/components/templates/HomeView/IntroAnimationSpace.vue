<script setup>
import { ref } from 'vue';

//Imagenes
import mainLogo from '../../../../../public/images/globals/main-logo.png';
import skipShip from '../../../../../public/images/home/standard-ship.png';



//Componentes
import WelcomeName from './WelcomeName.vue';
import LandingStart from './LandingStart.vue';
import ButtonSkip from '../../ui/ButtonSkip.vue';
import WinrocketAutoInitial from '../../templates/WinRocketAuto/WinrocketAutoInitial.vue';

//Ref
const logoAnimation = ref(true); //true
const galaxyAnimationRef = ref(false); //false
const landingStartanimationRef = ref(false); //false
const winRocketInitialRef = ref(false);

const props = defineProps({
    video: String,
});


//Desmontaje de animacion del logo
setTimeout(() => {
    logoAnimation.value = false;

    //SIla ultima pantalla esta activa significa que se uso el omitir asi que ya no se activa la animacion del robot
    if(!landingStartanimationRef.value){
        robotIntroduction();
    };
}, 6000);

//Funcion que activa la secuencia de activacion de animaciones de robot y posterior pantalla principal
const robotIntroduction = () => {
    galaxyAnimationRef.value = true;

    setTimeout(() => {
        galaxyAnimationRef.value = false;

        winRocketInitialRef.value = true;
    }, 28000);
};



const skipAnimation = () => {
    logoAnimation.value = false;
    galaxyAnimationRef.value = false;
    landingStartanimationRef.value = true;
};


//Funcion para determinar cuando se eligio una nave
const rocketSelected = (event) => {
    if(event){
        winRocketInitialRef.value = false;
        landingStartanimationRef.value = true;
    }
};
</script>

<template>
    <div class="intro-animation__div--background w-full h-full flex justify-center items-center overflow-hidden">
        <!-- <h2 v-if="title" class="intro-animation__h2--title absolute text-white top-12 border border-white rounded-full px-4 text-2xl z-20">{{ titleText }}</h2> -->
        <img v-if="logoAnimation" class="intro-animation__img--logo" :src="mainLogo" alt="logo"/>
        <WelcomeName v-if="galaxyAnimationRef" :video="props.video"/>
        <LandingStart v-if="landingStartanimationRef"/>
        <WinrocketAutoInitial v-if="winRocketInitialRef" @rocketSelected="rocketSelected"/>
        <!-- <button v-if="!landingStartanimationRef" @click="skipAnimation" class="absolute bottom-7 right-7 bg-blue-900 z-50 rounded-lg px-10 transition-all border border-2 hover:bg-blue-500 hover:scale-90"><img class="intro-animation__div--skip-button w-10" :src="skipShip" alt="skip"/></button> -->
        <div v-if="!landingStartanimationRef" @click="skipAnimation" class="absolute bottom-2 right-7 z-20 w-16 h-20 xl:bottom-7 xl:w-24 xl:h-24">
            <ButtonSkip/>
        </div>
    </div>
</template>

<style scoped>
.intro-animation__div--background {
    animation: backgroundAnimation 25s linear;
    animation-fill-mode: forwards;
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
    animation: mainLogoAnimation 5s linear;
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

.intro-animation__div--skip-button {
    animation: skipAnimation 2s linear infinite;
};

@keyframes skipAnimation {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.9);
    }

    100% {
        transform: scale(1);
    }
}

</style>