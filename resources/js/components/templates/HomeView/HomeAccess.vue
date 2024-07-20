<script setup>
import { onBeforeMount, ref } from "vue";

//Components
import ChoiceGame from "./ChoiceGame.vue";
import CreateGame from "./CreateGame.vue";
import PlanetsFooter from "./PlanetsFooter.vue";
import IntroAnimationSpace from "./IntroAnimationSpace.vue";
import ButtonSkip from "../../ui/ButtonSkip.vue";


const props = defineProps({
    video: String,
});


const gamesVerify = ref();
const createAccount = ref(false);
const introAnimationActive = ref(false);

const choiceOrCreateAccess = () => {
    if(createAccount.value === true){
        gamesVerify.value = false;
    }else if(!localStorage.getItem('games')){
        gamesVerify.value = false;
        localStorage.setItem('games', JSON.stringify([]));
    }else if(JSON.parse(localStorage.getItem('games')).length > 0){
        gamesVerify.value = true;
    }else if(JSON.parse(localStorage.getItem('games')).length === 0){
        gamesVerify.value = false;
    }
};

onBeforeMount(() => {
    choiceOrCreateAccess();
});


//Componente traido del emit.
const createGameComponent = (event) => {
    createAccount.value = event;
    choiceOrCreateAccess();
};

//Funcion que activa el intro
const introAnimationFunction = (event) => {
    introAnimationActive.value = event
};

</script>

<template>
    <div class="home-access__div--container w-full h-screen flex justify-center items-center overflow-hidden">
        <ChoiceGame v-if="gamesVerify && !introAnimationActive" @createGameComponent="createGameComponent" @introAnimationActive="introAnimationFunction"/>
        <CreateGame v-if="!gamesVerify && !introAnimationActive" @introAnimationActive="introAnimationFunction"/>
        <IntroAnimationSpace v-if="introAnimationActive" :video="props.video"/>
        <PlanetsFooter v-if="!introAnimationActive"/>
    </div>
</template>

<style scoped>
.home-access__div--container {
    background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/1231630/stars.png), linear-gradient(180deg, rgba(5,0,62,1) 0%, rgba(5,0,255,1) 100%),  repeat;
}


</style>