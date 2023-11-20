@extends('layouts.app')

@section('main')

    <select-activity
        :level="[{{1}},{{$activityNumber}}]"
        planet="{{asset('/images/planets/tierra.svg')}}"
    ></select-activity>

@endsection
