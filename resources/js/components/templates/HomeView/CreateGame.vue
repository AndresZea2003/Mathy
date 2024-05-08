<script setup>
import { ref } from 'vue';
import logo from '../../../../../public/images/globals/nave.png';

const inputName = ref('');

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
};

</script>


<template>
    <div class="w-64 h-80 flex justify-center items-center flex-col xl:bottom-9 z-10">
        <img class="w-12 my-3" :src="logo" alt="logo"/>
        <label for="text-input" class="create-game__font--julius text-white text-xl mt-20 xl:text-2xl">NOMBRE</label>
        <input class="create-game__font--julius w-64 bg-blue-950 border-white border rounded-2xl h-8 text-center text-white" id="text-input" v-model="inputName" type="text" placeholder="Nombre">
        <button class="create-game__font--julius bg-blue-950 w-40 h-8 text-white border-white border rounded-md mt-20 xl:w-52 xl:h-10 hover:bg-white hover:text-black xl:" @click="createGame">
            Continuar
        </button>

    </div>
</template>


<style scoped>
.create-game__font--julius {
    font-family: 'Julius Sans One', sans-serif;
}


</style>