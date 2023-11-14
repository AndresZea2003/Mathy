@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => '9', 'type' => 'NUMBER', 'content' => '2', 'group' => 'Numero'],
            ['name' => '7', 'type' => 'NUMBER', 'content' => '3', 'group' => 'Numero'],
            ['name' => '8', 'type' => 'NUMBER', 'content' => '1', 'group' => 'Numero'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :size="{{3}}"
        :order_to_resolve="[4,1,8,9]"
        :solution="[3,2,2,3]"
        :fill_sudoku="[
        0,3,1,
        0,1,2,
        1,0,0
        ]"
        :selectors="[
        [2,0],
        [1,1],
        [0,2],
        [3,3],
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>

@endsection
