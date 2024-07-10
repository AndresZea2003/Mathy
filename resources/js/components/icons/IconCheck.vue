<script setup>

const props = defineProps({
  hex: {type: String},
});

</script>

<template>
  <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="none" width="160">
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
    <g id="SVGRepo_iconCarrier">
      <path :stroke="hex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 5L8 15l-5-4"></path>
    </g>
  </svg>
</template>
