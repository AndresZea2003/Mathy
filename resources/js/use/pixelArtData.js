// function generateRow(rowNumber, color, startColumn, endColumn) {
//     const row = [];
//     for (let i = startColumn; i <= endColumn; i++) {
//         row.push({x: i, y: rowNumber + 1, color: color});
//     }
//     return row;
// }
//
// function generateColumn(columnNumber, color, startRow, endRow) {
//     const column = [];
//     for (let i = startRow; i <= endRow; i++) {
//         column.push({x: columnNumber, y: i + 1, color: color});
//     }
//     return column;
// }
//
// export const instruccionesTest = [
//     ...generateRow(0, 'gray', 1, 20),
//     ...generateRow(1, 'gray', 1, 20),
//     ...generateRow(2, 'gray', 1, 20),
//     ...generateRow(3, 'gray', 1, 20),
//     ...generateRow(4, 'gray', 1, 20),
//     ...generateRow(5, 'gray', 1, 20),
//     ...generateRow(6, 'gray', 1, 20),
//     ...generateRow(7, 'gray', 1, 20),
//     ...generateRow(8, 'gray', 1, 20),
//     ...generateRow(9, 'gray', 1, 20),
//     ...generateRow(10, 'gray', 1, 20),
//     ...generateRow(11, 'gray', 1, 20),
//     ...generateRow(12, 'gray', 1, 20),
//     ...generateRow(13, 'gray', 1, 20),
//
//     ...generateRow(1, 'black', 4, 4),
//     // ...generateRow(2, 'gray', 4, 6),
//     // ...generateRow(3, 'gray', 4, 6),
//     // ... more rows
//     ...generateColumn(20, 'black'),
//     // ... more columns
// ];
//
// const cat = () => {
//
// };
//
// export const instrucciones = [
//     ...generateRow(1, 'gray', 5),
//     ...generateRow(2, 'gray', 5),
//     ...generateRow(3, 'red', 5),
//     // ... more rows
//     ...generateColumn(20, 'black', 0, 3),
//     ...generateColumn(1, 'black'),
//     // ... more columns
// ];

export const instruccionesTest = [
    // Fila 1
    {x: 1 + 4, y: 1 + 1, color: 'gray'}, // 1
    {x: 2 + 4, y: 1 + 1, color: 'gray'}, // 2
    {x: 3 + 4, y: 1 + 1, color: 'gray'}, // 3
    {x: 4 + 4, y: 1 + 1, color: 'gray'}, // 4
    {x: 5 + 4, y: 1 + 1, color: 'gray'}, // 5
    {x: 6 + 4, y: 1 + 1, color: 'gray'}, // 6
    {x: 7 + 4, y: 1 + 1, color: 'gray'}, // 7
    {x: 8 + 4, y: 1 + 1, color: 'gray'}, // 8
    {x: 9 + 4, y: 1 + 1, color: 'gray'}, // 9
    {x: 10 + 4, y: 1 + 1, color: 'gray'}, // 10
    {x: 11 + 4, y: 1 + 1, color: 'gray'}, // 11

    // Fila 2
    {x: 1 + 4, y: 2 + 1, color: 'gray'}, // 1
    {x: 2 + 4, y: 2 + 1, color: '#27272a'}, // 2
    {x: 3 + 4, y: 2 + 1, color: 'gray'}, // 3
    {x: 4 + 4, y: 2 + 1, color: 'gray'}, // 4
    {x: 5 + 4, y: 2 + 1, color: 'gray'}, // 5
    {x: 6 + 4, y: 2 + 1, color: 'gray'}, // 6
    {x: 7 + 4, y: 2 + 1, color: 'gray'}, // 7
    {x: 8 + 4, y: 2 + 1, color: 'gray'}, // 8
    {x: 9 + 4, y: 2 + 1, color: 'gray'}, // 9
    {x: 10 + 4, y: 2 + 1, color: '#27272a'}, // 10
    {x: 11 + 4, y: 2 + 1, color: 'gray'}, // 11

    // Fila 3
    {x: 1 + 4, y: 3 + 1, color: 'gray'}, // 1
    {x: 2 + 4, y: 3 + 1, color: '#27272a'}, // 2
    {x: 3 + 4, y: 3 + 1, color: '#27272a'}, // 3
    {x: 4 + 4, y: 3 + 1, color: 'gray'}, // 4
    {x: 5 + 4, y: 3 + 1, color: 'gray'}, // 5
    {x: 6 + 4, y: 3 + 1, color: 'gray'}, // 6
    {x: 7 + 4, y: 3 + 1, color: 'gray'}, // 7
    {x: 8 + 4, y: 3 + 1, color: 'gray'}, // 8
    {x: 9 + 4, y: 3 + 1, color: '#27272a'}, // 9
    {x: 10 + 4, y: 3 + 1, color: '#27272a'}, // 10
    {x: 11 + 4, y: 3 + 1, color: 'gray'}, // 11

    // Fila 4
    {x: 1 + 4, y: 4 + 1, color: 'gray'}, // 1
    {x: 2 + 4, y: 4 + 1, color: '#27272a'}, // 2
    {x: 3 + 4, y: 4 + 1, color: '#facc15'}, // 3
    {x: 4 + 4, y: 4 + 1, color: '#27272a'}, // 4
    {x: 5 + 4, y: 4 + 1, color: '#27272a'}, // 5
    {x: 6 + 4, y: 4 + 1, color: '#27272a'}, // 6
    {x: 7 + 4, y: 4 + 1, color: '#27272a'}, // 7
    {x: 8 + 4, y: 4 + 1, color: '#27272a'}, // 8
    {x: 9 + 4, y: 4 + 1, color: '#facc15'}, // 9
    {x: 10 + 4, y: 4 + 1, color: '#27272a'}, // 10
    {x: 11 + 4, y: 4 + 1, color: 'gray'}, // 11

    // Fila 5
    {x: 1 + 4, y: 5 + 1, color: 'gray'}, // 1
    {x: 2 + 4, y: 5 + 1, color: '#27272a'}, // 2
    {x: 3 + 4, y: 5 + 1, color: '#facc15'}, // 3
    {x: 4 + 4, y: 5 + 1, color: '#16a34a'}, // 4
    {x: 5 + 4, y: 5 + 1, color: '#16a34a'}, // 5
    {x: 6 + 4, y: 5 + 1, color: '#16a34a'}, // 6
    {x: 7 + 4, y: 5 + 1, color: '#16a34a'}, // 7
    {x: 8 + 4, y: 5 + 1, color: '#16a34a'}, // 8
    {x: 9 + 4, y: 5 + 1, color: '#facc15'}, // 9
    {x: 10 + 4, y: 5 + 1, color: '#27272a'}, // 10
    {x: 11 + 4, y: 5 + 1, color: 'gray'}, // 11

    // Fila 6
    {x: 1 + 4, y: 6 + 1, color: 'gray'}, // 1
    {x: 2 + 4, y: 6 + 1, color: 'gray'}, // 2
    {x: 3 + 4, y: 6 + 1, color: '#facc15'}, // 3
    {x: 4 + 4, y: 6 + 1, color: '#27272a'}, // 4
    {x: 5 + 4, y: 6 + 1, color: '#facc15'}, // 5
    {x: 6 + 4, y: 6 + 1, color: '#facc15'}, // 6
    {x: 7 + 4, y: 6 + 1, color: '#facc15'}, // 7
    {x: 8 + 4, y: 6 + 1, color: '#27272a'}, // 8
    {x: 9 + 4, y: 6 + 1, color: '#facc15'}, // 9
    {x: 10 + 4, y: 6 + 1, color: 'gray'}, // 10
    {x: 11 + 4, y: 6 + 1, color: 'gray'}, // 11

    // Fila 7
    {x: 1 + 4, y: 7 + 1, color: 'gray'}, // 1
    {x: 2 + 4, y: 7 + 1, color: 'gray'}, // 2
    {x: 3 + 4, y: 7 + 1, color: '#facc15'}, // 3
    {x: 4 + 4, y: 7 + 1, color: '#facc15'}, // 4
    {x: 5 + 4, y: 7 + 1, color: '#facc15'}, // 5
    {x: 6 + 4, y: 7 + 1, color: '#27272a'}, // 6
    {x: 7 + 4, y: 7 + 1, color: '#facc15'}, // 7
    {x: 8 + 4, y: 7 + 1, color: '#facc15'}, // 8
    {x: 9 + 4, y: 7 + 1, color: '#facc15'}, // 9
    {x: 10 + 4, y: 7 + 1, color: 'gray'}, // 10
    {x: 11 + 4, y: 7 + 1, color: 'gray'}, // 11

    // Fila 8
    {x: 1 + 4, y: 8 + 1, color: 'gray'}, // 1
    {x: 2 + 4, y: 8 + 1, color: 'gray'}, // 2
    {x: 3 + 4, y: 8 + 1, color: '#facc15'}, // 3
    {x: 4 + 4, y: 8 + 1, color: '#facc15'}, // 4
    {x: 5 + 4, y: 8 + 1, color: '#27272a'}, // 5
    {x: 6 + 4, y: 8 + 1, color: '#27272a'}, // 6
    {x: 7 + 4, y: 8 + 1, color: '#27272a'}, // 7
    {x: 8 + 4, y: 8 + 1, color: '#facc15'}, // 8
    {x: 9 + 4, y: 8 + 1, color: '#facc15'}, // 9
    {x: 10 + 4, y: 8 + 1, color: 'gray'}, // 10
    {x: 11 + 4, y: 8 + 1, color: 'gray'}, // 11

    // Fila 9
    {x: 1 + 4, y: 9 + 1, color: 'gray'}, // 1
    {x: 2 + 4, y: 9 + 1, color: 'gray'}, // 2
    {x: 3 + 4, y: 9 + 1, color: 'gray'}, // 3
    {x: 4 + 4, y: 9 + 1, color: '#2563eb'}, // 4
    {x: 5 + 4, y: 9 + 1, color: '#2563eb'}, // 5
    {x: 6 + 4, y: 9 + 1, color: '#2563eb'}, // 6
    {x: 7 + 4, y: 9 + 1, color: '#2563eb'}, // 7
    {x: 8 + 4, y: 9 + 1, color: '#2563eb'}, // 8
    {x: 9 + 4, y: 9 + 1, color: 'gray'}, // 9
    {x: 10 + 4, y: 9 + 1, color: 'gray'}, // 10
    {x: 11 + 4, y: 9 + 1, color: 'gray'}, // 11

    // Fila 10
    {x: 1 + 4, y: 10 + 1, color: 'gray'}, // 1
    {x: 2 + 4, y: 10 + 1, color: 'gray'}, // 2
    {x: 3 + 4, y: 10 + 1, color: 'gray'}, // 3
    {x: 4 + 4, y: 10 + 1, color: 'gray'}, // 4
    {x: 5 + 4, y: 10 + 1, color: 'gray'}, // 5
    {x: 6 + 4, y: 10 + 1, color: 'gray'}, // 6
    {x: 7 + 4, y: 10 + 1, color: 'gray'}, // 7
    {x: 8 + 4, y: 10 + 1, color: 'gray'}, // 8
    {x: 9 + 4, y: 10 + 1, color: 'gray'}, // 9
    {x: 10 + 4, y: 10 + 1, color: 'gray'}, // 10
    {x: 11 + 4, y: 10 + 1, color: 'gray'}, // 11

    // Fila 11
    {x: 1 + 4, y: 11 + 1, color: 'gray'}, // 1
    {x: 2 + 4, y: 11 + 1, color: 'gray'}, // 2
    {x: 3 + 4, y: 11 + 1, color: 'gray'}, // 3
    {x: 4 + 4, y: 11 + 1, color: 'gray'}, // 4
    {x: 5 + 4, y: 11 + 1, color: 'gray'}, // 5
    {x: 6 + 4, y: 11 + 1, color: 'gray'}, // 6
    {x: 7 + 4, y: 11 + 1, color: 'gray'}, // 7
    {x: 8 + 4, y: 11 + 1, color: 'gray'}, // 8
    {x: 9 + 4, y: 11 + 1, color: 'gray'}, // 9
    {x: 10 + 4, y: 11 + 1, color: 'gray'}, // 10
    {x: 11 + 4, y: 11 + 1, color: 'gray'}, // 11

    {x: 20, y: 1, color: 'black'},
    {x: 20, y: 2, color: 'black'},
    {x: 20, y: 3, color: 'black'},
    {x: 20, y: 4, color: 'black'},
    {x: 20, y: 5, color: 'black'},
    {x: 20, y: 6, color: 'black'},
    {x: 20, y: 7, color: 'black'},
    {x: 20, y: 8, color: 'black'},
    {x: 20, y: 9, color: 'black'},
    {x: 20, y: 10, color: 'black'},
    {x: 20, y: 11, color: 'black'},
    {x: 20, y: 12, color: 'black'},
    {x: 20, y: 13, color: 'black'},
    {x: 20, y: 14, color: 'black'},
];

export const instrucciones = [
    // Fila 1
    {x: 1 + 5, y: 1 + 1, color: 'gray'}, // 1
    {x: 2 + 5, y: 1 + 1, color: 'gray'}, // 2
    {x: 3 + 5, y: 1 + 1, color: 'gray'}, // 3
    {x: 4 + 5, y: 1 + 1, color: 'gray'}, // 4
    {x: 5 + 5, y: 1 + 1, color: 'gray'}, // 5
    {x: 6 + 5, y: 1 + 1, color: 'gray'}, // 6
    {x: 7 + 5, y: 1 + 1, color: 'gray'}, // 7
    {x: 8 + 5, y: 1 + 1, color: 'gray'}, // 8
    {x: 9 + 5, y: 1 + 1, color: 'gray'}, // 9
    {x: 10 + 5, y: 1 + 1, color: 'gray'}, // 10
    {x: 11 + 5, y: 1 + 1, color: 'gray'}, // 11

    // Fila 2
    {x: 1 + 5, y: 2 + 1, color: 'gray'}, // 1
    {x: 2 + 5, y: 2 + 1, color: '#d1d5db'}, // 2
    {x: 3 + 5, y: 2 + 1, color: 'gray'}, // 3
    {x: 4 + 5, y: 2 + 1, color: 'gray'}, // 4
    {x: 5 + 5, y: 2 + 1, color: 'gray'}, // 5
    {x: 6 + 5, y: 2 + 1, color: 'gray'}, // 6
    {x: 7 + 5, y: 2 + 1, color: 'gray'}, // 7
    {x: 8 + 5, y: 2 + 1, color: 'gray'}, // 8
    {x: 9 + 5, y: 2 + 1, color: 'gray'}, // 9
    {x: 10 + 5, y: 2 + 1, color: '#d1d5db'}, // 10
    {x: 11 + 5, y: 2 + 1, color: 'gray'}, // 11

    // Fila 3
    {x: 1 + 5, y: 3 + 1, color: 'gray'}, // 1
    {x: 2 + 5, y: 3 + 1, color: '#d1d5db'}, // 2
    {x: 3 + 5, y: 3 + 1, color: '#d1d5db'}, // 3
    {x: 4 + 5, y: 3 + 1, color: 'gray'}, // 4
    {x: 5 + 5, y: 3 + 1, color: 'gray'}, // 5
    {x: 6 + 5, y: 3 + 1, color: 'gray'}, // 6
    {x: 7 + 5, y: 3 + 1, color: 'gray'}, // 7
    {x: 8 + 5, y: 3 + 1, color: 'gray'}, // 8
    {x: 9 + 5, y: 3 + 1, color: '#d1d5db'}, // 9
    {x: 10 + 5, y: 3 + 1, color: '#d1d5db'}, // 10
    {x: 11 + 5, y: 3 + 1, color: 'gray'}, // 11

    // Fila 4
    {x: 1 + 5, y: 4 + 1, color: 'gray'}, // 1
    {x: 2 + 5, y: 4 + 1, color: '#d1d5db'}, // 2
    {x: 3 + 5, y: 4 + 1, color: '#d1d5db'}, // 3
    {x: 4 + 5, y: 4 + 1, color: '#d1d5db'}, // 4
    {x: 5 + 5, y: 4 + 1, color: '#d1d5db'}, // 5
    {x: 6 + 5, y: 4 + 1, color: '#d1d5db'}, // 6
    {x: 7 + 5, y: 4 + 1, color: '#d1d5db'}, // 7
    {x: 8 + 5, y: 4 + 1, color: '#d1d5db'}, // 8
    {x: 9 + 5, y: 4 + 1, color: '#d1d5db'}, // 9
    {x: 10 + 5, y: 4 + 1, color: '#d1d5db'}, // 10
    {x: 11 + 5, y: 4 + 1, color: 'gray'}, // 11

    // Fila 5
    {x: 1 + 5, y: 5 + 1, color: 'gray'}, // 1
    {x: 2 + 5, y: 5 + 1, color: '#d1d5db'}, // 2
    {x: 3 + 5, y: 5 + 1, color: '#d1d5db'}, // 3
    {x: 4 + 5, y: 5 + 1, color: '#d1d5db'}, // 4
    {x: 5 + 5, y: 5 + 1, color: '#d1d5db'}, // 5
    {x: 6 + 5, y: 5 + 1, color: '#d1d5db'}, // 6
    {x: 7 + 5, y: 5 + 1, color: '#d1d5db'}, // 7
    {x: 8 + 5, y: 5 + 1, color: '#d1d5db'}, // 8
    {x: 9 + 5, y: 5 + 1, color: '#d1d5db'}, // 9
    {x: 10 + 5, y: 5 + 1, color: '#d1d5db'}, // 10
    {x: 11 + 5, y: 5 + 1, color: 'gray'}, // 11

    // Fila 6
    {x: 1 + 5, y: 6 + 1, color: 'gray'}, // 1
    {x: 2 + 5, y: 6 + 1, color: 'gray'}, // 2
    {x: 3 + 5, y: 6 + 1, color: '#d1d5db'}, // 3
    {x: 4 + 5, y: 6 + 1, color: '#d1d5db'}, // 4
    {x: 5 + 5, y: 6 + 1, color: '#d1d5db'}, // 5
    {x: 6 + 5, y: 6 + 1, color: '#d1d5db'}, // 6
    {x: 7 + 5, y: 6 + 1, color: '#d1d5db'}, // 7
    {x: 8 + 5, y: 6 + 1, color: '#d1d5db'}, // 8
    {x: 9 + 5, y: 6 + 1, color: '#d1d5db'}, // 9
    {x: 10 + 5, y: 6 + 1, color: 'gray'}, // 10
    {x: 11 + 5, y: 6 + 1, color: 'gray'}, // 11

    // Fila 7
    {x: 1 + 5, y: 7 + 1, color: 'gray'}, // 1
    {x: 2 + 5, y: 7 + 1, color: 'gray'}, // 2
    {x: 3 + 5, y: 7 + 1, color: '#d1d5db'}, // 3
    {x: 4 + 5, y: 7 + 1, color: '#d1d5db'}, // 4
    {x: 5 + 5, y: 7 + 1, color: '#d1d5db'}, // 5
    {x: 6 + 5, y: 7 + 1, color: '#d1d5db'}, // 6
    {x: 7 + 5, y: 7 + 1, color: '#d1d5db'}, // 7
    {x: 8 + 5, y: 7 + 1, color: '#d1d5db'}, // 8
    {x: 9 + 5, y: 7 + 1, color: '#d1d5db'}, // 9
    {x: 10 + 5, y: 7 + 1, color: 'gray'}, // 10
    {x: 11 + 5, y: 7 + 1, color: 'gray'}, // 11

    // Fila 8
    {x: 1 + 5, y: 8 + 1, color: 'gray'}, // 1
    {x: 2 + 5, y: 8 + 1, color: 'gray'}, // 2
    {x: 3 + 5, y: 8 + 1, color: '#d1d5db'}, // 3
    {x: 4 + 5, y: 8 + 1, color: '#d1d5db'}, // 4
    {x: 5 + 5, y: 8 + 1, color: '#d1d5db'}, // 5
    {x: 6 + 5, y: 8 + 1, color: '#d1d5db'}, // 6
    {x: 7 + 5, y: 8 + 1, color: '#d1d5db'}, // 7
    {x: 8 + 5, y: 8 + 1, color: '#d1d5db'}, // 8
    {x: 9 + 5, y: 8 + 1, color: '#d1d5db'}, // 9
    {x: 10 + 5, y: 8 + 1, color: 'gray'}, // 10
    {x: 11 + 5, y: 8 + 1, color: 'gray'}, // 11

    // Fila 9
    {x: 1 + 5, y: 9 + 1, color: 'gray'}, // 1
    {x: 2 + 5, y: 9 + 1, color: 'gray'}, // 2
    {x: 3 + 5, y: 9 + 1, color: 'gray'}, // 3
    {x: 4 + 5, y: 9 + 1, color: '#d1d5db'}, // 4
    {x: 5 + 5, y: 9 + 1, color: '#d1d5db'}, // 5
    {x: 6 + 5, y: 9 + 1, color: '#d1d5db'}, // 6
    {x: 7 + 5, y: 9 + 1, color: '#d1d5db'}, // 7
    {x: 8 + 5, y: 9 + 1, color: '#d1d5db'}, // 8
    {x: 9 + 5, y: 9 + 1, color: 'gray'}, // 9
    {x: 10 + 5, y: 9 + 1, color: 'gray'}, // 10
    {x: 11 + 5, y: 9 + 1, color: 'gray'}, // 11

    // Fila 10
    {x: 1 + 5, y: 10 + 1, color: 'gray'}, // 1
    {x: 2 + 5, y: 10 + 1, color: 'gray'}, // 2
    {x: 3 + 5, y: 10 + 1, color: 'gray'}, // 3
    {x: 4 + 5, y: 10 + 1, color: 'gray'}, // 4
    {x: 5 + 5, y: 10 + 1, color: 'gray'}, // 5
    {x: 6 + 5, y: 10 + 1, color: 'gray'}, // 6
    {x: 7 + 5, y: 10 + 1, color: 'gray'}, // 7
    {x: 8 + 5, y: 10 + 1, color: 'gray'}, // 8
    {x: 9 + 5, y: 10 + 1, color: 'gray'}, // 9
    {x: 10 + 5, y: 10 + 1, color: 'gray'}, // 10
    {x: 11 + 5, y: 10 + 1, color: 'gray'}, // 11

    // Fila 11
    {x: 1 + 5, y: 11 + 1, color: 'gray'}, // 1
    {x: 2 + 5, y: 11 + 1, color: 'gray'}, // 2
    {x: 3 + 5, y: 11 + 1, color: 'gray'}, // 3
    {x: 4 + 5, y: 11 + 1, color: 'gray'}, // 4
    {x: 5 + 5, y: 11 + 1, color: 'gray'}, // 5
    {x: 6 + 5, y: 11 + 1, color: 'gray'}, // 6
    {x: 7 + 5, y: 11 + 1, color: 'gray'}, // 7
    {x: 8 + 5, y: 11 + 1, color: 'gray'}, // 8
    {x: 9 + 5, y: 11 + 1, color: 'gray'}, // 9
    {x: 10 + 5, y: 11 + 1, color: 'gray'}, // 10
    {x: 11 + 5, y: 11 + 1, color: 'gray'}, // 11

    {x: 1, y: 1, color: 'black'},
    {x: 1, y: 2, color: 'black'},
    {x: 1, y: 3, color: 'black'},
    {x: 1, y: 4, color: 'black'},
    {x: 1, y: 5, color: 'black'},
    {x: 1, y: 6, color: 'black'},
    {x: 1, y: 7, color: 'black'},
    {x: 1, y: 8, color: 'black'},
    {x: 1, y: 9, color: 'black'},
    {x: 1, y: 10, color: 'black'},
    {x: 1, y: 11, color: 'black'},
    {x: 1, y: 12, color: 'black'},
    {x: 1, y: 13, color: 'black'},
    {x: 1, y: 14, color: 'black'},
];

export const cat = [
    // Fila 1
    {row: 13, color: 3, guide: true},
    {row: 21, color: 3, guide: true},

    // Fila 2
    {row: 24, color: 3, guide: true},
    {row: 25, color: 3, guide: true},
    {row: 31, color: 3, guide: true},
    {row: 32, color: 3, guide: true},

    // Fila 3
    {row: 35, color: 3, guide: true},
    {row: 36, color: 2, guide: true},
    {row: 37, color: 3, guide: true},
    {row: 38, color: 3, guide: true},
    {row: 39, color: 3, guide: true},
    {row: 40, color: 3, guide: true},
    {row: 41, color: 3, guide: true},
    {row: 42, color: 2, guide: true},
    {row: 43, color: 3, guide: true},

    // Fila 4
    {row: 46, color: 3, guide: true},
    {row: 47, color: 2, guide: true},
    {row: 48, color: 1, guide: true},
    {row: 49, color: 1, guide: true},
    {row: 50, color: 1, guide: true},
    {row: 51, color: 1, guide: true},
    {row: 52, color: 1, guide: true},
    {row: 53, color: 2, guide: true},
    {row: 54, color: 3, guide: true},

    // Fila 5
    {row: 58, color: 2, guide: true},
    {row: 59, color: 3, guide: true},
    {row: 60, color: 2, guide: true},
    {row: 61, color: 2, guide: true},
    {row: 62, color: 2, guide: true},
    {row: 63, color: 3, guide: true},
    {row: 64, color: 2, guide: true},

    // Fila 6
    {row: 69, color: 2, guide: true},
    {row: 70, color: 2, guide: true},
    {row: 71, color: 2, guide: true},
    {row: 72, color: 3, guide: true},
    {row: 73, color: 2, guide: true},
    {row: 74, color: 2, guide: true},
    {row: 75, color: 2, guide: true},

    // Fila 7
    {row: 80, color: 2, guide: true},
    {row: 81, color: 2, guide: true},
    {row: 82, color: 3, guide: true},
    {row: 83, color: 3, guide: true},
    {row: 84, color: 3, guide: true},
    {row: 85, color: 2, guide: true},
    {row: 86, color: 2, guide: true},

    // Fila 8
    {row: 92, color: 0, guide: true},
    {row: 93, color: 0, guide: true},
    {row: 94, color: 0, guide: true},
    {row: 95, color: 0, guide: true},
    {row: 96, color: 0, guide: true},

    ///////////////////////////////////

    // Fila 1
    {row: 13, color: 3, guide: false},
    {row: 21, color: 3, guide: false},

    // Fila 2
    {row: 24, color: 3, guide: false},
    {row: 25, color: 3, guide: false},
    {row: 31, color: 3, guide: false},
    {row: 32, color: 3, guide: false},

    // Fila 3
    {row: 35, color: 3, guide: false},
    {row: 36, color: 2, guide: false},
    {row: 37, color: 3, guide: false},
    {row: 38, color: 3, guide: false},
    {row: 39, color: 3, guide: false},
    {row: 40, color: 3, guide: false},
    {row: 41, color: 3, guide: false},
    {row: 42, color: 2, guide: false},
    {row: 43, color: 3, guide: false},

    // Fila 4
    {row: 46, color: 3, guide: false},
    {row: 47, color: 2, guide: false},
    {row: 48, color: 1, guide: false},
    {row: 49, color: 1, guide: false},
    {row: 50, color: 1, guide: false},
    {row: 51, color: 1, guide: false},
    {row: 52, color: 1, guide: false},
    {row: 53, color: 2, guide: false},
    {row: 54, color: 3, guide: false},

    // Fila 5
    {row: 58, color: 2, guide: false},
    {row: 59, color: 3, guide: false},
    {row: 60, color: 2, guide: false},
    {row: 61, color: 2, guide: false},
    {row: 62, color: 2, guide: false},
    {row: 63, color: 3, guide: false},
    {row: 64, color: 2, guide: false},

    // Fila 6
    {row: 69, color: 2, guide: false},
    {row: 70, color: 2, guide: false},
    {row: 71, color: 2, guide: false},
    {row: 72, color: 3, guide: false},
    {row: 73, color: 2, guide: false},
    {row: 74, color: 2, guide: false},
    {row: 75, color: 2, guide: false},

    // Fila 7
    {row: 80, color: 2, guide: false},
    {row: 81, color: 2, guide: false},
    {row: 82, color: 3, guide: false},
    {row: 83, color: 3, guide: false},
    {row: 84, color: 3, guide: false},
    {row: 85, color: 2, guide: false},
    {row: 86, color: 2, guide: false},

    // Fila 8
    {row: 92, color: 0, guide: false},
    {row: 93, color: 0, guide: false},
    {row: 94, color: 0, guide: false},
    {row: 95, color: 0, guide: false},
    {row: 96, color: 0, guide: false},
];

export const mouse = [
    {row: 19, color: 0, guide: true},
    {row: 31, color: 0, guide: true},
    {row: 43, color: 0, guide: true},
    {row: 54, color: 0, guide: true},
    {row: 65, color: 0, guide: true},
    {row: 75, color: 0, guide: true},
    {row: 85, color: 0, guide: true},
    {row: 60, color: 1, guide: true},
    {row: 48, color: 1, guide: true},
    {row: 50, color: 1, guide: true},

    {row: 36, color: 1, guide: true},
    {row: 40, color: 1, guide: true},
    {row: 51, color: 1, guide: true},
    {row: 62, color: 1, guide: true},
    {row: 61, color: 0, guide: true},
    {row: 73, color: 1, guide: true},
    {row: 72, color: 1, guide: true},
    {row: 84, color: 1, guide: true},
    {row: 83, color: 1, guide: true},
    {row: 82, color: 1, guide: true},
    {row: 81, color: 1, guide: true},
    {row: 80, color: 1, guide: true},

    {row: 47, color: 1, guide: true},
    {row: 58, color: 1, guide: true},
    {row: 59, color: 0, guide: true},
    {row: 69, color: 1, guide: true},
    {row: 70, color: 1, guide: true},
    {row: 71, color: 0, guide: true},
    {row: 92, color: 1, guide: true},
    {row: 94, color: 1, guide: true},

    ///////////////////////////////

    {row: 19, color: 0, guide: false},
    {row: 31, color: 0, guide: false},
    {row: 43, color: 0, guide: false},
    {row: 54, color: 0, guide: false},
    {row: 65, color: 0, guide: false},
    {row: 75, color: 0, guide: false},
    {row: 85, color: 0, guide: false},
    {row: 60, color: 1, guide: false},
    {row: 48, color: 1, guide: false},
    {row: 50, color: 1, guide: false},

    {row: 36, color: 1, guide: false},
    {row: 40, color: 1, guide: false},
    {row: 51, color: 1, guide: false},
    {row: 62, color: 1, guide: false},
    {row: 61, color: 0, guide: false},
    {row: 73, color: 1, guide: false},
    {row: 72, color: 1, guide: false},
    {row: 84, color: 1, guide: false},
    {row: 83, color: 1, guide: false},
    {row: 82, color: 1, guide: false},
    {row: 81, color: 1, guide: false},
    {row: 80, color: 1, guide: false},

    {row: 47, color: 1, guide: false},
    {row: 58, color: 1, guide: false},
    {row: 59, color: 0, guide: false},
    {row: 69, color: 1, guide: false},
    {row: 70, color: 1, guide: false},
    {row: 71, color: 0, guide: false},
    {row: 92, color: 1, guide: false},
    {row: 94, color: 1, guide: false},
]

export const heart = [
    {row: 15, color: 0, guide: true},
    {row: 16, color: 0, guide: true},
    {row: 18, color: 0, guide: true},
    {row: 19, color: 0, guide: true},

    {row: 25, color: 0, guide: true},
    {row: 27, color: 0, guide: true},
    {row: 28, color: 0, guide: true},
    {row: 29, color: 0, guide: true},
    {row: 30, color: 0, guide: true},
    {row: 31, color: 0, guide: true},

    {row: 36, color: 0, guide: true},
    {row: 37, color: 0, guide: true},
    {row: 39, color: 0, guide: true},
    {row: 40, color: 0, guide: true},
    {row: 41, color: 0, guide: true},
    {row: 42, color: 0, guide: true},

    {row: 47, color: 0, guide: true},
    {row: 48, color: 0, guide: true},
    {row: 49, color: 0, guide: true},
    {row: 50, color: 0, guide: true},
    {row: 51, color: 0, guide: true},
    {row: 52, color: 0, guide: true},
    {row: 53, color: 0, guide: true},

    {row: 59, color: 0, guide: true},
    {row: 60, color: 0, guide: true},
    {row: 61, color: 0, guide: true},
    {row: 62, color: 0, guide: true},
    {row: 63, color: 0, guide: true},

    {row: 71, color: 0, guide: true},
    {row: 72, color: 0, guide: true},
    {row: 73, color: 0, guide: true},

    {row: 83, color: 0, guide: true},

    ///////////////////////////////

    {row: 15, color: 0, guide: false},
    {row: 16, color: 0, guide: false},
    {row: 18, color: 0, guide: false},
    {row: 19, color: 0, guide: false},

    {row: 25, color: 0, guide: false},
    {row: 27, color: 0, guide: false},
    {row: 28, color: 0, guide: false},
    {row: 29, color: 0, guide: false},
    {row: 30, color: 0, guide: false},
    {row: 31, color: 0, guide: false},

    {row: 36, color: 0, guide: false},
    {row: 37, color: 0, guide: false},
    {row: 39, color: 0, guide: false},
    {row: 40, color: 0, guide: false},
    {row: 41, color: 0, guide: false},
    {row: 42, color: 0, guide: false},

    {row: 47, color: 0, guide: false},
    {row: 48, color: 0, guide: false},
    {row: 49, color: 0, guide: false},
    {row: 50, color: 0, guide: false},
    {row: 51, color: 0, guide: false},
    {row: 52, color: 0, guide: false},
    {row: 53, color: 0, guide: false},

    {row: 59, color: 0, guide: false},
    {row: 60, color: 0, guide: false},
    {row: 61, color: 0, guide: false},
    {row: 62, color: 0, guide: false},
    {row: 63, color: 0, guide: false},

    {row: 71, color: 0, guide: false},
    {row: 72, color: 0, guide: false},
    {row: 73, color: 0, guide: false},

    {row: 83, color: 0, guide: false},
];

export const turtle = [
    {row: 68, color: 0, guide: true},
    {row: 69, color: 0, guide: true},
    {row: 70, color: 0, guide: true},
    {row: 71, color: 0, guide: true},
    {row: 72, color: 0, guide: true},
    {row: 73, color: 0, guide: true},

    {row: 57, color: 0, guide: true},
    {row: 58, color: 0, guide: true},
    {row: 59, color: 0, guide: true},
    {row: 60, color: 0, guide: true},
    {row: 61, color: 0, guide: true},
    {row: 62, color: 0, guide: true},

    {row: 46, color: 0, guide: true},
    {row: 47, color: 0, guide: true},
    {row: 48, color: 0, guide: true},
    {row: 49, color: 0, guide: true},
    {row: 50, color: 0, guide: true},
    {row: 51, color: 0, guide: true},

    {row: 36, color: 0, guide: true},
    {row: 37, color: 0, guide: true},
    {row: 38, color: 0, guide: true},
    {row: 39, color: 0, guide: true},

    {row: 26, color: 0, guide: true},
    {row: 27, color: 0, guide: true},

    {row: 67, color: 1, guide: true},
    {row: 74, color: 1, guide: true},
    {row: 75, color: 1, guide: true},
    {row: 41, color: 1, guide: true},
    {row: 42, color: 1, guide: true},
    {row: 52, color: 1, guide: true},
    {row: 63, color: 1, guide: true},
    {row: 64, color: 1, guide: true},

    {row: 54, color: 1, guide: true},
    {row: 53, color: 2, guide: true},
    {row: 65, color: 1, guide: true},

    {row: 79, color: 1, guide: true},
    {row: 80, color: 1, guide: true},
    {row: 81, color: 1, guide: true},
    {row: 82, color: 1, guide: true},
    {row: 83, color: 1, guide: true},
    {row: 84, color: 1, guide: true},

    {row: 90, color: 1, guide: true},
    {row: 91, color: 1, guide: true},
    {row: 94, color: 1, guide: true},
    {row: 95, color: 1, guide: true},

    ///////////////////////////////

    {row: 68, color: 0, guide: false},
    {row: 69, color: 0, guide: false},
    {row: 70, color: 0, guide: false},
    {row: 71, color: 0, guide: false},
    {row: 72, color: 0, guide: false},
    {row: 73, color: 0, guide: false},

    {row: 57, color: 0, guide: false},
    {row: 58, color: 0, guide: false},
    {row: 59, color: 0, guide: false},
    {row: 60, color: 0, guide: false},
    {row: 61, color: 0, guide: false},
    {row: 62, color: 0, guide: false},

    {row: 46, color: 0, guide: false},
    {row: 47, color: 0, guide: false},
    {row: 48, color: 0, guide: false},
    {row: 49, color: 0, guide: false},
    {row: 50, color: 0, guide: false},
    {row: 51, color: 0, guide: false},

    {row: 36, color: 0, guide: false},
    {row: 37, color: 0, guide: false},
    {row: 38, color: 0, guide: false},
    {row: 39, color: 0, guide: false},

    {row: 26, color: 0, guide: false},
    {row: 27, color: 0, guide: false},

    {row: 67, color: 1, guide: false},
    {row: 74, color: 1, guide: false},
    {row: 75, color: 1, guide: false},
    {row: 41, color: 1, guide: false},
    {row: 42, color: 1, guide: false},
    {row: 52, color: 1, guide: false},
    {row: 63, color: 1, guide: false},
    {row: 64, color: 1, guide: false},

    {row: 54, color: 1, guide: false},
    {row: 53, color: 2, guide: false},
    {row: 65, color: 1, guide: false},

    {row: 79, color: 1, guide: false},
    {row: 80, color: 1, guide: false},
    {row: 81, color: 1, guide: false},
    {row: 82, color: 1, guide: false},
    {row: 83, color: 1, guide: false},
    {row: 84, color: 1, guide: false},

    {row: 90, color: 1, guide: false},
    {row: 91, color: 1, guide: false},
    {row: 94, color: 1, guide: false},
    {row: 95, color: 1, guide: false},
];

export const hat = [
    {row: 69, color: 0, guide: true},
    {row: 70, color: 0, guide: true},
    {row: 71, color: 0, guide: true},
    {row: 72, color: 0, guide: true},
    {row: 73, color: 0, guide: true},
    {row: 74, color: 0, guide: true},
    {row: 75, color: 0, guide: true},

    {row: 59, color: 1, guide: true},
    {row: 60, color: 1, guide: true},
    {row: 61, color: 1, guide: true},
    {row: 62, color: 2, guide: true},
    {row: 63, color: 1, guide: true},

    {row: 48, color: 0, guide: true},
    {row: 49, color: 0, guide: true},
    {row: 50, color: 0, guide: true},
    {row: 51, color: 0, guide: true},
    {row: 52, color: 0, guide: true},

    {row: 37, color: 0, guide: true},
    {row: 38, color: 0, guide: true},
    {row: 39, color: 0, guide: true},
    {row: 40, color: 0, guide: true},
    {row: 41, color: 0, guide: true},

    {row: 26, color: 0, guide: true},
    {row: 27, color: 0, guide: true},
    {row: 28, color: 0, guide: true},
    {row: 29, color: 0, guide: true},
    {row: 30, color: 0, guide: true},

    ///////////////////////////////

    {row: 69, color: 0, guide: false},
    {row: 70, color: 0, guide: false},
    {row: 71, color: 0, guide: false},
    {row: 72, color: 0, guide: false},
    {row: 73, color: 0, guide: false},
    {row: 74, color: 0, guide: false},
    {row: 75, color: 0, guide: false},

    {row: 59, color: 1, guide: false},
    {row: 60, color: 1, guide: false},
    {row: 61, color: 1, guide: false},
    {row: 62, color: 2, guide: false},
    {row: 63, color: 1, guide: false},

    {row: 48, color: 0, guide: false},
    {row: 49, color: 0, guide: false},
    {row: 50, color: 0, guide: false},
    {row: 51, color: 0, guide: false},
    {row: 52, color: 0, guide: false},

    {row: 37, color: 0, guide: false},
    {row: 38, color: 0, guide: false},
    {row: 39, color: 0, guide: false},
    {row: 40, color: 0, guide: false},
    {row: 41, color: 0, guide: false},

    {row: 26, color: 0, guide: false},
    {row: 27, color: 0, guide: false},
    {row: 28, color: 0, guide: false},
    {row: 29, color: 0, guide: false},
    {row: 30, color: 0, guide: false},
];