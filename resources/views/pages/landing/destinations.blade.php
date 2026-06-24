@extends('layouts.type1', [
    'layout_settings' => [
        'trip_navbar' => true,
    ]
])

@section('content')

    @include('components.section.type11', [
        'mode'           => 'destinations',
        'listings'       => $destinations,
        'q'              => $q,
        'pageEyebrow'    => 'Explore Bali',
        'pageTitle'      => 'Explore Destinations',
        'pageDescription'=> "Curated journeys across Bali's most breathtaking landscapes — from volcanic highland craters to dramatic sea cliffs and tropical island escapes.",
    ])

    @include('components.section.type7')

@endsection