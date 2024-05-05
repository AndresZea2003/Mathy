<script setup>
import coinChangerImage from '../../../../../public/images/coin-change/coin-changer-image.png';

</script>

<template>
    <div class="flex justify-center items-center w-full h-full absolute ">
        <div class="vortex__div--vortex-background rounded-full w-96 h-96 flex justify-center items-center">
            <img class="vortex__img--coin-changer w-72 rounded-full" :src="coinChangerImage" alt="vortex-image"/>
        </div>
    </div>
</template>

<style scoped>
.vortex__div--vortex-background {
    z-index: 2;
    background-image: url('../../../../../public/images/coin-change/vortex-2.jpg');
    background-size: cover;
    background-position: center;
}

.vortex__img--coin-changer {
    -webkit-box-shadow: 0px 0px 179px 21px rgba(255,255,255,1);
    -moz-box-shadow: 0px 0px 179px 21px rgba(255,255,255,1);
    box-shadow: 0px 0px 179px 21px rgba(255,255,255,1);
}
</style>