<script setup>
import { onMounted, ref } from 'vue';

//Imagenes
import logo from '../../../../../public/images/globals/main-logo.png';

//Ref
const inputName = ref('');
const backgroundInputColorRef = ref('');
const iconRef = ref('');
const iconIMG = ref('');

//Librerias
import {arrayIcons} from '../../../use/userIcons';
import Swal from "sweetalert2";

//Cuentas del storage
let storageCounts = ref('');

//Emits
const emit = defineEmits(['introAnimationActive']);

//Colores tarjeta
let backgroundInputColors = [
    {
        background: 'rgb(83, 57, 255)',
        text: 'rgb(255, 255, 255)'
    },
    {
        background: 'rgb(255, 57, 57)',
        text: 'rgb(255, 255, 255)'
    },
    {
        background: 'rgb(255, 163, 57)',
        text: 'rgb(0, 0, 0)'
    },
    {
        background: 'rgb(222, 255, 57)',
        text: 'rgb(0, 0, 0)'
    },
    {
        background: 'rgb(87, 255, 57)',
        text: 'rgb(0, 0, 0)'
    },
    {
        background: 'rgb(57, 255, 242)',
        text: 'rgb(0, 0, 0)'
    },
    {
        background: 'rgb(57, 149, 255)',
        text: 'rgb(0, 0, 0)'
    },
    {
        background: 'rgb(153, 57, 255)',
        text: 'rgb(255, 255, 255)'
    },
    {
        background: 'rgb(57, 255, 176)',
        text: 'rgb(0, 0, 0)'
    },
    {
        background: 'rgb(255, 116, 57)',
        text: 'rgb(0, 0, 0)',
    },
    {
        background: 'rgb(173, 255, 57)',
        text: 'rgb(0, 0, 0)',
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
        background: 'rgb(57, 255, 133)',
        text: 'rgb(0, 0, 0)',
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
    // console.log("Colores restantes",backgroundInputColors.length);

    if(backgroundInputColors.length === 0){
        let randonNum = Math.floor(Math.random() * backgroundInputColorBackup.length);
        backgroundInputColorRef.value = backgroundInputColorBackup[randonNum];
    }else if(backgroundInputColors.length > 0){
        let randonNum = Math.floor(Math.random() * backgroundInputColors.length);

        backgroundInputColorRef.value = backgroundInputColors[randonNum];
    };
};

const randomIconColor = () => {
    let arrayIconsBackup = [...arrayIcons];

    if(arrayIcons.length > 0){
        for (let i = 0; i < storageCounts.value.length; i++) {
            for (let j = 0; j < arrayIcons.length; j++) {
                if(storageCounts.value[i].icon == arrayIcons[j].name){
                    arrayIcons.splice(j, 1);
                }
            }
        }
    };


    if(arrayIcons.length === 0){
        let randonNum = Math.floor(Math.random() * arrayIconsBackup.length);
        iconRef.value = arrayIconsBackup[randonNum].name;
        iconIMG.value = arrayIconsBackup[randonNum].img;
    }else if(arrayIcons.length > 0){
        let randonNum = Math.floor(Math.random() * arrayIcons.length);
        iconRef.value = arrayIcons[randonNum].name;
        iconIMG.value = arrayIcons[randonNum].img;
    };
};

onMounted(() => {
    //Traemos las cuentas en la store.
    if(JSON.parse(localStorage.getItem('games')) !== undefined){
        storageCounts.value = JSON.parse(localStorage.getItem('games'));
    }else if(JSON.parse(localStorage.getItem('games')) !== undefined){
        storageCounts.value = [];
        localStorage.setItem('games', JSON.stringify([]));
    };

    randomSelectedColor();
    randomIconColor();
});


const createGame = () => {
    if(inputName.value.length > 0){
        let templateObject = {
            name: inputName.value,
            inputColor: {background: backgroundInputColorRef.value.background, text: backgroundInputColorRef.value.text},
            icon: iconRef.value,
            currentLevel: {level: 1, sublevel: 1},
            coinChangerAuto: true,// true para que se despliegue automaticamente el cambiador false para hacerlo manual
            unlockedLevels: [1],
            shipSelected: 1,
            goldenCoins: 0,
            silverCoins: 0,
            bronzeCoins: 3,
            unlockedShips: [1,2,3,4,5,6,7,8,9,10]
        }

        let localStorageContent = JSON.parse(localStorage.getItem('games'));

        localStorageContent.push(templateObject);

        localStorage.setItem('games', JSON.stringify(localStorageContent));
        localStorage.setItem('gamer', inputName.value);

        emit('introAnimationActive', true);
    }else if(inputName.value.length === 0){
        //alerta si el modo borrado esta activado
        Swal.fire({
            position: 'top',
            title: "Escribe un nombre",
            timer: 3000,
            timerProgressBar: true
        });
    }
};

</script>


<template>
    <div class="w-64 h-80 flex justify-center items-center flex-col xl:bottom-9 z-10">
        <img class="w-48 absolute top-24" :src="logo" alt="logo"/>

        <img class="w-10 bg-slate-50 border border-3 border-current rounded-md p-2 absolute mb-32" :src="iconIMG" alt="icon"/>

        <div class="flex justify-center items-center flex-col relative top-7">
            <label for="text-input" class="create-game__font--julius text-white text-xl mt-20 xl:text-2xl">NOMBRE</label>
            <div class="flex justify-center items-center">
                <input class="create-game__font--julius w-64 border-white border rounded-2xl font-bold h-8 text-center text-white" id="text-input" v-model="inputName" type="text" :style="{backgroundColor: backgroundInputColorRef.background, color: backgroundInputColorRef.text}">
            </div>
        </div>

        <!-- <img class="w-10 bg-slate-50 border border-3 border-current rounded-md p-2 absolute mt-40" :src="iconIMG" alt="icon"/> -->

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
    color: rgb(57, 255, 133);
    color: rgb(0, 0, 0);
}

</style>