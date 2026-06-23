@php
    $sectionId      = 'about-us';
    $eyebrow        = 'Who We Are';
    $title          = config('app.name');
    $description    = 'Bali Guide Adventure is your trusted companion in discovering the beauty, culture, and hidden gems of the Island of the Gods. More than just a tour service, we are passionate local guides who are dedicated to creating memorable journeys tailored to your needs. With years of experience and in-depth knowledge of Bali, we offer a wide range of adventures — from exploring breathtaking temples, lush rice terraces, and pristine beaches, to immersing yourself in authentic Balinese traditions and local hospitality.';
    $ctaLabel       = 'Browse All Trips';
    $ctaLink        = route('trip.index');
    $secondaryLink  = config('social.customer_service.url_email');
@endphp

<section id="{{ $sectionId }}" class="py-10 sm:py-14 md:py-16 px-4 bg-[var(--color-background)]">
    <div class="max-w-7xl mx-auto">
        <div class="rounded-[var(--radius-xl)] overflow-hidden
                    bg-[var(--color-primary)]
                    shadow-[var(--shadow-card-hover)]">

            <div class="px-5 sm:px-8 py-8 sm:py-12 md:px-14 md:py-14">
                <div class="flex flex-col md:flex-row items-start justify-between gap-6 sm:gap-8 mb-8 sm:mb-10">
                    <div class="flex-1 min-w-0">
                        <span class="inline-block mb-3 sm:mb-4 font-sans text-[10px] sm:text-[11px] font-semibold
                                     tracking-widest uppercase text-accent">
                            {{ $eyebrow ?? "Who We Are" }}
                        </span>
                        <h2 class="font-heading font-bold text-xl sm:text-2xl md:text-3xl text-white
                                   leading-snug mb-3 sm:mb-5">
                            {{ $title ?? "The Bali Guides Adventure" }}
                        </h2>
                        <p class="font-sans text-sm text-white/70 leading-relaxed max-w-2xl text-justify">
                            {{ $description ?? "Bali Guide Adventure is your trusted companion in discovering the beauty, culture, and hidden gems of the Island of the Gods. More than just a tour service, we are passionate local guides who are dedicated to creating memorable journeys tailored to your needs. With years of experience and in-depth knowledge of Bali, we offer a wide range of adventures — from exploring breathtaking temples, lush rice terraces, and pristine beaches, to immersing yourself in authentic Balinese traditions and local hospitality." }}
                        </p>
                    </div>

                    <div class="shrink-0 w-full md:w-auto md:self-center">
                        <div class="bg-white rounded-[var(--radius-lg)]
                                    shadow-[0_8px_32px_rgba(0,0,0,0.18)]
                                    px-5 sm:px-6 py-5 sm:py-7 flex flex-col gap-3 sm:gap-4 md:min-w-[220px]">

                            <p class="font-sans text-xs text-[var(--color-body-text)] leading-snug">
                                Ready to explore Bali with a local expert?
                            </p>

                            <a href="{{ $section_data['cta_link'] }}"
                            class="flex items-center justify-between gap-3
                                    bg-[var(--color-primary)] hover:bg-[var(--color-primary-light)]
                                    text-white font-sans text-sm font-semibold
                                    px-5 py-3 rounded-[var(--radius-md)]
                                    transition-colors duration-200 group">
                                <span>Browse All Trip</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-0.5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>

                            <a href="{{ $section_data['secondary_link'] ?? route('landing.contact') }}"
                            class="text-center font-sans text-xs text-[var(--color-body-text)]
                                    hover:text-[var(--color-primary)] transition-colors duration-150">
                                or get in touch with us
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4">

                    <div class="bg-white/10 rounded-[var(--radius-lg)] px-4 py-5 sm:py-6
                                flex flex-col items-start text-left gap-3">
                        <div class="w-12 h-12 rounded-full bg-white/15 flex items-center justify-center shrink-0">
                            <i class="ti ti-star text-accent text-2xl"></i>
                        </div>
                        <p class="font-heading font-bold text-sm text-white leading-snug">Expert Local Guides</p>
                        <p class="font-sans text-xs text-white/60 leading-relaxed">
                            Vetted for their expertise and experience.
                        </p>
                    </div>

                    <div class="bg-white/10 rounded-[var(--radius-lg)] px-4 py-5 sm:py-6
                                flex flex-col items-start text-left gap-3">
                        <div class="w-12 h-12 rounded-full bg-white/15 flex items-center justify-center shrink-0">
                            <i class="ti ti-route text-accent text-2xl"></i>
                        </div>
                        <p class="font-heading font-bold text-sm text-white leading-snug">Customizable Private Tours</p>
                        <p class="font-sans text-xs text-white/60 leading-relaxed">
                            Shape a tour to your interests, pace, and priorities.
                        </p>
                    </div>

                    <div class="bg-white/10 rounded-[var(--radius-lg)] px-4 py-5 sm:py-6
                                flex flex-col items-start text-left gap-3">
                        <div class="w-12 h-12 rounded-full bg-white/15 flex items-center justify-center shrink-0">
                            <i class="ti ti-calendar-x text-accent text-2xl"></i>
                        </div>
                        <p class="font-heading font-bold text-sm text-white leading-snug">Flexible Cancellation</p>
                        <p class="font-sans text-xs text-white/60 leading-relaxed">
                            Standard policy is always included, with option to upgrade.
                        </p>
                    </div>

                    <div class="bg-white/10 rounded-[var(--radius-lg)] px-4 py-5 sm:py-6
                                flex flex-col items-start text-left gap-3">
                        <div class="w-12 h-12 rounded-full bg-white/15 flex items-center justify-center shrink-0">
                            <i class="ti ti-headset text-accent text-2xl"></i>
                        </div>
                        <p class="font-heading font-bold text-sm text-white leading-snug">In-House Support</p>
                        <p class="font-sans text-xs text-white/60 leading-relaxed">
                            Our staff are ready to help you with 24/7 assistance.
                        </p>
                    </div>

                    <div class="bg-white/10 rounded-[var(--radius-lg)] px-4 py-5 sm:py-6
                                flex flex-col items-start text-left gap-3">
                        <div class="w-12 h-12 rounded-full bg-white/15 flex items-center justify-center shrink-0">
                            <i class="ti ti-ship text-accent text-2xl"></i>
                        </div>
                        <p class="font-heading font-bold text-sm text-white leading-snug">Return to Ship Guarantee</p>
                        <p class="font-sans text-xs text-white/60 leading-relaxed">
                            Back on time, or we cover the costs & logistics.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>