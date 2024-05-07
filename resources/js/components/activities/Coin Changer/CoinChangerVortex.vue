<script setup>

//Imagenes
import coinChangerImage from '../../../../../public/images/coin-change/coin-changer-image.png';
import storeImage from '../../../../../public/images/coin-change/store-img.png';

//Librerias
import { store_data } from '../../../use/store_data';


//Sonidos
import vortexSound from '../../../../../public/audios/coin-changer/vortex-sound.mp3';
import audioRocket from '../../../../../public/audios/effects/audioRocket.mp3';



import { onBeforeUnmount, onUpdated } from 'vue';



const props = defineProps({
    type: {type: Array},
    selected: {type: Boolean},
});

const currentShip = () => {
    let currentShip = parseInt(localStorage.getItem('shipSelected'));

    return store_data[currentShip - 1].img;
};

const vortexSoundEffect = new Audio(vortexSound);
const audioRocketEffect = new Audio(audioRocket);

vortexSoundEffect.play();
vortexSoundEffect.volume = 0.05;

onBeforeUnmount(() => {
    vortexSoundEffect.pause();
    vortexSoundEffect.currentTime = 0;
});


onUpdated(() => {
    if(props.selected){
        audioRocketEffect.play();
        // audioRocketEffect.volume = 0.5;
    };
});


</script>

<template>
    <div class="vortex__div--container flex justify-center items-center w-full h-full absolute ">
        <img v-if="props.selected" class="vortex__img--ship w-80 absolute z-30" :src="currentShip()" alt="ship"/>
        <div class="vortex__div--vortex-background rounded-full w-96 h-96 flex justify-center items-center">
            <img v-if="props.type === 'changer'" class="vortex__img--coin-changer w-72 rounded-full" :src="coinChangerImage" alt="vortex-image"/>
            <img v-if="props.type === 'store'" class="vortex__img--coin-changer w-72 rounded-full" :src="storeImage" alt="vortex-image"/>
        </div>
    </div>
</template>

<style scoped>

.vortex__div--vortex-background {
    z-index: 2;
    background-image: url('../../../../../public/images/coin-change/vortex-2.jpg');
    background-size: cover;
    background-position: center;
    -webkit-box-shadow: 0px 0px 126px -3px rgba(0,0,176,1);
    -moz-box-shadow: 0px 0px 126px -3px rgba(0,0,176,1);
    box-shadow: 0px 0px 126px -3px rgba(0,0,176,1);
    animation: rotateVortexAnimation 10s infinite linear,  introVortexAnimation 1s linear;
}

@keyframes rotateVortexAnimation {
    0% {
        transform: rotate(0deg);
    }

    /* 50% {
        transform: rotate(180deg);
    } */

    100% {
        transform: rotate(360deg);
    }
}

@keyframes introVortexAnimation {
    0% {
        width: 0;
        height: 0;
    }

    /* 50% {
        transform: rotate(180deg);
    } */

    100% {
        width: 400px;
        height: 400px;
    }
}



.vortex__img--coin-changer {
    -webkit-box-shadow: 0px 0px 179px 21px rgba(255,255,255,1);
    -moz-box-shadow: 0px 0px 179px 21px rgba(255,255,255,1);
    box-shadow: 0px 0px 179px 21px rgba(255,255,255,1);
    animation: rotateCoinChangerAnimation 10s infinite linear;
}

@keyframes rotateCoinChangerAnimation {
    0% {
        transform: rotate(0deg);
    }

    /* 50% {
        transform: rotate(180deg);
    } */

    100% {
        transform: rotate(-360deg);
    }
}


.vortex__img--ship {
    animation: animationShip 2s  linear;
    animation-fill-mode: forwards;
}

@keyframes animationShip {
    0% {
        transform: rotate(398deg) translate(-400px, 400px);
    }

    100% {
        transform: rotate(398deg) translate(0px, 0px);
    }
}

</style>