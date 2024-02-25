<script setup>
import {ref} from "vue";
import PlanetMoon from "@/components/ui/PlanetMoon.vue";
import SpaceBg from "@/components/ui/SpaceBg.vue";
import ButtonStar from "@/components/ui/ButtonStar.vue";
import {localHost} from "@/use/index.js";

import PlanetSaturn from "@/components/ui/PlanetSaturn.vue";
import DullShrimp from "@/components/ui/DullShrimp.vue";

const props = defineProps({
  asset_images: {type: String, required: true},
  asset_audio: {type: String, required: true},
  levels_route: {type: String, required: true}
})


</script>
<template>

<!--  Pagina inicial del juego-->

  <SpaceBg></SpaceBg>
  <div class="h-screen fixed w-screen flex justify-center items-center">
    <div class="fixed " style="transform: rotate(-18deg) translateX(-400px) translateY(-50px);">
      <PlanetMoon></PlanetMoon>
    </div>
    <div class="fixed" style="transform: rotate(40deg) translateX(200px) translateY(-430px) scale(.75);">
      <PlanetSaturn></PlanetSaturn>
    </div>
    <div class="fixed -z-10 opacity-50" style="transform: rotate(40deg) translateX(300px) translateY(-150px) scale(.5);">
      <DullShrimp></DullShrimp>
    </div>


    <div>
      <div class="text-white font-luckiest-guy text-7xl text-center select-none">
        Salva la <span class="text-red-500">Colores</span> con <br>
        <span class="text-red-500">Mati</span> y <span class="text-blue-500">Motas</span>
      </div>

      <div class="bg-amber-200 absolute translate-x-[600px] p-2 border-amber-400 border-2 rounded select-none"
           style="transform: rotate(-18deg) translateX(-70px) translateY(-240px);">
        <span class="font-bangers text-amber-900 text-2xl">Experiencias Logico Matematicas</span>
      </div>
      <div class="flex justify-center pt-16">
        <a :href="localHost + '/levels'">
          <buttonStar id="buttonStar" class="buttonStar"></buttonStar>
        </a>
      </div>
    </div>
  </div>
</template>
<style scoped>
@keyframes glow {
  0% {
    box-shadow: 0 0 5px #32CD32, 0 0 10px #32CD32, 0 0 15px #32CD32, 0 0 20px #32CD32;
  }
  100% {
    box-shadow: 0 0 10px #32CD32, 0 0 20px #32CD32, 0 0 30px #32CD32, 0 0 40px #32CD32;
  }
}

.buttonStar {
  animation: changeColor 4s linear infinite;
}
.buttonStar:hover {
  animation: glow 2s ease-in-out infinite alternate;
}

@keyframes changeColor {
  0% {
    background-color: #96dc92;
  }
  40% {
    background-color: #fff;
    box-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #fff, 0 0 20px #fff;
  }
  60% {
    background-color: #96dc92;
    box-shadow: 0 0 5px #96dc92, 0 0 10px #96dc92, 0 0 15px #96dc92, 0 0 20px #96dc92;
  }
  100% {
    background-color: #96dc92;
  }
}
</style>
