<script setup>
import { ref } from 'vue';
//Importacion imagenes
import naveIMG from '../../../../../public/images/store/nave.png';
import shotingStar from '../../../../../public/images/globals/shoting-star.png';
import back from '../../../../../public/images/globals/Arrow 15.png';

//Importación componentes
import ShotingStar from '../../../components/background/ShotingStar.vue';
import MainCard from './MainCard.vue';
import Cards from './Cards.vue';
import ShipSelectedAnimation from './ShipSelectedAnimation.vue';
import CoinCounter from './CoinCounter.vue';
import HomeScreen from '../../../components/background/HomeScreen.vue';



//Importacion de datos de la tienda.
import { standardShip, store_data } from '../../../use/store_data';
import ShipSelectedAnimationMobile from './ShipSelectedAnimationMobile.vue';


//Importacion de naves desbloqueadas
import { unlockedShips } from '../../../use/actions';





const props = defineProps({
    current_ship_storage: String,
    // unlockedShips: Array,
    storage_gold: String
});

// console.log("current_ship_storage", props.current_ship_storage);

const currentShip = localStorage.getItem(props.current_ship_storage);

//Ref que maneja la nave seleccionada para mostrar
const selectedShipRef = ref(0);

//Ref que controla el cambio de las tarjetas cuando se elige una en main card.
const changeCardsRef = ref(0);

//Ref que controla el estado de la animacion que aparece al elegir una nave
const shipSelectedAnimation = ref(false);

//Ref que maneja el estado de la pantalla de home-screen
const homeScreenExit = ref(true);

//Función que maneja el evento que recibe el id de la nave elegida por el usuario para mostrar.
const selectedShip = (event) => {
    selectedShipRef.value = event;
};


//Funcion para volver atras
const backTo = () => {
    window.location = localStorage.getItem('currentLocation');
};


//Funcion que controla el cambio de las tarjetas para actualizarlas.
const changeCards = (event) => {
    changeCardsRef.value = event;

    //Asignamos un timer para desactivar la animacion y finalizar el componente.
    shipSelectedAnimation.value = true;
    setTimeout(() => {
        shipSelectedAnimation.value = false;
    }, 7000);
};


//Funcion que controla el ancho de pantalla
const ajustarAnchoDePantalla = () => {
    let result;

    //Obtener el ancho de la ventana del navegador
    let widthScreen = window.innerWidth;

    //Proporcionar un limite para el punto de quiebre entre mobile y pantallas grandes
    let screenLimit = 850;

    if (widthScreen > screenLimit) {
        result = true;
    } else if (widthScreen < screenLimit) {
        result = false;
    }

    return result
};


const closeScreenHome = (event) => {
    homeScreenExit.value = event;
};


//Asignamos a una variable el resultado de la funcion que determina con un boleano si la pantalla esta ancha o pequeña.
let responsiveScreen = ajustarAnchoDePantalla();

</script>

<template>
    <div class="store__div--container w-full h-screen relative overflow-hidden">
        <HomeScreen v-if="homeScreenExit" @homeScreenExit="closeScreenHome" />
        <CoinCounter :storage_gold="props.storage_gold" />
        <ShipSelectedAnimation v-if="shipSelectedAnimation && responsiveScreen == true" />
        <ShipSelectedAnimationMobile v-else-if="shipSelectedAnimation && responsiveScreen == false" />
        <button @click="backTo"
            class="absolute z-40 transition-all top-1 left-1 border-2 border-slate-400 rounded flex items-center cursor-pointer lg:top-7 lg:left-7  hover:scale-125"><img
                class="w-14 p-1" :src="back" alt="back" /></button>
        <div class="store__div--space-background w-full h-full absolute top-0 left-0 bg-cover bg-center z-0"></div>
        <div class="store__div--container--title w-64 top-30 text-center mx-auto relative text-white pt-2 mt-4">
            <h2 class="text-2xl">COHETELANDIA</h2>
            <img class="w-12 top-6 right-1 absolute transform -rotate-45" :src="naveIMG" alt="nave" />
            <img class="w-52 absolute top-11 right-18" :src="shotingStar" alt="shoting-star" />
        </div>
        <!-- componente estrellas fugaces -->
        <ShotingStar />
        <!-- tarjetas para mostrar y vender las naves -->
        <div class="top-8 relative z-40 lg:flex lg:items-center lg:flex-row-reverse lg:h-4/5">
            <div class="lg:flex lg:items-center lg:absolute lg:right-0 lg:top-0 lg:w-1/4 lg:h-full">
                <!-- tarjeta estandar cuando una nave no esta elegida -->
                <MainCard :ship="standardShip" v-if="selectedShipRef === 0" />
                <!-- tarjeta de nave animada cuando se elige una carta -->
                <MainCard @changeCards="changeCards" v-else :ship="selectedShipRef" :currentShip="currentShip"
                    :unlockedShips="unlockedShips" :changeCards="changeCardsRef"
                    :current_ship_storage="props.current_ship_storage" />
            </div>
            <div
                class="store__div--container-cards relative top-6 h-80  grid gap-3 p-3 overflow-auto lg:w-7/12 lg:absolute lg:left-20 lg:top-16  lg:h-4/5 ">
                <Cards v-for="ship in store_data" :key="ship.id" :ship="ship" :unlockedShips="unlockedShips"
                    :currentShip="currentShip" @selected-ship="selectedShip" :changeCards="changeCardsRef" />
            </div>
        </div>
    </div>
</template>

<style scoped>
/*Estilo container principal */
.store__div--container {
    background: linear-gradient(180deg, #001250 0%, #101112 100%);
}

.store__div--container-cards::-webkit-scrollbar {
    width: 5px;
    position: absolute;
}

.store__div--container-cards::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 10px;
    position: absolute;
}

.store__div--container-cards::-webkit-scrollbar-track {
    background: transparent;
    position: absolute;
}

/* Estilos imagen de fondo con planetas y estrellas */
.store__div--space-background {
    background-image: url('../../../../../public/images/store/space-store.png');
}

/*Estilos titulo */
.store__div--container--title {
    font-family: 'Julius Sans One', sans-serif;
}

/* Estilos para el grid de las tarjetas automaticamente responsive */
.store__div--container-cards {
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
}

@media screen and (min-width: 1300px) {
    .store__div--container-cards {
        grid-template-columns: repeat(5, minmax(0, 1fr));
    }
}
</style>
