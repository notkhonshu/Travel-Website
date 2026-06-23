@php
    $sectionId = $section_data['id'] ?? 'packages';
    $source    = $section_data['source'] ?? 'packages';
    $allItems  = collect(config('data.' . $source, []));
    $dotClass  = 'tbg-' . $sectionId . '-dot';
    $cardClass = 'tbg-' . $sectionId . '-card';
@endphp

<section id="{{ $sectionId }}"
         data-pkg-slider="{{ $sectionId }}"
         class="py-12 sm:py-16 md:py-20 px-4 bg-[var(--color-background)] overflow-hidden">
    <div class="max-w-7xl mx-auto mb-8 sm:mb-10 md:mb-12 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div class="max-w-xl">
            <span class="inline-block mb-2 sm:mb-3 font-sans text-[10px] sm:text-xs font-semibold tracking-widest uppercase
                         text-accent">
                {{ $section_data['eyebrow'] }}
            </span>
            <h2 class="font-heading font-bold text-2xl sm:text-3xl md:text-4xl text-[var(--color-heading-text)] leading-tight">
                {!! $section_data['title'] !!}
            </h2>
            <p class="mt-2 sm:mt-3 font-sans text-sm text-[var(--color-body-text)] leading-relaxed text-justify">
                {{ $section_data['description'] }}
            </p>
        </div>
        <div class="flex items-center gap-2 shrink-0 self-end md:self-auto">
            <button id="{{ $sectionId }}_prev"
                    aria-label="Previous"
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full
                           bg-[var(--color-surface)] border border-[var(--color-border)]
                           flex items-center justify-center
                           text-[var(--color-heading-text)]
                           hover:bg-[var(--color-primary)] hover:text-white hover:border-[var(--color-primary)]
                           transition-all duration-200 shadow-sm">
                <i class="ti ti-arrow-left text-sm" aria-hidden="true"></i>
            </button>
            <button id="{{ $sectionId }}_next"
                    aria-label="Next"
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full
                           bg-[var(--color-primary)] border border-[var(--color-primary)]
                           flex items-center justify-center text-white
                           hover:bg-[var(--color-primary-light)] hover:border-[var(--color-primary-light)]
                           transition-all duration-200 shadow-sm">
                <i class="ti ti-arrow-right text-sm" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <div class="pl-4 sm:pl-0 max-w-7xl mx-auto">
        <div id="{{ $sectionId }}_track_wrap" class="overflow-hidden">
            <div id="{{ $sectionId }}_track" class="flex gap-4 sm:gap-4 md:gap-5 will-change-transform">
                @foreach($allItems as $item)
                <div class="{{ $cardClass }} shrink-0 w-[85%] sm:w-[calc(33%-8px)] lg:w-[calc(25%-15px)]">
                    @include('components.section.type4', [
                        'section_data' => [
                            'image'      => asset($item['image']),
                            'title'      => $item['title'],
                            'excerpt'    => $item['excerpt'],
                            'price'      => $item['price'],
                            'price_unit' => $item['price_unit'] ?? 'person',
                            'link'       => route('trip.index') . '/' . $item['slug'],
                        ]
                    ])
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="{{ $sectionId }}_dots" class="flex items-center justify-center gap-2 mt-6 sm:mt-8">
        @foreach($allItems as $i => $item)
        <button aria-label="Go to {{ $item['title'] }}"
                class="{{ $dotClass }} w-1.5 h-1.5 rounded-full
                       bg-[var(--color-border)]
                       transition-all duration-300"
                data-pkg-index="{{ $i }}"></button>
        @endforeach
    </div>
</section>