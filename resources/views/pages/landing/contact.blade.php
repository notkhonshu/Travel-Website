@extends('layouts.type1', [
    'layout_settings' => [
        'trip_navbar' => false,
    ]
])
@section('content')
    @include('components.section.type8', [
        'section_data'   => [
            'id'         => 'hero',
            'title'      => "Get in Touch",
            'description'=> "Have questions or need help planning your Bali adventure? Our friendly team is here to assist you with bookings, custom tours, and travel information.",
            'background' => [
                'link'   => asset('assets/img/static/beach.jpg'),
                'alt'    => 'The Bali Guides Adventure',
            ],
            'scroll_to' => '#contact',
        ],
    ])

    @include('components.section.type15')
@endsection