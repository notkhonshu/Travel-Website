<section id="contact"
         class="bg-[var(--color-background)] px-4 sm:px-8 md:px-12 lg:px-16 xl:px-24 2xl:px-32
                py-20 md:py-28">
    <div class="max-w-[1400px] mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 xl:gap-14 items-start">
            <div class="flex flex-col gap-10">
                <div>
                    <p class="font-sans text-[11px] font-semibold tracking-[0.2em] uppercase
                               text-primary mb-3">
                        Contact Us
                    </p>
                    <h1 class="font-heading font-bold text-3xl sm:text-4xl md:text-5xl
                                text-[var(--color-heading-text)] leading-tight mb-4">
                        Let's plan your<br>next adventure
                    </h1>
                    <p class="font-sans text-[15px] text-[var(--color-body-text)] leading-relaxed">
                        Have a question about our trips or want a custom itinerary?
                        Our team is ready to help you every step of the way.
                    </p>
                </div>

                <div class="flex flex-col gap-3">

                    @if(!empty($cs['email']))
                    <div class="flex items-start gap-4 bg-primary/5 border border-primary/10
                                rounded-2xl p-5 transition-all duration-200
                                hover:bg-primary/8 hover:border-primary/20">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-primary
                                     flex items-center justify-center text-white text-[17px]">
                            <i class="ti ti-mail" aria-hidden="true"></i>
                        </span>
                        <div>
                            <p class="font-sans text-[11px] font-semibold tracking-widest uppercase
                                       text-[var(--color-body-text)] mb-1">Email</p>
                            <a href="{{ $cs['url_email'] }}"
                               class="font-sans text-[14px] font-medium text-[var(--color-heading-text)]
                                      hover:text-primary transition-colors duration-200 break-all">
                                {{ $cs['email'] }}
                            </a>
                        </div>
                    </div>
                    @endif

                    @if(!empty($cs['whatsapp']))
                    <div class="flex items-start gap-4 bg-primary/5 border border-primary/10
                                rounded-2xl p-5 transition-all duration-200
                                hover:bg-primary/8 hover:border-primary/20">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-primary
                                     flex items-center justify-center text-white text-[17px]">
                            <i class="ti ti-brand-whatsapp" aria-hidden="true"></i>
                        </span>
                        <div>
                            <p class="font-sans text-[11px] font-semibold tracking-widest uppercase
                                       text-[var(--color-body-text)] mb-1">WhatsApp</p>
                            <a href="{{ $cs['url_whatsapp'] }}" target="_blank" rel="noopener"
                               class="font-sans text-[14px] font-medium text-[var(--color-heading-text)]
                                      hover:text-primary transition-colors duration-200">
                                {{ $cs['whatsapp'] }}
                            </a>
                        </div>
                    </div>
                    @endif

                    @if(!empty(config('social.marketing.whatsapp')))
                    <div class="flex items-start gap-4 bg-primary/5 border border-primary/10
                                rounded-2xl p-5 transition-all duration-200
                                hover:bg-primary/8 hover:border-primary/20">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-primary
                                     flex items-center justify-center text-white text-[17px]">
                            <i class="ti ti-brand-whatsapp" aria-hidden="true"></i>
                        </span>
                        <div>
                            <p class="font-sans text-[11px] font-semibold tracking-widest uppercase
                                       text-[var(--color-body-text)] mb-1">Marketing</p>
                            <p class="font-sans text-[14px] font-medium text-[var(--color-heading-text)]">
                                {{ config('social.marketing.whatsapp') }}
                            </p>
                        </div>
                    </div>
                    @endif

                    @if(!empty($address['street']))
                    <div class="flex items-start gap-4 bg-primary/5 border border-primary/10
                                rounded-2xl p-5 transition-all duration-200
                                hover:bg-primary/8 hover:border-primary/20">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-primary
                                     flex items-center justify-center text-white text-[17px]">
                            <i class="ti ti-map-pin" aria-hidden="true"></i>
                        </span>
                        <div>
                            <p class="font-sans text-[11px] font-semibold tracking-widest uppercase
                                       text-[var(--color-body-text)] mb-1">Address</p>
                            <p class="font-sans text-[14px] text-[var(--color-heading-text)] leading-snug">
                                @if(!empty($address['name'])){{ $address['name'] }}<br>@endif
                                {{ $address['street'] }}<br>
                                @if(!empty($address['locality'])){{ $address['locality'] }}@endif
                                @if(!empty($address['postal_code'])), {{ $address['postal_code'] }}@endif
                            </p>
                            @if(!empty($address['url']))
                            <a href="{{ $address['url'] }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-1 mt-2 font-sans text-[12px]
                                      font-semibold text-primary hover:gap-2 transition-all duration-200">
                                Get directions <i class="ti ti-arrow-right text-xs"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif

                </div>
                @if($socials->isNotEmpty())
                <div>
                    <p class="font-sans text-[11px] font-semibold tracking-[0.2em] uppercase
                               text-[var(--color-body-text)] mb-4">
                        Follow Us
                    </p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($socials as $s)
                        <a href="{{ $s['url'] }}" target="_blank" rel="noopener"
                           aria-label="{{ $s['label'] }}"
                           class="flex items-center gap-2 px-4 py-2.5
                                  bg-primary/5 border border-primary/10
                                  rounded-full font-sans text-[13px] font-medium
                                  text-[var(--color-body-text)]
                                  hover:bg-primary hover:text-white hover:border-primary
                                  transition-all duration-200">
                            <i class="ti {{ $s['icon'] }} text-[15px]" aria-hidden="true"></i>
                            {{ !empty($s['name']) ? $s['name'] : $s['label'] }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="bg-[var(--color-surface)] border border-[var(--color-border)]
                            rounded-3xl p-6 sm:p-8">
                    <h2 class="font-heading font-bold text-xl text-[var(--color-heading-text)] mb-1">
                        Send us a message
                    </h2>
                    <p class="font-sans text-[13px] text-[var(--color-body-text)] mb-6">
                        We typically reply within 24 hours.
                    </p>
                    @if(session('success'))
                    <div class="flex items-start gap-3 bg-primary/8 border border-primary/20
                                rounded-xl px-4 py-4 mb-6">
                        <i class="ti ti-circle-check text-primary text-xl shrink-0 mt-0.5" aria-hidden="true"></i>
                        <p class="font-sans text-[14px] text-[var(--color-heading-text)]">
                            {{ session('success') }}
                        </p>
                    </div>
                    @endif
                    @if($errors->has('rate_limit'))
                    <div class="flex items-start gap-3 bg-red-50 border border-red-200
                                rounded-xl px-4 py-4 mb-6">
                        <i class="ti ti-alert-circle text-red-500 text-xl shrink-0 mt-0.5" aria-hidden="true"></i>
                        <p class="font-sans text-[14px] text-red-700">{{ $errors->first('rate_limit') }}</p>
                    </div>
                    @endif
                    <form action="{{ route('contact.send') }}" method="POST" novalidate>
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div class="flex flex-col gap-1.5">
                                <label for="name"
                                       class="font-sans text-[12px] font-semibold
                                              text-[var(--color-heading-text)]">
                                    Full Name <span class="text-primary">*</span>
                                </label>
                                <input type="text" id="name" name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Your full name"
                                       autocomplete="name"
                                       class="w-full px-4 py-3 rounded-xl
                                              bg-[var(--color-background)]
                                              border border-[var(--color-border)]
                                              font-sans text-[14px] text-[var(--color-heading-text)]
                                              placeholder-[var(--color-body-text)]/50
                                              outline-none transition-all duration-200
                                              focus:border-primary/50 focus:ring-2 focus:ring-primary/10
                                              @error('name') border-red-400 @enderror">
                                @error('name')
                                <p class="font-sans text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label for="email"
                                       class="font-sans text-[12px] font-semibold
                                              text-[var(--color-heading-text)]">
                                    Email <span class="text-primary">*</span>
                                </label>
                                <input type="email" id="email" name="email"
                                       value="{{ old('email') }}"
                                       placeholder="your@email.com"
                                       autocomplete="email"
                                       class="w-full px-4 py-3 rounded-xl
                                              bg-[var(--color-background)]
                                              border border-[var(--color-border)]
                                              font-sans text-[14px] text-[var(--color-heading-text)]
                                              placeholder-[var(--color-body-text)]/50
                                              outline-none transition-all duration-200
                                              focus:border-primary/50 focus:ring-2 focus:ring-primary/10
                                              @error('email') border-red-400 @enderror">
                                @error('email')
                                <p class="font-sans text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div class="flex flex-col gap-1.5">
                                <label for="phone"
                                       class="font-sans text-[12px] font-semibold
                                              text-[var(--color-heading-text)]">
                                    Phone
                                    <span class="text-[var(--color-body-text)] font-normal">(optional)</span>
                                </label>
                                <input type="tel" id="phone" name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="+62 xxx xxxx xxxx"
                                       autocomplete="tel"
                                       class="w-full px-4 py-3 rounded-xl
                                              bg-[var(--color-background)]
                                              border border-[var(--color-border)]
                                              font-sans text-[14px] text-[var(--color-heading-text)]
                                              placeholder-[var(--color-body-text)]/50
                                              outline-none transition-all duration-200
                                              focus:border-primary/50 focus:ring-2 focus:ring-primary/10">
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label for="subject"
                                       class="font-sans text-[12px] font-semibold
                                              text-[var(--color-heading-text)]">
                                    Subject <span class="text-primary">*</span>
                                </label>
                                <select id="subject" name="subject"
                                        class="w-full px-4 py-3 rounded-xl
                                               bg-[var(--color-background)]
                                               border border-[var(--color-border)]
                                               font-sans text-[14px] text-[var(--color-heading-text)]
                                               outline-none transition-all duration-200
                                               focus:border-primary/50 focus:ring-2 focus:ring-primary/10
                                               @error('subject') border-red-400 @enderror">
                                    <option value="" disabled {{ old('subject') ? '' : 'selected' }}>
                                        Select a topic…
                                    </option>
                                    @foreach(['Trip Inquiry', 'Package Customization', 'Activity Booking', 'Partnership', 'Other'] as $opt)
                                    <option value="{{ $opt }}" {{ old('subject') === $opt ? 'selected' : '' }}>
                                        {{ $opt }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('subject')
                                <p class="font-sans text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5 mb-6">
                            <label for="message"
                                   class="font-sans text-[12px] font-semibold
                                          text-[var(--color-heading-text)]">
                                Message <span class="text-primary">*</span>
                            </label>
                            <textarea id="message" name="message" rows="5"
                                      placeholder="Tell us about your trip plans, preferred dates, group size…"
                                      class="w-full px-4 py-3 rounded-xl
                                             bg-[var(--color-background)]
                                             border border-[var(--color-border)]
                                             font-sans text-[14px] text-[var(--color-heading-text)]
                                             placeholder-[var(--color-body-text)]/50
                                             outline-none transition-all duration-200 resize-none
                                             focus:border-primary/50 focus:ring-2 focus:ring-primary/10
                                             @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                            @error('message')
                            <p class="font-sans text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2
                                       bg-primary text-white
                                       font-sans text-[14px] font-semibold
                                       px-6 py-3.5 rounded-xl
                                       hover:bg-primary/90 active:scale-[0.99]
                                       transition-all duration-200 cursor-pointer">
                            Send Message
                            <i class="ti ti-send text-base" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>

            </div>

            <div class="lg:sticky lg:top-[88px] h-[500px] lg:h-[calc(100vh-120px)]
                        rounded-3xl overflow-hidden border border-[var(--color-border)]
                        bg-[var(--color-surface)]">

                @if(!empty($address['url']))
                @php
                    $mapSrc = str_contains($address['url'], '/embed')
                        ? $address['url']
                        : 'https://maps.google.com/maps?q=' . urlencode(
                            trim(implode(', ', array_filter([
                                $address['name'],
                                $address['street'],
                                $address['locality'],
                            ])))
                          ) . '&output=embed';
                @endphp
                <iframe src="{{ $mapSrc }}"
                        width="100%"
                        height="100%"
                        style="border:0; display:block;"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Our location on Google Maps">
                </iframe>
                @else
                <div class="w-full h-full flex flex-col items-center justify-center gap-3">
                    <i class="ti ti-map-2 text-5xl text-[var(--color-border)]" aria-hidden="true"></i>
                    <p class="font-sans text-sm text-[var(--color-body-text)]">
                        Map will appear here once address is configured
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
