@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Lahormiga', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/hormiga.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Laabeja', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/abeja.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Elgrillo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/grillo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Balon dorado', 'type' => 'IMAGE', 'content' => asset('/images/objects/ballon-dorado.svg'), 'size' => 'BIG', 'group' => 'Imagen']
        ])}}"
        :size="{{3}}"
        :order_to_resolve="[3,9,4]"
        :solution="[1,3,3]"
        :fill_sudoku="[
        2,3,0,
        0,1,2,
        1,2,0
        ]"
        :selectors="[
        [1,0],
        [3,3],
        [2,1],
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>

@endsection
