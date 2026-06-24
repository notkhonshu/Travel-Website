<?php

return [

    /* ══════════════════════════════════════════
       CATEGORIES
    ══════════════════════════════════════════ */
    'categories' => [
        ['slug' => 'travel-guide',  'label' => 'Travel Guide'],
        ['slug' => 'adventure',     'label' => 'Adventure'],
        ['slug' => 'culture',       'label' => 'Culture'],
        ['slug' => 'nature',        'label' => 'Nature'],
        ['slug' => 'wellness',      'label' => 'Wellness'],
    ],

    /* ══════════════════════════════════════════
       POSTS
    ══════════════════════════════════════════ */
    'posts' => [

        /* ── 1 ── */
        [
            'slug'          => 'ultimate-guide-mount-batur-sunrise-trek',
            'title'         => 'The Ultimate Guide to Mount Batur Sunrise Trek',
            'excerpt'       => 'Everything you need to know before trekking Mount Batur — the best time to go, what to bring, how to prepare, and what to expect at the summit as the sun rises over the ancient caldera.',
            'content'       => "
                <p>Mount Batur is one of Bali's most accessible and rewarding volcanic treks. Standing at 1,717 metres above sea level, the active volcano sits at the centre of an ancient caldera filled by Lake Batur — one of the most dramatic highland landscapes in all of Indonesia.</p>

                <h2>Why Trek Mount Batur?</h2>
                <p>Unlike Mount Agung, which demands a full night of gruelling climbing, Batur is achievable by almost anyone with a reasonable level of fitness. The trek takes approximately two hours from base camp, making it possible to summit in time for sunrise — one of the most breathtaking experiences Bali has to offer.</p>

                <h2>Best Time to Go</h2>
                <p>The dry season between April and October offers the clearest summit views. The sweet spot is May to August, when the air is crisp and visibility from the crater rim can extend to Mount Agung, Mount Rinjani on Lombok, and even Nusa Penida on the clearest mornings.</p>

                <h2>What to Bring</h2>
                <ul>
                    <li>Warm jacket or fleece — temperatures at the summit drop to 10–15°C before dawn</li>
                    <li>Headlamp with fresh batteries</li>
                    <li>Comfortable trekking shoes with grip</li>
                    <li>Minimum 1.5 litres of water</li>
                    <li>Light snacks or energy bars</li>
                    <li>Camera or smartphone for the sunrise</li>
                </ul>

                <h2>The Trek Itself</h2>
                <p>Trekkers depart base camp at Toya Bungkah around 04:00 AM, guided by a certified local guide through volcanic rock trails and scrubland. The final section steepens considerably, but the reward at the top — a panoramic sunrise over the caldera lake with clouds below — makes every step worthwhile.</p>

                <h2>After the Trek</h2>
                <p>Most guides arrange a crater-rim breakfast of eggs cooked in volcanic steam vents — a uniquely Batur experience. After descending, a soak at the Toya Bungkah natural hot springs is highly recommended to ease tired muscles.</p>

                <p>Whether you book a guided package or arrange independently, Mount Batur is an experience that defines a Bali trip for most visitors who attempt it.</p>
            ",
            'image'         => 'assets/img/static/trekking.png',
            'gallery'       => [
                'assets/img/static/trekking.png',
                'assets/img/static/package/mtbike1.jpg',
                'assets/img/static/package/mtbike3.jpg',
            ],
            'category'      => 'adventure',
            'tags'          => ['mount batur', 'trekking', 'kintamani', 'sunrise', 'volcano'],
            'author'        => [
                'name'   => 'Wayan Sudiana',
                'avatar' => 'assets/img/static/author-1.jpg',
                'bio'    => 'Certified Bali trekking guide with 10 years of experience leading Mount Batur and Mount Agung expeditions.',
            ],
            'published_at'  => '2025-03-12',
            'read_time'     => 6,
            'featured'      => true,
            'meta' => [
                'title'       => 'Ultimate Guide to Mount Batur Sunrise Trek | The Bali Guides Adventure',
                'description' => 'Everything you need to know before trekking Mount Batur — preparation, what to bring, best time to go, and what to expect at the summit.',
                'keywords'    => 'mount batur trek, bali volcano trek, kintamani sunrise, batur sunrise guide',
            ],
        ],

        /* ── 2 ── */
        [
            'slug'          => 'nusa-penida-first-timers-guide',
            'title'         => "Nusa Penida: A First-Timer's Complete Island Guide",
            'excerpt'       => 'Kelingking Beach, Broken Beach, Angel Billabong, manta ray snorkelling — here is everything a first-time visitor needs to know to make the most of a day or two on Nusa Penida.',
            'content'       => "
                <p>Nusa Penida has transformed over the past decade from an overlooked island backwater into one of Southeast Asia's most talked-about travel destinations. Its dramatic sea cliffs, turquoise waters, and abundant marine life have put it firmly on the global travel map — and for good reason.</p>

                <h2>Getting There</h2>
                <p>The most common departure point is Sanur Harbour in Bali, where regular speedboats make the 45–50 minute crossing to Banjar Nyuh or Toyapakeh harbour on Nusa Penida. Book in advance during peak season (July–August) as boats fill quickly.</p>

                <h2>West Side Highlights</h2>
                <p>The iconic west coast is home to Nusa Penida's most photographed landmarks. Kelingking Beach — with its T-Rex shaped cliff — is the island's signature image. Nearby, Angel Billabong offers a natural infinity pool carved into the rock at the ocean's edge, and Broken Beach provides a stunning natural rock arch over a circular lagoon.</p>

                <h2>East Side Highlights</h2>
                <p>Less visited but equally spectacular, the east side is home to Atuh Beach and Diamond Beach — two of the most pristine white-sand coves in the region, accessible via steep staircases cut into the cliff face.</p>

                <h2>Snorkelling & Diving</h2>
                <p>Nusa Penida's underwater world is world-class. Crystal Bay is famous for its mola mola sunfish sightings between August and October. Manta Point offers near-guaranteed encounters with giant oceanic manta rays year-round. The coral gardens at Gamat Bay and The Wall are exceptional for reef snorkelling.</p>

                <h2>One Day or Two?</h2>
                <p>A single day covers the west side comfortably. Two days allows you to add the east coast and a proper snorkelling session. For the full experience — including freediving or kayaking — three days is ideal.</p>

                <h2>Tips for First-Timers</h2>
                <ul>
                    <li>Roads on the island are rough — hire a driver rather than self-driving a scooter</li>
                    <li>Bring cash — ATMs are limited and unreliable</li>
                    <li>Start early — key viewpoints get crowded by mid-morning</li>
                    <li>Wear water shoes for Angel Billabong</li>
                    <li>Book speedboat tickets in advance during July–August</li>
                </ul>
            ",
            'image'         => 'assets/img/static/nusapenida.png',
            'gallery'       => [
                'assets/img/static/nusapenida.png',
                'assets/img/static/package/west-day1.jpg',
                'assets/img/static/package/west-day3.jpg',
                'assets/img/static/package/Manta1.jpg',
            ],
            'category'      => 'travel-guide',
            'tags'          => ['nusa penida', 'kelingking', 'snorkelling', 'island guide', 'manta ray'],
            'author'        => [
                'name'   => 'Made Ariani',
                'avatar' => 'assets/img/static/author-2.jpg',
                'bio'    => 'Bali-based travel writer and island guide specialising in the Nusa islands and underwater experiences.',
            ],
            'published_at'  => '2025-04-05',
            'read_time'     => 8,
            'featured'      => true,
            'meta' => [
                'title'       => "Nusa Penida First-Timer's Guide | The Bali Guides Adventure",
                'description' => "Everything a first-time visitor needs to know about Nusa Penida — getting there, best spots, snorkelling, and practical tips.",
                'keywords'    => 'nusa penida guide, kelingking beach, nusa penida snorkelling, bali island trip',
            ],
        ],

        /* ── 3 ── */
        [
            'slug'          => 'balinese-spa-traditions-healing-rituals',
            'title'         => 'Balinese Spa Traditions: The Ancient Healing Rituals Behind the Treatments',
            'excerpt'       => 'Behind every Balinese massage, boreh scrub, and melukat ceremony lies centuries of Hindu-Balinese healing philosophy. Here is what the traditions really mean — and why they work.',
            'content'       => "
                <p>Bali has earned a global reputation as a wellness destination, and its spa culture goes far deeper than luxury hotel treatment menus. The healing traditions practised across the island are rooted in centuries of Balinese Hindu philosophy, Ayurvedic influence, and a profound connection between physical, spiritual, and environmental wellbeing.</p>

                <h2>The Balinese Approach to Healing</h2>
                <p>In Balinese belief, illness and imbalance — physical or spiritual — stem from a disruption of the body's inner harmony, known as <em>sekala</em> (the seen world) and <em>niskala</em> (the unseen world). Traditional healing addresses both dimensions simultaneously, which is why Balinese spa rituals often incorporate prayer, offerings, and sacred water alongside physical treatments.</p>

                <h2>The Boreh Scrub</h2>
                <p>One of the most distinctly Balinese treatments, the Boreh is a warming body scrub made from a paste of cloves, ginger, turmeric, galangal, and rice. Historically used by farmers and warriors to relieve muscle fatigue and improve circulation, the volcanic heat it generates draws out toxins while the spices stimulate blood flow. The scent alone — earthy, spiced, and warm — is deeply grounding.</p>

                <h2>The Balinese Massage</h2>
                <p>Unlike Thai or Swedish massage, the Balinese technique combines acupressure, skin rolling, and deep tissue manipulation using both thumbs and the full palm. The pressure points targeted correspond to traditional Balinese energy channels rather than the meridian system used in Chinese medicine — a subtle but meaningful distinction.</p>

                <h2>The Melukat Ceremony</h2>
                <p>The Melukat is a Hindu purification ritual performed at sacred water temples across Bali. Water drawn from a holy spring is channelled through carved stone spouts, and participants pass beneath each spout in sequence — cleansing both the body and the spiritual aura. The ritual is conducted by a Balinese priest (Pemangku) and accompanied by prayer and floral offerings.</p>

                <h2>The Floral Bath</h2>
                <p>The royal floral bath — a tub filled with warm water, rose petals, frangipani, and fragrant herbs — closes most traditional Balinese spa sequences. It is not merely aesthetic: in Balinese tradition, flowers carry specific spiritual energies, and immersion in floral water is believed to restore the body's energetic balance after deep tissue work.</p>

                <p>Whether you experience these treatments at a boutique spa in Ubud or through a cultural wellness retreat, understanding the tradition behind them transforms the experience from indulgent to genuinely meaningful.</p>
            ",
            'image'         => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
            'gallery'       => [
                'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
                'https://images.unsplash.com/photo-1573790387438-4da905039392?w=800&q=80',
                'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80',
            ],
            'category'      => 'wellness',
            'tags'          => ['spa', 'wellness', 'balinese healing', 'melukat', 'boreh', 'ubud'],
            'author'        => [
                'name'   => 'Ni Luh Pertiwi',
                'avatar' => 'assets/img/static/author-3.jpg',
                'bio'    => 'Certified Balinese spa therapist and wellness writer with a background in traditional Balinese healing arts.',
            ],
            'published_at'  => '2025-04-18',
            'read_time'     => 7,
            'featured'      => false,
            'meta' => [
                'title'       => 'Balinese Spa Traditions & Ancient Healing Rituals | The Bali Guides Adventure',
                'description' => 'Discover the ancient Balinese healing philosophy behind the boreh scrub, traditional massage, melukat ceremony, and floral bath.',
                'keywords'    => 'balinese spa, boreh scrub, melukat ceremony, bali wellness, traditional healing bali',
            ],
        ],

        /* ── 4 ── */
        [
            'slug'          => 'ubud-beyond-the-tourist-trail',
            'title'         => 'Ubud Beyond the Tourist Trail: Hidden Temples, Local Markets & Jungle Walks',
            'excerpt'       => "Ubud is far more than Tegalalang and the Monkey Forest. Here's how to explore the cultural heart of Bali like a local — with the hidden temples, dawn markets, and jungle ridge walks most visitors never find.",
            'content'       => "
                <p>Ubud is Bali's cultural capital, and it deserves its reputation. But most visitors follow the same well-trodden circuit — Tegalalang rice terraces, the Sacred Monkey Forest, Ubud Palace, and the art market. If you look beyond these landmarks, a quieter, more authentic Ubud reveals itself.</p>

                <h2>The Dawn Market at Pasar Ubud</h2>
                <p>Pasar Ubud's morning market operates from around 04:00 AM to 07:00 AM, before the daytime tourist market takes over the same space. Arrive before sunrise and you'll find local vendors selling fresh produce, temple offerings, tropical fruit, spices, and freshly made Balinese snacks — all at local prices, with none of the tourist crowds.</p>

                <h2>Pura Gunung Kawi Sebatu</h2>
                <p>While Tirta Empul draws thousands of visitors daily, Pura Gunung Kawi Sebatu — just 15 minutes north of Ubud — offers an almost identical holy spring experience in near-total tranquility. The temple is set in a lush jungle ravine beside a stream, and local worshippers outnumber tourists here on most days.</p>

                <h2>The Campuhan Ridge Walk</h2>
                <p>The Campuhan Ridge is Ubud's finest walking trail and surprisingly underused. The path follows a narrow ridge between two river valleys, with sweeping views of jungle, rice paddies, and distant hills. Start at 06:00 AM before the heat builds and the day-trippers arrive. The walk takes 45–60 minutes one way, ending at Karsa Kafe — the perfect breakfast stop with valley views.</p>

                <h2>Penestanan Village</h2>
                <p>Just west of central Ubud, the village of Penestanan is where Bali's expat artist community settled in the 1960s and 70s. A network of narrow lanes winds between family compounds, artist studios, and small cafés — the kind of Ubud that existed before Instagram. Worth an afternoon of aimless wandering.</p>

                <h2>Pura Taman Saraswati at Night</h2>
                <p>The lotus pond temple in the heart of Ubud is busiest at dusk, but arriving after dark — when the lotus flowers are lit and the crowds have thinned — reveals an entirely different atmosphere. A Legong or Kecak dance performance in the open-air stage beside the pond, if timed right, is one of Ubud's most memorable evenings.</p>
            ",
            'image'         => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80',
            'gallery'       => [
                'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80',
                'https://images.unsplash.com/photo-1573790387438-4da905039392?w=800&q=80',
                'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800&q=80',
            ],
            'category'      => 'culture',
            'tags'          => ['ubud', 'culture', 'hidden gems', 'temples', 'local experience', 'campuhan ridge'],
            'author'        => [
                'name'   => 'Ketut Dharma',
                'avatar' => 'assets/img/static/author-1.jpg',
                'bio'    => 'Ubud-born cultural guide and writer, leading immersive local experiences across the Ubud regency for over 12 years.',
            ],
            'published_at'  => '2025-05-02',
            'read_time'     => 9,
            'featured'      => true,
            'meta' => [
                'title'       => 'Ubud Beyond the Tourist Trail: Hidden Temples & Local Walks | The Bali Guides Adventure',
                'description' => 'Discover hidden temples, dawn markets, and jungle walks in Ubud that most tourists never find.',
                'keywords'    => 'ubud hidden gems, campuhan ridge walk, ubud local guide, bali culture, ubud temples',
            ],
        ],

        /* ── 5 ── */
        [
            'slug'          => 'bali-waterfall-guide-sekumpul-tegenungan-tibumana',
            'title'         => "Bali's Best Waterfalls: Sekumpul, Tegenungan, Kanto Lampo & Tibumana",
            'excerpt'       => "Bali's river gorges hide some of Southeast Asia's most spectacular waterfalls. Here is a complete guide to the island's four best cascades — where they are, how to get there, and what makes each one worth the journey.",
            'content'       => "
                <p>Bali's volcanic landscape channels enormous amounts of rainfall through a network of rivers and gorges, creating some of Southeast Asia's most beautiful waterfalls. Four stand out above all others — each with a distinct character, setting, and experience.</p>

                <h2>Sekumpul — Bali's Most Beautiful Waterfall</h2>
                <p>Sekumpul in North Bali is widely regarded as the most spectacular waterfall on the island. A cluster of seven cascades drops 25 metres into a lush jungle ravine, fed by multiple streams converging from the surrounding hills. Reaching Sekumpul requires a 45-minute guided trek through rice fields, bamboo forest, and a river crossing — the journey itself is part of the experience. A local guide is mandatory and worth every rupiah.</p>
                <p><strong>Best time:</strong> Morning, before 10:00 AM. Bring water shoes and a change of clothes.</p>

                <h2>Tegenungan — Accessible and Powerful</h2>
                <p>Just 15 minutes south of Ubud, Tegenungan is the most accessible of Bali's major waterfalls. A wide, powerful cascade drops into a natural pool where swimming is possible — though currents can be strong after heavy rain. The surrounding area has developed rapidly, with cafés and swing operators lining the access path, but the waterfall itself remains impressive.</p>
                <p><strong>Best time:</strong> Early morning (07:00–08:00 AM) before the crowds arrive and the light is best for photography.</p>

                <h2>Kanto Lampo — The Instagram Waterfall</h2>
                <p>Kanto Lampo has become one of Bali's most photographed water features, and for good reason. The waterfall fans out over a carved wall of black volcanic rock in a perfectly symmetrical curtain — ideal for wading into and photographing from below. The surrounding gorge is intimate and beautiful, with minimal development beyond the entrance area.</p>
                <p><strong>Best time:</strong> Mid-morning when sunlight enters the gorge. Wear water shoes — the volcanic rock is slippery.</p>

                <h2>Tibumana — The Hidden Gem</h2>
                <p>Tibumana remains one of Ubud's best-kept secrets — a multi-tiered jungle waterfall reached via a short jungle trek from the road. The falls drop in two stages into a clear pool surrounded by dense tropical vegetation, with rarely more than a handful of visitors at any time. No crowds, no swings, no cafés — just a beautiful, quiet waterfall in its natural state.</p>
                <p><strong>Best time:</strong> Any time — the lack of crowds means timing matters less here than at other waterfalls.</p>

                <h2>Practical Tips</h2>
                <ul>
                    <li>All four can be combined in a single day trip from Ubud or South Bali</li>
                    <li>Wear quick-dry clothing — most involve some wading</li>
                    <li>Bring a waterproof bag for your phone and valuables</li>
                    <li>Entrance fees range from IDR 10,000–30,000 per person</li>
                    <li>Hire a private driver — public transport to these sites is limited</li>
                </ul>
            ",
            'image'         => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800&q=80',
            'gallery'       => [
                'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800&q=80',
                'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80',
                'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
                'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?w=800&q=80',
            ],
            'category'      => 'nature',
            'tags'          => ['waterfalls', 'sekumpul', 'tegenungan', 'kanto lampo', 'tibumana', 'nature', 'ubud'],
            'author'        => [
                'name'   => 'Made Ariani',
                'avatar' => 'assets/img/static/author-2.jpg',
                'bio'    => 'Bali-based travel writer and island guide specialising in the Nusa islands and underwater experiences.',
            ],
            'published_at'  => '2025-05-20',
            'read_time'     => 10,
            'featured'      => false,
            'meta' => [
                'title'       => "Bali's Best Waterfalls: Sekumpul, Tegenungan, Kanto Lampo & Tibumana | The Bali Guides Adventure",
                'description' => "A complete guide to Bali's four best waterfalls — where they are, how to get there, and what makes each one worth visiting.",
                'keywords'    => 'bali waterfalls, sekumpul waterfall, tegenungan waterfall, kanto lampo, tibumana, bali nature',
            ],
        ],

    ],

];