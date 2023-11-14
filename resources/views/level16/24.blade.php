@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => '6', 'type' => 'NUMBER', 'content' => '2', 'group' => 'Numero'],
            ['name' => '4', 'type' => 'NUMBER', 'content' => '3', 'group' => 'Numero'],
            ['name' => '5', 'type' => 'NUMBER', 'content' => '1', 'group' => 'Numero'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
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
