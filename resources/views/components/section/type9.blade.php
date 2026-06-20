@php
    $sectionId = $section_data['id'] ?? 'about';
    $missions  = $section_data['missions'] ?? [];
@endphp

<section id="{{ $sectionId }}"
         class="py-12 sm:py-16 md:py-20 px-4 bg-[var(--color-background)]">

    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-10 md:gap-12 items-start">
            <div class="flex flex-col gap-4 sm:gap-5 md:gap-6">
                <div>
                    <span class="inline-block mb-2 sm:mb-3 font-sans text-[10px] sm:text-xs font-semibold tracking-widest uppercase
                                 text-accent">
                        {{ $section_data['eyebrow'] ?? 'Who we are' }}
                    </span>
                    <h2 class="font-heading font-bold text-2xl sm:text-3xl md:text-4xl
                                text-[var(--color-heading-text)] leading-tight">
                        {!! $section_data['title'] ?? 'Our Vision &amp; <br>Mission' !!}
                    </h2>
                </div>
                <div class="border-l-[3px] border-accent pl-4 sm:pl-5 py-1">
                    <p class="font-sans text-[10px] sm:text-[11px] font-semibold tracking-widest uppercase
                               text-accent mb-2 sm:mb-3">
                        Our Vision
                    </p>
                    <p class="font-sans text-sm text-[var(--color-body-text)] leading-relaxed text-justify md:text-left">
                        {{ $section_data['vision'] ?? '' }}
                    </p>
                </div>
            </div>
            <div class="flex flex-col gap-4 sm:gap-5">
                <p class="font-sans text-[10px] sm:text-[11px] font-semibold tracking-widest uppercase
                           text-[var(--color-body-text)]">
                    Our Mission
                </p>
                @foreach($missions as $mission)
                <div class="flex items-start gap-3 sm:gap-4
                            p-3 sm:p-4 rounded-xl
                            border border-[var(--color-border)]
                            bg-[var(--color-surface)]">
                    <div class="w-8 h-8 shrink-0
                                rounded-lg
                                bg-[var(--color-background)]
                                border border-[var(--color-border)]
                                flex items-center justify-center">
                        <i class="ti {{ $mission['icon'] }} text-accent"
                           aria-hidden="true"></i>
                    </div>
                    <div>
                        <p class="font-sans text-sm font-semibold
                                   text-[var(--color-heading-text)] mb-1">
                            {{ $mission['title'] }}
                        </p>
                        <p class="font-sans text-sm text-[var(--color-body-text)] leading-relaxed">
                            {{ $mission['desc'] }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>