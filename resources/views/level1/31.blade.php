@extends('layouts.app')

@section('main')

{{--    <paint-pattern--}}
{{--        :items="{{json_encode([--}}
{{--            ['name' => 'Lahormiga', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/hormiga.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],--}}
{{--            ['name' => 'Laabeja', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/abeja.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],--}}
{{--            ['name' => 'Elgrillo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/grillo.svg'), 'size' => 'NORMAL', 'group' => 'Animal'],--}}
{{--            ['name' => 'Elcangrejo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/cangrejo.svg'), 'size' => 'BIG', 'group' => 'Animal'],--}}
{{--        ])}}"--}}
{{--        :size="[2,2]"--}}
{{--        :solution="[1,1,1]"--}}
{{--        :fill_sample="[--}}
{{--        1,2,--}}
{{--        3,4,--}}
{{--        ]"--}}
{{--        :level="[{{$levelNumber}},{{$activityNumber}}]"--}}
{{--        :rotate="false"--}}
{{--    ></paint-pattern>--}}

    <paint-pattern
        :items="{{json_encode([
            ['name' => 'A', 'type' => 'LETTER', 'content' => 'A', 'group' => 'Letra'],
            ['name' => 'B', 'type' => 'LETTER', 'content' => 'B', 'group' => 'Letra'],
            ['name' => 'C', 'type' => 'LETTER', 'content' => 'C', 'group' => 'Letra'],
            ['name' => 'D', 'type' => 'LETTER', 'content' => 'D', 'group' => 'Letra'],
        ])}}"
        :size="[2,2]"
        :solution="[1,1,1]"
        :fill_sample="[
        1,2,
        2,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :fake_items="[]"
        :phase="{{ 3 }}"
    ></paint-pattern>


@endsection