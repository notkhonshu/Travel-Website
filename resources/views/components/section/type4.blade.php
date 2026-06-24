@php
    $mode       = $section_data['mode']      ?? 'listing';
    $image      = $section_data['image']     ?? '';
    $title      = $section_data['title']     ?? '';
    $excerpt    = $section_data['excerpt']   ?? '';
    $link       = $section_data['link']      ?? '#';

    $price      = $section_data['price']      ?? null;
    $price_unit = $section_data['price_unit'] ?? 'person';

    $tag        = $section_data['tag']       ?? null;
    $highlight  = $section_data['highlight'] ?? null;

    $category   = $section_data['category']  ?? null;
    $date       = $section_data['date']       ?? null;
    $read_time  = $section_data['read_time']  ?? null;
@endphp

<a href="{{ $link }}"
   class="group flex flex-col rounded-[var(--radius-lg)] overflow-hidden bg-white border border-[var(--color-border,#e5e7eb)] hover:shadow-lg transition-shadow duration-200">
    <div class="overflow-hidden h-52 sm:h-44 md:h-48">
        <img src="{{ $image }}" alt="{{ $title }}"
             class="w-full h-full object-cover group-hover:scale-[1.04] transition-transform duration-350">
    </div>
    <div class="flex flex-col flex-1 px-4 pt-3 pb-4 gap-2 sm:px-3 sm:pt-2.5 sm:pb-3.5 md:px-4 md:pt-3 md:pb-4">
        @if($mode === 'destination')
            @if($tag)
                <span class="inline-flex items-center gap-1 w-fit px-2 py-0.5 rounded text-[10px] font-semibold
                             bg-[var(--color-primary)]/10 text-[var(--color-primary)] tracking-wide">
                    {{ $tag }}
                </span>
            @endif
            <h3 class="font-sans font-semibold text-sm text-[var(--color-heading-text)] leading-snug line-clamp-2">
                {{ $title }}
            </h3>
            <p class="font-sans text-xs text-[var(--color-body-text)] leading-relaxed line-clamp-2 flex-1">
                {{ $excerpt }}
            </p>
            @if($highlight)
                <div class="flex items-center gap-1.5 mt-2 pt-2 border-t border-[var(--color-border)]">
                    <i class="ti ti-star-filled text-amber-400 text-[11px]" aria-hidden="true"></i>
                    <span class="text-[11px] text-[var(--color-body-text)]/70">{{ $highlight }}</span>
                </div>
            @endif
        @elseif($mode === 'blog')
            @if($category)
                <span class="inline-flex items-center gap-1 w-fit px-2 py-0.5 rounded text-[10px] font-semibold
                             bg-[var(--color-primary)]/10 text-[var(--color-primary)] tracking-wide">
                    {{ $category }}
                </span>
            @endif
            <h3 class="font-sans font-semibold text-sm text-[var(--color-heading-text)] leading-snug line-clamp-2">
                {{ $title }}
            </h3>
            <p class="font-sans text-xs text-[var(--color-body-text)] leading-relaxed line-clamp-3 flex-1">
                {{ $excerpt }}
            </p>
            @if($date || $read_time)
                <div class="flex items-center gap-3 mt-2 pt-2 border-t border-[var(--color-border)]">
                    @if($date)
                        <span class="inline-flex items-center gap-1 text-[11px] text-[var(--color-body-text)]/60">
                            <i class="ti ti-calendar text-[11px]" aria-hidden="true"></i>
                            {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                        </span>
                    @endif
                    @if($read_time)
                        <span class="inline-flex items-center gap-1 text-[11px] text-[var(--color-body-text)]/60">
                            <i class="ti ti-clock text-[11px]" aria-hidden="true"></i>
                            {{ $read_time }} min read
                        </span>
                    @endif
                </div>
            @endif
        @else
            <h3 class="font-sans font-semibold text-sm text-[var(--color-heading-text)] leading-snug line-clamp-2">
                {{ $title }}
            </h3>
            <p class="font-sans text-xs text-[var(--color-body-text)] leading-relaxed line-clamp-2 flex-1">
                {{ $excerpt }}
            </p>
            <div class="flex flex-col items-end gap-1 mt-2 sm:gap-0.5 sm:mt-1">
                <span class="font-sans font-semibold text-[11px] text-primary-dark">From</span>
                <span class="font-sans font-bold text-base sm:text-sm text-secondary">
                    Rp {{ number_format($price, 0, ',', '.') }}
                    <span class="font-normal text-xs text-[var(--color-body-text)]/80">/{{ $price_unit }}</span>
                </span>
            </div>
        @endif
    </div>
</a>