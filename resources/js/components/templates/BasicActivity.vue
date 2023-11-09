<script setup>
import "../sections/HelpCharacter.vue";
import HelpCharacter from "../sections/HelpCharacter.vue";
import ItemPalette from "../sections/ItemPalette.vue";
import ProgressBar from "../sections/ProgressBar.vue";

let localHost = window.location.origin

let aver = 'BASE';

const idk = () => {
    aver = 'Nope';
}

</script>
<template>
    <div class="bg-space flex flex-col min-h-screen">

        <!--        <nav class="bg-gray-300">-->
        <!--            <div class="mx-auto container px-[1%]">-->
        <!--                <span class="text-2xl">Holas</span>-->
        <!--            </div>-->
        <!--        </nav>-->

        <div class="mx-auto flex-1 container flex justify-center p-[1%]">

            <div class="flex bg-orange-600 p-6 w-full gap-5 rounded-md">
                <div class="w-[16%] bg-red-200">
                    <HelpCharacter :image="`${localHost}/images/characters/robot/normal.png`"
                                   :image_2="`${localHost}/images/characters/robot/talk.gif`" class=""/>
                </div>
                <div id="dat" class="w-[68%] bg-red-200 p-5">
                    <div class="bg-red-500 flex-col justify-center items-center h-full">
                        <div>
                            <div class="mx-auto container p-[1%] flex justify-center">
                                <div class="">
                                    <div class="mx-auto container p-[1%] flex justify-center">
                                        <ProgressBar :planet_1="`${localHost}/images/planets/tierra.svg`"
                                                     :planet_2="`${localHost}/images/planets/rojo.svg`"
                                                     :rocket="`${localHost}/images/rockets/1.svg`"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="board" class="flex flex-grow justify-center">
                            <div class="grid grid-cols-2 bg-blue-600 w-full">
                                <div class="flex justify-center items-center">
                                    <button
                                        class="bg-gray-300 shadow-md rounded-lg p-[40%] hover:bg-gray-400 hover:scale-95 duration-300">
                                    </button>
                                </div>
                                <div class="flex justify-center items-center">
                                    <button
                                        class="bg-gray-300 shadow-md rounded-lg p-[40%] hover:bg-gray-400 hover:scale-95 duration-300">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-[16%] bg-red-200">
                    <ItemPalette/>
                </div>
            </div>
        </div>
    </div>
</template>
