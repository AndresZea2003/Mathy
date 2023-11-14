@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Las uvas', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/uvas.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'Las bananas', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/bananas.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'Las fresas', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/fresas.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'La pina', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/pina.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
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
