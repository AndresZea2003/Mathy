@extends('layouts.app')

@section('main')

    <paint-pattern
        :items="{{json_encode([
            ['name' => 'Lahormiga', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/hormiga.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],
            ['name' => 'Laabeja', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/abeja.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],
            ['name' => 'Elgrillo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/grillo.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],
            ['name' => 'Elcangrejo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/cangrejo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
        ])}}"
        :size="[2,2]"
        :solution="[1,1,1]"
        :fill_sample="[
        1,2,
        3,4,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
    ></paint-pattern>

@endsection
