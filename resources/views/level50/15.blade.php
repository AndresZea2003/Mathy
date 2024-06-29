@extends('layouts.app')

@section('main')
        <paint-pattern
                :items="{{json_encode([
                        ['name' => 'Nave1', 'type' => 'IMAGE', 'content' => asset('/images/rockets/Cohetes-01.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],
                        ['name' => 'Nave2', 'type' => 'IMAGE', 'content' => asset('/images/rockets/Cohetes-06.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],
                        ['name' => 'Nave3', 'type' => 'IMAGE', 'content' => asset('/images/rockets/Cohetes-08.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],
                ])}}"
                :size="[3,3]"
                :fill_sample="[
                1,1,1,
                2,2,2,
                3,3,3,
                ]"
                :level="[{{$levelNumber}},{{$activityNumber}}]"
                :rotate="false"
                :fake_items="[]"
                :phase="{{ 3 }}"
        ></paint-pattern>
@endsection
