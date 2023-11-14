@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Elcaballo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/caballo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Lavaca', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/vaca.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Elcerdo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/cerdo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Laabeja', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/abeja.svg'), 'size' => 'SMALL', 'group' => 'Animal'],
        ])}}"
        :size="{{4}}"
        :order_to_resolve="[4,1,13,11,14,6,7]"
        :solution="[3,4,1,1,3,4,3]"
        :fill_sudoku="[
        0,1,2,0,
        2,0,0,1,
        3,2,0,4,
        0,0,4,2,
        ]"
        :selectors="[
        [0,4],
        [1,0],
        [0,1],
        [3,0],
        [4,0],
        [0,2],
        [2,3],
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>

@endsection
