@props([
    'image'      => $section_data['image'],
    'title'      => $section_data['title'],
    'excerpt'    => $section_data['excerpt'],
    'price'      => $section_data['price'],
    'price_unit' => $section_data['price_unit'],
    'link'       => $section_data['link'],
])

<a href="{{ $link }}"
   class="group flex flex-col rounded-[var(--radius-lg)] overflow-hidden bg-white border border-[var(--color-border,#e5e7eb)] hover:shadow-lg transition-shadow duration-200">
    <div class="overflow-hidden h-52 sm:h-44 md:h-48">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-[1.04] transition-transform duration-350">
    </div>
    <div class="flex flex-col flex-1 px-4 pt-3 pb-4 gap-2 sm:px-3 sm:pt-2.5 sm:pb-3.5 sm:gap-2 md:px-4 md:pt-3 md:pb-4">
        <h3 class="font-sans font-semibold text-sm sm:text-sm text-[var(--color-heading-text)]
                   leading-snug line-clamp-2">
            {{ $title }}
        </h3>
        <p class="font-sans text-xs sm:text-xs text-[var(--color-body-text)]
                  leading-relaxed line-clamp-2 flex-1">
            {{ $excerpt }}
        </p>
        <div class="flex flex-col items-end gap-1 mt-2 sm:gap-0.5 sm:mt-1">
            <span class="font-sans font-semibold text-[11px] sm:text-[10px] sm:text-[11px] text-primary-dark">From</span>
            <span class="font-sans font-bold text-base sm:text-sm sm:text-base text-accent">
                Rp {{ number_format($price, 0, ',', '.') }}
                <span class="font-normal text-xs sm:text-[10px] sm:text-xs text-[var(--color-body-text)]/80">/{{ $price_unit }}</span>
            </span>
        </div>
    </div>
</a>