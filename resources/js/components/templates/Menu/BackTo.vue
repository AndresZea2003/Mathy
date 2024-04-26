<script setup>

//Importacion de imagenes
import arrow from '../../../../../public/images/globals/Arrow 15.png';

import {localHost} from "@/use/index.js";

</script>

<template>
    <a :href="localHost + '/'">
        <button class="border rounded border-inherit">
            <img class="w-14 p-1" :src="arrow" alt="back"/>
        </button>
    </a>
</template>

<style scoped>
</style>