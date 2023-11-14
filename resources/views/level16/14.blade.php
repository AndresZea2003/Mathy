@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'La pina', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/pina.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'La papaya', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/papaya.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'El mango', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/mango.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
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
