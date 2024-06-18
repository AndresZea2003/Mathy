@extends('layouts.app')

@section('main')
    <line-paint-pattern
        :items="{{json_encode([
            ['name' => 'Caballo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Caballo.png'), 'group' => 'Imagen'],
            ['name' => 'Pollo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Pollo.png'), 'group' => 'Imagen'],
            ['name' => 'Cerdo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Cerdo.png'), 'group' => 'Imagen'],
            ['name' => 'Vaca', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Vaca.png'), 'group' => 'Imagen'],
        ])}}"
        :size="{{20}}"
        :solution="[1,2,3,4]"
        :fill_sample="[
        1,2,3,4,1,2,3,4
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :fake_items="[]"
        :phase="{{ 3 }}"
    ></line-paint-pattern>

@endsection
