@php
    $listings          = $listings          ?? collect();
    $categories        = $categories        ?? [];
    $activeCategory    = $activeCategory    ?? 'all';
    $activeDestination = $activeDestination ?? '';
    $sort              = $sort              ?? 'default';
    $q                 = $q                 ?? '';

    $destinationData = $activeDestination !== ''
        ? collect(config('data.destinations', []))->firstWhere('slug', $activeDestination)
        : null;

    $destinationLabel = $destinationData['label'] ?? \Illuminate\Support\Str::title(str_replace('-', ' ', $activeDestination));

    $baseQuery = array_filter([
        'category'    => $activeCategory !== 'all' ? $activeCategory : null,
        'destination' => $activeDestination ?: null,
        'sort'        => $sort !== 'default'    ? $sort         : null,
        'q'           => $q ?: null,
    ]);
@endphp

<section id="listing" class="pt-[156px] lg:pt-[164px] pb-10" style="margin-top:80px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">

        {{-- ── Top bar: count + sort ───────────────────────────────────────── --}}
        <div class="flex items-center justify-between flex-wrap gap-1">
            <p class="text-sm text-[var(--color-body-text)]/60 m-0">
                <span class="font-semibold text-[var(--color-heading-text)]">{{ $listings->count() }}+</span>
                results
                @if($q)
                    for <span class="font-semibold text-[var(--color-heading-text)]">"{{ $q }}"</span>
                    @if($activeDestination)
                        in <span class="font-semibold text-[var(--color-heading-text)]">{{ $destinationLabel }}</span>
                    @endif
                @elseif($activeDestination)
                    in <span class="font-semibold text-[var(--color-heading-text)]">{{ $destinationLabel }}</span>
                @else
                    : <span class="font-semibold text-[var(--color-heading-text)]">Bali</span>
                @endif
            </p>

            <form method="GET" action="{{ route('trip.index') }}" class="flex items-center gap-2">
                @if($activeCategory !== 'all')
                    <input type="hidden" name="category" value="{{ $activeCategory }}">
                @endif
                @if($activeDestination !== '')
                    <input type="hidden" name="destination" value="{{ $activeDestination }}">
                @endif
                @if($q)
                    <input type="hidden" name="q" value="{{ $q }}">
                @endif
                <label for="tbg-sort" class="text-xs text-[var(--color-body-text)]/50 whitespace-nowrap">Sort by</label>
                <select
                    id="tbg-sort"
                    name="sort"
                    onchange="this.form.submit()"
                    class="text-xs border border-[var(--color-border)] rounded-lg px-3 py-1.5
                           text-[var(--color-heading-text)] bg-white focus:outline-none
                           focus:ring-2 focus:ring-[var(--color-primary)]/30 cursor-pointer"
                >
                    <option value="default"    @selected($sort === 'default')>Featured</option>
                    <option value="rating"     @selected($sort === 'rating')>Top Rated</option>
                    <option value="price_asc"  @selected($sort === 'price_asc')>Price: Low → High</option>
                    <option value="price_desc" @selected($sort === 'price_desc')>Price: High → Low</option>
                </select>
            </form>
        </div>

        {{-- ── Active filter chips ─────────────────────────────────────────── --}}
        @if($activeDestination || $q)
            <div class="flex items-center gap-2 flex-wrap mt-2">

                @if($activeDestination)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium
                                 bg-primary/10 text-primary border border-primary/20">
                        <i class="ti ti-map-pin text-[12px]" aria-hidden="true"></i>
                        {{ $destinationLabel }}
                        <a href="{{ route('trip.index', \Illuminate\Support\Arr::except($baseQuery, 'destination')) }}"
                           class="ml-1 inline-flex items-center justify-center
                                  hover:text-[var(--color-heading-text)] transition-colors"
                           aria-label="Remove destination filter">
                            <i class="ti ti-x text-[11px]" aria-hidden="true"></i>
                        </a>
                    </span>
                @endif

                @if($q)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium
                                 bg-primary/10 text-primary border border-primary/20">
                        <i class="ti ti-search text-[12px]" aria-hidden="true"></i>
                        "{{ $q }}"
                        <a href="{{ route('trip.index', \Illuminate\Support\Arr::except($baseQuery, 'q')) }}"
                           class="ml-1 inline-flex items-center justify-center
                                  hover:text-[var(--color-heading-text)] transition-colors"
                           aria-label="Clear search">
                            <i class="ti ti-x text-[11px]" aria-hidden="true"></i>
                        </a>
                    </span>
                @endif

            </div>
        @endif

        {{-- ── Category filter tabs ─────────────────────────────────────────── --}}
        <div class="overflow-x-auto scrollbar-none mb-8 sm:mb-6 mt-6">
            <div class="flex items-center gap-2 w-max min-w-full pb-1">
                @php
                    $allTab = ['slug' => 'all', 'label' => 'All'];
                    $tabs   = array_merge([$allTab], $categories);
                @endphp

                @foreach($tabs as $cat)
                    @php
                        $isActive = $activeCategory === $cat['slug'];
                        $href = route('trip.index', array_filter([
                            'category'    => $cat['slug'] !== 'all' ? $cat['slug'] : null,
                            'destination' => $activeDestination ?: null,
                            'sort'        => $sort !== 'default'    ? $sort         : null,
                            'q'           => $q ?: null,
                        ]));
                    @endphp
                    <a href="{{ $href }}"
                       class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-medium
                              border transition-all duration-200 whitespace-nowrap
                              {{ $isActive
                                  ? 'bg-[var(--color-primary)] border-[var(--color-primary)] text-white'
                                  : 'bg-white border-[var(--color-border)] text-[var(--color-body-text)]/70 hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]'
                              }}"
                    >
                        @if($cat['slug'] === 'all')
                            <i class="ti ti-layout-grid text-[13px]" aria-hidden="true"></i>
                        @endif
                        {{ $cat['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- ── Grid ────────────────────────────────────────────────────────── --}}
        @if($listings->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 sm:gap-4">
                @foreach($listings as $item)
                    <div class="relative">

                        {{-- Badge type: Package / Activity --}}
                        <div class="absolute top-2 left-2 z-10 flex gap-1.5">
                            @if($item['type'] === 'package')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-semibold
                                             bg-[var(--color-primary)] text-white tracking-wide">
                                    <i class="ti ti-map-pin text-[10px]" aria-hidden="true"></i>
                                    Package
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-semibold
                                             bg-[var(--color-accent)] text-white tracking-wide">
                                    <i class="ti ti-bolt text-[10px]" aria-hidden="true"></i>
                                    Activity
                                </span>
                            @endif

                            @if(!empty($item['badge']))
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold
                                             bg-black/55 text-white tracking-wide backdrop-blur-sm">
                                    {{ $item['badge'] }}
                                </span>
                            @endif
                        </div>

                        {{-- Card --}}
                        @include('components.section.type4', [
                            'section_data' => [
                                'image'      => asset($item['image']),
                                'title'      => $item['title'],
                                'excerpt'    => $item['excerpt'],
                                'price'      => $item['price'],
                                'price_unit' => $item['price_unit'] ?? 'person',
                                'link'       => route('trip.index') . '/' . $item['slug'],
                            ]
                        ])
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-20 sm:py-14 gap-4 text-center">
                <i class="ti ti-search text-4xl text-[var(--color-body-text)]/20" aria-hidden="true"></i>
                <p class="text-[var(--color-body-text)]/50 text-sm m-0">
                    No results found
                    @if($q) for <strong>"{{ $q }}"</strong> @endif
                    @if($activeCategory !== 'all') in <strong>{{ $activeCategory }}</strong> @endif
                    @if($activeDestination) near <strong>{{ $destinationLabel }}</strong> @endif
                </p>
                <a href="{{ route('trip.index') }}"
                   class="text-xs text-[var(--color-primary)] hover:underline">
                    Clear filters
                </a>
            </div>
        @endif

    </div>
</section>