import './bootstrap';
import {createApp} from "vue/dist/vue.esm-bundler.js";
import MyComponent from "./components/MyComponent.vue";
import BasicActivity from "./components/templates/BasicActivity.vue"
import SelectActivity from "./components/templates/SelectActivity.vue"
import InteractiveSudoku from "./components/activities/InteractiveSudoku.vue"
import PaintPattern from "./components/activities/PaintPattern.vue"
import LinePaintPattern from "./components/activities/LinePaintPattern.vue"
import PaintPermutations from "./components/activities/PaintPermutations.vue"
import PaintLadder from "./components/activities/PaintLadder.vue"
import PixelArt from "./components/activities/PixelArt.vue"
import HomeView from "./components/templates/HomeView.vue"

createApp({
    components: {
        'my-component': MyComponent,
        'basic-activity': BasicActivity,
        'interactive-sudoku': InteractiveSudoku,
        'paint-pattern': PaintPattern,
        'line-paint-pattern': LinePaintPattern,
        'select-activity': SelectActivity,
        'paint-permutations': PaintPermutations,
        'paint-ladder': PaintLadder,
        'pixel-art': PixelArt,
        'home-view': HomeView
    }
}).mount("#app");
