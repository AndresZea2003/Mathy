export const types = {
    letter: 'LETTER',
    image: 'IMAGE',
    number: 'NUMBER',
    color: 'COLOR',
    figure: 'FIGURE',
    eraser: 'ERASER'
}

export const localHost = window.location.origin

export const getSelectItem = () => {
    return JSON.parse(localStorage.getItem('itemSelected'))
}
