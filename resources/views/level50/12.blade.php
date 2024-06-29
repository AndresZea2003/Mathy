@extends('layouts.app')

@section('main')
        <paint-pattern
                :items="{{json_encode([
                        ['name' => 'Morado', 'type' => 'COLOR', 'content' => 'bg-violet-600', 'hex' => '#793FEE' , 'group' => 'Color'],
                        ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-700', 'hex' => '#1D4ED8' , 'group' => 'Color'],
                ])}}"
                :size="[3,3]"
                :fill_sample="[
                1,1,1,
                1,2,1,
                1,1,1,
                ]"
                :level="[{{$levelNumber}},{{$activityNumber}}]"
                :rotate="true"
                :fake_items="[]"
                :phase="{{ 3 }}"
        ></paint-pattern>
@endsection
