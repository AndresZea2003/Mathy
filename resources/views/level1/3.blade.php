@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :size="{{5}}"
        :order_to_resolve="[1,5,9]"
        :solution="[1,1,1]"
        :fill_sudoku="[
        0,2,3,2,3,
        3,0,2,0,2,
        2,3,0,3,0,
        1,1,1,1,1,
        0,2,3,2,3,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>


@endsection
