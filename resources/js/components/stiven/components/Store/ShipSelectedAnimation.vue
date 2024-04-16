<script setup>
import { store_data } from "../../lib/store_data";
import { onBeforeMount, ref } from "vue";

//Importacion de imagenes
import check from '../../img/store/check.png';

//Importacion de sonidos
import shipSound from '../../audio/store/gravity-ship.mp3';
import selectedSound from '../../audio/store/selected-ship-sound.mp3';

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


//Sonido que se ejecuta al montarse el componente
const shipEffectSound = () => {
    const audio = new Audio(shipSound);

    audio.volume = 0.5;

    audio.play();
};

//Sonido que se ejecuta al momento de ell check de la nave seleccionada
const checkEffectSound = () => {
    const audio = new Audio(selectedSound);

    audio.volume = 0.5;

    audio.play();
};

shipEffectSound();

setTimeout(() => {
    checkEffectSound();
}, 5000);

</script>

<template>
    <div class="ship-selected-animation__div--container w-full h-full absolute top-0 left-0 z-40 flex justify-content-center align-items-center z-50">
        <div class="ship-selected-animation__div--space w-full h-full absolute top-0 left-0 z-40 flex justify-content-center align-items-center z-50">
            <div class="ship-selected-animation__div--container-animation">
                <div class="ship-selected-animation__div--wake w-10 absolute"></div>
                <img class="ship-selected-img-ship w-60 absolute z-50" :src="ship.img" alt="ship"/>
                <div class="ship-selected-animation__div--circle-1 rounded-full flex justify-content-center align-items-center" :style="`background-color: ${backgroundColorTier().color1}`">
                    <div class="ship-selected-animation__div--circle-2 relative  rounded-full flex justify-content-center align-items-center" :style="`background-color: ${backgroundColorTier().color2}`">
                        <img class="ship-selected-animation__img--check w-full absolute z-40" :src="check" alt="check"/>
                        <div class="ship-selected-animation__div--circle-3 rounded-full flex justify-content-center align-items-center" :style="`background-color: ${backgroundColorTier().color3}`">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Estilos container principal */
.ship-selected-animation__div--container {
    background: linear-gradient(180deg, #001250 0%, #101112 100%);
}

/* Estilos div que contiene imagenes del espacio */
.ship-selected-animation__div--space {
    background: url('../../img/store/space-store.png');
    background-size: cover;
    background-position: center;
    animation: launchAnimationBackground 7s linear;
}

@keyframes launchAnimationBackground {
    0% {
        opacity: 0%;
    }
    25% {
        opacity: 100%;
    }
    75% {
        opacity: 100%;
    }
    100% {
        opacity: 0%;
    }
}
/* Estilos que contiene los elementos de la animacion */
.ship-selected-animation__div--container-animation {
    position: relative;
    width: 850px;
    height: 400px;
}

/* Estilos de los circulos */
.ship-selected-animation__div--circle-1 {
    width: 400px;
    height: 400px;
    position: absolute;
    right: 20px;
    animation: transformAnimation 1s linear;
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

/* Estilos del icono de check */
.ship-selected-animation__img--check {
    opacity: 0;
    animation: checkOpacityAnimation 1s linear;
    animation-delay: 5s;
    animation-fill-mode: forwards;
    z-index: 60;
}

@keyframes checkOpacityAnimation {
    0% {
        opacity: 0%;
    }
    100% {
        opacity: 100%;
    }
}

/* Estilos de la estela */
.ship-selected-animation__div--wake {
    top: 291px;
    /* top: 235px; */
    left: -300px;
    height: 30px;
    transform: rotate(-6deg);
    background: linear-gradient(to right, #001150aa 0%, rgba(252, 252, 252, 0.707) 42%, rgba(255,255,255,1) 100%);
    background-size: 500%;
    border-radius: 100px;
    animation: wakeAnimation 7s linear;
}

@keyframes wakeAnimation {
    0% {
        width: 10px;
        top: 291px;
        opacity: 100%;

    }
    60% {
        width: 823px;
        top: 235px;
        opacity: 100%;
    }
    70% {
        width: 823px;
        top: 235px;
        opacity: 0%;
    }
    100% {
        width: 400px;
        top: 235px;
        opacity: 0%;
    }
}

/* Estilos de la nave */
.ship-selected-img-ship {
    left: -300px;
    top: 170px;
    transform: rotate(398deg);
    animation: shipAnimation 7s linear;
}



@keyframes shipAnimation {
    0% {
        left: -300px;
        top: 170px;
        transform: rotate(398deg);
    }
    60% {
        left: 510px;
        top: 75px;
        transform: rotate(398deg);
    }
    100% {
        left: 510px;
        top: 75px;
        transform: rotate(580deg);
    }
}


</style>