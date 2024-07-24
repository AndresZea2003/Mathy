<script setup>
import { store_data } from '../../use/store_data';
import { onBeforeMount, ref } from 'vue';
import { getUsersLocalStorage } from '../../use';

const currentShip = ref(null);


onBeforeMount(() => {
    currentShip.value = store_data[getUsersLocalStorage().shipSelected - 1].img;
});


let active = ref(true);

setInterval(() => {
    active.value = false;
    setTimeout(() => {
        active.value = true;
    }, 1000);
}, 60000);


</script>

<template>
    <div class="w-full h-full flex items-center overflow-hidden absolute">
        <img v-if="active" class="background-ship__img--ship w-40 absolute overflow-hidden" :src="currentShip" alt="rocket"/>
    </div>
</template>

<style scoped>
.background-ship__img--ship {
    left: -200px;
    animation: shipAnimation 20s linear;
}


@keyframes shipAnimation {
    0% {
        left: -200px;
        transform: rotate(0deg);
    }
    100% {
        left: 2000px;
        transform: rotate(800deg);
    }
}

</style>