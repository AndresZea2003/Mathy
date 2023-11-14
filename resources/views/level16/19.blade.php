@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Elleon', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/leon.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Elcocodrilo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/cocodrilo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Elelefante', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/elefante.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Eltiburon', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/tiburon.svg'), 'size' => 'BIG', 'group' => 'Animal'],
        ])}}"
        :size="{{4}}"
        :order_to_resolve="[3,15,5,8,14,12]"
        :solution="[1,4,2,4,2,1]"
        :fill_sudoku="[
        4,3,0,2,
        0,1,3,0,
        3,4,2,0,
        1,0,0,3,
        ]"
        :selectors="[
        [1,0],
        [0,3],
        [0,1],
        [2,0],
        [4,2],
        [3,4]
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>

@endsection
