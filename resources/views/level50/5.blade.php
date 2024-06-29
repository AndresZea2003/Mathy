@extends('layouts.app')

@section('main')
    <paint-pattern
        :items="{{json_encode([
            ['name' => 'Naranja', 'type' => 'COLOR', 'content' => 'bg-orange-600', 'hex' => '#E35C16' , 'group' => 'Color'],
            ['name' => 'Azul claro', 'type' => 'COLOR', 'content' => 'bg-sky-400', 'hex' => '#37BDF8' , 'group' => 'Color'],
        ])}}"
        :size="[2,2]"
        :fill_sample="[
        1,2,
        2,1
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="true"
        :fake_items="[]"
        :phase="{{ 3 }}"
    ></paint-pattern>
@endsection
