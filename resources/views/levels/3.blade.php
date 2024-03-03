@extends('layouts.app')

@section('main')

    <select-activity
        :level="[{{$activityNumber}},{{5}}]"
        planet="venus.jpg"
        color_card="bg-stone-500"
        planet_name="Venus"
    ></select-activity>

@endsection
