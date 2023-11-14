@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
        ])}}"
        :size="{{4}}"
        :order_to_resolve="[15,3,5,12,2,8]"
        :solution="[1,2,2,2,1,1]"
        :fill_sudoku="[
        4,0,0,3,
        0,4,3,0,
        1,3,4,0,
        3,2,0,4,
        ]"
        :selectors="[
        [4,0],
        [0,3],
        [0,1],
        [3,0],
        [1,2],
        [2,4]
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>

@endsection
