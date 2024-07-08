@extends('layouts.app')

@section('main')

    <pixel-art
        :items="{{json_encode([
            ['name' => 'Rojo', 'type' => 'COLOR', 'content' => 'bg-red-600', 'hex' => '#dc2626' , 'group' => 'Color'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-800', 'hex' => '#1E40B0' , 'group' => 'Color'],                ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-500', 'hex' => '#EAB308' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :fake_items="[]"
        draw="11"
    ></pixel-art>


@endsection

