@extends('layouts.app')

@section('main')

{{--    <select-level></select-level>--}}

    <menu-test :currentShipStorage="'shipSelected'" unlocked_levels_storage="unlockedLevels" test="dad"></menu-test>
@endsection
