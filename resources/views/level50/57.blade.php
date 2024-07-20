@extends('layouts.app')

@section('main')

    <interactive-sudoku
            :items="{{json_encode([
            ['name' => 'Pina', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/pina.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'Naranja', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/naranja.svg'), 'size' => 'SMALL', 'group' => 'Fruta'],
            ['name' => 'Sandia', 'type' => 'IMAGE', 'content' => asset('/images/items/fruits/sandia.svg'), 'size' => 'BIG', 'group' => 'Fruta'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
            :size="{{3}}"
            :fill_sample="[
            1,2,3,
            0,1,2,
            2,0,1
            ]"
            :sequence="[3,4,5]"
            :game_mode="{{ 0 }}"
            :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>

@endsection
