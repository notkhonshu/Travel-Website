@props([
    'hero_id'     => 'hero',
    'placeholder' => 'Search activity or package...',
    'url'         => '/trip',
])
<div data-hero-sentinel="{{ $hero_id }}" class="h-px w-full pointer-events-none" aria-hidden="true"></div>

<div id="{{ $hero_id }}_search_wrap"
     class="relative flex justify-center w-full px-4
            transition-all duration-300 ease-in-out">

    <div id="{{ $hero_id }}_search_inner"
         class="flex items-center w-full max-w-lg
                bg-white border border-[var(--color-border)]
                rounded-full p-1 sm:p-1.5 gap-1.5 sm:gap-2
                transition-all duration-200">

        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[var(--color-body-text)]/50 shrink-0 ml-2 sm:ml-3"
             fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
        </svg>

        <input type="text"
               id="{{ $hero_id }}_search"
               placeholder="{{ $placeholder }}"
               class="flex-1 min-w-0 bg-transparent text-sm
                      text-[var(--color-heading-text)]
                      placeholder-[var(--color-body-text)]/50
                      outline-none border-none font-sans"
               aria-label="Search"
               autocomplete="off"
               onkeydown="if(event.key==='Enter'){ event.preventDefault(); heroSearchSubmit('{{ $hero_id }}', '{{ $url }}'); }"/>

        <button type="button"
                onclick="heroSearchSubmit('{{ $hero_id }}', '{{ $url }}')"
                aria-label="Search"
                class="flex items-center justify-center gap-1.5
                       bg-[var(--color-primary)] hover:bg-[var(--color-primary-light)]
                       text-white font-sans text-xs font-medium tracking-wide
                       w-10 h-10 sm:w-auto sm:h-auto
                       rounded-full shrink-0
                       sm:px-6 sm:py-3
                       transition-colors duration-200">
            <svg class="w-4 h-4 sm:w-3.5 sm:h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
            <span class="hidden sm:inline">Search</span>
        </button>

    </div>
</div>