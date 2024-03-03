@extends('layouts.app')

@section('main')

    <select-activity
        :level="[{{$activityNumber}},{{20}}]"
        planet="tierra.jfif"
        color_card="bg-blue-500"
        planet_name="Tierra"
    ></select-activity>

@endsection
