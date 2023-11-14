@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'B', 'type' => 'LETTER', 'content' => 'B', 'group' => 'Letra'],
            ['name' => 'C', 'type' => 'LETTER', 'content' => 'C', 'group' => 'Letra'],
            ['name' => 'D', 'type' => 'LETTER', 'content' => 'D', 'group' => 'Letra'],
            ['name' => 'A', 'type' => 'LETTER', 'content' => 'A', 'group' => 'Letra'],
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
