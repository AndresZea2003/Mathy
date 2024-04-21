<script setup>
import BasicActivity from '../templates/BasicActivity.vue'
import {ref, watch} from "vue";
import {getTalk, talk, talkCharacter} from "../../use/index.js";

const props = defineProps({
  image: {type: String},
  image_2: {type: String},
})

let showImage = ref(props.image);

import IconCheck from "../icons/IconCheck.vue";
import IconError from "../icons/IconError.vue";

</script>
<template>
  <div class="backdrop-blur-sm border-2 border-blue-900 rounded-md h-full grid grid-row-2 ">
    <div class="flex justify-center items-center">
      <IconCheck id="icon-check" class="absolute duration-300 opacity-0" hex="#166534"></IconCheck>
      <IconError id="icon-error" class="absolute duration-300 opacity-0" hex="#dc2626"></IconError>
      <div id="itemPresentation"
           class="duration-300 h-36 w-36 bg-gray-200 flex justify-center items-center text-8xl font-bold shadow-xl hidden">
      </div>
    </div>
    <div class="flex justify-center items-end">
      <img id="character" class="cursor-pointer" :src="showImage" width="160" alt="">
    </div>
  </div>
</template>
