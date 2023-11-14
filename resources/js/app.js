import './bootstrap';
import {createApp} from "vue/dist/vue.esm-bundler.js";
import MyComponent from "./components/MyComponent.vue";
import BasicActivity from "./components/templates/BasicActivity.vue"
import SelectActivity from "./components/templates/SelectActivity.vue"
import InteractiveSudoku from "./components/activities/InteractiveSudoku.vue"
import PaintPattern from "./components/activities/PaintPattern.vue"
import LinePaintPattern from "./components/activities/LinePaintPattern.vue"

createApp({
    components: {
        'my-component': MyComponent,
        'basic-activity': BasicActivity,
        'interactive-sudoku': InteractiveSudoku,
        'line-paint-pattern': LinePaintPattern,
        'select-activity': SelectActivity
    }
}).mount("#app");
