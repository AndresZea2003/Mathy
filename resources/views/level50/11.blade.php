@extends('layouts.app')

@section('main')
<pixel-art
        :items="{{json_encode([
        ['name' => 'Azul claro', 'type' => 'COLOR', 'content' => 'bg-sky-500', 'hex' => '#0EA5E9' , 'group' => 'Color'],
        ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
        ['name' => 'Negro', 'type' => 'COLOR', 'content' => 'bg-zinc-900', 'hex' => '#19191C' , 'group' => 'Color'],
        ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        draw="6"
></pixel-art>
@endsection


