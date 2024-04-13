<script setup>
import { ref } from 'vue';
import cursorHand from '../../img/coin-change/cursorHand.png';

// let coinType = "silver";
// let capsuleCoins = 0;

//Props
const props = defineProps({
    capsuleCoins: Array,
    bronzeArray: Array,
    silverArray: Array,
    goldenExchange: Number,
    silverExchange: Number
});

const capsuleCoins = ref(props.capsuleCoins);
const silverArray = ref(props.silverArray);
const bronzeArray = ref(props.bronzeArray);





//Ref para controlar el tipo de moneda a mostrar.
const coinShow = ref("");


if (capsuleCoins.value.length === 0 && bronzeArray.value.length > 0 && silverArray.value.length > 0 && silverArray.value.length >= props.goldenExchange && bronzeArray.value.length >= props.silverExchange) {
    coinShow.value = "both";
} else if (bronzeArray.value.length === 0 && capsuleCoins.value.length === 0 || capsuleCoins.value.length > 0 && capsuleCoins.value[0].type === "silver" || bronzeArray.value.length < props.silverExchange) {
    coinShow.value = "silver";
} else if (silverArray.value.length === 0 && capsuleCoins.value.length === 0 || props.bronzeArray.length !== 0 || capsuleCoins.value.length > 0 && capsuleCoins.value[0].type === "bronze" || silverArray.value.length < props.goldenExchange) {
    coinShow.value = "bronze";
}



</script>

<template>
    <div class="coin-changer-tutorial__div--container">
        <div class="coin-changer-tutorial__div--container-animation">
            <div class="coin-changer-tutorial__div--deposit-coin-animation"></div>
            <div v-if="coinShow === 'both' || coinShow === 'silver'" class="coin-changer-tutorial__div--coin-silver">
                <img class="coin-changer-tutorial__img--mouse" :src="cursorHand" alt="mouse">
            </div>
            <div v-if="coinShow === 'both' || coinShow === 'bronze'" class="coin-changer-tutorial__div--coin-bronze">
                <img class="coin-changer-tutorial__img--mouse" :src="cursorHand" alt="mouse">
            </div>
        </div>
    </div>
</template>

<style>
.coin-changer-tutorial__div--container {
    width: 100%;
    height: 100%;
    /* background-color: rgba(0, 0, 255, 0.378); */
    position: absolute;
    z-index: 50;
    display: flex;
    justify-content: center;
    top: -23px;
    left: 0;
    pointer-events: none;
}

.coin-changer-tutorial__div--container-animation {
    width: 280px;
    height: 100%;
    /* background-color: rgba(255, 0, 0, 0.458); */
    position: relative;
}

.coin-changer-tutorial__div--deposit-coin-animation {
    width: 90px;
    height: 90px;
    border-radius: 100%;
    border: solid 3px white;
    position: absolute;
    top: 83px;
    left: 95px;
    box-shadow: inset 0px 0px 59px -1px rgba(255, 255, 255, 0.75);
    animation: depositCoinAnimation 3s infinite;
}

@keyframes depositCoinAnimation {
    0% {
        transform: scale(1.2);
    }

    100% {
        transform: scale(0);
    }
}

.coin-changer-tutorial__div--coin-silver {
    background-image: url('../../img/globals/silver-coin.png');
    width: 50px;
    height: 50px;
    border-radius: 100%;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    bottom: 110px;
    left: 40px;
    animation: coinSilverAnimation 6s infinite;
}

@keyframes coinSilverAnimation {
    0% {
        transform: translate(0px, 0px);
    }

    50% {
        transform: translate(75px, -340px);
    }

    100% {
        transform: translate(75px, -338px);
    }
}

.coin-changer-tutorial__div--coin-bronze {
    background-image: url('../../img/globals/bronze-coin.png');
    width: 50px;
    height: 50px;
    border-radius: 100%;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    bottom: 110px;
    right: 35px;
    animation: coinBronzeAnimation 6s infinite;
}

@keyframes coinBronzeAnimation {
    0% {
        transform: translate(0px, 0px);
    }

    50% {
        transform: translate(0px, 0px);
    }

    100% {
        transform: translate(-77px, -338px);
    }
}

.coin-changer-tutorial__img--mouse {
    position: relative;
    width: 20px;
    height: 23px;
}
</style>