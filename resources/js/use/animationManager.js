import {
    verifyFileExistence,
    playAudio,
    resolveAudio,
    setOnEnded,
    talkCharacter,
    localHost,
    types
} from './';

export const showItemsPresentation = (items, callback, fakeItems, onEndedAudio) => {

    let box = document.getElementById('itemPresentation')

    box.classList.remove('hidden')

    let currentBgClass = 'bg-gray-200';

    let i = 0;
    let countAudiosPlayed = 0;

    let jumpIterations = 0;

    const hasEraser = items.some(item => item.type === types.eraser);

    // Si hay un item de tipo 'eraser', no ejecutar la función
    if (hasEraser) {
        console.log('Hay un item de tipo eraser, no se ejecutará la función')
        jumpIterations++;
    }

    const playNextAudio = () => {
        // Ejecuta una itereacion por cada item
        if (i < items.length) {

            if (fakeItems) {
                jumpIterations = fakeItems.length;
            }
            if (fakeItems && fakeItems.includes(i)) {

                i++;
                playNextAudio();
                return;
            }

            if (items[i].type === types.eraser) {
                i++;
                playNextAudio();
                return;
            }

            let audio = null;

            countAudiosPlayed++;

            console.log(countAudiosPlayed)

            if (countAudiosPlayed === (items.length - jumpIterations)) {

                console.log('Ultimo item');

                console.log(countAudiosPlayed, 'ESTS ES EL COUNT AUDIO PLAYED')
                let item = items[i];
                if (countAudiosPlayed === 1) {
                    verifyFileExistence(`${localHost}/audios/items/theType/${item.name}.m4a`, function (exist) {
                        if (exist) {
                            console.log(`Ultimo item con Audio`);
                        } else {
                            console.log(item)
                            if (item.type === types.color) {
                                resolveAudio(`el color ${item.name}`, `${item.name}`, 'items/theType', '0.9');
                            } else if (item.type === types.letter) {
                                resolveAudio(`la letra ${item.name}`, `${item.name}`, 'items/theType', '0.9');
                            } else if (item.type === types.number) {
                                resolveAudio(`el número ${item.name}`, `${item.name}`, 'items/theType', '0.9');
                            }
                        }
                    });

                    audio = playAudio(`${localHost}/audios/items/theType/${items[i].name}.m4a`);
                } else {
                    verifyFileExistence(`${localHost}/audios/items/and/${item.name}.m4a`, function (exist) {
                        if (exist) {
                            console.log(`Ultimo item con Audio`);
                        } else {
                            console.log(item)
                            resolveAudio(`y ${item.name}`, `${item.name}`, 'items/and', '0.9');
                        }
                    });

                    audio = playAudio(`${localHost}/audios/items/and/${items[i].name}.m4a`);
                }

            } else {
                audio = playAudio(`${localHost}/audios/items/${items[i].name}.m4a`);
            }
            setOnEnded(audio, playNextAudio);
            const cleanBox = () => {
                let imgExt = box.getElementsByTagName('img')[0];

                if (imgExt) {
                    box.removeChild(imgExt);
                }

                box.innerText = null;
                box.classList.replace(currentBgClass, 'bg-gray-200');
                currentBgClass = 'bg-gray-200';
            }

            if (items[i].type === types.color) {
                cleanBox();
                box.classList.replace(currentBgClass, items[i].content);
                currentBgClass = items[i].content;
            } else if (items[i].type === types.image) {
                cleanBox();
                box.classList.replace(currentBgClass, 'bg-gray-200');
                currentBgClass = 'bg-gray-200';

                let img = document.createElement('img');
                img.src = items[i].content;
                img.alt = items[i].name;

                box.appendChild(img);
            } else if (items[i].type === types.letter || items[i].type === types.number) {
                cleanBox();

                box.innerText = items[i].name;
            } else if (items[i].type === types.eraser) {
                box.classList.add('hidden')
            }

            i++;
        } else {
            //Fin de la presentacion de items

            if (onEndedAudio) {
                let audio3 = playAudio(onEndedAudio);
                box.classList.add('hidden')
                setOnEnded(audio3, () => {
                    talkCharacter(`${localHost}/images/characters/robot/normal.png`, `${localHost}/images/characters/robot/talk.gif`)

                    if (callback) {
                        callback();

                    }
                });
            }
        }

    }
    playNextAudio();
}

export const getIcon = () => {
    return JSON.parse(localStorage.getItem('icon'))
}

export const icon = (bool) => {
    localStorage.setItem('icon', JSON.stringify(bool))
}

export const showCheckIcon = () => {
    if (getIcon()) {
        return;
    }
    icon(true);
    let iconCheck = document.getElementById('icon-check')

    iconCheck.classList.replace('opacity-0', 'opacity-100')

    setTimeout(() => {
        iconCheck.classList.replace('opacity-100', 'opacity-0')
        icon(false);
    }, 1000)
}

export const showErrorIcon = () => {
    if (getIcon()) {
        return;
    }
    icon(true);
    let iconCheck = document.getElementById('icon-error')

    iconCheck.classList.replace('opacity-0', 'opacity-100')

    setTimeout(() => {
        icon(false);
        iconCheck.classList.replace('opacity-100', 'opacity-0')
    }, 1000)
}