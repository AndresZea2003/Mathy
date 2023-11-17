<script setup>

import {ref} from "vue";

const props = defineProps({
    asset_images: {type: String, required: true},
    asset_audio: {type: String, required: true},
    levels_route: {type: String, required: true}
})

let soundtrack = ref(true)

let soundButton = ref(false)

let playGame = ref(false)

let figure1 = ref(false)
let figure2 = ref(false)

let principalSound = new Audio();
principalSound.src = `${props.asset_audio}/soundtracks/space-game.mp3`;
principalSound.loop = true;
principalSound.volume = 0.7
principalSound.play();

const pauseAudio = () => {
    soundtrack.value = false
    principalSound.pause();
}

const playAudio = () => {
    soundtrack.value = true
    principalSound.play();
}

const buttonSound = () => {
    if (soundButton.value === false) {
        let sound = new Audio();
        sound.src = `${props.asset_audio}/jumpCoin.wav`;
        sound.play()
    }

    soundButton.value = true

    setTimeout(function () {
        soundButton.value = false
    }, 1000)

}

const bottonLigth = () => {
    document.getElementById('principalButton').classList.add('bg-white')
    setTimeout(function () {
        document.getElementById('principalButton').classList.remove("bg-white");
    }, 300);
}

const play = () => {
    let sound = new Audio();
    sound.src = `${props.asset_audio}/space-shot.wav`;
    sound.play()

    setTimeout(function () {
        playGame.value = true
    }, 800);

    let homeUp = document.getElementById("homeUp");
    let homeDown = document.getElementById("homeDown");

    homeUp.style.transform = "translateY(-1000%)";
    homeDown.style.transform = "translateY(1000%)";
    principalSound.volume = 0.2

    setTimeout(function () {
        // rocketUp()
        document.getElementById('planet1').classList.replace('hidden', 'planetUp')
        introductionText()
    }, 1000);

}

setInterval(bottonLigth, 5000)

const rocketUp = () => {
    let rocket = document.getElementById("rocket");
    rocket.classList.add("rocket-up");
    rocket.classList.remove("top-[1500px]")
    setTimeout(function () {
        document.getElementById("rocket-humo").classList.replace('opacity-0', 'opacity-100');
        rocket.classList.replace("rocket-up", "rocket-down")
        rocket.classList.add("top-[500px]")
        setTimeout(function () {
            document.getElementById("rocket-humo").classList.replace('opacity-100', 'opacity-0');
        }, 5000);
    }, 3000);

}

const introductionText = () => {

    setTimeout(function () {
        document.getElementById('principalText').innerText = "Hola Viajeros!"
    }, 1000);
    setTimeout(function () {
        document.getElementById('principalText').innerText = "Bienvenidos a una nueva aventura!"
    }, 3000);
    setTimeout(function () {
        document.getElementById('principalText').innerText = "por el universo mágico de las "
    }, 6000);
    setTimeout(function () {
        document.getElementById('principalText').innerText = " "
        figure1.value = true
    }, 9000);
    setTimeout(function () {
        document.getElementById('principalText').innerText = ""
        figure1.value = false
        figure2.value = true
    }, 12000);
    setTimeout(function () {
        figure2.value = false
        document.getElementById('secondText').innerText = "A"
        setTimeout(function () {
            document.getElementById('secondText').innerText = "AB"
            setTimeout(function () {
                document.getElementById('secondText').innerText = "ABC"
            }, 500);
        }, 500);
    }, 15000);
    setTimeout(function () {
        document.getElementById('secondText').innerText = "1"
        setTimeout(function () {
            document.getElementById('secondText').innerText = "12"
            setTimeout(function () {
                document.getElementById('secondText').innerText = "123"
            }, 500);
        }, 500);
    }, 18000);
    setTimeout(function () {
        document.getElementById('secondText').innerText = ""
        document.getElementById('principalText').innerText = "El viaje interplanetario comienza en la tierra y el primer destino es el planeta Marte"
        document.getElementById('planet1').classList.add('scale-110')
    }, 21000);
    setTimeout(function () {
        document.getElementById('planet1').classList.remove('scale-110')
        document.getElementById('principalText').innerText = "Súbete a tú nave e inicia este feliz viaje resolviendo el primer reto"
        setTimeout(function () {
            document.getElementById('principalText').classList.add('planetDown')
            document.getElementById('planet1').classList.replace('planetUp', 'planetDown')
            rocketUp()
            setTimeout(function () {
                document.getElementById("rocket").classList.remove('scale-50')
            }, 2000)
            setTimeout(function () {
                let sound = new Audio();
                sound.src = `${props.asset_audio}/space-shot.wav`;
                sound.play()
            }, 9000)
            setTimeout(function () {
                window.location.replace(props.levels_route);
            }, 10000)


        })
    }, 24000);
}


</script>
<template>
    <div class="text-white fixed z-50 left-0 bottom-0 p-5">
        <svg v-if="soundtrack" @click="pauseAudio" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
             fill="white" viewBox="0 0 24 24">
            <path
                d="M6 7l8-5v20l-8-5v-10zm-6 10h4v-10h-4v10zm20.264-13.264l-1.497 1.497c1.847 1.783 2.983 4.157 2.983 6.767 0 2.61-1.135 4.984-2.983 6.766l1.498 1.498c2.305-2.153 3.735-5.055 3.735-8.264s-1.43-6.11-3.736-8.264zm-.489 8.264c0-2.084-.915-3.967-2.384-5.391l-1.503 1.503c1.011 1.049 1.637 2.401 1.637 3.888 0 1.488-.623 2.841-1.634 3.891l1.503 1.503c1.468-1.424 2.381-3.309 2.381-5.394z"/>
        </svg>

        <svg v-if="!soundtrack" @click="playAudio" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
             fill="white" viewBox="0 0 24 24">
            <path
                d="M19 7.358v15.642l-8-5v-.785l8-9.857zm3-6.094l-1.548-1.264-3.446 4.247-6.006 3.753v3.646l-2 2.464v-6.11h-4v10h.843l-3.843 4.736 1.548 1.264 18.452-22.736z"/>
        </svg>
    </div>
    <div class="h-full flex justify-center items-center ">
        <div id="loader"
             class="fixed top-0 left-0 w-full h-full bg-black transition-opacity duration-500">
            <div class="flex items-center justify-center h-full">

                <div class="h-box-of-star1">
                    <div class="h-star h-star-position1"></div>
                    <div class="h-star h-star-position2"></div>
                    <div class="h-star h-star-position3"></div>
                    <div class="h-star h-star-position4"></div>
                    <div class="h-star h-star-position5"></div>
                    <div class="h-star h-star-position6"></div>
                    <div class="h-star h-star-position7"></div>
                </div>
                <div class="h-box-of-star2">
                    <div class="h-star h-star-position1"></div>
                    <div class="h-star h-star-position2"></div>
                    <div class="h-star h-star-position3"></div>
                    <div class="h-star h-star-position4"></div>
                    <div class="h-star h-star-position5"></div>
                    <div class="h-star h-star-position6"></div>
                    <div class="h-star h-star-position7"></div>
                </div>
                <div class="h-box-of-star3">
                    <div class="h-star h-star-position1"></div>
                    <div class="h-star h-star-position2"></div>
                    <div class="h-star h-star-position3"></div>
                    <div class="h-star h-star-position4"></div>
                    <div class="h-star h-star-position5"></div>
                    <div class="h-star h-star-position6"></div>
                    <div class="h-star h-star-position7"></div>
                </div>
                <div id="start" class="h-box-of-star4">
                    <div class="h-star h-star-position1"></div>
                    <div class="h-star h-star-position2"></div>
                    <div class="h-star h-star-position3"></div>
                    <div class="h-star h-star-position4"></div>
                    <div class="h-star h-star-position5"></div>
                    <div class="h-star h-star-position6"></div>
                    <div class="h-star h-star-position7"></div>
                </div>

                <div v-if="!playGame" id="home">
                    <div id="homeUp" class="text-white select-none">
                        <div class="flex-col">
                        <span class="font-MPlus text-5xl">
                            Salva los
                            <span class="text-6xl text-yellow-700">colores</span>
                            con
                        </span>
                            <div class="flex justify-center font-MPlus">
                                <span class="text-red-600 font-bold text-8xl">Mati&nbsp</span>
                                <span class="font-bold text-8xl">y&nbsp</span>
                                <span class="text-blue-600 font-bold text-8xl">Motas</span>
                            </div>
                        </div>
                    </div>

                    <div id="homeDown">
                        <div class="flex justify-center mt-10">
                            <principalButton @click="play()" id="principalButton" @mouseover="buttonSound()"
                                             class="font-P2 text-2xl cursor-cell">Comenzar
                                <div class="star-1">
                                    <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53"
                                         style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                         version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs>
                                        <g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                            <path
                                                d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
                                                class="fil0"></path></g></svg>
                                </div>
                                <div class="star-2">
                                    <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53"
                                         style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                         version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs>
                                        <g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                            <path
                                                d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
                                                class="fil0"></path></g></svg>
                                </div>
                                <div class="star-3">
                                    <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53"
                                         style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                         version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs>
                                        <g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                            <path
                                                d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
                                                class="fil0"></path></g></svg>
                                </div>
                                <div class="star-4">
                                    <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53"
                                         style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                         version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs>
                                        <g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                            <path
                                                d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
                                                class="fil0"></path></g></svg>
                                </div>
                                <div class="star-5">
                                    <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53"
                                         style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                         version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs>
                                        <g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                            <path
                                                d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
                                                class="fil0"></path></g></svg>
                                </div>
                                <div class="star-6">
                                    <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53"
                                         style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                         version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs>
                                        <g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                            <path
                                                d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
                                                class="fil0"></path></g></svg>
                                </div>
                            </principalButton>
                        </div>
                        <div class="flex justify-center my-5">
                            <button @mouseover="buttonSound()" class="btn">
                            <span class="icon">
                                <svg viewBox="0 0 175 80" width="40" height="40">
                                    <rect width="80" height="15" fill="#f0f0f0" rx="10"></rect>
                                    <rect y="30" width="80" height="15" fill="#f0f0f0" rx="10"></rect>
                                    <rect y="60" width="80" height="15" fill="#f0f0f0" rx="10"></rect>
                                </svg>
                            </span>
                                <span class="text">MENU</span>
                            </button>
                        </div>
                        <div class="flex justify-center">
                            <button @mouseover="buttonSound()" class="text-white font-P2 hover:text-gray-400">Volver
                            </button>
                        </div>
                    </div>
                </div>


                <div v-if="playGame" id="principalText" class="text-white fixed top-36 font-P2 flex justify-center">

                </div>

                <div v-if="figure1" class="fixed top-36" style="transform: scale(2);">
                    <div class="loader2 flex gap-x-16">
                        <div class="box2"></div>
                        <div class="circle2"></div>
                        <div class="triangle2"></div>
                    </div>
                </div>

                <div v-if="figure2" class="fixed top-36 mr-28">
                    <div class="container3">
                        <div class="item item-1"></div>
                        <div class="item item-2"></div>
                        <div class="item item-3"></div>
                        <div class="item item-4"></div>
                    </div>
                </div>

                <div id="planet1" class="fixed top-96 hidden duration-300">
                    <img :src="`${props.asset_images}/planetas/tierra.svg`" width="300" alt="">
                </div>

                <div id="secondText" class="fixed top-36 font-P2 flex justify-center text-7xl text-gray-500"></div>


                <div v-if="playGame" class="rocket top-[1500px]" @click="rocketUp()" id="rocket">
                    <div class="rocket-body">
                        <div class="body"></div>
                        <div class="fin fin-left"></div>
                        <div class="fin fin-right"></div>
                        <div class="window"></div>
                    </div>
                    <div class="exhaust-flame"></div>
                    <ul id="rocket-humo" class="exhaust-fumes duration-300 opacity-0">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</template>
<style>

#homeUp {
    transition: transform 500ms ease-in-out;
}

#homeDown {
    transition: transform 500ms ease-in-out;
}

.planetDown {
    animation: down 15s;
}

.planetUp {
    animation: up 3s;
}

@keyframes up {
    0% {
        transform: translateY(650px);
    }

    100% {
        transform: translateY(0px);
    }
}

@keyframes down {
    0% {
        transform: translateY(0px);
    }

    100% {
        transform: translateY(650px);
    }
}


@keyframes snow {
    0% {
        opacity: 0;
        transform: translateY(0px);
    }

    20% {
        opacity: 1;
    }

    100% {
        opacity: 1;
        transform: translateY(650px);
    }
}

.h-box-of-star1,
.h-box-of-star2,
.h-box-of-star3,
.h-box-of-star4 {
    width: 100%;
    position: absolute;
    z-index: -10;
    left: 0;
    transform: translateY(650px);
    height: 700px;
}

.h-box-of-star1 {
    animation: snow 5s linear infinite;
}

.h-box-of-star2 {
    animation: snow 5s -1.64s linear infinite;
}

.h-box-of-star3 {
    animation: snow 5s -2.30s linear infinite;
}

.h-box-of-star4 {
    animation: snow 5s -3.30s linear infinite;
}

.h-star {
    width: 3px;
    height: 3px;
    border-radius: 50%;
    background-color: #FFF;
    position: absolute;
    z-index: 10;
    opacity: 0.7;
}

.h-star:before {
    content: "";
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: #FFF;
    position: absolute;
    z-index: 10;
    top: 80px;
    left: 70px;
    opacity: .7;
}

.h-star:after {
    content: "";
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #4ade80;
    position: absolute;
    z-index: 10;
    top: 8px;
    left: 170px;
    opacity: .9;
}

.h-star-position1 {
    top: 30px;
    left: 20px;
}

.h-star-position2 {
    top: 110px;
    left: 250px;
}

.h-star-position3 {
    top: 60px;
    left: 570px;
}

.h-star-position4 {
    top: 120px;
    left: 900px;
}

.h-star-position5 {
    top: 20px;
    left: 1120px;
}

.h-star-position6 {
    top: 90px;
    left: 1280px;
}

.h-star-position7 {
    top: 30px;
    left: 1480px;
}

/*nave*/
.rocket-up {
    top: 100%;
}

.rocket-up {
    bottom: -100%;
}

.rocket {
    position: absolute;
    width: 80px;
    left: calc(50% - 40px);
    transition: top 5s ease-in-out;
}

.rocket .rocket-body {
    width: 80px;
    left: calc(50% - 50px);
    animation: bounce 0.5s infinite;
}

.rocket .rocket-body .body {
    background-color: #dadada;
    height: 180px;
    top: -180px;
    z-index: -10;
    left: calc(60% - 50px);
    border-radius: 100% 100% 50% 50%;
    border-top: 5px solid #f5f5f5;
}

.rocket .rocket-body:before {
    content: '';
    position: absolute;
    left: calc(50% - 24px);
    width: 48px;
    height: 13px;
    background-color: #554842;
    bottom: -13px;
    border-bottom-right-radius: 60%;
    border-bottom-left-radius: 60%;
}

.rocket .window {
    position: absolute;
    width: 40px;
    height: 40px;
    border-radius: 100%;
    background-color: #60a5fa;
    left: calc(50% - 25px);
    top: -150px;
    border: 5px solid #b4b2b2;
}

.rocket .fin {
    position: absolute;
    z-index: -100;
    height: 55px;
    width: 50px;
    top: 10px;
    background-color: #60a5fa;
}

.rocket .fin-left {
    left: -30px;
    top: calc(100% - 55px);
    border-top-left-radius: 80%;
    border-bottom-left-radius: 20%;
}

.rocket .fin-right {
    right: -30px;
    top: calc(100% - 55px);
    border-top-right-radius: 80%;
    border-bottom-right-radius: 20%;
}

.rocket .exhaust-flame {
    position: absolute;
    top: 90%;
    width: 28px;
    background: linear-gradient(to bottom, transparent 10%, #f5f5f5 100%);
    height: 150px;
    left: calc(50% - 14px);
    animation: exhaust 0.2s infinite;
}

.rocket .exhaust-fumes li {
    width: 60px;
    height: 60px;
    background-color: #f5f5f5;
    list-style: none;
    top: 100px;
    position: absolute;
    border-radius: 100%;
}

.rocket .exhaust-fumes li:first-child {
    width: 200px;
    height: 200px;
    bottom: -10px;
    animation: fumes 5s infinite;
}

.rocket .exhaust-fumes li:nth-child(2) {
    width: 150px;
    height: 150px;
    left: -120px;
    top: 100px;
    animation: fumes 3.2s infinite;
}

.rocket .exhaust-fumes li:nth-child(3) {
    width: 120px;
    height: 120px;
    left: -40px;
    top: 230px;
    animation: fumes 3s 1s infinite;
}

.rocket .exhaust-fumes li:nth-child(4) {
    width: 100px;
    height: 100px;
    left: -170px;
    animation: fumes 4s 2s infinite;
    top: 280px;
}

.rocket .exhaust-fumes li:nth-child(5) {
    width: 130px;
    height: 130px;
    left: -120px;
    top: 250px;
    animation: fumes 5s infinite;
}

.rocket .exhaust-fumes li:nth-child(6) {
    width: 200px;
    height: 200px;
    left: -60px;
    top: 180px;
    animation: fumes2 10s infinite;
}

.rocket .exhaust-fumes li:nth-child(7) {
    width: 100px;
    height: 100px;
    left: -100px;
    top: 220px;
}

.rocket .exhaust-fumes li:nth-child(8) {
    width: 110px;
    height: 110px;
    left: 70px;
    top: 240px;
}

.rocket .exhaust-fumes li:nth-child(9) {
    width: 90px;
    height: 90px;
    left: 200px;
    top: 280px;
    animation: fumes 20s infinite;
}

.star li {
    list-style: none;
    position: absolute;
}

.star li:before, .star li:after {
    content: '';
    position: absolute;
    background-color: #f5f5f5;
}

.star li:before {
    width: 10px;
    height: 2px;
    border-radius: 50%;
}

.star li:after {
    height: 8px;
    width: 2px;
    left: 4px;
    top: -3px;
}

.star li:first-child {
    top: -30px;
    left: -210px;
    animation: twinkle 0.4s infinite;
}

.star li:nth-child(2) {
    top: 0;
    left: 60px;
    animation: twinkle 0.5s infinite;
}

.star li:nth-child(2):before {
    height: 1px;
    width: 5px;
}

.star li:nth-child(2):after {
    width: 1px;
    height: 5px;
    top: -2px;
    left: 2px;
}

.star li:nth-child(3) {
    left: 120px;
    top: 220px;
    animation: twinkle 1s infinite;
}

.star li:nth-child(4) {
    left: -100px;
    top: 200px;
    animation: twinkle 0.5s ease infinite;
}

.star li:nth-child(5) {
    left: 170px;
    top: 100px;
    animation: twinkle 0.4s ease infinite;
}

.star li:nth-child(6) {
    top: 87px;
    left: -79px;
    animation: twinkle 0.2s infinite;
}

.star li:nth-child(6):before {
    height: 1px;
    width: 5px;
}

.star li:nth-child(6):after {
    width: 1px;
    height: 5px;
    top: -2px;
    left: 2px;
}

@keyframes fumes {
    50% {
        transform: scale(1.5);
        background-color: transparent;
    }

    51% {
        transform: scale(0.8);
    }

    100% {
        background-color: #f5f5f5;
        transform: scale(1);
    }
}

@keyframes bounce {
    0% {
        transform: translate3d(0px, 0px, 0);
    }

    50% {
        transform: translate3d(0px, -4px, 0);
    }

    100% {
        transform: translate3d(0px, 0px, 0);
    }
}

@keyframes exhaust {
    0% {
        background: linear-gradient(to bottom, transparent 10%, #f5f5f5 100%);
    }

    50% {
        background: linear-gradient(to bottom, transparent 8%, #f5f5f5 100%);
    }

    75% {
        background: linear-gradient(to bottom, transparent 12%, #f5f5f5 100%);
    }
}

@keyframes fumes2 {
    50% {
        transform: scale(1.1);
    }
}

@keyframes twinkle {
    80% {
        transform: scale(1.1);
        opacity: 0.7;
    }
}

/*----*/

.loader2 {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.box2 {
    width: 50px;
    height: 50px;
    border: 4px solid #3498db;
    animation: box-expand 1s ease-in-out infinite alternate;
}

.circle2 {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 4px solid transparent;
    border-top-color: #f1c40f;
    animation: circle-rotate 1s linear infinite;
}

.triangle2 {
    width: 0;
    height: 0;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    border-bottom: 30px solid #e74c3c;
    animation: triangle-expand 1s ease-in-out infinite alternate;
}

@keyframes box-expand {
    0% {
        transform: scale(1);
    }

    100% {
        transform: scale(1.2);
    }
}

@keyframes circle-rotate {
    to {
        transform: rotate(360deg);
    }
}

@keyframes triangle-expand {
    0% {
        width: 0;
        height: 0;
    }

    100% {
        width: 30px;
        height: 60px;
    }
}

/*-----*/

.container3 {
    position: absolute;
    width: 100px;
    height: 100px;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}

.item {
    width: 50px;
    height: 50px;
    position: absolute;
}

.item-1 {
    background-color: rgb(250, 87, 103);
    top: 0;
    left: 0;
    z-index: 1;
    animation: item-1_move 1.8s cubic-bezier(.6, .01, .4, 1) infinite;
}

.item-2 {
    background-color: rgb(121, 68, 228);
    top: 0;
    right: 0;
    animation: item-2_move 1.8s cubic-bezier(.6, .01, .4, 1) infinite;
}

.item-3 {
    background-color: rgb(27, 145, 247);
    bottom: 0;
    right: 0;
    z-index: 1;
    animation: item-3_move 1.8s cubic-bezier(.6, .01, .4, 1) infinite;
}

.item-4 {
    background-color: rgb(250, 194, 76);
    bottom: 0;
    left: 0;
    animation: item-4_move 1.8s cubic-bezier(.6, .01, .4, 1) infinite;
}

@keyframes item-1_move {
    0%, 100% {
        transform: translate(0, 0)
    }

    25% {
        transform: translate(0, 50px)
    }

    50% {
        transform: translate(50px, 50px)
    }

    75% {
        transform: translate(50px, 0)
    }
}

@keyframes item-2_move {
    0%, 100% {
        transform: translate(0, 0)
    }

    25% {
        transform: translate(-50px, 0)
    }

    50% {
        transform: translate(-50px, 50px)
    }

    75% {
        transform: translate(0, 50px)
    }
}

@keyframes item-3_move {
    0%, 100% {
        transform: translate(0, 0)
    }

    25% {
        transform: translate(0, -50px)
    }

    50% {
        transform: translate(-50px, -50px)
    }

    75% {
        transform: translate(-50px, 0)
    }
}

@keyframes item-4_move {
    0%, 100% {
        transform: translate(0, 0)
    }

    25% {
        transform: translate(50px, 0)
    }

    50% {
        transform: translate(50px, -50px)
    }

    75% {
        transform: translate(0, -50px)
    }
}

</style>
