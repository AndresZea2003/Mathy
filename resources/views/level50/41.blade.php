@extends('layouts.app')

@section('main')
        <paint-pattern
                :items="{{json_encode([
                        ['name' => 'Frutas1', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/manzanasCantidad1.png'), 'size' => 'BIG', 'group' => 'Fruits'],
                        ['name' => 'Frutas2', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/manzanasCantidad2.png'), 'size' => 'BIG', 'group' => 'Fruits'],
                        ['name' => 'Frutas3', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/manzanasCantidad3.png'), 'size' => 'BIG', 'group' => 'Fruits'],
                        ['name' => 'Frutas3', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/manzanasCantidad4.png'), 'size' => 'BIG', 'group' => 'Fruits'],
                ])}}"
                :size="[2,2]"
                :fill_sample="[
                1,2,
                3,4
                ]"
                :level="[{{$levelNumber}},{{$activityNumber}}]"
                :rotate="false"
                :fake_items="[]"
                :phase="{{ 3 }}"
        ></paint-pattern>
@endsection
