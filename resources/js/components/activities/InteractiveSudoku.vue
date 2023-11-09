<script setup>
import "../sections/HelpCharacter.vue";
import HelpCharacter from "../sections/HelpCharacter.vue";
import ItemPalette from "../sections/ItemPalette.vue";
import ProgressBar from "../sections/ProgressBar.vue";
import {types} from '../../use';


let localHost = window.location.origin

const paintItem = (id) => {
    document.getElementById(id).innerText = localStorage.getItem('itemSelected');
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
                                    <div :id="i" @click="paintItem(i)" v-for="i in 9" :key="i" class="bg-blue-200 h-36 w-36 border border-black hover:opacity-75 flex justify-center items-center font-bold text-6xl">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-[16%] bg-red-200">
                    <ItemPalette :items="[
                        { name : 'a', type: types.letter },
                        { name : 'b', type: types.letter },
                        { name : 'c', type: types.letter },
                        { name : 'd', type: types.letter }
                        ]"/>
                </div>
            </div>
        </div>
    </div>
</template>
