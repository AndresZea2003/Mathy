@extends('layouts.app')

@section('main')

    <pixel-art
        :items="{{json_encode([
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#F8CC18' , 'group' => 'Color'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-500', 'hex' => '#3B82F6' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :fake_items="[]"
        draw="13"
    ></pixel-art>


@endsection

