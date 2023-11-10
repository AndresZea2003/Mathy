@extends('layouts.app')

@section('main')

{{--    <basic-activity></basic-activity>--}}

    <interactive-sudoku
        :order_to_resolve="[1,5,9]"
        :fill_sudoku="[
        0,1,3,
        2,0,1,
        3,2,0
        ]"
    ></interactive-sudoku>
@endsection
