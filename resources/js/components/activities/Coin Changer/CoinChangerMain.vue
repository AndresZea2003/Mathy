<script setup>
import CoinChanger from './CoinChanger.vue';



</script>

<template>
    <div class="coin-changer--container">
        <CoinChanger :storageBronze="'bronzeCoins'" :storageSilver="'silverCoins'" :storageGold="'goldCoins'"  :goldenExchange="3" :silverExchange="3" :guide="true"/>
    </div>
</template>

<style scoped>
.coin-changer--container {
    width: 700px;
    /* width: 300px; */
    height: 600px; /*Dejar en tamaño actual para evitar bugs.*/
}
</style>