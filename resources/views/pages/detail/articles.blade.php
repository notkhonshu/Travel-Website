@extends('layouts.type1', [
    'layout_settings' => [
        'trip_navbar' => true,
    ]
])

@section('content')

    @include('components.section.type8', [
        'section_data' => [
            'image'   => asset($post['image']),
            'title'   => $post['title'],
            'excerpt' => $post['excerpt'],
        ]
    ])

    @include('components.section.type16', compact('post', 'related', 'categories', 'recentPosts'))

    @include('components.section.type7')

@endsection