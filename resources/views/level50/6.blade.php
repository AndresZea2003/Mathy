@extends('layouts.app')

@section('main')
    <paint-pattern
        :items="{{json_encode([
            ['name' => 'Fucsia', 'type' => 'COLOR', 'content' => 'bg-fuchsia-800', 'hex' => '#851C91' , 'group' => 'Color'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-800', 'hex' => '#1E41B0' , 'group' => 'Color'],
        ])}}"
        :size="[3,3]"
        :fill_sample="[
        1,2,1,
        2,1,2,
        1,2,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :fake_items="[]"
        :phase="{{ 3 }}"
    ></paint-pattern>
@endsection
