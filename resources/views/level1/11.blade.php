@extends('layouts.app')

@section('main')

    {{--  <paint-pattern--}}
    {{--        :items="{{json_encode([--}}
    {{--            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],--}}
    {{--            ['name' => 'A', 'type' => 'LETTER', 'content' => 'a', 'group' => 'Letra'],--}}
    {{--            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],--}}
    {{--            ['name' => 'Lahormiga', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/hormiga.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],--}}
    {{--        ])}}"--}}
    {{--        :size="[2,2]"--}}
    {{--        :solution="[1,1,1]"--}}
    {{--        :fill_sample="[--}}
    {{--        1,2,--}}
    {{--        3,4,--}}
    {{--        ]"--}}
    {{--        :level="[{{$levelNumber}},{{$activityNumber}}]"--}}
    {{--        :rotate="false"--}}
    {{--    ></paint-pattern>--}}

    <paint-ladder
            :items="{{json_encode([
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
            :size="[6,6]"
            :select_cols="[1,3,5]"
            :order_to_resolve="[5,10,15,20,25,30]"
            :solution="[31,33,35,27,29,21,23,17,11]"
            :fill_sample="[
        0,0,0,0,0,1,
        0,0,0,0,1,1,
        0,0,0,1,1,1,
        0,0,1,1,1,1,
        0,1,1,1,1,1,
        1,1,1,1,1,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :fake_items="[1,2,3]"
{{--            :show_ids="true"--}}
    ></paint-ladder>

@endsection
