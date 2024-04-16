<script setup>
//Ref
import { onMounted, onUpdated, ref } from 'vue';

//Componentes
import CoinChangerScreen from '../Coin Changer/CoinChangerScreen.vue';
import ShotingStar from '../../../components/background/ShotingStar.vue';


//Props
const props = defineProps({
    storageSilver: String,
    storageBronze: String,
    goldenExchange: Number,
    silverExchange: Number,
    guide: Boolean
});

console.log("storageSilver", props.storageSilver);

const silverCoins = ref(localStorage.getItem(props.storageSilver));
const bronzeCoins = ref(localStorage.getItem(props.storageBronze));


//Ref para definir el tamaño del div padre y convertirlo a tamaño de pantalla.
const responsiveScreen = ref(false);
const widthRef = ref(null);

//Width limite
let widthLimit = 550;

//Funcion que compara el tamaño con el tamaño limite para elegir el componente a mostrar.
const calculatedResponsive = () => {
    if (parseInt(widthRef.value) < widthLimit) {
        responsiveScreen.value = false;
    } else if (parseInt(widthRef.value) >= widthLimit) {
        responsiveScreen.value = true;
    };
};

//On mounted que se ejecuta antes de montar el componente que calcula el tamaño del componente padre.
onMounted(() => {
    let divClassWidth = document.querySelector('.coin-changer__div--container');

    widthRef.value = divClassWidth.offsetWidth;

    calculatedResponsive();
});


//on update que se ejecuta cuando se actualiza el tamaño del componente para cambiar a el componente que se debe mostrar.
onUpdated(() => {
    calculatedResponsive();
});
</script>

<template>
    <div class="coin-changer__div--container relative w-full h-full rounded-md overflow-hidden">
        <div
            class="coin-changer__div--space-background w-full h-full absolute top-0 left-0 bg-cover bg-center z-0 overflow-hidden bg-center">
        </div>
        <ShotingStar />
        <CoinChangerScreen :silverCoins="silverCoins" :bronzeCoins="bronzeCoins" :goldenExchange="props.goldenExchange"
            :silverExchange="props.silverExchange" :guide="props.guide" />
    </div>
</template>

<style scoped>
.coin-changer__div--container {
    background: linear-gradient(180deg, #001250 0%, #101112 100%);
}

.coin-changer__div--space-background {
    background-image: url('../../../../../public/images/coin-change/coin-change-background.png');
}
</style>