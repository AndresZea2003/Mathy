@extends('layouts.app')

@section('main')

    <select-activity
        :level="[{{$activityNumber}},{{9}}]"
        planet="venus.jpg"
        color_text="text-green-900"
        color_card="bg-[url('https://cdn.pixabay.com/photo/2018/04/21/01/36/green-3337499_1280.png')]"
        planet_name="Venus"
    ></select-activity>

@endsection
