@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Balon dorado', 'type' => 'IMAGE', 'content' => asset('/images/objects/ballon-dorado.svg'), 'size' => 'SMALL', 'group' => 'Imagen'],
            ['name' => 'Balon dorado', 'type' => 'IMAGE', 'content' => asset('/images/objects/ballon-dorado.svg'), 'size' => 'NORMAL', 'group' => 'Imagen'],
            ['name' => 'Balon dorado', 'type' => 'IMAGE', 'content' => asset('/images/objects/ballon-dorado.svg'), 'size' => 'BIG', 'group' => 'Imagen'],
            ['name' => 'Rosa', 'type' => 'COLOR', 'content' => 'bg-rose-400', 'hex' => '#fb7185' , 'group' => 'Color'],
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
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>

@endsection
