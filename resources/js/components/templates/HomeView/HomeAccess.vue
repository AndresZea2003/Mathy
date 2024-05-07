<script setup>
import { onBeforeMount, ref } from "vue";

const gamesVerify = ref();

onBeforeMount(() => {
    console.log(localStorage.getItem('games'));

    if(localStorage.getItem('games')){
        gamesVerify.value = true;
    }else if(!localStorage.getItem('games')){
        gamesVerify.value = false;
    }
});


</script>

<template>
    <div>
        <p v-if="gamesVerify">Con cuentas</p>
        <p v-else>Sin cuentas</p>
    </div>
</template>

<style scoped>

</style>