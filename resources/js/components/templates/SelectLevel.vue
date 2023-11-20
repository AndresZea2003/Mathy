<script setup>

import {localHost} from "../../use/index.js";


</script>
<template>
    <div class="h-full bg-space flex justify-center items-center">

        <div class="grid grid-cols-5 gap-y-16">

            <div class="col-span-5 flex justify-center select-none opacity-90">
                <div class="bg-blue-200 rounded-md p-2 border-4 border-blue-400">
                    <div class="font-bold text-6xl flex justify-center">Comienza la aventura!</div>
                    <div class="font-bold text-2xl flex justify-center text-gray-500">Selecciona un planeta para
                        comenzar!
                    </div>
                </div>
            </div>

            <a :href="`${localHost}/levels/1`">
                <div class="hover:scale-75 duration-300">
                    <img :src="`${localHost}/images/planets/tierra.svg`" width="160" alt="">
                    <span class="text-white text-7xl font-bold absolute -translate-y-[280%] -translate-x-[40%]">1</span>
                </div>
            </a>

            <a :href="`${localHost}/levels/2`">
                <div class="hover:scale-75 duration-300">
                    <img :src="`${localHost}/images/planets/rojo.svg`" width="160" alt="">
                    <span class="text-white text-7xl font-bold absolute -translate-y-[280%] -translate-x-[40%]">2</span>
                </div>

            </a>


            <a :href="`${localHost}/levels/3`">
                <div class="hover:scale-75 duration-300">
                    <img :src="`${localHost}/images/planets/venus.svg`" width="160" alt="">
                    <span class="text-white text-7xl font-bold absolute -translate-y-[270%] -translate-x-[10%]">3</span>
                </div>
            </a>


            <div class="hover:scale-75 duration-300">
                <img :src="`${localHost}/images/planets/jupiter.svg`" width="160" alt="">
                <span class="text-white text-7xl font-bold absolute -translate-y-[270%] -translate-x-[40%]">4</span>
            </div>

            <div class="hover:scale-75 duration-300 -translate-y-[20%]">
                <img :src="`${localHost}/images/planets/marte.svg`" width="160" alt="">
                <span class="text-white text-7xl font-bold absolute -translate-y-[310%] -translate-x-[40%]">5</span>
            </div>

            <div class="hover:scale-75 duration-300">
                <img :src="`${localHost}/images/planets/saturno.svg`" width="260" alt="">
                <span class="text-white text-7xl font-bold absolute -translate-y-[380%] -translate-x-[10%]">6</span>
            </div>

            <div class="hover:scale-75 duration-300">
                <img :src="`${localHost}/images/planets/gray.svg`" width="160" alt="">
                <span class="text-white text-7xl font-bold absolute -translate-y-[270%] -translate-x-[40%]">7</span>
            </div>

            <div class="hover:scale-75 duration-300 flex items-center -translate-y-[20%]">
                <img :src="`${localHost}/images/planets/mercurio.svg`" width="160" alt="">
                <span class="text-white text-7xl font-bold absolute -translate-y-[100%] -translate-x-[40%]">8</span>
            </div>

            <div class="hover:scale-75 duration-300">
                <img :src="`${localHost}/images/planets/tierra2.svg`" width="160" alt="">
                <span class="text-white text-7xl font-bold absolute -translate-y-[270%] -translate-x-[40%]">9</span>
            </div>

            <div class="hover:scale-75 duration-300">
                <img :src="`${localHost}/images/planets/luna.svg`" width="160" alt="">
                <span class="text-white text-7xl font-bold absolute -translate-y-[270%] -translate-x-[40%]">10</span>
            </div>
        </div>

    </div>
</template>
