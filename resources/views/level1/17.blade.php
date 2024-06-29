@extends('layouts.app')

@section('main')
    <paint-pattern
        :items="{{json_encode([
            ['name' => 'Caballo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Caballo.png'), 'group' => 'Imagen'],
            ['name' => 'Pollo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Pollo.png'), 'group' => 'Imagen'],
            ['name' => 'Cerdo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Cerdo.png'), 'group' => 'Imagen'],
            ['name' => 'Vaca', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/Vaca.png'), 'group' => 'Imagen'],
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
    ></paint-pattern>
@endsection
