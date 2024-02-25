@extends('layouts.app')

@section('main')

    <select-activity
        :level="[{{$activityNumber}},{{20}}]"
        planet="marte"
    ></select-activity>

@endsection
