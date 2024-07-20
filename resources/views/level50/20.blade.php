@extends('layouts.app')

@section('main')

    <line-paint-pattern
        :items="{{json_encode([
            ['name' => '1', 'type' => 'NUMBER', 'content' => '1', 'group' => 'Numero'],
            ['name' => '2', 'type' => 'NUMBER', 'content' => '2', 'group' => 'Numero'],
            ['name' => '3', 'type' => 'NUMBER', 'content' => '3', 'group' => 'Numero'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        type="number"
        :size="{{18}}"
        :solution="[1,2,3]"
        :fill_sample="[
        1,2,3,1,2,3
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :phase="{{ 3 }}"
    ></line-paint-pattern>

@endsection
