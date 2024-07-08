@extends('layouts.app')

@section('main')

    <pixel-art
        :items="{{json_encode([
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-sky-500', 'hex' => '#0EA6E9' , 'group' => 'Color'],
            ['name' => 'Gris', 'type' => 'COLOR', 'content' => 'bg-gray-500', 'hex' => '#6B7380' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :fake_items="[]"
        draw="18"
    ></pixel-art>


@endsection

