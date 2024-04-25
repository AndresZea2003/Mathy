<script setup>
import { computed } from 'vue';

//Importacion de imagenes
import background1 from '../../../../public/images/backgrounds/background-1.png';
import background2 from '../../../../public/images/backgrounds/background-2.png';
import background3 from '../../../../public/images/backgrounds/background-3.png';
import background4 from '../../../../public/images/backgrounds/background-4.png';
import background5 from '../../../../public/images/backgrounds/background-5.png';
import background6 from '../../../../public/images/backgrounds/background-6.png';
import background7 from '../../../../public/images/backgrounds/background-7.png';
import background8 from '../../../../public/images/backgrounds/background-8.png';
import background9 from '../../../../public/images/backgrounds/background-9.png';
import background10 from '../../../../public/images/backgrounds/background-10.png';
import background11 from '../../../../public/images/backgrounds/background-11.png';
import background12 from '../../../../public/images/backgrounds/background-12.png';
import background13 from '../../../../public/images/backgrounds/background-13.png';
import background14 from '../../../../public/images/backgrounds/background-14.png';


//Importacion componentes
import AsteroidsAnimation from './AsteroidsAnimation.vue';
import ShotingStar from './ShotingStar.vue';
import AlienShip from './AlienShip.vue';
import OrbitingPlanet from './OrbitingPlanet.vue';
import BackgroundAnimationShip from './BackgroundAnimationShip.vue';



//Logica para poner los diferentes fondos
const arrayBackgrounds = [background1, background2, background3, background4, background5, background6, background7, background8, background9, background10, background11, background12, background13, background14];

const backgroundSelect = () => {
    let randomNum = Math.floor(Math.random() * arrayBackgrounds.length);

    return arrayBackgrounds[randomNum];
};

//Logica para poner las animaciones
let animationComponents = [AsteroidsAnimation, ShotingStar, AlienShip, BackgroundAnimationShip, OrbitingPlanet];


const animationRandom = computed(() => {
    let randomNum = Math.floor(Math.random() * animationComponents.length);

    return animationComponents[randomNum];
});



</script>

<template>
    <div class="w-full h-full -z-50 bg-center bg-cover overflow-hidden absolute" :style="{backgroundImage: `url(${backgroundSelect()})`}">
        <component :is="animationRandom" />
        <div class="w-11/12 h-full flex justify-between items-center m-auto">
            <!-- <div class="w-52 h-5/6 backdrop-blur-sm border-2 border-blue-900 rounded-md"></div>
            <div class="w-52 h-5/6 backdrop-blur-sm border-2 border-blue-900 rounded-md"></div> -->
        </div>
    </div>
</template>

<style scoped>

</style>