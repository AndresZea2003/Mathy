@extends('layouts.app')

@section('main')

    <paint-permutations
        :items="{{json_encode([
            ['name' => 'Las uvas', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/uvas.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'Las bananas', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/bananas.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'Las fresas', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/fresas.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
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
