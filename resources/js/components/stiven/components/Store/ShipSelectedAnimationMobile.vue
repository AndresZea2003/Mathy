<script setup>
import { store_data } from "@/lib/store_data";
import { onBeforeMount, ref } from "vue";

//Importacion de imagenes
import check from '../../img/store/check.png';

//Ref que controla la posicion de la nave en el array que el usuario tiene.
const shipPositionArray = ref(0);

//Ref para guardar la nave encontrada.
const ship = ref(store_data[0]);


onBeforeMount(() => {

    //Buscamos la nave con el id de la nave actual.
    for (let i = 0; i < store_data.length; i++) {
        if(store_data[i].id === parseInt(localStorage.getItem('shipSelected'))){
            shipPositionArray.value = i;
        }
    };


    //Guardamos en el ref la nave encontrada.
    ship.value = store_data[shipPositionArray.value];
});


const backgroundColorTier = () => {
    let color1, color2, color3;

    if(ship.value.tier === 1){
        color1 = "rgb(126, 126, 126)";
        color2 = "rgb(173, 173, 173)";
        color3 = "rgb(209, 209, 209)";
    }else if(ship.value.tier === 2){
        color1 = "rgb(39, 232, 0)";
        color2 = "rgb(31, 186, 0)";
        color3 = "rgb(20, 120, 0)";
    }else if(ship.value.tier === 3){
        color1 = "rgb(33, 0, 223)";
        color2 = "rgb(25, 0, 164)";
        color3 = "rgb(21, 0, 137)";
    }else if(ship.value.tier === 4){
        color1 = "rgb(234, 223, 0)";
        color2 = "rgb(191, 181, 0)";
        color3 = "rgb(157, 149, 0)";
    };

    return {
        color1: color1,
        color2: color2,
        color3: color3
    };
};



</script>

<template>
    <div class="ship-selected-animation__div--container w-full h-full absolute top-0 left-0 z-40 flex justify-content-center align-items-center z-50">
        <div class="ship-selected-animation__div--circle-1 rounded-full flex justify-content-center align-items-center" :style="`background-color: ${backgroundColorTier().color1}`">
            <div class="ship-selected-animation__div--circle-2 relative  rounded-full flex justify-content-center align-items-center" :style="`background-color: ${backgroundColorTier().color2}`">
                <img class="ship-selected-animation__img--check w-full absolute z-40" :src="check" alt="check"/>
                <div class="ship-selected-animation__div--circle-3 rounded-full flex justify-content-center align-items-center" :style="`background-color: ${backgroundColorTier().color3}`">
                    <img class="w-96" :src="ship.img" alt="ship"/>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Estilos container principal */
.ship-selected-animation__div--container {
    background: url('../../img/menu/stars.png');
    background-size: cover;
    background-position: center;
    animation: launchAnimationBackground 7s linear;
}

@keyframes launchAnimationBackground {
    0% {
        background-color: rgba(0, 0, 0, 0.293);
    }
    25% {
        background-color: rgb(0, 0, 0);
    }
    75% {
        background-color: rgb(0, 0, 0);
    }
    100% {
        background-color: rgba(0, 0, 0, 0);
    }
}

/* Estilos circulos */
.ship-selected-animation__div--circle-1 {
    width: 400px;
    height: 400px;
    animation: transformAnimation 3s linear;
}

@keyframes transformAnimation {
    0% {
        transform: scale(0);
    }
    25% {
        transform: scale(0.5);
    }
    100% {
        transform: scale(1);
    }
}

.ship-selected-animation__div--circle-2 {
    width: 80%;
    height: 80%;
}

.ship-selected-animation__div--circle-3 {
    width: 80%;
    height: 80%;
}

/* Estilos icono de check */
.ship-selected-animation__img--check {
    opacity: 0;
    animation: checkOpacityAnimation 1s linear;
    animation-delay: 3s;
    animation-fill-mode: forwards
}

@keyframes checkOpacityAnimation {
    0% {
        opacity: 0%;
    }
    100% {
        opacity: 100%;
    }
}

</style>