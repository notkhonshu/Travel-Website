@props(['trip'])

@php
    $price = number_format($trip['price'], 0, ',', '.');
    $bookUrl = config('social.bookurl');
    $whatsappNumber = config('social.marketing.whatsapp');
    $whatsappMessage = urlencode("Hi! I'm interested in booking: {$trip['title']}");
    $whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$whatsappMessage}";
@endphp

<div class="flex flex-col gap-4">

    <div class="rounded-2xl border-2 border-blue-200 bg-white p-5 shadow-sm">
        <div class="mb-4">
            <p class="text-xs text-gray-400 mb-0.5">Starting from</p>
            <div class="flex items-baseline gap-1.5">
                <span class="text-2xl font-medium text-gray-900">Rp {{ $price }}</span>
            </div>
            <p class="text-xs text-gray-400 mt-0.5">per {{ $trip['price_unit'] }}</p>
        </div>

        <div class="bg-gray-50 rounded-xl p-3.5 mb-4 divide-y divide-gray-100">
            <div class="flex justify-between py-2 first:pt-0">
                <span class="text-xs text-gray-500">Duration</span>
                <span class="text-xs font-medium text-gray-800">{{ $trip['duration'] }}</span>
            </div>
            <div class="flex justify-between py-2">
                <span class="text-xs text-gray-500">Group size</span>
                <span class="text-xs font-medium text-gray-800">{{ $trip['min_pax'] }}–{{ $trip['max_pax'] }} people</span>
            </div>
            <div class="flex justify-between py-2">
                <span class="text-xs text-gray-500">Difficulty</span>
                <span class="text-xs font-medium text-gray-800">{{ $trip['difficulty'] }}</span>
            </div>
            <div class="flex justify-between py-2 last:pb-0">
                <span class="text-xs text-gray-500">Meeting point</span>
                <span class="text-xs font-medium text-gray-800 text-right max-w-[55%]">{{ $trip['meeting_point'] ?? 'Hotel pickup' }}</span>
            </div>
        </div>

        <a
            href="{{ $bookUrl }}"
            target="_blank"
            rel="noopener noreferrer"
            class="flex items-center justify-center gap-2 w-full py-3 bg-gray-900 hover:bg-gray-700 text-white text-sm font-medium rounded-xl transition-colors mb-2"
        >
            Book this trip
        </a>

        <a
            href="{{ $whatsappUrl }}"
            target="_blank"
            rel="noopener noreferrer"
            class="flex items-center justify-center gap-2 w-full py-3 border border-gray-200 hover:border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-xl transition-colors"
        >
            <i class="ti ti-brand-whatsapp text-base text-green-600" aria-hidden="true"></i>
            Enquire via WhatsApp
        </a>
    </div>

    <div class="rounded-2xl border border-gray-100 bg-white p-4">
        <div class="flex items-start gap-3">
            <i class="ti ti-shield-check text-xl text-green-600 shrink-0 mt-0.5" aria-hidden="true"></i>
            <div>
                <p class="text-sm font-medium text-gray-800 mb-1">Safe & reliable</p>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Certified guides, safety equipment provided, and free cancellation up to 24 hours before the trip.
                </p>
            </div>
        </div>
    </div>
</div>