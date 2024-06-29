@extends('layouts.app')

@section('main')
<pixel-art
        :items="{{json_encode([
        ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16A44B' , 'group' => 'Color'],
        ['name' => 'Cafe', 'type' => 'COLOR', 'content' => 'bg-amber-900', 'hex' => '#773611' , 'group' => 'Color'],
        ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        draw="7"
></pixel-art>
@endsection


