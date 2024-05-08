<script setup>

let localStorageData = JSON.parse(localStorage.getItem('games'));



</script>


<template>
    <div class="w-64 h-96 z-10 backdrop-blur-sm border-2 border-blue-900 rounded-md my-3 py-3 flex flex-col justify-center items-center">
        <div class="w-56 my-4 overflow-auto">
            <button v-for="gamer, index in localStorageData" :key="index" class="choice-game__font--julius w-56 h-14 rounded-lg border-white bg-blue-950 border my-1 mx-auto text-white">{{ gamer.name }}</button>
            <button v-for="gamer, index in localStorageData" :key="index" class="choice-game__font--julius w-56 h-14 rounded-lg border-white bg-blue-950 border my-1 mx-auto text-white">{{ gamer.name }}</button>
            <button v-for="gamer, index in localStorageData" :key="index" class="choice-game__font--julius w-56 h-14 rounded-lg border-white bg-blue-950 border my-1 mx-auto text-white">{{ gamer.name }}</button>
            <button v-for="gamer, index in localStorageData" :key="index" class="choice-game__font--julius w-56 h-14 rounded-lg border-white bg-blue-950 border my-1 mx-auto text-white">{{ gamer.name }}</button>
        </div>
    </div>
</template>

<style scoped>
.choice-game__font--julius {
    font-family: 'Julius Sans One', sans-serif;
}


</style>