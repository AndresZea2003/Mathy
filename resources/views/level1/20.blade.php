@extends('layouts.app')

@section('main')
    <line-paint-pattern
        :items="{{json_encode([
            ['name' => 'Caballo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Caballo.png'), 'group' => 'Imagen'],
            ['name' => 'Pollo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Pollo.png'), 'group' => 'Imagen'],
            ['name' => 'Vaca', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Vaca.png'), 'group' => 'Imagen'],
        ])}}"
        :size="{{18}}"
        :solution="[1,2,3]"
        :fill_sample="[
        1,2,3,1,2,3
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :fake_items="[]"
        :phase="{{ 3 }}"
    ></line-paint-pattern>

@endsection
