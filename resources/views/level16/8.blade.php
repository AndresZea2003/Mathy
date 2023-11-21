@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Lahormiga', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/hormiga.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],
            ['name' => 'Laabeja', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/abeja.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],
            ['name' => 'Elgrillo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/grillo.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],
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
