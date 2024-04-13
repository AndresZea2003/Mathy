<script setup>
import {
    localHost,
} from '../../use';

let text = '¡Bienvenidos a un mundo de diversión y desafíos!'
let name = 'test'
let path = 'test'
let speed = '0.8'

const resolveAudio = (text, name, path, speed) => {
    axios.post(`${localHost}/loadAudio`, {
        text: text,
        name: name,
        path: path,
        speed: speed,
    }).then(response => {
        console.log(response.data)
    })

}

const playAudio = () => {

  let audio = new Audio(`${localHost}/audios/test/test.m4a`)

  audio.play()
}
</script>
<template>
  <div class="bg-red-400 h-screen flex justify-center items-center">
    <button class="bg-red-800 p-4" @click="resolveAudio(text, name, path, speed)">Crear audio</button>
    <button class="bg-purple-400 p-4" @click="playAudio()">Reproducir audio</button>
  </div>
</template>