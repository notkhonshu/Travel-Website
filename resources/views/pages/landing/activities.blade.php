@extends('layouts.type1', [
    'layout_settings' => [
        'trip_navbar' => true,
    ]
])

@section('content')

    @include('components.section.type11', [
        'mode'             => 'activities',
        'listings'         => $listings,
        'categories'       => $categories,
        'activeCategory'   => $activeCategory,
        'activeDestination'=> $activeDestination,
        'sort'             => $sort,
        'q'                => $q,
    ])

    @include('components.section.type7')
@endsection