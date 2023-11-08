<script setup>
import BasicActivity from '../templates/BasicActivity.vue'
import {ref, watch} from "vue";

const props = defineProps({
    image: {type: String},
    image_2: {type: String},
})

let showImage = ref(props.image)

let habla = ref('Nop')

const talk = () => {

    let localTalk = ref(localStorage.getItem('talk'))

    if (localTalk.value === 'true') {
        showImage.value = props.image
        localStorage.setItem('talk','false')
    } else {
        showImage.value = props.image_2
        localStorage.setItem('talk','true')
    }
}



watch(habla, () => talk());

</script>
<template>
    <div class="bg-orange-400 h-full flex items-end justify-center">
        <div class="">
            <img @click="talk()" class="cursor-pointer" :src="showImage" width="160" alt="">
        </div>
    </div>
</template>
