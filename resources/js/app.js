import './bootstrap';
import {createApp} from "vue/dist/vue.esm-bundler.js";
import MyComponent from "./components/MyComponent.vue";
import BasicActivity from "./components/templates/BasicActivity.vue"
import InteractiveSudoku from "./components/activities/InteractiveSudoku.vue"

createApp({
    components: {
        'my-component': MyComponent,
        'basic-activity': BasicActivity,
        'interactive-sudoku': InteractiveSudoku,
    }
}).mount("#app");
