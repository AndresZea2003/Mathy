@php
    $items = json_encode([
        ["name" => "Azul", "type" => "COLOR", "content" => "bg-blue-600", "hex" => "#2563eb", "group" => "Color"],
        ["name" => "Verde", "type" => "COLOR", "content" => "bg-green-600", "hex" => "#16a34a", "group" => "Color"],
        ["name" => "Rojo", "type" => "COLOR", "content" => "bg-red-600", "hex" => "#dc2626", "group" => "Color"],
        ["name" => "Borrador", "type" => "ERASER", "content" => asset('/images/items/tools/eraser.png'), "size" => "BIG", "group" => "Borrador"]
    ]);

@endphp

@extends('layouts.app')

@section('main')
    <paint-permutations
        :items="{{ $items }}"
        :gamemode="2"
        type="colors"
        :boxes_for_group="3"
        :show_groups="6"
        :show_fake_row="true"
        :show_animate_progress="true"
        :fill_sample="[
        1,3,0,
        1,0,0,
        3,2,0,
        3,0,0,
        2,1,0,
        2,0,0]"
        create_audio_6="¡Bienvenidos al emocionante viaje por el espacio! , ¡Vamos a empezar con algo divertido!"
        :level='[{{ $levelNumber }}, {{ $activityNumber }}]'
    ></paint-permutations>
@endsection
