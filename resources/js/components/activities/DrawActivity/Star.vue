<script setup>

const randomLeftPosition = () => {
    let randomNum = Math.floor(Math.random() * 100) + 1;

    return `${randomNum}%`;
};

const randomTopPosition = () => {
    let randomNum = Math.floor(Math.random() * 100) + 1;

    return `${randomNum}%`;
};

const randomAnimationDelay = () => {
    let randomNum = Math.floor(Math.random() * 10) + 1;

    return `${randomNum}s`;
};

</script>

<template>
    <div class="star__div--main" :style="{ left: randomLeftPosition(), top: randomTopPosition(), animationDelay:  randomAnimationDelay()}"></div>
</template>

<style scoped>
.star__div--main {
    position: absolute;
    width: 4px;
    height: 4px;
    background-color: white;
    border-radius: 100%;
    animation: starAnimation 4s infinite;
}



@keyframes starAnimation {
    0% {
        box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 1);
    }

    50% {
        box-shadow: 0px 0px 50px 7px rgba(255,255,255,1);
    }

    100% {
        box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 1);
    }
}
</style>