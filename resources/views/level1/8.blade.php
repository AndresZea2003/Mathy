@extends('layouts.app')

@section('main')

{{--    <paint-pattern--}}
{{--        :items="{{json_encode([--}}
{{--            ['name' => 'Lahormiga', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/hormiga.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],--}}
{{--            ['name' => 'Laabeja', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/abeja.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],--}}
{{--            ['name' => 'Elgrillo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/grillo.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],--}}
{{--            ['name' => 'Elcangrejo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/cangrejo.svg'), 'size' => 'BIG', 'group' => 'Animal'],--}}
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

    <paint-pattern
        :items="{{json_encode([
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],
        ])}}"
        :size="[2,2]"
        :solution="[1,1,1]"
        :fill_sample="[
        1,2,
        2,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :fake_items="[]"
        :phase="{{ 3 }}"
{{--        create_audio_1="¡Bienvenidos al emocionante viaje por el espacio! ,  ¡Vamos a empezar con algo divertido!, "--}}
{{--        create_audio_2=""--}}
{{--        create_audio_3=""--}}
    ></paint-pattern>


@endsection
