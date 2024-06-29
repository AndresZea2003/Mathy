@extends('layouts.app')

@section('main')
    <paint-pattern
        :items="{{json_encode([
            ['name' => 'A', 'type' => 'LETTER', 'content' => 'A', 'group' => 'Letra'],
            ['name' => 'B', 'type' => 'LETTER', 'content' => 'B', 'group' => 'Letra'],
            ['name' => 'C', 'type' => 'LETTER', 'content' => 'C', 'group' => 'Letra'],
            ['name' => 'D', 'type' => 'LETTER', 'content' => 'D', 'group' => 'Letra'],
        ])}}"
        :size="[2,2]"
        :fill_sample="[
        1,2,
        3,4,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="true"
        :show_help="{{ 1 }}"
        :phase="{{ 3 }}"
    ></paint-pattern>
@endsection
