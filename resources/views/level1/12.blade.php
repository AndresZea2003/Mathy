@extends('layouts.app')

@section('main')

    <paint-ladder
        :items="{{json_encode([
            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :size="[5,6]"
        :select_cols="[5]"
        :solution="[10,15,20,25,30]"
        :fill_sample="[
        0,0,0,0,0,
        0,0,0,0,1,
        0,0,0,1,1,
        0,0,1,1,1,
        0,1,1,1,1,
        1,1,1,1,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :show_ids="false"
    ></paint-ladder>

@endsection
