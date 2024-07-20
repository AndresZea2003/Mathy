<script setup>
//Ref
import { onBeforeMount, onMounted, onUpdated, ref } from 'vue';

//Componentes
import CoinChangerScreen from '../Coin Changer/CoinChangerScreen.vue';
import ShotingStar from '../../../components/background/ShotingStar.vue';
import { getUsersLocalStorage } from '../../../use';


//Props
const props = defineProps({
    storageSilver: String,
    storageBronze: String,
    goldenExchange: Number,
    silverExchange: Number,
    guide: Boolean
});

//Creando emits
const emit = defineEmits(['coinChangerClose', 'updateCoins']);


const silverCoins = ref(getUsersLocalStorage().silverCoins);
const bronzeCoins = ref(getUsersLocalStorage().bronzeCoins);


//Ref para definir el tamaño del div padre y convertirlo a tamaño de pantalla.
const responsiveScreen = ref(false);
const widthRef = ref(null);
const coinChangerAutoRef = ref(false);

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

onBeforeMount(() => {
    coinChangerAutoRef.value = getUsersLocalStorage().coinChangerAuto;
});

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


//Funcion para cerrar el coinChanger
const closeCoinChanger = (event) => {
    emit('coinChangerClose', event);
};

//Emit para actualizar
const updateCoins = (event) => {
    emit('updateCoins', event);
};

</script>

<template>
    <div class="coin-changer__div--container relative w-full h-full overflow-hidden">
        <div
            class="coin-changer__div--space-background w-full h-full absolute top-0 left-0 bg-cover bg-center z-0 overflow-hidden bg-center">
        </div>
        <ShotingStar />
        <CoinChangerScreen :coinChangerAuto="coinChangerAutoRef" :silverCoins="silverCoins" :bronzeCoins="bronzeCoins" :goldenExchange="props.goldenExchange"
            :silverExchange="props.silverExchange" :guide="props.guide"  @closeCoinChanger="closeCoinChanger" @updateCoins="updateCoins" />
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