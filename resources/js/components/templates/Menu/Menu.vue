<script setup>
//Importacion componentes
import { ref } from 'vue';

//Impportacion de componentes.
import ShotingStar from '../../background/ShotingStar.vue';
import Asteroids from '../../background/AsteroidsAnimation.vue';
import GridMobile from './GridMobile.vue';
import GridScreen from './GridScreen.vue';
import HomeScreen from '../../background/HomeScreen.vue';

//Props
const props = defineProps({
    arrayAccess: Array, required: false,
    currentShipStorage: String,
    unlocked_levels_storage: String,
    test: String
});



const currentShip = ref(localStorage.getItem(props.currentShipStorage));

//Ref que controla los componentes segun el tamaño de pantalla.
const responsiveGrid = ref(false);

//Ref que maneja el estado de la pantalla de home-screen
const homeScreenExit = ref(true);


const ajustarAnchoDePantalla = () => {
    //Obtener el ancho de la ventana del navegador
    let widthScreen = window.innerWidth;

    //Proporcionar un limite para el punto de quiebre entre mobile y pantallas grandes
    let screenLimit = 1000;

    if(widthScreen > screenLimit){
        responsiveGrid.value = true;
    }else if(widthScreen < screenLimit){
        responsiveGrid.value = false;

    }
}

const closeScreenHome = (event) => {
    homeScreenExit.value = event;
};


// Llamar a la función al cargar la página y cuando se redimensiona la ventana
window.addEventListener('resize', ajustarAnchoDePantalla);

console.log("Prueba");

let testArrayAccess = [
    {
        level: 1,
        location: "",
        img: "https://cdn.pixabay.com/photo/2022/05/12/16/04/trees-7191822_1280.png",
        style: "linear-gradient(45deg,#00c8ff, #ffffff, #00c8ff,  #ffffff, #ffffff, #00c8ff, #fffffd, #00c8ff, #ffffff)"
    },
    {
        level: 2,
        location: "",
        img: "https://cdn.pixabay.com/photo/2020/02/16/05/59/alien-4852662_1280.jpg",
        style: "linear-gradient(45deg,#b57300, #ffc60b, #ffffff,  #b57300, #ffffff, #ffc60b, #fffffd, #ffc60b, #b57300)"
    },
    {
        level: 3,
        location: "https://cdn.pixabay.com/photo/2018/04/21/01/36/green-3337499_1280.png",
        img: "https://cdn.pixabay.com/photo/2018/04/21/01/36/green-3337499_1280.png",
        style: "linear-gradient(45deg,#00b591, #0bffff, #ffffff,  #00b591, #0bffff, #00b591, #fffffd, #0bffff, #00b591)"
    },
    {
        level: 4,
        location: "",
        img: "https://cdn.pixabay.com/photo/2021/07/15/05/06/flowers-6467492_1280.jpg",
        style: "linear-gradient(45deg,#fa73ff, #f8ccff, #ffffff,  #f8ccff, #fa73ff, #ffffff, #f8ccff, #fa73ff, #fa73ff)"
    },
    {
        level: 5,
        location: "",
        img: "https://cdn.pixabay.com/photo/2016/11/21/03/56/landscape-1844230_1280.png",
        style: "linear-gradient(45deg,#ff9e30, #e226ff, #ffffff,  #ff9e30, #ff9e30, #ff9e30, #ffffff, #e226ff, #ff9e30)"
    },
    {
        level: 6,
        location: "",
        img: "https://cdn.pixabay.com/photo/2012/08/27/14/19/mountains-55067_1280.png",
        style: "linear-gradient(45deg,#ffe11b, #4e2254, #ffffff,  #ffe11b, #4e2254, #ffffff, #4e2254, #ffe11b, #ffe11b)"
    },
    {
        level: 7,
        location: "",
        img: "https://cdn.pixabay.com/photo/2019/12/17/12/00/cave-4701500_1280.png",
        style: "linear-gradient(45deg,#002871, #0f3eb4, #ffffff,  #0f3eb4, #002871, #0f3eb4, #ffffff, #0f3eb4, #002871)"
    },
    {
        level: 8,
        location: "",
        img: "https://cdn.pixabay.com/photo/2017/04/23/14/23/mountains-2253940_1280.jpg",
        style: "linear-gradient(45deg,#860069, #ff22d6, #ffffff,  #ff22d6, #ffffff, #ff22d6, #860069, #860069, #ff22d6)"
    },
    {
        level: 9,
        location: "",
        img: "https://cdn.pixabay.com/photo/2022/07/19/10/15/sea-7331682_1280.jpg",
        style: "linear-gradient(45deg,#fa37d0, #ffb1f1, #ffffff,  #fa37d0, #ffb1f1, #ffffff, #fa37d0, #ffb1f1, #ffffff)"

    },
    {
        level: 10,
        location: "",
        img: "https://cdn.pixabay.com/photo/2016/11/21/03/56/landscape-1844226_1280.png",
        style: "linear-gradient(45deg,#000c79, #2d65ff, #ffffff,  #000c79, #2d65ff, #ffffff, #000c79, #2d65ff, #ffffff)"
    },
    {
        level: 11,
        location: "",
        img: "https://cdn.pixabay.com/photo/2020/04/30/10/08/desert-5112222_1280.png",
        style: "linear-gradient(45deg,#f7ff08, #ffce2d, #ffffff,  #ffce2d, #f7ff08, #f7ff08, #ffce2d, #ffffff, #ffce2d)"
    },
    {
        level: 12,
        location: "",
        img: "https://cdn.pixabay.com/photo/2014/03/23/00/22/the-background-293017_1280.png",
        style: "linear-gradient(45deg,#ff0808, #970000, #ffffff,  #970000, #970000, #ff0808, #ffffff, #ff0808, #970000)"
    },
    {
        level: 13,
        location: "",
        img: "https://cdn.pixabay.com/photo/2017/01/31/13/36/landscape-2024099_1280.png",
        style: "linear-gradient(45deg,#96c0ff, #7092ff, #ffffff,  #7092ff, #96c0ff, #ffffff, #7092ff, #96c0ff, #ffffff)"
    },
    {
        level: 14,
        location: "",
        img: "https://cdn.pixabay.com/photo/2019/10/13/19/45/boat-4547083_640.png",
        style: "linear-gradient(45deg,#7994ff, #00c20a, #ffffff,  #00c20a, #7994ff, #00c20a, #ffffff, #00c20a, #7994ff)"
    },
    {
        level: 15,
        location: "",
        img: "https://cdn.pixabay.com/photo/2017/08/06/11/29/the-desert-2591554_1280.png",
        style: "linear-gradient(45deg,#ffe629, #fff75d, #ffffff,  #fff75d, #ffe629, #ffffff, #ffe629, #fff75d, #ffffff)"
    },
    {
        level: 16,
        location: "",
        img: "https://cdn.pixabay.com/photo/2019/11/27/19/03/landscape-4657646_640.jpg",
        style: "linear-gradient(45deg,#ff29ff, #86008b, #ffffff,  #86008b, #ff29ff, #ffffff, #ff29ff, #86008b, #ffffff)"
    },
    {
        level: 17,
        location: "",
        img: "https://cdn.pixabay.com/photo/2017/04/24/09/25/horse-2255876_1280.jpg",
        style: "linear-gradient(45deg,#dfd400, #a59700, #ffffff,  #a59700, #dfd400, #dfd400, #a59700, #dfd400, #ffffff)"
    },
    {
        level: 18,
        location: "",
        img: "https://cdn.pixabay.com/photo/2017/04/24/15/25/robot-2256814_1280.jpg",
        style: "linear-gradient(45deg,#8e8e8e, #bbbbbb, #ffffff,  #bbbbbb, #8e8e8e, #ffffff, #bbbbbb, #8e8e8e, #ffffff)"
    }
];
</script>

<template>
    <div class="menu__div--container w-full h-full relative overflow-hidden">
        <div class="store__div--space-background w-full h-full absolute top-0 left-0 bg-cover bg-center z-0"></div>
        <HomeScreen v-if="homeScreenExit" @homeScreenExit="closeScreenHome"/>
        <!-- componente estrellas fugaces -->
        <ShotingStar/>
        <!-- componente asteroides -->
        <Asteroids/>
        <div class="menu__div--mati-motas-colores border-4 border-cyan-600 w-full mx-auto relative top-5 rounded rounded-4 h-24 sm:w-72 flex flex-col items-center justify-center text-center">
            <p class="menu__p--salva-los p-2">Salva los</p>
            <div class="menu__div--container-colores flex items-center Class text-xl">
                <p class="c text-red-500">C</p><p class="o text-blue-500">O</p><p class="l text-green-500">L</p><p class="o text-yellow-500">O</p><p class="r text-red-500">R</p><p class="e text-violet-500">E</p><p class="s text-green-500">S</p>
            </div>
            <p class="menu__p--con-mati-motas text-sky-400 p-2">Con <span class="menu__p--con-mati-motas-yellow">Mati</span> y <span class="menu__p--con-mati-motas-yellow">Motas</span></p>
        </div>

        <div>
            {{ ajustarAnchoDePantalla() }}
            <grid-screen :currentShip="currentShip" :arrayAccess="testArrayAccess" :unlockedLevelsStorage="props.unlocked_levels_storage" v-if="responsiveGrid"/>
            <grid-mobile :currentShip="currentShip" :arrayAccess="testArrayAccess" :unlockedLevelsStorage="props.unlocked_levels_storage" v-else/>
        </div>
    </div>
</template>

<style scoped>
/* Estilos del container principal */
.menu__div--container {
    background: linear-gradient(180deg, #02124A 38.33%, #540061 100%);
}

/* Estilos de la imagen del fondo */
.store__div--space-background {
    background-image: url('../../../../../public/images/menu/space-menu.png');
}


/* Estilos contenedor salva los colores */
.menu__div--mati-motas-colores {
    background-color: #02124A;
    color: aliceblue;
}

.menu__div--container-colores {
    font-family: 'ZCOOL KuaiLe', sans-serif;
}

/* Estilos para la animacion de la palabra colores */
@keyframes coloresAnimation {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

.c, .o, .l, .o, .r, .e, .s {
    display: inline-block;
    animation: coloresAnimation 1s infinite alternate;
}

.o {
    animation-delay: 0.1s;
}

.l {
    animation-delay: 0.2s;
}

.r {
    animation-delay: 0.3s;
}

.e {
    animation-delay: 0.4s;
}

.s {
    animation-delay: 0.5s;
}

.menu__p--salva-los {
    font-family: 'ZCOOL KuaiLe', sans-serif;
    color: #0FF;
}

.menu__p--con-mati-motas {
    font-family: 'ZCOOL KuaiLe', sans-serif;
    color: #0FF;
}

.menu__p--con-mati-motas-yellow {
    font-family: 'ZCOOL KuaiLe', sans-serif;
    color: #FFE500;
}

</style>