@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Elleon', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/leon.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Elcocodrilo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/cocodrilo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Elelefante', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/elefante.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Balon dorado', 'type' => 'IMAGE', 'content' => asset('/images/objects/ballon-dorado.svg'), 'size' => 'BIG', 'group' => 'Imagen']
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
