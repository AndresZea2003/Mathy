@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Rosa', 'type' => 'COLOR', 'content' => 'bg-rose-400', 'hex' => '#fb7185' , 'group' => 'Color'],
            ['name' => 'Violeta', 'type' => 'COLOR', 'content' => 'bg-[#78288C]', 'hex' => '#78288C' , 'group' => 'Color'],
            ['name' => 'Azul Claro', 'type' => 'COLOR', 'content' => 'bg-[#00aae4]', 'hex' => '#00aae4' , 'group' => 'Color'],
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
