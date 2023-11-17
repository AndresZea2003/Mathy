@extends('layouts.app')

@section('main')

    <paint-ladder
        :items="{{json_encode([
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],
        ])}}"
        :size="[5,6]"
        :select_cols="[1,3]"
        :order_to_resolve="[5,10,15,20,25,30]"
        :solution="[26,28,23,18]"
        :fill_sample="[
        0,0,0,0,0,
        0,0,0,0,1,
        0,0,0,1,1,
        0,0,1,1,1,
        0,1,1,1,1,
        1,1,1,1,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
    ></paint-ladder>

{{--    <paint-ladder--}}
{{--        :items="{{json_encode([--}}
{{--            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],--}}
{{--            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],--}}
{{--            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],--}}
{{--            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],--}}
{{--        ])}}"--}}
{{--        :size="[10,10]"--}}
{{--        :select_cols="[5,6]"--}}
{{--        :order_to_resolve="[5,10,15,20,25,30]"--}}
{{--        :solution="[26,28,23,18]"--}}
{{--        :fill_sample="[--}}
{{--        1,0,0,0,0,0,0,0,0,0,--}}
{{--        1,1,0,0,0,0,0,0,0,0,--}}
{{--        1,1,1,0,0,0,0,0,0,0,--}}
{{--        1,1,1,1,0,0,0,0,0,0,--}}
{{--        1,1,1,1,1,0,0,0,0,0,--}}
{{--        1,1,1,1,1,1,0,0,0,0,--}}
{{--        1,1,1,1,1,1,1,0,0,0,--}}
{{--        1,1,1,1,1,1,1,1,0,0,--}}
{{--        1,1,1,1,1,1,1,1,1,0,--}}
{{--        1,1,1,1,1,1,1,1,1,1,--}}
{{--        ]"--}}
{{--        :level="[{{$levelNumber}},{{$activityNumber}}]"--}}
{{--        :rotate="false"--}}
{{--    ></paint-ladder>--}}

@endsection
