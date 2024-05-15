<script setup>



let localStorageData = JSON.parse(localStorage.getItem('games'));

//Imagenes
import save from '../../../../../public/images/home/save.png';
import logo from '../../../../../public/images/globals/main-logo.png';

//Emits
const emit = defineEmits(['createGameComponent', 'introAnimationActive']);


//Funcion que controla que usuario esta usando la aplicacion
const gamerSelected = (name) => {
    localStorage.setItem('gamer', name);
    emit('introAnimationActive', true);
};

//Funcion que te lleva a crear una nueva cuenta
const createGameComponent = () => {
    emit('createGameComponent', true);
};

</script>


<template>
    <div class="z-10 flex justify-center items-center flex-col">
        <img class="w-14 m-center" :src="save" alt="save"/>
        <div class="w-64 h-96 z-10 backdrop-blur-sm border-2 border-blue-900 rounded-md my-3 py-3 flex flex-col justify-center items-center xl:w-80 ">
            <div class="choice-game__div--scroll w-56 my-4 overflow-x-auto xl:w-72 flex items-center flex-col">
                <button v-for="gamer, index in localStorageData" :key="index" @click="gamerSelected(gamer.name)" class="choice-game__font--julius w-52 h-14 rounded-lg border-white border my-1 m-auto font-bold text-white xl:w-64 hover:bg-white hover:text-black hover:font-bold hover:scale-90 transition" :style="{ background: gamer.inputColor.background, color: gamer.inputColor.text }">{{ gamer.name }}</button>
                <button @click="createGameComponent()" class="choice-game__font--julius w-52 h-14 rounded-lg border-white bg-blue-950 border my-1 mx-auto text-white text-3xl xl:w-64 hover:bg-white hover:text-black hover:font-bold hover:scale-90 transition">+</button>
            </div>
        </div>
        <img class="w-40" :src="logo" alt="logo"/>
    </div>
</template>

<style scoped>
.choice-game__font--julius {
    font-family: 'Julius Sans One', sans-serif;
}


.choice-game__div--scroll {
    overflow-y: auto;
    flex-grow: 0;
}

.choice-game__div--scroll::-webkit-scrollbar {
    width: 5px;
    position: absolute;
}

.choice-game__div--scroll::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 10px;
    position: absolute;
}

.choice-game__div--scroll::-webkit-scrollbar-track {
    background: transparent;
    position: absolute;
}


</style>