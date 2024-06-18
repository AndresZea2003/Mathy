@extends('layouts.app')

@section('main')
    <pixel-art
            :items="{{json_encode([
            ['name' => 'Gris', 'type' => 'COLOR', 'content' => 'bg-gray-700', 'hex' => '#334155' , 'group' => 'Color'],
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
            :level="[{{$levelNumber}},{{$activityNumber}}]"
            draw="2"
    ></pixel-art>
@endsection
