@extends('layouts.app')

@section('main')

    <paint-pattern
        :items="{{json_encode([
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
        ])}}"
        :size="[2,2]"
        :solution="[1,1,1]"
        :fill_sample="[
        1,2,
        3,4,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="true"
        create_audio_1="Nuevamente hubo un giro en el cuadro de la izquierda. Colorea de forma idéntica el cuadro de la derecha"
{{--        create_audio_2="Sigue utilizando los colores."--}}
{{--        create_audio_3="Para completar este reto"--}}
        :show_help="{{ 3 }}"
    ></paint-pattern>


@endsection
