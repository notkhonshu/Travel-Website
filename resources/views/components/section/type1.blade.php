@php
    $heroId = $section_data['id'] ?? 'hero';
    $search = $section_data['search'] ?? [];
@endphp

<section id="{{ $heroId }}"
    class="relative w-full overflow-hidden h-[80vh] sm:h-[60vh] md:h-[60vh] lg:h-[85vh] {{ $section_data['class'] ?? '' }}">

    <div class="absolute inset-0 z-0">
        <img src="{{ $section_data['background']['link'] ?? '' }}"
             alt="{{ $section_data['background']['alt'] ?? '' }}"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <div class="relative z-10 flex flex-col items-center justify-center gap-2 sm:gap-3 h-full px-4 sm:px-6 text-center">

        <p class="text-sm sm:text-base md:text-[20px] font-semibold text-white">
            #TripWithUs
        </p>

        <h1 class="font-heading font-semibold text-white leading-tight sm:leading-tight md:leading-snug lg:leading-15
                   text-2xl sm:text-3xl md:text-4xl lg:text-5xl
                   max-w-xs sm:max-w-md md:max-w-2xl lg:max-w-3xl pb-2 sm:pb-3">
            Your All-in-One
            <span class="text-secondary font-normal font-accent
                         text-2xl sm:text-3xl md:text-4xl lg:text-[60px]">
                Destination
            </span>
            for an Exhilarating
            <span class="text-secondary font-accent font-normal
                         text-2xl sm:text-3xl md:text-4xl lg:text-[60px]">
                Balinese
            </span>
            Holiday
        </h1>

        <p class="text-white text-center max-w-md sm:max-w-xl md:max-w-2xl
                  text-sm sm:text-base md:text-lg lg:text-xl
                  py-2 sm:py-3 lg:py-5">
            ATV thrills, Sunrise Jeeps, and island transfers—officially managed and tailored for unforgettable memories.
        </p>

        <div class="w-full max-w-md sm:max-w-xl md:max-w-2xl">
            @include('components.section.type6', [
                'hero_id'     => $heroId,
                'placeholder' => $search['placeholder'] ?? 'Search activity or package...',
                'url'         => $search['url'] ?? '/packages',
            ])
        </div>

    </div>

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