@extends('layouts.app')

@section('main')
<line-paint-pattern
        :items="{{json_encode([
            ['name' => 'Caballo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Caballo.png'), 'group' => 'Imagen'],
            ['name' => 'Pollo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Pollo.png'), 'group' => 'Imagen'],
            ['name' => 'Vaca', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Vaca.png'), 'group' => 'Imagen'],
        ])}}"
        :size="{{18}}"
        :solution="[1,2]"
        :fill_sample="[
        1,2,1,2,1,2
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :fake_items="[2]"
        create_audio_1="¡Mira cómo progresa nuestra nave en el viaje a Marte! ¡Sigamos enfrentando desafíos!"
        create_audio_2="La cinta que está en el centro, la debemos colorear únicamente de..."
        create_audio_3="Presta mucha atención."
        :phase="{{ 3 }}"
    ></line-paint-pattern>
@endsection
