@extends('layouts.type1', [
    'layout_settings' => [
        'trip_navbar' => false,
    ]
])
@section('content')
    @include('components.section.type8', [
        'section_data'   => [
            'id'         => 'hero',
            'title'      => "Your Journey to Bali Starts Here",
            'description'=> "From volcanic landscapes and tropical waterfalls to cultural treasures and island escapes, we bring you the best adventures Bali has to offer with expert local guidance.",
            'background' => [
                'link'   => asset('assets/img/static/beach.jpg'),
                'alt'    => 'The Bali Guides Adventure',
            ],
            'scroll_to' => '#about-us',
        ],
    ])

    @include('components.section.type3', [
        'section_data' => [
            'cta_link'       => route('trip.index'),
            'secondary_link' => config('social.customer_service.url_email'),
        ],
    ])

    @include('components.section.type9', [
        'section_data' => [
            'id'      => 'about',
            'eyebrow' => 'Who we are',
            'title'   => 'Our Vision &amp; <br>Mission',
            'vision'  => 'To be Bali\'s leading and most trusted all-in-one adventure tourism operator, recognized globally for blending high-adrenaline exploration with world-class safety, sustainability, and authentic cultural experiences.',
            'missions' => [
                [
                    'icon'  => 'ti-mountain',
                    'title' => 'Deliver unparalleled experiences',
                    'desc'  => 'Thrilling, diverse adventures from the volcanic UNESCO Batur Geopark to the pristine shores of Nusa Penida.',
                ],
                [
                    'icon'  => 'ti-shield-check',
                    'title' => 'Prioritize safety & professionalism',
                    'desc'  => 'Highest legal compliance and safety standards as a fully insured, officially managed provider.',
                ],
                [
                    'icon'  => 'ti-leaf',
                    'title' => 'Preserve heritage & nature',
                    'desc'  => 'Responsible tourism that honors Balinese culture, supports local communities, and protects Mount Batur\'s unique environment.',
                ],
                [
                    'icon'  => 'ti-star',
                    'title' => 'Exceed guest expectations',
                    'desc'  => 'Seamless travel services with custom packages, fast boat transfers, and warm authentic Balinese hospitality.',
                ],
            ],
        ],
    ])

    @include('components.section.type7')
@endsection