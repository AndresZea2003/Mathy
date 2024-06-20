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
        <div :class="`rocket-selected__div--container bg-blue-900 w-52 h-60 md:h-96 md:w-60 m-5 border rounded-md border-cyan-300 border-2 flex justify-center items-center transition-all cursor-pointer relative`">

        </div>
    </div>
</template>

<style scoped>
.rocket-selected__div--container {
    animation: containerCardAnimation 2s ;
    animation-fill-mode: forwards;
}

@keyframes containerCardAnimation {
    0% {
        transform: rotate(0deg);
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
    }
}

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