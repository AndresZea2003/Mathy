<script setup>
import {localHost} from "../use/index.js";
</script>
<template>
    <div class="bg-gray-900 flex justify-center min-h-screen">

<!--        <nav class="bg-gray-300 h-full">-->
<!--            <div class="mx-auto container">-->
<!--                <span class="text-2xl">Holas</span>-->
<!--            </div>-->
<!--        </nav>-->


        <div class="bg-gray-200 container flex justify-center items-center">

            <a :href="`${localHost}/levels`">
                <button class="bg-red-400 p-4 rounded-md border-2 border-red-600 font-bold">Explorar niveles</button>
            </a>

        </div>
    </div>
</template>
