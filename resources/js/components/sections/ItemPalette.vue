<script setup>

import {ref, onMounted, onUpdated} from "vue";
import {types, sizes, localHost, getSelectItem, updateCoins, playAudio, getUsersLocalStorage, storageCoinUpdated} from '../../use';
import Swal from 'sweetalert2';

//Componentes
import CoinsComponent from "../ui/CoinsComponent.vue";


let itemSelected = ref();
let itemImg = ref();
let itemSize = ref();

//Importacion de imagenes
import IconShoppingCart from "../icons/IconShoppingCart.vue";
import IconPaintBrush from "../icons/IconPaintBrush.vue";

//Importacion audio
import hoverAudio from '../../../../public/audios/effects/audioHoverStandard.mp3';
import clickAudio from '../../../../public/audios/effects/audioClickStandard.mp3';
import CoinChanger from "../activities/Coin Changer/CoinChanger.vue";


//Ref que controla el numero de monedas de oro
const goldCoins = ref(null);
const silverCoins = ref(null);
const bronzeCoins = ref(null);
const goldCoinsChangeActive = ref("");
const silverCoinsChangeActive = ref("");
const bronzeCoinsChangeActive = ref("");
const userData = ref("");
const buttonNextLevel = ref(true);


//Props
const props = defineProps({
  level: {type: Array},
  items: {type: Object},
  updateCoins: {type: Boolean},
  currentAudio: {type: HTMLAudioElement},
  coinChangerClose: {type: Boolean}
});


const updateCoinsRef = ref(props.updateCoins);

//Emits
const emit = defineEmits(['closeAnimation', 'openAnimation', 'vortexType', 'selected', 'selectedCoinChanger']);

let isPlaying = ref(true)
let nextUrl = ref(`${localHost}/level${props.level[0]}/${props.level[1] + 1}`)

// const storageCoinUpdated = () => {
//   //Valido si las monedas de oro son 5 o mas de 5 en caso de ser mas de 5 va a devolver solo 5 y si es menos devolvera la cantidad que se tiene
//   if (parseInt(localStorage.getItem('goldCoins')) > 5) {
//     goldCoins.value = 5;
//   } else if (parseInt(localStorage.getItem('goldCoins')) < 5) {
//     goldCoins.value = parseInt(localStorage.getItem('goldCoins'));
//   }

//   if (parseInt(localStorage.getItem('silverCoins')) > 5) {
//     silverCoins.value = 5;
//   } else if (parseInt(localStorage.getItem('silverCoins')) < 5) {
//     silverCoins.value = parseInt(localStorage.getItem('silverCoins'));
//   }

//   if (parseInt(localStorage.getItem('bronzeCoins')) > 5) {
//     bronzeCoins.value = 5;
//   } else if (parseInt(localStorage.getItem('bronzeCoins')) < 5) {
//     bronzeCoins.value = parseInt(localStorage.getItem('bronzeCoins'));
//   }

//   //Controlamos si hay monedas suficientes para cambiar para darle efecto al boton de cambiar segun las monedas.
//   if (parseInt(localStorage.getItem('goldCoins')) > 0) {
//     goldCoinsChangeActive.value = "item-palette-gold__div--container-active";
//   } else if (parseInt(localStorage.getItem('goldCoins')) === 0) {
//     goldCoinsChangeActive.value = "";
//   }
//   ;

//   if (parseInt(localStorage.getItem('silverCoins')) > 2) {
//     silverCoinsChangeActive.value = "item-palette-gold__div--container-active";
//   } else if (parseInt(localStorage.getItem('silverCoins')) < 3) {
//     silverCoinsChangeActive.value = "";
//   }
//   ;

//   if (parseInt(localStorage.getItem('bronzeCoins')) > 2) {
//     bronzeCoinsChangeActive.value = "item-palette-gold__div--container-active";
//   } else if (parseInt(localStorage.getItem('bronzeCoins')) < 3) {
//     bronzeCoinsChangeActive.value = "";
//   }
//   ;
// };

onUpdated(() => {
  if (props.updateCoins) {
    storageCoinUpdated(goldCoins, silverCoins, bronzeCoins, goldCoinsChangeActive, silverCoinsChangeActive, bronzeCoinsChangeActive);
  };
});


onMounted(async() => {
  storageCoinUpdated(goldCoins, silverCoins, bronzeCoins, goldCoinsChangeActive, silverCoinsChangeActive, bronzeCoinsChangeActive);

  userData.value = getUsersLocalStorage();

  localStorage.setItem('itemSelected', null)
  itemSelected.value = getSelectItem()
  if (props.items.length % 2 !== 0) {
    document.getElementById(props.items[props.items.length - 1].name).classList.add('col-span-2')
  }

  const response = await axios.get('/activityCount/' + props.level[0]);
  if (props.level[1] === response.data) {
    nextUrl.value = `${localHost}/levels/${props.level[0]}`;
  }
});


const selectItemPalette = (item) => {
  storageCoinUpdated(goldCoins, silverCoins, bronzeCoins, goldCoinsChangeActive, silverCoinsChangeActive, bronzeCoinsChangeActive);
  let selectSound = new Audio()
  selectSound.src = `${localHost}/audios/effects/bubble.wav`
  selectSound.play()

  localStorage.setItem('itemSelected', JSON.stringify(item))

  if (item.type === types.letter || item.type === types.number) {
    itemImg.value = null
    for (let i = 0; i < props.items.length; i++) {
      const item = props.items[i];
      document.getElementById('itemScreen').classList.remove(item.content)
    }
    document.getElementById('itemScreen').classList.add('bg-white')
    itemSelected.value = getSelectItem()
  } else if (item.type === types.color) {
    itemSelected.value = null
    itemImg.value = null
    for (let i = 0; i < props.items.length; i++) {
      const item = props.items[i];
      document.getElementById('itemScreen').classList.remove(item.content)
      document.getElementById('itemScreen').classList.remove('bg-white')
    }
    document.getElementById('itemScreen').classList.add(item.content)
  } else if (item.type === types.image || item.type === types.eraser) {
    itemSelected.value = null
    for (let i = 0; i < props.items.length; i++) {
      const item = props.items[i];
      document.getElementById('itemScreen').classList.remove(item.content)
    }
    document.getElementById('itemScreen').classList.add('bg-white')
    itemImg.value = item.content

    if (item.size === sizes.small) {
      itemSize.value = 30
    } else if (item.size === sizes.normal) {
      itemSize.value = 40
    } else if (item.size === sizes.big) {
      itemSize.value = 50
    }
  }
}

const playHoverSound = (id) => {
  playAudio(`${localHost}/audios/effects/happyPop.mp3`)
  document.getElementById(id).style.fill = '#000'
};

const leaveMouse = (id) => {
  document.getElementById(id).style.fill = '#fff'
};

window.playHoverSound = playHoverSound;
window.leaveMouse = leaveMouse;
window.Swal = Swal;

const pause = () => {
  playAudio(`${localHost}/audios/effects/smoothDing.mp3`)
  handlePauseButton()
  Swal.fire({
    title: "Pausa",
    text: "Haz pausado el juego",
    width: "30rem",
    showConfirmButton: false,
    html: swalHtml,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      // Swal.fire("Saved!", "", "success");
    } else if (result.isDenied) {
      Swal.fire("Changes are not saved", "", "info");
    }
    playAudio(`${localHost}/audios/effects/blom.mp3`)
    handlePauseButton()
  });
};

const swalHtml = `
    <div class="grid gap-2">
      <div>
        <button onmouseenter="playHoverSound('svgPlay')" onmouseleave="leaveMouse('svgPlay')" onclick="Swal.clickConfirm()" class="btn-frog"><i class="animation"></i>
        <div class="translate-x-[10px]">
          Continuar
        </div>
        <div>
          <svg id="svgPlay" width="20px" fill="#fff" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>play</title> <path d="M5.92 24.096q0 1.088 0.928 1.728 0.512 0.288 1.088 0.288 0.448 0 0.896-0.224l16.16-8.064q0.48-0.256 0.8-0.736t0.288-1.088-0.288-1.056-0.8-0.736l-16.16-8.064q-0.448-0.224-0.896-0.224-0.544 0-1.088 0.288-0.928 0.608-0.928 1.728v16.16z"></path> </g></svg>
        </div>
        <i class="animation"></i>
        </button>
      </div>
      <div class="flex justify-center">
        <a href="${localHost}/levels/${props.level[0]}" onmouseenter="playHoverSound('svgPuzzle')" onmouseleave="leaveMouse('svgPuzzle')" class="btn-little-frog flex justify-center items-center gap-2">
          <div class="pl-4 pr-1">
            Retos ${props.level[0]}
          </div>
          <div>
            <svg width="30px" version="1.1" id="svgPuzzle" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" sodipodi:docname="New document 1" inkscape:version="0.48.4 r9939" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1200 1200" enable-background="new 0 0 1200 1200" xml:space="preserve" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="layer1" transform="translate(0,147.63782)" inkscape:label="Layer 1" inkscape:groupmode="layer"> <path id="rect3006" inkscape:connector-curvature="0" d="M471.749-147.637c-94.045,0-170.273,76.304-170.273,170.441 c0,46.55,18.624,88.767,48.842,119.528H0.001v284.069c31.224-36.108,77.389-59.006,128.842-59.006 c94.044,0,170.273,76.304,170.273,170.44c0,94.137-76.229,170.441-170.274,170.441C77.39,708.276,31.225,685.378,0,649.27v403.092 h368c-38.914-31.238-63.832-79.199-63.832-133.016c0-94.139,76.229-170.441,170.274-170.441 c94.044,0,170.272,76.305,170.272,170.441c0,53.814-24.918,101.775-63.832,133.016h328.253V696.307 c30.828,30.945,73.48,50.07,120.59,50.07c94.045,0,170.273-76.305,170.273-170.441c0-94.139-76.23-170.441-170.273-170.441 c-47.109,0-89.762,19.125-120.59,50.07V142.331H593.18c30.228-30.763,48.843-72.971,48.843-119.528 C642.023-71.334,565.793-147.637,471.749-147.637L471.749-147.637z"></path> </g> </g></svg>
          </div>
        </a>
      </div>
      <div class="flex justify-center">
        <a href="${localHost}/levels" onmouseenter="playHoverSound('svgRocket')" onmouseleave="leaveMouse('svgRocket')" class="btn-little-frog flex justify-center items-center gap-2">
          <div class="pl-4">
            Niveles
          </div>
          <div>
            <svg width="30px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>rocket-filled</title> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="svgRocket" fill="#fff" transform="translate(42.666667, 64.000000)"> <path d="M405.333333,1.42108547e-14 C396.316305,122.794806 364.316305,211.683695 309.333333,266.666667 C299.582265,276.417735 288.905446,285.33185 277.302879,293.409011 L277.302464,341.234872 L213.302464,405.234872 L174.248,336.891 L68.525,231.157 L7.10542736e-15,192 L64,128 L112.079613,128.000404 C120.083859,116.387258 128.94621,105.720457 138.666667,96 C193.649638,41.0170286 282.538527,9.01702859 405.333333,1.42108547e-14 Z M136.329915,329.707793 L166.499804,359.877683 L121.24497,405.132517 L91.0750809,374.962627 L136.329915,329.707793 Z M91.0750809,284.452959 L121.24497,314.622849 L45.8202469,390.047572 L15.6503576,359.877683 L91.0750809,284.452959 Z M45.8202469,239.198125 L75.9901363,269.368015 L30.7353023,314.622849 L0.565412939,284.452959 L45.8202469,239.198125 Z M245.333333,128 C227.660221,128 213.333333,142.326888 213.333333,160 C213.333333,177.673112 227.660221,192 245.333333,192 C263.006445,192 277.333333,177.673112 277.333333,160 C277.333333,142.326888 263.006445,128 245.333333,128 Z" id="Combined-Shape"> </path> </g> </g> </g></svg>
          </div>
        </a>
      </div>
      <div class="flex justify-center">
        <a href="${localHost}"  onmouseenter="playHoverSound('svgDoor')" onmouseleave="leaveMouse('svgDoor')" class="btn-little-frog flex justify-center items-center gap-2">
            <div class="pl-4">
                Salir
            </div>
            <div>
                <svg width="30px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools --> <title>ic_fluent_sign_out_24_filled</title> <desc>Created with Sketch.</desc> <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="svgDoor" fill="#ffffff" fill-rule="nonzero"> <path d="M12,4.35416625 L12,4.99998545 L13.7452668,5 C14.1245178,5 14.4381068,5.28151791 14.488266,5.64711331 L14.4952658,5.74875738 L14.502,10 L13.002,10 L12.9965084,6.5 L12,6.49998545 L12.0005455,11.004946 L13.002,11.0039854 L13.003,11 L14.504,11 L14.503,11.0039854 L19.442,11.0039854 L17.7195786,9.28023872 C17.4533579,9.0139263 17.4292236,8.59725845 17.6471286,8.30368449 L17.7197613,8.21957857 C17.9860737,7.95335788 18.4027416,7.9292236 18.6963155,8.14712863 L18.7804214,8.21976128 L21.7770341,11.2174065 C22.043008,11.4834721 22.0673769,11.8996744 21.850009,12.19325 L21.7775464,12.2773711 L18.7809337,15.2808167 C18.4883742,15.5740433 18.0135008,15.5745841 17.7202742,15.2820246 C17.4537046,15.0160615 17.4290241,14.5994256 17.646544,14.3055662 L17.7190663,14.2213652 L19.432,12.5039854 L12.0005455,12.504946 L12,17.0009854 L13.0139075,17.0014475 L13.007,13.5 L14.508,13.5 L14.5151512,17.7502049 C14.5157801,18.130345 14.23351,18.4448141 13.8670368,18.4945857 L13.7651512,18.5014475 L12,18.5009854 L12,19.25 C12,19.7163948 11.5788385,20.0696886 11.1195525,19.9885685 L2.61955246,18.4872805 C2.26120966,18.4239892 2,18.1126012 2,17.748712 L2,5.75 C2,5.38269391 2.26601447,5.06943276 2.62846599,5.00991252 L11.128466,3.61407877 C11.5850805,3.53909548 12,3.89143598 12,4.35416625 Z M8.50214976,11.5 C7.94867773,11.5 7.5,11.9486777 7.5,12.5021498 C7.5,13.0556218 7.94867773,13.5042995 8.50214976,13.5042995 C9.05562179,13.5042995 9.50429953,13.0556218 9.50429953,12.5021498 C9.50429953,11.9486777 9.05562179,11.5 8.50214976,11.5 Z" id="🎨-Color"> </path> </g> </g> </g></svg>
            </div>
        </a>
      </div>
    </div>
  `;

const pauseCurrentAudio = () => {
  if (props.currentAudio) {
    props.currentAudio.pause();
  }
};

// Función para reanudar todos los audios
const resumeCurrentAudio = () => {
  if (props.currentAudio && props.currentAudio.paused) {
    props.currentAudio.play();
  }
};

// Función para manejar el clic en el botón
const handlePauseButton = () => {
  if (isPlaying.value) {
    pauseCurrentAudio();
  } else {
    resumeCurrentAudio();
  }
  // Cambiar el estado de reproducción
  isPlaying.value = !isPlaying.value;
};

//Emits que controlan el cierre y la apertura de la animacion vortex.
const closeAnimation = () => {
  emit('closeAnimation', false);
};

const openAnimation = (type) => {
  emit('openAnimation', true);
  emit('vortexType', type);
  hoverButtonAudio();
};

//Creamos una funcion que nos mandara a la ruta de la store
const storeAccess = () => {
  clickButtonAudio();
  setTimeout(() => {
    window.location = `${localHost}/store`;
  }, 3000);
  emit('selected', true);
};

const openCoinChanger = () => {
  setTimeout(() => {
    emit('selectedCoinChanger', true);
  }, 4000);
  emit('selected', true);
};

//Funciones para los sonidos
const hoverButtonAudio = () => {
  const hoverAudioEffect = new Audio(hoverAudio);

  hoverAudioEffect.play();
  hoverAudioEffect.volume = 0.5;
};

const clickButtonAudio = () => {
  const clickAudioEffect = new Audio(clickAudio);

  clickAudioEffect.play();
  clickAudioEffect.volume = 0.5;
};

//Codigo para abrir el cambiador de monedas automatico antes de continuar al siguiente nivel si se cumplen los requisitos.
let silverCoinsAuto = parseInt(getUsersLocalStorage().silverCoins);
let bronzeCoinsAuto = parseInt(getUsersLocalStorage().bronzeCoins);
const nextLevel = () => {
  if(userData.value.coinChangerAuto && silverCoinsAuto >= 3 || userData.value.coinChangerAuto && bronzeCoinsAuto >= 3){
    buttonNextLevel.value = false;
    emit('vortexType', 'changer');
    openCoinChanger();
    setTimeout(() => {
      window.location = nextUrl.value;
    }, 50000);
  }else if(!userData.value.coinChangerAuto || userData.value.coinChangerAuto && silverCoinsAuto < 3 || userData.value.coinChangerAuto && bronzeCoins < 3){
    if(userData.value.goldenCoins >= 1){
      window.location = `${localHost}/claim-rocket`;
    }else if(userData.value.goldenCoins === 0){
      window.location = nextUrl.value;
    }
  };
};

</script>
<template>
  <div
      class="backdrop-blur-sm border-2 border-blue-900 rounded-md flex items-center justify-between justify-center h-full">

    <div class="w-full flex justify-center">
      <div class="grid grid-cols-2 gap-4 w-full">
        <div class="flex justify-center col-span-2 gap-10 py-[2%]">

          <button class="bg-gray-200 rounded-md py-[3%] px-[8%]">
            <IconShoppingCart/>
          </button>

          <button @click="pause()" class="bg-gray-200 rounded-md py-[3%] px-[8%]">
            <svg viewBox="-1 0 8 8" version="1.1" xmlns="http://www.w3.org/2000/svg" width="26px"
                 height="26px"
                 xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier"><title>pause [#1006]</title>
                <desc>Created with Sketch.</desc>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g id="Dribbble-Light-Preview" transform="translate(-227.000000, -3765.000000)"
                     fill="#000000">
                    <g id="icons" transform="translate(56.000000, 160.000000)">
                      <path
                          d="M172,3605 C171.448,3605 171,3605.448 171,3606 L171,3612 C171,3612.552 171.448,3613 172,3613 C172.552,3613 173,3612.552 173,3612 L173,3606 C173,3605.448 172.552,3605 172,3605 M177,3606 L177,3612 C177,3612.552 176.552,3613 176,3613 C175.448,3613 175,3612.552 175,3612 L175,3606 C175,3605.448 175.448,3605 176,3605 C176.552,3605 177,3605.448 177,3606"
                          id="pause-[#1006]"></path>
                    </g>
                  </g>
                </g>
              </g>
            </svg>
          </button>
        </div>


        <div class="flex justify-center col-span-2 items-center h-52">
          <div id="coins" class="flex flex-col justify-center items-center gap-2  duration-300">
            <!-- <svg height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                 fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier"> <path style="fill:#FFE14D;"
                                                   d="M256,512C114.837,512,0,397.157,0,256S114.837,0,256,0s256,114.843,256,256S397.163,512,256,512z"></path>
                    <path style="fill:#FFCC33;"
                          d="M512,256C512,114.843,397.163,0,256,0v512C397.163,512,512,397.157,512,256z"></path>
                    <path style="fill:#FF9F19;"
                          d="M256,33.391C133.25,33.391,33.391,133.256,33.391,256S133.25,478.609,256,478.609 S478.609,378.744,478.609,256S378.75,33.391,256,33.391z M256,445.217c-104.337,0-189.217-84.881-189.217-189.217 S151.663,66.783,256,66.783S445.217,151.663,445.217,256S360.337,445.217,256,445.217z"></path>
                    <path style="fill:#F28618;"
                          d="M445.217,256c0,104.337-84.881,189.217-189.217,189.217v33.391 c122.75,0,222.609-99.864,222.609-222.609S378.75,33.391,256,33.391v33.391C360.337,66.783,445.217,151.663,445.217,256z"></path>
                    <path style="fill:#FF9F19;"
                          d="M317.217,300.522c0,27.937-18.922,51.534-44.522,58.88v7.903c0,9.238-7.456,16.696-16.696,16.696 s-16.696-7.457-16.696-16.696v-7.903c-25.6-7.346-44.522-30.943-44.522-58.88c0-9.238,7.456-16.696,16.696-16.696 c9.239,0,16.696,7.457,16.696,16.696c0,15.36,12.466,27.826,27.826,27.826s27.826-12.466,27.826-27.826 c0-0.779-0.111-1.224-0.223-1.558c-1.336-8.682-13.802-16.473-27.603-24.042c-2.56-1.337-5.231-2.783-7.791-4.119 c-23.82-12.576-53.426-28.27-53.426-59.324c0-27.937,18.922-51.534,44.522-58.88v-7.903c0-9.238,7.456-16.696,16.696-16.696 s16.696,7.457,16.696,16.696v7.903c25.6,7.346,44.522,30.943,44.522,58.88c0,9.238-7.456,16.696-16.696,16.696 s-16.696-7.457-16.696-16.696c0-15.36-12.466-27.826-27.826-27.826s-27.826,12.466-27.826,27.826c0,9.238,13.133,17.586,27.826,25.6 c2.56,1.336,5.231,2.783,7.791,4.118C287.612,253.774,317.217,269.468,317.217,300.522z"></path>
                    <g> <path style="fill:#F28618;"
                              d="M317.217,300.522c0,27.937-18.922,51.534-44.522,58.88v7.903c0,9.238-7.456,16.696-16.696,16.696 v-55.652c15.36,0,27.826-12.466,27.826-27.826c0-0.779-0.111-1.224-0.223-1.558c-1.336-8.682-13.802-16.473-27.603-24.042v-37.843 c2.56,1.336,5.231,2.783,7.791,4.118C287.612,253.774,317.217,269.468,317.217,300.522z"></path>
                        <path style="fill:#F28618;"
                              d="M283.826,211.478c0,9.223,7.479,16.696,16.696,16.696c9.217,0,16.696-7.473,16.696-16.696 c0-27.961-18.869-51.551-44.522-58.843v-7.939c0-9.223-7.479-16.696-16.696-16.696v55.652 C271.348,183.652,283.826,196.136,283.826,211.478z"></path> </g> </g></svg> -->


            <!--                        <svg height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 488 488" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#F0F7F7;" cx="244" cy="244" r="244"></circle> <path style="fill:#B2CECE;" d="M488,244c0,134.4-109.6,244-244,244S0,378.4,0,244"></path> <path style="fill:#D1E7E8;" d="M488,244c0,134.4-109.6,228.8-244,228.8S0,378.4,0,244S109.6,15.2,244,15.2S488,109.6,488,244z"></path> <g> <path style="fill:#BFDBDB;" d="M244,15.2c134.4,0,244,93.6,244,228.8c0,134.4-109.6,228.8-244,228.8"></path> <path style="fill:#BFDBDB;" d="M428,244c0,101.6-82.4,172.8-184,172.8S60,345.6,60,244S142.4,58.4,244,58.4S428,142.4,428,244z"></path> <path style="fill:#BFDBDB;" d="M428,244c0,101.6-82.4,188-184,188S60,345.6,60,244S142.4,71.2,244,71.2S428,142.4,428,244z"></path> </g> <path style="fill:#DAEFEF;" d="M428,244c0,101.6-82.4,172.8-184,172.8S60,345.6,60,244S142.4,71.2,244,71.2S428,142.4,428,244z"></path> <path style="fill:#C5E2E2;" d="M244,71.2c101.6,0,184,71.2,184,172.8s-82.4,172.8-184,172.8"></path> <path style="fill:#F0F7F7;" d="M244,379.2c-81.6,0-142.4-57.6-142.4-133.6S162.4,111.2,244,111.2s142.4,57.6,142.4,133.6 S325.6,379.2,244,379.2z M244,126.4c-72.8,0-127.2,51.2-127.2,118.4c0,68,54.4,119.2,127.2,119.2s127.2-51.2,127.2-118.4 C371.2,177.6,316.8,126.4,244,126.4z"></path> <path style="fill:#E7F7F6;" d="M371.2,245.6c0,67.2-54.4,118.4-127.2,118.4v15.2c81.6,0,142.4-57.6,142.4-133.6 S325.6,111.2,244,111.2v15.2C316.8,126.4,371.2,177.6,371.2,245.6z"></path> </g></svg>-->
            <!--<svg height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 488 488" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#F0F7F7;" cx="244" cy="244" r="244"></circle> <path style="fill:#B2CECE;" d="M488,244c0,134.4-109.6,244-244,244S0,378.4,0,244"></path> <path style="fill:#D1E7E8;" d="M488,244c0,134.4-109.6,228.8-244,228.8S0,378.4,0,244S109.6,15.2,244,15.2S488,109.6,488,244z"></path> <g> <path style="fill:#BFDBDB;" d="M244,15.2c134.4,0,244,93.6,244,228.8c0,134.4-109.6,228.8-244,228.8"></path> <path style="fill:#BFDBDB;" d="M428,244c0,101.6-82.4,172.8-184,172.8S60,345.6,60,244S142.4,58.4,244,58.4S428,142.4,428,244z"></path> <path style="fill:#BFDBDB;" d="M428,244c0,101.6-82.4,188-184,188S60,345.6,60,244S142.4,71.2,244,71.2S428,142.4,428,244z"></path> </g> <path style="fill:#DAEFEF;" d="M428,244c0,101.6-82.4,172.8-184,172.8S60,345.6,60,244S142.4,71.2,244,71.2S428,142.4,428,244z"></path> <path style="fill:#C5E2E2;" d="M244,71.2c101.6,0,184,71.2,184,172.8s-82.4,172.8-184,172.8"></path> <path style="fill:#F0F7F7;" d="M244,379.2c-81.6,0-142.4-57.6-142.4-133.6S162.4,111.2,244,111.2s142.4,57.6,142.4,133.6 S325.6,379.2,244,379.2z M244,126.4c-72.8,0-127.2,51.2-127.2,118.4c0,68,54.4,119.2,127.2,119.2s127.2-51.2,127.2-118.4 C371.2,177.6,316.8,126.4,244,126.4z"></path> <path style="fill:#E7F7F6;" d="M371.2,245.6c0,67.2-54.4,118.4-127.2,118.4v15.2c81.6,0,142.4-57.6,142.4-133.6 S325.6,111.2,244,111.2v15.2C316.8,126.4,371.2,177.6,371.2,245.6z"></path> </g></svg>-->
            <!--<svg height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 488 488" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#F0F7F7;" cx="244" cy="244" r="244"></circle> <path style="fill:#B2CECE;" d="M488,244c0,134.4-109.6,244-244,244S0,378.4,0,244"></path> <path style="fill:#D1E7E8;" d="M488,244c0,134.4-109.6,228.8-244,228.8S0,378.4,0,244S109.6,15.2,244,15.2S488,109.6,488,244z"></path> <g> <path style="fill:#BFDBDB;" d="M244,15.2c134.4,0,244,93.6,244,228.8c0,134.4-109.6,228.8-244,228.8"></path> <path style="fill:#BFDBDB;" d="M428,244c0,101.6-82.4,172.8-184,172.8S60,345.6,60,244S142.4,58.4,244,58.4S428,142.4,428,244z"></path> <path style="fill:#BFDBDB;" d="M428,244c0,101.6-82.4,188-184,188S60,345.6,60,244S142.4,71.2,244,71.2S428,142.4,428,244z"></path> </g> <path style="fill:#DAEFEF;" d="M428,244c0,101.6-82.4,172.8-184,172.8S60,345.6,60,244S142.4,71.2,244,71.2S428,142.4,428,244z"></path> <path style="fill:#C5E2E2;" d="M244,71.2c101.6,0,184,71.2,184,172.8s-82.4,172.8-184,172.8"></path> <path style="fill:#F0F7F7;" d="M244,379.2c-81.6,0-142.4-57.6-142.4-133.6S162.4,111.2,244,111.2s142.4,57.6,142.4,133.6 S325.6,379.2,244,379.2z M244,126.4c-72.8,0-127.2,51.2-127.2,118.4c0,68,54.4,119.2,127.2,119.2s127.2-51.2,127.2-118.4 C371.2,177.6,316.8,126.4,244,126.4z"></path> <path style="fill:#E7F7F6;" d="M371.2,245.6c0,67.2-54.4,118.4-127.2,118.4v15.2c81.6,0,142.4-57.6,142.4-133.6 S325.6,111.2,244,111.2v15.2C316.8,126.4,371.2,177.6,371.2,245.6z"></path> </g></svg>-->


            <!--                                                <svg height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"-->
            <!--                             xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"-->
            <!--                             fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>-->
            <!--                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>-->
            <!--                            <g id="SVGRepo_iconCarrier"> <path style="fill:#FFE14D;"-->
            <!--                                                               d="M256,512C114.837,512,0,397.157,0,256S114.837,0,256,0s256,114.843,256,256S397.163,512,256,512z"></path>-->
            <!--                                <path style="fill:#FFCC33;"-->
            <!--                                      d="M512,256C512,114.843,397.163,0,256,0v512C397.163,512,512,397.157,512,256z"></path>-->
            <!--                                <path style="fill:#FF9F19;"-->
            <!--                                      d="M256,33.391C133.25,33.391,33.391,133.256,33.391,256S133.25,478.609,256,478.609 S478.609,378.744,478.609,256S378.75,33.391,256,33.391z M256,445.217c-104.337,0-189.217-84.881-189.217-189.217 S151.663,66.783,256,66.783S445.217,151.663,445.217,256S360.337,445.217,256,445.217z"></path>-->
            <!--                                <path style="fill:#F28618;"-->
            <!--                                      d="M445.217,256c0,104.337-84.881,189.217-189.217,189.217v33.391 c122.75,0,222.609-99.864,222.609-222.609S378.75,33.391,256,33.391v33.391C360.337,66.783,445.217,151.663,445.217,256z"></path>-->
            <!--                                <path style="fill:#FF9F19;"-->
            <!--                                      d="M317.217,300.522c0,27.937-18.922,51.534-44.522,58.88v7.903c0,9.238-7.456,16.696-16.696,16.696 s-16.696-7.457-16.696-16.696v-7.903c-25.6-7.346-44.522-30.943-44.522-58.88c0-9.238,7.456-16.696,16.696-16.696 c9.239,0,16.696,7.457,16.696,16.696c0,15.36,12.466,27.826,27.826,27.826s27.826-12.466,27.826-27.826 c0-0.779-0.111-1.224-0.223-1.558c-1.336-8.682-13.802-16.473-27.603-24.042c-2.56-1.337-5.231-2.783-7.791-4.119 c-23.82-12.576-53.426-28.27-53.426-59.324c0-27.937,18.922-51.534,44.522-58.88v-7.903c0-9.238,7.456-16.696,16.696-16.696 s16.696,7.457,16.696,16.696v7.903c25.6,7.346,44.522,30.943,44.522,58.88c0,9.238-7.456,16.696-16.696,16.696 s-16.696-7.457-16.696-16.696c0-15.36-12.466-27.826-27.826-27.826s-27.826,12.466-27.826,27.826c0,9.238,13.133,17.586,27.826,25.6 c2.56,1.336,5.231,2.783,7.791,4.118C287.612,253.774,317.217,269.468,317.217,300.522z"></path>-->
            <!--                                <g> <path style="fill:#F28618;"-->
            <!--                                          d="M317.217,300.522c0,27.937-18.922,51.534-44.522,58.88v7.903c0,9.238-7.456,16.696-16.696,16.696 v-55.652c15.36,0,27.826-12.466,27.826-27.826c0-0.779-0.111-1.224-0.223-1.558c-1.336-8.682-13.802-16.473-27.603-24.042v-37.843 c2.56,1.336,5.231,2.783,7.791,4.118C287.612,253.774,317.217,269.468,317.217,300.522z"></path>-->
            <!--                                    <path style="fill:#F28618;"-->
            <!--                                          d="M283.826,211.478c0,9.223,7.479,16.696,16.696,16.696c9.217,0,16.696-7.473,16.696-16.696 c0-27.961-18.869-51.551-44.522-58.843v-7.939c0-9.223-7.479-16.696-16.696-16.696v55.652 C271.348,183.652,283.826,196.136,283.826,211.478z"></path> </g> </g></svg>-->


            <!--
                                    <span id="coinsCount" class="text-white font-bold text-4xl">{{ `X ${goldCoins}` }}</span> -->


            <!-- Codigo nuevo para monedas -->
            <!-- <div>
              <div v-if="goldCoins < 1 || getUsersLocalStorage().coinChangerAuto === true" class="lg:w-32 xl:w-40 2xl:w-52 h-10 absolute z-20"></div>
              <div
                  :class="`item-palette-gold__div--container ${goldCoinsChangeActive} lg:w-32 xl:w-40 2xl:w-52 h-10 bg-blue-950 rounded-3xl flex justify-center items-center border-2 border-cyan-400 hover:bg-yellow-400 hover:scale-95 hover:border-violet-50 cursor-pointer duration-300`"
                  @mouseenter="openAnimation('store')" @mouseleave="closeAnimation()" @click="storeAccess()">
                <img class="item-palette-gold__img--gold-coin w-10 duration-300 ease-in-out" v-for="index in goldCoins"
                     :key="index" :src="IconGoldCoin" alt="golden-coin"/>
                <img class="item-palette__img--changer-icon w-0 absolute duration-300" :src="IconChanger"
                     alt="changer"/>
              </div>
            </div>

            <div>
              <div v-if="silverCoins < 3 || getUsersLocalStorage().coinChangerAuto === true" class="lg:w-32 xl:w-40 2xl:w-52 h-10 absolute z-20"></div>
              <div
                  :class="`item-palette-silver__div--container ${silverCoinsChangeActive} lg:w-32 xl:w-40 2xl:w-52 h-10 bg-blue-950 rounded-3xl flex justify-center items-center border-2 border-cyan-400 hover:bg-gray-400 hover:scale-95 hover:border-violet-50 cursor-pointer duration-300`"
                  @mouseenter="openAnimation('changer')" @mouseleave="closeAnimation()" @click="openCoinChanger()">
                <img class="item-palette-silver__img--silver-coin w-10 duration-300 ease-in-out"
                     v-for="index in silverCoins" :key="index" :src="IconSilverCoin" alt="silver-coin"/>
                <img class="item-palette__img--changer-icon w-0 absolute duration-300" :src="IconChanger"
                     alt="changer"/>
              </div>
            </div>

            <div>
              <div v-if="bronzeCoins < 3 || getUsersLocalStorage().coinChangerAuto === true" class="lg:w-32 xl:w-40 2xl:w-52 h-10 absolute z-20"></div>
              <div
                  :class="`item-palette-bronze__div--container ${bronzeCoinsChangeActive} lg:w-32 xl:w-40 2xl:w-52 h-10 bg-blue-950 rounded-3xl flex justify-center items-center border-2 border-cyan-400 hover:bg-amber-700 hover:scale-95 hover:border-violet-50 cursor-pointer duration-300`"
                  @mouseenter="openAnimation('changer')" @mouseleave="closeAnimation()" @click="openCoinChanger()">
                <img class="item-palette-bronze__img--bronze-coin w-10 duration-300 ease-in-out"
                     v-for="index in bronzeCoins" :key="index" :src="IconBronzeCoin" alt="bronze-coin"/>
                <img class="item-palette__img--changer-icon w-0 absolute duration-300" :src="IconChanger"
                     alt="changer"/>
              </div>
            </div> -->


            <CoinsComponent :goldCoins="goldCoins" :silverCoins="silverCoins" :bronzeCoins="bronzeCoins" :goldCoinsChangeActive="goldCoinsChangeActive" :silverCoinsChangeActive="silverCoinsChangeActive" :bronzeCoinsChangeActive="bronzeCoinsChangeActive" :openAnimation="openAnimation" :closeAnimation="closeAnimation" :storeAccess="storeAccess" :openCoinChanger="openCoinChanger"/>

          </div>

          <div id="addCoin" class="flex justify-center col-span-2 items-center gap-2 hidden opacity-0 duration-300">
            <div class="loader border-r-2 rounded-full border-yellow-500 bg-yellow-300 animate-bounce shadow-xl shadow-yellow-400
                                aspect-square w-8 flex justify-center items-center text-yellow-700">$
            </div>
            <span class="text-white font-bold text-xl duration-300">+1</span>
          </div>
        </div>

        <!--
                        <div
                            class="bg-red-100 col-span-2 flex justify-center m-3 p-2 rounded-md border-orange-400 border-4 border-dashed">
                            <span class="font-semibold text-xl text-center">Paleta de colores</span>
                        </div> -->
        <div @click="selectItemPalette(item)" v-for="item, index in props.items" :key="index"
             class="flex justify-center items-center w-full h-full">
          <button
              :class="['bg-gray-100 shadow-md rounded-lg hover:opacity-75 hover:scale-95 duration-300 select-none font-bold text-6xl w-20 h-20 flex justify-center items-center' ,
                        // {'py-[30%] px-[35%]' : item.type !== types.image && item.type !== types.figure },
                        // {'py-[18%] px-[16%]' : item.type === types.color },
                        // {'py-[12%] px-[20%]' : item.type === types.letter },
                        // {'py-[26%] px-[26%]' : (item.type === types.image || item.type === types.figure ) && item.size === sizes.small },
                        // {'py-[20%] px-[20%]' : (item.type === types.image || item.type === types.figure ) && item.size === sizes.normal },
                        // {'py-[16%] px-[16%]' : (item.type === types.image || item.type === types.figure ) && item.size === sizes.big }
                        ]">

            {{ item.type === types.letter || item.type === types.number ? item.name : null }}

            <IconPaintBrush v-if="item.type === types.color" :hex="item.hex"/>

            <img v-if="item.type === types.image || item.type === types.figure || item.type === types.eraser"
                 :src="item.content" alt=""
                 :class="['non-draggable',
                                 {'w-[30px]' : item.size === sizes.small},
                                 {'w-[40px]' : item.size === sizes.normal},
                                 {'w-[50px]' : item.size === sizes.big} ]">
          </button>
        </div>

        <div class="col-span-2 m-3">
          <div id="itemScreen"
               :class="`border-2 border-black h-14 col-span-2 shadow-xl rounded-md flex justify-center font-bold text-5xl bg-white`">
            {{ itemSelected ? itemSelected.name : null }}
            <img v-if="itemImg" :src="itemImg" alt="" :width="itemSize">
          </div>
        </div>

        <div class="col-span-2 flex justify-center">
          <!-- <a :href="nextUrl"> -->
            <button v-if="buttonNextLevel || coinChangerClose && buttonNextLevel" @click="nextLevel" id="nextLevelButton"
                    class="bg-yellow-infinite py-5 px-12 border-yellow-600 border-4 rounded-md shadow-xl shadow-yellow-400 hidden">

              <div class="arrow">
                <span></span>
                <span></span>
                <span></span>
              </div>

            </button>
          <!-- </a> -->
        </div>

      </div>
    </div>
  </div>
</template>

<style scoped>
.non-draggable {
  user-select: none;
  pointer-events: none;
}

.bg-yellow-infinite {
  animation: yellow-infinite 2.5s infinite;
}

@keyframes yellow-infinite {
  0% {
    border-color: #fef08a;
    background-color: #facc15;
  }

  50% {
    background-color: #fef08a;
  }

  100% {
    border-color: #fef08a;
    background-color: #facc15;
  }
}

.arrow {
  transform: rotate(-90deg);
  cursor: pointer;
}

.arrow span {
  display: block;
  width: 15px;
  height: 15px;
  border-bottom: 5px solid black;
  border-right: 5px solid black;
  transform: rotate(45deg);
  margin: -15px;
  animation: animate28797 2s infinite;
}

.arrow span:nth-child(2) {
  animation-delay: -0.2s;
}

.arrow span:nth-child(3) {
  animation-delay: -0.4s;
}

@keyframes animate28797 {
  0% {
    opacity: 0;
    transform: rotate(45deg) translate(-20px, -20px);
  }

  50% {
    opacity: 1;
  }

  100% {
    opacity: 0;
    transform: rotate(45deg) translate(20px, 20px);
  }
}
</style>
