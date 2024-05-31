<script setup>

//Nave modelo
import ship from '../../../../../public/images/rockets/Cohetes-13.svg';
import shipAnimated from '../../../../../public/images/rockets/Cohetes-13.gif';
import robot from '../../../../../public/images/characters/robot/robot.png';
import robotTalking from '../../../../../public/images/characters/robot/talk-animation.gif';
import { onBeforeMount, ref } from 'vue';


//Refs
const robotTalkingRef = ref(true);
const robotStaticRef = ref(true);
const classRobotRef = ref("");
const shipAnimatedRef = ref(false);
const shipStaticRef = ref(true);
const classBackgroundImageRef = ref("launch-rocket__div--image");
const classBackgroundImageContainerRef = ref("launch-rocket__div--container");
const classTerrainRef = ref("launch-rocket__div--terrain");
const planetSelectedAnimation = ref("");

const levelWorlds = [
    {
        background: "launch-rocket__div--container-animation-earth",//Clase que se proporciona para la animacion de degradado del fondo
        img: "url(https://cdn.pixabay.com/photo/2022/05/12/16/04/trees-7191822_1280.png)",//Imagen tomada apra representar el fondo
        terrain: "#BCDA4C",//Color de una de las bases donde van el robot y la nave
        terrain2: "#337709"//Color secundario de la base
    },
    {
        background: "launch-rocket__div--container-animation-mars",
        img: "url(https://cdn.pixabay.com/photo/2020/02/16/05/59/alien-4852662_1280.jpg)",
        terrain: "#39211B",
        terrain2: "#A04A2E"
    },
    {
        background: "launch-rocket__div--container-animation-venus",
        img: "url(https://cdn.pixabay.com/photo/2018/04/21/01/36/green-3337499_1280.png)",
        terrain: "#0D4C41",
        terrain2: "#1B9581"
    },
    {
        background: "launch-rocket__div--container-animation-jupiter",
        img: "url(https://cdn.pixabay.com/photo/2021/07/15/05/06/flowers-6467492_1280.jpg)",
        terrain: "#F4ACB4",
        terrain2: "#FEE3E1"
    }
];

//Props
const props = defineProps({
    planet: Number
});

onBeforeMount(() => {
    planetSelectedAnimation.value = levelWorlds[props.planet - 1].background;
});


setTimeout(() => {
    robotStaticRef.value = false;
}, 4000);

setTimeout(() => {
    robotTalkingRef.value = false;
    robotStaticRef.value = true;
    setTimeout(() => {
        classRobotRef.value = "launch-rocket__div--robot-arrived";

        //Aniamcion de despegue de la nave
        setTimeout(() => {
            shipAnimatedRef.value = true;
            shipStaticRef.value = false;

            setTimeout(() => {
                classBackgroundImageRef.value = "launch-rocket__div--image-animation";
                classBackgroundImageContainerRef.value = planetSelectedAnimation.value;
                classTerrainRef.value = "launch-rocket__div--terrain-animated";
            }, 3000);
        }, 4000);
    }, 1000);
}, 10000);


</script>

<template>
    <div :class="`${classBackgroundImageContainerRef} w-full h-full relative overflow-hidden`">
        <div :class="`${classBackgroundImageRef} w-full h-full flex justify-center items-center overflow-hidden`" :style="{backgroundImage: levelWorlds[props.planet - 1].img}">
            <div class="flex items-center justify-center w-72 xl:w-96 absolute z-20 bottom-14">
                <img v-if="shipStaticRef" class="launch-rocket__div--ship relative z-40 w-60" :src="ship" alt="ship"/>
                <img v-if="shipAnimatedRef" class="launch-rocket__img--ship-animated absolute z-40" :src="shipAnimated" alt="ship-animated"/>
                <img v-if="robotStaticRef" :class="`${classRobotRef} w-28 xl:w-32 absolute bottom-8 right-2 z-20`" :src="robot" alt="robot"/>
                <img v-if="robotTalkingRef" class=" w-36 absolute right-0 bottom-6" :src="robotTalking" alt="robot"/>
            </div>
            <div :class="`${classTerrainRef} rounded-full flex justify-center items-center`" :style="{backgroundColor: levelWorlds[props.planet - 1].terrain}">
                <div class="launch-rocket__div--terrain-2 rounded-full" :style="{backgroundColor: levelWorlds[props.planet - 1].terrain2}"></div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.launch-rocket__div--image  {
    background-position: center;
    background-size:cover;
    background-repeat: no-repeat;
}


.launch-rocket__div--image-animation  {
    background-position: center;
    background-size:cover;
    background-repeat: no-repeat;
    animation: backgroundImgAnimation 7s linear;
    animation-fill-mode: forwards;

}

@keyframes backgroundImgAnimation  {
    0%{
        background-position-y: auto;
        /* opacity: 100%; */
    }

    5%{
        background-position-y: auto;
        /* opacity: 100%; */
    }

    100%{
        background-position-y: 1500px;
        /* opacity: 0%; */
    }
}

/* Planeta Tierra */
.launch-rocket__div--container-animation-earth {
    animation: containerBackgroundEarthAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundEarthAnimation {
    0%{
        background-color: #68B9F0;
    }

    60%{
        background-color: #68B9F0;
    }

    100%{
        background-color: #000000;
    }
}

/* Planeta Marte */
.launch-rocket__div--container-animation-mars {
    animation: containerBackgroundMarsAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundMarsAnimation {
    0%{
        background-color: #FC9765;
    }

    60%{
        background-color: #FC9765;
    }

    100%{
        background-color: #000000;
    }
}

/* Planeta Venus */
.launch-rocket__div--container-animation-venus {
    animation: containerBackgroundVenusAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundVenusAnimation {
    0%{
        background-color: #208A7D;
    }

    60%{
        background-color: #208A7D;
    }

    100%{
        background-color: #000000;
    }
}

/* Planeta Jupiter */
.launch-rocket__div--container-animation-jupiter {
    animation: containerBackgroundVenusAnimation 10s linear;
    animation-fill-mode: forwards;
}

@keyframes containerBackgroundVenusAnimation {
    0%{
        background-color: #F4ACB4;
    }

    60%{
        background-color: #F4ACB4;
    }

    100%{
        background-color: #000000;
    }
}

.launch-rocket__div--terrain {
    width: 1500px;
    height: 1500px;
    position: absolute;
    bottom: -1350px;
}

.launch-rocket__div--terrain-animated {
    width: 1500px;
    height: 1500px;
    position: absolute;
    bottom: -1350px;
    animation: terrainAnimation 3s linear;
    animation-fill-mode: forwards;
}

@keyframes terrainAnimation {
    0%{
        bottom: -1350px;
    }


    100%{
        bottom: -1550px;
    }
}

.launch-rocket__div--terrain-2 {
    width: 1450px;
    height: 1450px;
    position: absolute;
    transform: translateX(170px);
}

.launch-rocket__div--ship {
    transform: rotate(-45deg);
}

.launch-rocket__div--robot-arrived {
    animation: robotArrivedAnimation 3s linear;
    animation-fill-mode: forwards;
}

@keyframes robotArrivedAnimation {
    0%{
        transform: translateX(0px) scale(1);;
    }

    90%{
        transform: translateX(-150px) scale(0);
    }

    100%{
        transform: translateX(-150px) scale(0);
    }
}

.launch-rocket__img--ship-animated {
    top: -320px;
    left: 15px;
    width: 363px;
    animation: shipLaunchAnimation 3s linear;
    animation-fill-mode: forwards;
}

@keyframes shipLaunchAnimation {
    0%{
        transform: translateY(0px);
    }

    100%{
        transform: translateY(-180px);
    }
}

</style>