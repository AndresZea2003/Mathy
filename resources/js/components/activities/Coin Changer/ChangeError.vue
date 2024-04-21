<script setup>

//Imagenes
import arrow from '../../../../../public/images/coin-change/flecha.png';


//Configurando emits para actualizar las tarjetas.
const emit = defineEmits(['closeWindowError']);


const closeError = () => {
    emit('closeWindowError', false);
};


setTimeout(() => {
    closeError();
}, 3000);

</script>

<template>
    <div class="change-error__div--container w-full h-full absolute left-0 z-30">
        <img class="change-error__img--arrow change-error__img--arrow-1 w-12 absolute" :src="arrow" alt="arrow" />
        <img class="change-error__img--arrow change-error__img--arrow-2 w-12 absolute" :src="arrow" alt="arrow" />
        <img class="change-error__img--arrow change-error__img--arrow-3 w-12 absolute" :src="arrow" alt="arrow" />
    </div>
</template>

<style scoped>
.change-error__div--container {
    background-color: rgba(0, 0, 0, 0.789);
    top: -30px;
}


.change-error__img--arrow-1 {
    top: 108px;
    left: 250px;
    animation: arrowAnimation1 2s infinite;
}

@keyframes arrowAnimation1 {
    0% {
        left: 200px;
    }

    100% {
        left: 250px;
    }
}

.change-error__img--arrow-2 {
    top: 108px;
    left: 397px;
    transform: rotate(180deg);
    animation: arrowAnimation2 2s infinite;
}

@keyframes arrowAnimation2 {
    0% {
        left: 447px;
    }

    100% {
        left: 397px;
    }
}

.change-error__img--arrow-3 {
    top: 185px;
    left: 323px;
    transform: rotate(-90deg);
    animation: arrowAnimation3 2s infinite;
}

@keyframes arrowAnimation3 {
    0% {
        top: 235px;
    }

    100% {
        top: 185px;
    }
}
</style>