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
    <div class="flex flex-col min-h-screen bg-orange-300">

        <!--        <nav class="bg-gray-300">-->
        <!--            <div class="mx-auto container px-[1%]">-->
        <!--                <span class="text-2xl">Holas</span>-->
        <!--            </div>-->
        <!--        </nav>-->

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

                                <div class="grid grid-cols-2">
                                    <div v-for="i in 4" :key="i" class="bg-blue-200 h-12 w-12 border border-black">

                                    </div>
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
