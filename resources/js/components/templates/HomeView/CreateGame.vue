<script setup>
import { ref } from 'vue';

//Imagenes
import logo from '../../../../../public/images/globals/main-logo.png';

const inputName = ref('');
//Emits
const emit = defineEmits(['introAnimationActive']);

const createGame = () => {
    let templateObject = {
        name: inputName.value,
        currentLevel:[0, 0],
        unlockedLevels: [1],
        shipSelected: 1,
        goldenCoins: 0,
        silverCoins: 0,
        bronzeCoins: 3,
    }

    let localStorageContent = JSON.parse(localStorage.getItem('games'));

    localStorageContent.push(templateObject);

    localStorage.setItem('games', JSON.stringify(localStorageContent));
    emit('introAnimationActive', true);
};

</script>


<template>
    <div class="w-64 h-80 flex justify-center items-center flex-col xl:bottom-9 z-10">
        <img class="w-48 absolute top-24" :src="logo" alt="logo"/>
        <div class="flex justify-center items-center flex-col relative top-7">
            <label for="text-input" class="create-game__font--julius text-white text-xl mt-20 xl:text-2xl">NOMBRE</label>
            <input class="create-game__font--julius w-64 bg-blue-950 border-white border rounded-2xl h-8 text-center text-white" id="text-input" v-model="inputName" type="text" placeholder="Nombre">
        </div>
        <button class="create-game__font--julius bg-blue-950 w-40 h-8 text-white border-white relative top-7 border rounded-md mt-20 xl:w-52 xl:h-10 hover:bg-white hover:text-black xl:" @click="createGame">
            Continuar
        </button>

    </div>
</template>


<style scoped>
.create-game__font--julius {
    font-family: 'Julius Sans One', sans-serif;
}


</style>