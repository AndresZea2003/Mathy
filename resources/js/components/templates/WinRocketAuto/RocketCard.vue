<script setup>
import { ref } from 'vue';

import goldCoin from '../../../../../public/images/globals/gold-coin.png';
import { getUsersLocalStorage, saveDataLocalStorage } from '../../../use';

//Audios
import clickAudio from '../../../../../public/audios/effects/soapBubble.wav';
import hoverCardAudio from '../../../../../public/audios/effects/happyPop.mp3';
import launchRocketAudio from '../../../../../public/audios/effects/audioRocket.mp3';


//Emits
const emit = defineEmits(['rocketSelected']);


//Props
const props = defineProps({
    shipNum: Number,
    randomShip: Object,
    rocketSelectedRef: Boolean,
    type: Number//Este parametro define que tipo de tarjeta se va a utilizar ya que este componente devuelve una tarjeta para el selector de naves automatico inicial y el del ciclo de juego.
});


//Ref
const hoverClass = ref(`rocket-card__div--card-${props.shipNum}`);
const rocketSelectedRef = ref(true);


//Funciones para tratar el hover sin perder ninguna animacion
const hoverCard = () => {
    hoverAudioFunction();
    hoverClass.value = `rocket-card__div--card-animation`;
};

const hoverOffCard = () => {
    hoverClass.value = ``;
};

//Elegimos la nave para guardar y ejecutar la animacion
const rocketSelected = (type) => {
    //Ref que controla si se eligio nave para no elegir automaticamente.
    rocketSelectedRef.value = false;

    //Ejecucion del sonido de click
    clickAudioFunction();

    //Traemos los datos de la store
    let userData = getUsersLocalStorage();

    //Modificamos los datos necesarios
    userData.shipSelected = type.id;

    userData.unlockedShips.push(type.id);

    //Guardamos los datos
    saveDataLocalStorage(userData);

    //Enviamos los datos al componente padre para ejecutar la animacion de eleccion.
    emit('rocketSelected', type);
};

//Audio
const clickAudioFunction = () => {
    const click = new Audio(clickAudio);
    const launchRocket = new Audio(launchRocketAudio);


    click.volume = 0.1;
    launchRocket.volume = 0.1;

    click.play();

    setTimeout(() => {
        launchRocket.play();
    }, 2000);
};

const hoverAudioFunction = () => {
    const hover = new Audio(hoverCardAudio);

    hover.volume = 0.1;

    hover.play();
};

setTimeout(() => {
    if(props.rocketSelectedRef && rocketSelectedRef.value){
        console.log("ejecutando nave electa", props.rocketSelectedRef);
        rocketSelected(props.randomShip);
    };

}, 30000);


</script>

<template>
    <div v-if="type === 1" @click="rocketSelected(props.randomShip)" @mouseenter="hoverCard" @mouseleave="hoverOffCard" :class="`${hoverClass} bg-blue-900 w-52 h-60 md:h-96 md:w-60 m-5 border rounded-md border-cyan-300 border-2 flex justify-center items-center transition-all cursor-pointer relative`">
        <img :src="props.randomShip.img" alt="rocket"/>
        <button class="rocket-card__button--container-coin w-14 h-14 absolute bottom-3">
            <img class="rocket-card__img--coin w-20 rounded-full" :src="goldCoin" alt="gold-coin"/>
        </button>
    </div>
    <div v-if="type === 2" class="rounded-lg  bg-black w-11/12 h-20 my-1">

    </div>
</template>

<style scoped>
.rocket-card__div--card-1 {
    transition: ease-in-out 2s;
    animation: rocket1Animation 2s;
    animation-fill-mode: forwards;
}

@keyframes rocket1Animation {
    0% {
        transform: translateY(-200px);
    }

    100% {
        transform: translateY(0px);
    }
}

.rocket-card__div--card-2 {
    transition: ease-in-out 2s;
    animation: rocket2Animation 2s;
    animation-fill-mode: forwards
}

@keyframes rocket2Animation {
    0% {
        transform: translateY(200px);
    }

    100% {
        transform: translateY(0px);
    }
}

.rocket-card__img--coin {
    animation: buttonCoinAnimation 4s infinite;
    background-color: aquamarine;
}

@keyframes buttonCoinAnimation {
    0% {
        box-shadow: 0px 0px 73px -45px rgba(255,255,255,1);
    }

    50% {
        box-shadow: 0px 0px 35px 17px rgb(255, 255, 255);
    }

    100% {
        box-shadow: 0px 0px 73px -45px rgba(255,255,255,1);
    }
}

.rocket-card__div--card-animation {
    background: rgb(39,230,0);
    background: linear-gradient(0deg, rgba(39,230,0,1) 49%, rgba(0,255,231,1) 52%, #1E3A8A 55%);
    background-size: 3000px 3000px;
    animation: hoverCardAnimation 1s;
    animation-fill-mode: forwards;
    transform: scale(0.95);
}


@keyframes hoverCardAnimation {
    0% {
        background-position-y: 0px;
    }

    100% {
        background-position-y: 500px;
    }
}



.rocket-card__button--container-coin {
    opacity: 0%;
    animation: coinIntroAnimation 1s;
    animation-delay: 1.5s;
    animation-fill-mode: forwards;
}

@keyframes coinIntroAnimation {
    0% {
        opacity: 0%;
    }

    100% {
        opacity: 100%;
    }
}
</style>