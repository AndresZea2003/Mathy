import { rewardLevelsCoin } from "./rewardCoin"

export const types = {
    letter: 'LETTER',
    image: 'IMAGE',
    number: 'NUMBER',
    color: 'COLOR',
    figure: 'FIGURE',
    eraser: 'ERASER'
}

export const sizes = {
    small: 'SMALL',
    normal: 'NORMAL',
    big: 'BIG'
}

export const localHost = window.location.origin

export const getSelectItem = () => {
    return JSON.parse(localStorage.getItem('itemSelected'))
}

export const getTalk = () => {
    return JSON.parse(localStorage.getItem('talk'))
}

export const talk = (bool) => {
    localStorage.setItem('talk', JSON.stringify(bool))
}

export const talkCharacter = (stopImg, talkImg) => {

    let talking = getTalk()
    let character = document.getElementById('character')

    if (talking === false) {

        character.src = talkImg
        talk(true)
    } else {
        character.src = stopImg
        talk(false)
    }
}

const removeAllBg = (id, items) => {
    for (let i = 0; i < items.length; i++) {
        const item = items[i];
        document.getElementById(id).classList.remove(item.content)
    }
}

export const paintItem = (id, items, rotate) => {

    let itemSelected = getSelectItem()

    if (itemSelected.type === types.eraser) {
        removeAllBg(id, items)
        document.getElementById(id).classList.add('bg-white')
        document.getElementById(id).innerText = null
    }

    if (itemSelected.type === types.letter || itemSelected.type === types.number) {
        for (let i = 0; i < items.length; i++) {
            const item = items[i];
            document.getElementById(id).classList.remove(item.content)
        }
        document.getElementById(id).classList.add('bg-white');

        //Comprobamos si el contenido se rota para crear las etiquetas p y rotar los numeros o letras
        if(!rotate){
            document.getElementById(id).innerText = itemSelected.name;
        }else if(rotate){
            //Comprobamos si el elemento ya existe
            let existingElement = document.getElementById(id).querySelector("p");

            //Si el elemento existe solo reemplazamos el contenido dentro
            if(existingElement){
                existingElement.innerText = itemSelected.name;
            }else if(!existingElement){

                //Creamos un elemento p
                let newElement = document.createElement("p");
                //Añadimos el contenido dentro
                newElement.innerText = itemSelected.name;
                //Añadimos la etiqueta con el contenido dentro del div.
                document.getElementById(id).appendChild(newElement);
                //Añadimos el estilo de rotación para girar la letra o numero.
                newElement.style.transform = "rotate(-45deg)";
            };
        };
    } else if (itemSelected.type === types.color) {
        for (let i = 0; i < items.length; i++) {
            const item = items[i];
            document.getElementById(id).classList.remove(item.content)
        }
        document.getElementById(id).classList.remove('bg-white')
        document.getElementById(id).classList.add(itemSelected.content)
        document.getElementById(id).innerText = null
    } else if (itemSelected.type === types.image) {
        for (let i = 0; i < items.length; i++) {
            const item = items[i];
            document.getElementById(id).classList.remove(item.content)
        }
        document.getElementById(id).classList.add('bg-white')
        document.getElementById(id).innerText = null

        let box = document.getElementById(id);

        let imgExisting = box.querySelector('img');

        if (!imgExisting) {
            let imgExisting = document.createElement('img');

            imgExisting.src = itemSelected.content;

            //Se añade este codigo para en caso de tener el atributo rotate en el componente vamos a rotar las imagenes para que queden derechas.
            if (rotate) {
                imgExisting.style.transform = "rotate(-45deg)";
            } else {
                imgExisting.style.transform = "";
            }

            if (itemSelected.size === sizes.small) {
                imgExisting.width = 50;
            } else if (itemSelected.size === sizes.normal) {
                imgExisting.width = 100;
            }

            box.appendChild(imgExisting);
        }

    }
}

export const errorPaint = (id) => {
    let box = document.getElementById(id)
    box.classList.add('duration-300')
    box.classList.add('opacity-25')
    box.classList.add('brush-fail')
    setTimeout(function () {
        box.classList.remove('opacity-25')
        box.classList.remove('brush-fail')
    }, 500)
}

export const cleanBox = (box, items) => {
  let imgExt = box.getElementsByTagName('img')[0];

  if (imgExt) {
    box.removeChild(imgExt);
  }

  box.innerText = null;
  for (let i = 0; i < items.length; i++) {
    const item = items[i];
    box.classList.remove(item.content)
  }
}

export const getCoins = () => {
    return JSON.parse(localStorage.getItem('coins'))
}

export const updateCoins = (addCoin) => {
    let coins = getCoins()

    localStorage.setItem('coins', coins + addCoin)

    return coins + addCoin
}


//Creacion de variables en el local storage
localStorage.setItem("unlockedLevels", [1]);

//Naves desbloqueadas en la store al principio de la partida
export const unlockedShips = [1, 2, 3, 4, 5];


//Se crea la variable en el localStorage sobre la nave elegida en caso de no existir se crea y selecciona la numero 1 si ya existe la variable en el localstorage se ignora.
if(!localStorage.getItem("shipSelected")){
    localStorage.setItem("shipSelected", 1);
}


//Logica de variables de cada moneda en el local storage.
if(!localStorage.getItem("goldCoins")){
    localStorage.setItem("goldCoins", 1);
}

if(!localStorage.getItem("silverCoins")){
    localStorage.setItem("silverCoins", 1);
}

if(!localStorage.getItem("bronzeCoins")){
    localStorage.setItem("bronzeCoins", 1);
}

//Logica de guardado de niveles
export const saveCurrentLevel = (level, sublevel) => {
    //Extraemos los datos del storage
    let localStorageDataGames = JSON.parse(localStorage.getItem('games'));
    let localStorageDataGamer = localStorage.getItem('gamer');

    let indiceGamer;

        //Localizamos el usuario
        if(localStorageDataGames){
            for (let i = 0; i < localStorageDataGames.length; i++) {
                if(localStorageDataGamer === localStorageDataGames[i].name){
                    indiceGamer = i;
                }
            }
        
            //Actualizamos los datos del usuarios
            localStorageDataGames[indiceGamer].currentLevel.level = level;
            localStorageDataGames[indiceGamer].currentLevel.sublevel = sublevel;
        
            //Los subimos al storage
            localStorage.setItem('games', JSON.stringify(localStorageDataGames));
        };
};

//Funcion que trae los datos del usuario para utilizar en los componentes. para llamar solo getUsersLocalStorage().name por ejmeplo.
export const getUsersLocalStorage = () => {
        //Extraemos los datos del storage
        let localStorageDataGames = JSON.parse(localStorage.getItem('games'));
        let localStorageDataGamer = localStorage.getItem('gamer');

        let indiceGamer;

        //Localizamos el usuario
        for (let i = 0; i < localStorageDataGames.length; i++) {
            if(localStorageDataGamer === localStorageDataGames[i].name){
                indiceGamer = i;
            }
        }

        return localStorageDataGames[indiceGamer]
};

//Funcion que guarda los datos modificados del usuario
//USO: al usar getUsersLocalStorage() se debe guardar en una variable esos datos traidos del usuario, despues se modifican EJEMPLO dataUser.bronzeCoins = 3, para guardar los datos de usuario con esa modificacion simplemnte llamamos la funcion saveDataLocalStorage y como parametro le pasamos los datos modificados por EJEMPLO. saveDataLocalStorage(dataUser);
export const saveDataLocalStorage = (data) => {//Desde el componente modificamos los datos del usuario y los devolvemos modificados en la funcion y la funcion se encarga de actualizar las partidas guardadas.
    let localStorageDataGamer = localStorage.getItem('gamer');
    let localStorageDataGames = JSON.parse(localStorage.getItem('games'));

    let indiceGamer;

    //Localizamos el usuario
    for (let i = 0; i < localStorageDataGames.length; i++) {
        if(localStorageDataGamer === localStorageDataGames[i].name){
            indiceGamer = i;
        }
    }

    localStorageDataGames[indiceGamer] = data;

    localStorage.setItem('games', JSON.stringify(localStorageDataGames));
};



//Funcion que comprueba si el nivel da alguna coin
export const winCoinCheckLevel = (level, sublevel) => {
    let result = false;



    for (let i = 0; i < rewardLevelsCoin.length; i++) {
        if( level === rewardLevelsCoin[i].level && sublevel === rewardLevelsCoin[i].subLevel){
            result = rewardLevelsCoin[i].typeCoin;
        };
    };

    console.log("wincoin", result);
    return result;
};


//Funcion que controla las monedas que se muestran en las secciones de los items
export const storageCoinUpdated = (goldCoins, silverCoins, bronzeCoins, goldCoinsChangeActive, silverCoinsChangeActive, bronzeCoinsChangeActive) => {
    console.log("ejecutando coinsss");
    //Valido si las monedas de oro son 5 o mas de 5 en caso de ser mas de 5 va a devolver solo 5 y si es menos devolvera la cantidad que se tiene
    let goldCoinsStorage = getUsersLocalStorage().goldenCoins;
    let silverCoinsStorage = getUsersLocalStorage().silverCoins;
    let bronzeCoinsStorage = getUsersLocalStorage().bronzeCoins;


    if (parseInt(goldCoinsStorage) >= 5) {
        goldCoins.value = 5;
    } else if (parseInt(goldCoinsStorage) < 5) {
        goldCoins.value = parseInt(goldCoinsStorage);
    }

    if (parseInt(silverCoinsStorage) >= 5) {
        silverCoins.value = 5;
    } else if (parseInt(silverCoinsStorage) < 5) {
        silverCoins.value = parseInt(silverCoinsStorage);
    }

    if (parseInt(bronzeCoinsStorage) >= 5) {
        bronzeCoins.value = 5;
    } else if (parseInt(bronzeCoinsStorage) < 5) {
        bronzeCoins.value = parseInt(bronzeCoinsStorage);
    }

    //Controlamos si hay monedas suficientes para cambiar para darle efecto al boton de cambiar segun las monedas.
    if (parseInt(goldCoinsStorage) > 0) {
        goldCoinsChangeActive.value = "item-palette-gold__div--container-active";
    } else if (parseInt(goldCoinsStorage) === 0) {
        goldCoinsChangeActive.value = "";
    }
    ;

    if (parseInt(silverCoinsStorage) > 2) {
        silverCoinsChangeActive.value = "item-palette-gold__div--container-active";
    } else if (parseInt(silverCoinsStorage) < 3) {
        silverCoinsChangeActive.value = "";
    }
    ;

    if (parseInt(bronzeCoinsStorage) > 2) {
        bronzeCoinsChangeActive.value = "item-palette-gold__div--container-active";
    } else if (parseInt(bronzeCoinsStorage) < 3) {
        bronzeCoinsChangeActive.value = "";
    };
};

//Funcion que traslada al siguiente nivel tomando el nivel actual guradado en el local storage y trasladando al siguiente
export const nextLevel = () => {
    let linkActualLevel = localStorage.getItem("currentLocation");

    let lastCharacter = linkActualLevel.slice(-1);

    let lastCharacterNewLevel = parseInt(lastCharacter) + 1;

    let linkNewLevel = linkActualLevel.slice(0, -1) + lastCharacterNewLevel;

    window.location = linkNewLevel;
};