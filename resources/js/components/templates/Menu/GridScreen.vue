<script setup>
import { ref } from 'vue';
//Importacion componentes
import LogicoMatematicos from './LogicoMatematicos.vue';
import BackTo from '../Menu/BackTo.vue';
import AnimatedElection from './AnimatedElection.vue';

//Importacion sonidos
import hoverMenuSound from '../../../../../public/audios/effects/audio-hover-standard.mp3';
import clickMenuSound from '../../../../../public/audios/effects/audio-click-standard.mp3';


//Props
const props = defineProps({
    arrayAccess: Array,
    currentShip: Number,
    unlockedLevelsStorage: String
});

// //Importacion de audios
// import hoverSound from '../../audio/menu/hover-audio-menu.mp3';

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
};


//Traemos del store los niveles desbloqueados
let unlockedLevels = localStorage.getItem(props.unlockedLevelsStorage);


// //Funcion que ejecuta el audio del hover.
// const hoverSoundPlay = () => {
//     console.log("Ejecutando sonido");
//     const audio = new Audio(hoverSound);
//     audio.play();
// };


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
}

//Funcion para ejecutar el sonido del hover de cada tarjeta
const hoverMenuSoundFunction = () => {
    const audio = new Audio(hoverMenuSound);

    audio.volume = 0.5;

    audio.play();
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
        <div class="absolute top-8 left-8 hover:scale-125 transition">
            <BackTo/>
        </div>
        <div class="w-full flex justify-center items-center relative top-24">
            <div class="grid-screen__div--grid">
                <div class="div1">
                    <button @mouseenter="hoverMenuSoundFunction()" @mouseover="hoverSoundPlay" @click="levelSelected(props.arrayAccess[0].location, 'NIVEL 1')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(1)" :disabled="levelUnlockedProcess(1)">
                        <div :style="`background-image: url(${props.arrayAccess[0].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 1</p>
                        </div>
                    </button>
                </div>
                <div class="div2">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[1].location, 'NIVEL 2')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(2)" :disabled="levelUnlockedProcess(2)">
                        <div :style="`background-image: url(${props.arrayAccess[1].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 2</p>
                        </div>
                    </button>
                </div>
                <div class="div3">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[2].location, 'NIVEL 3')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(3)" :disabled="levelUnlockedProcess(3)">
                        <div :style="`background-image: url(${props.arrayAccess[2].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 3</p>
                        </div>
                    </button>
                </div>
                <div class="div4">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[3].location, 'NIVEL 4')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(4)" :disabled="levelUnlockedProcess(4)">
                        <div :style="`background-image: url(${props.arrayAccess[3].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 4</p>
                        </div>
                    </button>
                </div>
                <div class="div5">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[4].location, 'NIVEL 5')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(5)" :disabled="levelUnlockedProcess(5)">
                        <div :style="`background-image: url(${props.arrayAccess[4].img})`" >
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 5</p>
                        </div>
                    </button>
                </div>
                <div class="div6">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[5].location, 'NIVEL 6')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(6)" :disabled="levelUnlockedProcess(6)">
                        <div :style="`background-image: url(${props.arrayAccess[5].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 6</p>
                        </div>
                    </button>
                </div>
                <div class="div7">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[6].location, 'NIVEL 7')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(7)" :disabled="levelUnlockedProcess(7)">
                        <div :style="`background-image: url(${props.arrayAccess[6].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 7</p>
                        </div>
                    </button>
                </div>
                <div>
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[9].location, 'NIVEL 10')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(10)" :disabled="levelUnlockedProcess(8)">
                        <div :style="`background-image: url(${props.arrayAccess[9].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 10</p>
                        </div>
                    </button>
                </div>
                <div class="div9">
                    <div class="div8">
                        <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[7].location, 'NIVEL 8')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(8)" :disabled="levelUnlockedProcess(8)">
                            <div :style="`background-image: url(${props.arrayAccess[7].img})`">
                                <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 8</p>
                            </div>
                        </button>
                    </div>
                    <div class="px-5">
                        <LogicoMatematicos/>
                    </div>
                    <div>
                        <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[8].location, 'NIVEL 9')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(9)" :disabled="levelUnlockedProcess(9)">
                            <div :style="`background-image: url(${props.arrayAccess[8].img})`">
                                <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 9</p>
                            </div>
                        </button>
                    </div>
                </div>
                <div class="div10">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[10].location, 'NIVEL 11')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(11)" :disabled="levelUnlockedProcess(11)">
                        <div :style="`background-image: url(${props.arrayAccess[10].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 11</p>
                        </div>
                    </button>
                </div>
                <div class="div11">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[11].location, 'NIVEL 12')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(12)" :disabled="levelUnlockedProcess(12)">
                        <div :style="`background-image: url(${props.arrayAccess[11].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 12</p>
                        </div>
                    </button>
                </div>
                <div class="div12">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[12].location, 'NIVEL 13')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(13)" :disabled="levelUnlockedProcess(13)">
                        <div :style="`background-image: url(${props.arrayAccess[12].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 13</p>
                        </div>
                    </button>
                </div>
                <div class="div13">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[13].location, 'NIVEL 14')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(14)" :disabled="levelUnlockedProcess(14)">
                        <div :style="`background-image: url(${props.arrayAccess[13].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 14</p>
                        </div>
                    </button>
                </div>
                <div class="div14">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[14].location, 'NIVEL 15')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(15)" :disabled="levelUnlockedProcess(15)">
                        <div :style="`background-image: url(${props.arrayAccess[14].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 15</p>
                        </div>
                    </button>
                </div>
                <div class="div15">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[15].location, 'NIVEL 16')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(16)" :disabled="levelUnlockedProcess(16)">
                        <div :style="`background-image: url(${props.arrayAccess[15].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 16</p>
                        </div>
                    </button>
                </div>
                <div class="div16">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[16].location, 'NIVEL 17')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(17)" :disabled="levelUnlockedProcess(17)">
                        <div :style="`background-image: url(${props.arrayAccess[16].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 17</p>
                        </div>
                    </button>
                </div>
                <div class="div17">
                    <button @mouseenter="hoverMenuSoundFunction()" @click="levelSelected(props.arrayAccess[17].location, 'NIVEL 18')" class="grid-screen__button" :style="levelUnlockedProcessBorderAndOpacity(18)" :disabled="levelUnlockedProcess(18)">
                        <div :style="`background-image: url(${props.arrayAccess[17].img})`">
                            <p class="grid-screen__p--nivel text-slate-200 text-2xl">NIVEL 18</p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.grid-screen__div--grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    grid-template-rows: repeat(4, 1fr);
    grid-column-gap: 5px;
    grid-row-gap: 15px;
}

.div1 { grid-area: 1 / 1 / 2 / 2; }
.div2 { grid-area: 1 / 2 / 2 / 3; }
.div3 { grid-area: 1 / 3 / 2 / 4; }
.div4 { grid-area: 1 / 4 / 2 / 5; }
.div5 { grid-area: 1 / 5 / 2 / 6; }
.div6 { grid-area: 1 / 6 / 2 / 7; }
.div7 { grid-area: 2 / 1 / 3 / 2; }
.div8 { grid-area: 2 / 6 / 3 / 7; }
.div9 {
    grid-area: 2 / 2 / 4 / 6;
    display: flex;
    justify-content: center;
    align-items: center;
}
.div10 { grid-area: 3 / 1 / 4 / 2; }
.div11 { grid-area: 3 / 6 / 4 / 7; }
.div12 { grid-area: 4 / 1 / 5 / 2; }
.div13 { grid-area: 4 / 2 / 5 / 3; }
.div14 { grid-area: 4 / 3 / 5 / 4; }
.div15 { grid-area: 4 / 4 / 5 / 5; }
.div16 { grid-area: 4 / 5 / 5 / 6; }
.div17 { grid-area: 4 / 6 / 5 / 7; }

.grid-screen__button {
    width: 190px;
    height: 80px;
    background-color: blue;
    border-radius: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: ease-in-out 0.2s;
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

.grid-screen__button div {
    width: 95%;
    height: 90%;
    border-radius: 15px;
    background-position: center;
    background-size: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.grid-screen__button:hover {
    transform: scale(0.9);
}

.grid-screen__p--nivel {
    font-family: 'ZCOOL KuaiLe', sans-serif;
    text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px  1px 0 #000, 1px  1px 0 #000;
}

.grid-screen__button:hover .grid-screen__p--nivel {
    color: rgb(205, 232, 0);
}

@media screen and (min-width: 1000px){
    .grid-screen__button {
        width: 140px;
        height: 70px;
    }
}

@media screen and (min-width: 1200px){
    .grid-screen__button {
        width: 190px;
        height: 90px;
    }
}


@media screen and (min-width: 1300px){
    .grid-screen__button {
        width: 220px;
        height: 110px;
    }
}
</style>