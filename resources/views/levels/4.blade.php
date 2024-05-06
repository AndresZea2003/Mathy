@extends('layouts.app')

@section('main')

    {{--    <test-naraket></test-naraket>--}}
    <select-activity
            :level="[{{$activityNumber}},{{12}}]"
            planet="venus.jpg"
            color_text="text-green-900"
            color_card="bg-[url('https://cdn.pixabay.com/photo/2021/07/15/05/06/flowers-6467492_1280.jpg')]"
            planet_name="Venus"
    ></select-activity>
@endsection

