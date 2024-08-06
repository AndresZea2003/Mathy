<script setup>
import { onBeforeMount, ref } from "vue";
import { getUsersLocalStorage } from "../../../use";
import { store_data } from "../../../use/store_data";


//Ref
const color1 = ref("red");
const color2 = ref("red");
const textColor = ref("red");

//Props
const props = defineProps({
    background: String,
    level: String
});


const getActualRocket = () => {
    let actualRocketID = getUsersLocalStorage().shipSelected;

    // console.log(store_data[0], "loffjjf", actualRocketID);

    return store_data[actualRocketID - 1].gif;


};

const colorsResources = [
    "rgb(255, 0, 0)",
    "rgb(255, 174, 0)",
    "rgb(115, 255, 0)",
    "rgb(0, 255, 98)",
    "rgb(0, 255, 213)",
    "rgb(0, 195, 255)",
    "rgb(0, 119, 255)",
    "rgb(0, 17, 255)",
    "rgb(174, 0, 255)",
    "rgb(255, 0, 242)",
    "rgb(255, 0, 119)",
    "rgb(255, 0, 0)"
];


const randomColor = () => {
    let randomNum = Math.floor(Math.random() * colorsResources.length);

    return colorsResources[randomNum];
};

onBeforeMount(() => {
    color1.value = randomColor();
    color2.value = randomColor();
    textColor.value = randomColor();
});


</script>

<template>
    <div class="intro-level__div--container  w-full h-full absolute pointer-events-none">
        <div class="intro-level--container-background h-full absolute" :style="{backgroundImage: `url(${background})`}">
            <div class="intro-level__div--container-figures-numbers absolute w-80 h-80 rounded-xl right-20 backdrop-blur-sm flex justify-center items-center" :style="{border: `.25em solid ${color1}`, boxShadow: `0 0 1em .25em ${color1}, 0 0 4em 1em ${color1}, inset 0 0 .75em .25em ${color1}`}">
                <div class="intro-level__div--circle w-10 h-10 rounded-full absolute top-5 left-5" :style="{border: `.25em solid ${color2}`, boxShadow: `0 0 1em .25em ${color2}, 0 0 4em 1em ${color2}, inset 0 0 .75em .25em ${color2}`}"></div>
                <div class="intro-level__div--circle w-10 h-10 rounded-full absolute bottom-5 right-5" :style="{border: `.25em solid ${color2}`, boxShadow: `0 0 1em .25em ${color2}, 0 0 4em 1em ${color2}, inset 0 0 .75em .25em ${color2}`}"></div>
                <p class="intro-level__p--number-level text-gray-50 text-9xl font-luckiest-guy" :style="{filter: `drop-shadow(0px 0px 15px ${color1}`}">
                    {{ level }}
                </p>
            </div>
            <img class="intro-level__img--rocket w-60 absolute" :src="getActualRocket()" alt="background"/>
        </div>
    </div>
</template>

<style scoped>

.intro-level__div--container {
    z-index: 10000;
    filter: drop-shadow(0px 0px 105px rgb(13, 0, 255));
}

.intro-level--container-background {
    background-size: cover;
    right: 0;
    filter: blur(0.5px);
    background-position: 100% center;
    animation: travelAnimation 2s linear;
}

@keyframes travelAnimation {
    0% {
        width: 100%;
    }

    100% {
        width: 0%;
    }
}


.intro-level__img--rocket {
    top: 50%;
    transform: translate(0%, -50%) rotate(90deg);
    z-index: 10000;
    left: -130px;
    /* animation: rocketAnimation 1s infinite linear; */
}

/* @keyframes rocketAnimation {
    0% {
        transform: translate(0px, -55%);
    }

    50% {
        transform: translate(0px, -45%);
    }

    100% {
        transform: translate(0px, -55%);
    }
} */

.intro-level__div--container-figures-numbers {
    /* --glow-color: rgb(132, 0, 255);
    --glow-spread-color: rgba(111, 0, 214, 0.781);
    border: .25em solid var(--glow-color);
    box-shadow: 0 0 1em .25em var(--glow-color),
        0 0 4em 1em var(--glow-spread-color),
        inset 0 0 .75em .25em var(--glow-color); */
    animation: figuresContainerAnimation 0.5s linear;
    animation-delay: 0.5s;
    animation-fill-mode: forwards;
    top: 50%;
    transform: translate(0%, -50%);
}

@keyframes figuresContainerAnimation {
    0% {
        /* transform: scale(1) translate(0%, -50%); */
        opacity: 100%;
    }

    100% {
        /* transform: scale(0) translate(0%, -50%); */
        opacity: 0%;
    }
}

.intro-level__div--circle {
    animation: circleAnimation 0.5s linear;
    animation-delay: 0.5s;
    animation-fill-mode: forwards;
}

@keyframes circleAnimation {
    0% {
        transform: translateY(0px);
        opacity: 100%;
    }

    100% {
        transform: translateY(-50px);
        opacity: 0%;
    }
}

.intro-level__p--number-level {
    color: rgb(255, 255, 255);
    font-size: 200px;
    /* filter: drop-shadow(0px 0px 15px rgb(25, 0, 255)); */
    animation: numbersAnimation 0.2s linear;
    animation-delay: 0.8s;
    animation-fill-mode: forwards;
}

@keyframes numbersAnimation {
    0% {
        transform: scale(1);
        /* opacity: 100%; */
    }

    100% {
        transform: scale(0);
        /* opacity: 0%; */
    }
}
</style>