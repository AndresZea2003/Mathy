<script setup>
import { onBeforeMount, onUpdated, ref, watchEffect } from 'vue';

//Importacion de sonidos
import hoverAudio from '../../../../../public/audios/effects/audioHoverStandard.mp3';
import clickAudio from '../../../../../public/audios/effects/audioClickStandard.mp3';


//Importacion de imagenes
import selectedShipImage from '../../../../../public/images/store/selected-ship.png';
import unlockedShipImage from '../../../../../public/images/store/unlocked-ship.png';


//Props
const props = defineProps({
    ship: Object,
    currentShip: Number,
    unlockedShips: Array,
    changeCards: Number
});


console.log("unlocked ships", props.unlockedShips);

//Ref que controla si la nave esta elegida actualmente.
const currentShip = ref(false);


//Code nuevo
const currentShipChange = ref(props.changeCards);


//Efecto watch que observa los cambios y cuando cambia le da un valor al ref para efectuar el cambio en las tarjetas.
watchEffect(() => {
    currentShipChange.value = props.changeCards;
});

const unlockedShip = ref(false);


//Ejecutamos un before mount que compruebe si la nave actual es la elegida.
onBeforeMount(() => {
    if (parseInt(props.currentShip) === props.ship.id) {
        currentShip.value = true;
    };

    if (props.unlockedShips.includes(props.ship.id)) {
        unlockedShip.value = true;
    };
});

//On updated que toma el valor de la tarjeta elegida para asi mostrar en pantalla tarjeta elegida marcada.
onUpdated(() => {
    if (props.changeCards === props.ship.id) {
        currentShip.value = true;
    } else {
        currentShip.value = false;
    };

    if (props.unlockedShips.includes(props.ship.id)) {
        unlockedShip.value = true;
    };
});



//Ref que controla el borde de la tarjeta segun su tier.
const border = ref("cards__div--container-tier-1");

//Depende del tier se dispondra el fondo de la tarjeta
if (props.ship.tier === 1) {
    border.value = "cards__div--container-tier-1";
} else if (props.ship.tier === 2) {
    border.value = "cards__div--container-tier-2";
} else if (props.ship.tier === 3) {
    border.value = "cards__div--container-tier-3";
} else if (props.ship.tier === 4) {
    border.value = "cards__div--container-tier-4";
}

const emit = defineEmits(['selectedShip']);


//Función que selecciona la nave para el emit
const selectedShip = (ship) => {
    emit('selectedShip', ship);
    clickEffectSound();
};


//Funcion que ejecuta el sonido de el hover en la tarjeta
const hoverEffectSound = () => {
    const audio = new Audio(hoverAudio);

    audio.play();
};


//Funcion que ejecuta el audio al darle click a la tarjeta
const clickEffectSound = () => {
    const audio = new Audio(clickAudio);

    audio.play();
};

</script>

<template>
    <div @mouseenter="hoverEffectSound" @click="selectedShip(props.ship)"
        :class="`${border} cards__div--container w-28 h-40 mx-auto flex items-center justify-center bg-cover bg-center rounded-2xl lg:w-36 lg:h-52 cursor-pointer`">
        <div
            class="main__div--inside rounded-2xl flex items-center justify-center relative duration-300 hover:bg-indigo-800 transition-all">
            <img v-show="unlockedShip" class="w-8 absolute top-1" :src="unlockedShipImage" alt="unlocked-ship" />
            <img v-show="currentShip" class="w-3/4" :src="selectedShipImage" alt="selected-ship" />
            <img class="main__img--elipse-g absolute w-5/6 mx-auto  transition-all duration-500 ease-in-out"
                :src="props.ship.elipseg" alt="big-elipse" />
            <img class="main__img--elipse absolute w-5/6 mx-auto  transition-all duration-500 ease-in-out"
                :src="props.ship.elipse" alt="elipse" />
            <img class="main__img--ship absolute mx-auto .main__img--ship w-5/6" :src="props.ship.img" alt="ship" />
            <p class="absolute bottom-1 text-green-500">{{ props.ship.name }}</p>
        </div>
    </div>
</template>

<style scoped>
/* estilos para tier 1 */
.cards__div--container-tier-1 {
    background: linear-gradient(45deg, #6a6a6a, #6a6a6a, #6a6a6a, #6a6a6a, #ffffff, #6a6a6a, #6a6a6a, #6a6a6a, #6a6a6a);
    background-size: 600% 600%;
    animation: gradientAnimation 5s infinite;
}

/* estilos para tier 2 */
.cards__div--container-tier-2 {
    background: linear-gradient(45deg, #51ff00, #51ff00, #51ff00, #51ff00, #ffffff, #51ff00, #51ff00, #51ff00, #51ff00);
    background-size: 600% 600%;
    animation: gradientAnimation 5s infinite;
}

/* estilos para tier 3 */
.cards__div--container-tier-3 {
    background: linear-gradient(45deg, #002aff, #002aff, #002aff, #002aff, #ffffff, #002aff, #002aff, #002aff, #002aff);
    background-size: 600% 600%;
    animation: gradientAnimation 5s infinite;
}

/* estilos para tier 4 */
.cards__div--container-tier-4 {
    background: linear-gradient(45deg, #fbff00, #fbff00, #fbff00, #fbff00, #ffffff, #fbff00, #fbff00, #fbff00, #fbff00);
    background-size: 600% 600%;
    animation: gradientAnimation 5s infinite;
}

@keyframes gradientAnimation {
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

.main__div--inside {
    width: 95%;
    height: 95%;
    background-color: #02124A;
}

.main__div--inside:hover {
    background-color: #090081;
}


/* estilos animacion elipses giratorios */
.main__img--elipse-g {
    animation: spinAnimation 5s infinite;
}

@keyframes spinAnimation {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

.main__img--elipse {
    animation: spinAnimation2 5s infinite;
}

@keyframes spinAnimation2 {
    0% {
        transform: rotate(360deg);
    }

    100% {
        transform: rotate(0deg);
    }
}

/* estilos nave */
.main__img--ship {
    transform: rotate(270deg);
}

.cards__div--container:hover .main__img--ship {
    animation: hoverShipAnimation 5s infinite;
}

@keyframes hoverShipAnimation {
    0% {
        transform: translateX(0px) rotate(270deg);
        ;
    }

    25% {
        transform: translateX(20px) rotate(275deg);
        ;
    }

    75% {
        transform: translateX(-20px) rotate(265deg);
        ;
    }

    100% {
        transform: translateX(0px) rotate(270deg);
        ;
    }
}
</style>