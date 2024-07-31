<script setup>
import { onMounted, ref } from "vue";

//Ref
const nameProcessed = ref("");

//props
const props = defineProps({
    name: Array,
    color: String
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


console.log("color", props.color);
</script>

<template>
    <div v-for="nameItem, index in nameProcessed" :key="index" class="w-full h-14 flex justify-center items-center my-1">
        <div v-for="item, index in nameItem" :key="index" class="name-card__div--card text-gray-100 w-7 h-14 flex justify-center items-center text-3xl font-luckiest-guy rounded-md m-1" :style="{border: `2px solid ${props.color}`, boxShadow: `0 0 25px 5px ${props.color}, 0 0 25px 1px ${props.color}, inset 0 0 25px 5px ${props.color}`}">{{ item }}</div>
    </div>
</template>

<style scoped>

.name-card__div--card {
    --glow-color: rgb(132, 0, 255);
    --glow-spread-color: rgba(111, 0, 214, 0.781);
    border: .25em solid var(--glow-color);
    box-shadow: 0 0 25px 5px var(--glow-color),
        0 0 25px 1px var(--glow-spread-color),
        inset 0 0 25px 5px var(--glow-color);
}


</style>