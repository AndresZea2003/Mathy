@extends('layouts.app')

@section('main')

    <pixel-art
        :items="{{json_encode([
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-amber-400', 'hex' => '#EEBF33' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :fake_items="[]"
        draw="17"
    ></pixel-art>


@endsection

