@extends('layouts.type1', [
    'layout_settings' => [
        'trip_navbar' => true,
    ]
])

@section('title', $trip['title'] . ' — PT Bali Guide Adventure')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-10 lg:py-14 mt-5">

        @include('components.section.type12', [
            'trip'        => $trip,
            'type'        => $type,
            'destination' => $destination,
        ])

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-10 lg:gap-16 items-start">
            <div>
                @include('components.section.type13', ['trip' => $trip])
            </div>
            <aside>
                @include('components.section.type14', ['trip' => $trip])
            </aside>
        </div>

    </section>
    @include('components.section.type7', [
        'section_data' => [
            'id'           => 'cta-booking',
            'eyebrow'      => 'Tailored for you',
            'title'        => 'Private & Group',
            'title_accent' => 'Bookings',
            'description'  => 'Elevate your journey with our tailor-made Private and Group Adventure services. From intimate getaways to large-scale group itineraries, our professional team is ready to design a seamless, unforgettable experience for you.',
            'cta_label'    => 'Contact Our Team',
            'cta_link'     => config('social.customer_service.url_email'),
        ],
    ])
@endsection