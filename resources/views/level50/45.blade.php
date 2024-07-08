@extends('layouts.app')

@section('main')

    <pixel-art
        :items="{{json_encode([
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#17A34B' , 'group' => 'Color'],
            ['name' => 'Naranja', 'type' => 'COLOR', 'content' => 'bg-orange-500', 'hex' => '#F97316' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :fake_items="[]"
        draw="12"
    ></pixel-art>


@endsection

