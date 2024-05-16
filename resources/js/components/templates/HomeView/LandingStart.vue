<script setup>
import { ref } from 'vue';

//Componentes
import SpaceBg from '../../background/SpaceBg.vue';
import buttonStar from '../../ui/ButtonStar.vue';


//Imagenes
import shipGif from '../../../../../public/images/rockets/Cohetes-13.gif';

//Ref
const interfaz = ref(false);
const currentGamer = ref('');


setTimeout(() => {
    interfaz.value = true;
}, 2000);


const gamer = localStorage.getItem('gamer');
let games = JSON.parse(localStorage.getItem('games'));

for (let i = 0; i < games.length; i++) {
    if(gamer === games[i].name){
        currentGamer.value = games[i];
    }
};


</script>

<template>
    <div class="landing-start__div--container w-full h-full flex items-center justify-center overflow-hidden relative">
        <SpaceBg/>
        <div class="w-full h-full flex justify-center items-center">
            <img class="landing-start__img--ship w-60" :src="shipGif" alt="ship"/>

            <div v-if="interfaz" class="landing-start__div--interfaz w-80 h-full absolute">
                <div class="text-white font-luckiest-guy text-2xl text-center select-none relative top-10">
                    Salva los <span class="text-red-500">Colores</span> con <br>
                    <span class="text-red-500">Mati</span> y <span class="text-blue-500">Motas</span>
                </div>

                <div class="bg-amber-200 absolute  border-amber-400 border-2 rounded select-none"
                    style="transform: rotate(-18deg) translateX(-40px) translateY(70px)">
                    <span class="font-bangers text-amber-900 text-sm">Experiencias Logico Matematicas</span>
                </div>

                <div class="landing-start__div--gamer text-white absolute flex justify-center items-center mt-20 top-96 rounded-xl py-1 px-20 border-slate-400 border-2 left-0 right-0 m-auto font-bold text-lg"  :style="{ backgroundColor: currentGamer.inputColor.background, color: currentGamer.inputColor.text }">
                    <p>{{ gamer }}</p>
                </div>

                <div class="flex justify-center pt-36 top-96 absolute w-full">
                    <a :href="localHost + '/levels'">
                        <buttonStar id="buttonStar" class="buttonStar"></buttonStar>
                    </a>
                </div>

            </div>
        </div>
    </div>
</template>

<style scoped>
.landing-start__img--ship {
    animation: shipAnimation 2s linear;
    animation-fill-mode: forwards;
}

@keyframes shipAnimation {
    0% {
        transform: translateY(500px);
    }

    100% {
        transform: translateY(0px);
    }
}

.landing-start__div--interfaz {
    animation: interfazAnimation 2s linear;
    animation-fill-mode: forwards;
}


@keyframes interfazAnimation {
    0% {
        opacity: 0%;
    }

    100% {
        opacity: 100%;
    }
}


.landing-start__div--gamer {
    font-family: 'Julius Sans One', sans-serif;
    animation: gamerAnimation 5s infinite linear;
}

@keyframes gamerAnimation {
    0% {
        transform: rotate(5deg);
    }

    50% {
        transform: rotate(-5deg);
    }

    100% {
        transform: rotate(5deg);
    }
}
</style>