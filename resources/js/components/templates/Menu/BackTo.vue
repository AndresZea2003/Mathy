<script setup>


//Importacion de imagenes
import arrow from '../../../../../public/images/globals/Arrow 15.png';

const backTo = () => {
    console.log("Volver");
};
</script>

<template>
    <button @click="backTo" class="border rounded border-inherit">
        <img class="w-14 p-1" :src="arrow" alt="back"/>
    </button>
</template>

<style scoped>
</style>