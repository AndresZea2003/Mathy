<script setup>
import asteroid from '../../../../public/images/globals/asteroid-2.png';

</script>

<template>
    <div class="container h-screen absolute top-0 left-0">
        <img class="asteroid__img--1 absolute w-7 left-3/4 top-1/4" :src="asteroid" alt="asteroid"/>
        <img class="asteroid__img--2 absolute w-16 left-1/2 top-3/4" :src="asteroid" alt="asteroid"/>
        <img class="asteroid__img--3 absolute w-10 left-1/3 top-1/3" :src="asteroid" alt="asteroid"/>
    </div>
</template>

<style scoped>
.asteroid__img--1 {
    animation: levitateAnimation1 5s infinite linear;
}

@keyframes levitateAnimation1 {
    0% {
    transform: rotate(0deg) translate(200px, 0);
    }
    25% {
        transform: rotate(90deg) translate(200px, 0);
    }
    50% {
        transform: rotate(180deg) translate(200px, 0);
    }
    75% {
        transform: rotate(270deg) translate(200px, 0);
    }
    100% {
        transform: rotate(360deg) translate(200px, 0);
    }
}

.asteroid__img--1 {
    animation: levitateAnimation1 40s infinite linear;
}

@keyframes levitateAnimation1 {
    0% {
    transform: rotate(0deg) translate(200px, 0);
    }
    25% {
        transform: rotate(90deg) translate(200px, 0);
    }
    50% {
        transform: rotate(180deg) translate(200px, 0);
    }
    75% {
        transform: rotate(270deg) translate(200px, 0);
    }
    100% {
        transform: rotate(360deg) translate(200px, 0);
    }
}

.asteroid__img--2 {
    animation: levitateAnimation1 60s infinite linear;
}

@keyframes levitateAnimation2 {
    0% {
    transform: rotate(0deg) translate(100px, 0);
    }
    25% {
        transform: rotate(90deg) translate(100px, 0);
    }
    50% {
        transform: rotate(180deg) translate(100px, 0);
    }
    75% {
        transform: rotate(270deg) translate(100px, 0);
    }
    100% {
        transform: rotate(360deg) translate(100px, 0);
    }
}

.asteroid__img--3 {
    animation: levitateAnimation3 30s infinite linear;
}

@keyframes levitateAnimation3 {
    0% {
    transform: rotate(0deg) translate(20px, 0);
    }
    25% {
        transform: rotate(90deg) translate(20px, 0);
    }
    50% {
        transform: rotate(180deg) translate(20px, 0);
    }
    75% {
        transform: rotate(270deg) translate(20px, 0);
    }
    100% {
        transform: rotate(360deg) translate(20px, 0);
    }
}
</style>