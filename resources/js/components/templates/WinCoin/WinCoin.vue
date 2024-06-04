<script setup>
import { onBeforeMount, ref } from 'vue';


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

import shipStatic from '../../../../../public/images/rockets/Cohetes-13.svg';
import asteroid from '../../../../../public/images/win-coin/asteroid.png';

import bronzeCoin from '../../../../../public/images/globals/bronze-coin.png';
import silverCoin from '../../../../../public/images/globals/silver-coin.png';
import { getUsersLocalStorage, saveDataLocalStorage } from '../../../use';


const arrayBackgrounds = [
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
    background14,
];

const bulletColors = [
    {
        background: "rgb(255, 0, 0)",
        shadow: "rgba(255, 0, 0, 0.75)"
    },
    {
        background: "rgb(17, 0, 255)",
        shadow: "rgba(0, 4, 255, 0.75)"
    },
    {
        background: "rgb(251, 255, 0)",
        shadow: "rgba(229, 255, 0, 0.75)"
    },
    {
        background: "rgb(51, 255, 0)",
        shadow: "rgba(30, 255, 0, 0.75)"
    },
    {
        background: "rgb(0, 255, 242)",
        shadow: "rgba(0, 255, 213, 0.75)"
    },
    {
        background: "rgb(255, 0, 255)",
        shadow: "rgba(255, 0, 234, 0.75)"
    },
    {
        background: "rgb(255, 0, 255)",
        shadow: "rgba(255, 0, 234, 0.75)"
    },
    {
        background: "rgb(132, 0, 255)",
        shadow: "rgba(174, 0, 255, 0.75)"
    },
];

//Ref
const bulletColor = ref("");
const backgroundImage = ref("");
const bulletImpactRef = ref(true);
const asteroidRef = ref(true);
const explosionRef = ref(false);
const coinRef = ref(false);
const coinImg = ref("");
const actualCoinRef = ref("");
const actualCoinTempRef = ref(false);
const newCoinRef = ref(false);

//Props
const props = defineProps({
    type_coin: String
});



//Funcion basica para sacar un numero random
const randomNum = (array) => {
    return Math.floor(Math.random() * array.length);
};

//fondo aleatorio
const randomBackground = () => {
    let randomNumReturn = randomNum(arrayBackgrounds);
    return arrayBackgrounds[randomNumReturn];
};

//Color de disparo aleatorio
const randomBullet = () => {
    let randomNumReturn = randomNum(bulletColors);
    return bulletColors[randomNumReturn];
};

//Funcion que aumenta la moneda que se reclamo en ese nivel
const rewardCoin = () => {
    let actualDataUser = getUsersLocalStorage();
    if(props.type_coin === "bronze"){
        actualDataUser.bronzeCoins = actualDataUser.bronzeCoins + 1;

        saveDataLocalStorage(actualDataUser);
    }else if(props.type_coin === "silver"){
        actualDataUser.silverCoins = actualDataUser.silverCoins + 1;

        saveDataLocalStorage(actualDataUser);
    };
};

onBeforeMount(() => {
    bulletColor.value = randomBullet();
    backgroundImage.value = randomBackground();


    if(props.type_coin === "silver"){
        coinImg.value = silverCoin;
        actualCoinRef.value = getUsersLocalStorage().silverCoins;

    }else if(props.type_coin === "bronze"){
        coinImg.value = bronzeCoin;
        actualCoinRef.value = getUsersLocalStorage().bronzeCoins;
    };
});

setTimeout(() => {
    bulletImpactRef.value = false;
    explosionRef.value = true;

    setTimeout(() => {
        asteroidRef.value = false;
        coinRef.value = true;

        setTimeout(() => {
            actualCoinTempRef.value = true;
            rewardCoin();
            setTimeout(() => {
                newCoinRef.value = true;
            }, 2000);
        }, 3000);
    }, 1500);
}, 5900);

</script>

<template>
    <div class="win-coin__div--container w-full h-full flex justify-center items-center relative bg-no-repeat bg-cover" :style="{backgroundImage: `url(${backgroundImage})`}">
        <div class="relative">
            <img class="win-coin__img--ship w-48 xl:w-60 relative bottom-40 right-10 xl:right-96 z-10" :src="shipStatic" alt="ship"/>
            <div v-if="bulletImpactRef" class="win-coin__div--bullet w-14 h-4 rounded-xl relative " :style="{backgroundColor: bulletColor.background ,boxShadow:  `0px 0px 23px 8px ${bulletColor.shadow}`}"></div>
            <img v-if="asteroidRef" class="win-coin__img--asteroid w-40 absolute left-14 xl:top-36 xl:left-96" :src="asteroid" alt="asteroid"/>
            <div v-if="bulletImpactRef" class="win-coin__div--impact absolute bottom-5  w-10 h-10 left-28 xl:left-96 rounded-full"></div>
            <div v-if="explosionRef" class="win-coin__div--explosion absolute w-10 h-10 left-28 rounded-full z-20"></div>
            <img v-if="coinRef" class="win-coin__div--coin absolute left-20" :src="coinImg" alt="coin"/>
            <div v-if="actualCoinTempRef" class="win-coin__div--actual-coins w-full grid grid-cols-5 absolute m-auto left-0 right-0 rounded bg-blue-950 border-2 border-cyan-400 rounded-xl overflow-hidden">
                <img v-for="coin, index in actualCoinRef" :key="index" class="win-coin__img--coin-actual" :src="coinImg" alt="coin"/>
                <img v-if="newCoinRef" class="win-coin__img--new-coin" :src="coinImg" alt="coin"/>
            </div>
        </div>
    </div>
</template>

<style scoped>
.win-coin__img--ship {
    /* transform: rotate(120deg); */
    animation: shipAnimation 5s linear infinite;
}


@media screen and (min-width: 1300px) {
    .win-coin__img--ship {
        /* transform: rotate(0deg); */
        /* background-color: red; */
        animation: shipXLAnimation 5s linear infinite;
    }
}


@keyframes shipAnimation  {
    0%{
        transform: translate(3px,  0px) rotate(120deg);
    }

    50%{
        transform: translate(0px,  0px) rotate(120deg);
    }

    100%{
        transform: translate(3px,  0px) rotate(120deg);
    }
}

@keyframes shipXLAnimation  {
    0%{
        transform: translate(3px,  0px) rotate(70deg);
    }

    50%{
        transform: translate(0px,  0px) rotate(70deg);
    }

    100%{
        transform: translate(3px,  0px) rotate(70deg);
    }
}



.win-coin__img--asteroid {
    animation: asteroidAnimation 15s linear infinite;
}

@keyframes asteroidAnimation  {
    0%{
        transform: rotate(0deg);
    }

    100%{
        transform: rotate(360deg);
    }
}

.win-coin__div--bullet {
    transform: rotate(74deg);
    top: -250px;
    left: 33px;
    animation: bulletAnimation 2s linear infinite;
    background-color: rgb(132, 0, 255);
    box-shadow: 0px 0px 23px 8px rgba(174, 0, 255, 0.75);
}

@media screen and (min-width: 1300px) {
    .win-coin__div--bullet {
        transform: rotate(74deg);
        top: -250px;
        left: 33px;
        animation: bulletXLAnimation 2s linear infinite;
    }
}


@keyframes bulletAnimation  {
    0%{
        transform: translate(0px, 0px) rotate(74deg);
    }

    100%{
        transform: translate(95px, 340px) rotate(74deg);
    }
}


@keyframes bulletXLAnimation  {
    0%{
        transform: translate(-250px, 0px) rotate(22deg);
    }

    100%{
        transform: translate(375px, 210px) rotate(22deg);
    }
}

.win-coin__div--impact {
    bottom: -80px;
    box-shadow: 0px 0px 48px 11px rgba(255, 255, 255, 0.13);
    animation: impactAnimation 2s linear infinite;
}

@media screen and (min-width: 1300px) {
    .win-coin__div--impact {
        bottom: 5px;
        left: 440px;
        animation: impactAnimation 2.08s linear infinite;
    }
}


@keyframes impactAnimation  {
    0%{
        transform: scale(0);
        opacity: 0%;
    }

    85%{
        transform: scale(0);
        opacity: 100%;
    }

    90%{
        transform: scale(4);
        opacity: 100%;
    }

    100%{
        transform: scale(7);
        opacity: 0%;
    }
}

.win-coin__div--explosion {
    bottom: -100px;
    box-shadow: 0px 0px 60px 35px rgba(255, 255, 255, 0.75);
    background-color: white;
    animation: explosionAnimation 3s linear;
    animation-fill-mode: forwards;
}

@media screen and (min-width: 1300px) {
    .win-coin__div--explosion {
        bottom: 10px;
        left: 440px;
        animation: explosionAnimation 3s linear;
        animation-fill-mode: forwards;
    }
}


@keyframes explosionAnimation  {
    0%{
        transform: scale(0);
        opacity: 100%;
    }

    50%{
        transform: scale(5);
        opacity: 100%;
    }

    100%{
        transform: scale(5);
        opacity: 0%;
    }
}

.win-coin__div--coin  {
    bottom: -130px;
    animation: winCoinAnimation 5s linear;
    animation-fill-mode: forwards;
}

@media screen and (min-width: 1300px) {
    .win-coin__div--coin  {
        bottom: -130px;
        animation: winCoinXLAnimation 5s linear;
        animation-fill-mode: forwards;
    }
}



@keyframes winCoinXLAnimation  {
    0%{
        transform: translate(330px, -120px) rotate(0deg);
        opacity: 100%;
    }

    10%{
        transform: translate(330px, -120px) rotate(0deg);
        opacity: 100%;
    }

    50%{
        transform: translate(330px, -270px) rotate(0deg);
        opacity: 100%;
    }

    80%{
        transform: translate(0px, -270px) rotate(0deg);
        opacity: 100%;
    }

    84%{
        transform: translate(0px, -270px) rotate(360deg);
        opacity: 100%;
    }

    88%{
        transform: translate(0px, -270px) rotate(360deg);
        opacity: 100%;
    }

    100%{
        transform: translate(-20px, 45px) rotate(360deg);
        opacity: 0%;
    }
}

.win-coin__div--actual-coins  {
    bottom: -150px;
    animation: actualCoinsAnimation 1s linear;
}

@keyframes actualCoinsAnimation  {
    0%{
        opacity: 0%;
    }

    100%{
        opacity: 100%;
    }
}

.win-coin__img--new-coin {
    animation: newCoinAnimation 4s linear;
    animation-fill-mode: forwards;
}

@keyframes newCoinAnimation {
    0%{
        opacity: 0%;
        transform: scale(0);
    }

    20%{
        opacity: 100%;
        transform: scale(1) rotate(0);
    }

    50%{
        opacity: 100%;
        transform: scale(1) rotate(360deg);
    }

    100%{
        opacity: 100%;
        transform: scale(1) rotate(360deg);
    }
}
</style>