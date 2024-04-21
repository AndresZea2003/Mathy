@extends('layouts.app')

@section('main')

    <paint-pattern
        :items="{{json_encode([
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
        ])}}"
        :size="[4,4]"
        :solution="[1,1,1]"
        :fill_sample="[
        2,1,2,1,
        1,2,1,2,
        2,1,2,1,
        1,2,1,2,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="true"
        :fake_items="[2,3]"
        create_audio_1=""
        create_audio_2=""
        create_audio_3=""
    ></paint-pattern>

@endsection
