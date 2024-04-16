<script setup>
    import TemplateDrawActivity from './TemplateDrawActivity.vue';
    import TemplateDrawActivityFree from './TemplateDrawActivityFree.vue';

    let activityType = "normal";






    //Importacion de imagen ejemplo
    import exampleImage from '../../../../../public/images/draw-image/cat.png';
    import drawImage from '../../../../../public/images/draw-image/draw-image.png';


    const drawActivity1 = {
        colorPalette: ['rgb(136, 149, 162)', 'rgb(225, 115, 140)'],
        exampleImage: exampleImage,
        canvas: [ 62, 38,],
        colorParts: ['rgb(136, 149, 162)', 'rgb(225, 115, 140)'],
        correctPercentage: [0.21, 0.40],
        drawImage: drawImage
    };

    import drawImageFree from '../../../../../public/images/draw-image/draw-image-free.png';

    const drawActivityFree1 = {
        colorPalette: ['rgb(0, 255, 10)', 'rgb(0, 10, 253)', 'rgb(255, 245, 0)'],
        drawImage: drawImageFree,
        correctPercentage: [0.70],
    };

</script>

<template>
    <TemplateDrawActivity :drawActivity="drawActivity1" v-if="activityType === 'normal'"/>
    <TemplateDrawActivityFree :drawActivity="drawActivityFree1" v-else/>
</template>

<style scoped>

</style>