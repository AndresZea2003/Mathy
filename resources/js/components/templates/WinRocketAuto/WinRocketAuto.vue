
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

//Componentes
import RocketCard from "./RocketCard.vue";
import RocketSelected from "./RocketSelected.vue";

//Librerias
import { store_data } from "../../../use/store_data";
import { getUsersLocalStorage, saveDataLocalStorage } from "../../../use";

const rocketSelectedCard = ref(false);//false
const rocketSelected1 = ref(true);//true
const rocketSelected2 = ref(true);//true
const counterActive = ref(true);
const backgroundSelected = ref("");
const unlockedShips = ref([]);
const rocketsSelectedRef = ref([]);



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
    rocketsSelectedRef.value = [selectedRandomRocket(), selectedRandomRocket()];
});

//Funcion que elige una nave aleatoriamente
const selectedRandomRocket = () => {
    let shipsNumber = store_data.length;
    let result;

    if(unlockedShips.value.length === shipsNumber){
        result = store_data[Math.floor(Math.random() * store_data.length)];
    }else{
        let rocketsFiltered = store_data.filter(ship => !unlockedShips.value.includes(ship.id));

        result = rocketsFiltered[Math.floor(Math.random() * rocketsFiltered.length)];

    };

    console.log("Nave elegida", result);
    return result;
};

const rocketSelected = (event) => {
    rocketSelectedCard.value = event;
    rocketSelected2.value = false;
    rocketSelected1.value = false;
    counterActive.value = false;
};


</script>

<template>
    <div class="win-rocket-auto__div--background w-full h-full flex justify-center items-center overflow-hidden">
        <div class="win-rocket-auto__div--cards-container flex-col rounded-md relative md:flex-row md:flex" :style="{backgroundImage: `url(${backgroundSelected})`}">
            <div v-if="counterActive" class="w-4 md:w-full h-full md:h-6 absolute flex justify-center items-center md:bottom-0">
                <div class="win-rocket-auto__div--cards-contador bg-white w-2 h-full rounded md:h-3"></div>
            </div>
            <RocketCard v-if="rocketSelected1" @rocketSelected="rocketSelected" :randomShip="rocketsSelectedRef[0]" :shipNum="1"/>
            <RocketCard v-if="rocketSelected2" @rocketSelected="rocketSelected" :randomShip="rocketsSelectedRef[1]" :shipNum="2"/>
            <RocketSelected v-if="rocketSelectedCard" :rocketSelected="rocketSelectedCard"/>
        </div>
    </div>
</template>

<style scoped>
.win-rocket-auto__div--background {
    background-color: rgba(0, 17, 255, 0.377);
}

.win-rocket-auto__div--cards-container {
    background-image: url('../../../../../public/images/backgrounds/background-10.png');
    background-position: center;
    background-size: cover;
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