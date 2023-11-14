@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'ElPerro', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/perro.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'ElConejo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/conejo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'ElGato', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/gato.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Elpulpo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/pulpo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
        ])}}"
        :size="{{4}}"
        :order_to_resolve="[15,3,5,12,2,8]"
        :solution="[1,2,2,2,1,1]"
        :fill_sudoku="[
        4,0,0,3,
        0,4,3,0,
        1,3,4,0,
        3,2,0,4,
        ]"
        :selectors="[
        [4,0],
        [0,3],
        [0,1],
        [3,0],
        [1,2],
        [2,4]
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>

@endsection
