<script setup>
import "../sections/HelpCharacter.vue";
import HelpCharacter from "../sections/HelpCharacter.vue";
import ItemPalette from "../sections/ItemPalette.vue";
import ProgressBar from "../sections/ProgressBar.vue";
import HorizontalItemPalette from "../sections/HorizontalItemPalette.vue";
import WinView from "../templates/WinView.vue";
import {
  types,
  localHost,
  sizes,
  getSelectItem,
  talk,
  talkCharacter,
  paintItem,
  errorPaint,
  // updateCoins,
  getCoins,
  playAudio,
  setOnEnded,
  showItemsPresentation,
  verifyFileExistence,
  resolveAudio,
  playSuccessShortRandom,
  showCheckIcon,
  showErrorIcon
} from '../../use';
import {onMounted, onUnmounted, ref} from "vue";
import IconArrowRight from "../icons/IconArrowRight.vue";
import Swal from "sweetalert2";
import BackgroundActivities from "../background/BackgroundActivities.vue";
import CoinChangerVortex from '../../components/activities/Coin Changer/CoinChangerVortex.vue';
import CoinChanger from '../../components/activities/Coin Changer/CoinChanger.vue';

const props = defineProps({
  size: {type: Number},
  fill_sample: {type: Array},
  solution: {type: Array},
  level: {type: Array},
  items: {type: Array},
  rotate: {type: Boolean},
  phase: {type: Number},
  fake_items: {type: Array},
  create_audio_1: {type: String},
  create_audio_2: {type: String},
  create_audio_3: {type: String},
  create_audio_4: {type: String},
  type: {type: String},
});

const items = props.items
const talkBool = ref(false)
const levelComplete = ref(false)
const inTutorial = ref(false)
let currentAudio = ref(null);
const coinChangerVortexRef = ref(false);
const vortexType = ref("");
const selectedLevelVortex = ref(false);
const selectedCoinChanger = ref(false);
const coinChangerCloseUser = ref(false);
const updateCoins = ref(false);
const winCoinRef = ref(false);//Creado para determinar si el nivel se reclaman monedas y que tipo de moneda
const winCoinViewAnimation = ref(false);//Creado para mostrar animacion si se cumplen requisitos

//Establecemos la ubicacion actual del software en el storage
localStorage.setItem('currentLocation', `${localHost}/level${props.level[0]}/${props.level[1]}`);

let character = document.getElementById('character');

const showInitialAlert = () => {
  Swal.fire({
    showConfirmButton: false,
    html: swalHtml,
    width: "30rem",
  }).then((result) => {
    intro(props.phase);
    // prepareActivity()
  });
}

const swalHtml = `
    <div class="flex justify-center items-center text-center">
                  <div>

                    <div
                        class="bg-[url('https://cdn.pixabay.com/photo/2020/09/28/16/29/leaves-5610361_640.png')] font-press-start rounded shadow-2xl border-4 border-yellow-700 border-dashed my-6 py-12 px-4" style="background-position: center; background-size: cover;">
                        <span class="border-4 border-yellow-700 border-dashed py-4 bg-yellow-500 pl-4 pr-4 text-yellow-800">RETO ${props.level[1]}</span> <br> <br> <br>
                      <span class="text-yellow-400">Patrones</span>
                      <span class="text-blue-400"> en la </span>
                      <span class="text-red-400">Cinta</span>
                      <br>
                      <br>
                      <span class="text-gray-200">¡Completa y Crea!</span>
                    </div>
                    <button onmouseenter="playHoverSound('svgPlay')" onmouseleave="leaveMouse('svgPlay')"
                            onclick="Swal.clickConfirm()" class="btn-frog"><i class="animation"></i>
                      <div class="translate-x-[10px]">
                        Comenzar
                      </div>
                      <div>
                        <svg id="svgPlay" width="20px" fill="#fff" viewBox="0 0 32 32" version="1.1"
                             xmlns="http://www.w3.org/2000/svg">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier"><title>play</title>
                            <path
                                d="M5.92 24.096q0 1.088 0.928 1.728 0.512 0.288 1.088 0.288 0.448 0 0.896-0.224l16.16-8.064q0.48-0.256 0.8-0.736t0.288-1.088-0.288-1.056-0.8-0.736l-16.16-8.064q-0.448-0.224-0.896-0.224-0.544 0-1.088 0.288-0.928 0.608-0.928 1.728v16.16z"></path>
                          </g>
                        </svg>
                      </div>
                      <i class="animation"></i>
                    </button>
                  </div>
                </div>
  `;


// Inicializacion de la actividad

let boxSize = ref(0)

const updateBoxSize = () => {
  if (window.innerWidth <= 1024) {
    // Para pantallas menores a 1024px
    boxSize.value = 48
    if (props.size >= 30) {
      boxSize.value = 24
    }
  } else if (window.innerWidth <= 1440 && window.innerWidth > 1024) {
    // Para pantallas mayores a 1024px y menor igual a 1440px
    boxSize.value = 66

    if (props.size >= 30) {
      boxSize.value = 30
    }
  } else {
    // Para pantallas mayores a 1440px

    if (props.size <= 18) {
      boxSize.value = 80;
    } else if (props.size < 30) {
      boxSize.value = 72
    } else if (props.size >= 30) {
      boxSize.value = 36
    }
  }
}
let totalActivities = ref(0)
onMounted(async () => {
  await axios.get('/activityCount/' + props.level[0])
      .then(response => totalActivities.value = response.data);

  showInitialAlert()

  updateBoxSize();
  window.addEventListener('resize', updateBoxSize);
})

onUnmounted(() => {
  window.removeEventListener('resize', updateBoxSize);
})

const showBlackScreen = () => {
  let blackScreen = document.getElementById('blackScreen')
  blackScreen.classList.remove('hidden')
  setTimeout(function () {
    blackScreen.classList.replace('opacity-0', 'opacity-60')
  }, 500)
}

const removeBlackScreen = () => {
  let blackScreen = document.getElementById('blackScreen')
  blackScreen.classList.replace('opacity-60', 'opacity-0')
  setTimeout(function () {
    blackScreen.classList.add('hidden')
  }, 500)
}
const showIntroductionHelp = () => {

  talkBool.value = true
  talkCharacter(
      `${localHost}/images/characters/robot/v1/still/notFace.png`,
      `${localHost}/images/characters/robot/v1/happyTalk.gif`
  );

  let i = 0;
  const playNextAudio = () => {
    // Ejecuta una itereacion por cada item
    if (i < props.fill_sample.length) {
      let audio = null;

      console.log(props.fill_sample.length - 1)
      if (i === props.fill_sample.length - 1) {
        console.log('Ultimo item');
        verifyFileExistence(`${localHost}/audios/items/and/${items[props.fill_sample[i] - 1].name}.m4a`, function (exist) {
          if (exist) {
            console.log(`Ultimo item con Audio`);
          } else {
            console.log('Ultimo item sin Audio')
            resolveAudio(`y ${items[props.fill_sample[props.fill_sample.length - 1] - 1].name}`, `${items[props.fill_sample[props.fill_sample.length - 1] - 1].name}`, 'items/and', '0.9');
          }
        });

        audio = playAudio(`${localHost}/audios/items/and/${items[props.fill_sample[i] - 1].name}.m4a`);

        localStorage.setItem('itemSelected', JSON.stringify(items[props.fill_sample[i] - 1]))
        paintItem(`${i + 1}`, items)

      } else {
        localStorage.setItem('itemSelected', JSON.stringify(items[props.fill_sample[i] - 1]))
        paintItem(`${i + 1}`, items)

        audio = playAudio(`${localHost}/audios/items/${items[props.fill_sample[i] - 1].name}.m4a`);
      }
      setOnEnded(audio, playNextAudio);

      currentAudio.value = audio;

      i++;
    } else {
      //Fin de la presentacion de ayuda

      let audio4Route = `${localHost}/audios/start/linePattern/4.m4a`
      if (props.type === 'number') {
        audio4Route = `${localHost}/audios/start/linePattern/numbers/4.m4a`
      } else if (props.type === 'figures') {
        audio4Route = `${localHost}/audios/start/linePattern/figures/4.m4a`
      } else if (props.type === 'letters') {
        audio4Route = `${localHost}/audios/start/linePattern/letters/4.m4a`
      } else if (props.type === 'colors') {
        audio4Route = `${localHost}/audios/start/linePattern/colors/4.m4a`
      } else if (props.type === 'animals') {
        audio4Route = `${localHost}/audios/start/linePattern/animals/4.m4a`
      } else if (props.type === 'fruits') {
        audio4Route = `${localHost}/audios/start/linePattern/fruits/4.m4a`
      }

      if (props.create_audio_4) {
        audio4Route = `${localHost}/audios/start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}/4.m4a`
      }

      let audio4 = playAudio(audio4Route);
      currentAudio.value = audio4;

      setOnEnded(audio4, () => {
        talkCharacter(`${localHost}/images/characters/robot/v1/still/notFace.png`, `${localHost}/images/characters/robot/v1/still/notFace.png`)
        talkBool.value = false
        inTutorial.value = false
        currentAudio.value = null;
      });

      prepareActivity()
      removeBlackScreen()
    }

    localStorage.setItem('itemSelected', JSON.stringify(null))

  }
  playNextAudio();
}

const intro = (phase) => {

  let audio1Route = `${localHost}/audios/start/linePattern/1.m4a`
  let audio2Route = `${localHost}/audios/start/linePattern/2.m4a`
  let audio3Route = `${localHost}/audios/start/linePattern/3.m4a`
  let audio4Route = `${localHost}/audios/start/linePattern/4.m4a`

  console.log(audio2Route)

  if (props.type === 'number') {
    audio1Route = `${localHost}/audios/start/linePattern/numbers/1.m4a`
    audio2Route = `${localHost}/audios/start/linePattern/numbers/2.m4a`
    audio3Route = `${localHost}/audios/start/linePattern/numbers/3.m4a`
    audio4Route = `${localHost}/audios/start/linePattern/numbers/4.m4a`
  } else if (props.type === 'figures') {
    audio1Route = `${localHost}/audios/start/linePattern/figures/1.m4a`
    audio2Route = `${localHost}/audios/start/linePattern/figures/2.m4a`
    audio3Route = `${localHost}/audios/start/linePattern/figures/3.m4a`
    audio4Route = `${localHost}/audios/start/linePattern/figures/4.m4a`
  } else if (props.type === 'letters') {
    audio1Route = `${localHost}/audios/start/linePattern/letters/1.m4a`
    audio2Route = `${localHost}/audios/start/linePattern/letters/2.m4a`
    audio3Route = `${localHost}/audios/start/linePattern/letters/3.m4a`
    audio4Route = `${localHost}/audios/start/linePattern/letters/4.m4a`
  } else if (props.type === 'colors') {
    audio1Route = `${localHost}/audios/start/linePattern/colors/1.m4a`
    audio2Route = `${localHost}/audios/start/linePattern/colors/2.m4a`
    audio3Route = `${localHost}/audios/start/linePattern/colors/3.m4a`
    audio4Route = `${localHost}/audios/start/linePattern/colors/4.m4a`
  } else if (props.type === 'animals') {
    audio1Route = `${localHost}/audios/start/linePattern/animals/1.m4a`
    audio2Route = `${localHost}/audios/start/linePattern/animals/2.m4a`
    audio3Route = `${localHost}/audios/start/linePattern/animals/3.m4a`
    audio4Route = `${localHost}/audios/start/linePattern/animals/4.m4a`
  } else if (props.type === 'fruits') {
    audio1Route = `${localHost}/audios/start/linePattern/fruits/1.m4a`
    audio2Route = `${localHost}/audios/start/linePattern/fruits/2.m4a`
    audio3Route = `${localHost}/audios/start/linePattern/fruits/3.m4a`
    audio4Route = `${localHost}/audios/start/linePattern/fruits/4.m4a`
  }

  if (props.create_audio_1) {
    audio1Route = `${localHost}/audios/start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}/1.m4a`
  }
  if (props.create_audio_2) {
    audio2Route = `${localHost}/audios/start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}/2.m4a`
  }
  if (props.create_audio_3) {
    audio3Route = `${localHost}/audios/start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}/3.m4a`
  }
  if (props.create_audio_4) {
    audio4Route = `${localHost}/audios/start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}/4.m4a`
  }

  if (phase === 1) {
    inTutorial.value = true
    showBlackScreen()
    showIntroductionHelp()
    return;
  }

  if (phase === 2) {
    // prepareActivity()
    inTutorial.value = true
    talkBool.value = true
    talkCharacter(
        `${localHost}/images/characters/robot/v1/still/notFace.png`,
        `${localHost}/images/characters/robot/v1/still/notFace.png`
    );
    showBlackScreen()
    let audio2 = playAudio(audio2Route)
    setOnEnded(audio2, () => {
      showItemsPresentation(items, showIntroductionHelp, props.fake_items, audio3Route, currentAudio);
      // showItemsPresentation(items, removeBlackScreen, props.fake_items, audio4Route, currentAudio, 'robot.png');
    });
    return;
  }

  if (phase === 3) {
    prepareActivity()
    return
  }

  if (phase === -1) {
    win()
    return;
  }
  talk(false)

  // Comienza a reproducir el audio inicial
  inTutorial.value = true
  let audio1 = playAudio(audio1Route);
  currentAudio.value = audio1;
  talkBool.value = true

  // Muestra el personaje hablando
  talkCharacter(
      `${localHost}/images/characters/robot/v1/still/notFace.png`,
      `${localHost}/images/characters/robot/v1/talk.gif`
  );

  // Cuando el audio 1 termina, reproduce el audio 2
  let audio2 = new Audio(audio2Route);


  // SetOnEnded es una funcion que se encarga de ejecutar una funcion cuando el audio termina el primer parametro es
  // el audio y el segundo es la funcion a ejecutar

  setOnEnded(audio1, () => {
    audio2.play();
    currentAudio.value = audio2;
    showBlackScreen();
  });
  // setOnEnded(audio2, showItemsPresentation(items, showHelp));
  setOnEnded(audio2, () => {
    talkBool.value = false;
    showItemsPresentation(items, showIntroductionHelp, props.fake_items, audio3Route, currentAudio);
  });
}
let boxes = ref([])
const prepareActivity = () => {
  let orderArray = []
  for (let i = 0; i <= props.fill_sample.length - 1; i++) {
    let order = props.fill_sample[i] - 1
    orderArray.push(order)
    if (orderArray[i] === -1) {
      continue
    }
    let item = items[orderArray[i]]
    localStorage.setItem('itemSelected', JSON.stringify(item))
    paintItem(`${i + 1}`, items)

    boxes.value[i] = true

    localStorage.setItem('itemSelected', JSON.stringify(null))
  }
}

const generateAudios = (audioNumber) => {

  if (props.type === 'number') {
    switch (audioNumber) {
      case 1:
        resolveAudio('¡Preparados para otro desafío en el espacio infinito! ¡Que la exploración continúe!, ', '1', 'start/linePattern/numbers', '0.9');
        break;
      case 2:
        resolveAudio('Observa que en el centro de la pantalla hay una cinta de forma horizontal que se encuentra incompleta. Deberás utilizar los números.', '2', 'start/linePattern/numbers', '0.9');
        break;
      case 3:
        resolveAudio('Para poder completar esta cinta ... Sigue el mismo patrón que se ha definido. ', '3', 'start/linePattern/numbers', '0.9');
        break;
      case 4:
        resolveAudio('Continúa utilizando los números. de la misma forma para superar este reto.', '4', 'start/linePattern/numbers', '0.9');
        break;
    }
  } else if (props.type === 'figures') {
    switch (audioNumber) {
      case 1:
        resolveAudio('¡Preparados para otro desafío en el espacio infinito! ¡Que la exploración continúe!, ', '1', 'start/linePattern/figures', '0.9');
        break;
      case 2:
        resolveAudio('Observa que en el centro de la pantalla hay una cinta de forma horizontal que se encuentra incompleta. Deberás utilizar las figuras.', '2', 'start/linePattern/figures', '0.9');
        break;
      case 3:
        resolveAudio('Para poder completar esta cinta ... Sigue el mismo patrón que se ha definido. ', '3', 'start/linePattern/figures', '0.9');
        break;
      case 4:
        resolveAudio('Continúa utilizando las figuras de la misma forma para superar este reto.', '4', 'start/linePattern/figures', '0.9');
        break;
    }
  } else if (props.type === 'letters') {
    switch (audioNumber) {
      case 1:
        resolveAudio('¡Preparados para otro desafío en el espacio infinito! ¡Que la exploración continúe!, ', '1', 'start/linePattern/letters', '0.9');
        break;
      case 2:
        resolveAudio('Observa que en el centro de la pantalla hay una cinta de forma horizontal que se encuentra incompleta. Deberás utilizar las letras.', '2', 'start/linePattern/letters', '0.9');
        break;
      case 3:
        resolveAudio('Para poder completar esta cinta ... Sigue el mismo patrón que se ha definido. ', '3', 'start/linePattern/letters', '0.9');
        break;
      case 4:
        resolveAudio('Continúa utilizando las letras de la misma forma para superar este reto.', '4', 'start/linePattern/letters', '0.9');
        break;
    }
  } else if (props.type === 'colors') {
    switch (audioNumber) {
      case 1:
        resolveAudio('¡Preparados para otro desafío en el espacio infinito! ¡Que la exploración continúe!, ', '1', 'start/linePattern/colors', '0.9');
        break;
      case 2:
        resolveAudio('Observa que en el centro de la pantalla hay una cinta de forma horizontal que se encuentra incompleta. Deberás utilizar los colores.', '2', 'start/linePattern/colors', '0.9');
        break;
      case 3:
        resolveAudio('Para poder completar esta cinta ... Sigue el mismo patrón que se ha definido. ', '3', 'start/linePattern/colors', '0.9');
        break;
      case 4:
        resolveAudio('Continúa utilizando los colores de la misma forma para superar este reto.', '4', 'start/linePattern/colors', '0.9');
        break;
    }
  } else if (props.type === 'animals') {
    switch (audioNumber) {
      case 1:
        resolveAudio('¡Preparados para otro desafío en el espacio infinito! ¡Que la exploración continúe!, ', '1', 'start/linePattern/animals', '0.9');
        break;
      case 2:
        resolveAudio('Observa que en el centro de la pantalla hay una cinta de forma horizontal que se encuentra incompleta. Deberás utilizar los animales.', '2', 'start/linePattern/animals', '0.9');
        break;
      case 3:
        resolveAudio('Para poder completar esta cinta ... Sigue el mismo patrón que se ha definido. ', '3', 'start/linePattern/animals', '0.9');
        break;
      case 4:
        resolveAudio('Continúa utilizando los animales de la misma forma para superar este reto.', '4', 'start/linePattern/animals', '0.9');
        break;
    }
  } else if (props.type === 'fruits') {
    switch (audioNumber) {
      case 1:
        resolveAudio('¡Preparados para otro desafío en el espacio infinito! ¡Que la exploración continúe!, ', '1', 'start/linePattern/fruits', '0.9');
        break;
      case 2:
        resolveAudio('Observa que en el centro de la pantalla hay una cinta de forma horizontal que se encuentra incompleta. Deberás utilizar las frutas.', '2', 'start/linePattern/fruits', '0.9');
        break;
      case 3:
        resolveAudio('Para poder completar esta cinta ... Sigue el mismo patrón que se ha definido. ', '3', 'start/linePattern/fruits', '0.9');
        break;
      case 4:
        resolveAudio('Continúa utilizando las frutas de la misma forma para superar este reto.', '4', 'start/linePattern/fruits', '0.9');
        break;
    }
  } else {
    switch (audioNumber) {
      case 1:
        resolveAudio('¡Preparados para otro desafío en el espacio infinito! ¡Que la exploración continúe!, ', '1', 'start/linePattern', '0.9');
        break;
      case 2:
        resolveAudio('Observa que en el centro de la pantalla hay una cinta de forma horizontal que se encuentra incompleta. Deberás utilizar.', '2', 'start/linePattern', '0.9');
        break;
      case 3:
        resolveAudio('Para poder completar esta cinta ... Sigue el mismo patrón que se ha definido. ', '3', 'start/linePattern', '0.9');
        break;
      case 4:
        resolveAudio('Continúa coloreando de la misma forma para superar este reto.', '4', 'start/linePattern', '0.9');
        break;
    }
  }
}

verifyAudiosNumber(4)

function verifyAudiosNumber(number) {

  // Verificacion de archivos perzonaliados
  if (props.create_audio_1) {
    verifyFileExistence(`${localHost}/audios/start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}/1.m4a`, function (exist) {
      if (exist) {
        console.log(`El archivo persoanlizado 1.m4a existe.`);
      } else {
        resolveAudio(props.create_audio_1, '1', `start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}`, '0.9');
        console.log(`El archivo persoanlizado 1.m4a no existe.`);
      }
    });
  }

  if (props.create_audio_2) {
    verifyFileExistence(`${localHost}/audios/start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}/2.m4a`, function (exist) {
      if (exist) {
        console.log(`El archivo persoanlizado 2.m4a existe.`);
      } else {
        resolveAudio(props.create_audio_2, '2', `start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}`, '0.9');
        console.log(`El archivo persoanlizado 2.m4a no existe.`);
      }
    });
  }

  if (props.create_audio_3) {
    verifyFileExistence(`${localHost}/audios/start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}/3.m4a`, function (exist) {
      if (exist) {
        console.log(`El archivo persoanlizado 3.m4a existe.`);
      } else {
        resolveAudio(props.create_audio_3, '3', `start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}`, '0.9');
        console.log(`El archivo persoanlizado 3.m4a no existe.`);
      }
    });
  }

  if (props.create_audio_4) {
    verifyFileExistence(`${localHost}/audios/start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}/4.m4a`, function (exist) {
      if (exist) {
        console.log(`El archivo persoanlizado 4.m4a existe.`);
      } else {
        resolveAudio(props.create_audio_4, '4', `start/linePattern/personalized/level_${props.level[0]}-${props.level[1]}`, '0.9');
        console.log(`El archivo persoanlizado 4.m4a no existe.`);
      }
    });
  }

  // Verificacion de archivos generales
  for (let i = 1; i <= number; i++) {
    verifyFileExistence(`${localHost}/audios/start/linePattern/${i}.m4a`, function (exist) {
      if (exist) {
        console.log(`El archivo ${i}.m4a existe.`);
      } else {
        generateAudios(i);
        console.log(`El archivo ${i}.m4a no existe.`);
      }
    });
  }

  console.log(props.type)

  // Verificacion de archivos de numeros
  if (props.type === 'number') {
    for (let i = 1; i <= number; i++) {
      verifyFileExistence(`${localHost}/audios/start/linePattern/numbers/${i}.m4a`, function (exist) {
        if (exist) {
          console.log(`El archivo numbers/${i}.m4a existe.`);
        } else {
          generateAudios(i);
          console.log(`El archivo numbers/${i}.m4a no existe.`);
        }
      });
    }
  } else if (props.type === 'figures') {
    for (let i = 1; i <= number; i++) {
      verifyFileExistence(`${localHost}/audios/start/linePattern/figures/${i}.m4a`, function (exist) {
        if (exist) {
          console.log(`El archivo figures/${i}.m4a existe.`);
        } else {
          generateAudios(i);
          console.log(`El archivo figures/${i}.m4a no existe.`);
        }
      });
    }
  } else if (props.type === 'letters') {
    for (let i = 1; i <= number; i++) {
      verifyFileExistence(`${localHost}/audios/start/linePattern/letters/${i}.m4a`, function (exist) {
        if (exist) {
          console.log(`El archivo letters/${i}.m4a existe.`);
        } else {
          generateAudios(i);
          console.log(`El archivo letters/${i}.m4a no existe.`);
        }
      });
    }
  } else if (props.type === 'colors') {
    for (let i = 1; i <= number; i++) {
      verifyFileExistence(`${localHost}/audios/start/linePattern/colors/${i}.m4a`, function (exist) {
        if (exist) {
          console.log(`El archivo colors/${i}.m4a existe.`);
        } else {
          generateAudios(i);
          console.log(`El archivo colors/${i}.m4a no existe.`);
        }
      });
    }
  } else if (props.type === 'animals') {
    for (let i = 1; i <= number; i++) {
      verifyFileExistence(`${localHost}/audios/start/linePattern/animals/${i}.m4a`, function (exist) {
        if (exist) {
          console.log(`El archivo animals/${i}.m4a existe.`);
        } else {
          generateAudios(i);
          console.log(`El archivo animals/${i}.m4a no existe.`);
        }
      });
    }
  } else if (props.type === 'fruits') {
    for (let i = 1; i <= number; i++) {
      verifyFileExistence(`${localHost}/audios/start/linePattern/fruits/${i}.m4a`, function (exist) {
        if (exist) {
          console.log(`El archivo fruits/${i}.m4a existe.`);
        } else {
          generateAudios(i);
          console.log(`El archivo fruits/${i}.m4a no existe.`);
        }
      });
    }
  }
}

const showHelp = () => {

}

let step = ref(0)
let showExpression = ref(false)

const paintBox = (id) => {
  if (levelComplete.value || inTutorial.value) {
    playAudio(`${localHost}/audios/effects/wood.wav`)
    return
  }

  let itemSelected = getSelectItem()

  if (itemSelected.type === types.eraser) {
    errorPaint(id)
    return
  }

  let patternIndex = (id - 1) % props.solution.length;

  if (itemSelected.content === items[(props.solution[patternIndex]) - 1].content) {
    // Si tiene un acierto
    paintItem(id, items)


    let bubble = new Audio()
    bubble.src = `${localHost}/audios/effects/soapBubble.wav`
    bubble.play()

    // playSuccessShortRandom(talkBool.value)
    // talkCharacter(`${localHost}/images/characters/robot/v1/still/notFace.png`, `${localHost}/images/characters/robot/v1/still/notFace.png`)
    // setTimeout(function () {
    //   talkCharacter(`${localHost}/images/characters/robot/v1/still/notFace.png`, `${localHost}/images/characters/robot/v1/still/notFace.png`)
    // }, 5000)

    //Esta linea causa que no se termine el nivel___________________________________________________________________//____________________________
    // character.src = `${localHost}/images/characters/robot/v1/still/happy.png`;

    // console.log("local host valor", `${localHost}/images/characters/robot/v1/still/happy.png`);

    // if (showExpression.value === false) {
    //   showExpression.value = true
    //   character.src = `${localHost}/images/characters/robot/v1/good.gif`
    //   setTimeout(function () {
    //     character.src = `${localHost}/images/characters/robot/v1/still/happy.png`
    //     showExpression.value = false
    //   }, 2800)
    // }


    showCheckIcon();

    document.getElementById(id).classList.remove('animate-pulse', 'scale-95')

    boxes.value[id - 1] = true

    for (let i = 0; i < props.size; i++) {
      if (boxes.value[i] === true) {
        step.value++
      }
    }

    console.log("step value", step.value);

    if (step.value === props.size) {
      win()
    }
    step.value = 0

    if (itemSelected.type === types.color) {

    } else if (itemSelected.type === types.letter || itemSelected.type === types.number) {
      let element = document.getElementById(id);
      element.classList.remove('text-red-500')
    } else if (itemSelected.type === types.image) {
      let element = document.getElementById(id);
      element.classList.remove('bg-red-500')
      element.classList.remove('bg-white')
      element.classList.add('bg-green-300')
      setTimeout(function () {
        element.classList.replace('bg-green-300', 'bg-white')
      }, 1000)
    }

  } else {
    // Si tiene un fallo
    paintItem(id, items)

    showErrorIcon()

    let bubble = new Audio()
    bubble.src = `${localHost}/audios/effects/wood.wav`
    bubble.play()


    //Codigo a revisar____________________________________________________________________
    // character.src = `${localHost}/images/characters/robot/v1/still/alert.png`
    // character.classList.add('brush-fail');
    // document.getElementById('character').classList.add('brush-fail');
    console.log("character", character);

    // setTimeout(function () {
    //   character.classList.remove('brush-fail')
    // }, 500)

    // if (showExpression.value === false) {
    //   showExpression.value = true
    //   character.src = `${localHost}/images/characters/robot/v1/still/alert.png`
    //   setTimeout(function () {
    //     character.src = `${localHost}/images/characters/robot/v1/still/alert.png`
    //     showExpression.value = false
    //   }, 2600)
    // }

    boxes.value[id - 1] = false

    if (itemSelected.type === types.color) {
      let element = document.getElementById(id);
      let span = document.createElement('span');
      span.innerText = 'X';
      if (props.rotate) {
        span.classList.add('-rotate-45')
      }
      element.appendChild(span);
    } else if (itemSelected.type === types.letter || itemSelected.type === types.number) {
      let element = document.getElementById(id);
      element.classList.add('text-red-500')
    } else if (itemSelected.type === types.image) {
      let element = document.getElementById(id);
      element.classList.replace('bg-white', 'bg-red-500')
    }

    document.getElementById(id).classList.add('animate-pulse', 'scale-95', 'zoom-box')

    setTimeout(function () {
      document.getElementById(id).classList.remove('zoom-box')
    }, 3000)
  }
}

let level = ref(props.level)
let showProgressBar = ref(true)
const win = async () => {
  levelComplete.value = true
  playAudio(`${localHost}/audios/effects/levelUp.mp3`)
  let progressBar = document.getElementById('progressBar')

  let staticBar = document.getElementById('staticBar')

  let animated = document.getElementById('test2')

  let station = document.getElementById('station')

  let board = document.getElementById('board')

  let winView = document.getElementById('winView')

  staticBar.classList.replace('opacity-100', 'opacity-0')
  progressBar.classList.replace('border-black', 'border-yellow-400')
  animated.classList.replace('opacity-0', 'opacity-100')
  station.classList.add('moveLeftInOut')

  board.classList.replace('bg-red-200', 'bg-green-300')

  let button = document.getElementById('nextLevelButton');
  let coinsComponent = document.getElementById('coinsComponentHorizontal');

  if (totalActivities.value === level.value[1]) {

    return
  }


  winView.classList.remove('hidden')

  setTimeout(function () {
    board.classList.replace('bg-green-300', 'bg-red-200')
    winView.classList.replace('opacity-0', 'opacity-100')

    setTimeout(function () {
      staticBar.classList.replace('opacity-0', 'opacity-100')
      animated.classList.replace('opacity-100', 'opacity-0')
      button.classList.remove('hidden');
      coinsComponent.classList.add('hidden');
      showProgressBar.value = false
      level.value[1] = level.value[1] + 1
      setTimeout(function () {
        showProgressBar.value = true
      }, 100)
    }, 1000)
  }, 2000)

  setTimeout(function () {
    winView.classList.replace('opacity-100', 'opacity-0')
    setTimeout(function () {
      winView.classList.add('hidden')
    }, 200)
  }, 4000)
};



//Funcion que controla los emits que activan el vortice
const coinChangerVortexActivate = (event) => {
  console.log("Ehjecutando el coinChanger vortex active", event);
  coinChangerVortexRef.value = event;
};

//Funcion que controla el tipo de vortice si es a coin changer o a la store
const vortexTypeFunction = (event) => {
  vortexType.value = event;
};

//Funcion que controla cuando el usuario da click para mostrar la animacion de la nave viajando al portal.
const selectedLevelVortexFunction= (event) => {
  selectedLevelVortex.value = event;
};

//Funcion que controla si se abre el coinChanger
const selectedCoinChangerFunction = (event) => {
  selectedCoinChanger.value = event;
};

const coinChangerClose = (event) => {
  selectedCoinChanger.value = event;
  selectedLevelVortex.value = event;
  coinChangerVortexRef.value = event;
  coinChangerCloseUser.value = true;

  setTimeout(() => {
    coinChangerCloseUser.value = false;
  }, 1000);
};

const updateCoinsFunction = (event) => {
  updateCoins.value = event;
};

</script>
<template>
  <!--  <div id="loadStyles" :class="`h-36 w-36 h-24 w-24 h-20 w-20 grid grid-cols-3 grid-cols-4 grid-cols-5 hidden-->
  <!--    grid-cols-6 grid-cols-7 grid-cols-8 grid-cols-9 grid-cols-10 grid-cols-11 grid-cols-12-->
  <!--     ${items[0].content} ${items[1].content} ${items[2].content} ${items[3].content}`-->

  <!--"></div>-->

  <BackgroundActivities/>

  <WinView id="winView" class="hidden opacity-0 duration-300"/>

  <div v-if="selectedCoinChanger"  class="w-full h-full absolute top-0 left-0 z-30" >
    <CoinChanger :storageBronze="'bronzeCoins'" :storageSilver="'silverCoins'" :storageGold="'goldCoins'" :goldenExchange="3" :silverExchange="3" :guide="true" @coinChangerClose="coinChangerClose" @updateCoins="updateCoinsFunction"/>
  </div>

  <div v-if="coinChangerVortexRef || selectedLevelVortex" class="absolute z-20 w-full h-full pointer-events-none">
    <CoinChangerVortex :type="vortexType" :selected="selectedLevelVortex"/>
  </div>

  <div id="blackScreen" class="bg-black h-screen w-screen fixed opacity-0 duration-300 hidden"></div>


  <div class="flex flex-col min-h-screen relative">
    <div class="mx-auto flex-1 container flex justify-center relative">
      <div class="flex  p-6 w-full gap-5 rounded-md grid grid-cols-5 relative">


        <div class="col-span-5">
          <ProgressBar v-if="showProgressBar" :planet_1="`${localHost}/images/planets/tierra.svg`"
                       :planet_2="`${localHost}/images/planets/rojo.svg`"
                       :rocket="`${localHost}/images/rockets/1.svg`"
                       :level="props.level"
          />
        </div>

        <div id="board" class="col-span-5 flex justify-center bg-red-200">
          <div class="col-span-4 flex justify-center items-center">
            <div>
              <div class="my-6 flex justify-center gap-5">
                <div id="sample-img" :class="`flex`">
                  <div :id="`${i}`" @click="paintBox(i)"
                       v-for="i in props.size" :key="i" :style="`width: ${boxSize}px; height: ${boxSize}px;`"
                       :class="[`bg-white border border-black hover:opacity-75 z-10 cursor-cell flex
                       justify-center items-center font-bold select-none duration-300`,
                       items[0].type === types.color ? 'text-xl' : 'text-6xl' ]">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-span-5 relative">
          <HorizontalItemPalette
            :level="props.level" :items="items"
            :currentAudio="currentAudio"
            :updateCoins="updateCoins"
            :coinChangerClose="coinChangerCloseUser"
            @closeAnimation="coinChangerVortexActivate"
            @openAnimation="coinChangerVortexActivate"
            @vortexType="vortexTypeFunction"
            @selected="selectedLevelVortexFunction"
            @selectedCoinChanger="selectedCoinChangerFunction"
          ></HorizontalItemPalette>
        </div>

      </div>
    </div>
  </div>
</template>
<style>
.brush-fail {
  animation: move-right 100ms linear infinite;
  fill: red;
}

@keyframes move-right {
  0% {
    transform: translateX(0);
  }
  50% {
    transform: translateX(10px);
  }
  100% {
    transform: translateX(0);
  }
}

.zoom-box {
  animation: zoom-out 1500ms linear infinite;
}

@keyframes zoom-out {
  /*0% {*/
  /*    transform: scale(.1);*/
  /*}*/
  50% {
    transform: scale(.75);
  }
  /*100% {*/
  /*    transform: scale(.1);*/
  /*}*/
}
</style>
