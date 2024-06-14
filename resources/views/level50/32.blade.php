@extends('layouts.app')

@section('main')

    <cache-test
        :items="{{json_encode([
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],
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
    ></cache-test>

{{--     <paint-permutations--}}
{{--            :items="{{json_encode([--}}
{{--                ['name' => '1', 'type' => 'NUMBER', 'content' => '1', 'group' => 'Numero'],--}}
{{--                ['name' => '3', 'type' => 'NUMBER', 'content' => '3', 'group' => 'Numero'],--}}
{{--                ['name' => '2', 'type' => 'NUMBER', 'content' => '2', 'group' => 'Numero'],--}}
{{--                ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']--}}
{{--            ])}}"--}}
{{--            type="numbers"--}}
{{--            :boxes_for_group="{{ 3 }}"--}}
{{--            :show_groups="{{ 6 }}"--}}
{{--            :show_fake_row="false"--}}
{{--            :show_animate_progress="false"--}}
{{--            :fill_sample="[--}}
{{--            1,3,0,--}}
{{--            1,0,0,--}}
{{--            3,2,0,--}}
{{--            3,0,0,--}}
{{--            2,1,0,--}}
{{--            2,0,0,--}}
{{--            ]"--}}
{{--            --}}{{--            create_audio_6="¡Bienvenidos al emocionante viaje por el espacio! ,  ¡Vamos a empezar con algo divertido!, "--}}
{{--            :level="[{{$levelNumber}},{{$activityNumber}}]"--}}
{{--    ></paint-permutations>--}}
@endsection
