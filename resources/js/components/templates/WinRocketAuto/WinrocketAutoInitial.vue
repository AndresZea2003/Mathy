<script setup>
import { ref, onBeforeMount } from "vue";

//Componentes
import RocketCard from "./RocketCard.vue";
import AnimatedStars from "../../background/ShotingStar.vue";

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
import rocketGif from '../../../../../public/images/rockets/Cohetes-13.gif';
import rocketInitialIMG from '../../../../../public/images/rockets/Cohetes-13.svg';


//Ref
const backgroundSelected = ref("");
const rocketSelected1Ref = ref(false);

const rocketSelectedCard = ref(false);//false
const rocketSelected1 = ref(true);//true
const rocketSelected2 = ref(true);//true
const counterActive = ref(true);
const rocketsSelectedRef = ref([]);
const rocketSelected2Ref = ref(false);

const rocketInitialGifRef = ref(true);
const rocketInitialImgRef = ref(false);
const contentRef = ref(false);

//Ref naves aniamcion seleccion
const selectedRocket1 = ref(true);
const selectedRocket2 = ref(true);
const selectedRocket3 = ref(true);
const selectedRocket4 = ref(true);
const selectedRocket5 = ref(true);

//Ref para cambiar la nave
const rocketBackgroundRef = ref(rocketGif);
const rocketBackgroundInitialRef = ref(rocketInitialIMG);

const initialGifClassRef = ref("win-rocket-initial__img--rocket");
const initialImgClassRef =ref("");

//Ref inicial
const contentInitialAnimationFinalRef = ref("");

//Emits
const emit = defineEmits(['rocketSelected']);

//Librerias
import { initialRockets, store_data } from "../../../use/store_data";
import { getUsersLocalStorage } from "../../../use";

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
});


//Timers para el inicio del componente
const initialTimers = () => {
    setTimeout(() => {
        contentRef.value = true;

        setTimeout(() => {
            rocketInitialGifRef.value = false;
            rocketInitialImgRef.value = true;
        }, 1000);
    }, 4000);
};

initialTimers();

const rocketSelected = (event) => {
    console.log(event);

    contentInitialAnimationFinalRef.value = "win-rocket-initial__final-content-animation";

    backgroundRocketSelectionStorage();

    procesingRocketsSelection(event.id);
    
    // redeemCurrency();

    // console.log("Nave reclamada");

    rocketFinalRoad();

    setTimeout(() => {
        emit('rocketSelected', true);
    }, 9000);

};

const redeemCurrency = () => {
    let userData = getUsersLocalStorage();

    userData.goldenCoins = userData.goldenCoins - 1;

    saveDataLocalStorage(userData);
};

//Codigo que desactiva las tarjetas de las naves no seleccionadas
const procesingRocketsSelection = (id) => {
    console.log("Ejecutando el proceso de naves", id);
    if(id === 1){
        console.log("ejecutabdi por la 1");
        selectedRocket1.value = true;
        selectedRocket2.value = false;
        selectedRocket3.value = false;
        selectedRocket4.value = false;
        selectedRocket5.value = false;
    }else if(id === 2){
        console.log("ejecutabdi por la 2");
        selectedRocket1.value = false;
        selectedRocket2.value = true;
        selectedRocket3.value = false;
        selectedRocket4.value = false;
        selectedRocket5.value = false;
    }else if(id === 3){
        console.log("ejecutabdi por la 3");
        selectedRocket1.value = false;
        selectedRocket2.value = false;
        selectedRocket3.value = true;
        selectedRocket4.value = false;
        selectedRocket5.value = false;
    }else if(id === 4){
        console.log("ejecutabdi por la 4");
        selectedRocket1.value = false;
        selectedRocket2.value = false;
        selectedRocket3.value = false;
        selectedRocket4.value = true;
        selectedRocket5.value = false;
    }else if(id === 5){
        console.log("ejecutabdi por la 5");
        selectedRocket1.value = false;
        selectedRocket2.value = false;
        selectedRocket3.value = false;
        selectedRocket4.value = false;
        selectedRocket5.value = true;
    }
};


//Funcion que toma la nave del fondo y la cambia por la nave seleccionada
const backgroundRocketSelectionStorage = () => {
    let rocketSelected = getUsersLocalStorage().shipSelected;

    rocketBackgroundRef.value = store_data[rocketSelected - 1].img;

    rocketBackgroundInitialRef.value = store_data[rocketSelected - 1].img;
};


//Funcion que ejecuta la animacion de la nave yendose
const rocketFinalRoad = () => {
    initialGifClassRef.value = "win-rocket-initial__img--rocket-launch-gif";
    initialImgClassRef.value = "win-rocket-initial__img--rocket-launch";

    setTimeout(() => {
        rocketInitialGifRef.value = true;
    }, 5000);
    setTimeout(() => {
        rocketInitialImgRef.value = false;
    }, 5500);
};

</script>

<template>
    <div class="win-rocket-initial__div--container w-full flex justify-center items-center overflow-hidden" :style="{backgroundImage: `url(${backgroundSelected})`}">
        <AnimatedStars/>
        <div  class="w-full h-full overflow-hidden flex justify-center items-center relative">
            <img v-if="rocketInitialGifRef" :class="`${initialGifClassRef} w-96 absolute overflow-hidden`" :src="rocketBackgroundRef" alt="rocket-initial"/>
            <img v-if="rocketInitialImgRef" :class="`win-rocket-initial__img--rocket-initial ${initialImgClassRef} absolute`" :src="rocketBackgroundInitialRef" alt="rocket-initial"/>
        </div>
        <div v-if="contentRef" :class="`win-rocket-initial__div--content ${contentInitialAnimationFinalRef} absolute w-4/5 rounded-lg backdrop-blur-sm flex justify-center items-center flex-col lg:flex-row py-5 my-5 overflow-hidden`">
            <RocketCard v-if="rocketSelected1" @rocketSelected="rocketSelected" :randomShip="initialRockets[0]" :shipNum="1" :rocketSelectedRef="rocketSelected1Ref" :type="2" :numberCard="1" :selectedRocket="selectedRocket1"/>
            <RocketCard v-if="rocketSelected1" @rocketSelected="rocketSelected" :randomShip="initialRockets[1]" :shipNum="1" :rocketSelectedRef="rocketSelected1Ref" :type="2" :numberCard="2" :selectedRocket="selectedRocket2"/>
            <RocketCard v-if="rocketSelected1" @rocketSelected="rocketSelected" :randomShip="initialRockets[2]" :shipNum="1" :rocketSelectedRef="rocketSelected1Ref" :type="2" :numberCard="3" :selectedRocket="selectedRocket3"/>
            <RocketCard v-if="rocketSelected1" @rocketSelected="rocketSelected" :randomShip="initialRockets[3]" :shipNum="1" :rocketSelectedRef="rocketSelected1Ref" :type="2" :numberCard="4" :selectedRocket="selectedRocket4"/>
            <RocketCard v-if="rocketSelected1" @rocketSelected="rocketSelected" :randomShip="initialRockets[4]" :shipNum="1" :rocketSelectedRef="rocketSelected1Ref" :type="2" :numberCard="5" :selectedRocket="selectedRocket5"/>
        </div>
    </div>
</template>

<style scoped>

.win-rocket-initial__div--container {
    height: 750px;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}

@media screen and (min-height: 600px) {
    .win-rocket-initial__div--container {
        height: 100vh;
    }
}

@media screen and (min-width: 350px) {
    .win-rocket-initial__div--content {
        width: 320px;
    }
}

@media screen and (min-width: 1024px) {
    .win-rocket-initial__div--content {
        width: 80%;
    }
}

.win-rocket-initial__div--content {
    --glow-color: rgb(132, 0, 255);
    --glow-spread-color: rgba(111, 0, 214, 0.781);
    border: .25em solid var(--glow-color);
    box-shadow: 0 0 1em .25em var(--glow-color),
        0 0 4em 1em var(--glow-spread-color),
        inset 0 0 .75em .25em var(--glow-color);
    animation: contentAnimation 4s linear;
    /* animation-fill-mode: forwards; */
}

@media screen and (min-width: 1024px) {
    .win-rocket-initial__div--content {
        animation: contentAnimation1024 4s linear;
    }
}

@keyframes contentAnimation {
    0% {
        width: 0%;
        height: 0px;
    }

    50% {
        width: 0%;
        height: 490px;
    }

    100% {
        width: 320px;
        height: auto;
    }
}

@keyframes contentAnimation1024 {
    0% {
        width: 0%;
        height: 0px;
    }

    50% {
        width: 0%;
        height: 440px;
    }

    100% {
        width: 80%;
        height: auto;
    }
}


.win-rocket-initial__img--rocket {
    animation: rocketInitialAnimation 4.5s linear;
    animation-fill-mode: forwards;
}


@keyframes rocketInitialAnimation {
    0% {
        transform: translateX(-1500px) rotate(90deg);
    }

    90% {
        transform: translateX(0px) rotate(90deg);
    }

    100% {
        transform: translateX(0px) rotate(0deg);
    }
}

.win-rocket-initial__img--rocket-initial {
    transform: rotate(-45deg) translate(90px, -95px);
    width: 260px;
}


.win-rocket-initial__final-content-animation {
    animation: contentFinalAnimation 4.5s linear;
    animation-delay: 1s;
    animation-fill-mode: forwards;
}

@keyframes contentFinalAnimation {
    0% {
        opacity: 100%;
    }

    100% {
        opacity: 0%;
    }
}

.win-rocket-initial__img--rocket-launch {
    animation: rocketFinalIMGAnimation 2s linear;
    animation-fill-mode: forwards;
    animation-delay: 3s;
}

@keyframes rocketFinalIMGAnimation {
    0% {
        transform: rotate(-45deg) translate(90px, -95px);
    }

    100% {
        transform: rotate(45deg) translate(0px, 0px);
    }
}


.win-rocket-initial__img--rocket-launch-gif {
    width: 255px;
    transform: rotate(45deg);
    animation: rocketFinalGIFAnimation 2s linear;
    animation-fill-mode: forwards;
    animation-delay: 2s;
}

/*Codigo para el gif*/
/* @keyframes rocketFinalGIFAnimation {
    0% {
        transform: rotate(90deg) translateY(0px);
    }

    100% {
        transform: rotate(90deg) translateY(-500px);
    }
} */


/*Codigo para imagen momentaneo*/
@keyframes rocketFinalGIFAnimation {
    0% {
        transform: rotate(45deg) translate(0px, 0px);
    }

    100% {
        transform: rotate(45deg) translate(800px, -800px);
    }
}
</style>