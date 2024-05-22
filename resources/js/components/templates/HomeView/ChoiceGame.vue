<script setup>
import { onMounted, onUpdated, ref } from 'vue';
import Swal from "sweetalert2";

let localStorageData = JSON.parse(localStorage.getItem('games'));

//Librerias
import {arrayIcons} from '../../../use/userIcons';


//Imagenes
import save from '../../../../../public/images/home/save.png';
import logo from '../../../../../public/images/globals/main-logo.png';
import deleteIMG from '../../../../../public/images/globals/delete.png';
import closeIMG from '../../../../../public/images/globals/close.png';
import closeDelete from '../../../../../public/images/globals/close-2.png';
import allUsers from '../../../../../public/images/globals/all.png';


//Emits
const emit = defineEmits(['createGameComponent', 'introAnimationActive']);

//ref
const input = ref('');
const deleteAuthorization = ref(false);
const iconDelete = ref(deleteIMG);
const mainIcon = ref(save);
const deleteMode = ref(false);
const deleteModeError = ref(false);
const classMainIconDelete = ref('');
const users = ref("");


//Funcion para borrar un usuario.
const deleteUser = (user) => {
    for (let i = 0; i < users.value.length; i++) {
        if(users.value[i].name === user){
            users.value.splice([i], 1);
            localStorage.setItem('games', JSON.stringify(users.value));
        };
    };
};

//Funcion que controla que usuario esta usando la aplicacion
const gamerSelected = (name) => {

    if(!deleteMode.value){
        localStorage.setItem('gamer', name);
        emit('introAnimationActive', true);
    }else if(deleteMode.value){
        //Logica en el modo borrado
        Swal.fire({
            title: "Quieres borrar este usuario?",
            showCancelButton: true,
            confirmButtonText: "Borrar",
            confirmButtonColor: "red"
        }).then((result) => {
            if (result.isConfirmed) {
                //Ejecutando funcion para borrar al usuario
                deleteUser(name);
                Swal.fire("Borrado con exito");
            } else if (result.isDenied) {
                Swal.fire("No se pudo borrar el usuario");
            };
        });
    };
};

//Funcion que te lleva a crear una nueva cuenta
const createGameComponent = () => {
    emit('createGameComponent', true);
};


//Funcion para borrar los usuarios del computador
const deleteFunction = () => {
    //Si el input para entrar esta abierto se cierra y cambia el icono para salir con un cesto de basura
    if(deleteAuthorization.value){
        deleteAuthorization.value = false;
        iconDelete.value = deleteIMG;

    //Si el input esta cerrado y el modo borrado esta inactivo abre el input y cambiar el boton por una equis
    }else if(!deleteAuthorization.value && !deleteMode.value){
        deleteAuthorization.value = true;
        iconDelete.value = closeIMG;

    //Si el input esta cerrado pero el modo de borrado esta activo solamente se cierra el modo de borrado y se pone el icono de cesto de basura
    }else if(!deleteAuthorization.value && deleteMode.value){
        deleteMode.value = false;
        iconDelete.value = deleteIMG;

        //alerta si el modo borrado esta desactivado
        Swal.fire({
            position: 'top',
            title: "Modo borrado desactivado",
            timer: 3000,
            timerProgressBar: true
        });
    };
};


//Borrar todos los usuarios
const deleteAllUsers = () => {
    Swal.fire({
        title: "¿quieres borrar todos los usuarios?",
        input: "text",
        inputLabel: 'Escribe lo siguiente para borrar "Borrar usuarios"',
        showCancelButton: true,
        confirmButtonText: "Borrar",
        confirmButtonColor: "red",

        inputValidator: (value) => {
                    if (!value) {
                        return 'Necesitas escribir algo';
                    }
                }
    }).then((result) => {
        if (result.isConfirmed  && result.value.toUpperCase() === "BORRAR USUARIOS") {
            //Ejecutando funcion para borrar al usuario
            localStorage.removeItem('games');
            users.value = [];
            Swal.fire("Borrado con exito");
        } else if (result.isConfirmed && result.value.toUpperCase() !== "BORRAR USUARIOS") {
            Swal.fire("No se borraron los usuarios");
        }else if(result.isDenied){
            Swal.fire("No se borraron los usuarios");
        }
    });
};


//Funcion de continuar
const continuarFunction = () => {
    if("IET" === input.value){
        deleteMode.value = true;
        deleteAuthorization.value = false;
        //alerta si el modo borrado esta activado
        Swal.fire({
            position: 'top',
            title: "Modo borrado activado",
            timer: 3000,
            timerProgressBar: true
        });
    }else if("IET" !== input.value){
        deleteModeError.value = true;
        setTimeout(() => {
            deleteModeError.value = false;
        }, 3000);
    };
};

//Onmounted
onMounted(() => {
    users.value = localStorageData;
});


//OnUpdate
onUpdated(() => {
    if(deleteMode.value){
        classMainIconDelete.value = "choice-game__div--animation-icon-delete";
        mainIcon.value = deleteIMG;
        iconDelete.value = closeDelete;
    }else if(!deleteMode.value){
        mainIcon.value = save;
        classMainIconDelete.value = "";
    };
});


//Funcion para traer los iconos en cada etiqueta
const getIcon = (name) => {
    let result;

    for (let i = 0; i < arrayIcons.length; i++) {
        if(arrayIcons[i].name === name){
            result = arrayIcons[i].img;
        };
    };

    return result;
};

</script>


<template>
    <div class="z-10 flex justify-center items-center flex-col">
        <div v-if="deleteAuthorization" class="choice-game__div--input-container flex justify-center items-center w-full h-full flex-col absolute z-20     backdrop-blur-sm">
            <label for="text-input" class="choice-game__font--julius text-white text-xl xl:text-2xl">Nombre</label>
            <label for="text-input" class="choice-game__font--julius text-white text-xl mb-3 xl:text-2xl">Institución Educativa</label>
            <input class="create-game__font--julius w-64 border-white border rounded-2xl font-bold h-8 text-center" id="text-input" v-model="input" type="text">
            <div class="mt-10 w-60 h-14 flex justify-center items-center">
                <button v-if="!deleteModeError" class="create-game__font--julius bg-blue-950 w-40 h-8 text-white border-white relative top-7 border rounded-md xl:w-52 xl:h-10 hover:bg-white hover:text-black xl:" @click="continuarFunction">
                    Continuar
                </button>
                <p v-else class="text-slate-300 absolute w-60 text-center">Revisa los datos suministrados</p>
            </div>
        </div>

        <img :class="`${classMainIconDelete} w-14 m-center`" :src="mainIcon" alt="save"/>

        <div class="w-64 h-96 z-10 backdrop-blur-sm border-2 border-blue-900 rounded-md my-3 py-3 flex flex-col justify-center items-center xl:w-80 ">
            <div class="choice-game__div--scroll w-56 my-4 overflow-x-auto xl:w-72 flex items-center flex-col">
                <button v-for="gamer, index in users" :key="index" @click="gamerSelected(gamer.name)" class="choice-game__font--julius w-52 h-14 rounded-lg border-white border my-1 m-auto font-bold text-white flex justify-between items-center xl:w-64 hover:bg-white hover:text-black hover:font-bold hover:scale-90 transition" :style="{ background: deleteMode ?('rgb(229, 62, 62)'):(gamer.inputColor.background) , color: deleteMode ? ('white'):(gamer.inputColor.text)  }">
                    <img class="w-5 ml-5" :src="getIcon(gamer.icon)" alt="icon"/>
                        {{ gamer.name }}
                    <img class="w-5 mr-5" :src="getIcon(gamer.icon)" alt="icon"/>
                </button>
                <button @click="createGameComponent()" class="choice-game__font--julius w-52 h-14 rounded-lg border-white bg-blue-950 border my-1 mx-auto text-white text-3xl xl:w-64 hover:bg-white hover:text-black hover:font-bold hover:scale-90 transition">+</button>
            </div>
        </div>
        <img class="w-40 z-50" :src="logo" alt="logo"/>

        <!-- Boton activar modo borrado -->
        <button @click="deleteFunction" class="rounded-full absolute top-3 right-3 bg-red-500 z-20 xl:top-auto xl:bottom-10 xl:right-10 hover:transition-all hover:scale-90">
            <img class="w-10 p-2 xl:w-16" :src="iconDelete" alt="delete"/>
        </button>

        <!-- boton borrar todo -->
        <button v-if="deleteMode" @click="deleteAllUsers" class="rounded-full absolute top-3 left-3 bg-blue-800 z-20 xl:top-auto xl:bottom-10 xl:left-10 hover:transition-all hover:scale-90">
            <img class="w-10 p-2 xl:w-16" :src="allUsers" alt="delete"/>
        </button>
    </div>
</template>

<style scoped>
.choice-game__font--julius {
    font-family: 'Julius Sans One', sans-serif;
}

.choice-game__div--scroll {
    overflow-y: auto;
    flex-grow: 0;
}

.choice-game__div--scroll::-webkit-scrollbar {
    width: 5px;
    position: absolute;
}

.choice-game__div--scroll::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 10px;
    position: absolute;
}

.choice-game__div--scroll::-webkit-scrollbar-track {
    background: transparent;
    position: absolute;
}

.choice-game__div--input-container {
    background-color: rgba(9, 1, 102, 0.86);
    animation: introAuthorization 0.5s linear;
}

@keyframes introAuthorization {
    0%{
        opacity: 0%;
    }

    100%{
        opacity: 100%;
    }
}

.choice-game__div--animation-icon-delete {
    animation: iconDeleteAnimation 4s infinite linear;
}

@keyframes iconDeleteAnimation  {
    0% {
        transform: scale(1);
        opacity: 80%;
    }

    50% {
        transform: scale(1.1);
        opacity: 100%;
    }

    100% {
        transform: scale(1);
        opacity: 80%;
    }

}

</style>