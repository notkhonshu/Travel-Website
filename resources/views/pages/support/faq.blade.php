@extends('layouts.type1', [
    'layout_settings' => [
        'navbar_trip' => false,
    ]
])

@section('content')
@include('components.section.type8', [
    'section_data'   => [
        'id'         => 'hero',
        'title'      => "Frequently Asked Questions",
        'description'=> "PT. Bali Guide Adventure",
        'background' => [
            'link'   => asset('assets/img/static/beach.jpg'),
            'alt'    => 'Bali Guide Adventure',
        ],
        'scroll_to' => '#faq',
    ],
])

@include('components.section.type18',[
    'section_data'=>[
        'id' => 'faq',
    ]
])

@include('components.section.type7')
@endsection