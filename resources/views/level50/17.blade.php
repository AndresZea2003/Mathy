@extends('layouts.app')

@section('main')
        <line-paint-pattern
                :items="{{json_encode([
                        ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
                        ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-700', 'hex' => '#B71E20' , 'group' => 'Color'],
                ])}}"
                :size="{{20}}"
                :solution="[1,1,2,2,2]"
                :fill_sample="[
                1,1,2,2,2
                ]"
                :level="[{{$levelNumber}},{{$activityNumber}}]"
                :fake_items="[2]"
                :phase="{{ 3 }}"
        ></line-paint-pattern>
@endsection
