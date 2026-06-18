@php
    $heroId = $section_data['id'] ?? 'hero';
@endphp

<section id="{{ $heroId }}"
    class="relative w-full overflow-hidden h-[60vh] sm:h-[65vh] md:h-[70vh] lg:h-180 {{ $section_data['class'] ?? '' }}">

    <div class="absolute inset-0 z-0">
        <img src="{{ $section_data['background']['link'] ?? '' }}"
             alt="{{ $section_data['background']['alt'] ?? '' }}"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <div class="relative z-10 flex flex-col items-center justify-center gap-2 sm:gap-3 h-full px-4 sm:px-6 text-center">
        <h1 class="font-heading font-bold text-white leading-tight sm:leading-tight md:leading-snug lg:leading-15
                   text-3xl sm:text-4xl md:text-5xl
                   max-w-xs sm:max-w-md md:max-w-xl pb-2 sm:pb-3">
            {!! $section_data['title'] ?? '' !!}
        </h1>
        <p class="text-white text-center
                  text-sm sm:text-base md:text-lg lg:text-xl
                  max-w-md sm:max-w-xl md:max-w-2xl
                  py-2 sm:py-3 lg:py-5">
            {!! $section_data['description'] ?? '' !!}
        </p>
    </div>

    {{-- Sentinel --}}
    <div id="{{ $heroId }}_sentinel"
         data-hero-sentinel="{{ $heroId }}"
         class="absolute bottom-0 left-0 w-full h-px pointer-events-none"></div>

    @if (!empty($section_data['scroll_to']))
        <div class="absolute bottom-4 sm:bottom-6 w-full flex justify-center z-10">
            <a href="{{ $section_data['scroll_to'] }}"
               aria-label="Scroll down"
               class="animate-bounce"
               data-scroll-target="{{ $section_data['scroll_to'] }}"
               onclick="
                   event.preventDefault();
                   var target = document.querySelector(this.getAttribute('data-scroll-target'));
                   if (target) {
                       var navbar = document.getElementById('tbg-header');
                       var offset = navbar ? navbar.offsetHeight : 0;
                       var top = target.getBoundingClientRect().top + window.scrollY - offset;
                       window.scrollTo({ top: top, behavior: 'smooth' });
                   }
               ">
                <svg width="32" height="32" fill="none" viewBox="0 0 76 76"
                     class="stroke-current text-white/50 sm:w-10 sm:h-10 md:w-11 md:h-11"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="m22.8 30.4 15.2 15.2 15.2-15.2" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </a>
        </div>
    @endif
</section>