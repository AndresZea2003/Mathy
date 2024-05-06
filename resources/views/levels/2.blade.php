@extends('layouts.app')

@section('main')

    <select-activity
        :level="[{{$activityNumber}},{{9}}]"
        planet="marte.jfif"
        color_text="text-orange-900"
        color_card="bg-[url('https://cdn.pixabay.com/photo/2020/02/16/05/59/alien-4852662_1280.jpg')]"
        planet_name="Marte"
    ></select-activity>

@endsection
