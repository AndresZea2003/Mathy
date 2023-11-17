@extends('layouts.app')

@section('main')

    <paint-pattern
        :items="{{json_encode([
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
            ['name' => 'Gris', 'type' => 'COLOR', 'content' => 'bg-gray-700', 'hex' => '#334155' , 'group' => 'Color'],
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Rosa', 'type' => 'COLOR', 'content' => 'bg-rose-400', 'hex' => '#fb7185' , 'group' => 'Color'],
        ])}}"
        :size="[7,7]"
        :solution="[1,1,1]"
        :fill_sample="[
        2,2,2,2,2,2,2,
        2,3,3,3,3,3,2,
        2,3,1,1,1,3,2,
        2,3,1,4,1,3,2,
        2,3,1,1,1,3,2,
        2,3,3,3,3,3,2,
        2,2,2,2,2,2,2,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
    ></paint-pattern>

@endsection
