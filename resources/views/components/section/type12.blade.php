@props([
    'trip',
    'type',
    'destination',
])

@php
    $allImages  = array_merge([$trip['image']], $trip['gallery'] ?? []);
    $mainImage  = $allImages[0];
    $thumb1     = $allImages[1] ?? null;
    $thumb2     = $allImages[2] ?? null;
    $extraCount = max(0, count($allImages) - 3);

    $badgeMap = [
        'Best Seller'     => 'bg-amber-100 text-amber-800',
        'Popular'         => 'bg-teal-100 text-teal-800',
        'Top Rated'       => 'bg-blue-100 text-blue-800',
        'Family Friendly' => 'bg-green-100 text-green-800',
        'Thrill Seeker'   => 'bg-red-100 text-red-800',
    ];
    $badgeClass = $badgeMap[$trip['badge'] ?? ''] ?? 'bg-gray-100 text-gray-700';
    $typeLabel  = $type === 'package' ? 'Package' : 'Activity';
@endphp

<nav aria-label="Breadcrumb" class="flex items-center gap-2 text-sm text-gray-500 mb-5 pt-5 md:pt-0">
    <a href="/trip" class="hover:text-gray-800 transition-colors">Trip</a>
    <svg class="w-3.5 h-3.5 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    @if ($destination)
        <a href="/trip?destination={{ $destination['slug'] }}" class="hover:text-gray-800 transition-colors capitalize">
            {{ $destination['label'] }}
        </a>
        <svg class="w-3.5 h-3.5 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    @endif
    <span class="text-gray-800 font-medium truncate max-w-[180px] sm:max-w-[240px]">{{ $trip['title'] }}</span>
</nav>

<div class="flex flex-wrap items-center gap-2 mb-3">
    @if ($trip['badge'] ?? null)
        <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full {{ $badgeClass }}">
            <i class="ti ti-flame text-sm" aria-hidden="true"></i>
            {{ $trip['badge'] }}
        </span>
    @endif
    <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full bg-gray-100 text-gray-700 capitalize">
        <i class="ti ti-tag text-sm" aria-hidden="true"></i>
        {{ $trip['category'] }}
    </span>
    <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full bg-gray-100 text-gray-600">
        {{ $typeLabel }}
    </span>
</div>

<h1 class="text-xl sm:text-2xl md:text-3xl font-medium leading-snug mb-4">
    {{ $trip['title'] }}
</h1>

<div class="flex flex-wrap items-center gap-x-4 gap-y-2 mb-6 text-sm text-gray-600">
    <div class="flex items-center gap-1">
        <i class="ti ti-star-filled text-amber-500" aria-hidden="true"></i>
        <span class="font-medium text-gray-900">{{ number_format($trip['rating'], 1) }}</span>
        <span class="text-gray-400">({{ number_format($trip['reviews']) }} reviews)</span>
    </div>
    @if ($destination)
        <span class="text-gray-300">·</span>
        <div class="flex items-center gap-1">
            <i class="ti ti-map-pin text-base" aria-hidden="true"></i>
            {{ $destination['label'] }}, Bali
        </div>
    @endif
</div>

<div
    id="tbg-trip-gallery"
    data-images='@json($allImages)'
    class="mb-8"
>
    <div class="hidden md:grid md:grid-cols-3 md:grid-rows-2 gap-1.5 rounded-xl overflow-hidden h-[400px]">
        <button
            class="col-span-2 row-span-2 relative overflow-hidden group focus:outline-none focus-visible:ring-2 focus-visible:ring-white/80 focus-visible:ring-offset-1"
            data-trip-img-index="0"
            aria-label="View main photo"
        >
            <img
                src="{{ $mainImage }}"
                alt="{{ $trip['title'] }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            >
            <span class="absolute bottom-3 left-3 bg-black/50 text-white text-xs px-2.5 py-1 rounded-full backdrop-blur-sm">
                1 / {{ count($allImages) }}
            </span>
        </button>

        @if ($thumb1)
            <button
                class="relative overflow-hidden group focus:outline-none focus-visible:ring-2 focus-visible:ring-white/80"
                data-trip-img-index="1"
                aria-label="View photo 2"
            >
                <img
                    src="{{ $thumb1 }}"
                    alt=""
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                >
            </button>
        @else
            <div class="bg-gray-100"></div>
        @endif

        @if ($thumb2)
            <button
                class="relative overflow-hidden group focus:outline-none focus-visible:ring-2 focus-visible:ring-white/80"
                data-trip-img-index="2"
                aria-label="View all photos"
            >
                <img
                    src="{{ $thumb2 }}"
                    alt=""
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                >
                @if ($extraCount > 0)
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center backdrop-blur-[1px]">
                        <span class="text-white text-sm font-medium">+{{ $extraCount }} photos</span>
                    </div>
                @endif
            </button>
        @else
            <div class="bg-gray-100"></div>
        @endif
    </div>

    <div class="md:hidden">
        <button
            class="relative w-full overflow-hidden rounded-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-white/80 aspect-[4/3]"
            data-trip-img-index="0"
            aria-label="View main photo"
        >
            <img
                src="{{ $mainImage }}"
                alt="{{ $trip['title'] }}"
                class="w-full h-full object-cover"
            >
            <span class="absolute bottom-3 left-3 bg-black/50 text-white text-xs px-2.5 py-1 rounded-full backdrop-blur-sm">
                1 / {{ count($allImages) }}
            </span>
            @if (count($allImages) > 1)
                <span class="absolute bottom-3 right-3 bg-black/50 text-white text-xs px-2.5 py-1 rounded-full backdrop-blur-sm flex items-center gap-1">
                    <i class="ti ti-photo text-sm" aria-hidden="true"></i>
                    See all
                </span>
            @endif
        </button>

        @if (count($allImages) > 1)
            <div class="flex gap-2 mt-2 overflow-x-auto pb-1 snap-x snap-mandatory scrollbar-hide">
                @foreach ($allImages as $i => $img)
                    <button
                        class="shrink-0 snap-start relative overflow-hidden rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-1 focus-visible:ring-gray-400 w-[72px] h-[52px] sm:w-[88px] sm:h-[64px]"
                        data-trip-img-index="{{ $i }}"
                        aria-label="View photo {{ $i + 1 }}"
                    >
                        <img
                            src="{{ $img }}"
                            alt=""
                            class="w-full h-full object-cover"
                            loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                        >
                        @if ($i === 2 && count($allImages) > 3)
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center rounded-lg">
                                <span class="text-white text-xs font-medium">+{{ count($allImages) - 3 }}</span>
                            </div>
                        @endif
                    </button>
                @endforeach
            </div>
        @endif
    </div>
</div>