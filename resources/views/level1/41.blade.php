@extends('layouts.app')

@section('main')

    <paint-pattern
        :items="{{json_encode([
            ['name' => '1', 'type' => 'NUMBER', 'content' => '1', 'group' => 'Numero'],
            ['name' => '2', 'type' => 'NUMBER', 'content' => '2', 'group' => 'Numero'],
            ['name' => '3', 'type' => 'NUMBER', 'content' => '3', 'group' => 'Numero'],
            ['name' => '4', 'type' => 'NUMBER', 'content' => '4', 'group' => 'Numero'],
        ])}}"
        :size="[2,2]"
        :solution="[1,1,1]"
        :fill_sample="[
        1,2,
        3,4,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :fake_items="[]"
        :phase="{{ 3 }}"
    ></paint-pattern>

@endsection
