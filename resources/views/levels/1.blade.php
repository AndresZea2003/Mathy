@extends('layouts.app')

@section('main')

    <select-activity
        :level="[{{$activityNumber}},{{11}}]"
        planet="tierra.jfif"
        color_text="text-gray-600"
        color_card="bg-[url('https://cdn.pixabay.com/photo/2022/05/12/16/04/trees-7191822_1280.png')]"
        planet_name="Tierra"
    ></select-activity>

@endsection
