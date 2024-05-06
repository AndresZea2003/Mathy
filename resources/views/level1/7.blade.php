@extends('layouts.app')

@section('main')

    <line-paint-pattern
            :items="{{json_encode([
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
//            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],
//            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
        ])}}"
            :size="{{18}}"
            :solution="[1,2,2]"
            :fill_sample="[
                1,2,2,1,2,2,1
            ]"
            :level="[{{$levelNumber}},{{$activityNumber}}]"
            :rotate="false"
            :fake_items="[]"
            :phase="{{ 3 }}"
            {{--        create_audio_1="¡Mira cómo progresa nuestra nave en el viaje a Marte! ¡Sigamos enfrentando desafíos!"--}}
            {{--        create_audio_2="Estás haciendo un excelente trabajo. Para esta ocasión, utilizaremos los colores ..."--}}
            {{--        create_audio_3="De la siguiente manera..."--}}
    ></line-paint-pattern>

@endsection
