
<script setup>
import { onBeforeMount, onMounted, onUpdated, ref, watch } from "vue";

//Imagenes
import background1 from '../../../../../public/images/backgrounds/background-1.png';
import background2 from '../../../../../public/images/backgrounds/background-2.png';
import background3 from '../../../../../public/images/backgrounds/background-3.png';
import background4 from '../../../../../public/images/backgrounds/background-4.png';
import background5 from '../../../../../public/images/backgrounds/background-5.png';
import background6 from '../../../../../public/images/backgrounds/background-6.png';
import background7 from '../../../../../public/images/backgrounds/background-7.png';
import background8 from '../../../../../public/images/backgrounds/background-8.png';
import background9 from '../../../../../public/images/backgrounds/background-9.png';
import background10 from '../../../../../public/images/backgrounds/background-10.png';
import background11 from '../../../../../public/images/backgrounds/background-11.png';
import background12 from '../../../../../public/images/backgrounds/background-12.png';
import background13 from '../../../../../public/images/backgrounds/background-13.png';
import background14 from '../../../../../public/images/backgrounds/background-14.png';

//Audios
import timerAudio from '../../../../../public/audios/effects/timerAudio.mp3';

//Componentes
import RocketCard from "./RocketCard.vue";
import RocketSelected from "./RocketSelected.vue";
import ShotingStars from "../../background/ShotingStar.vue";

//Librerias
import { store_data } from "../../../use/store_data";
import { getUsersLocalStorage, nextLevel, saveDataLocalStorage } from "../../../use";

const rocketSelectedCard = ref(false);//false
const rocketSelected1 = ref(true);//true
const rocketSelected2 = ref(true);//true
const counterActive = ref(true);
const backgroundSelected = ref("");
const unlockedShips = ref([]);
const rocketsSelectedRef = ref([]);
const rocketSelected1Ref = ref(false);
const rocketSelected2Ref = ref(false);



const backgrounds = [
    background1,
    background2,
    background3,
    background4,
    background5,
    background6,
    background7,
    background8,
    background9,
    background10,
    background11,
    background12,
    background13,
    background14
];

const randomBackground = () => {
    return backgrounds[Math.floor(Math.random() * backgrounds.length)];
};

onBeforeMount(() => {
    backgroundSelected.value = randomBackground();
    unlockedShips.value = getUsersLocalStorage().unlockedShips;
    // rocketsSelectedRef.value = [ selectedRandomRocket(), selectedRandomRocket() ];
    notSameRocket();

    shipSelectedRandom();
});

const shipSelectedRandom = () => {
    let randomNum = Math.floor(Math.random() * 2);

    if(randomNum === 0){
        console.log("Random 1");
        rocketSelected1Ref.value = true;
        rocketSelected2Ref.value = false;
    } else if(randomNum === 1){
        console.log("Random 2");
        rocketSelected1Ref.value = false;
        rocketSelected2Ref.value = true;
    };
};

//Funcion que verifica que las naves sean diferentes
const notSameRocket = () => {
    let rocket1 = selectedRandomRocket();
    let rocket2 = selectedRandomRocket();

    if(rocket1 !== rocket2){
        console.log("diferentes naves");
        rocketsSelectedRef.value = [ rocket1, rocket2 ];
    }else if(rocket1 === rocket2){
        console.log("Naves iguales");
        notSameRocket();
    }
};

//Funcion que elige una nave aleatoriamente
const selectedRandomRocket = () => {
    let shipsNumber = store_data.length;
    let result;

    if(unlockedShips.value.length >= shipsNumber || unlockedShips.value.length === shipsNumber - 1 ){
        result = store_data[Math.floor(Math.random() * store_data.length)];
    }else{
        let rocketsFiltered = store_data.filter(ship => !unlockedShips.value.includes(ship.id));

        result = rocketsFiltered[Math.floor(Math.random() * rocketsFiltered.length)];

    };

    // redeemCurrency();

    // setTimeout(() => {
    //     nextLevel();
    // }, 5000);

    return result;
};



const rocketSelected = (event) => {
    rocketSelectedCard.value = event;
    rocketSelected2.value = false;
    rocketSelected1.value = false;
    counterActive.value = false;
    rocketSelected1Ref.value = false;
    rocketSelected2Ref.value = false;

    redeemCurrency();

    setTimeout(() => {
        nextLevel();
    }, 4000);
};


onUpdated(() => {
    if(!counterActive.value){
        timerAudioFunction("pause");
    };
});



//Audio
const timer = new Audio(timerAudio);
const timerAudioFunction = (action) => {
    console.log("timer gun", action);

    timer.volume = 0.1;

    if(action === "play"){
        timer.play();
    }else if(action === "pause"){
        timer.pause();
    };
};




setTimeout(() => {
    timerAudioFunction("play");
}, 25000);



//Funcion que resta la moneda de oro al reclamar la nave.
const redeemCurrency = () => {
    let userData = getUsersLocalStorage();

    userData.goldenCoins = userData.goldenCoins - 1;

    saveDataLocalStorage(userData);
};

// //Funcion que traslada al siguiente nivel.
// const nextLevel = () => {
//     let linkActualLevel = localStorage.getItem("currentLocation");

//     let lastCharacter = linkActualLevel.slice(-1);

//     console.log("last character", lastCharacter);

//     let lastCharacterNewLevel = parseInt(lastCharacter) + 1;

//     console.log("last Character new level", lastCharacterNewLevel);

//     let linkNewLevel = linkActualLevel.slice(0, -1) + lastCharacterNewLevel;

//     console.log("Link new level...", linkNewLevel);

//     window.location = linkNewLevel;
// };



</script>

<template>
    <div class="win-rocket-auto__div--background w-full h-full flex justify-center items-center overflow-hidden" :style="{backgroundImage: `url(${backgroundSelected})`}">
        <ShotingStars/>
        <div class="win-rocket-auto__div--cards-container backdrop-blur-sm border-2 border-blue-900 flex-col rounded-md relative md:flex-row md:flex" >
            <div v-if="counterActive" class="w-4 md:w-full h-full md:h-6 absolute flex justify-center items-center md:bottom-0">
                <div class="win-rocket-auto__div--cards-contador bg-white w-2 h-full rounded md:h-3"></div>
            </div>
            <RocketCard v-if="rocketSelected1" @rocketSelected="rocketSelected" :randomShip="rocketsSelectedRef[0]" :shipNum="1" :rocketSelectedRef="rocketSelected1Ref" :type="1" :numberCard="1"/>
            <RocketCard v-if="rocketSelected2" @rocketSelected="rocketSelected" :randomShip="rocketsSelectedRef[1]" :shipNum="2" :rocketSelectedRef="rocketSelected2Ref" :type="1" :numberCard="2"/>
            <RocketSelected v-if="rocketSelectedCard" :rocketSelected="rocketSelectedCard"/>
        </div>
    </div>
</template>

<style scoped>
.win-rocket-auto__div--background {
    background-color: rgba(0, 17, 255, 0.377);
    background-image: url('../../../../../public/images/backgrounds/background-10.png');
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}

.win-rocket-auto__div--cards-container {
    /* background-image: url('../../../../../public/images/backgrounds/background-10.png');
    background-position: center;
    background-size: cover; */
    --glow-color: rgb(132, 0, 255);
    --glow-spread-color: rgba(111, 0, 214, 0.781);
    border: .25em solid var(--glow-color);
    box-shadow: 0 0 1em .25em var(--glow-color),
        0 0 4em 1em var(--glow-spread-color),
        inset 0 0 .75em .25em var(--glow-color);
    animation: containerRocketsAnimation 1s;
}


@keyframes containerRocketsAnimation {
    0% {
        opacity: 0%;
    }

    100% {
        opacity: 100%;
    }
}

.win-rocket-auto__div--cards-contador {
    opacity: 0%;
    animation: contadorAnimation 30s linear, introContadorAnimation 1s;
    animation-fill-mode: forwards, forwards;
    animation-delay: 1.5s, 1.5s;
}

@keyframes contadorAnimation {
    0% {
        height: 100%;
    }

    100% {
        height: 0%;
    }
}

@media (min-width: 768px) {
    .win-rocket-auto__div--cards-contador {
        opacity: 0%;
        animation: contadorAnimation768 30s linear, introContadorAnimation 1s;
        animation-fill-mode: forwards, forwards;
        animation-delay: 1.5s, 1.5s;
    }
}

@keyframes contadorAnimation768 {
    0% {
        width: 100%;
    }

    100% {
        width: 0%;
    }
}

@keyframes introContadorAnimation {
    0% {
        opacity: 0%;
    }

    100% {
        opacity: 100%;
    }
}

@media (min-width: 768px) {
    .win-rocket-auto__div--cards-container {
        width: 950px;
        height: 550px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
}
</style>