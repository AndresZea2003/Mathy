@extends('layouts.app')

@section('main')

    <line-paint-pattern
        :items="{{json_encode([
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Naranja', 'type' => 'COLOR', 'content' => 'bg-orange-400', 'hex' => '#fb923c' , 'group' => 'Color'],
            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],
            ['name' => 'Rosa', 'type' => 'COLOR', 'content' => 'bg-rose-400', 'hex' => '#fb7185' , 'group' => 'Color'],
        ])}}"
        :size="{{18}}"
        :solution="[4,2]"
        :fill_sample="[
        4,2,4,2,4,2,4,2,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :fake_items="[0,2]"
        :phase="{{ 1 }}"
    ></line-paint-pattern>

@endsection
