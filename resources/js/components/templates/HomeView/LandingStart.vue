<script setup>
import { onMounted, ref } from 'vue';

//Componentes
import SpaceBg from '../../background/SpaceBg.vue';
import buttonStar from '../../ui/ButtonStar.vue';


//Imagenes
import shipGif from '../../../../../public/images/rockets/Cohetes-13.gif';
import planetHome from '../../../../../public/images/home/planet-home.png';

//Ref
const interfaz = ref(false);
const currentGamer = ref('');
const arrayNameRef = ref([]);



setTimeout(() => {
    interfaz.value = true;
}, 2000);

let gamer = localStorage.getItem('gamer');
let games = JSON.parse(localStorage.getItem('games'));

for (let i = 0; i < games.length; i++) {
    if(gamer === games[i].name){
        currentGamer.value = games[i];
    }
};

const gamerArray = () => {
    const gamer = localStorage.getItem('gamer');

    const arrayName = gamer.split("");

    arrayNameRef.value = arrayName;
};

onMounted(() => {
    gamerArray();
    console.log("igor", games.name);
});

</script>

<template>
    <div class="landing-start__div--container w-full h-full flex items-center justify-center overflow-hidden relative">
        <SpaceBg/>
        <div class="w-full h-full flex justify-center items-center">
            <img class="landing-start__img--ship w-56 top-16 absolute" :src="shipGif" alt="ship"/>
            

            <!-- planeta parte baja -->
            <div class="landing-start__div--planet-container flex justify-center items-center">
                <div class="landing-start__div--planet-atmos rounded-full absolute" :style="{backgroundColor: currentGamer.inputColor.background, boxShadow: `0px 0px 187px 12px ${currentGamer.inputColor.background}`}">
                </div>
                <img class="landing-start__div--planet-icons absolute" :src="planetHome" alt="planet"/>
            </div>

            <div v-if="interfaz" class="landing-start__div--interfaz w-80 h-full absolute">
                <div class="text-white font-luckiest-guy text-2xl text-center select-none relative top-10">
                    Salva los <span class="text-red-500">Colores</span> con <br>
                    <span class="text-red-500">Mati</span> y <span class="text-blue-500">Motas</span>
                </div>

                <div class="landing-start__div--experiencias-logico-matematicas bg-amber-200 absolute border-amber-400 border-2 rounded select-none">
                    <span class="font-bangers text-amber-900 text-xl">Experiencias Logico Matematicas</span>
                </div>

                <!-- <div class="landing-start__div--gamer text-white absolute flex justify-center items-center mt-20 top-96 rounded-xl py-1 px-20 border-slate-400 border-2 left-0 right-0 m-auto font-bold text-4xl font-black"  :style="{ backgroundColor: currentGamer.inputColor.background, color: currentGamer.inputColor.text }">
                    <p class="" v-for="letter, index in arrayNameRef" :key="index">{{ letter }}</p>
                </div> -->

                <div class="flex justify-center pt-36 top-60 absolute w-full">
                    <a :href="localHost + '/levels'">
                        <buttonStar id="buttonStar" class="buttonStar"></buttonStar>
                    </a>
                </div>

                <div class="landing-start__div--gamer text-white absolute flex justify-center items-center mt-28 top-96 left-0 right-0 m-auto font-bold text-4xl font-black">
                    <p class="text-center">{{ gamer }}</p>
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
        transform: translateX(-500px) rotate(90deg);
    }

    100% {
        transform: translateX(0px) rotate(90deg);
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


.landing-start__div--experiencias-logico-matematicas {
    animation: gamerAnimation 5s infinite linear;

}

@keyframes gamerAnimation {
    0% {
        transform: rotate(5deg) translate(30px, 50px);
    }

    50% {
        transform: rotate(-5deg) translate(80px, 80px);
    }

    100% {
        transform: rotate(5deg) translate(30px, 50px);
    }
}

.landing-start__div--gamer {
    font-family: 'Julius Sans One', sans-serif;
}

.landing-start__div--planet-container {
    width: 2400px;
    height: 2400px;
    position: absolute;
    top: 210px;
    animation: planetAnimation 20s infinite linear;
}

@keyframes planetAnimation {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(-360deg);
    }
}


.landing-start__div--planet-atmos {
    width: 70%;
    height: 70%;
    background-color: red;
    box-shadow: 0px 0px 187px 12px rgb(255, 0, 0);
}

.landing-start__div--planet-icons {
    width: 81%;
    height: 81%;
}
</style>