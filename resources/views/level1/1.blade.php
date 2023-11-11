@extends('layouts.app')

@section('main')

{{--    <basic-activity></basic-activity>--}}

    <interactive-sudoku
        :size="{{3}}"
        :order_to_resolve="[1,5,9]"
        :solution="[1,1,1]"
        :fill_sudoku="[
        0,2,3,
        3,0,2,
        2,3,0
        ]"
        :selectors="[
        [1,1],
        [2,2],
        [3,3],
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
    ></interactive-sudoku>

@endsection
