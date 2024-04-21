//Importacion de las imagenes de las naves.
import ship0 from '../../../public/images/store/standard-ship.png';
// import ship1 from '../img/nave.png';
import ship1 from '../../../public/images/rockets/Cohetes-01.svg';
import ship2 from '../../../public/images/rockets/Cohetes-10.svg';
import ship3 from '../../../public/images/rockets/Cohetes-11.svg';
import ship4 from '../../../public/images/rockets/Cohetes-12.svg';
import ship5 from '../../../public/images/rockets/Cohetes-13.svg';
import ship6 from '../../../public/images/rockets/Cohetes-14.svg';
import ship7 from '../../../public/images/rockets/Cohetes-15.svg';
import ship8 from '../../../public/images/rockets/Cohetes-16.svg';

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
        name: "T-01",//Nombre
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
        name: "T-02",
        id: 2,
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
        name: "T-03",
        id: 3,
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
        name: "T-04",
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
        name: "T-05",
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
        name: "T-06",
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
        name: "T-07",
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
        name: "T-08",
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

export {store_data, standardShip};