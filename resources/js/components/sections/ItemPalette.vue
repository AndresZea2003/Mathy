<script setup>
import IconShoppingCart from "../icons/IconShoppingCart.vue"
import IconPaintBrush from "../icons/IconPaintBrush.vue"
import {ref, onMounted} from "vue";
import {types, sizes, localHost, getSelectItem} from '../../use';

let itemSelected = ref()
let itemImg = ref()
let itemSize = ref()

onMounted(() => {
    localStorage.setItem('itemSelected', null)
    itemSelected.value = getSelectItem()
});

const props = defineProps({
    items: {type: Object},
})

const selectItem = (item) => {
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
    } else if (item.type === types.image) {
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

</script>
<template>
    <div class="flex  items-center justify-between justify-center bg-red-800 h-full">

        <div class="w-full flex justify-center">
            <div class="grid grid-cols-2 gap-4 w-full">
                <div class="flex justify-center col-span-2 gap-10 py-[2%]">

                    <button class="bg-gray-200 rounded-md py-[3%] px-[8%]">
                        <IconShoppingCart/>
                    </button>

                    <button class="bg-gray-200 rounded-md py-[3%] px-[8%]">
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
                <div class="flex justify-center col-span-2 items-center gap-2">
                    <svg height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
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
                                      d="M283.826,211.478c0,9.223,7.479,16.696,16.696,16.696c9.217,0,16.696-7.473,16.696-16.696 c0-27.961-18.869-51.551-44.522-58.843v-7.939c0-9.223-7.479-16.696-16.696-16.696v55.652 C271.348,183.652,283.826,196.136,283.826,211.478z"></path> </g> </g></svg>
                    <span class="text-white font-bold text-2xl">x008</span>
                </div>
                <div
                    class="bg-red-100 col-span-2 flex justify-center m-3 p-2 rounded-md border-orange-400 border-4 border-dashed">
                    <span class="font-semibold text-xl text-center">Paleta de colores</span>
                </div>
                <div @click="selectItem(item)" v-for="item in props.items"
                     class="flex justify-center items-center w-full h-full">
                    <button
                        :class="['bg-gray-100 shadow-md rounded-lg hover:opacity-75 hover:scale-95 duration-300 select-none font-bold text-6xl' ,
                        {'py-[30%] px-[35%]' : item.type !== types.image && item.type !== types.figure },
                        {'py-[18%] px-[16%]' : item.type === types.color },
                        {'py-[12%] px-[20%]' : item.type === types.letter },
                        {'py-[26%] px-[26%]' : (item.type === types.image || item.type === types.figure ) && item.size === sizes.small },
                        {'py-[20%] px-[20%]' : (item.type === types.image || item.type === types.figure ) && item.size === sizes.normal },
                        {'py-[16%] px-[16%]' : (item.type === types.image || item.type === types.figure ) && item.size === sizes.big }
                        ]">

                        {{ item.type === types.letter || item.type === types.number ? item.name : null }}

                        <IconPaintBrush v-if="item.type === types.color" :hex="item.hex"/>

                        <img v-if="item.type === types.image || item.type === types.figure" :src="item.content" alt=""
                             :class="[
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
                    <button
                        class="bg-yellow-infinite py-5 px-12 border-yellow-600 border-4 rounded-md shadow-xl shadow-yellow-400">

                        <div class="arrow">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                    </button>
                </div>

            </div>
        </div>
    </div>
</template>

<style>

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
