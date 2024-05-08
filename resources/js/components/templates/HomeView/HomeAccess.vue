<script setup>
import { onBeforeMount, ref } from "vue";
import ChoiceGame from "./ChoiceGame.vue";
import CreateGame from "./CreateGame.vue";
import PlanetsFooter from "./PlanetsFooter.vue";

const gamesVerify = ref();

onBeforeMount(() => {
    if(JSON.parse(localStorage.getItem('games')).length > 0){
        gamesVerify.value = true;
    }else if(!localStorage.getItem('games')){
        gamesVerify.value = false;
        localStorage.setItem('games', JSON.stringify([]));
    }
});

</script>

<template>
    <div class="home-access__div--container w-full h-screen flex justify-center items-center">
        <ChoiceGame v-if="gamesVerify"/>
        <CreateGame v-else/>
        <PlanetsFooter/>
    </div>
</template>

<style scoped>
.home-access__div--container {
    background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/1231630/stars.png), linear-gradient(180deg, rgba(5,0,62,1) 0%, rgba(5,0,255,1) 100%),  repeat;
}


</style>