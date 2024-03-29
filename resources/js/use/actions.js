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

export const paintItem = (id, items) => {

    let itemSelected = getSelectItem()

    if (itemSelected.type === types.eraser) {
        removeAllBg()
        document.getElementById(id).classList.add('bg-white')
        document.getElementById(id).innerText = null
    }

    if (itemSelected.type === types.letter || itemSelected.type === types.number) {
        for (let i = 0; i < items.length; i++) {
            const item = items[i];
            document.getElementById(id).classList.remove(item.content)
        }
        document.getElementById(id).classList.add('bg-white')
        document.getElementById(id).innerText = itemSelected.name;
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

            if (itemSelected.size === sizes.small) {
                imgExisting.width = 50;
            } else if (itemSelected.size === sizes.normal) {
                imgExisting.width = 100;
            }

            box.appendChild(imgExisting);
        }

    }


    const removeAllBg = () => {
        for (let i = 0; i < items.length; i++) {
            const item = items[i];
            document.getElementById(id).classList.remove(item.content)
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

export const getCoins = () => {
    return JSON.parse(localStorage.getItem('coins'))
}

export const updateCoins = (addCoin) => {
    let coins = getCoins()

    localStorage.setItem('coins', coins + addCoin)

    return coins + addCoin
}