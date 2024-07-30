<script setup>
import rocket from '../../../../../public/images/rockets/Cohetes-01.svg';

//Props
const props = defineProps({
    rocketSelected: Object
});


</script>

<template>
    <div class="flex justify-center items-center">
        <img class="rocket-selected__img--rocket w-60 absolute z-10" :src="props.rocketSelected.img" alt="rocket"/>
        <div :class="`rocket-selected__div--container w-52 h-60 md:h-96 md:w-60 m-5 border rounded-md flex justify-center items-center transition-all cursor-pointer relative`">

        </div>
    </div>
</template>

<style scoped>
.rocket-selected__div--container {
    --glow-color: rgb(9, 255, 0);
    --glow-spread-color: rgba(9, 255, 0, 0.863);
    border: .25em solid var(--glow-color);
    box-shadow: inset 0px 0px 23px 12px var(--glow-spread-color);
    animation: containerCardAnimation 4s ;
    animation-fill-mode: forwards;
}

@keyframes containerCardAnimation {
    0% {
        border-radius: 100%;
        width: 200px;
        height: 200px;
    }



    100% {
        opacity: 0%;
        border-radius: 100%;
        width: 800px;
        height: 800px;
    }
}

/* @keyframes containerCardAnimation {
    0% {
        transform: rotate(0deg);
        border-radius: 2%;
    }

    35% {
        transform: rotate(360deg);
    }

    70% {
        transform: rotate(0deg);
        opacity: 100%;
    }

    100% {
        transform: rotate(0deg);
        opacity: 0%;
        border-radius: 100%;
        width: 400px;
        height: 400px;
    }
} */

.rocket-selected__img--rocket {
    animation: rocketLaunchAnimation 5s;
    animation-delay: 2s;
    animation-fill-mode: forwards;
}

@keyframes rocketLaunchAnimation {
    0% {
        transform: translate(0px, 0px);
    }

    100% {
        transform: translate(500px, -500px);
    }
}


</style>