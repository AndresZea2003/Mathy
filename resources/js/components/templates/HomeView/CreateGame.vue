<script setup>
import { onMounted, ref } from 'vue';

//Imagenes
import logo from '../../../../../public/images/globals/main-logo.png';

//Ref
const inputName = ref('');
const backgroundInputColorRef = ref('');

//Cuentas del storage
let storageCounts = ref('');

//Emits
const emit = defineEmits(['introAnimationActive']);


let backgroundInputColors = [
    {
        background: 'rgb(255, 0, 0)',
        text: 'rgb(255, 255, 255)'
    },
    {
        background: 'rgb(255, 213, 0)',
        text: 'rgb(47, 0, 255)'
    },
    {
        background: 'rgb(96, 214, 0)',
        text: 'rgb(47, 0, 255)'
    },
    {
        background: 'rgb(0, 247, 255)',
        text: 'rgb(47, 0, 255)'
    },
    {
        background: 'rgb(145, 0, 0)',
        text: 'rgb(255, 255, 255)'
    },
    {
        background: 'rgb(167, 0, 200)',
        text: 'rgb(255, 255, 255)'
    },
    {
        background: 'rgb(123, 86, 255)',
        text: 'rgb(255, 255, 255)'
    },
    {
        background: 'rgb(29, 0, 132)',
        text: 'rgb(255, 255, 255)'
    },
    {
        background: 'rgb(91, 255, 85)',
        text: 'rgb(16, 0, 123)'
    },
    {
        background: 'rgb(153, 255, 0)',
        text: 'rgb(16, 0, 123)',
    },
    {
        background: 'rgb(255, 187, 0)',
        text: 'rgb(16, 0, 123)',
    },
    {
        background: 'rgb(255, 98, 0)',
        text: 'rgb(255, 255, 255)',
    },
    {
        background: 'rgb(255, 255, 255)',
        text: 'rgb(0, 0, 0)',
    },
    {
        background: 'rgb(0, 0, 0)',
        text: 'rgb(255, 255, 255)',
    }
];

const randomSelectedColor = () => {
    let backgroundInputColorBackup = [...backgroundInputColors];

    if(backgroundInputColors.length > 0){
        for (let i = 0; i < storageCounts.value.length; i++) {
            for (let j = 0; j < backgroundInputColors.length; j++) {
                if(storageCounts.value[i].inputColor.background == backgroundInputColors[j].background ){
                    console.log("cantidad de colores back" ,backgroundInputColors.length,"storageCounts.value[j].inputColor.background", storageCounts.value[i].inputColor.background,  "backgroundInputColors[i].background",backgroundInputColors[j].background);
                    backgroundInputColors.splice(j, 1);
                };
            };
        };
    };

    // console.log("storage", storageCounts.value[0].inputColor);
    console.log("Colores restantes",backgroundInputColors.length);

    if(backgroundInputColors.length === 0){
        console.log("Se acabaron los colores");
        let randonNum = Math.floor(Math.random() * backgroundInputColorBackup.length);
        backgroundInputColorRef.value = backgroundInputColorBackup[randonNum];
    }else if(backgroundInputColors.length > 0){
        let randonNum = Math.floor(Math.random() * backgroundInputColors.length);

        backgroundInputColorRef.value = backgroundInputColors[randonNum];
    };
};

onMounted(() => {
    //Traemos las cuentas en la store.
    storageCounts.value = JSON.parse(localStorage.getItem('games'));
    randomSelectedColor();
});


const createGame = () => {
    let templateObject = {
        name: inputName.value,
        inputColor: {background: backgroundInputColorRef.value.background, text: backgroundInputColorRef.value.text},
        currentLevel:[0, 0],
        unlockedLevels: [1],
        shipSelected: 1,
        goldenCoins: 0,
        silverCoins: 0,
        bronzeCoins: 3,
    }

    let localStorageContent = JSON.parse(localStorage.getItem('games'));

    localStorageContent.push(templateObject);

    localStorage.setItem('games', JSON.stringify(localStorageContent));
    emit('introAnimationActive', true);
};

</script>


<template>
    <div class="w-64 h-80 flex justify-center items-center flex-col xl:bottom-9 z-10">
        <img class="w-48 absolute top-24" :src="logo" alt="logo"/>
        <div class="flex justify-center items-center flex-col relative top-7">
            <label for="text-input" class="create-game__font--julius text-white text-xl mt-20 xl:text-2xl">NOMBRE</label>
            <input class="create-game__font--julius w-64 border-white border rounded-2xl font-bold h-8 text-center text-white" id="text-input" v-model="inputName" type="text" :style="{backgroundColor: backgroundInputColorRef.background, color: backgroundInputColorRef.text}">
        </div>
        <button class="create-game__font--julius bg-blue-950 w-40 h-8 text-white border-white relative top-7 border rounded-md mt-20 xl:w-52 xl:h-10 hover:bg-white hover:text-black xl:" @click="createGame">
            Continuar
        </button>

    </div>
</template>


<style scoped>
.create-game__font--julius {
    font-family: 'Julius Sans One', sans-serif;
}

.create {
    color: rgb(0, 0, 0);
    color: rgb(255, 255, 255);
}

</style>