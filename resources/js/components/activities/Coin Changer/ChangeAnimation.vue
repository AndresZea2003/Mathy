<script setup>
import { onBeforeMount, ref } from 'vue';

//Importacion de imagenes
import coinBronze from '../../../../../public/images/globals/bronze-coin.png';
import coinSilver from '../../../../../public/images/globals/silver-coin.png';
import coinGolden from '../../../../../public/images/globals/gold-coin.png';
import ovni from '../../../../../public/images/coin-change/ovni.png';
import catnauta from '../../../../../public/images/coin-change/catnauta.png';
import star from '../../../../../public/images/coin-change/star.png';
import planet from '../../../../../public/images/coin-change/planet.png';


//Importacion de sonidos
import hoverEffect from '../../../../../public/audios/effects/audioHoverStandard.mp3';
import clickEffect from '../../../../../public/audios/effects/audioClickStandard.mp3';


//Importacion de librerias
import { getUsersLocalStorage } from '../../../use';


//Props
const props = defineProps({
    coinChangeType: String
});

//Ref que manejan las imagenes segun las monedas a cambiar
const coinImage = ref(null);
const coinChange = ref(null);
const coinChangerAutoRef = ref(false);


//Creamos un before mount para manejar antes del monataje del componente que imagenes se usaran.
onBeforeMount(() => {
    if (props.coinChangeType === "silver") {
        coinImage.value = coinSilver;
        coinChange.value = coinGolden;
    } else if (props.coinChangeType === "bronze") {
        coinImage.value = coinBronze;
        coinChange.value = coinSilver;
    }

    coinChangerAutoRef.value = getUsersLocalStorage().coinChangerAuto;
});


//Configurando emits para actualizar las tarjetas.
const emit = defineEmits(['closeAnimation']);


//Funcion que cierra la animacion.
const closeAnimation = () => {
    emit('closeAnimation', false);
    clickEffectSound();
};

//Funcion para ejecutar el sonido del hover del boton continuar
const hoverEffectSound = () => {
    const audio = new Audio(hoverEffect);

    audio.play();
};

const clickEffectSound = () => {
    const audio = new Audio(clickEffect);

    audio.play();
};


</script>

<template>
    <div class="w-full h-full absolute top-0 left-0 z-40">
        <div class="change-animation__div--container-animations">
            <img class="change-animation__img--catnauta" :src="catnauta" alt="catnauta" />
            <img class="change-animation__img--planet" :src="planet" alt="catnauta" />
            <img class="change-animation__img--star" :src="star" alt="catnauta" />
            <img class="change-animation__img--ovni" :src="ovni" alt="catnauta" />
            <img class="change-animation__div--coin-generated" :src="coinChange" alt="golden-coin" />
            <div class="change-animation__div--animationCoin">
            </div>
        </div>

        <button v-if="!coinChangerAutoRef" @mouseenter="hoverEffectSound"
            class="change-animation__button--continuar text-slate-300 m-auto w-56 h-8 rounded rounded-lg bg-cyan-950 absolute left-0 right-0 transition-all hover:scale-125 hover:text-slate-100"
            @click="closeAnimation">Continuar</button>
    </div>
</template>

<style scoped>
/* Estilos container */
.change-animation-coins-container {
    top: 155px;
}

/* Estilos cada moneda flotante */
.change-animation-coin-1 {
    filter: drop-shadow(5px 5px 5px rgba(0, 0, 0, 0.5));
    animation: coin1Animation 6s linear;
    animation-fill-mode: forwards;
}

@keyframes coin1Animation {
    0% {
        transform: translate(0px, 0px) rotate(0deg) scale(1);
        opacity: 100%;
    }

    22% {
        transform: translate(-40px, 30px)rotate(20deg) scale(1.2);
        opacity: 100%;
    }

    49% {
        transform: translate(100px, -30px)rotate(70deg) scale(1);
        opacity: 100%;
    }

    68% {
        transform: translate(-140px, 100px)rotate(20deg) scale(1.4);
        opacity: 50%;
    }

    100% {
        transform: translate(60px, 50px) rotate(240deg) scale(1);
        opacity: 0%;
    }
}

.change-animation-coin-2 {
    filter: drop-shadow(5px 5px 5px rgba(0, 0, 0, 0.5));
    animation: coin2Animation 6s linear;
    animation-fill-mode: forwards;
}

@keyframes coin2Animation {
    0% {
        transform: translate(0px, 0px) rotate(0deg) scale(1);
        opacity: 100%;
    }

    34% {
        transform: translate(-40px, -40px)rotate(-20deg) scale(1.2);
        opacity: 100%;
    }

    45% {
        transform: translate(30px, -60px)rotate(120deg) scale(1.1);
        opacity: 100%;
    }

    80% {
        transform: translate(-40px, 20px)rotate(40deg) scale(1.4);
        opacity: 50%;
    }

    100% {
        transform: translate(60px, 50px) rotate(240deg) scale(1);
        opacity: 0%;
    }
}

.change-animation-coin-3 {
    filter: drop-shadow(5px 5px 5px rgba(0, 0, 0, 0.5));
    animation: coin3Animation 6s linear;
    animation-fill-mode: forwards;
}

@keyframes coin3Animation {
    0% {
        transform: translate(0px, 0px) rotate(0deg) scale(1);
        opacity: 100%;
    }

    20% {
        transform: translate(-50px, -20px)rotate(90deg) scale(1.5);
        opacity: 100%;
    }

    55% {
        transform: translate(90px, 40px)rotate(70deg) scale(.5);
        opacity: 100%;
    }

    78% {
        transform: translate(-140px, 100px)rotate(20deg) scale(1.4);
        opacity: 50%;
    }

    100% {
        transform: translate(60px, 50px) rotate(240deg) scale(1);
        opacity: 0%;
    }
}

/* Estilos circulo de luz  */
.change-animation-white-circle {
    box-shadow: 0px 0px 203px 200px rgb(255, 255, 255);
    animation-fill-mode: forwards;
    animation: whiteCircleAnimation 6s linear;
    transform: scale(1.5);
}

@keyframes whiteCircleAnimation {
    0% {
        transform: scale(0);
        opacity: 0%;
        box-shadow: 0px 0px 203px 200px rgba(255, 255, 255, 0.379);
    }

    50% {
        transform: scale(.5);
        opacity: 50%;
        box-shadow: 0px 0px 203px 200px rgba(255, 255, 255, 0.751);
    }

    100% {
        transform: scale(1.5);
        opacity: 100%;
        box-shadow: 0px 0px 203px 200px rgb(255, 255, 255);
    }
}

/* Estilos resultado moneda cambiada */
.change-animation__img--coin-change {
    animation: coinChangeAnimation 30s linear;
    transform: scale(1);
}

@keyframes coinChangeAnimation {
    0% {
        transform: scale(0);
        opacity: 0%;
    }

    85% {
        transform: scale(.5);
        opacity: 0%;
    }

    100% {
        transform: scale(1);
        opacity: 100%;
    }
}

.change-animation__button--continuar {
    top: 350px;
    animation: buttonContinueAnimation 15s linear;
}

@keyframes buttonContinueAnimation {
    0% {
        transform: scale(0);
        opacity: 0%;
    }

    90% {
        transform: scale(0);
        opacity: 0%;
    }

    100% {
        transform: scale(1);
        opacity: 100%;
    }
}


.change-animation__div--container-animations {
    width: 188px;
    height: 60px;
    position: absolute;
    left: 0;
    right: 0;
    margin: auto;
    top: 280px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.change-animation__div--animationCoin {
    width: 100%;
    height: 100%;
    background-color: rgba(105, 85, 85, 0);
    animation: absorptionAnimation 3s linear;
    box-shadow: 0px 0px 27px 0px rgba(255, 255, 255, 0.75);
    animation-fill-mode: forwards;
    animation-delay: 5s;
}

@keyframes absorptionAnimation {
    0% {
        width: 188px;
        height: 60px;
        background-color: rgba(255, 255, 255, 0);
        border-radius: 0%;
        opacity: 0%;
    }

    20% {
        width: 188px;
        height: 60px;
        background-color: rgb(255, 255, 255);
        border-radius: 0%;
        opacity: 100%;

    }

    50% {
        width: 40px;
        height: 40px;
        background-color: rgb(255, 255, 255);
        border-radius: 100%;
        opacity: 100%;
    }

    100% {
        width: 40px;
        height: 40px;
        background-color: rgb(255, 255, 255);
        border-radius: 100%;
        opacity: 0%;
    }
}

.change-animation__img--catnauta {
    width: 40px;
    filter: drop-shadow(0px 0px 10px rgba(255, 255, 255, 0.5));
    position: absolute;
    animation: catnautaAnimation 2s linear;
    animation-fill-mode: forwards;

}

@keyframes catnautaAnimation {
    0% {
        transform: scale(1.5) translate(80px, 80px);
    }

    100% {
        transform: scale(0) translate(0px, 0px);
    }
}

.change-animation__img--planet {
    width: 40px;
    filter: drop-shadow(0px 0px 10px rgba(255, 255, 255, 0.5));
    position: absolute;
    animation: planetAnimation 4s linear;
    animation-fill-mode: forwards;

}

@keyframes planetAnimation {
    0% {
        transform: scale(1.5) translate(60px, -60px);
    }

    100% {
        transform: scale(0) translate(0px, 0px);
    }
}

.change-animation__img--star {
    width: 40px;
    filter: drop-shadow(0px 0px 10px rgba(255, 255, 255, 0.5));
    position: absolute;
    animation: starAnimation 3s linear;
    animation-fill-mode: forwards;

}

@keyframes starAnimation {
    0% {
        transform: scale(1.5) translate(-100px, -100px);
    }

    100% {
        transform: scale(0) translate(0px, 0px);
    }
}

.change-animation__img--ovni {
    width: 40px;
    filter: drop-shadow(0px 0px 10px rgba(255, 255, 255, 0.5));
    position: absolute;
    animation: ovniAnimation 6s linear;
    animation-fill-mode: forwards;

}

@keyframes ovniAnimation {
    0% {
        transform: scale(1.5) translate(-50px, 80px);
    }

    100% {
        transform: scale(0) translate(0px, 0px);
    }
}


.change-animation__div--coin-generated {
    width: 40px;
    position: absolute;
    left: 0;
    right: 0;
    margin: auto;
    opacity: 0%;
    z-index: -10;
    border-radius: 100%;
    animation: coinGeneratedAnimation 6s linear;
    animation-fill-mode: forwards;
    animation-delay: 7s;

}

@keyframes coinGeneratedAnimation {
    0% {
        transform: scale(1) translate(0px, 0px);
        filter: drop-shadow(0px 0px 10px rgba(255, 255, 255, 0.5));
        opacity: 80%;
    }

    10% {
        transform: scale(1) translate(0px, 0px);
        filter: drop-shadow(0px 0px 10px rgba(255, 255, 255, 0.5));
        opacity: 80%;
    }

    50% {
        transform: scale(1) translate(0px, 190px);
        filter: drop-shadow(0px 0px 10px rgba(255, 255, 255, 0.5));
        opacity: 80%;
    }

    51% {
        transform: scale(1) translate(0px, 190px);
        filter: drop-shadow(0px 0px 10px rgba(255, 255, 255, 0.5));
        opacity: 100%;
        box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.75);
    }

    100% {
        transform: scale(2.2) translate(0px, -30px);
        filter: drop-shadow(0px 0px 50px rgb(10, 0, 82));
        opacity: 100%;
        box-shadow: 0px 0px 192px 145px rgba(255, 255, 255, 0.75);
    }
}
</style>