@php
    $post       = $post       ?? [];
    $related    = $related    ?? collect();
    $categories = $categories ?? [];
    $recentPosts = $recentPosts ?? collect();

    $categoryLabel = collect($categories)->firstWhere('slug', $post['category'] ?? '')['label'] ?? null;
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 py-12">
    <div class="flex flex-col lg:flex-row gap-10 lg:gap-14">
        <article class="flex-1 min-w-0">
            <div class="flex items-center gap-3 flex-wrap mb-4">
                @if($categoryLabel)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-[11px] font-semibold
                                 bg-[var(--color-primary)]/10 text-[var(--color-primary)] tracking-wide">
                        {{ $categoryLabel }}
                    </span>
                @endif
                @if(!empty($post['published_at']))
                    <span class="inline-flex items-center gap-1 text-xs text-[var(--color-body-text)]/50">
                        <i class="ti ti-calendar text-[11px]" aria-hidden="true"></i>
                        {{ \Carbon\Carbon::parse($post['published_at'])->format('d M Y') }}
                    </span>
                @endif
                @if(!empty($post['read_time']))
                    <span class="inline-flex items-center gap-1 text-xs text-[var(--color-body-text)]/50">
                        <i class="ti ti-clock text-[11px]" aria-hidden="true"></i>
                        {{ $post['read_time'] }} min read
                    </span>
                @endif
            </div>
            <h1 class="font-sans font-bold text-2xl sm:text-3xl lg:text-4xl text-[var(--color-heading-text)]
                       leading-tight mb-6">
                {{ $post['title'] }}
            </h1>
            @if(!empty($post['author']))
                <div class="flex items-center gap-3 mb-8 pb-8 border-b border-[var(--color-border)]">
                    <img src="{{ asset($post['author']['avatar']) }}"
                         alt="{{ $post['author']['name'] }}"
                         class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <p class="text-sm font-semibold text-[var(--color-heading-text)] m-0">
                            {{ $post['author']['name'] }}
                        </p>
                        <p class="text-xs text-[var(--color-body-text)]/60 m-0">
                            {{ $post['author']['bio'] }}
                        </p>
                    </div>
                </div>
            @endif
            <div class="prose prose-sm sm:prose max-w-none
                        prose-headings:font-sans prose-headings:text-[var(--color-heading-text)]
                        prose-p:text-[var(--color-body-text)] prose-p:leading-relaxed
                        prose-li:text-[var(--color-body-text)]
                        prose-a:text-[var(--color-primary)] prose-a:no-underline hover:prose-a:underline
                        prose-strong:text-[var(--color-heading-text)]">
                {!! $post['content'] !!}
            </div>
            @if(!empty($post['tags']))
                <div class="flex items-center gap-2 flex-wrap mt-10 pt-8 border-t border-[var(--color-border)]">
                    <span class="text-xs text-[var(--color-body-text)]/50 font-medium">Tags:</span>
                    @foreach($post['tags'] as $tag)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px]
                                     bg-[var(--color-border)] text-[var(--color-body-text)]/70">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>
            @endif
            @if($related->isNotEmpty())
                <div class="mt-12">
                    <h2 class="font-sans font-bold text-lg text-[var(--color-heading-text)] mb-5">
                        Related Articles
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @foreach($related as $rel)
                            @include('components.section.type4', [
                                'section_data' => [
                                    'mode'      => 'blog',
                                    'image'     => asset($rel['image']),
                                    'title'     => $rel['title'],
                                    'excerpt'   => $rel['excerpt'],
                                    'date'      => $rel['published_at'],
                                    'read_time' => $rel['read_time'] ?? null,
                                    'link'      => route('article.show', $rel['slug']),
                                ]
                            ])
                        @endforeach
                    </div>
                </div>
            @endif
        </article>
        <aside class="w-full lg:w-72 xl:w-80 shrink-0 space-y-8">
            {{-- Categories --}}
            @if(!empty($categories))
                <div>
                    <h3 class="font-sans font-bold text-sm text-[var(--color-heading-text)] mb-4
                               uppercase tracking-widest">
                        Categories
                    </h3>
                    <ul class="space-y-1">
                        @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('article.index', ['category' => $cat['slug']]) }}"
                                   class="flex items-center justify-between px-3 py-2 rounded-lg text-sm
                                          text-[var(--color-body-text)]/70 hover:bg-[var(--color-primary)]/5
                                          hover:text-[var(--color-primary)] transition-colors duration-150
                                          {{ ($post['category'] ?? '') === $cat['slug']
                                              ? 'bg-[var(--color-primary)]/10 text-[var(--color-primary)] font-medium'
                                              : '' }}">
                                    {{ $cat['label'] }}
                                    <i class="ti ti-chevron-right text-[12px]" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if($recentPosts->isNotEmpty())
                <div>
                    <h3 class="font-sans font-bold text-sm text-[var(--color-heading-text)] mb-4
                               uppercase tracking-widest">
                        Recent Articles
                    </h3>
                    <ul class="space-y-4">
                        @foreach($recentPosts as $recent)
                            <li>
                                <a href="{{ route('article.show', $recent['slug']) }}"
                                   class="flex gap-3 group">
                                    <img src="{{ asset($recent['image']) }}"
                                         alt="{{ $recent['title'] }}"
                                         class="w-16 h-16 rounded-lg object-cover shrink-0
                                                group-hover:opacity-80 transition-opacity">
                                    <div class="flex flex-col justify-center gap-1">
                                        <p class="text-xs font-semibold text-[var(--color-heading-text)]
                                                   leading-snug line-clamp-2 group-hover:text-[var(--color-primary)]
                                                   transition-colors m-0">
                                            {{ $recent['title'] }}
                                        </p>
                                        <span class="text-[11px] text-[var(--color-body-text)]/50">
                                            {{ \Carbon\Carbon::parse($recent['published_at'])->format('d M Y') }}
                                        </span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="rounded-[var(--radius-lg)] bg-[var(--color-primary)] p-6 text-white">
                <h3 class="font-sans font-bold text-base mb-2">Ready to Explore Bali?</h3>
                <p class="text-xs text-white/80 leading-relaxed mb-4">
                    Browse our curated tours and activities — guided by local experts who know Bali best.
                </p>
                <a href="{{ route('trip.index') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-white
                          text-[var(--color-primary)] text-xs font-semibold hover:bg-white/90 transition-colors">
                    View All Trips
                    <i class="ti ti-arrow-right text-[12px]" aria-hidden="true"></i>
                </a>
            </div>

        </aside>

    </div>
</div>