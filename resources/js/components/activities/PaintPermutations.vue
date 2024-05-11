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
    updateCoins, getCoins
} from '../../use';
import {onMounted, onUnmounted, ref} from "vue";
import IconArrowRight from "../icons/IconArrowRight.vue"
import Swal from "sweetalert2";
import BackgroundActivities from "../background/BackgroundActivities.vue";

const props = defineProps({
    size: {type: Array},
    solution: {type: Array},
    level: {type: Array},
    items: {type: Array},
    rotate: {type: Boolean},
    order_to_resolve: {type: Array},
    fill_sample: {type: Array},
})

let totalActivities = ref(0)
let talkBool = ref(false)


onMounted(async () => {
  // ... other code
  await axios.get('/activityCount/' + props.level[0])
      .then(response => totalActivities.value = response.data);
  // showInitialAlert()

})




</script>
<template>

    <BackgroundActivities/>
    <WinView id="winView" class="hidden opacity-0 duration-300"/>

    <div class="flex flex-col min-h-screen">
        <div class="mx-auto flex-1 container flex justify-center">
            <div class="flex p-6 w-full gap-5 rounded-md">
                <div @click="showItemsPresentation()" class="w-[16%]">
                    <HelpCharacter :image="`${localHost}/images/characters/robot/normal.png`"
                                   :image_2="`${localHost}/images/characters/robot/talk.gif`"
                    />
                </div>
                <div id="dat" class="w-[68%] bg-red-200 p-5 grid grid-rows-4">
                    <ProgressBar :planet_1="`${localHost}/images/planets/tierra.svg`"
                                 :planet_2="`${localHost}/images/planets/rojo.svg`"
                                 :rocket="`${localHost}/images/rockets/1.svg`"
                                 :activity_number="props.level[1]"
                    />

                    <div class="row-span-3 flex justify-center items-center">
                        <div>
                            <div class="my-6 flex justify-center gap-5">
                                <div id="activity" :class="[`grid grid-cols-3 gap-y-2 gap-x-1`, talkBool ? 'cursor-not-allowed' : 'cursor-cell']">
                                    <div :id="i" @click="validateOrder(i)" v-for="i in 21"
                                         :key="i"
                                         :style="`width: ${7}vmin; height: ${7}vmin;`"
                                         :class="`bg-white border border-black hover:opacity-75
                                          flex justify-center items-center font-bold text-6xl select-none`">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="w-[16%]">
                    <ItemPalette :level="props.level" :items="items"/>
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
