@extends('layouts.app')

@section('main')

    <paint-pattern
        :items="{{json_encode([
            ['name' => 'Gris', 'type' => 'COLOR', 'content' => 'bg-gray-700', 'hex' => '#334155' , 'group' => 'Color'],
            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
        ])}}"
        :size="[3,3]"
        :solution="[1,1,1]"
        :fill_sample="[
        3,2,1,
        1,3,2,
        2,1,3,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="true"
        :fake_items="[3]"
    ></paint-pattern>

@endsection
