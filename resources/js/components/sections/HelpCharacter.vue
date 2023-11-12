<script setup>
import BasicActivity from '../templates/BasicActivity.vue'
import {ref, watch} from "vue";
import {getTalk, talk, talkCharacter} from "../../use/index.js";

const props = defineProps({
    image: {type: String},
    image_2: {type: String},
})

let showImage = ref(props.image)

</script>
<template>
    <div class="bg-orange-400 h-full grid grid-row-2">
        <div class="flex justify-center items-center">
            <div id="itemPresentation" class="h-36 w-36 bg-gray-200 flex justify-center items-center text-8xl font-bold shadow-xl hidden">
            </div>
        </div>
        <div class="flex justify-center items-end">
            <img id="character" @click="talkCharacter(props.image, props.image_2)" class="cursor-pointer" :src="showImage" width="160" alt="">
        </div>
    </div>
</template>
