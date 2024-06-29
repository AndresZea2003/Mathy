@extends('layouts.app')

@section('main')
        <line-paint-pattern
                :items="{{json_encode([
                        ['name' => 'Azul claro 1', 'type' => 'COLOR', 'content' => 'bg-blue-300', 'hex' => '#8FC4FD' , 'group' => 'Color'],
                        ['name' => 'Azul claro 2', 'type' => 'COLOR', 'content' => 'bg-blue-500', 'hex' => '#3B82F6' , 'group' => 'Color'],
                        ['name' => 'Azul oscuro 1', 'type' => 'COLOR', 'content' => 'bg-blue-800', 'hex' => '#1F42B0' , 'group' => 'Color'],
                ])}}"
                :size="{{20}}"
                :solution="[1,1,2,2,3,3]"
                :fill_sample="[
                1,1,2,2,3,3
                ]"
                :level="[{{$levelNumber}},{{$activityNumber}}]"
                :fake_items="[2]"
                :phase="{{ 3 }}"
        ></line-paint-pattern>
@endsection
