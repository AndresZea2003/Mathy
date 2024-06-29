@extends('layouts.app')

@section('main')
    <paint-pattern
        :items="{{json_encode([
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
        ])}}"
        :size="[2,2]"
        :fill_sample="[
        1,2,
        1,2,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :fake_items="[]"
        :phase="{{ 3 }}"
    ></paint-pattern>
@endsection
