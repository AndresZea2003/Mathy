@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => '3', 'type' => 'NUMBER', 'content' => '3', 'group' => 'Numero'],
            ['name' => '4', 'type' => 'NUMBER', 'content' => '4', 'group' => 'Numero'],
            ['name' => '2', 'type' => 'NUMBER', 'content' => '2', 'group' => 'Numero'],
            ['name' => '1', 'type' => 'NUMBER', 'content' => '1', 'group' => 'Numero'],
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
