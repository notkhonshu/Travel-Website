@extends('layouts.type1', [
    'layout_settings' => [
        'trip_navbar' => true,
    ]
])

@section('content')
    @include('components.section.type8', [
        'section_data'   => [
            'id'         => 'hero',
            'title'      => $post['title'],
            'description'=> $post['excerpt'],
            'background' => [
                'link'   => asset($post['image']),
                'alt'    => $post['title'],
            ],
            'scroll_to' => '#',
        ],
    ])
    @include('components.section.type16', compact('post', 'related', 'categories', 'recentPosts'))

    @include('components.section.type7')

@endsection