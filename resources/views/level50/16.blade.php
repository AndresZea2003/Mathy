@extends('layouts.app')

@section('main')
        <line-paint-pattern
                :items="{{json_encode([
                        ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
                        ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
                ])}}"
                :size="{{18}}"
                :solution="[1,2,2,2,2,1]"
                :fill_sample="[
                1,2,2,2,2,1
                ]"
                :level="[{{$levelNumber}},{{$activityNumber}}]"
                :fake_items="[2]"
                :phase="{{ 3 }}"
        ></line-paint-pattern>
@endsection
