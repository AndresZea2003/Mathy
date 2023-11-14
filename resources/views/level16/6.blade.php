@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Eltiburon', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/tiburon.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Elcangrejo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/cangrejo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Elpulpo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/pulpo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Balon dorado', 'type' => 'IMAGE', 'content' => asset('/images/objects/ballon-dorado.svg'), 'size' => 'BIG', 'group' => 'Imagen']
        ])}}"
        :size="{{3}}"
        :order_to_resolve="[4,1,8,9]"
        :solution="[3,2,2,3]"
        :fill_sudoku="[
        0,3,1,
        0,1,2,
        1,0,0
        ]"
        :selectors="[
        [2,0],
        [1,1],
        [0,2],
        [3,3],
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>

@endsection
