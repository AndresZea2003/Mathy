@extends('layouts.app')

@section('main')

    <select-activity
        :level="[{{1}},{{$activityNumber}}]"
    ></select-activity>

@endsection
