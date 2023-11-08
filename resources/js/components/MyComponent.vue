<template>
    <div class="bg-gray-900 flex flex-col min-h-screen">

        <nav class="bg-gray-300 h-full">
            <div class="mx-auto container">
                <span class="text-2xl">Holas</span>
            </div>
        </nav>


        <div class="bg-gray-200 mx-auto flex-1 container flex justify-center items-center">

            <div class="flex bg-blue-600 p-6 w-full gap-5">
                <div class="w-[10%] bg-red-200">
                    Robot
                </div>
                <div class="w-[70%] bg-red-200">

                    <div v-for="i in 4" :key="i" class="flex">

                        <div class="border-black border h-[5px] w-[5px]"></div>
                    </div>

                </div>
                <div class="w-[20%] bg-red-200">
                    Paleta
                </div>
            </div>
        </div>
    </div>
</template>
