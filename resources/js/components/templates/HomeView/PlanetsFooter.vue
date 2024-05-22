<script setup>

const planets = [
  'rgba(149, 0, 0, 1)',
  'rgba(0, 149, 0, 1)',
  'rgba(0, 22, 149, 1)',
  'rgba(149, 0, 129, 1)',
  'rgba(0, 127, 149, 1)',
  'rgba(141, 149, 0, 1)',
  'rgba(0, 149, 89, 1)',
  'rgba(0, 79, 149, 1)',
  'rgba(82, 0, 149, 1)',
  'rgba(149, 69, 0, 1)',
  'rgba(149, 0, 69, 1)'
];


const randomPlanetColor = () => {
  let randomNum = Math.floor(Math.random() * planets.length);

  return planets[randomNum];
};


</script>

<template>
  <div class="w-full h-full absolute flex justify-center overflow-hidden">
    <div class="planets-footer__div--planet rounded-full w-10 h-10 absolute" :style="{background: `radial-gradient(circle, rgba(0,0,0,1) 29%, ${randomPlanetColor()} 100%)` }"></div>
  </div>
</template>

<style scoped>
.planets-footer__div--planet {
  width: 3000px;
  height: 3000px;
  bottom: -2850px;
  /* background-color: rgb(149, 0, 69); */
  background: radial-gradient(circle, rgba(0,0,0,1) 29%, rgba(5,0,255,1) 100%);
  -webkit-box-shadow: 0px 0px 55px -2px rgba(255,255,255,1);
  -moz-box-shadow: 0px 0px 55px -2px rgba(255,255,255,1);
  box-shadow: 0px 0px 55px -2px rgba(255,255,255,1);
}
</style>