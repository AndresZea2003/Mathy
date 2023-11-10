@extends('layouts.app')

@section('main')

    <interactive-sudoku
        :size="{{4}}"
        :order_to_resolve="[6,11,15]"
        :solution="[4,4,4]"
        :fill_sudoku="[
        2,2,3,1,
        3,0,2,1,
        2,3,0,1,
        2,3,0,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>


@endsection
