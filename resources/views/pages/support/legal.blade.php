@extends('layouts.type1', [
    'layout_settings' => [
        'navbar_trip' => false,
    ]
])

@section('content')
@include('components.section.type8', [
        'section_data'   => [
            'id'         => 'hero',
            'title'      => "Legal Notice",
            'description'=> "PT. Bali Guide Adventure",
            'background' => [
                'link'   => asset('assets/img/static/beach.jpg'),
                'alt'    => 'Bali Guide Adventure',
            ],
            'scroll_to' => '#legal',
        ],
    ])

@include('components.section.type17',[
    'section_data'=>[
        'id' => 'legal',
    ]
])

@include('components.section.type7')
@endsection