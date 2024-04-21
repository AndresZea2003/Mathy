<script setup>

//Importacion de imagenes
import planet1 from '../../../../public/images/planets/planet-1.png';
import planet2 from '../../../../public/images/planets/planet-2.png';
import planet3 from '../../../../public/images/planets/planet-3.png';
import exoplanet1 from '../../../../public/images/planets/exoplanet-1.png';
import exoplanet2 from '../../../../public/images/planets/exoplanet-2.png';
import asteroid from '../../../../public/images/globals/asteroid.png';


//Emits
const emit = defineEmits(['homeScreenExit']);

const closeHomeScreen = () => {
    emit('homeScreenExit', false);
};

</script>

<template>
    <div class="home-screen__div--container">
        <div class="home-screen__div--content">
            <button @click="closeHomeScreen" class="home-screen__button--continuar">Continuar</button>
            <img class="home-screen__img--planet1" :src="planet1" alt="planet" />
            <img class="home-screen__img--planet2" :src="planet2" alt="planet" />
            <img class="home-screen__img--asteroid" :src="asteroid" alt="asteroids" />
            <div class="home-screen__div--planet3">
                <img class="home-screen__img--planet3" :src="planet3" alt="planet" />
                <img class="home-screen__img--exoplanet1" :src="exoplanet1" alt="planet" />
                <img class="home-screen__img--exoplanet2" :src="exoplanet2" alt="planet" />
            </div>
        </div>
    </div>
</template>

<style>
.home-screen__div--container {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    /* background-color: red; */
    z-index: 55;
    backdrop-filter: blur(10px);
    display: flex;
    justify-content: center;
    align-items: center;
    animation: blurAnimation 5s;
}

@keyframes blurAnimation {
    0% {
        backdrop-filter: blur(2px);
    }

    100% {
        backdrop-filter: blur(10px);
    }
}


.home-screen__div--content {
    width: 300px;
    height: 300px;
    /* background-color: blue; */
    display: flex;
    align-items: center;
    justify-content: center;
}


.home-screen__button--continuar {
    width: 100px;
    height: 100px;
    background-color: rgb(219, 219, 0);
    border-radius: 100%;
    box-shadow: 0px 0px 72px 5px rgba(246, 255, 0, 0.75);
    font-family: 'Julius Sans One', sans-serif;
    font-weight: 600;
    transition: ease-in-out 0.2s;
    animation: sunAnimation 5s linear infinite;
}

.home-screen__button--continuar:hover {
    transform: scale(1.2);
    color: blue;
    font-weight: 900;
}

@keyframes sunAnimation {
    0% {
        box-shadow: 0px 0px 72px 5px rgb(246, 255, 0);
    }

    50% {
        box-shadow: 0px 0px 219px 121px rgba(246, 255, 0, 0.642);
    }

    100% {
        box-shadow: 0px 0px 72px 5px rgb(246, 255, 0);
    }
}

.home-screen__img--planet1 {
    position: absolute;
    width: 20px;
    /* transform: translate(-100%, -100%) rotate(360deg) ; */
    animation: orbit 15s linear infinite;
}

@keyframes orbit {
    0% {
        transform: rotate(0deg) translateX(100px) rotate(0deg);
    }

    100% {
        transform: rotate(360deg) translateX(100px) rotate(-360deg);
    }
}

.home-screen__img--planet2 {
    position: absolute;
    width: 25px;
    /* transform: translate(-100%, -100%) rotate(360deg) ; */
    animation: orbit2 13s linear infinite;
}

@keyframes orbit2 {
    0% {
        transform: rotate(0deg) translateX(150px) rotate(0deg);
    }

    100% {
        transform: rotate(360deg) translateX(150px) rotate(-360deg);
    }
}

.home-screen__div--planet3 {
    transform: translateX(140px);
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    animation: orbit3 30s linear infinite;
}

.home-screen__img--planet3 {
    position: relative;
    width: 40px;
}

.home-screen__img--asteroid {
    position: absolute;
    width: 95px;
    /* transform: translate(-100%, -100%) rotate(360deg) ; */
    animation: asteroid 34s linear infinite;
}

@keyframes asteroid {
    0% {
        transform: rotate(0deg) translateX(320px) rotate(270deg);
    }

    100% {
        transform: rotate(360deg) translateX(320px) rotate(270deg);
    }
}

@keyframes orbit3 {
    0% {
        transform: rotate(0deg) translateX(250px) rotate(0deg);
    }

    100% {
        transform: rotate(360deg) translateX(250px) rotate(-360deg);
    }
}


.home-screen__img--exoplanet1 {
    position: absolute;
    width: 10px;
    animation: exoplanet1 9s linear infinite;
}

@keyframes exoplanet1 {
    0% {
        transform: rotate(0deg) translateX(40px) rotate(0deg);
    }

    100% {
        transform: rotate(360deg) translateX(40px) rotate(-360deg);
    }
}

.home-screen__img--exoplanet2 {
    position: absolute;
    width: 10px;
    animation: exoplanet2 13s linear infinite;
}


@keyframes exoplanet2 {
    0% {
        transform: rotate(0deg) translateX(60px) rotate(0deg);
    }

    100% {
        transform: rotate(360deg) translateX(60px) rotate(-360deg);
    }
}
</style>