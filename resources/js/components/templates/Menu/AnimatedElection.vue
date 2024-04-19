<script setup>

import { onBeforeMount, ref } from 'vue';

//Sonidos
import coheteSound from '../../../../../public/audios/effects/audio-cohete.mp3';

//Importacion de los datos de la nave
import { store_data } from '../../../use/store_data';


//Gif imprtado prueba
import gifNave from '../../../../../public/images/rockets/Cohetes-13.gif';

//Props
const props = defineProps({
    levelSelected: String
});

//Ref que controla la posicion de la nave en el array que el usuario tiene.
const shipPositionArray = ref(0);

//Ref para guardar la nave encontrada.
const ship = ref(store_data[0]);

onBeforeMount(() => {
    //Buscamos la nave con el id de la nave actual.
    for (let i = 0; i < store_data.length; i++) {
        if(store_data[i].id === parseInt(localStorage.getItem("shipSelected"))){
            shipPositionArray.value = i;
        }
    };

    //Guardamos en el ref la nave encontrada.
    ship.value = store_data[shipPositionArray.value].img;
});

const planetColor = [
    {
        backgroundColor: "rgb(0, 150, 15)",
        shadow: "rgba(40, 162, 0, 0.76)"
    },
    {
        backgroundColor: "rgb(0, 10, 150)",
        shadow: "rgba(0, 5, 162, 0.76)"
    },
    {
        backgroundColor: "rgb(72, 0, 150)",
        shadow: "rgba(59, 0, 162, 0.76)"
    },
    {
        backgroundColor: "rgb(0, 122, 150)",
        shadow: "rgba(0, 140, 162, 0.76)"
    },
    {
        backgroundColor: "rgb(150, 85, 0)",
        shadow: "rgba(162, 135, 0, 0.76)"
    },
    {
        backgroundColor: "rgb(150, 0, 0)",
        shadow: "rgba(162, 0, 0, 0.76)"
    },
    {
        backgroundColor: "rgb(150, 0, 130)",
        shadow: "rgba(162, 0, 162, 0.76)"
    },
    {
        backgroundColor: "rgb(150, 0, 85)",
        shadow: "rgba(162, 0, 27, 0.76)"
    }
];


const randomPlanetColor = () => {
    let result;

    shipSoundEffect();

    let randomNum = Math.floor(Math.random() * planetColor.length);


    result = `background-color: ${planetColor[randomNum].backgroundColor}; box-shadow: 0px 0px 55px 13px ${planetColor[randomNum].shadow}`;

    return result;
};


const shipSoundEffect = () => {
    const audio = new Audio(coheteSound);

    audio.play();
};


</script>

<template>
    <div class="animated-election__div--container w-full h-full absolute top-0 left-0 z-40 flex justify-center items-center">
        <div class="animated-election__div--planet absolute" :style="randomPlanetColor()"></div>
        <p class="animated-election__p--level absolute text-slate-300 text-5xl z-50 rounded-2xl">{{ props.levelSelected }}</p>
        <img class="animated-election__img z-40" :src="gifNave" alt="ship"/>
        <!-- <img class="animated-election__img z-40" :src="ship" alt="ship"/> -->
        <div class="animated-election-wake absolute m-auto inset-x-0 w-10"></div>
    </div>
</template>

<style scoped>

.animated-election__div--container {
    background: url('../../img/menu/stars.png');
    background-size: cover;
    background-position: center;
    animation: launchAnimationBackground 5s linear;
}

@keyframes launchAnimationBackground {
    0% {
        background-color: rgba(0, 0, 0, 0.293);
    }
    25% {
        background-color: rgba(0, 0, 0, 0.751);
    }
    100% {
        background-color: rgb(0, 0, 0);
    }
}

.animated-election__div--planet {
    top: -600px;
    width: 800px;
    height: 800px;
    border-radius: 100%;
    animation: planetAnimation 5s linear;
}

@keyframes planetAnimation {
    0% {
        top: -700px;
    }
    60% {
        top: -650px;
    }
    100% {
        top: -600px;
    }
}


.animated-election__p--level {
    background: linear-gradient(45deg,hsl(283, 100%, 19%), #00376e, #9a9a9a,  #5d0063, #5d0063);
    background-size: 800% 800% !important;
    padding: 5px 30px;
    border: #9a9a9a solid 2px;
    font-family: 'ZCOOL KuaiLe', sans-serif;
    animation: levelAnimation 5s linear;
    top: 5px;
}

@keyframes levelAnimation {
    0% {
        transform: translateY(100px);
        color: rgb(237, 237, 237);
        background-position: 0% 0%;
    }
    10% {
        transform: translateY(200px);
        color: rgb(162, 162, 162);
        background-position: 50% 50%;
    }
    100% {
        transform: translateY(300px);
        color: rgb(255, 255, 255);
        background-position: 100% 100%;
    }
}


.animated-election__img {
    position: absolute;
    bottom: -400px;
    animation: launchAnimation 5s;
    width: 400px;
}

/* @keyframes launchAnimation {
    0% {
        transform: rotate(315deg) translate(0px, 0px);
    }
    50% {
        transform: rotate(315deg) translate(486px, -490px);
    }
    100% {
        transform: rotate(315deg) translate(786px, -790px);
    }
} */

@keyframes launchAnimation {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-486px);
    }
    100% {
        transform: translateY(-886px);
    }
}


.animated-election-wake {
    bottom: -50px;
    height: 30px;
    background-size: 600%;
    background: linear-gradient(to bottom, rgba(255,255,255,1) 0%, rgba(252,252,252,0.67) 42%, rgba(0,0,0,0.22) 100%);
    animation: wakeAnimation 5s linear;
}

/* @keyframes wakeAnimation {
    0% {
        width: 10px;
        transform: rotate(270deg);
    }
    100% {
        width: 400px;
        transform: rotate(270deg);
    }
} */


@keyframes wakeAnimation {
    0% {
        height: 10px;
    }
    50% {
        height: 600px;
    }
    100% {
        height: 1000px;
    }
}
</style>