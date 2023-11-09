<script setup>
import "../sections/HelpCharacter.vue";
import HelpCharacter from "../sections/HelpCharacter.vue";
import ItemPalette from "../sections/ItemPalette.vue";
import ProgressBar from "../sections/ProgressBar.vue";
import {types, localHost, getSelectItem} from '../../use';

const items = [
    {name: 'a', type: types.letter, content: 'a'},
    {name: 'b', type: types.letter, content: 'b'},
    {name: 'c', type: types.letter, content: 'c'},
    {name: 'd', type: types.letter, content: 'd'},
    {name: 'azul', type: types.color, content: 'bg-blue-600'},
    {name: 'eraser', type: types.eraser, content: 'bg-white'},
]

const paintItem = (id) => {

    let itemSelected = getSelectItem()

    if (itemSelected.type === types.letter || itemSelected.type === types.number) {
        for (let i = 0; i < items.length; i++) {
            const item = items[i];
            document.getElementById(id).classList.remove(item.content)
        }
        document.getElementById(id).classList.add('bg-white')
        document.getElementById(id).innerText = itemSelected.name;
    } else if (itemSelected.type === types.color) {
        for (let i = 0; i < items.length; i++) {
            const item = items[i];
            document.getElementById(id).classList.remove(item.content)
        }
        document.getElementById(id).classList.remove('bg-white')
        document.getElementById(id).classList.add(itemSelected.content)
        document.getElementById(id).innerText = null
    }
}

</script>
<template>
    <div class="flex flex-col min-h-screen bg-orange-300">
        <div class="mx-auto flex-1 container flex justify-center">
            <div class="flex bg-orange-600 p-6 w-full gap-5 rounded-md">
                <div class="w-[16%] bg-red-200">
                    <HelpCharacter :image="`${localHost}/images/characters/robot/normal.png`"
                                   :image_2="`${localHost}/images/characters/robot/talk.gif`" class=""/>
                </div>
                <div id="dat" class="w-[68%] bg-red-200 p-5 grid grid-rows-4">
                    <ProgressBar :planet_1="`${localHost}/images/planets/tierra.svg`"
                                 :planet_2="`${localHost}/images/planets/rojo.svg`"
                                 :rocket="`${localHost}/images/rockets/1.svg`"/>
                    <div class="bg-red-500 flex justify-center items-center row-span-3">
                        <div>
                            <div class="my-6 flex justify-center">

                                <div class="grid grid-cols-3">
                                    <div :id="i" @click="paintItem(i)" v-for="i in 9" :key="i"
                                         class="bg-white h-36 w-36 border border-black hover:opacity-75 flex justify-center items-center font-bold text-6xl">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-[16%] bg-red-200">
                    <ItemPalette :items="items"/>
                </div>
            </div>
        </div>
    </div>
</template>
