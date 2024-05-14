<script setup>
import { onMounted, ref } from 'vue';

//Imagenes
import ship from '../../../../../public/images/rockets/Cohetes-13.gif';
import robot from '../../../../../public/images/characters/robot/robot.png';
import conection from '../../../../../public/images/home/conection.png';
import shipStatic from '../../../../../public/images/rockets/Cohetes-13.svg';

let gamer = localStorage.getItem('gamer');

//Ref
const planetColor = ref('');
const shipAnimation1 = ref(true);
const shipAnimation2 = ref(false);
const robotRocket = ref(false);

const getPlanetColor = () => {
    let games = JSON.parse(localStorage.getItem('games'));

    for (let i = 0; i < games.length; i++) {
        if(gamer === games[i].name){
            planetColor.value = games[i].inputColor.background;
        }
    }
};

onMounted(() => {
    getPlanetColor();
});

setTimeout(() => {
    shipAnimation1.value = ref(false);
    shipAnimation2.value = ref(true);

    // setTimeout(() => {
    //     shipAnimation2.value = ref(false);
    // }, 7000);

}, 5000);

setTimeout(() => {
    robotRocket.value = true;
}, 10000);




</script>

<template>
    <div class="welcome-name__img--galaxy w-full h-full overflow-hidden z-10">
        <img v-if="shipAnimation1" class="welcome-name__img--ship w-80" :src="ship" alt="ship"/>
        <div class="welcome-name__div--planet" :style="{background: planetColor, boxShadow: `0px 0px 40px 3px ${planetColor}`}"></div>

        <div class="welcome-name__div--robot-rocket w-60 absolute m-auto left-0 right-0">
            <img v-if="shipAnimation2" class="welcome-name__img--ship-1" :src="ship" alt="ship-2"/>
            <img v-if="robotRocket" class="welcome-name__img--conection w-28 absolute  bottom-14 left-10 xl:w-40" :src="conection" alt="conection"/>
            <img v-if="robotRocket" class="welcome-name__img--ship-static w-60 absolute" :src="shipStatic" alt="ship"/>
            <img v-if="robotRocket" class="welcome-name__img--robot w-40 relative bottom-4 left-24 xl:w-60" :src="robot" alt="robot"/>
        </div>

    </div>
</template>

<style scoped>

/* Galaxia */
.welcome-name__img--galaxy {
    overflow: hidden;
    background-image: url('../../../../../public/images/backgrounds/space.jpg');
    background-size: cover;
    background-position: center;
    animation: galaxiaAnimation 1s linear;
}


.welcome-name__img--ship {
    transform: rotate(170deg);
    animation: shipAnimation 4s linear;
    animation-fill-mode: forwards;
}

@keyframes shipAnimation {
    0% {
        transform: translate(-260px, -240px) rotate(160deg);
    }


    100% {
        transform: translate(360px, 370px)  rotate(130deg);
    }
}

.welcome-name__img--ship-1 {
    width: 490px;
    margin: auto;
    position: absolute;
    transform: translateY(200px);
    animation: ship2Animation 1s linear;
    animation-fill-mode: forwards;
}

@keyframes ship2Animation {
    0% {
        transform: translate(-76px, 100px) scale(1.4);
    }

    100% {
        transform: translate(-76px, -30px) scale(1.4);
    }
}


.welcome-name__div--planet {
    background-color: white;
    width: 800px;
    height: 800px;
    border-radius: 100%;
    position: absolute;
    top: -500px;
    right: -650px;
}


.welcome-name__div--robot-rocket  {
    top: 450px;
}

.welcome-name__img--conection {
    left: -150;
    animation: robotLineAnimation 6s infinite linear;
}

@keyframes robotLineAnimation {
    0% {
        transform: translate(0px, -10px);
    }

    40% {
        transform: translate(0px, 0px);
    }

    60% {
        transform: translate(0px, 0px);
    }

    100% {
        transform: translate(0px, -10px);
    }
}

.welcome-name__img--ship-static {
    transform: rotate(-45deg);
    left: -80px;
    bottom: -40px;
    animation: ship3Animation 6s infinite linear;
}

@keyframes ship3Animation {
    0% {
        transform: translate(0px, -10px) rotate(-45deg);
    }

    40% {
        transform: translate(0px, 0px) rotate(-45deg);
    }

    60% {
        transform: translate(0px, 0px) rotate(-45deg);
    }

    100% {
        transform: translate(0px, -10px) rotate(-45deg);
    }
}


.welcome-name__img--robot {
    animation: robotAnimation 6s infinite linear;
}

@keyframes robotAnimation {
    0% {
        transform: rotate(0deg) translate(0px, -10px);
    }

    20% {
        transform: rotate(10deg) translate(0px, -5px);
    }

    80% {
        transform: rotate(-10deg) translate(0px, -5px);
    }

    100% {
        transform: rotate(0deg) translate(0px, -10px);
    }
}



</style>