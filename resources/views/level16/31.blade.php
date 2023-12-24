@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Elleon', 'type' => 'IMAGE', 'content' => asset('/images/items/ED/3.jpeg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Elcocodrilo', 'type' => 'IMAGE', 'content' => asset('/images/items/ED/1.jpeg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Elelefante', 'type' => 'IMAGE', 'content' => asset('/images/items/ED/2.jpeg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :size="{{3}}"
        :order_to_resolve="[1,7,6]"
        :solution="[3,2,3]"
        :fill_sudoku="[
        0,1,2,
        1,2,0,
        0,3,1
        ]"
        :selectors="[
        [1,0],
        [3,1],
        [2,3],
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>

@endsection
