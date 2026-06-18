@php
    $sectionId   = 'cta-booking';
    $eyebrow     = 'Tailored for you';
    $title       = 'Private & Group';
    $titleAccent = 'Bookings';
    $description = 'Elevate your journey with our tailor-made Private and Group Adventure services. From intimate getaways to large-scale group itineraries, our professional team is ready to design a seamless, unforgettable experience for you.';
    $ctaLabel    = 'Contact Our Team';
    $ctaLink     = config('social.customer_service.url_email');
@endphp

<section id="{{ $sectionId }}" class="py-12 sm:py-16 md:py-20 px-4 bg-primary">
    <div class="max-w-7xl mx-auto text-center">

        <div class="flex items-center justify-center gap-3 mb-4 sm:mb-6">
            <span class="font-sans text-[10px] sm:text-[11px] font-semibold tracking-widest uppercase
                         text-white">
                {{ $eyebrow }}
            </span>
        </div>

        <h2 class="font-heading font-bold text-2xl sm:text-3xl md:text-4xl text-white leading-tight mb-4 sm:mb-6">
            {{ $title }}
            <span class="text-accent">{{ $titleAccent }}</span>
        </h2>

        <p class="font-sans text-sm md:text-base text-white leading-relaxed max-w-2xl mx-auto mb-6 sm:mb-8">
            {{ $description }}
        </p>

        <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 md:gap-6 mb-8 sm:mb-10">
            <span class="flex items-center gap-1.5 sm:gap-2 font-sans text-sm sm:text-[16px] text-white">
                <i class="ti ti-users text-accent" aria-hidden="true"></i>
                Private groups
            </span>
            <span class="flex items-center gap-1.5 sm:gap-2 font-sans text-sm sm:text-[16px] text-white">
                <i class="ti ti-calendar-event text-accent" aria-hidden="true"></i>
                Custom itineraries
            </span>
            <span class="flex items-center gap-1.5 sm:gap-2 font-sans text-sm sm:text-[16px] text-white">
                <i class="ti ti-headset text-accent" aria-hidden="true"></i>
                Dedicated support
            </span>
        </div>

        <a href="{{ $ctaLink }}"
           class="inline-flex items-center gap-2 sm:gap-2.5
                  font-sans text-xs sm:text-sm font-semibold
                  bg-accent text-white
                  px-5 sm:px-6 md:px-7 py-3 sm:py-3.5 rounded-[var(--radius-md)]
                  hover:opacity-90 active:scale-[.98]
                  transition-all duration-200">
            <i class="ti ti-map-pin" aria-hidden="true"></i>
            {{ $ctaLabel }}
        </a>

        <p class="mt-3 sm:mt-4 font-sans text-xs text-white/80">
            Usually responds within a few hours &middot; No commitment required
        </p>

    </div>
    <span class="block h-px bg-white mt-8 sm:mt-10"></span>
</section>