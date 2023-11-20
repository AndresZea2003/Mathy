@extends('layouts.app')

@section('main')

    <select-activity
        :level="[{{2}},{{$activityNumber}}]"
        planet="{{asset('/images/planets/rojo.svg')}}"
    ></select-activity>

@endsection
