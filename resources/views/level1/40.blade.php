@extends('layouts.app')

@section('main')
    <pixel-art
            :items="{{json_encode([
            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#D62B2E' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
            ])}}"
            :level="[{{$levelNumber}},{{$activityNumber}}]"
            draw="3"
    ></pixel-art>
@endsection
