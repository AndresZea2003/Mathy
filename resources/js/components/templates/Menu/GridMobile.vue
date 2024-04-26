<script setup>
import { ref } from "vue";

//Componentes
import LogicoMatematicos from "./LogicoMatematicos.vue";
import BackTo from "./BackTo.vue";
import AnimatedElection from './AnimatedElection.vue';

//importacion de sonidos
import clickMenuSound from '../../../../../public/audios/effects/audioClickStandard.mp3';


//Props
const props = defineProps({
    arrayAccess: Array,
    currentShip: Number,
    unlockedLevelsStorage: String
});


//Ref que controla la cuando se da click a un nivel.
const levelSelectedClick = ref(false);
const levelSelectedAnimation = ref("");

//Funcion que se ejcuta al elegir el nivel.
const levelSelected = (link, level) => {


    levelSelectedClick.value = true;
    levelSelectedAnimation.value = level;

    clickMenuSoundFunction();

    setTimeout(() => {
        //Logica de acceso al nivel usando el parametro link de la funcion
        levelSelectedClick.value = false;
    }, 5000);

    setTimeout(() => {
        window.location = link;
    }, 4800);
};

//Traemos del store los niveles desbloqueados
let unlockedLevels = localStorage.getItem(props.unlockedLevelsStorage);

//Funcion que devuelve si ese nivel esta desbloqueado o bloqueado
const levelUnlockedProcess = (level) => {
    let result;
    result = !unlockedLevels.includes(level);
    return result
};


//Funcion que controla el fondo de cada tarjeta
const levelUnlockedProcessBorderAndOpacity = (level) => {
    let result;

    let isLevelLocked = !unlockedLevels.includes(level);

    if(!isLevelLocked) {
        result = `background: ${props.arrayAccess[level - 1].style}; opacity: 100%`
    }else if(isLevelLocked){
        result = `background: linear-gradient(45deg,#000000, #000000, #313131,  #2f2f2f, #ffffff, #333333, #2f2f2f, #000000, #000000); opacity: 50%`
    };

    return result
};

//Funcion para sonido al dar click sobre la tarjeta
const clickMenuSoundFunction = () => {
    const audio = new Audio(clickMenuSound);

    audio.play();
};


</script>

<template>
    <div>
        <AnimatedElection :currentShip="props.currentShip" :levelSelected="levelSelectedAnimation" v-if="levelSelectedClick"/>
        <!-- componente de boton de regresar -->
        <div class="absolute z-40 top-8 left-2">
            <BackTo/>
        </div>
        <!-- componente logo de experiencias logico matematicas -->
        <div class="relative top-10">
            <LogicoMatematicos/>
        </div>
        <!-- grid de botones para cada nivel -->
        <div class="relative w-full h-96 top-20 overflow-auto">
            <button  v-for="access, index in props.arrayAccess" @click="levelSelected(access.location, `NIVEL ${index + 1}`)" class="grid-mobile__button  w-11/12 h-28 flex justify-center items-center"  :key="access.level" :style="levelUnlockedProcessBorderAndOpacity(index + 1)" :disabled="levelUnlockedProcess(index + 1)">
                <div class="grid-mobile__div--img bg-center bg-cover flex justify-center items-center" :style="`background-image: url(${access.img})`">
                    <p class="grid-mobile__p--nivel text-slate-200 text-3xl">NIVEL {{access.level}}</p>
                </div>
            </button>
        </div>
    </div>
</template>

<style scoped>

/* Estilo basico para el borde del boton */
.grid-mobile__button {
    margin: 15px auto;
    border-radius: 20px;
    background-size: 800% 800% !important;
    animation: gradientAnimation 10s infinite;
}


@keyframes gradientAnimation {
    0% {
        background-position: 0% 0%;
    }
    50% {
        background-position: 100% 100%;
    }
    100% {
        background-position: 0% 0%;
    }
}

.grid-mobile__div--img {
    width: 95%;
    height: 90%;
    border-radius: 20px;
}

.grid-mobile__p--nivel {
    font-family: 'ZCOOL KuaiLe', sans-serif;
    text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px  1px 0 #000, 1px  1px 0 #000;
}
</style>