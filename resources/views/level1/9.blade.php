@extends('layouts.app')

@section('main')

    <paint-pattern
        :items="{{json_encode([
            ['name' => 'La pina', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/pina.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'La papaya', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/papaya.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'El mango', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/mango.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'Las bananas', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/bananas.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
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
