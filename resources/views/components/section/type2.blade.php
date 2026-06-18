@php
    $destinations = config('data.destinations', []);
    $packages     = config('data.packages', []);
    $sectionId    = $section_data['id'] ?? 'destinations';

    $tripCounts = collect($packages)->groupBy('destination')->map->count();
@endphp

<section id="{{ $sectionId }}"
         data-dest-slider="{{ $sectionId }}"
         class="py-12 sm:py-16 md:py-20 px-4 bg-[var(--color-background)] overflow-hidden">

    {{-- Header --}}
    <div class="max-w-7xl mx-auto mb-8 sm:mb-10 md:mb-12 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div class="max-w-xl">
            <span class="inline-block mb-2 sm:mb-3 font-sans text-[10px] sm:text-xs font-semibold tracking-widest uppercase
                         text-accent">
                {{ $section_data['eyebrow'] }}
            </span>
            <h2 class="font-heading font-bold text-2xl sm:text-3xl md:text-4xl text-[var(--color-heading-text)] leading-tight">
                {{ $section_data['title'] }}
            </h2>
            <p class="mt-2 sm:mt-3 font-sans text-sm text-[var(--color-body-text)] leading-relaxed">
                {{ $section_data['description'] }}
            </p>
        </div>

        {{-- Prev / Next --}}
        <div class="flex items-center gap-2 shrink-0 self-end md:self-auto">
            <button id="{{ $sectionId }}_prev"
                    aria-label="Previous destination"
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full
                           bg-[var(--color-surface)] border border-[var(--color-border)]
                           flex items-center justify-center
                           text-[var(--color-heading-text)]
                           hover:bg-[var(--color-primary)] hover:text-white hover:border-[var(--color-primary)]
                           transition-all duration-200 shadow-sm">
                <i class="ti ti-arrow-left text-sm" aria-hidden="true"></i>
            </button>
            <button id="{{ $sectionId }}_next"
                    aria-label="Next destination"
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full
                           bg-[var(--color-primary)] border border-[var(--color-primary)]
                           flex items-center justify-center
                           text-white
                           hover:bg-[var(--color-primary-light)] hover:border-[var(--color-primary-light)]
                           transition-all duration-200 shadow-sm">
                <i class="ti ti-arrow-right text-sm" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        <div id="{{ $sectionId }}_track_wrap"
             class="overflow-hidden">
            <div id="{{ $sectionId }}_track"
                 class="flex gap-3 sm:gap-4 md:gap-5 will-change-transform">

                @foreach ($destinations as $dest)
                <article class="tbg-dest-card shrink-0 w-[220px] sm:w-[260px] md:w-[320px] group relative
                                rounded-[var(--radius-xl)] overflow-hidden
                                shadow-[var(--shadow-card)] cursor-pointer">

                    <div class="relative h-[320px] sm:h-[380px] md:h-[420px] overflow-hidden">
                        <img src="{{ asset($dest['image']) }}"
                             alt="{{ $dest['label'] }}"
                             loading="lazy"
                             class="w-full h-full object-cover
                                    transition-transform duration-700 ease-in-out
                                    group-hover:scale-105">

                        <div class="absolute inset-0 bg-gradient-to-t
                                    from-black/75 via-black/20 to-transparent"></div>

                        <span class="absolute top-3 left-3 sm:top-4 sm:left-4
                                     font-sans text-[10px] sm:text-[11px] font-semibold tracking-widest uppercase
                                     bg-accent text-white
                                     px-2.5 sm:px-3 py-0.5 sm:py-1 rounded-full">
                            {{ $dest['tag'] }}
                        </span>

                        <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-5">
                            <p class="font-sans text-[10px] sm:text-[11px] font-medium tracking-widest uppercase
                                      text-white/60 mb-1">
                                {{ $dest['tagline'] }}
                            </p>
                            <h3 class="font-heading font-bold text-lg sm:text-xl md:text-2xl text-white leading-tight mb-1.5 sm:mb-2">
                                {{ $dest['label'] }}
                            </h3>
                            <p class="font-sans text-xs sm:text-[13px] text-white/75 leading-snug line-clamp-2 mb-3 sm:mb-4">
                                {{ $dest['desc'] }}
                            </p>

                            <div class="flex items-center justify-between gap-2">
                                <span class="flex items-center gap-1.5 font-sans text-[11px] sm:text-xs text-white/60 truncate">
                                    <i class="ti ti-map-route text-accent shrink-0" aria-hidden="true"></i>
                                    <span class="truncate">{{ $tripCounts[$dest['slug']] ?? 0 }} trips available</span>
                                </span>
                                <a href="{{ route('trip.index', ['destination' => $dest['slug']]) }}"
                                   class="flex items-center gap-1.5 shrink-0
                                          font-sans text-[11px] sm:text-xs font-semibold
                                          text-accent
                                          hover:text-white transition-colors duration-200">
                                    Explore
                                    <i class="ti ti-arrow-right text-sm" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </article>
                @endforeach

            </div>
        </div>
    </div>

    {{-- Dots --}}
    <div id="{{ $sectionId }}_dots"
         class="flex items-center justify-center gap-2 mt-6 sm:mt-8">
        @foreach ($destinations as $i => $dest)
        <button aria-label="Go to {{ $dest['label'] }}"
                class="tbg-dest-dot w-1.5 h-1.5 rounded-full
                       bg-[var(--color-border)]
                       transition-all duration-300"
                data-dest-index="{{ $i }}"></button>
        @endforeach
    </div>

</section>