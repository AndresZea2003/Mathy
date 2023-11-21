@extends('layouts.app')

@section('main')

{{--    <interactive-sudoku--}}
{{--        :items="{{json_encode([--}}
{{--            ['name' => 'Gris', 'type' => 'COLOR', 'content' => 'bg-gray-500', 'hex' => '#6b7280' , 'group' => 'Color'],--}}
{{--            ['name' => 'Fucsia', 'type' => 'COLOR', 'content' => 'bg-fuchsia-600', 'hex' => '#c026d3' , 'group' => 'Color'],--}}
{{--            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],--}}
{{--            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']--}}
{{--        ])}}"--}}
{{--        :size="{{3}}"--}}
{{--        :order_to_resolve="[3,9,4]"--}}
{{--        :solution="[1,3,3]"--}}
{{--        :fill_sudoku="[--}}
{{--        2,3,0,--}}
{{--        0,1,2,--}}
{{--        1,2,0--}}
{{--        ]"--}}
{{--        :selectors="[--}}
{{--        [1,0],--}}
{{--        [3,3],--}}
{{--        [2,1],--}}
{{--        ]"--}}
{{--        :level="[{{$levelNumber}},{{$activityNumber}}]"--}}
{{--    ></interactive-sudoku>--}}

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Las uvas', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/uvas.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'Las bananas', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/bananas.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'Las fresas', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/fresas.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'El mango', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/mango.svg'), 'size' => 'NORMAL', 'group' => 'Fruta'],
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
