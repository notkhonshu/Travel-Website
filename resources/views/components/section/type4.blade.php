@props([
    'image'      => $section_data['image'],
    'title'      => $section_data['title'],
    'excerpt'    => $section_data['excerpt'],
    'price'      => $section_data['price'],
    'price_unit' => $section_data['price_unit'],
    'link'       => $section_data['link'],
])

<a href="{{ $link }}"
   class="group flex flex-col rounded-[var(--radius-lg)] overflow-hidden
          bg-white border border-[var(--color-border,#e5e7eb)]
          hover:shadow-lg transition-shadow duration-200">

    <div class="overflow-hidden aspect-[4/3]">
        <img src="{{ $image }}"
             alt="{{ $title }}"
             class="w-full h-full object-cover
                    group-hover:scale-[1.04] transition-transform duration-350">
    </div>
    <div class="flex flex-col flex-1 px-2.5 sm:px-3 md:px-4 pt-2 sm:pt-2.5 md:pt-3 pb-3 sm:pb-3.5 md:pb-4 gap-1.5 sm:gap-2">
        <h3 class="font-sans font-semibold text-xs sm:text-sm text-[var(--color-heading-text)]
                   leading-snug line-clamp-2">
            {{ $title }}
        </h3>
        <p class="font-sans text-[11px] sm:text-xs text-[var(--color-body-text)]
                  leading-relaxed line-clamp-1 sm:line-clamp-2 flex-1">
            {{ $excerpt }}
        </p>
        <div class="flex flex-col items-end gap-0.5 mt-1">
            <span class="font-sans font-semibold text-[10px] sm:text-[11px] text-primary-dark">From</span>
            <span class="font-sans font-bold text-sm sm:text-base text-accent">
                Rp {{ number_format($price, 0, ',', '.') }}
                <span class="font-normal text-[10px] sm:text-xs text-[var(--color-body-text)]/80">/{{ $price_unit }}</span>
            </span>
        </div>

    </div>
</a>