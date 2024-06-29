@extends('layouts.app')

@section('main')

    {{--    <paint-ladder--}}
    {{--        :items="{{json_encode([--}}
    {{--            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],--}}
    {{--            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],--}}
    {{--            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],--}}
    {{--            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],--}}
    {{--        ])}}"--}}
    {{--        :size="[5,6]"--}}
    {{--        :select_cols="[1,3]"--}}
    {{--        :order_to_resolve="[5,10,15,20,25,30]"--}}
    {{--        :solution="[26,28,23,18]"--}}
    {{--        :fill_sample="[--}}
    {{--        0,0,0,0,0,--}}
    {{--        0,0,0,0,1,--}}
    {{--        0,0,0,1,1,--}}
    {{--        0,0,1,1,1,--}}
    {{--        0,1,1,1,1,--}}
    {{--        1,1,1,1,1,--}}
    {{--        ]"--}}
    {{--        :level="[{{$levelNumber}},{{$activityNumber}}]"--}}
    {{--        :rotate="false"--}}
    {{--    ></paint-ladder>--}}

    {{--    <pixel-art></pixel-art>--}}



    <pixel-art
            :items="{{json_encode([
//            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
//            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
            ['name' => 'Gris', 'type' => 'COLOR', 'content' => 'bg-gray-700', 'hex' => '#334155' , 'group' => 'Color'],
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
            :size="[2,2]"
            :solution="[1,1,1]"
            :fill_sample="[
        1,2,
        3,4,
        ]"
            :level="[{{$levelNumber}},{{$activityNumber}}]"
            :rotate="false"
            :fake_items="[]"
            create_audio_1="¡Bienvenidos al emocionante viaje por el espacio! ,  ¡Vamos a empezar con algo divertido!, "
            create_audio_2=""
            create_audio_3=""
            draw="2"
    ></pixel-art>

    {{--    <cache-test--}}
    {{--        :items="{{json_encode([--}}
    {{--            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],--}}
    {{--            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],--}}
    {{--            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],--}}
    {{--            ['name' => 'Gris', 'type' => 'COLOR', 'content' => 'bg-gray-700', 'hex' => '#334155' , 'group' => 'Color'],--}}
    {{--        ])}}"--}}
    {{--        :size="[2,2]"--}}
    {{--        :solution="[1,1,1]"--}}
    {{--        :fill_sample="[--}}
    {{--        1,2,--}}
    {{--        3,4,--}}
    {{--        ]"--}}
    {{--        :level="[{{$levelNumber}},{{$activityNumber}}]"--}}
    {{--        :rotate="false"--}}
    {{--        :fake_items="[]"--}}
    {{--        create_audio_1="¡Bienvenidos al emocionante viaje por el espacio! ,  ¡Vamos a empezar con algo divertido!, "--}}
    {{--        create_audio_2=""--}}
    {{--        create_audio_3=""--}}
    {{--  ></cache-test>--}}

@endsection
