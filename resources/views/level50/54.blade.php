@extends('layouts.app')

@section('main')

    <line-paint-pattern
        :items="{{json_encode([
            ['name' => 'A', 'type' => 'LETTER', 'content' => 'A', 'group' => 'Letra'],
            ['name' => 'E', 'type' => 'LETTER', 'content' => 'B', 'group' => 'Letra'],
            ['name' => 'I', 'type' => 'LETTER', 'content' => 'C', 'group' => 'Letra'],
            ['name' => 'O', 'type' => 'LETTER', 'content' => 'B', 'group' => 'Letra'],
            ['name' => 'U', 'type' => 'LETTER', 'content' => 'C', 'group' => 'Letra'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        type="number"
        :size="{{15}}"
        :solution="[1,2,3,4,5]"
        :fill_sample="[
        1,2,3,4,5
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :phase="{{ 3 }}"
    ></line-paint-pattern>

@endsection
