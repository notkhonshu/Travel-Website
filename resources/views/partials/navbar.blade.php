@php
    $secondaryNav = config('data.nav.secondary', []);
    $packages     = collect(config('data.packages', []));
    $activities   = collect(config('data.activities', []));

    $destinations = collect(config('data.destinations', []))->map(function ($dest) use ($packages, $activities) {
        $dest['packages']   = $packages->whereIn('slug', $dest['packages'] ?? [])->values();
        $dest['activities'] = $activities->whereIn('slug', $dest['activities'] ?? [])->values();
        return $dest;
    });

    $destinationsNav      = $destinations->take(6);
    $destinationsFullmenu = $destinations->take(5);

    $packagesNav   = $packages->take(3);
    $activitiesNav = $activities->take(3);

    $tripNavbar = ($layout_settings['trip_navbar'] ?? false);

    $hasPackages   = $packages->isNotEmpty();
    $hasActivities = $activities->isNotEmpty();
    $hasTrip       = $hasPackages || $hasActivities;
    $hasDest       = $destinationsNav->isNotEmpty();
@endphp

<header id="tbg-header"
        data-trip="{{ $tripNavbar ? 'true' : 'false' }}"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-300 ease-in-out
               {{ $tripNavbar
                   ? 'bg-white border-b border-[var(--color-border)] shadow-[var(--shadow-card)]'
                   : 'bg-transparent border-b border-white/20' }}"
        role="banner">

    <nav class="grid items-center gap-x-6
                max-w-[1400px] mx-auto px-4 sm:px-6 h-[68px]
                {{ $tripNavbar
                    ? 'grid-cols-[1fr_auto_auto] md:grid-cols-[1fr_2fr_1fr]'
                    : 'grid-cols-[1fr_auto] md:grid-cols-[1fr_auto_1fr]' }}"
         aria-label="Main navigation">

        {{-- ══ COL 1 — LOGO ══ --}}
        <a href="{{ route('landing.index') }}"
           class="tbg-logo font-heading font-normal text-lg xl:text-2xl transition-colors duration-300
                  {{ $tripNavbar ? 'text-[var(--color-heading-text)]' : 'text-white' }}"
           aria-label="{{ config('app.name') }} — home">
            {{ config('app.name') }}
        </a>

        {{-- ══ COL 2 — DEFAULT: MAIN NAV | TRIP: SEARCHBAR (hidden di bawah md) ══ --}}
        @if(!$tripNavbar)

        {{-- DEFAULT NAV — hanya tampil di md ke atas --}}
        <div class="hidden md:flex items-center justify-center gap-0.5" role="list">

            {{-- ── Dropdown: Trip (Packages + Activities) ── --}}
            @if($hasTrip)
            <div class="tbg-menu-item relative" role="listitem">
                <button class="tbg-menu-trigger tbg-nav-text
                               flex items-center gap-1.5 px-3 py-2
                               rounded-lg font-sans text-sm font-medium text-white
                               transition-colors duration-200 cursor-pointer bg-transparent border-none
                               hover:bg-white/12"
                        aria-haspopup="true"
                        aria-expanded="false"
                        aria-controls="tbg-dropdown-packages">
                    Trip
                    <i class="ti ti-chevron-down text-sm transition-transform duration-300
                              [.tbg-menu-item.tbg-open_&]:rotate-180"
                       aria-hidden="true"></i>
                </button>

                <div id="tbg-dropdown-packages"
                     class="tbg-dropdown
                            absolute top-[calc(100%+10px)] left-1/2
                            -translate-x-1/2 -translate-y-1.5
                            bg-[var(--color-background)]
                            rounded-2xl
                            border border-[var(--color-border)]
                            shadow-[var(--shadow-card-hover)]
                            w-[420px]
                            opacity-0 pointer-events-none
                            transition-all duration-200 ease-in-out
                            [&.tbg-drop-open]:opacity-100
                            [&.tbg-drop-open]:pointer-events-auto
                            [&.tbg-drop-open]:-translate-x-1/2
                            [&.tbg-drop-open]:translate-y-0
                            z-50"
                     role="region"
                     aria-label="Trip menu">

                    <span class="absolute -top-[6px] left-1/2 -translate-x-1/2 rotate-45
                                 w-3 h-3 bg-[var(--color-background)]
                                 border-l border-t border-[var(--color-border)]
                                 rounded-tl-sm"
                          aria-hidden="true"></span>

                    @if($hasPackages)
                    <div class="p-2 pb-1">
                        <p class="px-2 py-1.5 font-sans text-[10px] font-semibold
                                  tracking-widest uppercase text-[var(--color-body-text)]">
                            Packages
                        </p>
                        <div class="{{ $packagesNav->count() === 1 ? 'grid grid-cols-1' : 'grid grid-cols-2' }} gap-0.5">
                            @foreach ($packagesNav as $pkg)
                            <a href="{{ route('trip.show', $pkg['slug']) }}"
                               class="flex items-start gap-3 p-3
                                      rounded-xl hover:bg-[var(--color-surface)]
                                      transition-colors duration-150 group">
                                <span class="flex-shrink-0 w-9 h-9
                                             rounded-lg bg-[var(--color-primary)]/8
                                             flex items-center justify-center
                                             text-[var(--color-secondary)] text-[17px] mt-0.5
                                             group-hover:bg-[var(--color-primary)]/14
                                             transition-colors">
                                    <i class="ti {{ $pkg['icon'] ?? 'ti-package' }} text-accent" aria-hidden="true"></i>
                                </span>
                                <span class="flex flex-col gap-0.5 min-w-0 overflow-hidden">
                                    <span class="font-sans text-[13.5px] font-medium
                                                 text-[var(--color-heading-text)] leading-tight truncate">
                                        {{ $pkg['title'] }}
                                    </span>
                                    <span class="font-sans text-[12px]
                                                 text-[var(--color-body-text)] leading-snug">
                                        {{ $pkg['duration'] }}
                                    </span>
                                </span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($hasPackages && $hasActivities)
                    <div class="mx-4 border-t border-[var(--color-border)]"></div>
                    @endif

                    @if($hasActivities)
                    <div class="p-2 pt-1">
                        <p class="px-2 py-1.5 font-sans text-[10px] font-semibold
                                  tracking-widest uppercase text-[var(--color-body-text)]">
                            Activities
                        </p>
                        <div class="{{ $activitiesNav->count() === 1 ? 'grid grid-cols-1' : 'grid grid-cols-2' }} gap-0.5">
                            @foreach ($activitiesNav as $act)
                            <a href="{{ route('trip.show', $act['slug']) }}"
                               class="flex items-start gap-3 p-3
                                      rounded-xl hover:bg-[var(--color-surface)]
                                      transition-colors duration-150 group">
                                <span class="flex-shrink-0 w-9 h-9
                                             rounded-lg bg-[var(--color-primary)]/8
                                             flex items-center justify-center
                                             text-[var(--color-secondary)] text-[17px] mt-0.5
                                             group-hover:bg-[var(--color-primary)]/14
                                             transition-colors">
                                    <i class="ti {{ $act['icon'] ?? 'ti-bolt' }} text-accent" aria-hidden="true"></i>
                                </span>
                                <span class="flex flex-col gap-0.5 min-w-0 overflow-hidden">
                                    <span class="font-sans text-[13.5px] font-medium
                                                 text-[var(--color-heading-text)] leading-tight truncate">
                                        {{ $act['title'] }}
                                    </span>
                                    <span class="font-sans text-[12px]
                                                 text-[var(--color-body-text)] leading-snug">
                                        {{ $act['duration'] }}
                                    </span>
                                </span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="px-3 pb-3 pt-1 border-t border-[var(--color-border)] mx-2
                                flex items-center justify-between">
                        <span class="font-sans text-[11px] text-[var(--color-body-text)] uppercase tracking-widest">
                            @if($hasPackages && $hasActivities)
                                {{ $packages->count() }} packages · {{ $activities->count() }} activities
                            @elseif($hasPackages)
                                {{ $packages->count() }} packages
                            @else
                                {{ $activities->count() }} activities
                            @endif
                        </span>
                        <a href="{{ route('trip.index') }}"
                           class="font-sans text-[11px] font-semibold text-[var(--color-accent)]
                                  flex items-center gap-1 hover:gap-1.5 transition-all duration-200">
                            View all <i class="ti ti-arrow-right text-xs"></i>
                        </a>
                    </div>

                </div>
            </div>
            @endif

            {{-- ── Dropdown: Destinations ── --}}
            @if($hasDest)
            <div class="tbg-menu-item relative" role="listitem">
                <button class="tbg-menu-trigger tbg-nav-text
                               flex items-center gap-1.5 px-3 py-2
                               rounded-lg font-sans text-sm font-medium text-white
                               transition-colors duration-200 cursor-pointer bg-transparent border-none
                               hover:bg-white/12"
                        aria-haspopup="true"
                        aria-expanded="false"
                        aria-controls="tbg-dropdown-destinations">
                    Destinations
                    <i class="ti ti-chevron-down text-sm transition-transform duration-300
                              [.tbg-menu-item.tbg-open_&]:rotate-180"
                       aria-hidden="true"></i>
                </button>

                <div id="tbg-dropdown-destinations"
                     class="tbg-dropdown
                            absolute top-[calc(100%+10px)] left-1/2
                            -translate-x-1/2 -translate-y-1.5
                            bg-[var(--color-background)]
                            rounded-2xl
                            border border-[var(--color-border)]
                            shadow-[var(--shadow-card-hover)]
                            w-[380px]
                            opacity-0 pointer-events-none
                            transition-all duration-200 ease-in-out
                            [&.tbg-drop-open]:opacity-100
                            [&.tbg-drop-open]:pointer-events-auto
                            [&.tbg-drop-open]:-translate-x-1/2
                            [&.tbg-drop-open]:translate-y-0
                            z-50"
                     role="region"
                     aria-label="Destinations menu">

                    <span class="absolute -top-[6px] left-1/2 -translate-x-1/2 rotate-45
                                 w-3 h-3 bg-[var(--color-background)]
                                 border-l border-t border-[var(--color-border)]
                                 rounded-tl-sm"
                          aria-hidden="true"></span>

                    <div class="p-2 gap-0.5
                                {{ $destinationsNav->count() === 1 ? 'grid grid-cols-1' : 'grid grid-cols-2' }}">
                        @foreach ($destinationsNav as $dest)
                        <a href="{{ route('trip.index', ['destination' => $dest['slug']]) }}"
                           class="flex items-start gap-3 p-3
                                  rounded-xl hover:bg-[var(--color-surface)]
                                  transition-colors duration-150 group">
                            <span class="flex-shrink-0 w-9 h-9
                                         rounded-lg bg-[var(--color-primary)]/8
                                         flex items-center justify-center
                                         text-[var(--color-secondary)] text-[17px] mt-0.5
                                         group-hover:bg-[var(--color-primary)]/14
                                         transition-colors">
                                <i class="ti ti-map-pin text-accent" aria-hidden="true"></i>
                            </span>
                            <span class="flex flex-col gap-0.5 min-w-0 overflow-hidden">
                                <span class="font-sans text-[13.5px] font-medium
                                             text-[var(--color-heading-text)] leading-tight truncate">
                                    {{ $dest['label'] }}
                                </span>
                                <span class="font-sans text-[12px]
                                             text-[var(--color-body-text)] leading-snug">
                                    {{ $dest['tagline'] }}
                                </span>
                            </span>
                        </a>
                        @endforeach
                    </div>

                    <div class="px-3 pb-3 pt-1 border-t border-[var(--color-border)] mx-2
                                flex items-center justify-between">
                        <span class="font-sans text-[11px] text-[var(--color-body-text)] uppercase tracking-widest">
                            Destinations — {{ $destinations->count() }} destinations
                        </span>
                        <a href="{{ route('trip.index') }}"
                           class="font-sans text-[11px] font-semibold text-[var(--color-accent)]
                                  flex items-center gap-1 hover:gap-1.5 transition-all duration-200">
                            View all <i class="ti ti-arrow-right text-xs"></i>
                        </a>
                    </div>

                </div>
            </div>
            @endif

        </div>

        @else

        {{-- TRIP SEARCHBAR — hanya tampil di md ke atas --}}
        <div class="relative w-full hidden md:block" id="tbg-search-wrap">
            <div class="flex items-center gap-2
                        bg-[var(--color-surface)] border border-[var(--color-border)]
                        rounded-full px-4 h-[42px]
                        transition-all duration-300
                        focus-within:ring-2 focus-within:ring-[var(--color-accent)]/40">
                <i class="ti ti-search text-[var(--color-body-text)] text-[15px] shrink-0"
                   aria-hidden="true"></i>
                <input id="tbg-search-input"
                       type="search"
                       placeholder="Search trips, activities, destinations…"
                       autocomplete="off"
                       class="flex-1 bg-transparent border-none outline-none
                              font-sans text-sm
                              text-[var(--color-heading-text)]
                              placeholder-[var(--color-body-text)]"
                       aria-label="Search"
                       aria-autocomplete="list"
                       aria-controls="tbg-search-results">
                <button id="tbg-search-clear"
                        class="hidden text-[var(--color-body-text)] hover:text-[var(--color-heading-text)]
                               transition-colors"
                        aria-label="Clear search">
                    <i class="ti ti-x text-sm"></i>
                </button>
            </div>

            <div id="tbg-search-results"
                 class="absolute top-[calc(100%+8px)] left-0 right-0
                        bg-[var(--color-background)]
                        border border-[var(--color-border)]
                        rounded-2xl shadow-[var(--shadow-card-hover)]
                        opacity-0 pointer-events-none scale-y-95 origin-top
                        transition-all duration-200
                        [&.tbg-search-open]:opacity-100
                        [&.tbg-search-open]:pointer-events-auto
                        [&.tbg-search-open]:scale-y-100
                        z-50 max-h-[420px] overflow-y-auto"
                 role="listbox">

                @if($hasPackages)
                <div class="tbg-result-group" data-group="packages">
                    <p class="px-4 pt-3 pb-1.5 font-sans text-[10px] font-semibold
                               tracking-widest uppercase text-[var(--color-body-text)]">
                        Packages
                    </p>
                    @foreach($packages as $pkg)
                    <a href="{{ route('trip.show', $pkg['slug']) }}"
                       data-search-title="{{ strtolower($pkg['title']) }}"
                       data-search-excerpt="{{ strtolower($pkg['excerpt'] ?? '') }}"
                       data-search-tags="{{ strtolower(($pkg['category'] ?? '') . ' ' . ($pkg['destination'] ?? '') . ' ' . ($pkg['difficulty'] ?? '') . ' ' . ($pkg['badge'] ?? '')) }}"
                       class="tbg-result-item flex items-center gap-3 px-4 py-2.5
                              hover:bg-[var(--color-surface)] transition-colors duration-150">
                        <img src="{{ asset($pkg['image']) }}" alt=""
                             class="w-9 h-9 rounded-lg object-cover shrink-0">
                        <div class="min-w-0">
                            <p class="font-sans text-sm font-medium text-[var(--color-heading-text)] truncate">
                                {{ $pkg['title'] }}
                            </p>
                            <p class="font-sans text-xs text-[var(--color-body-text)] flex items-center gap-1">
                                {{ $pkg['duration'] }}
                                &middot;
                                <span class="inline-flex items-center gap-0.5">
                                    <i class="ti ti-map-pin text-[10px]" aria-hidden="true"></i>
                                    Package
                                </span>
                            </p>
                        </div>
                        <i class="ti ti-arrow-right text-sm text-[var(--color-accent)] ml-auto shrink-0"></i>
                    </a>
                    @endforeach
                </div>
                @endif

                @if($hasActivities)
                <div class="tbg-result-group {{ $hasPackages ? 'border-t border-[var(--color-border)]' : '' }}"
                     data-group="activities">
                    <p class="px-4 pt-3 pb-1.5 font-sans text-[10px] font-semibold
                               tracking-widest uppercase text-[var(--color-body-text)]">
                        Activities
                    </p>
                    @foreach($activities as $act)
                    <a href="{{ route('trip.show', $act['slug']) }}"
                       data-search-title="{{ strtolower($act['title']) }}"
                       data-search-excerpt="{{ strtolower($act['excerpt'] ?? '') }}"
                       data-search-tags="{{ strtolower(($act['category'] ?? '') . ' ' . ($act['destination'] ?? '') . ' ' . ($act['difficulty'] ?? '') . ' ' . ($act['badge'] ?? '')) }}"
                       class="tbg-result-item flex items-center gap-3 px-4 py-2.5
                              hover:bg-[var(--color-surface)] transition-colors duration-150">
                        <img src="{{ $act['image'] }}" alt=""
                             class="w-9 h-9 rounded-lg object-cover shrink-0">
                        <div class="min-w-0">
                            <p class="font-sans text-sm font-medium text-[var(--color-heading-text)] truncate">
                                {{ $act['title'] }}
                            </p>
                            <p class="font-sans text-xs text-[var(--color-body-text)] flex items-center gap-1">
                                {{ $act['duration'] }}
                                &middot;
                                <span class="inline-flex items-center gap-0.5">
                                    <i class="ti ti-bolt text-[10px]" aria-hidden="true"></i>
                                    Activity
                                </span>
                            </p>
                        </div>
                        <i class="ti ti-arrow-right text-sm text-[var(--color-accent)] ml-auto shrink-0"></i>
                    </a>
                    @endforeach
                </div>
                @endif

                @if($hasDest)
                <div class="tbg-result-group {{ ($hasPackages || $hasActivities) ? 'border-t border-[var(--color-border)]' : '' }}"
                     data-group="destinations">
                    <p class="px-4 pt-3 pb-1.5 font-sans text-[10px] font-semibold
                               tracking-widest uppercase text-[var(--color-body-text)]">
                        Destinations
                    </p>
                    @foreach($destinations as $dest)
                    <a href="{{ route('trip.index', ['destination' => $dest['slug']]) }}"
                       data-search-title="{{ strtolower($dest['label']) }}"
                       data-search-excerpt="{{ strtolower(($dest['tagline'] ?? '') . ' ' . ($dest['highlight'] ?? '') . ' ' . ($dest['tag'] ?? '')) }}"
                       class="tbg-result-item flex items-center gap-3 px-4 py-2.5
                              hover:bg-[var(--color-surface)] transition-colors duration-150">
                        <span class="w-9 h-9 rounded-lg bg-[var(--color-surface)]
                                     border border-[var(--color-border)]
                                     flex items-center justify-center shrink-0">
                            <i class="ti ti-map-pin text-[var(--color-accent)] text-sm" aria-hidden="true"></i>
                        </span>
                        <div class="min-w-0">
                            <p class="font-sans text-sm font-medium text-[var(--color-heading-text)]">
                                {{ $dest['label'] }}
                            </p>
                            <p class="font-sans text-xs text-[var(--color-body-text)] truncate">
                                {{ $dest['tagline'] }}
                            </p>
                        </div>
                        <i class="ti ti-arrow-right text-sm text-[var(--color-accent)] ml-auto shrink-0"></i>
                    </a>
                    @endforeach
                </div>
                @endif

                <div id="tbg-search-empty" class="hidden px-4 py-8 text-center">
                    <i class="ti ti-search-off text-2xl text-[var(--color-border)] mb-2 block"></i>
                    <p class="font-sans text-sm text-[var(--color-body-text)]">No results found</p>
                </div>

            </div>
        </div>

        {{-- SEARCH ICON — hanya tampil di bawah md, sebagai pengganti searchbar --}}
        <div class="flex md:hidden items-center justify-center">
            <button id="tbg-search-icon-btn"
                    class="flex items-center justify-center w-10 h-10 rounded-lg
                           text-[var(--color-heading-text)]
                           hover:bg-[var(--color-surface)]
                           transition-colors duration-200 bg-transparent border-none cursor-pointer"
                    aria-label="Open search"
                    aria-expanded="false"
                    aria-controls="tbg-search-panel-mobile">
                <i class="ti ti-search text-[18px]" aria-hidden="true"></i>
            </button>
        </div>

        @endif

        {{-- ══ COL 3 — HAMBURGER ══ --}}
        <div class="flex items-center justify-end">
            <button id="tbg-burger-btn"
                    class="tbg-burger
                        flex flex-col justify-center items-end gap-[6px]
                        w-10 h-10 p-2
                        bg-transparent border-none cursor-pointer
                        rounded-lg
                        transition-colors duration-200
                        {{ $tripNavbar ? 'hover:bg-[var(--color-surface)]' : 'hover:bg-white/12' }}"
                    aria-label="Toggle menu"
                    aria-expanded="false"
                    aria-controls="tbg-fullmenu">
                <span class="tbg-bar-2 block h-[2.5px] w-6 rounded-sm
                            transition-all duration-300
                            {{ $tripNavbar ? 'bg-[var(--color-heading-text)]' : 'bg-white' }}"></span>
                <span class="tbg-bar-2 block h-[2px] w-6 rounded-sm
                            transition-all duration-300
                            {{ $tripNavbar ? 'bg-[var(--color-heading-text)]' : 'bg-white' }}"></span>
            </button>
        </div>

    </nav>

    {{-- ═══════════════════════════════════════════
         SEARCH PANEL MOBILE — slide down, trip navbar only
         ═══════════════════════════════════════════ --}}
    @if($tripNavbar)
    <div id="tbg-search-panel-mobile"
         class="md:hidden
                absolute top-full left-0 right-0
                bg-[var(--color-background)]
                border-b border-[var(--color-border)]
                shadow-[var(--shadow-card-hover)]
                opacity-0 pointer-events-none -translate-y-2
                transition-all duration-200 ease-in-out
                [&.tbg-search-panel-open]:opacity-100
                [&.tbg-search-panel-open]:pointer-events-auto
                [&.tbg-search-panel-open]:translate-y-0
                z-40">

        <div class="px-4 py-3">
            <div class="flex items-center gap-2
                        bg-[var(--color-surface)] border border-[var(--color-border)]
                        rounded-full px-4 h-[44px]
                        focus-within:ring-2 focus-within:ring-[var(--color-accent)]/40
                        transition-all duration-200">
                <i class="ti ti-search text-[var(--color-body-text)] text-[15px] shrink-0" aria-hidden="true"></i>
                <input id="tbg-search-input-mobile"
                       type="search"
                       placeholder="Search trips, activities…"
                       autocomplete="off"
                       class="flex-1 bg-transparent border-none outline-none
                              font-sans text-sm
                              text-[var(--color-heading-text)]
                              placeholder-[var(--color-body-text)]"
                       aria-label="Search">
                <button id="tbg-search-clear-mobile"
                        class="hidden text-[var(--color-body-text)] hover:text-[var(--color-heading-text)]
                               bg-transparent border-none cursor-pointer transition-colors"
                        aria-label="Clear search">
                    <i class="ti ti-x text-sm"></i>
                </button>
            </div>
        </div>

        <div id="tbg-search-results-mobile"
             class="px-4 pb-3 max-h-[50vh] overflow-y-auto"
             role="listbox">

            @if($hasPackages)
            <div class="tbg-result-group-mobile" data-group="packages">
                <p class="pt-2 pb-1.5 font-sans text-[10px] font-semibold
                           tracking-widest uppercase text-[var(--color-body-text)]">
                    Packages
                </p>
                @foreach($packages as $pkg)
                <a href="{{ route('trip.show', $pkg['slug']) }}"
                   data-search-title="{{ strtolower($pkg['title']) }}"
                   data-search-excerpt="{{ strtolower($pkg['excerpt'] ?? '') }}"
                   data-search-tags="{{ strtolower(($pkg['category'] ?? '') . ' ' . ($pkg['destination'] ?? '') . ' ' . ($pkg['difficulty'] ?? '') . ' ' . ($pkg['badge'] ?? '')) }}"
                   class="tbg-result-item-mobile flex items-center gap-3 py-2.5
                          rounded-xl hover:bg-[var(--color-surface)] px-2 -mx-2
                          transition-colors duration-150">
                    <img src="{{ asset($pkg['image']) }}" alt=""
                         class="w-9 h-9 rounded-lg object-cover shrink-0">
                    <div class="min-w-0 flex-1">
                        <p class="font-sans text-sm font-medium text-[var(--color-heading-text)] truncate">
                            {{ $pkg['title'] }}
                        </p>
                        <p class="font-sans text-xs text-[var(--color-body-text)]">
                            {{ $pkg['duration'] }} · Package
                        </p>
                    </div>
                    <i class="ti ti-arrow-right text-sm text-[var(--color-accent)] shrink-0"></i>
                </a>
                @endforeach
            </div>
            @endif

            @if($hasActivities)
            <div class="tbg-result-group-mobile {{ $hasPackages ? 'border-t border-[var(--color-border)] mt-1 pt-1' : '' }}"
                 data-group="activities">
                <p class="pt-2 pb-1.5 font-sans text-[10px] font-semibold
                           tracking-widest uppercase text-[var(--color-body-text)]">
                    Activities
                </p>
                @foreach($activities as $act)
                <a href="{{ route('trip.show', $act['slug']) }}"
                   data-search-title="{{ strtolower($act['title']) }}"
                   data-search-excerpt="{{ strtolower($act['excerpt'] ?? '') }}"
                   data-search-tags="{{ strtolower(($act['category'] ?? '') . ' ' . ($act['destination'] ?? '') . ' ' . ($act['difficulty'] ?? '') . ' ' . ($act['badge'] ?? '')) }}"
                   class="tbg-result-item-mobile flex items-center gap-3 py-2.5
                          rounded-xl hover:bg-[var(--color-surface)] px-2 -mx-2
                          transition-colors duration-150">
                    <img src="{{ $act['image'] }}" alt=""
                         class="w-9 h-9 rounded-lg object-cover shrink-0">
                    <div class="min-w-0 flex-1">
                        <p class="font-sans text-sm font-medium text-[var(--color-heading-text)] truncate">
                            {{ $act['title'] }}
                        </p>
                        <p class="font-sans text-xs text-[var(--color-body-text)]">
                            {{ $act['duration'] }} · Activity
                        </p>
                    </div>
                    <i class="ti ti-arrow-right text-sm text-[var(--color-accent)] shrink-0"></i>
                </a>
                @endforeach
            </div>
            @endif

            @if($hasDest)
            <div class="tbg-result-group-mobile {{ ($hasPackages || $hasActivities) ? 'border-t border-[var(--color-border)] mt-1 pt-1' : '' }}"
                 data-group="destinations">
                <p class="pt-2 pb-1.5 font-sans text-[10px] font-semibold
                           tracking-widest uppercase text-[var(--color-body-text)]">
                    Destinations
                </p>
                @foreach($destinations as $dest)
                <a href="{{ route('trip.index', ['destination' => $dest['slug']]) }}"
                   data-search-title="{{ strtolower($dest['label']) }}"
                   data-search-excerpt="{{ strtolower(($dest['tagline'] ?? '') . ' ' . ($dest['highlight'] ?? '') . ' ' . ($dest['tag'] ?? '')) }}"
                   class="tbg-result-item-mobile flex items-center gap-3 py-2.5
                          rounded-xl hover:bg-[var(--color-surface)] px-2 -mx-2
                          transition-colors duration-150">
                    <span class="w-9 h-9 rounded-lg bg-[var(--color-surface)]
                                 border border-[var(--color-border)]
                                 flex items-center justify-center shrink-0">
                        <i class="ti ti-map-pin text-[var(--color-accent)] text-sm" aria-hidden="true"></i>
                    </span>
                    <div class="min-w-0 flex-1">
                        <p class="font-sans text-sm font-medium text-[var(--color-heading-text)]">
                            {{ $dest['label'] }}
                        </p>
                        <p class="font-sans text-xs text-[var(--color-body-text)] truncate">
                            {{ $dest['tagline'] }}
                        </p>
                    </div>
                    <i class="ti ti-arrow-right text-sm text-[var(--color-accent)] shrink-0"></i>
                </a>
                @endforeach
            </div>
            @endif

            <div id="tbg-search-empty-mobile" class="hidden py-8 text-center">
                <i class="ti ti-search-off text-2xl text-[var(--color-border)] mb-2 block"></i>
                <p class="font-sans text-sm text-[var(--color-body-text)]">No results found</p>
            </div>

        </div>
    </div>
    @endif

    {{-- ═══════════════════════════════════════════
         BUBBLE
         ═══════════════════════════════════════════ --}}
    <div id="tbg-menu-bubble"
         aria-hidden="true"
         style="
             position: fixed;
             border-radius: 50%;
             background: var(--color-background);
             pointer-events: none;
             opacity: 0;
             z-index: 998;
             will-change: transform, opacity;
         ">
    </div>

    {{-- ═══════════════════════════════════════════
         FULL SCREEN MENU
         ═══════════════════════════════════════════ --}}
    <div id="tbg-fullmenu"
         style="
             position: fixed;
             inset: 0;
             background: transparent;
             opacity: 0;
             pointer-events: none;
             z-index: 999;
             overflow-y: auto;
             -webkit-overflow-scrolling: touch;
             transition: opacity 200ms ease-in-out;
         "
         aria-hidden="true"
         role="dialog"
         aria-modal="true"
         aria-label="Site menu">

        <div class="flex items-center justify-between
                    max-w-[1400px] mx-auto px-4 sm:px-8 h-[68px]
                    border-b border-[var(--color-border)]
                    sticky top-0 bg-[var(--color-background)] z-10">
            <a href="{{ route('landing.index') }}"
               class="font-heading font-normal text-xl sm:text-2xl text-[var(--color-heading-text)]">
                {{ config('app.name') }}
            </a>
            <button id="tbg-menu-close"
                    class="flex items-center gap-2
                           font-sans text-sm sm:text-lg text-[var(--color-body-text)]
                           hover:text-[var(--color-heading-text)]
                           bg-transparent border-none cursor-pointer
                           transition-colors duration-200"
                    aria-label="Close menu">
                Close
                <i class="ti ti-x text-xl sm:text-2xl" aria-hidden="true"></i>
            </button>
        </div>

        <div class="max-w-[1400px] mx-auto px-4 sm:px-8 py-8 sm:py-12
                    grid grid-cols-1 {{ $hasTrip ? 'md:grid-cols-2' : '' }} gap-x-8 gap-y-10">
            @if($hasTrip)
            <div>
                <div class="flex items-center justify-between mb-5 sm:mb-6
                            border-b border-[var(--color-border)] pb-4">
                    <h2 class="font-heading font-bold text-xl sm:text-2xl text-[var(--color-heading-text)]">
                        Trip
                    </h2>
                    <a href="{{ route('trip.index') }}"
                       class="font-sans text-xs text-[var(--color-accent)] flex items-center gap-1
                              hover:gap-2 transition-all duration-200">
                        View all <i class="ti ti-arrow-right text-sm"></i>
                    </a>
                </div>

                @if($hasPackages)
                <p class="font-sans text-[10px] font-semibold tracking-widest uppercase
                          text-[var(--color-body-text)] mb-2">
                    Packages
                </p>
                @foreach($packagesNav as $pkg)
                <a href="{{ route('trip.show', $pkg['slug']) }}"
                   class="group flex items-center justify-between
                          py-3.5 border-b border-[var(--color-border)]
                          hover:pl-1.5 transition-all duration-200">
                    <div class="min-w-0 mr-3">
                        <p class="font-sans text-sm font-medium text-[var(--color-heading-text)]
                                   group-hover:text-[var(--color-accent)] transition-colors duration-200 leading-snug truncate">
                            {{ $pkg['title'] }}
                        </p>
                        <p class="font-sans text-xs text-[var(--color-body-text)] mt-0.5">
                            {{ $pkg['duration'] }}
                            @if(!empty($pkg['badge']))
                                &middot; <span class="text-[var(--color-accent)] font-medium">{{ $pkg['badge'] }}</span>
                            @endif
                        </p>
                    </div>
                    <i class="ti ti-arrow-right text-sm text-[var(--color-border)]
                              group-hover:text-[var(--color-accent)] group-hover:translate-x-1
                              transition-all duration-200 shrink-0"></i>
                </a>
                @endforeach
                @endif

                @if($hasActivities)
                <p class="font-sans text-[10px] font-semibold tracking-widest uppercase
                          text-[var(--color-body-text)] mb-2
                          {{ $hasPackages ? 'mt-6' : '' }}">
                    Activities
                </p>
                @foreach($activitiesNav as $act)
                <a href="{{ route('trip.show', $act['slug']) }}"
                   class="group flex items-center justify-between
                          py-3.5 border-b border-[var(--color-border)]
                          hover:pl-1.5 transition-all duration-200">
                    <div class="min-w-0 mr-3">
                        <p class="font-sans text-sm font-medium text-[var(--color-heading-text)]
                                   group-hover:text-[var(--color-accent)] transition-colors duration-200 leading-snug truncate">
                            {{ $act['title'] }}
                        </p>
                        <p class="font-sans text-xs text-[var(--color-body-text)] mt-0.5">
                            {{ $act['duration'] }}
                            @if(!empty($act['badge']))
                                &middot; <span class="text-[var(--color-accent)] font-medium">{{ $act['badge'] }}</span>
                            @endif
                        </p>
                    </div>
                    <i class="ti ti-arrow-right text-sm text-[var(--color-border)]
                              group-hover:text-[var(--color-accent)] group-hover:translate-x-1
                              transition-all duration-200 shrink-0"></i>
                </a>
                @endforeach
                @endif
            </div>
            @endif
            <div class="flex flex-col gap-10">
                @if($destinationsFullmenu->isNotEmpty())
                <div>
                    <div class="border-b border-[var(--color-border)] pb-4 mb-5 sm:mb-6">
                        <h2 class="font-heading font-bold text-xl sm:text-2xl text-[var(--color-heading-text)]">
                            Destinations
                        </h2>
                    </div>
                    @foreach($destinationsFullmenu as $dest)
                    <a href="{{ route('trip.index', ['destination' => $dest['slug']]) }}"
                       class="group flex items-center justify-between
                              py-3.5 border-b border-[var(--color-border)]
                              hover:pl-1.5 transition-all duration-200">
                        <div class="min-w-0 mr-3">
                            <p class="font-sans text-sm font-medium text-[var(--color-heading-text)]
                                       group-hover:text-[var(--color-accent)] transition-colors duration-200">
                                {{ $dest['label'] }}
                            </p>
                            <p class="font-sans text-xs text-[var(--color-body-text)] mt-0.5 truncate">
                                {{ $dest['tagline'] }}
                            </p>
                        </div>
                        <i class="ti ti-arrow-right text-sm text-[var(--color-border)]
                                  group-hover:text-[var(--color-accent)] group-hover:translate-x-1
                                  transition-all duration-200 shrink-0"></i>
                    </a>
                    @endforeach
                </div>
                @endif

                <div>
                    <div class="border-b border-[var(--color-border)] pb-4 mb-4">
                        <h2 class="font-heading font-bold text-xl sm:text-2xl text-[var(--color-heading-text)]">
                            More
                        </h2>
                    </div>
                    @foreach($secondaryNav as $sec)
                        <a href="{{ route($sec['route']) }}"
                        class="group flex items-center gap-2.5
                                py-3.5 border-b border-[var(--color-border)]
                                font-sans text-sm font-medium text-[var(--color-heading-text)]
                                hover:text-[var(--color-accent)] hover:pl-1.5 transition-all duration-200">
                            <i class="ti {{ $sec['icon'] }} text-[var(--color-body-text)]
                                    group-hover:text-[var(--color-accent)] text-base transition-colors duration-200"
                            aria-hidden="true"></i>
                            {{ $sec['label'] }}
                        </a>
                    @endforeach
                    <div class="flex items-center gap-5 mt-6 pb-8 md:pb-0">
                        <a href="{{ config('social.instagram.url') }}" target="_blank" rel="noopener"
                           class="text-[var(--color-body-text)] hover:text-[var(--color-accent)] text-xl transition-colors"
                           aria-label="Instagram">
                            <i class="ti ti-brand-instagram"></i>
                        </a>
                        <a href="{{ config('social.facebook.url') }}" target="_blank" rel="noopener"
                           class="text-[var(--color-body-text)] hover:text-[var(--color-accent)] text-xl transition-colors"
                           aria-label="Facebook">
                            <i class="ti ti-brand-facebook"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>