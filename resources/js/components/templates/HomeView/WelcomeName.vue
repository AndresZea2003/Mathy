<script setup>
import { onMounted, ref } from 'vue';

//Componentes
import AnimatedStars from '../../activities/DrawActivity/AnimatedStars.vue';

//Imagenes
import ship from '../../../../../public/images/rockets/Cohetes-13.gif';
import robot from '../../../../../public/images/characters/robot/robot.png';
import conection from '../../../../../public/images/home/conection.png';
import shipStatic from '../../../../../public/images/rockets/Cohetes-13.svg';
import satelite from '../../../../../public/images/home/satelite.png';
import asteroidBelt from '../../../../../public/images/home/asteroid-belt.png';

//Traemos datos del storage
let gamer = localStorage.getItem('gamer');

//Ref
const planetColor = ref('');
const shipAnimation1 = ref(true);
const shipAnimation2 = ref(false);
const robotRocket = ref(false);
const robotClass = ref('welcome-name__img--robot-arrived');
const conectionClass = ref('welcome-name__img--conection-arrived');
const sateliteRef = ref(false);

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
    shipAnimation1.value = false;
    shipAnimation2.value = true;

    // setTimeout(() => {
    //     shipAnimation2.value = ref(false);
    // }, 7000);

}, 5000);

setTimeout(() => {
    robotRocket.value = true;
    sateliteRef.value = true;

    setTimeout(() => {
        robotClass.value = 'welcome-name__img--robot-orbit';
        conectionClass.value = 'welcome-name__img--conection-orbit';
    }, 3200);

    setTimeout(() => {
        shipAnimation2.value = false;
    }, 3000);
}, 8000);





</script>

<template>
    <div class="welcome-name__img--galaxy w-full h-full relative z-10">
        <AnimatedStars/>
        <img class="welcome-name__img--belt-asteroids overflow-hidden" :src="asteroidBelt" alt="asteroid-belt"/>
        <img v-if="shipAnimation1" class="welcome-name__img--ship w-80" :src="ship" alt="ship"/>
        <div class="welcome-name__div--planet overflow-hidden" :style="{background: planetColor, boxShadow: `0px 0px 40px 3px ${planetColor}`}"></div>

        <img v-if="sateliteRef" class="welcome-name__img--satelite w-16 absolute" :src="satelite" alt="satelite"/>

        <div class="welcome-name__div--robot-rocket w-60 absolute m-auto left-0 right-0">
            <img v-if="shipAnimation2" class="welcome-name__img--ship-2" :src="ship" alt="ship-2"/>
            <img v-if="robotRocket" :class="`${conectionClass} w-28 absolute  bottom-14 left-10 xl:w-40`" :src="conection" alt="conection"/>
            <img v-if="robotRocket" class="welcome-name__img--ship-static w-60 z-10 absolute" :src="shipStatic" alt="ship"/>
            <img v-if="robotRocket" :class="`${robotClass} w-40 relative bottom-4 z-0 left-24 xl:w-60`" :src="robot" alt="robot"/>
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

.welcome-name__img--ship-2 {
    width: 490px;
    margin: auto;
    position: absolute;
    transform: translateY(200px);
    animation: ship2Animation 3.5s linear;
    animation-fill-mode: forwards;
}

@keyframes ship2Animation {
    0% {
        transform: translate(-76px, 400px) scale(1.4);
        opacity: 100%;
    }
    80% {
        transform: translate(-76px, -30px) scale(1.4);
        opacity: 100%;
    }

    100% {
        transform: translate(-76px, -30px) scale(1.4);
        opacity: 0%;
    }
}

.welcome-name__img--belt-asteroids {
    width: 3500px;
    max-width: none;
    position: relative;
    top: 150px;
    overflow: hidden;
    animation: asteroidAnimation 120s infinite linear;
}

@keyframes asteroidAnimation {
    0% {
        transform: translateX(0);
    }

    50% {
        transform: translateX(-500px);
    }

    100% {
        transform: translateX(0);
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


.welcome-name__img--conection-arrived {
    left: -150;
    animation: robotLineArrivedAnimation 3s linear;
}

@keyframes robotLineArrivedAnimation {
    0% {
        transform: translateX(-50px) scale(0.1);
    }

    100% {
        transform: translateX(0px) scale(1);
    }
}

.welcome-name__img--conection-orbit {
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

.welcome-name__img--robot-arrived {
    animation: robotArrivedAnimation 3s linear;
}


@keyframes robotArrivedAnimation {
    0% {
        transform: translateX(-150px) scale(0.1);
    }

    100% {
        transform: translateX(0px) scale(1);
    }
}

.welcome-name__img--robot-orbit {
    animation: robotOrbitAnimation 6s infinite linear;
}

@keyframes robotOrbitAnimation {
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

.welcome-name__img--satelite {
    animation: sateliteAnimation 12s linear;
    animation-fill-mode: forwards;
}

@keyframes sateliteAnimation {
    0% {
        transform: translate(-100px, -100px);
    }

    100% {
        transform: translate(500px, 500px);
    }
}

</style>