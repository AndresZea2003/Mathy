<script setup>
import BasicActivity from '../templates/BasicActivity.vue'
import {ref, watch} from "vue";
import {getTalk, talk, talkCharacter} from "../../use/index.js";

const props = defineProps({
  image: {type: String},
  image_2: {type: String},
})

let showImage = ref(props.image)

import IconCheck from "../icons/IconCheck.vue";
import IconError from "../icons/IconError.vue";

</script>
<template>
  <div class="h-full grid grid-row-2">
    <div class="flex justify-center items-end">
      <img id="character" class="cursor-pointer" :src="showImage" width="220" alt="">
    </div>
  </div>
</template>
