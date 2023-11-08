import './bootstrap';
import {createApp} from "vue/dist/vue.esm-bundler.js";
import MyComponent from "./components/MyComponent.vue";
import BasicActivity from "./components/templates/BasicActivity.vue"

createApp({
    components: {
        'my-component': MyComponent,
        'basic-activity': BasicActivity,
    }
}).mount("#app");
