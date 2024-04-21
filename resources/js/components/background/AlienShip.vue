<script setup>
import { ref } from 'vue';

//Importacion de imagenes
import ovni from '../../../../public/images/globals/ovni.png';

//Creamos una variable que es controlado por un intervalo que desmonta el div que contiene las estrellas fugaces el intervalo desactiva el div y lo vuelve a montar de nuevo para comenzar las animaciones nuevamente.
let active = ref(true);


setInterval(() => {
    active.value = false;
    setTimeout(() => {
        active.value = true;
    }, 1000);
}, 40000);

</script>

<template>
    <div v-if="active" class="w-full h-full overflow-hidden absolute">
        <img class="ovni__img--ovni w-16 absolute" :src="ovni" alt="ovni"/>
    </div>
</template>

<style scoped>
.ovni__img--ovni {
    top: 300px;
    left: -100px;
    animation: ovniAnimation 20s linear;
}


@keyframes ovniAnimation {
    0% {
        transform: translate(0, 0) rotate(0deg);
    }
    10% {
        transform: translate(180px, -10px) rotate(15deg);
    }
    20% {
        transform: translate(360px, 10px) rotate(-15deg);
    }
    30% {
        transform: translate(540px, -40px) rotate(20deg);
    }
    40% {
        transform: translate(720px, 40px) rotate(-20deg);
    }
    50% {
        transform: translate(900px, -30px) rotate(5deg);
    }
    60% {
        transform: translate(1080px, 30px) rotate(-5deg);
    }
    70% {
        transform: translate(1260px, -10px) rotate(15deg);
    }
    80% {
        transform: translate(1440px, 10px) rotate(-15deg);
    }
    90% {
        transform: translate(1620px, -13px) rotate(3deg);
    }
    100% {
        transform: translate(1800px, 0) rotate(0deg);
    }
}

</style>