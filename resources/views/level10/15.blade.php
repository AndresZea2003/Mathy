@extends('layouts.app')

@section('main')

    {{--    <paint-permutations--}}
    {{--        :items="{{json_encode([--}}
    {{--            ['name' => 'Eltiburon', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/tiburon.svg'), 'size' => 'BIG', 'group' => 'Animal'],--}}
    {{--            ['name' => 'Elcangrejo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/cangrejo.svg'), 'size' => 'BIG', 'group' => 'Animal'],--}}
    {{--            ['name' => 'Elpulpo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/pulpo.svg'), 'size' => 'BIG', 'group' => 'Animal'],--}}
    {{--            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']--}}
    {{--        ])}}"--}}
    {{--        :order_to_resolve="[3,5,6,9,11,12,15,17,18]"--}}
    {{--        :size="[2,2]"--}}
    {{--        :solution="[2,2,3,1,1,2,3,3,1]"--}}
    {{--        :solution="[3,3,3,3,3,3,3,3,3]"--}}
    {{--        :fill_sample="[--}}
    {{--        1,3,2,--}}
    {{--        1,2,3,--}}
    {{--        3,2,1,--}}
    {{--        3,1,2,--}}
    {{--        2,1,3,--}}
    {{--        2,3,1,--}}
    {{--        ]"--}}
    {{--        :level="[{{$levelNumber}},{{$activityNumber}}]"--}}
    {{--        :rotate="false"--}}
    {{--    ></paint-permutations>--}}

    <test-permutations
        asset_videos="{{asset('videos')}}"
        asset_audio="{{asset('audios')}}/old"
        {{--        route_back="{{route('normal.level-1.home')}}"--}}
        {{--        route_next="{{route('normal.test1')}}"--}}
        asset_images="{{asset('images')}}"
        win_audio="/voz1/win/fantastico1.m4a"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :items="{{json_encode([
                ['name' => 'Eltiburon', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/tiburon.svg'), 'size' => 'BIG', 'group' => 'Animal'],
                ['name' => 'Elcangrejo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/cangrejo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
                ['name' => 'Elpulpo', 'type' => 'IMAGE', 'content' => asset('/images/items/animals/pulpo.svg'), 'size' => 'BIG', 'group' => 'Animal'],
                ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
            ])}}"
    ></test-permutations>
@endsection
