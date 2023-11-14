@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => '8', 'type' => 'NUMBER', 'content' => '1', 'group' => 'Numero'],
            ['name' => '7', 'type' => 'NUMBER', 'content' => '3', 'group' => 'Numero'],
            ['name' => '6', 'type' => 'NUMBER', 'content' => '2', 'group' => 'Numero'],
            ['name' => '9', 'type' => 'NUMBER', 'content' => '2', 'group' => 'Numero'],
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
