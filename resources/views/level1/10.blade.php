@extends('layouts.app')

@section('main')

{{--    <paint-pattern--}}
{{--        :items="{{json_encode([--}}
{{--            ['name' => 'La pina', 'type' => 'IMAGE', 'content' => asset('/images/items/ED/dinosaurio.png'), 'size' => 'BIG', 'group' => 'Fruta'],--}}
{{--            ['name' => 'La papaya', 'type' => 'IMAGE', 'content' => asset('/images/items/ED/papaya.png'), 'size' => 'BIG', 'group' => 'Fruta'],--}}
{{--            ['name' => 'El mango', 'type' => 'IMAGE', 'content' => asset('/images/items/ED/patineta.png'), 'size' => 'BIG', 'group' => 'Fruta'],--}}
{{--            ['name' => 'Las bananas', 'type' => 'IMAGE', 'content' => asset('/images/items/ED/uvas.png'), 'size' => 'BIG', 'group' => 'Fruta'],--}}
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

    <paint-ladder
        :items="{{json_encode([
            ['name' => 'Amarillo', 'type' => 'COLOR', 'content' => 'bg-yellow-400', 'hex' => '#facc15' , 'group' => 'Color'],
            ['name' => 'Azul', 'type' => 'COLOR', 'content' => 'bg-blue-600', 'hex' => '#2563eb' , 'group' => 'Color'],
//            ['name' => 'Verde', 'type' => 'COLOR', 'content' => 'bg-green-600', 'hex' => '#16a34a' , 'group' => 'Color'],
            ['name' => 'Borrador', 'type' => 'ERASER', 'content' => asset('/images/items/tools/eraser.png'), 'size' => 'BIG', 'group' => 'Borrador']
        ])}}"
        :size="[5,6]"
        :select_cols="[2,4]"
        :order_to_resolve="[5,10,15,20,25,30]"
        :solution="[22,27,14,19,24,29]"
        :fill_sample="[
        0,0,0,0,0,
        0,0,0,0,1,
        0,0,0,1,1,
        0,0,1,1,1,
        0,1,1,1,1,
        1,1,1,1,1,
        ]"
        :level="[{{$levelNumber}},{{$activityNumber}}]"
        :rotate="false"
        :fake_items="[1,2,3]"
{{--        :show_ids="true"--}}

    ></paint-ladder>
@endsection
