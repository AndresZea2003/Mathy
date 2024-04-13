<script setup>
import { onBeforeMount, onUpdated, ref } from 'vue';

//Componentes
import Store from './components/Store/Store.vue';
import Menu from './components/Menu/Menu.vue';
import CoinChanger from './components/Coin Changer/CoinChanger.vue';
// import DrawActivity from './components/DrawActivity/DrawActivity.vue';
// import DrawActivity2 from './components/DrawActivity/DrawActivity2.vue';
import TemplateDrawActivity from './components/DrawActivity/TemplateDrawActivity.vue';
import TemplateDrawActivityFree from './components/DrawActivity/TemplateDrawActivityFree.vue';


//Datos componente store
const unlockedShips = [1, 2, 3, 4, 5];




//Datos componente menu

//Datos del localStorage de niveles desbloqueados
localStorage.setItem("unlockedLevels", [1, 2, 3, 4]);

//Datos array
const arrayAccess = [
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



//Datos para el componente de canjeo

localStorage.setItem('goldCoins', 3);
localStorage.setItem('silverCoins', 5);
localStorage.setItem('bronzeCoins', 5);
localStorage.setItem('tutorial', false);


//Datos para el componente pintar

//Importacion de imagen ejemplo
import exampleImage from './img/Draw-image/cat.png';
import drawImage from './img/Draw-image/draw-image.png';


const drawActivity1 = {
    colorPalette: ['rgb(136, 149, 162)', 'rgb(225, 115, 140)'],
    exampleImage: exampleImage,
    canvas: [ 62, 38,],
    colorParts: ['rgb(136, 149, 162)', 'rgb(225, 115, 140)'],
    correctPercentage: [0.21, 0.40],
    drawImage: drawImage
};

import drawImageFree from './img/Draw-image/draw-image-free.png';

const drawActivityFree1 = {
    colorPalette: ['rgb(0, 255, 10)', 'rgb(0, 10, 253)', 'rgb(255, 245, 0)'],
    drawImage: drawImageFree,
    correctPercentage: [0.70],
};
</script>



<template>
    <!-- <Store :currentShipStorage="'shipSelected'" :unlockedShips="unlockedShips" :storageGold="'goldCoins'"/> -->
    <!-- <Pruebas/> -->
     <Menu :arrayAccess="arrayAccess" :currentShipStorage="'shipSelected'" :unlockedLevelsStorage="'unlockedLevels'"/>
    <!-- <div class="coin-changer--container">
        <CoinChanger :storageBronze="'bronzeCoins'" :storageSilver="'silverCoins'" :storageGold="'goldCoins'"  :goldenExchange="3" :silverExchange="3" :guide="true"/>
    </div> -->


    <!-- <TemplateDrawActivity :drawActivity="drawActivity1"/> -->
    <TemplateDrawActivityFree :drawActivity="drawActivityFree1"/>
    <!-- <DrawActivity /> -->
    <!-- <DrawActivity2/> -->
</template>

<style scoped>
.coin-changer--container {
    width: 700px;
    /* width: 300px; */
    height: 600px; /*Dejar en tamaño actual para evitar bugs.*/
}
</style>