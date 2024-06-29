@extends('layouts.app')

@section('main')
    <paint-pattern
        :items="{{json_encode([
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-lime-500', 'hex' => '#82CC19' , 'group' => 'Color'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-700', 'hex' => '#1D4ED8' , 'group' => 'Color'],
        ])}}"
        :size="[3,3]"
        :fill_sample="[
        1,1,1,
        1,2,1,
        1,1,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :fake_items="[]"
        :phase="{{ 3 }}"
    ></paint-pattern>
@endsection
