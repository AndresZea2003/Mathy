@extends('layouts.app')

@section('main')
    <pixel-art
            :items="{{json_encode([
            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16A44B' , 'group' => 'Color'],
            ['name' => 'Gris', 'type' => 'COLOR', 'content' => 'bg-neutral-800', 'hex' => '#272929' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
            ])}}"
            :level="[{{$levelNumber}},{{$activityNumber}}]"
            draw="8"
    ></pixel-art>
@endsection
