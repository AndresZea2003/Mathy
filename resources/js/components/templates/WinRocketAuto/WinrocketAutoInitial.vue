<script setup>
import { ref, onBeforeMount } from "vue";

//Imagenes
import background1 from '../../../../../public/images/backgrounds/background-1.png';
import background2 from '../../../../../public/images/backgrounds/background-2.png';
import background3 from '../../../../../public/images/backgrounds/background-3.png';
import background4 from '../../../../../public/images/backgrounds/background-4.png';
import background5 from '../../../../../public/images/backgrounds/background-5.png';
import background6 from '../../../../../public/images/backgrounds/background-6.png';
import background7 from '../../../../../public/images/backgrounds/background-7.png';
import background8 from '../../../../../public/images/backgrounds/background-8.png';
import background9 from '../../../../../public/images/backgrounds/background-9.png';
import background10 from '../../../../../public/images/backgrounds/background-10.png';
import background11 from '../../../../../public/images/backgrounds/background-11.png';
import background12 from '../../../../../public/images/backgrounds/background-12.png';
import background13 from '../../../../../public/images/backgrounds/background-13.png';
import background14 from '../../../../../public/images/backgrounds/background-14.png';


//Ref
const backgroundSelected = ref("");
const rocketSelected1Ref = ref(false);

const rocketSelectedCard = ref(false);//false
const rocketSelected1 = ref(true);//true
const rocketSelected2 = ref(true);//true
const counterActive = ref(true);
const rocketsSelectedRef = ref([]);
const rocketSelected2Ref = ref(false);

//Librerias
import { initialRockets } from '../../../use/store_data';

const backgrounds = [
    background1,
    background2,
    background3,
    background4,
    background5,
    background6,
    background7,
    background8,
    background9,
    background10,
    background11,
    background12,
    background13,
    background14
];

import RocketCard from "./RocketCard.vue";
import { store_data } from "../../../use/store_data";

const randomBackground = () => {
    return backgrounds[Math.floor(Math.random() * backgrounds.length)];
};


onBeforeMount(() => {
    backgroundSelected.value = randomBackground();
});

</script>

<template>
    <div class="win-rocket-initial__div--container w-full flex justify-center items-center overflow-hidden" :style="{backgroundImage: `url(${backgroundSelected})`}">
        <div class="win-rocket-initial__div--content w-4/5 rounded-lg backdrop-blur-sm flex justify-center items-center flex-col py-5 my-5">
            <RocketCard v-if="rocketSelected1" @rocketSelected="rocketSelected" :randomShip="initialRockets[0]" :shipNum="1" :rocketSelectedRef="rocketSelected1Ref" :type="2"/>
            <RocketCard v-if="rocketSelected1" @rocketSelected="rocketSelected" :randomShip="initialRockets[0]" :shipNum="1" :rocketSelectedRef="rocketSelected1Ref" :type="2"/>
            <RocketCard v-if="rocketSelected1" @rocketSelected="rocketSelected" :randomShip="initialRockets[0]" :shipNum="1" :rocketSelectedRef="rocketSelected1Ref" :type="2"/>
            <RocketCard v-if="rocketSelected1" @rocketSelected="rocketSelected" :randomShip="initialRockets[0]" :shipNum="1" :rocketSelectedRef="rocketSelected1Ref" :type="2"/>
            <RocketCard v-if="rocketSelected1" @rocketSelected="rocketSelected" :randomShip="initialRockets[0]" :shipNum="1" :rocketSelectedRef="rocketSelected1Ref" :type="2"/>
        </div>
    </div>
</template>

<style scoped>

@media screen and (min-height: 500px) {
    .win-rocket-initial__div--container {
        height: 750px;
    }
}

@media screen and (min-width: 350px) {
    .win-rocket-initial__div--content {
        width: 320px;
    }
}

@media screen and (min-width: 1024px) {
    .win-rocket-initial__div--content {
        width: 80%;
    }
}

.win-rocket-initial__div--content {
    --glow-color: rgb(132, 0, 255);
    --glow-spread-color: rgba(111, 0, 214, 0.781);
    border: .25em solid var(--glow-color);
    box-shadow: 0 0 1em .25em var(--glow-color),
        0 0 4em 1em var(--glow-spread-color),
        inset 0 0 .75em .25em var(--glow-color);
}


</style>