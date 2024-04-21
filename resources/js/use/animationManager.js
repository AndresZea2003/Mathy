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

    let jumpIterations = 0;
    const playNextAudio = () => {
        // Ejecuta una itereacion por cada item
        if (i < items.length) {

            if (fakeItems) {
                jumpIterations = fakeItems.length;

                if (fakeItems.includes(i)) {
                    i++;
                    playNextAudio();
                    return;
                }

            }

            let audio = null;

            if (i === (items.length - jumpIterations) - 1) {
                console.log('Ultimo item');

                let item = items[i];
                verifyFileExistence(`${localHost}/audios/items/and/${item.name}.m4a`, function (exist) {
                    if (exist) {
                        console.log(`Ultimo item con Audio`);
                    } else {
                        console.log(item)
                        resolveAudio(`y ${item.name}`, `${item.name}`, 'items/and', '0.9');
                    }
                });

                audio = playAudio(`${localHost}/audios/items/and/${items[i].name}.m4a`);
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
                let audio3 = playAudio(`${localHost}/audios/start/pattern/3.m4a`);
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