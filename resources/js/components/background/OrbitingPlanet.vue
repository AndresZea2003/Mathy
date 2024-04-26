<script setup>
import { onMounted, ref } from 'vue';


let active = ref(true);

//Color del planeta
const backgroundPlanet = ref(null);
const shadowPlanet = ref(null);


setInterval(() => {
    active.value = false;
    setTimeout(() => {
        active.value = true;
    }, 1000);
}, 80000);


const colorPlanet = [
    'rgb(0, 255, 255)',
    'rgb(0, 47, 255)',
    'rgb(229, 255, 0)',
    'rgb(0, 106, 255)',
    'rgb(255, 0, 212)',
    'rgb(255, 0, 0)',
    'rgb(0, 255, 102)',
    'rgb(55, 55, 214)',
    'rgb(209, 55, 214)',
    'rgb(214, 55, 55)',
    'rgb(81, 0, 139)',
    'rgb(9, 0, 139)',
    'rgb(139, 0, 118)',
    'rgb(0, 132, 139)',
    'rgb(139, 97, 0)'
];

onMounted(() => {
    const randomNum = Math.floor(Math.random() * colorPlanet.length);

    backgroundPlanet.value = colorPlanet[randomNum];
    shadowPlanet.value = colorPlanet[randomNum];
});

</script>

<template>
    <div class="w-full h-full flex items-center justify-center overflow-hidden absolute">
        <div v-if="active" class="orbiting-planet__div--planet w-48 h-48 rounded-full absolute" :style="{ backgroundColor: backgroundPlanet, boxShadow: `0px 0px 32px 7px ${shadowPlanet}` }"></div>
    </div>
</template>

<style scoped>
.orbiting-planet__div--planet {
    top: 750px;
    animation: levitateAnimation 55s linear;
}

@keyframes levitateAnimation {
    0% {
    transform: rotate(0deg) translate(700px, 0);
    }
    25% {
        transform: rotate(90deg) translate(700px, 0);
    }
    50% {
        transform: rotate(180deg) translate(700px, 0);
    }
    75% {
        transform: rotate(270deg) translate(700px, 0);
    }
    100% {
        transform: rotate(360deg) translate(700px, 0);
    }
}
</style>