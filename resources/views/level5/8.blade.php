@extends('layouts.app')

@section('main')

    <paint-ladder
        :items="{{json_encode([
            ['name' => 'Azul Claro', 'type' => 'COLOR', 'content' => 'bg-[#00aae4]', 'hex' => '#00aae4' , 'group' => 'Color'],
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],
        ])}}"
        :size="[10,10]"
        :select_cols="[5,6]"
        :order_to_resolve="[5,10,15,20,25,30]"
        :solution="[45,55,65,75,85,95,96,86,76,66,56]"
        :fill_sample="[
        1,1,1,1,1,1,1,1,1,1,
        0,1,0,1,0,1,0,1,0,1,
        0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,0,0,0,0,0,
        1,1,1,1,1,1,1,1,1,1,
        1,1,1,1,1,1,1,1,1,1,
        0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,0,0,0,0,0,
        0,1,0,1,0,1,0,1,0,1,
        1,1,1,1,1,1,1,1,1,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
    ></paint-ladder>

@endsection
