<script setup>
import { onBeforeMount, ref } from 'vue';
import goldCoinIMG from '../../img/globals/gold-coin.png';


const props = defineProps({
    currentShip: Number,
    unlockedShips: Array,
    storage_gold: String
});


const goldCoinsStorage = ref(localStorage.getItem(props.storage_gold));

const arrayCoins = ref([]);

onBeforeMount(() => {
    for (let i = 0; i < goldCoinsStorage.value; i++) {
        arrayCoins.value.push({
            coinId: i,
            type: "gold",
            img: goldCoinIMG
        });
    };
});


</script>

<template>
    <div class="coin-counter__div--container rounded-3xl bg-red-500 absolute flex items-center justify-center z-50 top-24 right-2.5 md:top-10 md:right-12">
        <div class="coin-counter__div--content  md:py-0.5 md:px-3.5 py-1.5 px-0.5 rounded-3xl md:flex md:flex-row md:items-center md:justify-center">
            <img class="coin-counter__img--coin w-10" v-for="(coin, index) in arrayCoins" :key="index" :src="coin.img" alt="gold-coin"/>
        </div>
    </div>
</template>

<style scoped>
.coin-counter__div--container {
    background: linear-gradient(45deg,#00ffa6, #02124A, #ff0000, #02124A, #00fbff, #02124A,  #f400cb, #02124A, #2bff00, #ff0000, #02124A,  #d00042,#02124A,  #bcc900);
    background-size: 800% 800%;
    animation: gradientAnimationCoinCounter 50s infinite;
}

@keyframes gradientAnimationCoinCounter {
    0% {
        background-position: 0% 0%;
    }
    50% {
        background-position: 100% 100%;
    }
    100% {
        background-position: 0% 0%;
    }
}
.coin-counter__div--content {
    width: calc(100% - 6px);
    height: 95%;
    background-color: #02124A;
}

@media screen and (min-width: 700px) {
    .coin-counter__div--content {
        width: calc(100% - 15px);
    }
}

.coin-counter__img--coin {
    animation: coinAnimation 5s infinite linear;
}

@keyframes coinAnimation {
    0% {
        transform: translateX(-5px);
    }
    50% {
        transform: translateX(5px);
    }
    100% {
        transform: translateX(-5px);
    }
}
</style>