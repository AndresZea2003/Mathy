@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Gris', 'type' => 'COLOR', 'content' => 'bg-gray-500', 'hex' => '#6b7280' , 'group' => 'Color'],
            ['name' => 'Fucsia', 'type' => 'COLOR', 'content' => 'bg-fuchsia-600', 'hex' => '#c026d3' , 'group' => 'Color'],
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
            ['name' => 'Balon dorado', 'type' => 'IMAGE', 'content' => asset('/images/objects/ballon-dorado.svg'), 'size' => 'BIG', 'group' => 'Imagen']
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
