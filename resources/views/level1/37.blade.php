@extends('layouts.app')

@section('main')
    <paint-ladder
        :items="{{json_encode([
            ['name' => 'B', 'type' => 'LETTER', 'content' => 'B', 'group' => 'Letra'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :size="[5,6]"
        :select_cols="[4]"
        :solution="[14,19,24,29]"
        :fill_sample="[
        0,0,0,0,0,
        0,0,0,0,1,
        0,0,0,1,1,
        0,0,1,1,1,
        0,1,1,1,1,
        1,1,1,1,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :show_ids="false"
    ></paint-ladder>
@endsection
