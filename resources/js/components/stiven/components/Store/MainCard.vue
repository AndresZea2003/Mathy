<script setup>
import { onBeforeMount, onUpdated, ref } from 'vue';


//Importacion de imagenes
import check from '../../img/store/check.png';
import padlock from '../../img/store/padlock.png';

//Importacion de sonidos
import gravitySound from '../../audio/store/gravity-ship-2.mp3';
import clickSound from '../../audio/global/audio-click-standard.mp3';


//Props
const props = defineProps({
    ship: Object,
    currentShip: Number,
    unlockedShips: Array,
    changeCards: Number,
    currentShipStorage: String
});

//Ref que controla si se muestran el humo, las estrellas y el boton.
const shouldShowContent = ref(false);
//Ref que controla el borde de la tarjeta segun su tier.
const border = ref("cards__div--container-tier-1");
//Ref que controla la clase de la imagen estandar y las naves para ejecutar la animación
const classAnimation = ref("main__img--ship-standard");
//Ref para definir si esta nave ya esta elegida por el usuario.}
const lockedSelectedButton = ref("locked");
//Ref para manejar la nave electa actual
const currentShipRef = ref(props.currentShip);
//Ref para manejar el sonido de gravedad de la nave y que no se ejecute en momentos donde no debe hacerlo.
const gravityEffectSoundRef = ref(true);


let animationList = ["main__img--ship-animation-1", "main__img--ship-animation-2", "main__img--ship-animation-3"];


//Funcion que se ejecuta al montarse el componente que representa la animacion de la nave.
const gravityEffectSound = () => {
    const audio = new Audio(gravitySound);

    audio.volume = 0.2;

    setTimeout(() => {
        audio.play();
    }, 1000);
}

//Sonido que se ejecuta al hacer click en el boton de seleccionar la nave
const clickEffectSound = () => {
    const audio = new Audio(clickSound);

    audio.volume = 0.5;

    audio.play();
}



//funcion que devuelve una clase random para la animacion de la nave
const shipRandomAnimation = () => {
    let result;

    if ( gravityEffectSoundRef.value ) {
        gravityEffectSound();
    }


    let randomNum = Math.floor(Math.random() * animationList.length);

    result = animationList[randomNum];

    setTimeout(() => {
        result = "main__img--ship-animation-1";
    }, 5000);

    // return animationList[randomNum];
    // return "main__img--ship-animation-3";
    return result;
};



//Estado que determina antes del montaje del componente que no se muestren las estrellas, humo y boton de la tarjeta antes de ser montado.
onBeforeMount(() => {
    // Verificar el valor de props.ship.tier antes de montar el componente
    if (props.ship.tier === false) {
        shouldShowContent.value = false;
        classAnimation.value = "main__img--ship-standard";
    } else {
        shouldShowContent.value = true;
        classAnimation.value = "main__img--ship-animation";
    }


    //Verificar si recibimos la lista de naves en los props ejecutamos los condicionales para asignar un boton, un candado o el check dependiendod de la necesidad.
    if(props.unlockedShips){
        if(parseInt(currentShipRef.value) === props.ship.id){
            lockedSelectedButton.value = "check";
        }else if(!props.unlockedShips.includes(props.ship.id)){
            lockedSelectedButton.value = "locked";
        }else if(props.unlockedShips.includes(props.ship.id)){
            lockedSelectedButton.value = "button";
        };
    };

    if(props.ship.tier === 0){
        border.value = "cards__div--container-tier-1";
        classAnimation.value = "main__img--ship-standard";
    }else if(props.ship.tier === 1){
        border.value = "cards__div--container-tier-1";
        classAnimation.value = shipRandomAnimation();

    }else if(props.ship.tier === 2){
        border.value = "cards__div--container-tier-2";
        classAnimation.value = shipRandomAnimation();
    }else if(props.ship.tier === 3){
        border.value = "cards__div--container-tier-3";
        classAnimation.value = shipRandomAnimation();
    }else if(props.ship.tier === 4){
        border.value = "cards__div--container-tier-4";
        classAnimation.value = shipRandomAnimation();
    }

});




//Ejecutando el onUpdated para validar el borde del main card
onUpdated(() => {

    if ( gravityEffectSoundRef.value ) {
        gravityEffectSound();
    }

//Depende del tier se dispondra el fondo de la tarjeta y la aniamcion de aterrizaje del cohete
    if(props.ship.tier === 0){
        border.value = "cards__div--container-tier-1";
        classAnimation.value = "main__img--ship-standard";
    }else if(props.ship.tier === 1){
        border.value = "cards__div--container-tier-1";
        classAnimation.value = shipRandomAnimation();
    }else if(props.ship.tier === 2){
        border.value = "cards__div--container-tier-2";
        classAnimation.value = shipRandomAnimation();
    }else if(props.ship.tier === 3){
        border.value = "cards__div--container-tier-3";
        classAnimation.value = shipRandomAnimation();
    }else if(props.ship.tier === 4){
        border.value = "cards__div--container-tier-4";
        classAnimation.value = shipRandomAnimation();
    }


    //Verificar si la nave actual esta en uso por el usuario y si lo esta pintar de verde el boton.
    if(!props.unlockedShips.includes(props.ship.id)){
        lockedSelectedButton.value = "locked";
    }else if(props.unlockedShips.includes(props.ship.id)){
        if(props.changeCards === 0){
            if(parseInt(currentShipRef.value) === props.ship.id){
                lockedSelectedButton.value = "check";
            }else{
                lockedSelectedButton.value = "button";
            }
        }else{
            if(parseInt(currentShipRef.value) === props.ship.id){
                lockedSelectedButton.value = "check";
            }else{
                lockedSelectedButton.value = "button";
            }
        }
    };
});

//Configurando emits para actualizar las tarjetas.
const emit = defineEmits(['changeCards']);

//Función que se ejecuta si al darle click al boton de la tarjeta principal
const clickButtonMaincard = () => {
    clickEffectSound();
    localStorage.setItem(props.currentShipStorage, props.ship.id);
    emit('changeCards', props.ship.id);
    currentShipRef.value = props.ship.id;
    //Segmento de codigo que establece el ref en false para que no se ejecute el sonido en momentos donde no debe hacerlo.
    gravityEffectSoundRef.value = false;
    setTimeout(() => {
        gravityEffectSoundRef.value = true;
    }, 1000);
};

</script>

<template>
    <div :class="`${border} main__div--container w-40 h-52 mx-auto flex items-center justify-center bg-cover bg-center rounded-2xl lg:w-64 lg:h-96`" :key="props.ship.name">
        <div class="main__div--inside rounded-2xl flex items-center justify-center relative">
            <p v-show="shouldShowContent" class="text-green-500 absolute top-2 left-2">{{ props.ship.name }}</p>
            <img v-show="shouldShowContent" class="main__img--stars absolute w-5/6 mx-auto inset-0 transition-all duration-500 ease-in-out" :src="props.ship.stars" alt="stars"/>
            <img v-show="shouldShowContent" class="absolute mx-auto inset-0 w-9/12" :src="props.ship.smoke" alt="smoke"/>
            <img :class="`${classAnimation} absolute mx-auto .main__img--ship w-5/6`" :src="props.ship.img" alt="ship"/>
            <button v-if="lockedSelectedButton === 'button'"  @click="clickButtonMaincard" v-show="shouldShowContent" class="main__button absolute bottom-2 mx-auto w-10 h-10 rounded-full border-4 border-white shadow-button-shadow animate-buttonAnimation transition-all duration-500 ease-in-out hover:bg-indigo-800"></button>
            <img class="w-10 absolute bottom-2" v-show="shouldShowContent"  v-else-if="lockedSelectedButton ==='locked'" :src="padlock" alt="padlock"/>
            <img class="w-10 absolute bottom-2" v-show="shouldShowContent"  v-else-if="lockedSelectedButton ==='check'" :src="check" alt="check"/>
        </div>
    </div>
</template>

<style scoped>
.cards__div--container-tier-1 {
    background: linear-gradient(45deg,#6a6a6a, #6a6a6a, #6a6a6a,  #6a6a6a, #ffffff, #6a6a6a, #6a6a6a, #6a6a6a, #6a6a6a);
    background-size: 600% 600%;
    animation: gradientAnimation 5s infinite;
}

/* estilos para tier 2 */
.cards__div--container-tier-2 {
    background: linear-gradient(45deg,#51ff00, #51ff00, #51ff00,  #51ff00, #ffffff, #51ff00, #51ff00, #51ff00, #51ff00);
    background-size: 600% 600%;
    animation: gradientAnimation 5s infinite;
}

/* estilos para tier 3 */
.cards__div--container-tier-3 {
    background: linear-gradient(45deg,#002aff, #002aff, #002aff,  #002aff, #ffffff, #002aff, #002aff, #002aff, #002aff);
    background-size: 600% 600%;
    animation: gradientAnimation 5s infinite;
}

/* estilos para tier 4 */
.cards__div--container-tier-4 {
    background: linear-gradient(45deg,#fbff00, #fbff00, #fbff00,  #fbff00, #ffffff, #fbff00, #fbff00, #fbff00, #fbff00);
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

/* Estilos fondo azul de la tarjeta */
.main__div--inside {
    width: 95%;
    height: 95%;
    background-color: #02124A;
}

/* Animacion estrellas */
.main__img--stars {
    animation: starsAnimation 5s infinite linear;
}

@keyframes starsAnimation {
    0% {
        top: 0;
        left: 0;
    }
    25% {
        top: 10px;
        left: 0;
    }
    50% {
        top: 0;
        left: 10px;
    }
    75% {
        top: -10px;
        left: 0;
    }
    100% {
        top: 0;
        left: 0;
    }
}


/* Estilos para la imagen estandar sin animacion */
.main__img--ship-standard {
    transform: rotate(270deg);
}

/* Estilos para darle animacion a la nave */
.main__img--ship-animation-1 {
    /* transform: rotate(210deg); */
    animation: landingShipAnimation-1 3s ease-in-out forwards;
    transition: ease-in-out 3s;
}

@keyframes landingShipAnimation-1 {
    0% {
        transform: rotate(0deg);
        filter: drop-shadow(0 0 40px rgba(255, 255, 255, 0.77));
    }
    100% {
        transform: rotate(210deg);
        filter: drop-shadow(0 0 0px rgba(255, 255, 255, 0.77));
    }
}


.main__img--ship-animation-2 {
    transform: rotate(315deg);
    animation: landingShipAnimation-2 3s ease-in-out forwards;
    transition: ease-in-out 3s;
}

@keyframes landingShipAnimation-2 {
    0% {
        transform: rotate(0deg);
        filter: drop-shadow(0 0 40px rgba(255, 255, 255, 0.77));
    }
    100% {
        transform: rotate(115deg);
        filter: drop-shadow(0 0 0px rgba(255, 255, 255, 0.77));
    }
}


.main__img--ship-animation-3 {
    transform: rotate(315deg);
    animation: landingShipAnimation-3 3s ease-in-out forwards;
    transition: ease-in-out 3s;
}

@keyframes landingShipAnimation-3 {
    0% {
        transform: rotate(0deg);
        filter: drop-shadow(0 0 40px rgba(255, 255, 255, 0.77));
    }
    100% {
        transform: rotate(315deg);
        filter: drop-shadow(0 0 0px rgba(255, 255, 255, 0.77));
    }
}


.main__img--ship-animation-4 {
    transform: rotate(315deg);
    animation: landingShipAnimation-4 3s ease-in-out forwards;
    transition: ease-in-out 3s;
}

@keyframes landingShipAnimation-4 {
    0% {
        transform: rotate(0deg);
        filter: drop-shadow(0 0 40px rgba(255, 255, 255, 0.77));
    }
    100% {
        transform: rotate(180deg);
        filter: drop-shadow(0 0 0px rgba(255, 255, 255, 0.77));
    }
}

.main__img--ship-animation-5 {
    transform: rotate(315deg);
    animation: landingShipAnimation-5 3s ease-in-out forwards;
    transition: ease-in-out 3s;
}

@keyframes landingShipAnimation-5 {
    0% {
        transform: rotate(0deg);
        filter: drop-shadow(0 0 40px rgba(255, 255, 255, 0.77));
    }
    100% {
        transform: rotate(10deg);
        filter: drop-shadow(0 0 0px rgba(255, 255, 255, 0.77));
    }
}

/* Estilos animacion de boton de selección */
.main__button {
    background-color: #02124A;
    animation: buttonAnimation 3s infinite linear;
}

@keyframes buttonAnimation {
    0% {
        box-shadow: 0px 0px 15px 5px rgba(255, 255, 255, 0.75);
    }
    50% {
        box-shadow: 0px 0px 15px 15px rgba(255, 255, 255, 0.75);
    }
    100% {
        box-shadow: 0px 0px 15px 5px rgba(255, 255, 255, 0.75);
    }
}

</style>