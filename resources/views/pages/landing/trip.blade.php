@extends('layouts.type1', [
    'layout_settings' => [
        'trip_navbar' => true,
    ]
])

@section('content')

    @include('components.section.type11', [
        'listings'       => $listings,
        'categories'     => $categories,
        'activeCategory' => $activeCategory,
        'sort'           => $sort,
        'q'              => $q,
    ])

    @include('components.section.type7')
@endsection