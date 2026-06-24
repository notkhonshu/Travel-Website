@php
    $listings          = $listings          ?? collect();
    $categories        = $categories        ?? [];
    $activeCategory    = $activeCategory    ?? 'all';
    $activeDestination = $activeDestination ?? '';
    $sort              = $sort              ?? 'default';
    $q                 = $q                 ?? '';
    $mode              = $mode              ?? 'trip';

    $isDestinationMode = ($mode === 'destinations');

    $pageEyebrow     = $pageEyebrow     ?? 'Explore Bali';
    $pageTitle       = $pageTitle       ?? 'Explore Destinations';
    $pageDescription = $pageDescription ?? "Curated journeys across Bali's most breathtaking landscapes — from volcanic highland craters to dramatic sea cliffs and tropical island escapes.";

    $destConfig = collect(config('data.destinations', []));

    $destinationData  = ($activeDestination !== '')
        ? $destConfig->firstWhere('slug', $activeDestination)
        : null;

    $destinationLabel = $destinationData['label']
        ?? \Illuminate\Support\Str::title(str_replace('-', ' ', $activeDestination));

    $baseQuery = array_filter([
        'category'    => $activeCategory !== 'all' ? $activeCategory : null,
        'destination' => $activeDestination ?: null,
        'sort'        => $sort !== 'default' ? $sort : null,
        'q'           => $q ?: null,
    ]);

    $indexRoute = match($mode) {
        'activities'   => 'activity.index',
        'packages'     => 'package.index',
        'destinations' => 'destination.index',
        'blog'         => 'article.index',
        default        => 'trip.index',
    };

    $isBlogMode        = ($mode === 'blog');
    $isDestinationMode = ($mode === 'destinations');
    $isSimpleMode      = ($isDestinationMode || $isBlogMode);

    $pageEyebrow     = $pageEyebrow     ?? ($isBlogMode ? 'From Our Guides' : 'Explore Bali');
    $pageTitle       = $pageTitle       ?? ($isBlogMode ? 'Travel Blog & Guides' : 'Explore Destinations');
    $pageDescription = $pageDescription ?? ($isBlogMode
        ? 'Stories, tips and destination guides written by our local Bali experts.'
        : "Curated journeys across Bali's most breathtaking landscapes — from volcanic highland craters to dramatic sea cliffs and tropical island escapes.");

    $allTab = ['slug' => 'all', 'label' => 'All'];
    $tabs   = array_merge([$allTab], $categories);
@endphp

<section id="listing" class="pt-20  ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        @if($isSimpleMode)
            <div class="pt-3">
                <span class="inline-block text-xs font-semibold tracking-widest uppercase text-accent mb-3">
                    {{ $pageEyebrow }}
                </span>
                <h1 class="font-sans font-bold text-3xl sm:text-4xl text-[var(--color-heading-text)] leading-tight mb-3">
                    {{ $pageTitle }}
                </h1>
                <p class="font-sans text-sm sm:text-base text-[var(--color-body-text)]/70 max-w-xl leading-relaxed">
                    {{ $pageDescription }}
                </p>
            </div>
        @endif
        <div class="flex items-center justify-between flex-wrap gap-3">
            @unless($isSimpleMode)
                <p class="text-sm text-[var(--color-body-text)]/60 m-0">
                    <span class="font-semibold text-[var(--color-heading-text)]">{{ $listings->count() }}</span>
                    destinations available
                </p>
            @endunless

            @if(!$isSimpleMode)
                <form method="GET" action="{{ route($indexRoute) }}" class="flex items-center gap-2">
                    @if($activeCategory !== 'all')
                        <input type="hidden" name="category" value="{{ $activeCategory }}">
                    @endif
                    @if($activeDestination !== '')
                        <input type="hidden" name="destination" value="{{ $activeDestination }}">
                    @endif
                    @if($q)
                        <input type="hidden" name="q" value="{{ $q }}">
                    @endif
                    <label for="tbg-sort" class="text-xs text-[var(--color-body-text)]/50">Sort by</label>
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
                        <option value="price_asc"  @selected($sort === 'price_asc')>Price: Low to High</option>
                        <option value="price_desc" @selected($sort === 'price_desc')>Price: High to Low</option>
                    </select>
                </form>
            @endif
        </div>
        @if(!$isSimpleMode)
            @if($activeDestination || $q)
                <div class="flex items-center gap-2 flex-wrap mt-2">

                    @if($activeDestination)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium
                                     bg-primary/10 text-primary border border-primary/20">
                            <i class="ti ti-map-pin text-[12px]" aria-hidden="true"></i>
                            {{ $destinationLabel }}
                            <a href="{{ route($indexRoute, \Illuminate\Support\Arr::except($baseQuery, 'destination')) }}"
                               class="ml-1 inline-flex items-center justify-center hover:text-[var(--color-heading-text)] transition-colors"
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
                            <a href="{{ route($indexRoute, \Illuminate\Support\Arr::except($baseQuery, 'q')) }}"
                               class="ml-1 inline-flex items-center justify-center hover:text-[var(--color-heading-text)] transition-colors"
                               aria-label="Clear search">
                                <i class="ti ti-x text-[11px]" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif

                </div>
            @endif
        @endif
        @if($isBlogMode && count($categories) > 0)
            <div class="overflow-x-auto scrollbar-none mb-6 mt-6">
                <div class="flex items-center gap-2 w-max min-w-full pb-1">
                    @php
                        $blogAllTab = ['slug' => 'all', 'label' => 'All'];
                        $blogTabs   = array_merge([$blogAllTab], $categories);
                    @endphp
                    @foreach($blogTabs as $cat)
                        @php
                            $isActive = $activeCategory === $cat['slug'];
                            $tabHref  = route($indexRoute, array_filter([
                                'category' => $cat['slug'] !== 'all' ? $cat['slug'] : null,
                                'q'        => $q ?: null,
                            ]));
                        @endphp
                        <a href="{{ $tabHref }}"
                        class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-medium
                                border transition-all duration-200
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
        @elseif(!$isSimpleMode)
            <div class="overflow-x-auto scrollbar-none mb-8 sm:mb-6 mt-6">
                <div class="flex items-center gap-2 w-max min-w-full pb-1">
                    @foreach($tabs as $cat)
                        @php
                            $isActive  = $activeCategory === $cat['slug'];
                            $tabParams = array_filter([
                                'category'    => $cat['slug'] !== 'all' ? $cat['slug'] : null,
                                'destination' => $activeDestination ?: null,
                                'sort'        => $sort !== 'default' ? $sort : null,
                                'q'           => $q ?: null,
                            ]);
                            $tabHref = route($indexRoute, $tabParams);
                        @endphp
                        <a href="{{ $tabHref }}"
                           class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-medium
                                  border transition-all duration-200
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
        @endif
        @if($listings->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 sm:gap-4
                        {{ $isSimpleMode ? 'mt-6' : '' }} pb-10">

                @foreach($listings as $item)
                    <div class="relative">

                        @if(!$isSimpleMode)
                            {{-- ... existing badges unchanged ... --}}
                        @endif

                        @if($isDestinationMode)
                            @include('components.section.type4', [
                                'section_data' => [
                                    'mode'      => 'destination',
                                    'image'     => asset($item['image']),
                                    'title'     => $item['label'],
                                    'excerpt'   => $item['desc'],
                                    'tag'       => $item['tag']       ?? null,
                                    'highlight' => $item['highlight'] ?? null,
                                    'link'      => route('trip.index', ['destination' => $item['slug']]),
                                ]
                            ])
                        @elseif($isBlogMode)
                            @include('components.section.type4', [
                                'section_data' => [
                                    'mode'      => 'blog',
                                    'image'     => asset($item['image']),
                                    'title'     => $item['title'],
                                    'excerpt'   => $item['excerpt'],
                                    'category'  => collect(config('blog.categories'))->firstWhere('slug', $item['category'])['label'] ?? null,
                                    'date'      => $item['published_at'],
                                    'read_time' => $item['read_time'] ?? null,
                                    'link'      => route('article.show', $item['slug']),
                                ]
                            ])
                        @else
                            @include('components.section.type4', [
                                'section_data' => [
                                    'mode'       => 'listing',
                                    'image'      => asset($item['image']),
                                    'title'      => $item['title'],
                                    'excerpt'    => $item['excerpt'],
                                    'price'      => $item['price'],
                                    'price_unit' => $item['price_unit'] ?? 'person',
                                    'link'       => route('trip.index') . '/' . $item['slug'],
                                ]
                            ])
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>