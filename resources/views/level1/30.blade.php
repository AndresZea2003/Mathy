@extends('layouts.app')

@section('main')

    <paint-pattern
        :items="{{json_encode([
            ['name' => 'D', 'type' => 'LETTER', 'content' => 'D', 'group' => 'Letra'],
            ['name' => 'C', 'type' => 'LETTER', 'content' => 'C', 'group' => 'Letra'],
            ['name' => 'B', 'type' => 'LETTER', 'content' => 'B', 'group' => 'Letra'],
            ['name' => 'A', 'type' => 'LETTER', 'content' => 'A', 'group' => 'Letra'],
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
        :phase="{{ 3 }}"
    ></paint-pattern>


@endsection
