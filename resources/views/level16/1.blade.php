@extends('layouts.app')

@section('main')

    <interactive-sudoku
            :items="{{json_encode([
//            ['name' => '1', 'type' => 'NUMBER', 'content' => '1', 'group' => 'Numero'],
//            ['name' => '2', 'type' => 'NUMBER', 'content' => '2', 'group' => 'Numero'],
//            ['name' => '3', 'type' => 'NUMBER', 'content' => '3', 'group' => 'Numero'],

//            ['name' => '4', 'type' => 'NUMBER', 'content' => '4', 'group' => 'Numero'],
//            ['name' => '5', 'type' => 'NUMBER', 'content' => '5', 'group' => 'Numero'],
//            ['name' => '6', 'type' => 'NUMBER', 'content' => '6', 'group' => 'Numero'],
//            ['name' => '7', 'type' => 'NUMBER', 'content' => '7', 'group' => 'Numero'],
//            ['name' => '8', 'type' => 'NUMBER', 'content' => '8', 'group' => 'Numero'],
//            ['name' => '9', 'type' => 'NUMBER', 'content' => '9', 'group' => 'Numero'],

//            ['name' => 'A', 'type' => 'LETTER', 'content' => 'a', 'group' => 'Letra'],
//            ['name' => 'B', 'type' => 'LETTER', 'content' => 'b', 'group' => 'Letra'],
//            ['name' => 'C', 'type' => 'LETTER', 'content' => 'c', 'group' => 'Letra'],
            ['name' => 'Las uvas', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/uvas.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'Las bananas', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/bananas.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'Las fresas', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/fresas.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
//            ['name' => 'La pina', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/pina.svg'), 'size' => 'BIG', 'group' => 'Fruta'],

            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
            :size="{{3}}"
            :order_to_resolve="[1,5,9]"
            :solution="[1,1,1]"
            :fill_sudoku="[
        0,2,3,
        3,0,2,
        2,3,0
        ]"
            :selectors="[
        [1,1],
        [2,0],
        [3,0],
        ]"
        :fill_sample="[
        1,2,0,
        0,1,2,
        2,0,1
        ]"
            :sequence="[3,4,8]"
{{--            :fill_sample="[--}}
{{--        1,2,0,0,--}}
{{--        0,1,2,4,--}}
{{--        4,3,1,0,--}}
{{--        0,0,3,1,--}}
{{--        ]"--}}
{{--            :sequence="[3,5,12,4,13,14]"--}}
            :game_mode="{{ 0 }}"
            :game_speed="{{ 0 }}"
            :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>

@endsection
