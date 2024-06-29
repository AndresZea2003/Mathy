@extends('layouts.app')

@section('main')

    <paint-ladder
        :items="{{json_encode([
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :size="[10,10]"
        :select_cols="[5,6]"
        :order_to_resolve="[5,10,15,20,25,30]"
        :solution="[55,65,75,85,95,96,86,76,66,56,46]"
        :fill_sample="[
        0,0,0,0,0,0,0,0,0,1,
        0,0,0,0,0,0,0,0,1,1,
        0,0,0,0,0,0,0,1,1,1,
        0,0,0,0,0,0,1,1,1,1,
        0,0,0,0,0,1,1,1,1,1,
        0,0,0,0,1,1,1,1,1,1,
        0,0,0,1,1,1,1,1,1,1,
        0,0,1,1,1,1,1,1,1,1,
        0,1,1,1,1,1,1,1,1,1,
        1,1,1,1,1,1,1,1,1,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :show_ids="false"
    ></paint-ladder>

@endsection
