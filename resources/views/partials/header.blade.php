<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- Meta --}}
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        {{-- Meta Name --}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description"
            content="{{ isset($data['metadata']['description']) ? strip_tags($data['metadata']['description']) : config('metadata.description') }}">
        <meta name="keywords"
            content="{{ isset($data['metadata']['keyword']) ? $data['metadata']['keyword'] . ' ' . config('metadata.keyword') : config('metadata.keyword') }}">
        <meta name="robots" content="index, follow">
        <meta name="author" content="The Bali Guides Adventure">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        {{-- Meta Property OG --}}
        <meta property="og:title"
            content="{{ isset($data['metadata']['og-title']) ? $data['metadata']['og-title'] : config('metadata.og-title') }}">
        <meta property="og:description"
            content="{{ isset($data['metadata']['og-description']) ? strip_tags($data['metadata']['og-description']) : config('metadata.og-description') }}">
        <meta property="og:image" content="{{ asset('assets/img/metadata/featured_image/image.jpg') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt"
            content="{{ isset($data['metadata']['og-title']) ? $data['metadata']['og-title'] : config('metadata.og-title') }}">
        <meta property="og:locale" content="{{ app()->getLocale() }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name"
            content="{{ isset($data['metadata']['og-site-name']) ? $data['metadata']['og-site-name'] : config('metadata.og-site-name') }}">
        <meta property="og:type"
            content="{{ isset($data['metadata']['og-type']) ? $data['metadata']['og-type'] : config('metadata.og-type') }}" />
        <meta property="og:longitude"
            content="{{ isset($data['metadata']['og-longitude']) ? $data['metadata']['og-longitude'] : config('metadata.og-longitude') }}">
        <meta property="og:latitude"
            content="{{ isset($data['metadata']['og-latitude']) ? $data['metadata']['og-latitude'] : config('metadata.og-latitude') }}">
        <meta property="og:locality"
            content="{{ isset($data['metadata']['og-locality']) ? $data['metadata']['og-locality'] : config('metadata.og-locality') }}">
        <meta property="og:region"
            content="{{ isset($data['metadata']['og-region']) ? $data['metadata']['og-region'] : config('metadata.og-region') }}">
        <meta property="og:postal-code"
            content="{{ isset($data['metadata']['og-postal-code']) ? $data['metadata']['og-postal-code'] : config('metadata.og-postal-code') }}">
        <meta property="og:country-name"
            content="{{ isset($data['metadata']['og-country-name']) ? $data['metadata']['og-country-name'] : config('metadata.og-country-name') }}">
        <meta property="og:email"
            content="{{ isset($data['metadata']['og-email']) ? $data['metadata']['og-email'] : config('social.customer_service.email') }}">
        <meta property="og:phone_number"
            content="{{ isset($data['metadata']['og-phone-number']) ? $data['metadata']['og-phone-number'] : config('social.customer_service.whatsapp') }}">
        <meta property="og:street-address"
            content="{{ isset($data['metadata']['og-street-address']) ? $data['metadata']['og-street-address'] : config('social.address.name') }}">

        {{-- Twitter Card --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title"
            content="{{ isset($data['metadata']['og-title']) ? $data['metadata']['og-title'] : config('metadata.og-title') }}">
        <meta name="twitter:description"
            content="{{ isset($data['metadata']['og-description']) ? strip_tags($data['metadata']['og-description']) : config('metadata.og-description') }}">
        <meta name="twitter:image" content="{{ asset('assets/img/metadata/featured_image/image.jpg') }}">
        <meta name="twitter:site" content="@{{ config('social.twitter.name') }}">

        {{-- Title --}}
        <title>
            {{ isset($data['metadata']['title']) ? $data['metadata']['title'] : config('metadata.title') }}
        </title>

        {{-- Canonical --}}
        <link rel="canonical" href="{{ url()->current() }}" />
        <link rel="shortcut icon" href="{{ asset('assets/img/metadata/favicon/ico.ico') }}" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ asset('assets/img/metadata/favicon/apple-touch-icon.png') }}">

        {{-- Vite --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        {{-- Tabler Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        {{-- JSON-LD Structured Data --}}
        <?php
            $jsonLd = [
                '@context'    => 'https://schema.org',
                '@type'       => 'TouristInformationCenter',
                'name'        => 'The Bali Guides Adventure',
                'description' => config('metadata.description'),
                'image'       => asset('assets/img/metadata/featured_image/image.jpg'),
                'url'         => route('landing.index'),
                'telephone'   => config('social.customer_service.whatsapp'),
                'email'       => config('social.customer_service.email'),
                'address'     => [
                    '@type'           => 'PostalAddress',
                    'streetAddress'   => config('social.address.street'),
                    'addressLocality' => config('social.address.locality'),
                    'addressRegion'   => 'Bali',
                    'postalCode'      => config('social.address.postal_code'),
                    'addressCountry'  => 'ID',
                ],
                'geo' => [
                    '@type'     => 'GeoCoordinates',
                    'latitude'  => config('metadata.og-latitude'),
                    'longitude' => config('metadata.og-longitude'),
                ],
                'openingHoursSpecification' => [
                    '@type'     => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
                    'opens'     => '08:00',
                    'closes'    => '20:00',
                ],
                'hasOfferCatalog' => [
                    '@type'           => 'OfferCatalog',
                    'name'            => 'Bali Adventure Tours & Activities',
                    'itemListElement' => array_map(fn($pkg) => [
                        '@type'       => 'Offer',
                        'itemOffered' => [
                            '@type'       => 'TouristTrip',
                            'name'        => $pkg['title'],
                            'description' => $pkg['excerpt'],
                        ],
                    ], config('data.packages', [])),
                ],
                'sameAs' => [
                    config('social.facebook.url'),
                    config('social.instagram.url'),
                ],
            ];
        ?>
        <script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?></script>
    </head>