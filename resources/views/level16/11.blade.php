@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :items="{{json_encode([
            ['name' => 'Morado', 'type' => 'COLOR', 'content' => 'bg-[#572364]', 'hex' => '#572364' , 'group' => 'Color'],
            ['name' => 'Naranja', 'type' => 'COLOR', 'content' => 'bg-orange-400', 'hex' => '#fb923c' , 'group' => 'Color'],
            ['name' => 'Negro', 'type' => 'COLOR', 'content' => 'bg-black', 'hex' => '#000000' , 'group' => 'Color'],
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
