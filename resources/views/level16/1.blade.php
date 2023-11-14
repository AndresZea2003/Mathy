@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'A', 'type' => 'LETTER', 'content' => 'a', 'group' => 'Letra'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :size="{{3}}"
        :order_to_resolve="[1,5,9]"
        :solution="[1,1,1]"
        :fill_sudoku="[
        0,2,3,
        3,0,2,
        2,3,0
        ]"
        :selectors="[
        [1,1],
        [2,0],
        [3,0],
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>

@endsection
