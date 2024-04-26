<script setup>
import IconShoppingCart from "../icons/IconShoppingCart.vue"
import IconPaintBrush from "../icons/IconPaintBrush.vue"
import HelpCharacterOnly from "./HelpCharacterOnly.vue";
import IconCheck from "../icons/IconCheck.vue";
import IconError from "../icons/IconError.vue";
import {ref, onMounted} from "vue";
import {types, sizes, localHost, getSelectItem} from '../../use';
import Swal from 'sweetalert2'

let itemSelected = ref()
let itemImg = ref()
let itemSize = ref()

const props = defineProps({
  level: {type: Array},
  items: {type: Object},
})


onMounted(() => {
  localStorage.setItem('itemSelected', null)
  itemSelected.value = getSelectItem()
});

const selectItemPalette = (item) => {
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

const pause = () => {
  Swal.fire({
    title: "Pausa",
    text: "Haz pausado el juego",
    width: "40rem",
    html: `
            <div class="grid gap-2">
                <div>
                    <button id="swal-button1" class="bg-blue-200 px-16 py-2 hover:opacity-75 hover:scale-90 rounded-md duration-300">
                        <span class="font-bold text-2xl">Continuar</span>
                    </button>
                </div>
                <div>
                    <button id="swal-button1" class="bg-blue-200 px-16 py-2 hover:opacity-75 hover:scale-90 rounded-md duration-300">
                        <span class="font-bold text-2xl">Niveles</span>
                    </button>
                </div>
                <div>
                    <button id="swal-button1" class="bg-blue-200 px-16 py-2 hover:opacity-75 hover:scale-90 rounded-md duration-300">
                        <span class="font-bold text-2xl">Salir</span>
                    </button>
                </div>
            </div>
          `,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      // Swal.fire("Saved!", "", "success");
    } else if (result.isDenied) {
      Swal.fire("Changes are not saved", "", "info");
    }
  });
};

</script>
<template>

  <div class="backdrop-blur-sm border-2 border-blue-900 rounded-md h-full flex justify-center items-center px-12">

    <div class="absolute translate-x-[-450px] border-b-4 border-dashed drop-shadow-2xl">
      <HelpCharacterOnly :image="`${localHost}/images/characters/robot/normal.png`"
                         :image_2="`${localHost}/images/characters/robot/talk.gif`"></HelpCharacterOnly>
    </div>

    <div class="grid grid-cols-4 gap-2 mx-12">
      <div class="col-span-4 m-3">
        <div id="itemScreen"
             :class="`border-2 border-black h-14 col-span-2 shadow-xl rounded-md flex justify-center font-bold text-5xl bg-white`">
          {{ itemSelected ? itemSelected.name : null }}
          <img v-if="itemImg" :src="itemImg" alt="" :width="itemSize">
        </div>
      </div>
      <div @click="selectItemPalette(item)" v-for="item, index in props.items" :key="index"
           class="flex justify-center items-center w-full h-full">
        <button
            :class="['bg-gray-100 shadow-md rounded-lg hover:opacity-75 hover:scale-95 duration-300 select-none font-bold' +
           ' text-6xl w-20 h-20 flex justify-center items-center']">

          {{ item.type === types.letter || item.type === types.number ? item.name : null }}

          <IconPaintBrush v-if="item.type === types.color" :hex="item.hex"/>

          <img v-if="item.type === types.image || item.type === types.figure || item.type === types.eraser"
               :src="item.content" alt=""
               :class="[
                                 {'w-[30px]' : item.size === sizes.small},
                                 {'w-[40px]' : item.size === sizes.normal},
                                 {'w-[50px]' : item.size === sizes.big} ]">

        </button>
      </div>

      <div class="flex justify-center gap-4 left-20 col-span-4 mt-2">

        <button @click="pause()" class="bg-gray-200 rounded-md flex justify-center items-center p-2">
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
        <button class="bg-gray-200 rounded-md p-2">
          <IconShoppingCart/>
        </button>
      </div>
    </div>

    <div class="col-span-2 flex justify-center absolute translate-x-[450px]">

      <div class="flex justify-center items-center">
      <IconCheck id="icon-check" class="absolute duration-300 opacity-0" hex="#86efac"></IconCheck>
      <IconError id="icon-error" class="absolute duration-300 opacity-0" hex="#f87171"></IconError>
      <div id="itemPresentation"
           class="duration-300 h-36 w-36 bg-gray-200 flex justify-center items-center text-8xl font-bold shadow-xl hidden">
      </div>
    </div>

      <a :href="`${localHost}/level${props.level[0]}/${props.level[1] + 1}`">
        <button id="nextLevelButton"
                class="bg-yellow-infinite py-8 px-16 border-yellow-600 border-4 rounded-md shadow-xl shadow-yellow-400 hidden">

          <div class="arrow">
            <span></span>
            <span></span>
            <span></span>
          </div>

        </button>
      </a>
    </div>
  </div>
</template>

<style scoped>

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