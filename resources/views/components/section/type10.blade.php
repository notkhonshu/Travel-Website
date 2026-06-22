@php
    $images = $images ?? collect();
@endphp

<section id="gallery" class="py-20 sm:py-12">
    <div class="max-w-7xl mx-auto px-8 sm:px-4">
        <div class="flex items-baseline justify-between mb-9 pb-5 border-b border-black/8">
            <span class="text-[11px] tracking-[0.18em] uppercase text-dark/50 font-normal">
                Our Collection
            </span>
            <p class="text-[12px] tracking-[0.06em] text-dark/50 m-0">
                {{ $images->count() }} {{ Str::plural('Photo', $images->count()) }}
            </p>
        </div>

        @if($images->isNotEmpty())
            {{-- Masonry Grid --}}
            <div class="gap-[10px] lg:columns-4 sm:columns-2 sm:gap-[6px]" id="tbgGrid">
                @foreach($images as $index => $image)
                    <button
                        class="block break-inside-avoid relative overflow-hidden rounded-[4px] mb-[10px] sm:mb-[6px] w-full border-0 p-0 bg-transparent cursor-zoom-in opacity-0 translate-y-4
                               hover:[&_img]:scale-105 focus-visible:[&_img]:scale-105
                               hover:[&_.gal-caption]:opacity-100 focus-visible:[&_.gal-caption]:opacity-100
                               focus-visible:outline focus-visible:outline-2 focus-visible:outline-white/80 focus-visible:outline-offset-2
                               motion-reduce:opacity-100 motion-reduce:translate-y-0"
                        data-index="{{ $index }}"
                        aria-label="View {{ $image['alt'] }}"
                    >
                        <img
                            class="block w-full h-auto transition-transform duration-500 ease-[cubic-bezier(0.25,0.46,0.45,0.94)] motion-reduce:transition-none"
                            src="{{ $image['url'] }}"
                            alt="{{ $image['alt'] }}"
                            loading="{{ $index < 6 ? 'eager' : 'lazy' }}"
                        >
                        <span class="gal-caption absolute bottom-0 left-0 right-0 px-3 pt-7 pb-2.5 text-[11px] tracking-[0.04em] text-white/90 opacity-0 transition-opacity duration-300 pointer-events-none"
                              style="background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 100%);">
                            {{ Str::title(str_replace(['-', '_'], ' ', $image['alt'])) }}
                        </span>
                    </button>
                @endforeach
            </div>
        @else
            <p class="text-center text-[#999] text-[15px] py-16">No photos available yet.</p>
        @endif

    </div>
</section>

{{-- Lightbox --}}
<div
    class="fixed inset-0 z-[9999] flex items-center justify-center opacity-0 transition-opacity duration-[280ms] ease-in-out motion-reduce:transition-none"
    id="tbgLb"
    role="dialog"
    aria-modal="true"
    aria-label="Image lightbox"
    style="background: rgba(10,9,8,0.92);"
    hidden
>
    <button
        class="absolute top-5 right-6 text-white/55 hover:text-white/90 transition-colors duration-200 p-2 leading-none bg-transparent border-0 cursor-pointer"
        id="tbgLbClose"
        aria-label="Close lightbox"
    >
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
            <path d="M1 1l16 16M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
    </button>
    <button
        class="absolute left-2 top-1/2 -translate-y-1/2 text-white/45 hover:text-white/90 transition-colors duration-200 px-5 py-4 leading-none bg-transparent border-0 cursor-pointer"
        id="tbgLbPrev"
        aria-label="Previous image"
    >
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
            <path d="M13 4l-6 6 6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    <div class="flex flex-col items-center gap-3 max-w-[90vw] max-h-[90vh]">
        <img
            class="block w-auto h-auto max-w-[90vw] max-h-[82vh] object-contain rounded-[3px] transition-opacity duration-200 motion-reduce:transition-none"
            id="tbgLbImg"
            src=""
            alt=""
        >
        <p class="text-[12px] tracking-[0.08em] text-white/45 m-0 text-center" id="tbgLbLabel"></p>
    </div>
    <button
        class="absolute right-2 top-1/2 -translate-y-1/2 text-white/45 hover:text-white/90 transition-colors duration-200 px-5 py-4 leading-none bg-transparent border-0 cursor-pointer"
        id="tbgLbNext"
        aria-label="Next image"
    >
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
            <path d="M7 4l6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-[11px] tracking-[0.1em] text-white/35" id="tbgLbCounter"></div>
</div>