<script setup>
import ring from '../../img/Draw-image/ring.png';
import check from '../../img/Draw-image/check.png';

//Props
const props = defineProps({
    finishedLevels: Array
});

</script>

<template>
    <div class="finished-level__div--container">
        <div class="finished-level__div--container-massage">
            <div class="w-25 h-25 m-auto relative top-48 flex justify-center items-center">
                <img class="finished-level__img--ring w-40 absolute pointer-events-none pointer-events-none select-none" :src="ring" alt="ring"/>
                <img class="finished-level__img--check w-32 absolute pointer-events-none pointer-events-none select-none" :src="check" alt="check"/>
            </div>
            <div v-if="props.finishedLevels" class="m-auto flex justify-center items-center relative top-50">
                <div class="finished-level__div--indicator w-16 h-16  mx-2 rounded-full border-cyan-600 border-2 border-solid" v-for="check, index in props.finishedLevels" :key="index" :style="{backgroundColor: check.state ? ('green'):('red')}"></div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.finished-level__div--container {
    width: 100%;
    height: 100%;
    position: absolute;
    z-index: 50;
}

.finished-level__div--container-massage {
    width: 100%;
    height: 100%;
    background-image: url('../../img/Draw-image/background-level-completed.png');
    background-position: center;
    background-size: 1800px;
    background-repeat: no-repeat;
    animation: opacityAnimation 2s linear;
}

@keyframes opacityAnimation {
    0% {
        opacity: 0%;
    }

    100% {
        opacity: 100%;
    }
}

.finished-level__img--ring {
    transform: scale(0);
    animation: ringAnimation 0.5s linear;
    animation-delay: 2s;
    animation-fill-mode: forwards;
}

@keyframes ringAnimation {
    0% {
        transform: scale(0);
    }

    100% {
        transform: scale(1);
    }
}

.finished-level__img--check {
    animation: checkAnimation 1.5s linear;
}

@keyframes checkAnimation {
    0% {
        transform: scale(0);
    }

    100% {
        transform: scale(1);
    }
}

.finished-level__div--indicator {
    animation: indicatorAnimation 4s infinite;
}

@keyframes indicatorAnimation {
    0% {
        box-shadow: 0px 0px 8px -21px rgba(255, 255, 255, 0.75);
    }

    50% {
        box-shadow: 0px 0px 8px 11px rgba(255, 255, 255, 0.75);
    }

    100% {
        box-shadow: 0px 0px 8px -21px rgba(255, 255, 255, 0.75);
    }
}

</style>