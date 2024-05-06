<script setup>
import DullShrimp from "@/components/ui/DullShrimp.vue";
import LightBars from "@/components/ui/LightBars.vue";
import {localHost, playAudio, setOnEnded} from "@/use/index.js";

const props = defineProps({
  activity: {type: Number, required: true},
  color: {type: String, default: "bg-red-500"},
  textColor: {type: String, default: "text-white"},
  hoverColor: {type: String, default: "bg-space"},
  hoverTextColor: {type: String, default: "text-white"},
})

let popSound = false
const playHoverSound = () => {
  if (!popSound) {
    let audioPop = playAudio(`${localHost}/audios/effects/happyPop.mp3`)
    popSound = true
    setOnEnded(audioPop, () => {
      popSound = false
    })
  }
}

</script>
<template>
  <div :class="[`card`, props.hoverColor]">
    <div :class="[`first-content`, props.color]" style="background-position: center;">
      <div class="text-center">
        <span :class="textColor" @mouseenter="playHoverSound()">Reto {{ props.activity }}</span>
        <div class="flex justify-center items-center">
          <!--        <LightBars class=""></LightBars>-->
        </div>
      </div>
    </div>
    <div class="second-content">
      <span :class="[`z-10`, props.hoverTextColor]" @mouseenter="playHoverSound()">Jugar!</span>
      <div class="fixed">
        <!--      <DullShrimp class="absolute -z-10"></DullShrimp>-->
        <DullShrimp class="absolute scale-50 -z-10"></DullShrimp>
        <DullShrimp class="absolute scale-50 -z-10"></DullShrimp>
      </div>

    </div>


  </div>
</template>
<style scoped>
.card {
  width: 150px;
  height: 160px;
  //background: rgb(103, 225, 255);
  transition: all 0.4s;
  border-radius: 10px;
  box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.705);
  font-size: 20px;
  font-weight: 900;
}

.card:hover {
  border-radius: 15px;
  cursor: pointer;
  transform: scale(.9);
  box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.705);
  //background: rgb(103, 151, 255);
}

.first-content {
  height: 100%;
  width: 100%;
  transition: all 0.4s;
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 1;
  border-radius: 15px;
}

.card:hover .first-content {
  height: 0px;
  opacity: 0;
}

.second-content {
  height: 0%;
  width: 100%;
  opacity: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 15px;
  transition: all 0.4s;
  font-size: 0px;
  transform: rotate(90deg) scale(-1);
}

.card:hover .second-content {
  opacity: 1;
  height: 100%;
  font-size: 1.8rem;
  transform: rotate(0deg);
}

</style>