@php
    $faqCategories = config('faq.categories', []);
@endphp

<section class="tbg-faq py-16 md:py-24 bg-white" id="{{ $section_data['id']}}">
    <div class="tbg-faq__container max-w-3xl mx-auto px-6 md:px-8">
        <div class="tbg-faq__body space-y-12">
            @forelse ($faqCategories as $categoryIndex => $group)
                <div class="tbg-faq__group">
                    <h2 class="tbg-faq__group-title text-xs font-semibold uppercase tracking-widest mb-5 text-primary">
                        {{ $group['category'] }}
                    </h2>
                    <div class="tbg-faq__items divide-y divide-gray-100 border-t border-gray-100">
                        @foreach ($group['items'] as $itemIndex => $item)
                            @php
                                $accordionId = 'faq-' . $categoryIndex . '-' . $itemIndex;
                            @endphp
                            <div class="tbg-faq__item">
                                <button type="button" class="tbg-faq__trigger w-full flex items-start justify-between gap-4 py-4 text-left" aria-expanded="false" aria-controls="{{ $accordionId }}">
                                    <span class="tbg-faq__question text-sm font-semibold text-gray-900 leading-snug">
                                        {{ $item['question'] }}
                                    </span>
                                    <span class="tbg-faq__icon mt-0.5 shrink-0 transition-transform duration-200 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </span>
                                </button>
                                <div id="{{ $accordionId }}" class="tbg-faq__panel overflow-hidden" style="max-height: 0; transition: max-height 0.3s ease;">
                                    <p class="tbg-faq__answer text-sm text-gray-600 leading-relaxed pb-4 pr-8">
                                        {{ $item['answer'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if (!$loop->last)
                    <hr class="border-gray-100">
                @endif
            @empty
                <p class="text-sm text-gray-400 italic">No FAQ data available.</p>
            @endforelse
        </div>
        <div class="tbg-faq__cta mt-14 pt-10 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-gray-900">Still have questions?</p>
                <p class="text-sm text-gray-500 mt-0.5">Our team is happy to help — reach out any time.</p>
            </div>
            <a href="mailto:director@thebaliguidesadventure.com"
               class="tbg-faq__cta-btn inline-flex items-center gap-2 text-sm font-semibold px-5 py-2.5 rounded-lg text-white shrink-0 transition-opacity hover:opacity-90 bg-primary">
                Contact Us
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>