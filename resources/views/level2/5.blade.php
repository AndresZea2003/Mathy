@extends('layouts.app')

@section('main')

    <line-paint-pattern
        :items="{{json_encode([
            ['name' => 'Lahormiga', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/hormiga.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],
            ['name' => 'Laabeja', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/abeja.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],
            ['name' => 'Elgrillo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/grillo.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :size="{{18}}"
        :solution="[1,2,3]"
        :fill_sample="[
        1,2,3,1,2,3,1,2,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        type=""
        :phase="{{ 3 }}"
    ></line-paint-pattern>

@endsection
