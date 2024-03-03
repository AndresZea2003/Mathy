@extends('layouts.app')

@section('main')

    <select-activity
        :level="[{{$activityNumber}},{{20}}]"
        planet="marte.jfif"
        color_card="bg-red-500"
        planet_name="Marte"
    ></select-activity>

@endsection
