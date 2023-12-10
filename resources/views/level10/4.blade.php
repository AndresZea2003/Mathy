@extends('layouts.app')

@section('main')

    <paint-permutations
        :items="{{json_encode([
            ['name' => 'Elcaballo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/caballo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Lavaca', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/vaca.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Elcerdo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/cerdo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :order_to_resolve="[3,5,6,9,11,12,15,17,18]"
        :size="[2,2]"
        :solution="[2,2,3,1,1,2,3,3,1]"
{{--        :solution="[3,3,3,3,3,3,3,3,3]"--}}
        :fill_sample="[
        1,3,2,
        1,2,3,
        3,2,1,
        3,1,2,
        2,1,3,
        2,3,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
    ></paint-permutations>

@endsection
