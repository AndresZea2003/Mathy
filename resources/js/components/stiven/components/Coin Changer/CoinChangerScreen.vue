<script setup>
import { onBeforeMount, onUpdated, ref } from 'vue';
import Draggable from 'vuedraggable';

//Importacion de componentes
import ChangeAnimation from './ChangeAnimation.vue';
import ChangeError from './ChangeError.vue';
import CoinChangerTutorial from './CoinChangerTutorial.vue';


//Importacion de imagenes
import bronzeIMG from '../../img/globals/bronze-coin.png';
import silverIMG from '../../img/globals/silver-coin.png';
import goldenIMG from '../../img/globals/gold-coin.png';
import shotingStar from '../../img/globals/shoting-star.png';
import naveIMG from '../../img/globals/nave.png';
import elipseChangerPlatform from '../../img/coin-change/elipse-changer-platform.png';
import purplePanel from '../../img/coin-change/purple-panel.png';
import panel1 from '../../img/coin-change/panel1.png';
import panel2 from '../../img/coin-change/panel2.png';
import arrow from '../../img/coin-change/flecha.png';

//Importacion de sonidos
import depositCoinSound from '../../audio/coin-changer/deposit-coin-sound.mp3';
import coinMovementSound from '../../audio/coin-changer/coin-movement.mp3';
import splendorSound1 from '../../audio/coin-changer/splendor-effect-sound1.mp3';
import splendorSound2 from '../../audio/coin-changer/splendor-effect-sound2.mp3';
import hoverEffectSound from '../../audio/global/audio-hover-standard.mp3';
import clickEffectSound from '../../audio/global/audio-click-standard.mp3';
import tunnelEffectSound from '../../audio/coin-changer/tunel-animation-sound.mp3';
import tunnelEffectSound2 from '../../audio/coin-changer/tunel-animation-sound2.mp3';
import spawnCoinEffectSound from '../../audio/coin-changer/spawn-coin-sound.mp3';
import endChangeEffectSound from '../../audio/coin-changer/end-change-sound.mp3';
import endChangeButtonEffectSound from '../../audio/coin-changer/end-button-sound.mp3'



//Props
const props = defineProps({
    silverCoins: Number,
    bronzeCoins: Number,
    goldenExchange: Number,
    silverExchange: Number,
    guide: Boolean
});




//Recibimos la cantidad de monedas
// const monedasBronce = 5;
// const monedasPlata = 6;

//Creamos los tres arrays donde funcionara la conversion.
const changeArray = ref([]);
const bronzeArray = ref([]);
const silverArray = ref([]);

//Creamos un ref que indicara cuando se inicie el proceso de conversion
const startConversion = ref(false);

//Ref que controla que tipo de moneda vamos a cambiar
const typeChange = ref(null);

//Ref que maneja el componente de error
const error = ref(false);

//Ref que vigila los cambios al hacer un dragEnd
const dragEndWatcher = ref(false);

//Ref que almacena las monedas en una capsula que se muestra en la maquina
const capsuleCoins = ref([]);

//Ref que se activa cuando esta listo para hacerse el cambio
const changeReady = ref(false);

//Ref que controla la animacion del deposito de la moneda en la maquina
const animationDepositActive = ref(false);

//Ref que controla el tipo de moneda que se esta depositando para mostrarla en la animacion de deposito
const typeCoinDeposit = ref("");

//Ref que controla el error cuando se quiere poner la moneda erronea
const errorDepositCoin = ref(false);

//Ref que controla cuando debe aparecer el boton de devolver las monedas
const returnCoins = ref(false);

//Ref que controla la moneda que muestra el boton
const coinButton = ref("");

//Ref que controla el tunel sobre el panel de monedas purpura
const coinTunnel = ref(false);

//Ref que controla las animaciones de tutorial.
const tutorialAnimation = ref(true);

//Ref que controla cuando se empieza a arrastrar un objeto o no para desactivar la animacion tutorial
const dragActive = ref(false);

const targetList = ref(null);

const dataKey = ref(null);

const sourceList = ref(null);


//Control de el dragEnd para evitar mas de una ejecucion.
const onDragEndControl = ref(true);




//Creamos un before mount que se ejecuta antes de mostrar el componente donde se convertira las monedas en objetos en un array para arrastrar.
onBeforeMount(() => {
    for (let i = 0; i < props.bronzeCoins; i++) {
        bronzeArray.value.push({
            coinId: i,
            type: "bronze",
            img: bronzeIMG
        });
    };

    for (let i = 0; i < props.silverCoins; i++) {
        silverArray.value.push({
            coinId: i,
            type: "silver",
            img: silverIMG
        });
    };

});


const tutorialAnimationActivation = () => {
    if (changeReady.value === true || errorDepositCoin.value === true || animationDepositActive.value === true || dragActive.value === true || startConversion.value === true) {
        tutorialAnimation.value = false;
    } else if (changeReady.value === false || errorDepositCoin.value === false || animationDepositActive.value === false || dragActive.value === false || startConversion.value === false) {
        tutorialAnimation.value = true;
    };
};


//Hacemos un onUpdated que ejecuta la funcion de la animacion del tutorial, que verifica todos los casos en los que la animacion debe ser ejecutada.
onUpdated(() => {
    tutorialAnimationActivation();
});







//Funcion que marca lo que pasa al inicio del arrastre del elemento
const onDragStart = (event) => {
    // Asignar el nuevo valor a la propiedad `data-target` del elemento arrastrado.
    // event.item.dataset.target = event.target.classList[0];
    sourceList.value = event.target.classList[0];

    // dataKey.value = event.item.getAttribute('data-key');

    dragActive.value = true;
    tutorialAnimationActivation();
};


// //Funcion que se ejecuta mientras se arrastra el elemento
// const onDragOver = (event) => {

//     // Obtener la lista sobre la que se encuentra el elemento arrastrado.
//     const lista = event.currentTarget.classList[0];
//     console.log("ejecutando dragover", lista);
//     targetList.value = lista;

// };


const onDragOver = (event) => {
    // Verificar si el evento es táctil
    const isTouch = event.type === 'touchmove';
    
    // Obtener la posición del toque si es un evento táctil
    const touchPosition = isTouch ? event.touches[0].clientY : null;
    
    // Obtener el elemento sobre el que se está arrastrando
    const targetElement = isTouch ? document.elementFromPoint(event.touches[0].clientX, touchPosition) : event.target;

    // Obtener la clase del elemento arrastrado.
    const lista = targetElement.classList[0];
    targetList.value = lista;
};

//Funcion para lanzar el proceso de animaciones monedas en el sistema de intercambios
const onDragEndChanger = () => {

    if (changeArray.value.length > 0) {
        typeCoinDeposit.value = changeArray.value[0].img;
        let saveCoin = changeArray.value.slice(0);
        changeArray.value = [];
        animationDepositActive.value = true;
        tutorialAnimationActivation();

        setTimeout(() => {
            animationDepositActive.value = false;
        }, 6000);

        setTimeout(() => {
            capsuleCoins.value.push(saveCoin[0]);
        }, 4000);
    };
};

// // //Funcion que se ejecuta al final del arrastre
const onDragEnd = (event) => {
    event.preventDefault();
    if(onDragEndControl.value){
        //Para evitar la ejecucion doble de la funcion en tactil se puso un timer y un control con un ref.
        onDragEndControl.value = false;
        setTimeout(() => {
            onDragEndControl.value = true;
        }, 5000);


        // const listaOrigen = event.item.dataset.target;
        const listaOrigen = sourceList.value;
        const listaDestino = targetList.value;


        let index = null;

        if (listaOrigen === "changeArray") {
            index = changeArray.value.indexOf(0);
        } else if (listaOrigen === "bronzeArray") {
            index = bronzeArray.value.indexOf(0);
        } else if (listaOrigen === "silverArray") {
            index = silverArray.value.indexOf(0);
        }



        // console.log("Index procesado index of", index);

        let elementoAMover = null;


        // Mover el elemento de la lista de origen a la lista de destino.
        if (listaOrigen === "changeArray") {
            elementoAMover = changeArray.value.splice(index, 1);
        } else if (listaOrigen === "bronzeArray" && listaDestino === "changeArray") {
            elementoAMover = bronzeArray.value.splice(index, 1);
        } else if (listaOrigen === "silverArray" && listaDestino === "changeArray") {
            elementoAMover = silverArray.value.splice(index, 1);
        }


        if (changeArray.value.length < 3 && listaDestino === "changeArray" && elementoAMover[0].type === "bronze" || changeArray.value.length < 3 && listaDestino === "changeArray" && elementoAMover[0].type === "silver") {//Ejecutamos un if que comprueba que el array para cambiar si es menor a 3 la cantidad y es moneda de bronze o plata podamos mover la moneda al array de cambio
            changeArray.value.push(elementoAMover[0]);
            depositCoinEffectsSounds();
        } else if (changeArray.value.length >= 3 && listaDestino === "changeArray" && elementoAMover[0].type === "bronze" || changeArray.value.length >= 3 && listaDestino === "changeArray" && elementoAMover[0].type === "silver") {//Si el array tiene 3 o mas elementos no permitira que se agreguen mas monedas y la moneda volvera a su array de origen
            if (listaOrigen === "bronzeArray") {
                bronzeArray.value.push(elementoAMover[0]);
            } else if (listaOrigen === "silverArray") {
                silverArray.value.push(elementoAMover[0]);
            };
        } else if (listaDestino === "bronzeArray" && elementoAMover[0].type === "bronze") {//Si queremos mover una moneda de bronce a el array de bronce lo podremos hacer
            bronzeArray.value.push(elementoAMover[0]);
        } else if (listaDestino === "silverArray" && elementoAMover[0].type === "silver") {//Si queremos mover una moneda de plata a el array de plata lo podremos hacer
            silverArray.value.push(elementoAMover[0]);
        } else if (listaDestino === "silverArray" && elementoAMover[0].type === "bronze") {//Si queremos mover una moneda de bronce a un array de plata no podrenmos y la moneda volvera a su array y nos desplegara una notificacion.
            if (listaOrigen === "bronzeArray") {
                bronzeArray.value.push(elementoAMover[0]);
            } else if (listaOrigen === "changeArray") {
                changeArray.value.push(elementoAMover[0]);
            }
            error.value = true;//Desplegamos la ventana de error donde nos muestra una aniamcion de como hacerlo bien
        } else if (listaDestino === "bronzeArray" && elementoAMover[0].type === "silver") {//Si queremos mover una moneda de plata a un array de plata no podrenmos y la moneda volvera a su array y nos desplegara una notificacion.
            if (listaOrigen === "silverArray") {
                silverArray.value.push(elementoAMover[0]);
            } else if (listaOrigen === "changeArray") {
                changeArray.value.push(elementoAMover[0]);
            }
            error.value = true;//Desplegamos la ventana de error donde nos muestra una aniamcion de como hacerlo bien
        };

        if (dragEndWatcher.value) {
            dragEndWatcher.value = false;
        } else if (!dragEndWatcher.value) {
            dragEndWatcher.value = true;
        }


        if (capsuleCoins.value.length === 0 && listaDestino === "changeArray") {
            onDragEndChanger();
        } else if (capsuleCoins.value.length > 0) {
            if (capsuleCoins.value[0].type === elementoAMover[0].type) {
                onDragEndChanger();

                //Verificacion de si se tienen la cantidad de monedas requeridas de bronce o plata se mostraran nuevas animaciones en la interfaz
                if (capsuleCoins.value.length + 1 === props.goldenExchange && capsuleCoins.value[0].type === "silver" || capsuleCoins.value.length + 1 === props.silverExchange && capsuleCoins.value[0].type === "bronze") {

                    //Verificamos que monedas queremos cambiar y hacemos que se muestre en el boton
                    if (capsuleCoins.value[0].type === "bronze") {
                        coinButton.value = silverIMG;
                    } else if (capsuleCoins.value[0].type === "silver") {
                        coinButton.value = goldenIMG;
                    }

                    setTimeout(() => {
                        changeReady.value = true;
                        returnCoins.value = true;
                    }, 6000);
                }
            } else if (capsuleCoins.value[0].type !== elementoAMover[0].type) {
                if (elementoAMover[0].type === "bronze") {
                    let returnCoin = changeArray.value.slice(0);
                    changeArray.value = [];
                    bronzeArray.value.push(returnCoin[0]);
                    errorDepositCoin.value = true;
                    setTimeout(() => {
                        errorDepositCoin.value = false;
                    }, 4000);
                } else if (elementoAMover[0].type === "silver") {
                    let returnCoin = changeArray.value.slice(0);
                    changeArray.value = [];
                    silverArray.value.push(returnCoin[0]);
                    errorDepositCoin.value = true;
                    setTimeout(() => {
                        errorDepositCoin.value = false;
                    }, 4000);
                }

            }

        }


        // onDragEndChanger();


        dragActive.value = false;
    }
};


//Boton para cambiar las monedas
const changeCoins = () => {
    clickEffectSoundFunction();
    changeAnimationEffectSounds();
    returnCoins.value = false;
    if (changeReady.value === true) {
        if (capsuleCoins.value[0].type === "bronze") {
            coinTunnel.value = true;
            setTimeout(() => {
                coinTunnel.value = false;
                changeReady.value = false;
            }, 6000);
            startConversion.value = true;
            typeChange.value = "bronze";
            //Generamos el codigo al cambiar las monedas de bronce, añadimos una en el array de plata y limpiamos el array de cambio.
            capsuleCoins.value = [];
            localStorage.setItem("bronzeCoins", localStorage.getItem("bronzeCoins") - props.silverExchange)
            //Establecemos en la store
            localStorage.setItem("silverCoins", parseInt(localStorage.getItem("silverCoins")) + 1);
            setTimeout(() => {
                //Temporizador para que la moneda aparezca despues de un tiempo en las monedas de plata.
                silverArray.value.push({
                    coinId: silverArray.length,
                    type: "silver",
                    img: silverIMG
                });
                tutorialAnimationActivation();
            }, 12000);

        } else if (capsuleCoins.value[0].type === "silver") {
            coinTunnel.value = true;
            setTimeout(() => {
                coinTunnel.value = false;
                changeReady.value = false;
                tutorialAnimationActivation();
            }, 6000);
            startConversion.value = true;
            typeChange.value = "silver";
            //Generamos el codigo al cambiar las monedas de bronce, añadimos una en el array de plata y limpiamos el array de cambio.
            capsuleCoins.value = [];
            localStorage.setItem("silverCoins", parseInt(localStorage.getItem("silverCoins")) - props.goldenExchange);
            //Establecemos en la store
            localStorage.setItem("goldCoins", parseInt(localStorage.getItem("goldCoins")) + 1);
        }
    }


};


//Funcion que toma del emit un boleano para cerrar la animación de canjeo
const closeAnimation = (event) => {
    startConversion.value = event;
};

//Funcion que toma del emit un boleano para cerrar la ventana de error
const closeError = (event) => {
    error.value = event;
};

//Función para retornar las monedas al monedero
const returnCoinsFunction = () => {
    clickEffectSoundFunction();
    let typeCoin = capsuleCoins.value[0].type;

    if (typeCoin === 'bronze') {
        for (let i = 0; i < capsuleCoins.value.length; i++) {
            bronzeArray.value.push(capsuleCoins.value[i]);
        }
    } else if (typeCoin === 'silver') {
        for (let i = 0; i < capsuleCoins.value.length; i++) {
            silverArray.value.push(capsuleCoins.value[i]);
        }
    }

    capsuleCoins.value = [];
    returnCoins.value = false;
    changeReady.value = false;

};

//Funcion para determinar si el fondo del contenedor de monedas se pinta de verde o rojo
const backCoinColor = (type) => {
    let result;

    if (type === "silver") {
        if (silverArray.value.length < props.goldenExchange && capsuleCoins.value.length === 0) {
            result = "linear-gradient(54deg, rgba(235,0,0,1) 48%, rgba(255,255,255,1) 50%, rgba(235,0,0,1) 52%)";
        } else if (silverArray.value.length < props.goldenExchange && capsuleCoins.value.length > 0) {
            if (capsuleCoins.value[0].type === type) {
                result = "linear-gradient(54deg, rgba(36,235,0,1) 48%, rgba(255,255,255,1) 50%, rgba(36,235,0,1) 52%)";
            } else {
                result = "linear-gradient(54deg, rgba(235,0,0,1) 48%, rgba(255,255,255,1) 50%, rgba(235,0,0,1) 52%)";
            }
        } else {
            result = "linear-gradient(54deg, rgba(36,235,0,1) 48%, rgba(255,255,255,1) 50%, rgba(36,235,0,1) 52%)";
        }
    }

    if (type === "bronze") {
        if (bronzeArray.value.length < props.silverExchange && capsuleCoins.value.length === 0) {
            result = "linear-gradient(54deg, rgba(235,0,0,1) 48%, rgba(255,255,255,1) 50%, rgba(235,0,0,1) 52%)";
        } else if (bronzeArray.value.length < props.silverExchange && capsuleCoins.value.length > 0) {
            if (capsuleCoins.value[0].type === type) {
                result = "linear-gradient(54deg, rgba(36,235,0,1) 48%, rgba(255,255,255,1) 50%, rgba(36,235,0,1) 52%)";
            } else {
                result = "linear-gradient(54deg, rgba(235,0,0,1) 48%, rgba(255,255,255,1) 50%, rgba(235,0,0,1) 52%)";
            }
        } else {
            result = "linear-gradient(54deg, rgba(36,235,0,1) 48%, rgba(255,255,255,1) 50%, rgba(36,235,0,1) 52%)";
        }
    }


    return result
};


//Funcion que se ejecuta diferentes sonidos al momento de depositar la moneda con los efectos
const depositCoinEffectsSounds = () => {
    const depositCoin = new Audio(depositCoinSound);
    const coinMovement = new Audio(coinMovementSound);
    const splendorSoundEffect1 = new Audio(splendorSound1);
    const splendorSoundEffect2 = new Audio(splendorSound2);


    depositCoin.play();

    setTimeout(() => {
        coinMovement.play();
    }, 3000);

    setTimeout(() => {
        splendorSoundEffect1.play();
        splendorSoundEffect2.play();
    }, 4000);

};


//Funcion que ejecuta el sonido de hover estandar de la app
const hoverEffectSoundFunction = () => {
    const audio = new Audio(hoverEffectSound);

    audio.play();
};

//Funcion que ejecuta el sonido de click estandar de la app
const clickEffectSoundFunction = () => {
    const audio = new Audio(clickEffectSound);

    audio.play();
};


//Funcion para ejecutar los sonidos de las animaciones de cambio
const changeAnimationEffectSounds = () => {
    const tunnelSound = new Audio(tunnelEffectSound);
    // const tunnelSound2 = new Audio(tunnelEffectSound2);
    const spawnCoinSound = new Audio(spawnCoinEffectSound);
    const coinMovement = new Audio(coinMovementSound);
    const endChange = new Audio(endChangeEffectSound);
    const endChangeButton = new Audio(endChangeButtonEffectSound);

    tunnelSound.play();
    // tunnelSound2.play();
    setTimeout(() => {
        spawnCoinSound.play();
    }, 4500);

    setTimeout(() => {
        coinMovement.play();
    }, 8000);

    setTimeout(() => {
        endChange.play();
    }, 10000);

    setTimeout(() => {
        endChangeButton.play();
    }, 14000);
};

//funcion que indica si se debe bloquear el arrastre de las monedas en casode que ya no este la cantidad de monedas
const blockDragCoins = (array, props, type) => {

    let result;
    if(array.length < props){
        result = true;
    }else if(capsuleCoins.value.length > 0){
        if(capsuleCoins.value[0].type !== type){
            result = true;
        };
    } else if(array.length > props || capsuleCoins.value.length === 0){
        result = false;
    };

    return result;
};


</script>

<template>
    <div class="z-40 relative w-full h-full">
        <CoinChangerTutorial v-if="tutorialAnimation && props.guide" :capsuleCoins="capsuleCoins" :bronzeArray="bronzeArray"
            :silverArray="silverArray" :goldenExchange="props.goldenExchange" :silverExchange="props.silverExchange"/>
        <ChangeError v-if="error" @closeWindowError="closeError" />
        <ChangeAnimation v-if="startConversion" :coinChangeType="typeChange" @closeAnimation="closeAnimation" />
        <div
            class="coin-changer-screen__div--container--title w-64 top-30 text-center mx-auto relative text-white pt-2 mt-4">
            <h2 class="text-2xl">COHETELANDIA</h2>
            <img class="w-12 top-6 right-1 absolute transform -rotate-45" :src="naveIMG" alt="nave" />
            <img class="w-52 absolute top-11 right-18" :src="shotingStar" alt="shoting-star" />
        </div>
        <div class="coin-changer-screen__div--change-platform bg-center bg-no-repeat w-52 m-auto relative top-16">
            <div class="absolute top-10 inset-x-0 w-12 h-16 m-auto">
                <div class="coin-changer-screen__div--wind coin-changer-screen__div--wind-1"></div>
                <div class="coin-changer-screen__div--wind coin-changer-screen__div--wind-2"></div>
                <div class="coin-changer-screen__div--wind coin-changer-screen__div--wind-3"></div>
                <div class="coin-changer-screen__div--wind coin-changer-screen__div--wind-4"></div>
                <div class="coin-changer-screen__div--wind coin-changer-screen__div--wind-5"></div>
            </div>

            <div v-if="errorDepositCoin" class="coin-changer-screen__div--error-different-coin-container m-auto absolute inset-x-0 z-10 flex justify-center items-center">
                <div class="coin-changer-screen__div--error-different-coin-1 h-5 absolute"></div>
                <div class="coin-changer-screen__div--error-different-coin-2 absolute h-5 "></div>
                <img class="coin-changer-screen__div--error-coin relative z-10 " :src="typeCoinDeposit" alt="coin" />
            </div>

            <div v-if="animationDepositActive" class="coin-changer-screen__div--block-interaction absolute m-auto inset-x-0 z-30"></div>

            <div v-if="animationDepositActive" class="coin-changer-screen__img--animacion-deposit-container h-5 m-auto inset-x-0 absolute ">
                <img class="coin-changer-screen__img--coin-deposit-animation w-12 m-auto relative" :src="typeCoinDeposit"
                    alt="coin-change" />
                <div class="coin-changer-screen__div--panel-deposit-animation m-auto absolute inset-x-0"></div>
            </div>

            <img :src="panel1" class="coin-changer-screen__img--panel-1 absolute top-10 inset-x-0 w-21 m-auto"
                alt="platform1" />

            <div>
                <Draggable v-if="!returnCoins" v-model="changeArray" tag="ul"
                    class="changeArray coin-changer-screen__div--changer w-20 h-20 relative  flex justify-content-center align-items-center m-auto rounded-full"
                    @start="onDragStart" @dragover="onDragOver" @end="onDragEnd"  @touchstart.prevent="onDragStart" @touchmove.prevent="onDragOver" @touchend.prevent="onDragEnd" >
                    <template #item="{ element }">
                        <li class="drag-item" :key="element.index" :data-key="element.coinId">
                            <img class="coin-changer-screen__img--coin w-12 m-auto hover:scale-125 hover:cursor-grab transition-all"
                                :src="element.img" alt="coin-change" />
                        </li>
                    </template>
                </Draggable>

                <div class="relative w-full h-20 m-auto" v-else>
                    <button @mouseenter="hoverEffectSoundFunction()" @click="returnCoinsFunction" class="coin-changer-screen__button--return-coins m-auto absolute inset-x-0 rounded-full bg-center"></button>
                </div>

            </div>

            <img class="coin-changer-screen__img--panel-2 absolute inset-x-0 m-auto flex justify-center items-center"
                :src="panel2" alt="panel2" />

            <div class="coin-changer-screen__div--container-coins-panel relative left-2.5">
                <div class="coin-changer-screen__div--coins flex justify-center items-center w-full">
                    <img class="coin-changer-screen__img--coin w-12" v-for="element, index in capsuleCoins" :key="index"
                        :src="element.img" alt="silver-coin" />
                </div>
                <img class="absolute top-0 left-0" :src="purplePanel" alt="panel" />
                <div v-if="coinTunnel"
                    class="coin-changer-screen__img--purple-panel-animation absolute inset-x-0 m-auto "></div>
            </div>

            <div v-if="changeReady"
                class="coin-changer-screen__div--arrows absolute top-60 pl-0.5 inset-x-0 flex justify-center items-center flex-col w-10 m-auto z-10">
                <img class="coin-changer-screen__img--arrow-1 w-5 rotate-90" :src="arrow" alt="arrow" />
                <img class="coin-changer-screen__img--arrow-2 w-5 rotate-90" :src="arrow" alt="arrow" />
                <img class="coin-changer-screen__img--arrow-3 w-5 rotate-90" :src="arrow" alt="arrow" />
            </div>

            <button @mouseenter="hoverEffectSoundFunction()" v-if="changeReady" @click="changeCoins"
                class="coin-changer-screen__button--changer-button size-12 rounded-full m-auto flex justify-center items-center relative left-0.5 hover:scale-125">
                <img :src="coinButton" alt="coin" />
            </button>
            <div class="coin-changer-screen__div--elipses-container relative ">
                <img :class="{ 'coin-changer-screen__div--elipse-1-animation relative top-10': startConversion, 'relative top-10': !startConversion }"
                    :src="elipseChangerPlatform" alt="elipse" />
                <img :class="{ 'coin-changer-screen__div--elipse-2-animation relative top-5': startConversion, 'relative top-5': !startConversion }"
                    :src="elipseChangerPlatform" alt="elipse" />
                <img :class="{ 'coin-changer-screen__div--elipse-3-animation': startConversion, 'coin-changer-screen__div--elipse-3': !startConversion }"
                    :src="elipseChangerPlatform" alt="elipse" />
            </div>
        </div>
        <div class="w-56 h-36 absolute px-1.5 inset-x-0 m-auto bottom-10">
            <div class="coin-changer-screen__div--animation-back" :style="{ background: backCoinColor('silver') }">
                <div class="coin-changer-screen__div--container absolute rounded-3xl overflow-hidden">
                    <div v-if="animationDepositActive || errorDepositCoin || blockDragCoins(silverArray, props.goldenExchange, 'silver')"
                        class="coin-changer-screen__div--block-animation absolute z-30">
                    </div>
                    <Draggable v-model="silverArray" tag="ul" class="silverArray grid grid-cols-1" @start="onDragStart"
                        @dragover="onDragOver" @end="onDragEnd" @touchstart.prevent="onDragStart" @touchmove.prevent="onDragOver" @touchend.prevent="onDragEnd">

                        <template #item="{ element }">
                            <li class="drag-item" :key="element.index" :data-key="element.coinId">
                                <img class="coin-changer-screen__img--coin w-12 m-auto hover:scale-125 hover:cursor-grab transition-all"
                                    :src="element.img" alt="silver-coin" />
                            </li>
                        </template>
                    </Draggable>
                </div>
            </div>
            <div class="coin-changer-screen__div--animation-back coin-changer-screen__div--animation-back-side right-0"
                :style="{ background: backCoinColor('bronze') }">
                <div class="coin-changer-screen__div--container absolute rounded-3xl overflow-hidden">
                    <div v-if="animationDepositActive || errorDepositCoin || blockDragCoins(bronzeArray, props.silverExchange, 'bronze')"
                        class="coin-changer-screen__div--block-animation coin-changer-screen__div--block-animation absolute z-30">
                    </div>
                    <Draggable v-model="bronzeArray" tag="ul" class="bronzeArray grid grid-cols-1" @start="onDragStart"
                        @dragover="onDragOver" @end="onDragEnd" @touchstart.prevent="onDragStart" @touchmove.prevent="onDragOver" @touchend.prevent="onDragEnd">

                        <template #item="{ element }">
                            <li class="drag-item" :key="element.index" :data-key="element.coinId">
                                <img class="coin-changer-screen__img--coin w-12 m-auto hover:scale-125 hover:cursor-grab transition-all"
                                    :src="element.img" alt="bronze-coin" />
                            </li>
                        </template>
                    </Draggable>
                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>
/* Estilos titulo */
.coin-changer-screen__div--container--title {
    font-family: 'Julius Sans One', sans-serif;
}

/* .coin-changer__div--container--coins-containers {
    width: 220px;
    height: 150px;
    position: absolute;
    padding-left: 5px;
    left: 0;
    right: 0;
    margin: auto;
    bottom: 40px;
} */

.coin-changer-screen__div--animation-back {
    /*Estos estilos presentaron problenmas al convertirse a tailwind por lo que se opto por dejarlos en css*/
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 20px;
    width: 60px;
    height: 140px;
    background-size: 800% 800% !important;
    background: linear-gradient(63deg, rgb(0, 249, 220) 0%, rgb(111, 111, 111) 100%);
    animation: backgroundContainerCoins 4s infinite;
}

.coin-changer-screen__div--animation-back-side {
    animation: backgroundContainerCoins 4s infinite;
}

@keyframes backgroundContainerCoins {
    0% {
        background-position: 0% 0%;
    }

    50% {
        background-position: 100% 100%;
    }

    100% {
        background-position: 0% 0%;
    }
}


/* Estilos container monedas de plata */
.coin-changer-screen__div--container {
    /*Se opta por dejar los estilos de tamaño en css ya que tailwind predefine diferente los estilos de tamaño en porcentajes y no 90% ambos */
    width: 90%;
    height: 90%;
    background-color: rgb(0, 5, 77);
}

/* .coin-changer-screen__draggable--silver {
    display: grid;
    grid-template-columns: 1fr;
} */

/* Estilos monedas de bronce */
/* .coin-changer-screen__div--container-bronze {
    bottom: 180px;
    right: 50px;
} */



/* .coin-changer-screen__div--container-wind {
    background-color: red;
    position: absolute;
    top: 40px;
    left: 0px;
    right: 0px;
    width: 50px;
    height: 60px;
    margin: auto;

} */

/* Estilos viento de la maquina */
.coin-changer-screen__div--wind {
    /*Para no repetir el codigo en las diferentes lineas que conforman el viento se dejaron los estilos en formato css */
    position: absolute;
    display: inline-block;
    width: 4px;
    height: 50px;
    border-radius: 20px;
    background-color: white;

}

.coin-changer-screen__div--wind-1 {
    animation: windAnimation1 2s infinite;
}


@keyframes windAnimation1 {
    0% {
        transform: translateY(0px);
        height: 0;
    }

    50% {
        transform: translateY(0px);
        height: 50px;
    }

    100% {
        transform: translateY(50px);
        height: 0px;
    }
}


.coin-changer-screen__div--wind-2 {
    left: 12px;
    top: -8px;
    animation: windAnimation2 4s infinite;
}


@keyframes windAnimation2 {
    0% {
        transform: translateY(0px);
        height: 0;
    }

    50% {
        transform: translateY(0px);
        height: 70px;
    }

    100% {
        transform: translateY(70px);
        height: 0px;
    }
}

.coin-changer-screen__div--wind-3 {
    left: 23px;
    top: 6px;
    animation: windAnimation3 3s infinite;
}


@keyframes windAnimation3 {
    0% {
        transform: translateY(0px);
        height: 0;
    }

    50% {
        transform: translateY(0px);
        height: 70px;
    }

    100% {
        transform: translateY(70px);
        height: 0px;
    }
}

.coin-changer-screen__div--wind-4 {
    left: 33px;
    top: 3px;
    animation: windAnimation4 5s infinite;
}


@keyframes windAnimation4 {
    0% {
        transform: translateY(0px);
        height: 0;
    }

    50% {
        transform: translateY(0px);
        height: 30px;
    }

    100% {
        transform: translateY(30px);
        height: 0px;
    }
}


.coin-changer-screen__div--wind-5 {
    left: 42px;
    top: 0px;
    animation: windAnimation5 2s infinite;
}


@keyframes windAnimation5 {
    0% {
        transform: translateY(0px);
        height: 0;
    }

    50% {
        transform: translateY(0px);
        height: 40px;
    }

    100% {
        transform: translateY(40px);
        height: 0px;
    }
}

/* Animacion plataformas */
.coin-changer-screen__img-platform-1 {
    animation: coinPlatformAnimation 6s infinite;
}

@keyframes coinPlatformAnimation {
    0% {
        filter: auto;
    }

    25% {
        filter: brightness(0) saturate(100%) invert(78%) sepia(26%) saturate(7214%) hue-rotate(75deg) brightness(105%) contrast(129%);
    }

    100% {
        filter: auto;
    }
}

.coin-changer-screen__img-platform-2 {
    animation-delay: 4s;
    animation: coinPlatformAnimation 6s infinite;
}

@keyframes coinPlatformAnimation {
    0% {
        filter: auto;
    }

    25% {
        filter: brightness(0) saturate(100%) invert(78%) sepia(26%) saturate(7214%) hue-rotate(75deg) brightness(105%) contrast(129%);
    }

    100% {
        filter: auto;
    }
}

.coin-changer-screen__img-platform-3 {
    animation-delay: 6s;
    animation: coinPlatformAnimation 6s infinite;
}

@keyframes coinPlatformAnimation {
    0% {
        filter: auto;
    }

    25% {
        filter: brightness(0) saturate(100%) invert(78%) sepia(26%) saturate(7214%) hue-rotate(75deg) brightness(105%) contrast(129%);
    }

    100% {
        filter: auto;
    }
}

/* Estilos de monedas */
.coin-changer-screen__img--coin {
    animation: coinAnimation 6s infinite;
}

@keyframes coinAnimation {
    0% {
        transform: translate(5px, 0px);
    }

    50% {
        transform: translate(-5px, 0px);
    }

    100% {
        transform: translate(5px, 0px);
    }
}

/* Estilos platafromasde maquina */
.coin-changer-screen__img--panel-1 {
    z-index: 3;
    /*Se deja el z-index ya que en tailwind se manejan de 10 en 10 en este caso era necesario manejar otros valores*/
}

.coin-changer-screen__img--panel-2 {
    /*Se dejan los estilos width y top ya que se necesitan estos tamaños puntualmente y no se encuentran en tailwind*/
    width: 190px;
    top: 235px;
}


/* Estilos panel de monedas */
.coin-changer-screen__div--container-coins-panel {
    /*Se opta por dejar los estilos width height y top ya que sus medidas son precisas y tailwind no las tiene*/
    width: 189px;
    height: 60px;
    top: 97px;
    background: linear-gradient(90deg, rgba(255, 255, 255, 0) 49%, rgba(255, 255, 255, 0.8352591036414566) 50%, rgba(255, 255, 255, 0) 51%);
    background-size: 500%;
    animation: backgroundPanelCoins 10s infinite linear;
}

@keyframes backgroundPanelCoins {
    0% {
        background-position: 0% 0%;
    }

    50% {
        background-position: 100% 100%;
    }

    100% {
        background-position: 0% 0%;
    }
}

/* Flechas animadas */
.coin-changer-screen__div--arrows {
    height: 70px;
    animation: changeReadyFadedAnimation 2s linear;
}

/* animacion usada en los componentes animados despues de cumplir requisitos de monedas */
@keyframes changeReadyFadedAnimation {
    0% {
        opacity: 0%;
    }

    100% {
        opacity: 100%;
    }
}


.coin-changer-screen__img--arrow-1 {
    animation: arrowAnimation 4s infinite;
    animation-delay: 1s;
}

.coin-changer-screen__img--arrow-2 {
    animation: arrowAnimation 4s infinite;
    animation-delay: 2s;
}

.coin-changer-screen__img--arrow-3 {
    animation: arrowAnimation 4s infinite;
    animation-delay: 3s;
}


@keyframes arrowAnimation {
    0% {
        opacity: 0%;
    }

    50% {
        opacity: 100%;
    }

    100% {
        opacity: 0%;
    }
}


.coin-changer-screen__div--coins {
    /*Se deja el tamaño del alto ya que no se encuentra la cifra exacta de pixeles en tailwind*/
    height: 60px;
}


/* Estilos animacion del panel purpura */
.coin-changer-screen__img--purple-panel-animation {
    /* left: 0;
    right: 0; */
    /* margin: auto; */
    bottom: 0px;
    width: 187px;
    height: 60px;
    background: rgb(115, 0, 176);
    background: radial-gradient(circle, rgba(115, 0, 176, 1) 0%, rgba(76, 0, 236, 1) 8%, rgba(156, 80, 255, 1) 11%, rgba(55, 119, 230, 1) 18%, rgba(0, 153, 166, 1) 23%, rgba(96, 60, 192, 1) 30%, rgba(192, 0, 255, 1) 37%, rgba(96, 78, 183, 1) 43%, rgba(0, 156, 110, 1) 49%, rgba(67, 52, 74, 1) 57%, rgba(101, 0, 56, 1) 64%, rgba(51, 9, 103, 1) 71%, rgba(244, 249, 16, 1) 75%, rgba(0, 18, 150, 1) 78%, rgba(50, 255, 211, 1) 89%, rgba(240, 0, 198, 1) 100%);
    background-size: 500%;
    background-position: center;
    box-shadow: 0px 0px 44px 3px rgba(250, 90, 250, 1);
    animation: purplePanelAnimation 6s linear;
    animation-fill-mode: forwards;
}

@keyframes purplePanelAnimation {
    0% {
        background-size: 500%;
    }

    89% {
        width: 187px;
        height: 60px;
        border-radius: 0%;
    }

    90% {
        width: 10px;
        height: 10px;
        border-radius: 100%;
    }

    100% {
        width: 0px;
        height: 0px;
        background-size: 100%;
    }
}



/* Estilos plataforma de canjeo */
.coin-changer-screen__div--change-platform {
    height: 400px;
}

.coin-changer-screen__div--changer {
    top: -40px;
    /* background: rgba(2, 18, 74, 0.67); */
    animation: shadowAnimation 4s infinite;
    background-image: url('../../img/coin-change/coin-example.png');
    background-position: center;
    background-size: 90%;
    background-repeat: no-repeat;
}

@keyframes shadowAnimation {
    0% {
        box-shadow: 0px 0px 15px -2px rgba(255, 255, 255, 0.75);
    }

    50% {
        box-shadow: 0px 0px 15px 10px rgba(255, 255, 255, 0.84);
    }

    100% {
        box-shadow: 0px 0px 15px -2px rgba(255, 255, 255, 0.75);
    }
}

.coin-changer-screen__button--changer-button {
    background-color: #01124E;
    border: #00E2B9 solid 12px;
    z-index: 5;
    top: 170px;
    transition: .2s ease-in-out;
    animation: shadowAnimationButton 4s infinite, changeReadyFadedAnimation 2s linear;
}

@keyframes shadowAnimationButton {
    0% {
        box-shadow: 0px 0px 15px -2px #00E2B9;
    }

    50% {
        box-shadow: 0px 0px 15px 10px #00E2B9;
    }

    100% {
        box-shadow: 0px 0px 15px -2px #00E2B9;
    }
}

.coin-changer-screen__button--changer-button:hover {
    border: #00E2B9 solid 3px;
}

.coin-changer-screen__div--elipses-container {
    top: 90px;
}

/* Estilos animacion de los elipses */
.coin-changer-screen__div--elipse-1-animation {
    animation: elipsesAnimation 4s infinite;
}

.coin-changer-screen__div--elipse-2-animation {
    animation: elipsesAnimation 4s infinite;
}

.coin-changer-screen__div--elipse-3-animation {
    animation: elipsesAnimation 4s infinite;
}


@keyframes elipsesAnimation {
    0% {
        filter: auto;
    }

    100% {
        filter: invert(11%) sepia(99%) saturate(7280%) hue-rotate(233deg) brightness(83%) contrast(106%);
    }
}

.coin-changer-screen__img--animacion-deposit-container {
    width: 200px;
    top: -21px;
}

/* Animacion moneda despues de depositar */
.coin-changer-screen__img--coin-deposit-animation {
    top: -3px;
    z-index: 1;
    animation: depositCoinAnimation 4s linear;
    animation-fill-mode: forwards;
}

@keyframes depositCoinAnimation {
    0% {
        transform: rotate(0deg) translateX(0px) rotate(0deg);
    }

    10% {
        transform: rotate(0deg) translateX(12px) rotate(0deg);
    }

    40% {
        transform: rotate(-280deg) translateX(12px) rotate(280deg);
    }

    70% {
        transform: rotate(0deg) translateX(0px) rotate(0deg);
    }

    100% {
        transform: rotate(0deg) translateX(0px) translateY(200px) rotate(0deg);
    }
}

.coin-changer-screen__div--panel-deposit-animation {
    width: 188px;
    height: 58px;
    background-color: rgba(255, 255, 255, 0);
    top: 198px;
    z-index: 15;
    animation-fill-mode: forwards;
    animation: depositPanelAnimation 2s linear;
    animation-delay: 4s;
}

@keyframes depositPanelAnimation {
    0% {
        border-radius: 100%;
        background-color: rgb(255, 255, 255);
        width: 58px;
    }

    5% {
        border-radius: 0%;
        background-color: rgb(255, 255, 255);
        width: 188px;
        box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 1);
        transform: scale(1);
    }

    80% {
        border-radius: 0%;
        background-color: rgb(255, 255, 255);
        width: 188px;
        box-shadow: 0px 0px 159px 133px rgb(255, 255, 255);
        transform: scale(1);
    }

    90% {
        border-radius: 0%;
        background-color: rgb(255, 255, 255);
        box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 1);
        transform: scale(1);
    }

    95% {
        border-radius: 100%;
        background-color: rgb(255, 255, 255);
        box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 1);
        width: 58px;
        transform: scale(1);
    }

    100% {
        border-radius: 100%;
        background-color: rgb(255, 255, 255);
        box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 1);
        width: 58px;
        transform: scale(0);
    }
}

.coin-changer-screen__div--error-different-coin-container {
    width: 100px;
    height: 50px;
    top: -25px;
}

.coin-changer-screen__div--error-different-coin-1 {
    width: 60px;
    height: 20px;
    background-color: white;
    transform: rotate(50deg);
    border-radius: 10px;
    animation: errorAnimation 2s linear;
    animation-fill-mode: forwards;
}

@keyframes errorAnimation {
    0% {
        width: 60px;
        height: 20px;
        opacity: 0%;
        border-radius: 10px;
    }

    5% {
        width: 60px;
        height: 20px;
        opacity: 100%;
        border-radius: 10px;
    }

    20% {
        width: 60px;
        height: 20px;
        opacity: 100%;
        border-radius: 10px;
    }

    70% {
        width: 50px;
        height: 50px;
        opacity: 100%;
        border-radius: 100%;
    }

    100% {
        width: 50px;
        height: 50px;
        opacity: 100%;
        border-radius: 100%;
    }
}

.coin-changer-screen__div--error-different-coin-2 {
    width: 60px;
    height: 20px;
    background-color: white;
    transform: rotate(-50deg);
    border-radius: 10px;
    animation: errorAnimation 2s linear;
    animation-fill-mode: forwards;
}

@keyframes errorAnimation {
    0% {
        width: 60px;
        height: 20px;
        opacity: 0%;
        border-radius: 10px;
    }

    5% {
        width: 60px;
        height: 20px;
        opacity: 100%;
        border-radius: 10px;
    }

    20% {
        width: 60px;
        height: 20px;
        opacity: 100%;
        border-radius: 10px;
    }

    70% {
        width: 50px;
        height: 50px;
        opacity: 100%;
        border-radius: 100%;
    }

    100% {
        width: 50px;
        height: 50px;
        opacity: 100%;
        border-radius: 100%;
    }
}

.coin-changer-screen__div--error-coin {
    width: 38px;
    position: relative;
    z-index: 10;
    opacity: 0%;
    animation: errorCoinAnimation 2s linear;
    animation-fill-mode: forwards;
}

@keyframes errorCoinAnimation {
    0% {
        opacity: 0%;
        width: 10;
    }

    100% {
        opacity: 100%;
        width: 38px;
    }
}

.coin-changer-screen__div--block-interaction {
    width: 100px;
    height: 100px;
    top: -50px;
}


.coin-changer-screen__button--return-coins {
    bottom: 38px;
    width: 70px;
    height: 70px;
    background-size: 100%;
    background-image: url('../../img/coin-change/coin-return.png');
}

.coin-changer-screen__button--return-coins:hover {
    background-color: rgba(255, 255, 255, 0.492);
    transform: scale(1.2) rotate(360deg);
    transition: all 0.3s;
}

.coin-changer-screen__div--block-animation {
    background-color: rgba(0, 0, 0, 0.488);
    width: 70px;
    height: 130px;
}
</style>import { space } from 'postcss/lib/list';
