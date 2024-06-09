@extends('layouts.app')

@section('main')

{{--    PainPattern--}}
{{--    Items: Items ( Colores, Letras, imagenes, etc ), que se van a usar en la actividad, Tambien se puede elegir el orden--}}
{{--    Size: Tamaño del cuadro de la actividad ( Horizontal, Vertical )--}}
{{--    Fill Sample: Muestra como se va a llenar el cuadro de la actividad utilizando el indice de los items--}}
{{--    Level: Nivel y actividad de la actividad (Se deja igual)--}}
{{--    Rotate: Rotar el cuadro--}}
{{--    Fake Items: Items que quieres omitir en la introduccion--}}


{{--    <paint-pattern--}}
{{--        :items="{{json_encode([--}}
{{--            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],--}}
{{--            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],--}}
{{--            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],--}}
{{--            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],--}}
{{--        ])}}"--}}
{{--        :size="[2,2]"--}}
{{--        :fill_sample="[--}}
{{--        1,2,--}}
{{--        4,3,--}}
{{--        ]"--}}
{{--        :level="[{{$levelNumber}},{{$activityNumber}}]"--}}
{{--        :rotate="false"--}}
{{--        :fake_items="[]"--}}
{{--        :phase="{{ 3 }}"--}}
{{--    ></paint-pattern>--}}

{{--    Line Paint Pattern--}}
{{--    Size: cantidad de cuadros que tendra la cinta--}}
{{--    Solution: Patron de colores que se debe seguir--}}
{{--    Fill Sample: Muestra como se va a llenar el cuadro de la actividad utilizando el indice de los items--}}

{{--    <line-paint-pattern--}}
{{--        :items="{{json_encode([--}}
{{--            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],--}}
{{--            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],--}}
{{--//            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],--}}
{{--            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],--}}
{{--        ])}}"--}}
{{--        :size="{{40}}"--}}
{{--        :solution="[1,2,3]"--}}
{{--        :fill_sample="[--}}
{{--        1,2,3--}}
{{--        ]"--}}
{{--        :level="[{{$levelNumber}},{{$activityNumber}}]"--}}
{{--        :fake_items="[2]"--}}
{{--        :phase="{{ 3 }}"--}}
{{--    ></line-paint-pattern>--}}

{{--    Paint Ladder--}}
{{--    Select Col: Columnas que quires seleccionar para la actividad ( Solo se puede interactuar con las seleccionadas )--}}
{{--    Solution: Cuadros que se deben pintar para completar la actividad, todo lo que no este en solution es = a Error--}}

{{--    <paint-ladder--}}
{{--        :items="{{json_encode([--}}
{{--            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],--}}
{{--//            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],--}}
{{--            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],--}}
{{--            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']--}}
{{--        ])}}"--}}
{{--        :size="[5,6]"--}}
{{--        :select_cols="[1,3]"--}}
{{--        :solution="[26,28,23,18]"--}}
{{--        :fill_sample="[--}}
{{--        0,0,0,0,0,--}}
{{--        0,0,0,0,1,--}}
{{--        0,0,0,1,1,--}}
{{--        0,0,1,1,1,--}}
{{--        0,1,1,1,1,--}}
{{--        1,1,1,1,1,--}}
{{--        ]"--}}
{{--        :level="[{{$levelNumber}},{{$activityNumber}}]"--}}
{{--        :show_ids="false"--}}
{{--    ></paint-ladder>--}}

    <pixel-art
            :items="{{json_encode([
//            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
//            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
            ['name' => 'Gris', 'type' => 'COLOR', 'content' => 'bg-gray-700', 'hex' => '#334155' , 'group' => 'Color'],
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
            :level="[{{$levelNumber}},{{$activityNumber}}]"
            draw="smile"
    ></pixel-art>


    LISTA DE ACTIVIDADES
    - Paint Pattern ( Numeros, letras, colores, figuras geometricas, frutas, animales ) ,
    (
        Tier 1: 2x2, ( Nivel 1 )
        Tier 2: 3x3, ( Nivel 2)
        Tier 3: 4x4, ( Nivel 3)
    )
    - Line Paint Pattern ( Numeros, letras, colores, figuras geometricas, frutas, animales )
    - Paint Ladder ( colores ), Jugar con los tamaños
    - Pixel Art


@endsection
