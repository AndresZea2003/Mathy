<template>
    <div class="flex  items-center justify-between justify-center bg-red-800 h-full">

        <div class="w-full flex justify-center">
            <div class="grid grid-cols-2 gap-4 w-full">
                <div
                    class="bg-red-100 col-span-2 flex justify-center m-3 p-2 rounded-md border-orange-400 border-4 border-dashed">
                    <span class="font-semibold text-xl text-center">Paleta de colores</span>
                </div>
                <div class="flex justify-center items-center w-full h-full">
                    <button
                        class="bg-gray-300 shadow-md rounded-lg p-[40%] hover:bg-gray-400 hover:scale-95 duration-300">

                    </button>
                </div>

                <div class="flex justify-center items-center w-full h-full">
                    <button
                        class="bg-gray-300 shadow-md rounded-lg p-[40%] hover:bg-gray-400 hover:scale-95 duration-300">

                    </button>
                </div>

                <div class="flex justify-center items-center w-full h-full">
                    <button
                        class="bg-gray-300 shadow-md rounded-lg p-[40%] hover:bg-gray-400 hover:scale-95 duration-300">

                    </button>
                </div>

                <div class="flex justify-center items-center w-full h-full">
                    <button
                        class="bg-gray-300 shadow-md rounded-lg p-[40%] hover:bg-gray-400 hover:scale-95 duration-300">

                    </button>
                </div>

                <div class="col-span-2 m-3">
                    <div id="muestra"
                         :class="`border-2 border-black h-14 col-span-2 shadow-xl rounded-md flex justify-center font-bold text-5xl bg-white`">

                    </div>
                </div>

                <div class="col-span-2 flex justify-center">
                    <button
                        class="bg-yellow-infinite py-5 px-12 border-yellow-600 border-4 rounded-md shadow-xl shadow-yellow-400">

                        <div class="arrow">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                    </button>
                </div>

            </div>
        </div>
    </div>

    <!--                                <div class="col-span-2 flex justify-center mt-5">-->
    <!--                                    <a :href="props.route_next">-->
    <!--                                        <button v-if="winLevel"-->
    <!--                                                class="bg-yellow-300 p-2 font-MPlus flex items-center arrow border-2 border-yellow-100 animate-pulse shadow-2xl shadow-amber-300">-->
    <!--                                            Siguiente-->
    <!--                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"-->
    <!--                                                 viewBox="0 0 24 24">-->
    <!--                                                <path-->
    <!--                                                    d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z"/>-->
    <!--                                            </svg>-->
    <!--                                        </button>-->
    <!--                                    </a>-->
    <!--                                </div>-->
</template>

<style>

.bg-yellow-infinite {
    animation: yellow-infinite 2.5s infinite;
}

@keyframes yellow-infinite {
    0% {
        border-color: #fef08a;
        background-color: #facc15;
    }

    50% {
        background-color: #fef08a;
    }

    100% {
        border-color: #fef08a;
        background-color: #facc15;
    }
}

.arrow {
    transform: rotate(-90deg);
    cursor: pointer;
}

.arrow span {
    display: block;
    width: 15px;
    height: 15px;
    border-bottom: 5px solid black;
    border-right: 5px solid black;
    transform: rotate(45deg);
    margin: -15px;
    animation: animate28797 2s infinite;
}

.arrow span:nth-child(2) {
    animation-delay: -0.2s;
}

.arrow span:nth-child(3) {
    animation-delay: -0.4s;
}

@keyframes animate28797 {
    0% {
        opacity: 0;
        transform: rotate(45deg) translate(-20px, -20px);
    }

    50% {
        opacity: 1;
    }

    100% {
        opacity: 0;
        transform: rotate(45deg) translate(20px, 20px);
    }
}

</style>
