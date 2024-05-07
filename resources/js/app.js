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
import SelectLevel from "./components/templates/SelectLevel.vue"

import '@fontsource/press-start-2p';
import '@fontsource/bangers';
import '@fontsource/luckiest-guy';
import '@fontsource/julius-sans-one';



import TestPermutations from "./components/activities/TestPermutations.vue"
import TestNaraket from "./components/activities/TestNaraket.vue"

import MenuTest from "./components/templates/Menu/Menu.vue";
import StoreMain from "./components/templates/Store/Store.vue";
import CoinChanger from "./components/activities/Coin Changer/CoinChangerMain.vue";
import TemplateDrawActivity from "./components/activities/DrawActivity/TemplateDrawActivity.vue";
import TemplateDrawActivityFree from "./components/activities/DrawActivity/TemplateDrawActivityFree.vue";
import HomeAccess from "./components/templates/HomeView/HomeAccess.vue";



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
        'home-view': HomeView,
        'select-level': SelectLevel,

        'test-permutations': TestPermutations,
        'test-naraket': TestNaraket,

        'menu-test': MenuTest,
        'store-main': StoreMain,
        'coin-changer': CoinChanger,
        'draw-activity': TemplateDrawActivity,
        'draw-activity-free':TemplateDrawActivityFree,
        'home-access': HomeAccess

    }
}).mount("#app");
