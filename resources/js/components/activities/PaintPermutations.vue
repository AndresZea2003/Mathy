<script setup>
import "../sections/HelpCharacter.vue";
import HelpCharacter from "../sections/HelpCharacter.vue";
import ItemPalette from "../sections/ItemPalette.vue";
import ProgressBar from "../sections/ProgressBar.vue";
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
  updateCoins, getCoins, playAudio, playSuccessShortRandom, setOnEnded, resolveAudio
} from '../../use';
import {onMounted, onUnmounted, ref} from "vue";
import BackgroundActivities from "../background/BackgroundActivities.vue";

const props = defineProps({
  gamemode: {type: Number},
  level: {type: Array},
  items: {type: Array},
  type: {type: String},
  fill_sample: {type: Array},
  boxes_for_group: {type: Number},
  show_groups: {type: Number},
  show_fake_row: {type: Boolean},
  show_animate_progress: {type: Boolean}
})

let totalActivities = ref(0)
let talkBool = ref(false)

let showGroups = ref(props.show_groups)
let showFakeRow = ref(props.show_fake_row)
let showAnimateProgress = ref(props.show_animate_progress)
let gameMode = ref(props.gamemode)

onMounted(async () => {
  if (props.show_fake_row === true) {
    showGroups.value = props.show_groups + 1
  }
  // ... other code
  await axios.get('/activityCount/' + props.level[0])
      .then(response => totalActivities.value = response.data);
  // showInitialAlert()

  initializeGame()

})

let groups = 0

let boxesForGroup = props.boxes_for_group

let items = props.items
let boxes = ref([])

let levelComplete = ref(false)
let inTutorial = ref(false)

let currentCombinations = {};
let steps = ref(0)
let currentAudio = ref(null)
let niceNextAudio = ref(1)

let isLastRow = ref(false)
let failedAttempts = ref(0);

const paintBox = async (id) => {
  if (levelComplete.value || inTutorial.value) {
    playAudio(`${localHost}/audios/effects/wood.wav`)
    return
  }

  let itemSelected = getSelectItem()

  const updateCurrentCombinations = (group, boxNumber, selectedColor) => {
    if (!currentCombinations[group]) {
      currentCombinations[group] = [];
    }
    currentCombinations[group][boxNumber - 1] = selectedColor;
    console.log('Ola')
  }

  let [group, boxNumber] = id.split('-');

  if (currentFocus.value === null && showFakeRow.value && group === `group${showGroups.value}`) {
    paintItem(id, items);

    updateCurrentCombinations(group, parseInt(boxNumber), itemSelected.content);


    boxNumber = parseInt(boxNumber);

    // Check if all boxes in the group have been colored
    let boxesInGroup = document.querySelectorAll(`#${group} div`);
    let allBoxesColored = Array.from(boxesInGroup).every(box => {
      let boxClasses = box.className.split(' ');
      return boxClasses.some(cls => cls.startsWith('bg-') && cls !== 'bg-white');
    });

    if (allBoxesColored) {
      // Check for errors
      let combination = currentCombinations[group];
      let hasDuplicateColors = combination && combination.length !== new Set(combination).size;
      let isCombinationRepeated = combination && usedCombinations.value.includes(combination.join(','));

      // Check if all colors in the group are the same
      let allColorsSame = combination && new Set(combination).size === 1;

      console.log('allColorsSame:', allColorsSame)

      if (allColorsSame) {
        // Error: The player colored all boxes in the group with the same color
        boxesInGroup.forEach(box => box.classList.add('scale-50'));

        inTutorial.value = true;
        currentAudio.value = playAudio(`${localHost}/audios/start/permutations/errors/combinacionSinVariacion.m4a`)

        setOnEnded(currentAudio.value, () => {
          inTutorial.value = false;
          boxesInGroup.forEach(box => box.classList.remove('scale-50'));
          boxesInGroup.forEach(box => {
            let boxClasses = box.className.split(' ');
            let colorClass = boxClasses.find(cls => cls.startsWith('bg-'));
            box.classList.remove(colorClass);
          });
          boxesInGroup.forEach(box => box.classList.add('bg-white'));
          failedAttempts.value++;
        });
      } else if (hasDuplicateColors) {
        // Error 1: The player repeated colors in the group
        let duplicateColors = combination.filter((item, index) => combination.indexOf(item) !== index);

        console.log('duplicate :', duplicateColors);

        combination.forEach((color, index) => {
          if (duplicateColors.includes(color)) {
            let boxId = `${group}-${index + 1}`;
            console.log('boxId:', boxId);
            document.getElementById(boxId).classList.add('scale-50');
          }
        });

        // Play error audio
        inTutorial.value = true;
        currentAudio.value = playAudio(`${localHost}/audios/start/permutations/${props.type}/errors/repetido.m4a`);

        // Remove selection class and reset colors

        setOnEnded(currentAudio.value, () => {
          inTutorial.value = false;
          combination.forEach((color, index) => {
            if (duplicateColors.includes(color)) {
              let boxId = `${group}-${index + 1}`;
              console.log('boxId 2:', boxId);
              boxesInGroup.forEach(box => {
                let boxClasses = box.className.split(' ');
                let colorClass = boxClasses.find(cls => cls.startsWith('bg-'));
                box.classList.remove(colorClass);
              });
              boxesInGroup.forEach(box => box.classList.remove('scale-50'));
              boxesInGroup.forEach(box => box.classList.add('bg-white'));
              failedAttempts.value++;
            }
          });
        })

      } else if (isCombinationRepeated) {
        // Error 2: The player made a combination that already exists
        let fakeCombination = currentCombinations[group].join(',');
        let repeatedGroup = Object.keys(currentCombinations).find(g => g !== group && currentCombinations[g].join(',') === fakeCombination);
        let boxesInRepeatedGroup = document.querySelectorAll(`#${repeatedGroup} div`);

        boxesInGroup.forEach(box => box.classList.add('scale-50'));
        boxesInRepeatedGroup.forEach(box => box.classList.add('scale-50'));

        // Play error audio
        inTutorial.value = true;
        currentAudio.value = playAudio(`${localHost}/audios/start/permutations/errors/combinacionUsada.m4a`);

        setOnEnded(currentAudio.value, () => {
          // Remove selection class and reset colors
          inTutorial.value = false;
          boxesInRepeatedGroup.forEach(box => box.classList.remove('scale-50'));
          boxesInGroup.forEach(box => box.classList.remove('scale-50'));
          boxesInGroup.forEach(box => {
            let boxClasses = box.className.split(' ');
            let colorClass = boxClasses.find(cls => cls.startsWith('bg-'));
            box.classList.remove(colorClass);
          });
          boxesInGroup.forEach(box => box.classList.add('bg-white'));
          failedAttempts.value++;
        });
      }

      if (failedAttempts.value >= 3) {
        // The player has failed 3 times, they win
        alert('Ganaste');
      }
    }

    return;
  }

  if (currentFocus.value !== id && gameMode.value === 1 && currentFocus.value !== null) {
    playAudio(`${localHost}/audios/effects/wood.wav`)
    document.getElementById(id).classList.add('scale-50')
    setTimeout(() => {
      document.getElementById(id).classList.remove('scale-50')
    }, 1000)
    return;
  } else if (document.getElementById(id).dataset.initiallyPainted === 'true') {
    playAudio(`${localHost}/audios/effects/wood.wav`)
    document.getElementById(id).classList.add('scale-50')
    setTimeout(() => {
      document.getElementById(id).classList.remove('scale-50')
    }, 1000)
    return;
  }

  const animateBox = (boxId) => {
    document.getElementById(boxId).classList.add('scale-75');
    setTimeout(() => {
      document.getElementById(boxId).classList.remove('scale-75');
    }, 1000);
  }

  const playLevelUpAudio = () => {
    playAudio(`${localHost}/audios/effects/levelUp.mp3`);
    // playSuccessShortRandom();
  }

  const updateCurrentFocus = (group, id, boxNumber) => {

    let useGroup = group
    if (boxNumber === boxesForGroup) {
      useGroup = parseInt(id.split('-')[0].replace('group', '')) + 1;
    }

    console.log(typeof useGroup)
    // validar si useGroup es un integer
    if (typeof useGroup === 'number') {
      useGroup = `group${useGroup}`;
    }

    console.log('useGroup:', useGroup)
    let colors = currentCombinations[useGroup];

    let indices = colors.map(color => {
      return items.findIndex(item => item.content === color);
    });

    function playAudios(i) {
      if (i >= indices.length) {
        steps.value++;
        let currentFocusIndex = props.fill_sample.indexOf(0, (parseInt(currentFocus.value.split('-')[0].replace('group', '')) - 1) * boxesForGroup + parseInt(currentFocus.value.split('-')[1]) - 1);
        let nextBoxIndex = props.fill_sample.indexOf(0, currentFocusIndex + 1);
        currentFocus.value = `group${Math.floor(nextBoxIndex / boxesForGroup) + 1}-${nextBoxIndex % boxesForGroup + 1}`;
        document.getElementById(currentFocus.value).style.opacity = '';
        document.getElementById(currentFocus.value).classList.add('yellow-border-reflection');
        console.log(i)
        if (i === 1) {
          currentAudio.value = playAudio(`${localHost}/audios/start/permutations/${props.type}/siguiente.m4a`);
        } else {
          currentAudio.value = playAudio(`${localHost}/audios/start/permutations/${props.type}/falta.m4a`);
        }

        setOnEnded(currentAudio.value, () => {
          inTutorial.value = false;
        });

        return;
      }

      currentAudio.value = playAudio(`${localHost}/audios/items/${items[indices[i]].name}.m4a`);

      document.getElementById(`${useGroup}-${i + 1}`).style.opacity = '';

      currentAudio.value.onended = () => {
        playAudios(i + 1);
      };
    }

    if (boxNumber === boxesForGroup) {
      playAudios(0);
    } else {
      steps.value++;
      let currentFocusIndex = props.fill_sample.indexOf(0, (parseInt(currentFocus.value.split('-')[0].replace('group', '')) - 1) * boxesForGroup + parseInt(currentFocus.value.split('-')[1]) - 1);
      let nextBoxIndex = props.fill_sample.indexOf(0, currentFocusIndex + 1);
      currentFocus.value = `group${Math.floor(nextBoxIndex / boxesForGroup) + 1}-${nextBoxIndex % boxesForGroup + 1}`;
      document.getElementById(currentFocus.value).style.opacity = '';
      document.getElementById(currentFocus.value).classList.add('yellow-border-reflection');
      currentAudio.value = playAudio(`${localHost}/audios/start/permutations/${props.type}/falta.m4a`);
      setOnEnded(currentAudio.value, () => {
        inTutorial.value = false;
      });
    }
  }

  const addClassesInCompleteBoxes = (classesToAdd) => {
    for (let groupIndex = 1; groupIndex <= showGroups.value; groupIndex++) {
      let group = `group${groupIndex}`;

      let boxesInGroup = document.querySelectorAll(`#${group} div`);

      let isGroupComplete = Array.from(boxesInGroup).every(box => {
        let boxClasses = box.className.split(' ');

        return boxClasses.some(cls => cls.startsWith('bg-') && cls !== 'bg-white');
      });

      // if (isGroupComplete) {
      //   boxesInGroup.forEach(box => box.classList.add('rotate-45', 'scale-75', 'opacity-70'));
      // }
      if (isGroupComplete) {
        boxesInGroup.forEach(box => box.classList.add(...classesToAdd));
      }
    }
  }

  const removeClassesInCompleteBoxes = (classesToRemove) => {
    for (let groupIndex = 1; groupIndex <= showGroups.value; groupIndex++) {
      let group = `group${groupIndex}`;

      // Obtiene los cuadros en el grupo
      let boxesInGroup = document.querySelectorAll(`#${group} div`);

      // Elimina la clase 'rotate-45', 'scale-75 de todos los cuadros en el grupo
      // boxesInGroup.forEach(box => box.classList.remove('rotate-45', 'scale-75', 'opacity-70'));
      boxesInGroup.forEach(box => box.classList.remove(...classesToRemove));
    }
  }

  if (gameMode.value === 1) {
    if (id !== currentFocus.value && currentFocus.value !== null) {
      return;
    }

    paintItem(id, items)

    let [group, boxNumber] = id.split('-');
    boxNumber = parseInt(boxNumber);
    let selectedColor = getSelectItem().content;
    updateCurrentCombinations(group, boxNumber, selectedColor);

    if (boxNumber === boxesForGroup - 1) {
      console.log('Penultimo cuadro del grupo')
      let combinationString = currentCombinations[group].join(',');

      for (let [index, usedCombination] of usedCombinations.value.entries()) {
        let firstItems = usedCombination.split(',').slice(0, boxesForGroup - 1).join(',');

        console.log('Combinación actual:', combinationString, 'firstItems:', firstItems, 'usedCombination:', usedCombination)

        if (firstItems === combinationString) {
          playAudio(`${localHost}/audios/effects/wood.wav`)
          currentAudio.value = playAudio(`${localHost}/audios/start/permutations/${props.type}/errors/buen-intento-fila-anterior.m4a`);
          document.getElementById(id).classList.replace('yellow-border-reflection', 'red-border-reflection');
          inTutorial.value = true;
          let groupId = index + 1;

          document.getElementById(`group${groupId}-${boxNumber}`).classList.add('scale-75');
          document.getElementById(id).classList.add('scale-75');
          setOnEnded(currentAudio.value, () => {
            document.getElementById(`group${groupId}-${boxNumber}`).classList.remove('scale-75');
            document.getElementById(id).classList.remove('scale-75');
            inTutorial.value = false;
          });
          console.log('ID del grupo:', groupId);
          return;
        }

        let combinationArray = combinationString.split(',');
        let combinationSet = new Set(combinationArray);

        if (combinationSet.size < combinationArray.length) {
          console.log('La combinación actual contiene valores repetidos');
          playAudio(`${localHost}/audios/effects/wood.wav`)
          currentAudio.value = playAudio(`${localHost}/audios/start/permutations/${props.type}/errors/repetido.m4a`);
          inTutorial.value = true;
          document.getElementById(id).classList.replace('yellow-border-reflection', 'red-border-reflection');
          if (boxNumber > 1) {
            let previousBoxId = `${group}-${boxNumber - 1}`;
            console.log('ID de la caja anterior:', previousBoxId);
            document.getElementById(previousBoxId).classList.add('scale-75');
            document.getElementById(id).classList.add('scale-75');
            setOnEnded(currentAudio.value, () => {
              document.getElementById(previousBoxId).classList.remove('scale-75');
              document.getElementById(id).classList.remove('scale-75');
              inTutorial.value = false;
            });
            return;
          } else {
            animateBox(id);
          }
        }
      }

      document.getElementById(currentFocus.value).classList.remove('red-border-reflection');
      document.getElementById(currentFocus.value).classList.remove('yellow-border-reflection');
      playLevelUpAudio();
      updateCurrentFocus(group, id, boxNumber);
      console.log('La combinación actual no ha sido utilizada en los dos primeros elementos de ninguna combinación anterior');
      return;
    }

    if (isUniqueCombination(id)) {
      playLevelUpAudio();
      console.log('Grupo completado');
      document.getElementById(currentFocus.value).classList.remove('red-border-reflection');
      document.getElementById(currentFocus.value).classList.remove('yellow-border-reflection');

      if (showAnimateProgress.value && niceNextAudio.value === 2) {

        addClassesInCompleteBoxes(['rotate-90', 'scale-75']);

        await playAudiosInOrder();

        inTutorial.value = true;
        currentAudio.value = playAudio(`${localHost}/audios/start/permutations/niceNext/${niceNextAudio.value}.m4a`);
        niceNextAudio.value++;

        setOnEnded(currentAudio.value, () => {

          removeClassesInCompleteBoxes(['rotate-90', 'scale-75']);

          let nextGroup = parseInt(id.split('-')[0].replace('group', '')) + 1;
          updateCurrentFocus(group, id, boxNumber);

          document.getElementById(`group${nextGroup}`).style.opacity = 1;

          let completedGroup = document.querySelectorAll(`#group${nextGroup - 1} div`);
          completedGroup.forEach(box => box.classList.remove('brush-fail', 'scale-75', 'animate-pulse'));
        });

        return
      } else if (showAnimateProgress.value && niceNextAudio.value === 4) {

        addClassesInCompleteBoxes(['rotate-90', 'scale-75']);

        // await playAudiosInOrder();

        inTutorial.value = true;
        currentAudio.value = playAudio(`${localHost}/audios/start/permutations/niceNext/${niceNextAudio.value}.m4a`);
        niceNextAudio.value++;

        setOnEnded(currentAudio.value, () => {

          removeClassesInCompleteBoxes(['rotate-90', 'scale-75']);

          let nextGroup = parseInt(id.split('-')[0].replace('group', '')) + 1;
          updateCurrentFocus(group, id, boxNumber);

          document.getElementById(`group${nextGroup}`).style.opacity = 1;

          let completedGroup = document.querySelectorAll(`#group${nextGroup - 1} div`);
          completedGroup.forEach(box => box.classList.remove('brush-fail', 'scale-75', 'animate-pulse'));
        });

        return
      } else if (showAnimateProgress.value && niceNextAudio.value === 5) {

      }

      inTutorial.value = true;

      if (showFakeRow.value && niceNextAudio.value === showGroups.value - 1) {
        currentAudio.value = playAudio(`${localHost}/audios/start/permutations/fakeRow/1.m4a`);
      } else {
        currentAudio.value = playAudio(`${localHost}/audios/start/permutations/niceNext/${niceNextAudio.value}.m4a`);
      }

      niceNextAudio.value++;

      console.log('niceNextAudio:', niceNextAudio.value, showGroups.value)

      setOnEnded(currentAudio.value, () => {
        let realGroups = showGroups.value
        if (showFakeRow.value) {
          realGroups = showGroups.value - 1
        }

        if (!showFakeRow.value && niceNextAudio.value > realGroups) {
          alert('Ganaste')
          return;
        } else if (showFakeRow.value && niceNextAudio.value > realGroups) {
          inTutorial.value = false;
          currentFocus.value = null

          let nextGroup = `group${showGroups.value}`

          let completedGroup = document.querySelectorAll(`#group${showGroups.value} div`);

          completedGroup.forEach(box => box.style.opacity = 1);

          document.getElementById(nextGroup).style.opacity = 1;

          return;
        }

        updateCurrentFocus(group, id, boxNumber);
        let nextGroup = parseInt(id.split('-')[0].replace('group', '')) + 1;

        document.getElementById(`group${nextGroup}`).style.opacity = 1;

        let completedGroup = document.querySelectorAll(`#group${nextGroup - 1} div`);
        completedGroup.forEach(box => box.classList.remove('brush-fail', 'scale-75', 'animate-pulse'));
        return;


      })

    } else {
      // Obtiene el valor actual
      console.log('Grupo no completado');

      let currentValue;
      if (props.type === 'colors') {
        let currentClasses = document.getElementById(id).className.split(' ');
        currentValue = currentClasses.find(cls => cls.startsWith('bg-'));
      } else if (props.type === 'numbers') {
        currentValue = document.getElementById(id).textContent;
      }

      let boxesInGroup = document.querySelectorAll(`#${group} div`);
      playAudio(`${localHost}/audios/effects/wood.wav`)
      currentAudio.value = playAudio(`${localHost}/audios/start/permutations/${props.type}/errors/repetido.m4a`);
      inTutorial.value = true;
      document.getElementById(currentFocus.value).classList.replace('yellow-border-reflection', 'red-border-reflection');
      boxesInGroup.forEach(box => {
        let boxValue;
        if (props.type === 'colors') {
          let boxClasses = box.className.split(' ');
          boxValue = boxClasses.find(cls => cls.startsWith('bg-'));
        } else if (props.type === 'numbers') {
          boxValue = box.textContent;
        }
        if (boxValue === currentValue) {
          box.classList.add('scale-75');
        }
      });

      setOnEnded(currentAudio.value, () => {
        boxesInGroup.forEach(box => {
          box.classList.remove('scale-75');
          inTutorial.value = false;
        });
      });
    }
  }

  if (gameMode.value === 2) {
    // Solo permite colorear el cuadro siguiente
    let itemSelected = getSelectItem()
    // if (itemSelected.type === types.eraser) {
    //   errorPaint(id)
    //   return
    // }
    paintItem(id, items)
    console.log(isGroupComplete(id))
    // Verifica si una combinación es única y si se ha completado un grupo
    if (isUniqueCombination(id)) {
      playAudio(`${localHost}/audios/effects/levelUp.mp3`)
      console.log('Grupo completado')
      // Revela el siguiente grupo
      let nextGroup = parseInt(id.split('-')[0].replace('group', '')) + 1
      document.getElementById(`group${nextGroup}`).style.opacity = 1

      // Elimina la clase de error de todos los elementos del grupo completado
      let completedGroup = document.querySelectorAll(`#group${nextGroup - 1} div`);
      completedGroup.forEach(box => box.classList.remove('brush-fail', 'scale-75', 'animate-pulse'));
    } else {
      playAudio(`${localHost}/audios/effects/wood.wav`)
      document.getElementById(id).classList.add('brush-fail')
      setTimeout(() => {
        document.getElementById(id).classList.remove('brush-fail')
        setTimeout(() => {
          document.getElementById(id).classList.add('scale-75', 'animate-pulse')
        }, 10)
      }, 1000)
    }
  }
}


// resolveAudio('Buen intento, pero si utilizas ese número en esa posición, quedará igual a la fila anterior.', 'buen-intento-fila-anterior', 'start/permutations/numbers/errors', '0.9');


const playAudiosInOrder = async () => {
  // Itera sobre las combinaciones usadas
  for (let i = 0; i < usedCombinations.value.length; i++) {
    // Reproduce el audio inicial correspondiente al grupo
    await playAudioInOrder(`${localHost}/audios/start/permutations/rows/${i + 1}.m4a`);

    // Obtiene la combinación actual
    let combination = usedCombinations.value[i];

    // Divide la combinación en los colores individuales
    let colors = combination.split(',');

    // Itera sobre los colores
    for (let color of colors) {
      // Busca el ítem correspondiente al color
      let item = items.find(item => item.content === color);

      // Construye la ruta del audio
      let audioPath = `${localHost}/audios/items/${item.name}.m4a`;

      // Agrega una clase al cuadro correspondiente al color
      let boxId = `group${i + 1}-${colors.indexOf(color) + 1}`;
      document.getElementById(boxId).classList.add('border-8', 'border-yellow-400');

      // Reproduce el audio
      await playAudioInOrder(audioPath);

      // Elimina la clase del cuadro cuando el audio termina
      document.getElementById(boxId).classList.remove('border-8', 'border-yellow-400');
    }
  }
}

const playAudioInOrder = (src) => {
  return new Promise((resolve) => {
    let audio = new Audio(src);
    audio.onended = resolve;
    audio.play();
  });
}

let usedCombinations = ref([])

const isUniqueCombination = (id) => {
  // Obtiene el grupo actual
  let group = id.split('-')[0]

  // Obtiene los cuadros en el grupo
  let boxes = document.querySelectorAll(`#${group} div`)

  // Crea una combinación para el grupo actual
  let combination;
  if (props.type === 'colors') {
    combination = Array.from(boxes).map(box => {
      // Obtiene todas las clases del cuadro
      let classes = box.className.split(' ');

      // Encuentra la clase que corresponde al color de fondo
      let colorClass = classes.find(cls => cls.startsWith('bg-'));

      return colorClass;
    });

    combination = combination.filter(color => color !== 'bg-white');
    // Verifica si la combinación contiene 'bg-white'
    if (combination.includes('bg-white')) {
      return false;
    }
  } else if (props.type === 'numbers') {
    combination = Array.from(boxes).map(box => {
      // Obtiene el contenido de texto del cuadro
      let number = box.textContent;

      return number;
    });

    combination = combination.filter(number => number !== '');
    // Verifica si la combinación contiene ''
    if (combination.includes('')) {
      return false;
    }
  }

  // Verifica si un elemento se repite en la combinación
  let uniqueElements = [...new Set(combination)];

  if (uniqueElements.length !== combination.length) {
    return false;
  }

  // Convierte la combinación en una cadena para compararla con las combinaciones usadas
  combination = combination.join(',');

  // Verifica si la combinación ya ha sido utilizada
  if (usedCombinations.value.includes(combination)) {
    return false
  } else {
    usedCombinations.value.push(combination)
    return true
  }
}

const isGroupComplete = (id) => {
  // Obtiene el grupo actual
  let group = id.split('-')[0]

  // Obtiene los cuadros en el grupo
  let boxes = document.querySelectorAll(`#${group} div`)

  console.log(Array.from(boxes).every(box => box.style.backgroundColor !== '' && !box.classList.contains('bg-white')))
  // Verifica si todos los cuadros en el grupo han sido coloreados
  return Array.from(boxes).every(box => box.style.backgroundColor !== '' && !box.classList.contains('bg-white'))
}

let currentFocus = ref(null)
const initializeGame = () => {
  // Configura el estado inicial del juego según el modo de juego

  function playAudios(i) {
    if (i >= boxesForGroup) { // Solo reproduce los audios de la primera fila
      document.getElementById(currentFocus.value).style.opacity = '';
      document.getElementById(currentFocus.value).classList.add('yellow-border-reflection');
      currentAudio.value = playAudio(`${localHost}/audios/start/permutations/${props.type}/siguiente.m4a`);
      setOnEnded(currentAudio.value, () => {
        inTutorial.value = false;
      });
      return;
    }

    if (props.fill_sample[i] !== 0) {
      let boxId = `group${Math.floor(i / boxesForGroup) + 1}-${i % boxesForGroup + 1}`;
      currentAudio.value = playAudio(`${localHost}/audios/items/${items[props.fill_sample[i] - 1].name}.m4a`);

      // Elimina la opacidad al momento de reproducir el audio del ítem
      document.getElementById(boxId).style.opacity = '';

      currentAudio.value.onended = () => {
        playAudios(i + 1);
      };
    } else {
      playAudios(i + 1);
    }
  }


  // if (gameMode.value === 1) {
  //   props.fill_sample.forEach((item, index) => {
  //     if (item !== 0) { // Si el valor es 0, omite el pintado
  //       let boxId = `group${Math.floor(index / boxesForGroup) + 1}-${index % boxesForGroup + 1}`;
  //       localStorage.setItem('itemSelected', JSON.stringify(items[item - 1]));
  //       paintItem(boxId, items);
  //       document.getElementById(boxId).style.opacity = '';
  //       document.getElementById(boxId).dataset.initiallyPainted = 'true';
  //
  //       // Obtiene el grupo y el número del cuadro dentro del grupo
  //       let [group, boxNumber] = boxId.split('-');
  //       boxNumber = parseInt(boxNumber);
  //
  //       // Obtiene el color seleccionado
  //       let selectedColor = getSelectItem().content;
  //
  //       // Actualiza la combinación actual para el grupo
  //       if (!currentCombinations[group]) {
  //         currentCombinations[group] = [];
  //       }
  //       currentCombinations[group][boxNumber - 1] = selectedColor;
  //     } else if (currentFocus.value === null) { // Si el valor es 0 y currentFocus es null, establece currentFocus a este cuadro
  //       currentFocus.value = `group${Math.floor(index / boxesForGroup) + 1}-${index % boxesForGroup + 1}`;
  //       document.getElementById(currentFocus.value).style.opacity = '';
  //     }
  //   });
  //
  //   localStorage.setItem('itemSelected', JSON.stringify(null));
  //   // Oculta los demás grupos
  //   for (let i = 2; i <= showGroups; i++) {
  //     document.getElementById(`group${i}`).style.opacity = 0;
  //   }
  // }

  if (gameMode.value === 1) {
    inTutorial.value = true;
    props.fill_sample.forEach((item, index) => {
      if (item !== 0) { // Si el valor es 0, omite el pintado
        let boxId = `group${Math.floor(index / boxesForGroup) + 1}-${index % boxesForGroup + 1}`;
        localStorage.setItem('itemSelected', JSON.stringify(items[item - 1]));
        paintItem(boxId, items);
        document.getElementById(boxId).dataset.initiallyPainted = 'true';

        // Obtiene el grupo y el número del cuadro dentro del grupo
        let [group, boxNumber] = boxId.split('-');
        boxNumber = parseInt(boxNumber);

        // Obtiene el color seleccionado
        let selectedColor = getSelectItem().content;

        // Actualiza la combinación actual para el grupo
        if (!currentCombinations[group]) {
          currentCombinations[group] = [];
        }
        currentCombinations[group][boxNumber - 1] = selectedColor;
      } else if (currentFocus.value === null) { // Si el valor es 0 y currentFocus es null, establece currentFocus a este cuadro
        currentFocus.value = `group${Math.floor(index / boxesForGroup) + 1}-${index % boxesForGroup + 1}`;
      }
    });

    // Inicia la reproducción de los audios
    playAudios(0);

    localStorage.setItem('itemSelected', JSON.stringify(null));
    // Oculta los demás grupos
    for (let i = 2; i <= showGroups.value; i++) {
      document.getElementById(`group${i}`).style.opacity = 0;
    }
  }

  if (gameMode.value === 2) {
    props.fill_sample.forEach((item, index) => {
      let boxId = 'group' + (Math.floor(index / boxesForGroup) + 1) + '-' + (index % boxesForGroup + 1);
      if (item !== 0) { // Si el valor es 0, omite el pintado
        localStorage.setItem('itemSelected', JSON.stringify(items[item - 1]));
        paintItem(boxId, items);
        document.getElementById(boxId).dataset.initiallyPainted = 'true';
      }
      document.getElementById(boxId).style.opacity = 1;
    });

    localStorage.setItem('itemSelected', JSON.stringify(null));
    // Muestra todos los grupos
    for (let i = 1; i <= showGroups.value; i++) {
      document.getElementById(`group${i}`).style.opacity = 1;
    }
  }

}
</script>
<template>
  <BackgroundActivities/>
  <WinView id="winView" class="hidden opacity-0 duration-300"/>

  <div class="flex flex-col min-h-screen">
    <div class="mx-auto flex-1 container flex justify-center">
      <div class="flex p-6 w-full gap-5 rounded-md">
        <div @click="showItemsPresentation()" class="w-[16%]">
          <HelpCharacter :image="`${localHost}/images/characters/robot/v1/still/notFace.png`"
                         :image_2="`${localHost}/images/characters/robot/talk.gif`"
          />
        </div>
        <div id="dat" class="w-[68%] bg-red-200 p-5 grid grid-rows-4">
          <ProgressBar :planet_1="`${localHost}/images/planets/tierra.svg`"
                       :planet_2="`${localHost}/images/planets/rojo.svg`"
                       :rocket="`${localHost}/images/rockets/1.svg`"
                       :level="props.level"
          />

          <div class="row-span-3 flex justify-center items-center">
            <div>
              <div class="my-6 flex justify-center gap-5">
                <!--                {{ usedCombinations }}, {{ currentFocus }}-->
                <div id="activity"
                     :class="[`grid grid-cols-${Math.ceil(showGroups / 7)} gap-x-8`, inTutorial ? 'cursor-not-allowed' : 'cursor-cell']">
                  <div v-for="(group, groupIndex) in showGroups" :key="`group-${groupIndex}`"
                       :id="`group${groupIndex + 1}`"
                       class="grid pt-2 gap-x-2" :class="`grid-cols-${boxesForGroup} grid-rows-7`">
                    <div :id="`group${groupIndex + 1}-${i}`"
                         @click="paintBox(`group${groupIndex + 1}-${i}`)"
                         v-for="i in boxesForGroup"
                         :key="`box-${i}`"
                         :style="`width: ${7}vmin; height: ${7}vmin; opacity: 0;`"
                         :class="`bg-white border border-black hover:opacity-75 flex justify-center items-center
                         font-bold text-6xl select-none duration-300 shadow-xl`">
                      <!--                      {{ `group${groupIndex + 1}-${i}` }}-->
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>

        <div class="w-[16%]">
          <ItemPalette :level="props.level" :items="items" :currentAudio="currentAudio"/>
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

@keyframes yellow-reflection-animation {
  0% {
    border-color: #fde047;
    box-shadow: #fde047 0 0 50px 0;
  }
  50% {
    border-color: white;
    box-shadow: gray 0 0 50px 0;
  }
  100% {
    border-color: #fde047;
    box-shadow: #fde047 0 0 50px 0;
  }
}

@keyframes yellow-reflection-animation {
  0% {
    border-color: #fde047;
    box-shadow: #fde047 0 0 50px 0;
  }
  50% {
    border-color: white;
    box-shadow: gray 0 0 50px 0;
  }
  100% {
    border-color: #fde047;
    box-shadow: #fde047 0 0 50px 0;
  }
}

.yellow-border-reflection {
  position: relative;
  border: 2px solid;
  animation: yellow-reflection-animation 3s infinite;
}

.red-border-reflection {
  position: relative;
  border: 2px solid;
  animation: red-reflection-animation 3s infinite;
}

@keyframes red-reflection-animation {
  0% {
    border-color: #ef4444;
    box-shadow: #ef4444 0 0 50px 0;
  }
  50% {
    border-color: white;
    box-shadow: gray 0 0 50px 0;
  }
  100% {
    border-color: #ef4444;
    box-shadow: #ef4444 0 0 50px 0;
  }
}
</style>
