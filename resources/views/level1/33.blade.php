@extends('layouts.app')

@section('main')
    <line-paint-pattern
        :items="{{json_encode([
            ['name' => 'A', 'type' => 'LETTER', 'content' => 'A', 'group' => 'Letra'],
            ['name' => 'B', 'type' => 'LETTER', 'content' => 'B', 'group' => 'Letra'],
            ['name' => 'C', 'type' => 'LETTER', 'content' => 'C', 'group' => 'Letra'],
        ])}}"
        :size="{{18}}"
        :solution="[1,2,3]"
        :fill_sample="[
        1,2,3,1,2,3
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :fake_items="[]"
        :phase="{{ 3 }}"
    ></line-paint-pattern>

@endsection
