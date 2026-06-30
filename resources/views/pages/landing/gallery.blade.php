@extends('layouts.type1', [
    'layout_settings' => [
        'trip_navbar' => false,
    ]
])
@section('content')
    @include('components.section.type8', [
        'section_data'   => [
            'id'         => 'hero',
            'title'      => "Moments Captured Across Bali",
            'description'=> "Explore a collection of unforgettable experiences, breathtaking landscapes, and authentic adventures captured during our journeys across the Island of the Gods.",
            'background' => [
                'link'   => asset('assets/img/static/beach.jpg'),
                'alt'    => 'Bali Guide Adventure',
            ],
            'scroll_to' => '#gallery',
        ],
    ])

    @include('components.section.type10', ['images' => $images])

    @include('components.section.type7')
@endsection