//Importacion de las imagenes de las naves.
import ship0 from '../../../public/images/store/standard-ship.png';
// import ship1 from '../img/nave.png';
import ship1 from '../../../public/images/rockets/Cohetes-01.svg';
import ship2 from '../../../public/images/rockets/Cohetes-02.svg';
import ship3 from '../../../public/images/rockets/Cohetes-03.svg';
import ship4 from '../../../public/images/rockets/Cohetes-04.svg';
import ship5 from '../../../public/images/rockets/Cohetes-05.svg';
import ship6 from '../../../public/images/rockets/Cohetes-06.svg';
import ship7 from '../../../public/images/rockets/Cohetes-07.svg';
import ship8 from '../../../public/images/rockets/Cohetes-08.svg';
import ship9 from '../../../public/images/rockets/Cohetes-09.svg';
import ship10 from '../../../public/images/rockets/Cohetes-10.svg';
import ship11 from '../../../public/images/rockets/Cohetes-11.svg';
import ship12 from '../../../public/images/rockets/Cohetes-12.svg';
import ship13 from '../../../public/images/rockets/Cohetes-13.svg';
import ship14 from '../../../public/images/rockets/Cohetes-14.svg';
import ship15 from '../../../public/images/rockets/Cohetes-15.svg';
import ship16 from '../../../public/images/rockets/Cohetes-16.svg';
import ship17 from '../../../public/images/rockets/Cohetes-17.png';
import ship18 from '../../../public/images/rockets/Cohetes-18.png';
import ship19 from '../../../public/images/rockets/Cohetes-19.png';
import ship20 from '../../../public/images/rockets/Cohetes-20.png';
import ship21 from '../../../public/images/rockets/Cohetes-21.png';
import ship22 from '../../../public/images/rockets/Cohetes-22.png';
import ship23 from '../../../public/images/rockets/Cohetes-23.png';
import ship24 from '../../../public/images/rockets/Cohetes-24.png';
import ship25 from '../../../public/images/rockets/Cohetes-25.png';
import ship26 from '../../../public/images/rockets/Cohetes-26.png';
import ship27 from '../../../public/images/rockets/Cohetes-27.png';
import ship28 from '../../../public/images/rockets/Cohetes-28.png';
import ship29 from '../../../public/images/rockets/Cohetes-29.png';
import ship30 from '../../../public/images/rockets/Cohetes-30.png';
import ship31 from '../../../public/images/rockets/Cohetes-31.png';
import ship32 from '../../../public/images/rockets/Cohetes-32.png';

//Importacion de el humo de cada tier
import smoke1 from '../../../public/images/store/smoke-tier-1.png';
import smoke2 from '../../../public/images/store/smoke-tier-2.png';
import smoke3 from '../../../public/images/store/smoke-tier-3.png';
import smoke4 from '../../../public/images/store/smoke-tier-4.png';


//Importación de estrellas de cada tier
import stars1 from '../../../public/images/store/stars-tier-1.png';
import stars2 from '../../../public/images/store/stars-tier-2.png';
import stars3 from '../../../public/images/store/stars-tier-3.png';
import stars4 from '../../../public/images/store/stars-tier-4.png';

//Importación de alipses de cada tier
import elipse1 from '../../../public/images/store/elipse-tier-1.png';
import elipse1g from '../../../public/images/store/elipse-g-tier-1.png';
import elipse2 from '../../../public/images/store/elipse-tier-2.png';
import elipse2g from '../../../public/images/store/elipse-g-tier-2.png';
import elipse3 from '../../../public/images/store/elipse-tier-3.png';
import elipse3g from '../../../public/images/store/elipse-g-tier-3.png';
import elipse4 from '../../../public/images/store/elipse-tier-4.png';
import elipse4g from '../../../public/images/store/elipse-g-tier-4.png';


//Array que contiene los datos de todas las naves que estaran en la tienda, datos principales dato, img, price y sus dos variantes de moneda oro y plata y purchased que indica si esa nave ya se compro o no.

let store_data = [
    {
        name: "Cometín",//Nombre
        id: 1,//id
        img: ship1,//Imagen de la nave
        tier: 1,//Tier de la nave
        smoke: smoke1,//Humo de tarjeta principal
        stars: stars1,//Estrellas de tarjeta principal
        elipse: elipse1,//Elipse de tarjeta giatorio pequeño
        elipseg: elipse1g,//Elipse de tarjeta giratorio grande
        price: 2,//Precio de nave
        purchased: false,//Boleano que indica si la nave fue comprada o no
        unlocked: false//Boleano que indica si la nave esta bloqueada o desbloqueada
    },
    {
        name: "Nova",
        id: 2,
        img: ship3,
        tier: 2,
        smoke: smoke2,
        stars: stars2,
        elipse: elipse2,
        elipseg: elipse2g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Chispa",
        id: 3,
        img: ship2,
        tier: 1,
        smoke: smoke1,
        stars: stars1,
        elipse: elipse1,
        elipseg: elipse1g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Astro",
        id: 4,
        img: ship4,
        tier: 2,
        smoke: smoke2,
        stars: stars2,
        elipse: elipse2,
        elipseg: elipse2g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Láctea",
        id: 5,
        img: ship5,
        tier: 3,
        smoke: smoke3,
        stars: stars3,
        elipse: elipse3,
        elipseg: elipse3g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Nómada",
        id: 6,
        img: ship6,
        tier: 3,
        smoke: smoke3,
        stars: stars3,
        elipse: elipse3,
        elipseg: elipse3g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Express",
        id: 7,
        img: ship7,
        tier: 3,
        smoke: smoke3,
        stars: stars3,
        elipse: elipse3,
        elipseg: elipse3g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 8,
        img: ship8,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 9,
        img: ship9,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 10,
        img: ship10,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 11,
        img: ship11,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 12,
        img: ship12,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 13,
        img: ship13,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 14,
        img: ship14,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 15,
        img: ship15,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 16,
        img: ship16,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 17,
        img: ship17,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 18,
        img: ship18,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 19,
        img: ship19,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 20,
        img: ship20,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 21,
        img: ship21,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 22,
        img: ship22,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 23,
        img: ship23,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 24,
        img: ship24,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 25,
        img: ship25,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 26,
        img: ship26,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 27,
        img: ship27,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 28,
        img: ship28,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 29,
        img: ship29,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 30,
        img: ship30,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 31,
        img: ship31,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Centella",
        id: 32,
        img: ship32,
        tier: 4,
        smoke: smoke4,
        stars: stars4,
        elipse: elipse4,
        elipseg: elipse4g,
        price: 2,
        purchased: false,
        unlocked: false
    }
];

//Nave estandar para cuando no este elegida una nave previamente
const standardShip = {
    name: "standard",
    id: 0,
    img: ship0,
    tier: false,
    smoke: false,
    stars: false,
    elipse: false,
    elipseg: false,
    price: false,
    purchased: false,
    unlocked: false
}

//Naves iniciales
const initialRockets = [
    {
        name: "Cometín",//Nombre
        id: 1,//id
        img: ship1,//Imagen de la nave
        tier: 1,//Tier de la nave
        smoke: smoke1,//Humo de tarjeta principal
        stars: stars1,//Estrellas de tarjeta principal
        elipse: elipse1,//Elipse de tarjeta giatorio pequeño
        elipseg: elipse1g,//Elipse de tarjeta giratorio grande
        price: 2,//Precio de nave
        purchased: false,//Boleano que indica si la nave fue comprada o no
        unlocked: false//Boleano que indica si la nave esta bloqueada o desbloqueada
    },
    {
        name: "Nova",
        id: 2,
        img: ship3,
        tier: 2,
        smoke: smoke2,
        stars: stars2,
        elipse: elipse2,
        elipseg: elipse2g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Chispa",
        id: 3,
        img: ship2,
        tier: 1,
        smoke: smoke1,
        stars: stars1,
        elipse: elipse1,
        elipseg: elipse1g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Astro",
        id: 4,
        img: ship4,
        tier: 2,
        smoke: smoke2,
        stars: stars2,
        elipse: elipse2,
        elipseg: elipse2g,
        price: 2,
        purchased: false,
        unlocked: false
    },
    {
        name: "Láctea",
        id: 5,
        img: ship5,
        tier: 3,
        smoke: smoke3,
        stars: stars3,
        elipse: elipse3,
        elipseg: elipse3g,
        price: 2,
        purchased: false,
        unlocked: false
    },
];


export {store_data, standardShip, initialRockets};