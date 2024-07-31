<script setup>
import { onMounted, ref } from "vue";

//Ref
const nameProcessed = ref("");

//props
const props = defineProps({
    name: Array
});

//Funcion que genera los arrays del nombre
const nameCardsArray = (name) => {
    let nameParts = name.split(" ");

    return nameParts.map(part => part.split(''));
};

//Eejcutamos la funcion al montaje
onMounted(() => {
    nameProcessed.value = nameCardsArray(props.name.toUpperCase());
});


// console.log("namecard", props.name);
</script>

<template>
    <div v-for="nameItem, index in nameProcessed" :key="index" class="w-full h-14 flex justify-center items-center my-1">
        <div v-for="item, index in nameItem" :key="index" class="w-7 h-14 bg-white flex justify-center items-center text-3xl font-luckiest-guy rounded-md m-1">{{ item }}</div>
    </div>
</template>

<style scoped>




</style>