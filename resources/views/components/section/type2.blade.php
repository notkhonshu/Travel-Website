@php
    $destinations = config('data.destinations', []);
    $packages     = config('data.packages', []);
    $sectionId    = $section_data['id'] ?? 'destinations';
    $tripCounts   = collect($packages)->groupBy('destination')->map->count();
@endphp

<section id="{{ $sectionId }}" data-dest-slider="{{ $sectionId }}" class="py-12 sm:py-16 md:py-20 bg-[var(--color-background)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="mb-8 sm:mb-10 md:mb-12 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div class="max-w-xl">
                <span class="inline-block mb-2 sm:mb-3 font-sans text-[10px] sm:text-xs font-semibold tracking-widest uppercase text-accent">
                    {{ $section_data['eyebrow'] }}
                </span>
                <h2 class="font-heading font-bold text-2xl sm:text-3xl md:text-4xl text-[var(--color-heading-text)] leading-tight">
                    {{ $section_data['title'] }}
                </h2>
                <p class="mt-2 sm:mt-3 font-sans text-sm text-[var(--color-body-text)] leading-relaxed text-justify">
                    {{ $section_data['description'] }}
                </p>
            </div>
            <div class="flex items-center gap-2 shrink-0 self-end md:self-auto">
                <button id="{{ $sectionId }}_prev" aria-label="Previous destination"
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[var(--color-surface)] border border-[var(--color-border)]
                           flex items-center justify-center text-[var(--color-heading-text)]
                           hover:bg-[var(--color-primary)] hover:text-white hover:border-[var(--color-primary)]
                           transition-all duration-200 shadow-sm">
                    <i class="ti ti-arrow-left text-sm" aria-hidden="true"></i>
                </button>
                <button id="{{ $sectionId }}_next" aria-label="Next destination"
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[var(--color-primary)] border border-[var(--color-primary)]
                           flex items-center justify-center text-white
                           hover:bg-[var(--color-primary-light)] hover:border-[var(--color-primary-light)]
                           transition-all duration-200 shadow-sm">
                    <i class="ti ti-arrow-right text-sm" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="overflow-hidden" id="{{ $sectionId }}_track_wrap">
            <div class="flex items-stretch gap-4" id="{{ $sectionId }}_track" style="will-change: transform;">
                @foreach ($destinations as $dest)
                <div class="tbg-dest-card shrink-0 w-[88%] sm:w-[calc(33%-8px)] lg:w-[calc(25%-12px)] flex">
                    <article class="group relative rounded-[var(--radius-xl)] overflow-hidden shadow-[var(--shadow-card)] cursor-pointer w-full">
                        <div class="relative h-[400px] sm:h-[400px] md:h-[450px] overflow-hidden">
                            <img src="{{ asset($dest['image']) }}"
                                 alt="{{ $dest['label'] }}"
                                 loading="lazy"
                                 class="w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <span class="absolute top-3 left-3 font-sans text-[10px] font-semibold
                                         tracking-widest uppercase bg-accent text-white px-2.5 py-0.5 rounded-full">
                                {{ $dest['tag'] }}
                            </span>
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <p class="font-sans text-[9px] sm:text-[10px] font-medium tracking-widest uppercase text-white/60 mb-0.5">
                                    {{ $dest['tagline'] }}
                                </p>
                                <h3 class="font-heading font-bold text-lg sm:text-xl text-white leading-tight mb-1.5">
                                    {{ $dest['label'] }}
                                </h3>
                                <p class="font-sans text-[11px] sm:text-xs text-white/75 leading-snug line-clamp-3 mb-3">
                                    {{ $dest['desc'] }}
                                </p>
                                <div class="flex items-center justify-between gap-2">
                                    <span class="flex items-center gap-1 font-sans text-[10px] text-white/60 truncate">
                                        <i class="ti ti-map-route text-accent shrink-0" aria-hidden="true"></i>
                                        <span class="truncate">{{ $tripCounts[$dest['slug']] ?? 0 }} trips available</span>
                                    </span>
                                    <a href="{{ route('trip.index', ['destination' => $dest['slug']]) }}"
                                       class="flex items-center gap-1 shrink-0 font-sans text-[10px] sm:text-[11px] font-semibold
                                              text-accent hover:text-white transition-colors duration-200">
                                        Explore
                                        <i class="ti ti-arrow-right text-xs" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
        <div class="flex items-center justify-center gap-2 mt-6 sm:mt-8" id="{{ $sectionId }}_dots">
            @foreach ($destinations as $i => $dest)
                <button
                    class="tbg-dest-dot h-2 w-2 rounded-full bg-[var(--color-border)] transition-all duration-300 cursor-pointer border-0"
                    data-dest-index="{{ $i }}"
                    aria-label="Go to {{ $dest['label'] }}"
                ></button>
            @endforeach
        </div>
    </div>
</section>