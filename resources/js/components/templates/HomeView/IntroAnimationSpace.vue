<script setup>
import { ref } from 'vue';

//Imagenes
import mainLogo from '../../../../../public/images/globals/main-logo.png';
import galaxy from '../../../../../public/images/home/galaxy.jpg';

//Ref
const logoAnimation = ref(true); //true
const galaxyAnimationRef = ref(false); //false
const title = ref(false);
const titleText = ref("");


//Desmontaje de animacion del logo
setTimeout(() => {
    logoAnimation.value = false;
}, 7000);

//Montaje de animacion de galaxia
setTimeout(() => {
    galaxyAnimationRef.value = true;
    title.value = true;
    titleText.value = 'via lactea';

    //Desmontaje de galaxia
    setTimeout(() => {
        galaxyAnimationRef.value = false;
        title.value = false;
    }, 10000);
}, 6000);





</script>

<template>
    <div class="intro-animation__div--background w-full h-full flex justify-center items-center overflow-hidden">
        <h2 v-if="title" class="intro-animation__h2--title absolute text-white top-12 border border-white rounded-full px-4 text-2xl z-20">{{ titleText }}</h2>
        <img v-if="logoAnimation" class="intro-animation__img--logo" :src="mainLogo" alt="logo"/>
        <img v-if="galaxyAnimationRef" class="intro-animation__img--galaxy overflow-hidden" :src="galaxy" alt="galaxy"/>
        <div>

        </div>
    </div>
</template>

<style scope>
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
    width: 200px;
    border-radius: 100%;
    position: absolute;
    animation: galaxyAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes galaxyAnimation {
    0% {
        transform: rotate(0deg) scale(1);
        opacity: 0%;
    }

    5%{
        opacity: 100%;
    }

    20% {
        transform: rotate(-60deg) scale(1) translate(0px, 0px);
    }

    95% {
        opacity: 100%;
    }

    100%{
        transform: rotate(-60deg) scale(5) translate(0px, 50px);
        opacity: 0%;
    }

}
</style>