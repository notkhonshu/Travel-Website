@extends('layouts.type1', [
    'layout_settings' => [
        'trip_navbar' => false,
    ]
])
@section('content')
    @include('components.section.type1', [
        'section_data'   => [
            'id'         => 'home_hero',
            'background' => [
                'link'   => asset('assets/img/static/beach.jpg'),
                'alt'    => 'The Bali Guides Adventure',
            ],
            'scroll_to' => '#destinations',
            'search' => [
                'placeholder' => 'Search trips, activities, destination...',
                'url'         => route('trip.index'),
            ],
        ],
    ])
    @if ($sections['has_destinations'])
        @include('components.section.type2', [
            'section_data' => [
                'id'       => 'destinations',
                'eyebrow'  => "Things to see",
                'title'    => "Explore Bali's Destinations",
                'description' => "From volcanic highlands to clifftop temples — every corner of Bali tells a different story.",
            ],
        ])
    @endif

    @include('components.section.type3', [
        'section_data' => [
            'cta_link'       => route('trip.index'),
            'secondary_link' => config('social.customer_service.url_email'),
        ],
    ])

    @if ($sections['has_packages'])
        @include('components.section.type5', [
            'section_data' => [
                'id'       => 'packages',
                'source'   => 'packages',
                'eyebrow'  => "Explore",
                'title'    => "Our Packages",
                'description' => "Explore our carefully crafted tour packages designed to showcase the best destinations, experiences, and local attractions for a memorable journey.",
            ],
        ])
    @endif

    @if ($sections['has_activities'])
        @include('components.section.type5', [
            'section_data' => [
                'id'          => 'activities',
                'source'      => 'activities',
                'eyebrow'     => 'Things to do',
                'title'       => 'Explore Our Activity',
                'description' => 'Discover exciting activities and unique adventures that let you experience each destination in a fun, authentic, and unforgettable way.',
                'bg'          => 'bg-black/4'
            ]
        ])
    @endif

    @if ($sections['has_blog'])
        @include('components.section.type5', [
            'section_data' => [
                'id'          => 'blogs',
                'eyebrow'     => 'Things to know',
                'title'       => 'Stories & <span class="text-accent">Travel Guides</span>',
                'description' => 'Honest travel advice, trekking tips, and hidden-gem recommendations written by the guides who live here.',
            ]
        ])
    @endif

    @include('components.section.type7')
@endsection