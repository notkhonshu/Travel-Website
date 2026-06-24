@extends('layouts.type1', [
    'layout_settings' => [
        'trip_navbar' => true,
    ]
])

@section('content')

    @include('components.section.type11', [
        'mode'           => 'blog',
        'listings'       => $posts,
        'categories'     => $categories,
        'activeCategory' => $activeCategory,
        'q'              => $q,
        'pageEyebrow'    => 'Things To Know',
        'pageTitle'      => 'Travel Blog & Guides',
        'pageDescription'=> 'Stories, tips and destination guides written by our local Bali experts — everything you need to plan the perfect Bali trip.',
    ])

    @include('components.section.type7')

@endsection