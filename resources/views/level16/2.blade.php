@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'A', 'type' => 'LETTER', 'content' => 'a', 'group' => 'Letra'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Balon dorado', 'type' => 'IMAGE', 'content' => asset('/images/objects/ballon-dorado.svg'), 'size' => 'BIG', 'group' => 'Imagen']
        ])}}"
        :size="{{4}}"
        :order_to_resolve="[6,11,15]"
        :solution="[4,4,4]"
        :fill_sudoku="[
        2,2,3,1,
        3,0,2,1,
        2,3,0,1,
        2,3,0,1,
        ]"
        :selectors="[
        [4,0],
        [2,0],
        [3,0],
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>


@endsection
