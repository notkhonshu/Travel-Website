@php
    $usefulLinks = [
        ['title' => 'Home',            'link' => route('landing.index')],
        ['title' => 'About Us',        'link' => route('landing.about')],
        ['title' => 'Trip',            'link' => route('trip.index')],
        ['title' => 'Gallery',         'link' => route('gallery.index')],
        ['title' => 'Contact Us',      'link' => route('landing.contact')],
        ['title' => 'Partner with Us', 'link' => config('social.customer_service.url_email')],
    ];
@endphp

<footer id="footer"
    class="relative bg-primary px-4 sm:px-8 md:px-12 lg:px-16 xl:px-24 2xl:px-32 py-14 md:py-20">
    <div class="max-w-[1400px] mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 md:gap-8 xl:gap-12
                    pb-10 md:pb-14 border-b border-white/20">
            <div class="flex flex-col gap-6 sm:col-span-2 md:col-span-1">
                <div>
                    <h4 class="text-white text-[20px] font-heading font-bold leading-snug">
                        {{ config('app.name') }}
                    </h4>
                    <p class="mt-3 text-white/70 text-[15px] leading-relaxed">
                        We specialize in creating awesome and extraordinary experiences, whether you're looking for thrilling adventures or serene landscapes of Bali or venturing into the cultural wonders of Asia.
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ config('social.facebook.url') }}" target="_blank" rel="noopener"
                        aria-label="Facebook"
                        class="text-white/70 hover:text-[var(--color-accent)] transition-colors duration-200">
                        <div class="px-3 py-2.5 border border-white/30 hover:border-[var(--color-accent)]
                                    rounded-full transition-colors duration-200">
                            <i class="ti ti-brand-facebook text-xl"></i>
                        </div>
                    </a>
                    <a href="{{ config('social.instagram.url') }}" target="_blank" rel="noopener"
                        aria-label="Instagram"
                        class="text-white/70 hover:text-[var(--color-accent)] transition-colors duration-200">
                        <div class="px-3 py-2.5 border border-white/30 hover:border-[var(--color-accent)]
                                    rounded-full transition-colors duration-200">
                            <i class="ti ti-brand-instagram text-xl"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="flex flex-col gap-5">
                <h5 class="text-white text-[15px] font-semibold tracking-wide uppercase">
                    Useful Links
                </h5>
                <nav aria-label="Footer navigation">
                    <ul class="space-y-3">
                        @foreach ($usefulLinks as $item)
                        <li>
                            <a href="{{ $item['link'] }}"
                               class="text-white/70 hover:text-white text-[15px]
                                      transition-colors duration-200 flex items-center gap-1.5 group">
                                <i class="ti ti-arrow-right text-xs text-white/30
                                          group-hover:text-white/70 group-hover:translate-x-0.5
                                          transition-all duration-200"></i>
                                {{ $item['title'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="flex flex-col gap-4">
                <h5 class="text-white text-[15px] font-semibold tracking-wide uppercase">
                    Subscribe Now
                </h5>
                <p class="text-white/70 text-[15px] leading-relaxed">
                    Don't miss our future updates! Get subscribed today.
                </p>
                <div class="flex items-stretch border border-white/20 rounded-lg overflow-hidden mt-1
                            cursor-not-allowed opacity-60">
                    <input
                        type="email"
                        placeholder="Your email address"
                        disabled
                        class="flex-1 px-4 py-3 bg-white/5 text-white/50 text-[14px]
                               placeholder-white/30 outline-none border-0 cursor-not-allowed min-w-0">
                    <button
                        type="button"
                        disabled
                        aria-label="Subscribe"
                        class="px-4 py-3 bg-[var(--color-accent)] text-white
                               cursor-not-allowed shrink-0">
                        <i class="ti ti-arrow-right text-base"></i>
                    </button>
                </div>
            </div>

        </div>
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-center gap-1">
            <p class="text-white/50 text-[13px] text-center">
                © {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.
            </p>
        </div>
    </div>
</footer>