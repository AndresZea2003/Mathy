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


onBeforeMount(() => {
    bulletColor.value = randomBullet();
});

</script>

<template>
    <div class="win-coin__div--container w-full h-full flex justify-center items-center relative" :style="{backgroundImage: `url(${randomBackground()})`}">
        <div class="">
            <img class="win-coin__img--ship w-48 relative bottom-40 right-10 z-10" :src="shipStatic" alt="ship"/>
            <div class="win-coin__div--bullet w-14 h-4 rounded-xl relative" :style="{backgroundColor: bulletColor.background ,boxShadow:  `0px 0px 23px 8px ${bulletColor.shadow}`}"></div>
            <img class="win-coin__img--asteroid w-40 relative top-10 left-14" :src="asteroid" alt="asteroid"/>
        </div>
    </div>
</template>

<style scoped>
.win-coin__img--ship {
    transform: rotate(120deg);
    animation: shipAnimation 5s linear infinite;
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

@keyframes bulletAnimation  {
    0%{
        transform: translate(0px, 0px) rotate(74deg);
    }

    100%{
        transform: translate(95px, 380px) rotate(74deg);
    }
}

</style>