<script setup>

//Librerias
import { getUsersLocalStorage } from "../../use"

//Imagenes
import IconGoldCoin from "../../../../public/images/globals/gold-coin.png";
import IconSilverCoin from "../../../../public/images/globals/silver-coin.png";
import IconBronzeCoin from "../../../../public/images/globals/bronze-coin.png";
import IconChanger from "../../../../public/images/globals/icon-change.png";


//Props
const props = defineProps({
    goldCoins: Number,
    silverCoins: Number,
    bronzeCoins: Number,

    goldCoinsChangeActive: String,
    silverCoinsChangeActive: String,
    bronzeCoinsChangeActive: String,

    openAnimation: Function,
    closeAnimation: Function,
    storeAccess: Function,
    openCoinChanger: Function
});

</script>

<template>
    <div>
        <div class="my-1">
            <div v-if="goldCoins < 1 || getUsersLocalStorage().coinChangerAuto === true" class="lg:w-32 xl:w-40 2xl:w-52 h-10 absolute z-20"></div>
            <div :class="`item-palette-gold__div--container ${goldCoinsChangeActive} lg:w-32 xl:w-40 2xl:w-52 h-10 bg-blue-950 rounded-3xl flex justify-center items-center border-2 border-cyan-400 hover:bg-yellow-400 hover:scale-95 hover:border-violet-50 cursor-pointer duration-300`"
                @mouseenter="openAnimation('store')" @mouseleave="closeAnimation()" @click="storeAccess()">
                <img class="item-palette-gold__img--gold-coin w-10 duration-300 ease-in-out" v-for="index in goldCoins"
                    :key="index" :src="IconGoldCoin" alt="golden-coin"/>
                <img class="item-palette__img--changer-icon w-0 absolute duration-300" :src="IconChanger"
                    alt="changer"/>
            </div>
        </div>

        <div class="my-1">
            <div v-if="silverCoins < 3 || getUsersLocalStorage().coinChangerAuto === true" class="lg:w-32 xl:w-40 2xl:w-52 h-10 absolute z-20"></div>
            <div :class="`item-palette-silver__div--container ${silverCoinsChangeActive} lg:w-32 xl:w-40 2xl:w-52 h-10 bg-blue-950 rounded-3xl flex justify-center items-center border-2 border-cyan-400 hover:bg-gray-400 hover:scale-95 hover:border-violet-50 cursor-pointer duration-300`"
                @mouseenter="openAnimation('changer')" @mouseleave="closeAnimation()" @click="openCoinChanger()">
                <img class="item-palette-silver__img--silver-coin w-10 duration-300 ease-in-out"
                    v-for="index in silverCoins" :key="index" :src="IconSilverCoin" alt="silver-coin"/>
                <img class="item-palette__img--changer-icon w-0 absolute duration-300" :src="IconChanger"
                        alt="changer"/>
            </div>
        </div>

        <div class="my-1">
            <div v-if="bronzeCoins < 3 || getUsersLocalStorage().coinChangerAuto === true" class="lg:w-32 xl:w-40 2xl:w-52 h-10 absolute z-20"></div>
            <div :class="`item-palette-bronze__div--container ${bronzeCoinsChangeActive} lg:w-32 xl:w-40 2xl:w-52 h-10 bg-blue-950 rounded-3xl flex justify-center items-center border-2 border-cyan-400 hover:bg-amber-700 hover:scale-95 hover:border-violet-50 cursor-pointer duration-300`"
                @mouseenter="openAnimation('changer')" @mouseleave="closeAnimation()" @click="openCoinChanger()">
                <img class="item-palette-bronze__img--bronze-coin w-10 duration-300 ease-in-out"
                    v-for="index in bronzeCoins" :key="index" :src="IconBronzeCoin" alt="bronze-coin"/>
                <img class="item-palette__img--changer-icon w-0 absolute duration-300" :src="IconChanger"
                    alt="changer"/>
            </div>
        </div>
    </div>
</template>

<style scoped>

.item-palette-gold__div--container {
    -webkit-box-shadow: inset 0px 0px 20px -1px rgba(233, 245, 0, 1);
    -moz-box-shadow: inset 0px 0px 20px -1px rgba(233, 245, 0, 1);
    box-shadow: inset 0px 0px 20px -1px rgba(233, 245, 0, 1);
}


.item-palette-gold__div--container:hover .item-palette-gold__img--gold-coin {
    width: 0px;
}

.item-palette-gold__div--container:hover .item-palette__img--changer-icon {
    width: 40px;
}

.item-palette-gold__div--container-active {
    animation: changerActive 2s infinite;
}

@keyframes changerActive {
    0% {
        -webkit-box-shadow: 0px 0px 9px -21px rgb(255, 255, 255);
        -moz-box-shadow: 0px 0px 9px -21px rgb(255, 255, 255);
        box-shadow: 0px 0px 9px -21px rgb(255, 255, 255);
    }

    50% {
        -webkit-box-shadow: 0px 0px 20px -3px rgba(255, 255, 255, 1);
        -moz-box-shadow: 0px 0px 20px -3px rgba(255, 255, 255, 1);
        box-shadow: 0px 0px 20px -3px rgba(255, 255, 255, 1);
    }

    100% {
        -webkit-box-shadow: 0px 0px 9px -21px rgb(255, 255, 255);
        -moz-box-shadow: 0px 0px 9px -21px rgb(255, 255, 255);
        box-shadow: 0px 0px 9px -21px rgb(255, 255, 255);
    }
}

.item-palette-gold__img--gold-coin {
    filter: drop-shadow(10px 10px 5px rgba(0, 0, 0, 0.5));
}

.item-palette-silver__div--container:hover .item-palette-silver__img--silver-coin {
    width: 0px;
}

.item-palette-silver__div--container:hover .item-palette__img--changer-icon {
    width: 40px;
}

.item-palette-bronze__div--container:hover .item-palette-bronze__img--bronze-coin {
    width: 0px;
}

.item-palette-bronze__div--container:hover .item-palette__img--changer-icon {
    width: 40px;
}


</style>