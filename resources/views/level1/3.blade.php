@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'A', 'type' => 'LETTER', 'content' => 'a', 'group' => 'Letra'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Balon dorado', 'type' => 'IMAGE', 'content' => asset('/images/objects/ballon-dorado.svg'), 'size' => 'BIG', 'group' => 'Imagen']
        ])}}"
        :size="{{5}}"
        :order_to_resolve="[1,5,9]"
        :solution="[1,1,1]"
        :fill_sudoku="[
        0,2,3,2,3,
        3,0,2,0,2,
        2,3,0,3,0,
        1,1,1,1,1,
        0,2,3,2,3,
        ]"
        :selectors="[
        [5,4],
        [2,3],
        [3,1],
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>


@endsection
