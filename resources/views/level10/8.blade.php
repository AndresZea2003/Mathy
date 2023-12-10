@extends('layouts.app')

@section('main')

    <paint-permutations
        :items="{{json_encode([
            ['name' => 'Morado', 'type' => 'COLOR', 'content' => 'bg-[#572364]', 'hex' => '#572364' , 'group' => 'Color'],
            ['name' => 'Naranja', 'type' => 'COLOR', 'content' => 'bg-orange-400', 'hex' => '#fb923c' , 'group' => 'Color'],
            ['name' => 'Negro', 'type' => 'COLOR', 'content' => 'bg-black', 'hex' => '#000000' , 'group' => 'Color'],
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
