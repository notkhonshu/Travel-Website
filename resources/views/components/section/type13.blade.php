@props(['trip'])

@php
    $difficultyConfig = [
        'Easy'          => ['icon' => 'ti-mood-smile',   'class' => 'bg-green-50  text-green-700  border-green-200'],
        'Easy–Moderate' => ['icon' => 'ti-mood-neutral', 'class' => 'bg-yellow-50 text-yellow-700 border-yellow-200'],
        'Moderate'      => ['icon' => 'ti-mood-neutral', 'class' => 'bg-amber-50  text-amber-700  border-amber-200'],
        'Challenging'   => ['icon' => 'ti-mood-nervous', 'class' => 'bg-red-50    text-red-700    border-red-200'],
    ];
    $difficulty = $difficultyConfig[$trip['difficulty']] ?? ['icon' => 'ti-gauge', 'class' => 'bg-gray-50 text-gray-600 border-gray-200'];

    $pills = [
        ['icon' => 'ti-clock',          'value' => $trip['duration'],                                      'class' => 'bg-gray-50 text-gray-700 border-gray-200'],
        ['icon' => 'ti-users',          'value' => $trip['min_pax'] . '–' . $trip['max_pax'] . ' people', 'class' => 'bg-gray-50 text-gray-700 border-gray-200'],
        ['icon' => $difficulty['icon'], 'value' => $trip['difficulty'],                                    'class' => $difficulty['class']],
        ['icon' => 'ti-map-pin',        'value' => $trip['meeting_point'] ?? 'Hotel pickup included',      'class' => 'bg-gray-50 text-gray-700 border-gray-200'],
    ];
@endphp

<div class="grid grid-cols-2 sm:flex sm:flex-wrap gap-2 mb-6">
    @foreach ($pills as $pill)
        <div class="inline-flex items-center gap-2 text-sm px-3 py-2 rounded-xl border {{ $pill['class'] }} min-w-0">
            <i class="ti {{ $pill['icon'] }} text-base shrink-0" aria-hidden="true"></i>
            <span class="font-medium truncate">{{ $pill['value'] }}</span>
        </div>
    @endforeach
</div>

<p class="text-sm sm:text-base text-gray-600 leading-relaxed mb-8">
    {{ $trip['description'] }}
</p>

@if (!empty($trip['highlights']))
    <hr class="border-gray-100 mb-8">
    <div class="mb-8">
        <h2 class="text-base sm:text-lg font-medium mb-4">Trip highlights</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 sm:gap-3">
            @foreach ($trip['highlights'] as $item)
                <div class="flex items-start gap-3 text-sm text-gray-700">
                    <i class="ti ti-circle-check text-base text-green-600 mt-0.5 shrink-0" aria-hidden="true"></i>
                    <span>{{ $item }}</span>
                </div>
            @endforeach
        </div>
    </div>
@endif

@if (!empty($trip['includes']) || !empty($trip['excludes']))
    <hr class="border-gray-100 mb-8">
    <div class="mb-8">
        <h2 class="text-base sm:text-lg font-medium mb-4">What's included</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @if (!empty($trip['includes']))
                <div>
                    <p class="text-xs font-medium uppercase tracking-widest text-gray-400 mb-3">Included</p>
                    <div class="flex flex-col gap-2.5">
                        @foreach ($trip['includes'] as $item)
                            <div class="flex items-start gap-2.5 text-sm text-gray-700">
                                <i class="ti ti-check text-sm text-green-600 mt-0.5 shrink-0" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @if (!empty($trip['excludes']))
                <div>
                    <p class="text-xs font-medium uppercase tracking-widest text-gray-400 mb-3">Not included</p>
                    <div class="flex flex-col gap-2.5">
                        @foreach ($trip['excludes'] as $item)
                            <div class="flex items-start gap-2.5 text-sm text-gray-700">
                                <i class="ti ti-x text-sm text-red-400 mt-0.5 shrink-0" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif

@if (!empty($trip['itinerary']))
    <hr class="border-gray-100 mb-8">
    <div class="mb-8">
        <h2 class="text-base sm:text-lg font-medium mb-5">Itinerary</h2>
        <ol class="relative border-l border-gray-200 flex flex-col gap-0">
            @foreach ($trip['itinerary'] as $i => $step)
                <li class="relative pl-6 sm:pl-7 pb-6 last:pb-0">
                    <span class="absolute left-0 top-1 -translate-x-1/2 w-2.5 h-2.5 rounded-full border-2 border-gray-300 bg-white"></span>
                    <span class="block text-xs font-medium text-gray-400 mb-0.5 tabular-nums">{{ $step['time'] }}</span>
                    <span class="text-sm text-gray-700 leading-relaxed">{{ $step['activity'] }}</span>
                </li>
            @endforeach
        </ol>
    </div>
@endif