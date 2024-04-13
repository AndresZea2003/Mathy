<script setup>
//Importacion de imagenes
import ship from '../../img/globals/nave.png';
</script>

<template>
    <div class="logico-matematicas__div--container w-80 mx-auto relative flex justify-content-center align-items-center flex-col">
        <p class="logico-matematicas__p--experiencias text-4xl">EXPERIENCIAS</p>
        <p class="logico-matematicas__p--logico-matematicas text-lg">LOGICO MATEMATICAS</p>
        <img class="logico-matematicas__img--ship w-20 absolute" :src="ship"  alt="ship"/>
    </div>
</template>

<style scoped>
.logico-matematicas__p--experiencias {
    font-family: 'Lakki Reddy', serif;
    color: #0FF;
}

.logico-matematicas__p--logico-matematicas {
    font-family: 'ZCOOL KuaiLe', sans-serif;
    color: #FFE500;
}

.logico-matematicas__img--ship{
    bottom: -25px;
    right: 15px;
    transform: rotate(-45deg);
}
</style>