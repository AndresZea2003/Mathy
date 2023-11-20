@extends('layouts.app')

@section('main')

    <paint-permutations
        :items="{{json_encode([
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],
        ])}}"
        :order_to_resolve="[3,5,6,9,11,12,15,17,18]"
        :size="[2,2]"
{{--        :solution="[2,2,4,1,1,2,4,4,1]"--}}
        :solution="[3,3,3,3,3,3,3,3,3]"
        :fill_sample="[
        1,4,2,
        1,2,4,
        4,2,1,
        4,1,2,
        2,1,4,
        2,4,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
    ></paint-permutations>

@endsection
