
<script setup>
import { ref } from 'vue';

//Importación de imagenes
import shotingStar from '../img/globals/shoting-star.png';


//Creamos una variable que es controlado por un intervalo que desmonta el div que contiene las estrellas fugaces el intervalo desactiva el div y lo vuelve a montar de nuevo para comenzar las animaciones nuevamente.
let active = ref(true);

setInterval(() => {
    active.value = false;
    setTimeout(() => {
        active.value = true;
    }, 1000);
}, 20000);

</script>

<template>
    <div v-if="active" class="shoting-star__div--container">
        <img class="shoting-star__img--star shoting-star__img--star-1" :src="shotingStar" alt="shoting-star-1"/>
        <img class="shoting-star__img--star shoting-star__img--star-2" :src="shotingStar" alt="shoting-star-2"/>
        <img class="shoting-star__img--star shoting-star__img--star-3" :src="shotingStar" alt="shoting-star-3"/>
        <img class="shoting-star__img--star shoting-star__img--star-4" :src="shotingStar" alt="shoting-star-4"/>
    </div>
</template>

<style  scoped>
    .shoting-star__div--container {
        width: 100%;
        height: 100%;
        overflow: hidden;
        position: absolute;
    }

    /* configuración general de la estrella fugaz */
    .shoting-star__img--star {
        width: 200px;
        position: absolute;
        right: -200px;
        top: 400px;
        transition: ease-in-out 0.5s;
    }

    /* configuración estrella 1 */
    .shoting-star__img--star-1 {
        transform: rotate(55deg);
        animation: shotingAnimation1 2s;
        animation-delay: 15s;
    }

    @keyframes shotingAnimation1 {
        0% {
            top: -50px;
            left: -50px;
        }
        100% {
            left: 800px;
            top: 1200px;
        }
    }

    /* configuración estrella 2 */
    .shoting-star__img--star-2 {
        transform: rotate(28deg);
        animation: shotingAnimation2 2s;
        animation-delay: 10s;
    }

    @keyframes shotingAnimation2 {
        0% {
            top: 10px;
            left: -200px;
        }
        100% {
            left: 1000px;
            top: 721px;
        }
    }

    /* configuración estrella 3 */
    .shoting-star__img--star-3 {
        transform: rotate(38deg);
        animation: shotingAnimation3 2s;
        animation-delay: 5s;
    }

    @keyframes shotingAnimation3 {
        0% {
            top: -100px;
            left: -20px;
        }
        100% {
            left: 1000px;
            top: 721px;
        }
    }

    /* configuración estrella 4 */
    .shoting-star__img--star-4 {
        transform: rotate(48deg);
        animation: shotingAnimation4 2s;
        animation-delay: 2s;
    }

    @keyframes shotingAnimation4 {
        0% {
            top: -90px;
            left: -10px;
        }
        100% {
            left: 700px;
            top: 700px;
        }
    }
</style>