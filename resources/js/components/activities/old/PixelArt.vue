<script setup>
import Swal from 'sweetalert2'
import {ref} from "vue";

let color = 'white';
let figura1 = 0;
let mati = ref(`${props.asset_images}/robot/mati_act1.gif`)
let pulso = ref(false)

const props = defineProps({
    route_back: {type: String, required: true},
    route_next: {type: String, required: true},
    asset_images: {type: String, required: true},
    asset_audio: {type: String, required: true}
})

const paint = (id) => {

    // if (color === 'white') {
    //         Swal.fire({
    //             icon: 'warning',
    //             title: 'Falta color!',
    //             text: 'Selecciona un color primero',
    //             showConfirmButton: true,
    //         })
    //     }

    if (pulso.value === true) {

        // let sound = new Audio();
        // sound.src = `${props.asset_audio}/paint.wav`;
        // sound.play()

        document.getElementById(id).classList.remove('hover:bg-gray-400')
        document.getElementById(id).classList.remove('bg-blue-600')
        document.getElementById(id).classList.remove('bg-stone-700')
        document.getElementById(id).classList.remove('bg-yellow-400')
        document.getElementById(id).classList.remove('bg-green-600')
        document.getElementById(id).classList.remove('white')
        document.getElementById(id).classList.add(`bg-${color}`);

        // Figura 1
        if (document.getElementById('caja1').classList.contains('bg-red-600') &&
            document.getElementById('caja2').classList.contains('bg-yellow-400') &&
            document.getElementById('caja3').classList.contains('bg-red-600') &&
            document.getElementById('caja4').classList.contains('bg-yellow-400') &&

            document.getElementById('caja5').classList.contains('bg-yellow-400') &&
            document.getElementById('caja6').classList.contains('bg-red-600') &&
            document.getElementById('caja7').classList.contains('bg-yellow-400') &&
            document.getElementById('caja8').classList.contains('bg-red-600') &&

            document.getElementById('caja9').classList.contains('bg-red-600') &&
            document.getElementById('caja10').classList.contains('bg-yellow-400') &&
            document.getElementById('caja11').classList.contains('bg-red-600') &&
            document.getElementById('caja12').classList.contains('bg-yellow-400') &&

            document.getElementById('caja13').classList.contains('bg-yellow-400') &&
            document.getElementById('caja14').classList.contains('bg-red-600') &&
            document.getElementById('caja15').classList.contains('bg-yellow-400') &&
            document.getElementById('caja16').classList.contains('bg-red-600')
        ) {

            document.getElementById('fig1').classList.remove('text-gray-300')
            document.getElementById('fig1').classList.add('text-green-600')

            if (figura1 === 0) {
                let sound = new Audio();
                sound.src = `${props.asset_audio}/coin.wav`;
                sound.play()
                figura1++
                Swal.fire({
                    icon: 'success',
                    title: 'Completado!',
                    text: 'Felicidades! Has completado la actividad',
                    showConfirmButton: true,
                })

                mati.value = `${props.asset_images}/robot/mati.gif`
                document.getElementById('fondoMati').classList.remove('bg-red-400')
                document.getElementById('fondoMati').classList.add('bg-green-300')
            }
        } else {
            document.getElementById('fig1').classList.remove('text-green-600')
            document.getElementById('fig1').classList.add('text-gray-300')
        }
    }

}

const clickPaint = () => {
    pulso.value = !pulso.value;
    console.log(pulso.value)
}

const selectColor = (bg) => {
    color = bg

    document.getElementById('muestra').classList.remove('bg-blue-600')
    document.getElementById('muestra').classList.remove('bg-yellow-400')
    document.getElementById('muestra').classList.remove('bg-green-600')
    document.getElementById('muestra').classList.remove('bg-stone-700')
    document.getElementById('muestra').classList.remove('bg-white')

    document.getElementById('muestra').classList.add(`bg-${color}`)

    let sound = new Audio();
    sound.src = `${props.asset_audio}/bubble.wav`;
    sound.play()
}

</script>

<template>
    <div class="min-h-full bg-space" @mousedown="clickPaint()" @mouseup="clickPaint()">
        <div class="md:container mx-auto">
            <div class="font-bold text-xl bg-gray-900 mx-5 px-5 py-3 rounded-b-lg shadow-2xl text-white">Matematicas -
                Nivel 3
            </div>
        </div>
        <div class="container mx-auto mb-10 rounded-md px-5">
            <div class="bg-green-400 border-4 border-green-600 flex-col pb-2 rounded-md shadow-2xl">
                <div class="mx-5 py-2">
                    <div>
                        <span class="font-bold">Actividad 1 -</span>
                        <span> Replica los colores como se muestra en la imagen izquierda</span>
                    </div>
                </div>
                <div class="grid md:grid-cols-4 mx-5">
                    <div
                        class="bg-white rounded-md md:col-span-3 grid md:grid-cols-2">
                        <div class="flex justify-center border-black border-4">
                            <div class="grid grid-cols-11">
                                <!--                            linea1-->
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <!--                            linea2-->
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-x-4 border-t-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-x-4 border-t-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <!--                            linea3-->
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-l-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-y-4 border-r-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-l-4 border-y-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-r-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <!--                            linea4-->
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-l-4 ">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-x-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-x-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-r-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <!--                            linea5-->
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-l-4 border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-x-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-green-600 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-green-600 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-green-600 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-green-600 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-green-600 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-x-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-r-4 border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <!--                            linea6-->
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-x-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-l-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-r-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-x-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <!--                            linea7-->
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-l-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-b-4 border-r-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-l-4 border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-r-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <!--                            linea8-->
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-l-4 border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-r-4 border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-stone-700 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-l-4 border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-yellow-400 grid grid-cols-3 border-black border-r-4 border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <!--                            linea9-->
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-blue-600 grid grid-cols-3 border-black border-l-4 border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-blue-600 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-blue-600 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-blue-600 grid grid-cols-3 border-black border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="bg-blue-600 grid grid-cols-3 border-black border-r-4 border-b-4">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <!--                            linea10-->
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                    <div class="select-none p-2 hover:bg-blue-700">{{ null }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center border-black border-4">
                            <div class="bg-white  grid grid-cols-11">
                                <!--                                linea1-->
                                <div class=" grid grid-cols-3">
                                    <div @mousemove="paint('caja1')" id="caja1"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja2')" id="caja2"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja3')" id="caja3"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja4')" id="caja4"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja5')" id="caja5"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja6')" id="caja6"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja7')" id="caja7"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja8')" id="caja8"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja9')" id="caja9"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja10')" id="caja10"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja11')" id="caja11"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja12')" id="caja12"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja13')" id="caja13"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja14')" id="caja14"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja15')" id="caja15"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja16')" id="caja16"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja17')" id="caja17"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja18')" id="caja18"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja19')" id="caja19"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja20')" id="caja20"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja21')" id="caja21"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja22')" id="caja22"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja23')" id="caja23"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja24')" id="caja24"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja25')" id="caja25"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja26')" id="caja26"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja27')" id="caja27"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja28')" id="caja28"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja29')" id="caja29"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja30')" id="caja30"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja31')" id="caja31"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja32')" id="caja32"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja33')" id="caja33"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja34')" id="caja34"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja35')" id="caja35"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja36')" id="caja36"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja37')" id="caja37"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja38')" id="caja38"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja39')" id="caja39"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja40')" id="caja40"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja41')" id="caja41"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja42')" id="caja42"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja43')" id="caja43"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja44')" id="caja44"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja45')" id="caja45"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja46')" id="caja46"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja47')" id="caja47"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja48')" id="caja48"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja49')" id="caja49"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja50')" id="caja50"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja51')" id="caja51"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja52')" id="caja52"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja53')" id="caja53"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja54')" id="caja54"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja55')" id="caja55"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja56')" id="caja56"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja57')" id="caja57"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja58')" id="caja58"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja59')" id="caja59"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja60')" id="caja60"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja61')" id="caja61"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja62')" id="caja62"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja63')" id="caja63"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja64')" id="caja64"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja65')" id="caja65"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja66')" id="caja66"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja67')" id="caja67"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja68')" id="caja68"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja69')" id="caja69"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja70')" id="caja70"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja71')" id="caja71"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja72')" id="caja72"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja73')" id="caja73"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja74')" id="caja74"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja75')" id="caja75"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja76')" id="caja76"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja77')" id="caja77"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja78')" id="caja78"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja79')" id="caja79"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja80')" id="caja80"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja81')" id="caja81"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja82')" id="caja82"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja83')" id="caja83"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja84')" id="caja84"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja85')" id="caja85"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja86')" id="caja86"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja87')" id="caja87"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja88')" id="caja88"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja89')" id="caja89"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja90')" id="caja90"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja91')" id="caja91"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja92')" id="caja92"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja93')" id="caja93"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja94')" id="caja94"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja95')" id="caja95"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja96')" id="caja96"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja97')" id="caja97"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja98')" id="caja98"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja99')" id="caja99"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <!--                linea2-->
                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja100')" id="caja100"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja101')" id="caja101"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja102')" id="caja102"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja103')" id="caja103"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja104')" id="caja104"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja105')" id="caja105"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja106')" id="caja106"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja107')" id="caja107"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja108')" id="caja108"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-l-4 border-t-4">
                                    <div @mousemove="paint('caja109')" id="caja109"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja110')" id="caja110"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja111')" id="caja111"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja112')" id="caja112"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja113')" id="caja113"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja114')" id="caja114"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja115')" id="caja115"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja116')" id="caja116"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja117')" id="caja117"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-l-4">
                                    <div @mousemove="paint('caja118')" id="caja118"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja119')" id="caja119"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja120')" id="caja120"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja121')" id="caja121"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja122')" id="caja122"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja123')" id="caja123"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja124')" id="caja124"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja125')" id="caja125"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja126')" id="caja126"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja127')" id="caja127"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja128')" id="caja128"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja129')" id="caja129"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja130')" id="caja130"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja131')" id="caja131"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja132')" id="caja132"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja133')" id="caja133"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja134')" id="caja134"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja135')" id="caja135"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja136')" id="caja136"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja137')" id="caja137"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja138')" id="caja138"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja139')" id="caja139"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja140')" id="caja140"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja141')" id="caja141"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja142')" id="caja142"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja143')" id="caja143"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja144')" id="caja144"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja145')" id="caja145"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja146')" id="caja146"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja147')" id="caja147"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja148')" id="caja148"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja149')" id="caja149"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja150')" id="caja150"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja151')" id="caja151"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja152')" id="caja152"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja153')" id="caja153"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja154')" id="caja154"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja155')" id="caja155"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja156')" id="caja156"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja157')" id="caja157"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja158')" id="caja158"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja159')" id="caja159"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja160')" id="caja160"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja161')" id="caja161"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja162')" id="caja162"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja163')" id="caja163"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja164')" id="caja164"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja165')" id="caja165"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja166')" id="caja166"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja167')" id="caja167"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja168')" id="caja168"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja169')" id="caja169"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja170')" id="caja170"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja171')" id="caja171"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-r-4">
                                    <div @mousemove="paint('caja172')" id="caja172"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja173')" id="caja173"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja174')" id="caja174"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja175')" id="caja175"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja176')" id="caja176"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja177')" id="caja177"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja178')" id="caja178"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja179')" id="caja179"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja180')" id="caja180"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-r-4 border-t-4">
                                    <div @mousemove="paint('caja181')" id="caja181"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja182')" id="caja182"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja183')" id="caja183"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja184')" id="caja184"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja185')" id="caja185"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja186')" id="caja186"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja187')" id="caja187"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja188')" id="caja188"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja189')" id="caja189"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">

                                    <div @mousemove="paint('caja190')" id="caja190"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja191')" id="caja191"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja192')" id="caja192"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja193')" id="caja193"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja194')" id="caja194"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja195')" id="caja195"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja196')" id="caja196"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja197')" id="caja197"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja198')" id="caja198"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <!--                linea3-->
                                <div class="grid grid-cols-3 grid-rows-2">

                                    <div @mousemove="paint('caja199')" id="caja199"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja200')" id="caja200"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja201')" id="caja201"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja202')" id="caja202"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja203')" id="caja203"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja204')" id="caja204"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja205')" id="caja205"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja206')" id="caja206"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja207')" id="caja207"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-l-4">
                                    <div @mousemove="paint('caja208')" id="caja208"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja209')" id="caja209"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja210')" id="caja210"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja211')" id="caja211"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja212')" id="caja212"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja213')" id="caja213"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja214')" id="caja214"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja215')" id="caja215"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja216')" id="caja216"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-y-4 border-r-4">
                                    <div @mousemove="paint('caja217')" id="caja217"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja218')" id="caja218"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja219')" id="caja219"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja220')" id="caja220"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja221')" id="caja221"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja222')" id="caja222"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja223')" id="caja223"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja224')" id="caja224"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja225')" id="caja225"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja226')" id="caja226"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja227')" id="caja227"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja228')" id="caja228"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja229')" id="caja229"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja230')" id="caja230"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja231')" id="caja231"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja232')" id="caja232"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja233')" id="caja233"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja234')" id="caja234"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja235')" id="caja235"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja236')" id="caja236"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja237')" id="caja237"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja238')" id="caja238"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja239')" id="caja239"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja240')" id="caja240"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja241')" id="caja241"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja242')" id="caja242"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja243')" id="caja243"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja244')" id="caja244"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja245')" id="caja245"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja246')" id="caja246"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja247')" id="caja247"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja248')" id="caja248"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja249')" id="caja249"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja250')" id="caja250"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja251')" id="caja251"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja252')" id="caja252"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja253')" id="caja253"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja254')" id="caja254"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja255')" id="caja255"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja256')" id="caja256"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja257')" id="caja257"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja258')" id="caja258"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja259')" id="caja259"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja260')" id="caja260"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja261')" id="caja261"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja262')" id="caja262"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja263')" id="caja263"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja264')" id="caja264"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja265')" id="caja265"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja266')" id="caja266"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja267')" id="caja267"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja268')" id="caja268"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja269')" id="caja269"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja270')" id="caja270"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-y-4 border-l-4">
                                    <div @mousemove="paint('caja271')" id="caja271"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja272')" id="caja272"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja273')" id="caja273"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja274')" id="caja274"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja275')" id="caja275"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja276')" id="caja276"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja277')" id="caja277"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja278')" id="caja278"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja279')" id="caja279"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-r-4">
                                    <div @mousemove="paint('caja280')" id="caja280"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja281')" id="caja281"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja282')" id="caja282"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja283')" id="caja283"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja284')" id="caja284"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja285')" id="caja285"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja286')" id="caja286"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja287')" id="caja287"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja288')" id="caja288"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja289')" id="caja289"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja290')" id="caja290"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja291')" id="caja291"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja292')" id="caja292"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja293')" id="caja293"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja294')" id="caja294"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja295')" id="caja295"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja296')" id="caja296"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja297')" id="caja297"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <!--                linea4-->
                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja298')" id="caja298"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja299')" id="caja299"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja300')" id="caja300"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja301')" id="caja301"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja302')" id="caja302"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja303')" id="caja303"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja304')" id="caja304"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja305')" id="caja305"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja306')" id="caja306"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-l-4">
                                    <div @mousemove="paint('caja307')" id="caja307"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja308')" id="caja308"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja309')" id="caja309"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja310')" id="caja310"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja311')" id="caja311"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja312')" id="caja312"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja313')" id="caja313"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja314')" id="caja314"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja315')" id="caja315"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-x-4">
                                    <div @mousemove="paint('caja316')" id="caja316"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja317')" id="caja317"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja318')" id="caja318"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja319')" id="caja319"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja320')" id="caja320"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja321')" id="caja321"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja322')" id="caja322"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja323')" id="caja323"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja324')" id="caja324"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja325')" id="caja325"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja326')" id="caja326"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja327')" id="caja327"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja328')" id="caja328"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja329')" id="caja329"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja330')" id="caja330"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja331')" id="caja331"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja332')" id="caja332"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja333')" id="caja333"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja334')" id="caja334"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja335')" id="caja335"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja336')" id="caja336"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja337')" id="caja337"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja338')" id="caja338"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja339')" id="caja339"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja340')" id="caja340"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja341')" id="caja341"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja342')" id="caja342"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja343')" id="caja343"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja344')" id="caja344"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja345')" id="caja345"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja346')" id="caja346"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja347')" id="caja347"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja348')" id="caja348"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja349')" id="caja349"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja350')" id="caja350"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja351')" id="caja351"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja352')" id="caja352"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja353')" id="caja353"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja354')" id="caja354"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja355')" id="caja355"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja356')" id="caja356"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja357')" id="caja357"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja358')" id="caja358"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja359')" id="caja359"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja360')" id="caja360"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja361')" id="caja361"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja362')" id="caja362"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja363')" id="caja363"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja364')" id="caja364"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja365')" id="caja365"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja366')" id="caja366"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja367')" id="caja367"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja368')" id="caja368"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja369')" id="caja369"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-x-4">

                                    <div @mousemove="paint('caja374')" id="caja374"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja375')" id="caja375"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja376')" id="caja376"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja377')" id="caja377"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja378')" id="caja378"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja379')" id="caja379"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja380')" id="caja380"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja381')" id="caja381"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja382')" id="caja382"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-r-4">

                                    <div @mousemove="paint('caja383')" id="caja383"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja384')" id="caja384"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja385')" id="caja385"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja386')" id="caja386"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja387')" id="caja387"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja388')" id="caja388"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja389')" id="caja389"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja390')" id="caja390"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja391')" id="caja391"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">

                                    <div @mousemove="paint('caja392')" id="caja392"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja393')" id="caja393"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja394')" id="caja394"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja395')" id="caja395"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja396')" id="caja396"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja397')" id="caja397"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja398')" id="caja398"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja399')" id="caja399"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja400')" id="caja400"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <!--                linea5-->
                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja401')" id="caja401"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja402')" id="caja402"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja403')" id="caja403"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja404')" id="caja404"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja405')" id="caja405"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja406')" id="caja406"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja407')" id="caja407"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja408')" id="caja408"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja409')" id="caja409"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-l-4 border-b-4">
                                    <div @mousemove="paint('caja410')" id="caja410"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja411')" id="caja411"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja412')" id="caja412"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja413')" id="caja413"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja414')" id="caja414"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja415')" id="caja415"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja416')" id="caja416"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja417')" id="caja417"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja418')" id="caja418"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-x-4">
                                    <div @mousemove="paint('caja419')" id="caja419"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja420')" id="caja420"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja421')" id="caja421"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja422')" id="caja422"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja423')" id="caja423"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja424')" id="caja424"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja425')" id="caja425"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja426')" id="caja426"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja427')" id="caja427"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja428')" id="caja428"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja429')" id="caja429"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja430')" id="caja430"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja431')" id="caja431"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja432')" id="caja432"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja433')" id="caja433"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja434')" id="caja434"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja435')" id="caja435"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja436')" id="caja436"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja437')" id="caja437"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja438')" id="caja438"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja439')" id="caja439"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja440')" id="caja440"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja441')" id="caja441"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja442')" id="caja442"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja443')" id="caja443"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja444')" id="caja444"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja445')" id="caja445"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja446')" id="caja446"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja447')" id="caja447"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja448')" id="caja448"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja449')" id="caja449"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja450')" id="caja450"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja451')" id="caja451"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja452')" id="caja452"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja453')" id="caja453"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja454')" id="caja454"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja455')" id="caja455"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja456')" id="caja456"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja457')" id="caja457"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja458')" id="caja458"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja459')" id="caja459"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja460')" id="caja460"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja461')" id="caja461"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja462')" id="caja462"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja463')" id="caja463"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja464')" id="caja464"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja465')" id="caja465"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja466')" id="caja466"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja467')" id="caja467"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja468')" id="caja468"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja469')" id="caja469"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja470')" id="caja470"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja471')" id="caja471"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja472')" id="caja472"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-x-4">
                                    <div @mousemove="paint('caja473')" id="caja473"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja474')" id="caja474"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja475')" id="caja475"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja476')" id="caja476"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja477')" id="caja477"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja478')" id="caja478"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja479')" id="caja479"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja480')" id="caja480"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja481')" id="caja481"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-r-4">
                                    <div @mousemove="paint('caja482')" id="caja482"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja483')" id="caja483"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja484')" id="caja484"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja485')" id="caja485"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja486')" id="caja486"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja487')" id="caja487"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja488')" id="caja488"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja489')" id="caja489"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja490')" id="caja490"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja491')" id="caja491"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja492')" id="caja492"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja493')" id="caja493"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja494')" id="caja494"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja495')" id="caja495"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja496')" id="caja496"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja497')" id="caja497"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja498')" id="caja498"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja499')" id="caja499"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <!--                linea6-->
                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja500')" id="caja500"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja501')" id="caja501"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja502')" id="caja502"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja503')" id="caja503"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja504')" id="caja504"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja505')" id="caja505"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja506')" id="caja506"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja507')" id="caja507"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja508')" id="caja508"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja509')" id="caja509"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja510')" id="caja510"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja511')" id="caja511"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja512')" id="caja512"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja513')" id="caja513"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja514')" id="caja514"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja515')" id="caja515"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja516')" id="caja516"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja517')" id="caja517"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-x-4">
                                    <div @mousemove="paint('caja518')" id="caja518"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja519')" id="caja519"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja520')" id="caja520"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja521')" id="caja521"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja522')" id="caja522"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja523')" id="caja523"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja524')" id="caja524"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja525')" id="caja525"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja526')" id="caja526"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-r-4 border-b-4">
                                    <div @mousemove="paint('caja527')" id="caja527"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja528')" id="caja528"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja529')" id="caja529"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja530')" id="caja530"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja531')" id="caja531"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja532')" id="caja532"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja533')" id="caja533"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja534')" id="caja534"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja535')" id="caja535"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja536')" id="caja536"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja537')" id="caja537"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja538')" id="caja538"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja539')" id="caja539"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja540')" id="caja540"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja541')" id="caja541"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja542')" id="caja542"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja543')" id="caja543"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja544')" id="caja544"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja545')" id="caja545"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja546')" id="caja546"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja547')" id="caja547"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja548')" id="caja548"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja549')" id="caja549"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja550')" id="caja550"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja551')" id="caja551"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja552')" id="caja552"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja553')" id="caja553"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja554')" id="caja554"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja555')" id="caja555"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja556')" id="caja556"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja557')" id="caja557"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja558')" id="caja558"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja559')" id="caja559"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja560')" id="caja560"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja561')" id="caja561"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja562')" id="caja562"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4 border-l-4">
                                    <div @mousemove="paint('caja563')" id="caja563"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja564')" id="caja564"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja565')" id="caja565"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja566')" id="caja566"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja567')" id="caja567"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja568')" id="caja568"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja569')" id="caja569"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja570')" id="caja570"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja571')" id="caja571"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-x-4">
                                    <div @mousemove="paint('caja572')" id="caja572"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja573')" id="caja573"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja574')" id="caja574"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja575')" id="caja575"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja576')" id="caja576"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja577')" id="caja577"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja578')" id="caja578"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja579')" id="caja579"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja580')" id="caja580"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-t-4">
                                    <div @mousemove="paint('caja581')" id="caja581"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja582')" id="caja582"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja583')" id="caja583"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja584')" id="caja584"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja585')" id="caja585"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja586')" id="caja586"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja587')" id="caja587"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja588')" id="caja588"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja589')" id="caja589"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja590')" id="caja590"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja591')" id="caja591"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja592')" id="caja592"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja593')" id="caja593"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja594')" id="caja594"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja595')" id="caja595"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja596')" id="caja596"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja597')" id="caja597"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja598')" id="caja598"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <!--                linea7-->
                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja599')" id="caja599"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja600')" id="caja600"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja602')" id="caja602"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja603')" id="caja603"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja604')" id="caja604"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja605')" id="caja605"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja606')" id="caja606"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja607')" id="caja607"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja608')" id="caja608"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja609')" id="caja609"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja610')" id="caja610"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja611')" id="caja611"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja612')" id="caja612"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja613')" id="caja613"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja614')" id="caja614"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja615')" id="caja615"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja616')" id="caja616"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja617')" id="caja617"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-l-4">
                                    <div @mousemove="paint('caja618')" id="caja618"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja619')" id="caja619"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja620')" id="caja620"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja621')" id="caja621"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja622')" id="caja622"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja623')" id="caja623"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja624')" id="caja624"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja625')" id="caja625"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja626')" id="caja626"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja627')" id="caja627"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja628')" id="caja628"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja629')" id="caja629"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja630')" id="caja630"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja631')" id="caja631"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja632')" id="caja632"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja633')" id="caja633"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja634')" id="caja634"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja635')" id="caja635"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4 border-r-4">
                                    <div @mousemove="paint('caja636')" id="caja636"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja637')" id="caja637"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja638')" id="caja638"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja639')" id="caja639"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja640')" id="caja640"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja641')" id="caja641"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja642')" id="caja642"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja643')" id="caja643"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja644')" id="caja644"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja645')" id="caja645"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja646')" id="caja646"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja647')" id="caja647"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja648')" id="caja648"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja649')" id="caja649"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja650')" id="caja650"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja651')" id="caja651"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja652')" id="caja652"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja653')" id="caja653"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4 border-l-4">
                                    <div @mousemove="paint('caja654')" id="caja654"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja655')" id="caja655"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja656')" id="caja656"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja657')" id="caja657"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja658')" id="caja658"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja659')" id="caja659"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja660')" id="caja660"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja661')" id="caja661"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja662')" id="caja662"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja663')" id="caja663"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja664')" id="caja664"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja665')" id="caja665"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja666')" id="caja666"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja667')" id="caja667"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja668')" id="caja668"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja669')" id="caja669"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja670')" id="caja670"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja671')" id="caja671"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-r-4">
                                    <div @mousemove="paint('caja672')" id="caja672"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja673')" id="caja673"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja674')" id="caja674"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja675')" id="caja675"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja676')" id="caja676"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja677')" id="caja677"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja678')" id="caja678"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja679')" id="caja679"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja680')" id="caja680"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja681')" id="caja681"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja682')" id="caja682"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja683')" id="caja683"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja684')" id="caja684"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja685')" id="caja685"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja686')" id="caja686"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja687')" id="caja687"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja688')" id="caja688"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja689')" id="caja689"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja690')" id="caja690"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja691')" id="caja691"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja692')" id="caja692"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja693')" id="caja693"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja694')" id="caja694"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja695')" id="caja695"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja696')" id="caja696"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja697')" id="caja697"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja698')" id="caja698"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <!--                linea8-->
                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja699')" id="caja699"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja700')" id="caja700"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja701')" id="caja701"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja702')" id="caja702"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja703')" id="caja703"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja704')" id="caja704"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja705')" id="caja705"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja706')" id="caja706"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja707')" id="caja707"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja708')" id="caja708"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja709')" id="caja709"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja710')" id="caja710"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja711')" id="caja711"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja712')" id="caja712"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja713')" id="caja713"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja714')" id="caja714"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja715')" id="caja715"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja716')" id="caja716"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4 border-l-4">
                                    <div @mousemove="paint('caja719')" id="caja719"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja720')" id="caja720"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja721')" id="caja721"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja722')" id="caja722"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja723')" id="caja723"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja724')" id="caja724"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja725')" id="caja725"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja726')" id="caja726"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja727')" id="caja727"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja728')" id="caja728"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja729')" id="caja729"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja730')" id="caja730"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja731')" id="caja731"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja732')" id="caja732"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja733')" id="caja733"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja734')" id="caja734"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja735')" id="caja735"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja736')" id="caja736"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4 border-l-4">
                                    <div @mousemove="paint('caja737')" id="caja737"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja738')" id="caja738"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja739')" id="caja739"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja740')" id="caja740"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja741')" id="caja741"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja742')" id="caja742"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja743')" id="caja743"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja744')" id="caja744"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja745')" id="caja745"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja746')" id="caja746"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja747')" id="caja747"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja748')" id="caja748"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja749')" id="caja749"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja750')" id="caja750"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja751')" id="caja751"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja752')" id="caja752"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja753')" id="caja753"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja754')" id="caja754"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4 border-r-4">
                                    <div @mousemove="paint('caja755')" id="caja755"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja756')" id="caja756"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja757')" id="caja757"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja758')" id="caja758"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja759')" id="caja759"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja760')" id="caja760"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja761')" id="caja761"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja762')" id="caja762"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja763')" id="caja763"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja764')" id="caja764"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja765')" id="caja765"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja766')" id="caja766"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja767')" id="caja767"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja768')" id="caja768"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja769')" id="caja769"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja770')" id="caja770"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja771')" id="caja771"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja772')" id="caja772"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4 border-r-4">
                                    <div @mousemove="paint('caja773')" id="caja773"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja774')" id="caja774"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja775')" id="caja775"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja776')" id="caja776"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja777')" id="caja777"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja778')" id="caja778"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja779')" id="caja779"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja780')" id="caja780"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja781')" id="caja781"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja782')" id="caja782"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja783')" id="caja783"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja784')" id="caja784"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja785')" id="caja785"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja786')" id="caja786"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja787')" id="caja787"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja788')" id="caja788"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja789')" id="caja789"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja790')" id="caja790"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja791')" id="caja791"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja792')" id="caja792"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja793')" id="caja793"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja794')" id="caja794"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja795')" id="caja795"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja796')" id="caja796"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja797')" id="caja797"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja798')" id="caja798"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja799')" id="caja799"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <!--                linea9-->
                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja800')" id="caja800"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja801')" id="caja801"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja802')" id="caja802"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja803')" id="caja803"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja804')" id="caja804"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja805')" id="caja805"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja806')" id="caja806"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja807')" id="caja807"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja808')" id="caja808"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja809')" id="caja809"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja810')" id="caja810"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja811')" id="caja811"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja812')" id="caja812"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja813')" id="caja813"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja814')" id="caja814"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja815')" id="caja815"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja816')" id="caja816"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja817')" id="caja817"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja818')" id="caja818"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja819')" id="caja819"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja820')" id="caja820"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja821')" id="caja821"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja822')" id="caja822"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja823')" id="caja823"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja824')" id="caja824"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja825')" id="caja825"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja826')" id="caja826"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4 border-l-4">
                                    <div @mousemove="paint('caja827')" id="caja827"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja828')" id="caja828"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja829')" id="caja829"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja830')" id="caja830"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja831')" id="caja831"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja832')" id="caja832"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja833')" id="caja833"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja834')" id="caja834"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja835')" id="caja835"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja836')" id="caja836"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja837')" id="caja837"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja838')" id="caja838"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja839')" id="caja839"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja840')" id="caja840"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja841')" id="caja841"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja842')" id="caja842"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja843')" id="caja843"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja844')" id="caja844"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja845')" id="caja845"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja846')" id="caja846"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja847')" id="caja847"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja848')" id="caja848"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja849')" id="caja849"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja850')" id="caja850"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja851')" id="caja851"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja852')" id="caja852"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja853')" id="caja853"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4">
                                    <div @mousemove="paint('caja854')" id="caja854"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja855')" id="caja855"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja856')" id="caja856"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja857')" id="caja857"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja858')" id="caja858"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja859')" id="caja859"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja860')" id="caja860"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja861')" id="caja861"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja862')" id="caja862"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2 border-black border-b-4 border-r-4">
                                    <div @mousemove="paint('caja863')" id="caja863"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja864')" id="caja864"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja865')" id="caja865"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja866')" id="caja866"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja867')" id="caja867"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja868')" id="caja868"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja869')" id="caja869"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja870')" id="caja870"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja871')" id="caja871"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja872')" id="caja872"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja873')" id="caja873"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja874')" id="caja874"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja875')" id="caja875"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja876')" id="caja876"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja877')" id="caja877"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja878')" id="caja878"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja879')" id="caja879"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja880')" id="caja880"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja881')" id="caja881"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja882')" id="caja882"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja883')" id="caja883"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja884')" id="caja884"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja885')" id="caja885"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja886')" id="caja886"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja887')" id="caja887"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja888')" id="caja888"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja889')" id="caja889"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja890')" id="caja890"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja891')" id="caja891"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja892')" id="caja892"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja893')" id="caja893"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja894')" id="caja894"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja895')" id="caja895"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja896')" id="caja896"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja897')" id="caja897"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja898')" id="caja898"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <!--                linea10-->
                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja899')" id="caja899"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja900')" id="caja900"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja901')" id="caja901"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja902')" id="caja902"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja903')" id="caja903"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja904')" id="caja904"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja905')" id="caja905"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja906')" id="caja906"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja907')" id="caja907"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja908')" id="caja908"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja909')" id="caja909"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja910')" id="caja910"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja911')" id="caja911"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja912')" id="caja912"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja913')" id="caja913"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja914')" id="caja914"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja915')" id="caja915"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja916')" id="caja916"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja917')" id="caja917"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja918')" id="caja918"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja919')" id="caja919"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja920')" id="caja920"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja921')" id="caja921"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja922')" id="caja922"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja923')" id="caja923"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja924')" id="caja924"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja925')" id="caja925"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja926')" id="caja926"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja927')" id="caja927"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja928')" id="caja928"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja929')" id="caja929"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja930')" id="caja930"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja931')" id="caja931"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja932')" id="caja932"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja933')" id="caja933"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja934')" id="caja934"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja935')" id="caja935"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja936')" id="caja936"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja937')" id="caja937"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja938')" id="caja938"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja939')" id="caja939"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja940')" id="caja940"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja941')" id="caja941"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja942')" id="caja942"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja943')" id="caja943"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja944')" id="caja944"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja945')" id="caja945"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja946')" id="caja946"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja947')" id="caja947"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja948')" id="caja948"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja949')" id="caja949"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja950')" id="caja950"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja951')" id="caja951"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja952')" id="caja952"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja953')" id="caja953"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja954')" id="caja954"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja955')" id="caja955"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja956')" id="caja956"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja957')" id="caja957"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja958')" id="caja958"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja959')" id="caja959"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja960')" id="caja960"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja961')" id="caja961"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja963')" id="caja963"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja964')" id="caja964"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja965')" id="caja965"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja966')" id="caja966"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja967')" id="caja967"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja968')" id="caja968"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja969')" id="caja969"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja970')" id="caja970"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja971')" id="caja971"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja972')" id="caja972"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja973')" id="caja973"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja974')" id="caja974"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja975')" id="caja975"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja976')" id="caja976"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja977')" id="caja977"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja978')" id="caja978"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja979')" id="caja979"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja980')" id="caja980"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja981')" id="caja981"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja982')" id="caja982"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja983')" id="caja983"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja984')" id="caja984"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja985')" id="caja985"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja986')" id="caja986"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja987')" id="caja987"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja988')" id="caja988"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja989')" id="caja989"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 grid-rows-2">
                                    <div @mousemove="paint('caja990')" id="caja990"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja991')" id="caja991"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja992')" id="caja992"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja993')" id="caja993"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja994')" id="caja994"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja995')" id="caja995"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja996')" id="caja996"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja997')" id="caja997"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                    <div @mousemove="paint('caja998')" id="caja998"
                                         class=" select-none p-2 hover:bg-blue-700">
                                        {{ null }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ml-5 bg-red-400 border-4 border-red-600 rounded-md flex justify-center items-center ">
                        <div class=" bg-gray-200 rounded p-2 border-gray-600 border-4">
                            <div id="muestra" class="border-2 border-black p-10 m-2 bg-white col-span-2"></div>
                            <div class="grid grid-cols-2 gap-5 flex">
                                <div class=" col-span-2 mx-1 flex justify-center">
                                    <div class="bg-pink-200 rounded-md px-2 flex">
                                        <ArrowDownIcon class="w-5"/>
                                        <div class="font-bold">PALETA DE COLORES</div>
                                        <ArrowDownIcon class="w-5"/>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <button @click="selectColor('blue-600')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                             viewBox="0 0 24 24"
                                             fill="#2563eb">
                                            <path
                                                d="M7.127 22.562l-7.127 1.438 1.438-7.128 5.689 5.69zm1.414-1.414l11.228-11.225-5.69-5.692-11.227 11.227 5.689 5.69zm9.768-21.148l-2.816 2.817 5.691 5.691 2.816-2.819-5.691-5.689z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex justify-center">
                                    <button @click="selectColor('yellow-400')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                             viewBox="0 0 24 24"
                                             fill="#facc15">
                                            <path
                                                d="M7.127 22.562l-7.127 1.438 1.438-7.128 5.689 5.69zm1.414-1.414l11.228-11.225-5.69-5.692-11.227 11.227 5.689 5.69zm9.768-21.148l-2.816 2.817 5.691 5.691 2.816-2.819-5.691-5.689z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex justify-center">
                                    <button @click="selectColor('stone-700')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                             viewBox="0 0 24 24"
                                             fill="#064e3b">
                                            <path
                                                d="M7.127 22.562l-7.127 1.438 1.438-7.128 5.689 5.69zm1.414-1.414l11.228-11.225-5.69-5.692-11.227 11.227 5.689 5.69zm9.768-21.148l-2.816 2.817 5.691 5.691 2.816-2.819-5.691-5.689z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex justify-center">
                                    <button @click="selectColor('green-600')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                             viewBox="0 0 24 24"
                                             fill="#16a34a">
                                            <path
                                                d="M7.127 22.562l-7.127 1.438 1.438-7.128 5.689 5.69zm1.414-1.414l11.228-11.225-5.69-5.692-11.227 11.227 5.689 5.69zm9.768-21.148l-2.816 2.817 5.691 5.691 2.816-2.819-5.691-5.689z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="col-span-2 flex justify-center">
                                    <button @click="selectColor()">
                                        <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 24 24"
                                             fill-rule="evenodd"
                                             clip-rule="evenodd">
                                            <path
                                                d="M5.662 23l-5.369-5.365c-.195-.195-.293-.45-.293-.707 0-.256.098-.512.293-.707l14.929-14.928c.195-.194.451-.293.707-.293.255 0 .512.099.707.293l7.071 7.073c.196.195.293.451.293.708 0 .256-.097.511-.293.707l-11.216 11.219h5.514v2h-12.343zm3.657-2l-5.486-5.486-1.419 1.414 4.076 4.072h2.829zm.456-11.429l-4.528 4.528 5.658 5.659 4.527-4.53-5.657-5.657z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2">
                    <div class="px-5 pt-2 flex">
                        <div>
                            <a :href="props.route_back">
                                <button
                                    class="bg-red-300 px-2 py-1 rounded-md border-red-800 border-2 flex items-center hover:text-white hover:bg-gray-700 hover:scale-90 duration-300">
                                    <HomeIcon class="h-7 w-7"></HomeIcon>
                                    <span class="font-bold">&nbspVolver</span>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="px-5 pt-2 flex justify-end">
                        <div>
                            <a :href="props.route_next">
                                <button
                                    class="bg-red-300 px-2 py-1 rounded-md border-red-800 border-2 flex items-center hover:text-white hover:bg-gray-700 hover:scale-90 duration-300">
                                    <span class="font-bold">&nbspSiguiente</span>
                                    <ChevronRightIcon class="h-7 w-7"></ChevronRightIcon>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
