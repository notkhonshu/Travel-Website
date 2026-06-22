import './bootstrap';

/* ══════════════════════════════════════════
   HEADER — scroll, bubble menu, dropdowns
   ══════════════════════════════════════════ */
(function () {
    'use strict';

    const header   = document.getElementById('tbg-header');
    const burger   = document.getElementById('tbg-burger-btn');
    const fullMenu = document.getElementById('tbg-fullmenu');
    const closeBtn = document.getElementById('tbg-menu-close');
    const bubble   = document.getElementById('tbg-menu-bubble');

    if (!header) return;

    const isTripNavbar = header.dataset.trip === 'true';

    const logo       = header.querySelector('.tbg-logo');
    const bars       = header.querySelectorAll('.tbg-bar-1, .tbg-bar-2');
    const burger_btn = header.querySelector('.tbg-burger');

    function applyScrolled() {
        header.classList.add('bg-white', 'shadow-[var(--shadow-card)]');
        header.classList.add('border-b', 'border-[var(--color-border)]');
        header.classList.remove('bg-transparent', 'border-white/20');
        logo?.classList.remove('text-white');
        logo?.classList.add('text-[var(--color-heading-text)]');
        bars.forEach(bar => {
            bar.classList.remove('bg-white');
            bar.classList.add('bg-[var(--color-heading-text)]');
        });
        burger_btn?.classList.remove('hover:bg-white/12');
        burger_btn?.classList.add('hover:bg-[var(--color-surface)]');
        header.querySelectorAll('.tbg-nav-text').forEach(el => {
            el.classList.remove('text-white', 'hover:bg-white/12');
            el.classList.add('text-[var(--color-heading-text)]', 'hover:bg-[var(--color-surface)]', 'hover:text-[var(--color-primary)]');
        });
    }

    function applyUnscrolled() {
        header.classList.remove('bg-white', 'border-b', 'border-[var(--color-border)]', 'shadow-[var(--shadow-card)]');
        header.classList.add('bg-transparent', 'border-white/20');
        logo?.classList.add('text-white');
        logo?.classList.remove('text-[var(--color-heading-text)]');
        bars.forEach(bar => {
            bar.classList.add('bg-white');
            bar.classList.remove('bg-[var(--color-heading-text)]');
        });
        burger_btn?.classList.add('hover:bg-white/12');
        burger_btn?.classList.remove('hover:bg-[var(--color-surface)]');
        header.querySelectorAll('.tbg-nav-text').forEach(el => {
            el.classList.add('text-white', 'hover:bg-white/12');
            el.classList.remove('text-[var(--color-heading-text)]', 'hover:bg-[var(--color-surface)]', 'hover:text-[var(--color-primary)]');
        });
    }

    function onScroll() {
        if (isTripNavbar) return;
        window.scrollY > 10 ? applyScrolled() : applyUnscrolled();
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    if (isTripNavbar) {
        logo?.classList.remove('text-white');
        logo?.classList.add('text-[var(--color-heading-text)]');
        bars.forEach(bar => {
            bar.classList.remove('bg-white');
            bar.classList.add('bg-[var(--color-heading-text)]');
        });
        burger_btn?.classList.remove('hover:bg-white/12');
        burger_btn?.classList.add('hover:bg-[var(--color-surface)]');
    }

    function getBurgerCenter() {
        const rect = burger ? burger.getBoundingClientRect() : { top: 24, left: window.innerWidth - 56, width: 40, height: 40 };
        return { cx: rect.left + rect.width / 2, cy: rect.top + rect.height / 2, size: Math.max(rect.width, rect.height) };
    }

    function calcScale(cx, cy, size) {
        const vw = window.innerWidth, vh = window.innerHeight;
        const maxDist = Math.sqrt(Math.pow(Math.max(cx, vw - cx), 2) + Math.pow(Math.max(cy, vh - cy), 2));
        return (maxDist * 2) / size + 1;
    }

    function positionBubbleAtBurger() {
        if (!bubble) return;
        const { cx, cy, size } = getBurgerCenter();
        bubble.style.transition = 'none';
        bubble.style.width      = size + 'px';
        bubble.style.height     = size + 'px';
        bubble.style.left       = (cx - size / 2) + 'px';
        bubble.style.top        = (cy - size / 2) + 'px';
        bubble.style.transform  = 'scale(1)';
        bubble.style.opacity    = '0';
    }

<<<<<<< HEAD
    let menuIsOpen  = false;
    let bubbleTimer = null;
=======
    let menuIsOpen = false, bubbleTimer = null;
>>>>>>> origin/master

    function openMenu() {
        if (!fullMenu || !burger || menuIsOpen) return;
        menuIsOpen = true;
        clearTimeout(bubbleTimer);
        positionBubbleAtBurger();
        const { cx, cy, size } = getBurgerCenter();
        const targetScale = calcScale(cx, cy, size);
        requestAnimationFrame(() => {
            if (!bubble) return;
            bubble.style.transition = 'transform 480ms cubic-bezier(0.4, 0, 0.2, 1), opacity 80ms ease';
            bubble.style.opacity    = '1';
            requestAnimationFrame(() => { bubble.style.transform = `scale(${targetScale})`; });
        });
        bubbleTimer = setTimeout(() => {
            fullMenu.style.opacity       = '1';
            fullMenu.style.pointerEvents = 'auto';
            fullMenu.removeAttribute('aria-hidden');
        }, 160);
        burger.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        if (!fullMenu || !burger || !menuIsOpen) return;
        menuIsOpen = false;
        clearTimeout(bubbleTimer);
        fullMenu.style.opacity       = '0';
        fullMenu.style.pointerEvents = 'none';
        fullMenu.setAttribute('aria-hidden', 'true');
        bubbleTimer = setTimeout(() => {
            if (!bubble) return;
            bubble.style.transition = 'transform 380ms cubic-bezier(0.4, 0, 0.2, 1), opacity 180ms ease 200ms';
            bubble.style.transform  = 'scale(1)';
            bubble.style.opacity    = '0';
        }, 60);
        burger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    positionBubbleAtBurger();
    burger?.addEventListener('click', () => menuIsOpen ? closeMenu() : openMenu());
    closeBtn?.addEventListener('click', closeMenu);

    if (!isTripNavbar) {
        const menuItems = document.querySelectorAll('.tbg-menu-item');
        const triggers  = document.querySelectorAll('.tbg-menu-trigger');
        const dropdowns = document.querySelectorAll('.tbg-dropdown');

        function closeAllDropdowns() {
            menuItems.forEach(i => i.classList.remove('tbg-open'));
            dropdowns.forEach(d => d.classList.remove('tbg-drop-open'));
            triggers.forEach(t => t.setAttribute('aria-expanded', 'false'));
        }

        triggers.forEach((trigger, idx) => {
            trigger.addEventListener('click', e => {
                e.stopPropagation();
                const isOpen = menuItems[idx]?.classList.contains('tbg-open');
                closeAllDropdowns();
                if (!isOpen) {
                    menuItems[idx]?.classList.add('tbg-open');
                    dropdowns[idx]?.classList.add('tbg-drop-open');
                    trigger.setAttribute('aria-expanded', 'true');
                }
            });
        });

        document.addEventListener('click', e => {
            if (!e.target.closest('.tbg-menu-item')) closeAllDropdowns();
        });
    }

    document.querySelectorAll('.tbg-acc-trigger').forEach(trigger => {
        trigger.addEventListener('click', () => {
            const idx    = trigger.dataset.accIdx;
            const body   = document.getElementById('tbg-acc-' + idx);
            const caret  = trigger.querySelector('.tbg-acc-caret');
            const isOpen = trigger.getAttribute('aria-expanded') === 'true';
            document.querySelectorAll('.tbg-acc-trigger').forEach(t => {
                t.setAttribute('aria-expanded', 'false');
                t.querySelector('.tbg-acc-caret')?.classList.remove('rotate-180');
                const b = document.getElementById('tbg-acc-' + t.dataset.accIdx);
                if (b) { b.classList.remove('tbg-acc-open', 'flex'); b.classList.add('hidden'); }
            });
            if (!isOpen && body) {
                trigger.setAttribute('aria-expanded', 'true');
                caret?.classList.add('rotate-180');
                body.classList.remove('hidden');
                body.classList.add('tbg-acc-open', 'flex');
            }
        });
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeMenu();
            document.querySelectorAll('.tbg-menu-item').forEach(i => i.classList.remove('tbg-open'));
            document.querySelectorAll('.tbg-dropdown').forEach(d => d.classList.remove('tbg-drop-open'));
            document.querySelectorAll('.tbg-menu-trigger').forEach(t => t.setAttribute('aria-expanded', 'false'));
        }
    });

<<<<<<< HEAD
})();

/* ══════════════════════════════════════════
   TRIP NAVBAR SEARCH — desktop + mobile
   ══════════════════════════════════════════ */
(function () {
    'use strict';

    const header = document.getElementById('tbg-header');
    if (!header || header.dataset.trip !== 'true') return;

    const TRIP_URL  = '/trip';
    const urlParams = new URLSearchParams(window.location.search);
    const urlQ      = urlParams.get('q') ?? '';
=======
    if (isTripNavbar) {
        const TRIP_URL  = '/trip';
        const urlParams = new URLSearchParams(window.location.search);
        const urlQ      = urlParams.get('q') ?? '';

        function createSearchInstance({ input, clearBtn, emptyEl, itemSelector, groupSelector, onOpen, onClose }) {
            if (!input) return null;
            const groups = document.querySelectorAll(groupSelector);
>>>>>>> origin/master

    const searchIconBtn  = document.getElementById('tbg-search-icon-btn');
    const searchPanel    = document.getElementById('tbg-search-panel-mobile');
    const searchInputMob = document.getElementById('tbg-search-input-mobile');

    function openMobilePanel() {
        if (!searchPanel) return;
        searchPanel.style.opacity       = '1';
        searchPanel.style.pointerEvents = 'auto';
        searchPanel.style.transform     = 'translateY(0)';
        searchIconBtn?.setAttribute('aria-expanded', 'true');
        requestAnimationFrame(() => searchInputMob?.focus());
    }

    function closeMobilePanel() {
        if (!searchPanel) return;
        searchPanel.style.opacity       = '0';
        searchPanel.style.pointerEvents = 'none';
        searchPanel.style.transform     = 'translateY(-8px)';
        searchIconBtn?.setAttribute('aria-expanded', 'false');
    }

    searchIconBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = searchPanel?.style.opacity === '1';
        isOpen ? closeMobilePanel() : openMobilePanel();
    });

    document.addEventListener('click', e => {
        if (!searchPanel) return;
        if (!searchPanel.contains(e.target) && !searchIconBtn?.contains(e.target)) {
            closeMobilePanel();
        }
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeMobilePanel();
    });

    const searchWrap = document.getElementById('tbg-search-wrap');

    document.addEventListener('click', e => {
        if (!searchWrap?.contains(e.target)) {
            document.getElementById('tbg-search-results')?.classList.remove('tbg-search-open');
        }
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            document.getElementById('tbg-search-results')?.classList.remove('tbg-search-open');
        }
    });

    function createSearchInstance({ input, clearBtn, emptyEl, itemSelector, groupSelector, onOpen, onClose }) {
        if (!input) return null;

        const groups = document.querySelectorAll(groupSelector);

        function filterResults(q) {
            let total = 0;
            groups.forEach(group => {
                const items = group.querySelectorAll(itemSelector);
                let visible = 0;
                items.forEach(item => {
                    const title   = (item.dataset.searchTitle   ?? '').toLowerCase();
                    const excerpt = (item.dataset.searchExcerpt ?? '').toLowerCase();
                    const tags    = (item.dataset.searchTags    ?? '').toLowerCase();
                    const match   = q === '' || title.includes(q) || excerpt.includes(q) || tags.includes(q);
                    item.style.display = match ? '' : 'none';
                    if (match) visible++;
                });
<<<<<<< HEAD
                group.style.display = visible > 0 ? '' : 'none';
                total += visible;
            });
            if (emptyEl) emptyEl.classList.toggle('hidden', total > 0 || q === '');
        }

        function submitSearch(keyword) {
            if (!keyword) return;
            const params = new URLSearchParams(window.location.search);
            params.set('q', keyword);
            params.delete('destination');
            window.location.href = TRIP_URL + '?' + params.toString();
        }

        if (urlQ) {
            input.value = urlQ;
            clearBtn?.classList.remove('hidden');
        }

        input.addEventListener('focus', () => {
            filterResults(input.value.trim().toLowerCase());
            onOpen?.();
        });

        input.addEventListener('input', () => {
            const q = input.value.trim().toLowerCase();
            clearBtn?.classList.toggle('hidden', q === '');
            filterResults(q);
            onOpen?.();
        });

        input.addEventListener('keydown', e => {
            if (e.key === 'Enter') {
                e.preventDefault();
                onClose?.();
                submitSearch(input.value.trim());
            }
            if (e.key === 'Escape') onClose?.();
        });

        clearBtn?.addEventListener('click', () => {
            input.value = '';
            clearBtn.classList.add('hidden');
            filterResults('');
            input.focus();
            const params = new URLSearchParams(window.location.search);
            if (params.has('q')) {
                params.delete('q');
                const qs = params.toString();
                window.location.href = TRIP_URL + (qs ? '?' + qs : '');
            }
        });

        filterResults(urlQ.toLowerCase());
        return { filterResults };
    }

    try {
=======
                if (emptyEl) emptyEl.classList.toggle('hidden', total > 0 || q === '');
            }

            function submitSearch(keyword) {
                if (!keyword) return;
                const params = new URLSearchParams(window.location.search);
                params.set('q', keyword);
                params.delete('destination');
                window.location.href = TRIP_URL + '?' + params.toString();
            }

            if (urlQ) { input.value = urlQ; clearBtn?.classList.remove('hidden'); }

            input.addEventListener('focus', () => { filterResults(input.value.trim().toLowerCase()); onOpen?.(); });
            input.addEventListener('input', () => {
                const q = input.value.trim().toLowerCase();
                clearBtn?.classList.toggle('hidden', q === '');
                filterResults(q);
                onOpen?.();
            });
            input.addEventListener('keydown', e => {
                if (e.key === 'Enter') { e.preventDefault(); onClose?.(); submitSearch(input.value.trim()); }
                if (e.key === 'Escape') onClose?.();
            });
            clearBtn?.addEventListener('click', () => {
                input.value = '';
                clearBtn.classList.add('hidden');
                filterResults('');
                input.focus();
                const params = new URLSearchParams(window.location.search);
                if (params.has('q')) {
                    params.delete('q');
                    const qs = params.toString();
                    window.location.href = TRIP_URL + (qs ? '?' + qs : '');
                }
            });

            filterResults(urlQ.toLowerCase());
            return { filterResults };
        }

        const searchWrap = document.getElementById('tbg-search-wrap');
>>>>>>> origin/master
        createSearchInstance({
            input:         document.getElementById('tbg-search-input'),
            clearBtn:      document.getElementById('tbg-search-clear'),
            emptyEl:       document.getElementById('tbg-search-empty'),
            itemSelector:  '.tbg-result-item',
            groupSelector: '.tbg-result-group',
            onOpen:  () => document.getElementById('tbg-search-results')?.classList.add('tbg-search-open'),
            onClose: () => document.getElementById('tbg-search-results')?.classList.remove('tbg-search-open'),
        });
    } catch (err) {
        console.error('Desktop search init failed:', err);
    }

<<<<<<< HEAD
    try {
=======
        document.addEventListener('click', e => {
            if (!searchWrap?.contains(e.target))
                document.getElementById('tbg-search-results')?.classList.remove('tbg-search-open');
        });
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape')
                document.getElementById('tbg-search-results')?.classList.remove('tbg-search-open');
        });

        const searchIconBtn  = document.getElementById('tbg-search-icon-btn');
        const searchPanel    = document.getElementById('tbg-search-panel-mobile');
        const searchInputMob = document.getElementById('tbg-search-input-mobile');

        function openMobilePanel() {
            if (!searchPanel) return;
            searchPanel.classList.add('tbg-search-panel-open');
            searchIconBtn?.setAttribute('aria-expanded', 'true');
            requestAnimationFrame(() => searchInputMob?.focus());
        }
        function closeMobilePanel() {
            if (!searchPanel) return;
            searchPanel.classList.remove('tbg-search-panel-open');
            searchIconBtn?.setAttribute('aria-expanded', 'false');
        }

        searchIconBtn?.addEventListener('click', () => {
            searchPanel?.classList.contains('tbg-search-panel-open') ? closeMobilePanel() : openMobilePanel();
        });

>>>>>>> origin/master
        createSearchInstance({
            input:         searchInputMob,
            clearBtn:      document.getElementById('tbg-search-clear-mobile'),
            emptyEl:       document.getElementById('tbg-search-empty-mobile'),
            itemSelector:  '.tbg-result-item-mobile',
            groupSelector: '.tbg-result-group-mobile',
            onOpen:  null,
            onClose: closeMobilePanel,
        });
<<<<<<< HEAD
    } catch (err) {
        console.error('Mobile search init failed:', err);
=======

        document.addEventListener('click', e => {
            if (!searchPanel) return;
            if (!searchPanel.contains(e.target) && !searchIconBtn?.contains(e.target)) closeMobilePanel();
        });
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMobilePanel(); });
>>>>>>> origin/master
    }

})();

/* ══════════════════════════════════════════
   HERO SEARCH — sticky on scroll
   ══════════════════════════════════════════ */
(function () {
    'use strict';

    if (!('IntersectionObserver' in window)) return;

    function getNavbarHeight() {
        const navbar = document.getElementById('tbg-header');
        return navbar ? navbar.offsetHeight : 64;
    }

    document.querySelectorAll('[data-hero-sentinel]').forEach(sentinel => {
        const heroId = sentinel.dataset.heroSentinel;
        const wrap   = document.getElementById(heroId + '_search_wrap');
        if (!wrap) return;

        let isSticky = false;

        function makeSticky() {
            if (isSticky) return;
            isSticky = true;
            wrap.classList.remove('relative');
            wrap.classList.add('fixed', 'left-0', 'right-0', 'z-40', 'py-2');
            wrap.style.top = getNavbarHeight() + 'px';
        }

        function makeInline() {
            if (!isSticky) return;
            isSticky = false;
            wrap.classList.remove('fixed', 'left-0', 'right-0', 'z-40', 'py-2');
            wrap.classList.add('relative');
            wrap.style.top = '';
        }

        new IntersectionObserver(entries => {
            entries.forEach(entry => entry.isIntersecting ? makeInline() : makeSticky());
        }, { threshold: 0 }).observe(sentinel);
    });

})();

window.heroSearchSubmit = function (heroId, baseUrl) {
    const input = document.getElementById(heroId + '_search');
    const q     = (input?.value ?? '').trim();
    if (!q) return;
    window.location.href = baseUrl + '?q=' + encodeURIComponent(q);
};

/* ══════════════════════════════════════════
   SLIDERS — Swiper.js via CDN
   ══════════════════════════════════════════ */
(function () {
    'use strict';

    function initSwiper(swiperEl, config) {
        if (swiperEl.swiper) {
            swiperEl.swiper.destroy(true, true);
        }
        return new Swiper(swiperEl, config);
    }

    function refreshDots(dotsEl, realIndex) {
        if (!dotsEl) return;
        dotsEl.querySelectorAll('button').forEach((btn, i) => {
            const active = i === realIndex;
            btn.classList.toggle('!w-4',                      active);
            btn.classList.toggle('!bg-[var(--color-accent)]', active);
            btn.classList.toggle('bg-[var(--color-border)]',  !active);
        });
    }

    function buildDots(dotsEl, realTotal, swiper) {
        if (!dotsEl) return;
        dotsEl.innerHTML = '';
        for (let i = 0; i < realTotal; i++) {
            const btn = document.createElement('button');
            btn.className = 'w-1.5 h-1.5 rounded-full bg-[var(--color-border)] transition-all duration-300';
            btn.setAttribute('aria-label', 'Go to slide ' + (i + 1));
            btn.addEventListener('click', () => {
                swiper.slideToLoop(i);
                swiper.autoplay.start();
            });
            dotsEl.appendChild(btn);
        }
        refreshDots(dotsEl, swiper.realIndex);
    }

<<<<<<< HEAD
        const cards = Array.from(track.querySelectorAll('.' + cardClass));
        const total = cards.length;
        if (total === 0) return;
=======
    function initPkgSwipers() {
        document.querySelectorAll('[data-pkg-swiper]').forEach(section => {
            const id       = section.dataset.pkgSwiper;
            const swiperEl = document.getElementById(id + '_swiper');
            const btnPrev  = document.getElementById(id + '_prev');
            const btnNext  = document.getElementById(id + '_next');
            const dotsEl   = document.getElementById(id + '_dots');

            if (!swiperEl) return;
>>>>>>> origin/master

            const realTotal = swiperEl.querySelectorAll('.swiper-slide').length;
            if (!realTotal) return;

            const swiper = initSwiper(swiperEl, {
                loop: realTotal > 1,
                grabCursor: true,
                slidesPerView: 1.2,
                spaceBetween: 16,
                autoplay: realTotal > 1 ? {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                } : false,
                breakpoints: {
                    480:  { slidesPerView: 1.5, spaceBetween: 16 },
                    640:  { slidesPerView: 2.2, spaceBetween: 16 },
                    768:  { slidesPerView: 2.5, spaceBetween: 20 },
                    1024: { slidesPerView: 3.2, spaceBetween: 20 },
                    1280: { slidesPerView: 4,   spaceBetween: 24 },
                },
            });

            buildDots(dotsEl, realTotal, swiper);
            swiper.on('slideChange', () => refreshDots(dotsEl, swiper.realIndex));
            btnPrev?.addEventListener('click', () => swiper.slidePrev());
            btnNext?.addEventListener('click', () => swiper.slideNext());
        });
    }

    function initDestSwipers() {
        document.querySelectorAll('[data-dest-swiper]').forEach(section => {
            const id       = section.dataset.destSwiper;
            const swiperEl = document.getElementById(id + '_swiper');
            const btnPrev  = document.getElementById(id + '_prev');
            const btnNext  = document.getElementById(id + '_next');
            const dotsEl   = document.getElementById(id + '_dots');

            if (!swiperEl) return;

            const realTotal = swiperEl.querySelectorAll('.swiper-slide').length;
            if (!realTotal) return;

            const swiper = initSwiper(swiperEl, {
                loop: realTotal > 1,
                grabCursor: true,
                slidesPerView: 1.2,
                spaceBetween: 12,
                autoplay: realTotal > 1 ? {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                } : false,
                breakpoints: {
                    480:  { slidesPerView: 1.5, spaceBetween: 12 },
                    640:  { slidesPerView: 2,   spaceBetween: 16 },
                    768:  { slidesPerView: 2.5, spaceBetween: 16 },
                    1024: { slidesPerView: 3,   spaceBetween: 20 },
                    1280: { slidesPerView: 3.5, spaceBetween: 24 },
                },
            });

            buildDots(dotsEl, realTotal, swiper);
            swiper.on('slideChange', () => refreshDots(dotsEl, swiper.realIndex));
            btnPrev?.addEventListener('click', () => swiper.slidePrev());
            btnNext?.addEventListener('click', () => swiper.slideNext());
        });
    }

    function initSwipers() {
        if (typeof Swiper === 'undefined') {
            setTimeout(initSwipers, 50);
            return;
        }
<<<<<<< HEAD

        let pointer     = 0;
        let offsetSteps = 0;
        let isAnimating = false;
        let autoTimer   = null;

        cards.forEach(c => track.insertBefore(c.cloneNode(true), track.firstChild));
        cards.forEach(c => track.appendChild(c.cloneNode(true)));

        const allCards   = Array.from(track.querySelectorAll('.' + cardClass));
        const sourceHTML = cards.map(c => c.innerHTML);

        function mod(n, m) { return ((n % m) + m) % m; }

        let cachedCardWidth = 0;

        function getTrackGap() {
            const style = getComputedStyle(track);
            const gap   = parseFloat(style.columnGap || style.gap || '0');
            return Number.isNaN(gap) ? 0 : gap;
        }

        function measureCardWidth() {
            const w = allCards[0].getBoundingClientRect().width;
            if (w === 0) return false;
            cachedCardWidth = w + getTrackGap();
            return true;
        }

        function applyTransform(animate) {
            if (cachedCardWidth === 0) return;
            track.style.transition = animate ? 'transform 500ms ease-in-out' : 'none';
            track.style.transform  = `translateX(-${total * cachedCardWidth + offsetSteps * cachedCardWidth}px)`;
        }

        function initPosition() {
            if (!measureCardWidth()) return;
            applyTransform(false);
        }

        initPosition();
        requestAnimationFrame(() => {
            if (!measureCardWidth()) return;
            applyTransform(false);
        });
        window.addEventListener('load', () => {
            if (!measureCardWidth()) return;
            applyTransform(false);
            updateDots();
        }, { once: true });

        let resizeTimer = null;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(initPosition, 100);
        });

        function updateDots() {
            const realIdx = mod(pointer - 1, total);
            dots.forEach((d, i) => {
                d.classList.toggle('!w-4', i === realIdx);
                d.classList.toggle('!bg-[var(--color-accent)]', i === realIdx);
            });
        }

        function step(dir) {
            if (isAnimating) return;
            isAnimating = true;
            offsetSteps += dir;
            applyTransform(true);
            setTimeout(() => {
                if (dir > 0) {
                    pointer++;
                    const idx = mod(pointer - 1, total);
                    const firstEl = track.firstElementChild;
                    firstEl.innerHTML = sourceHTML[idx];
                    track.appendChild(firstEl);
                    offsetSteps -= 1;
                    applyTransform(false);
                } else {
                    pointer--;
                    const idx = mod(pointer, total);
                    const lastEl = track.lastElementChild;
                    lastEl.innerHTML = sourceHTML[idx];
                    track.insertBefore(lastEl, track.firstElementChild);
                    offsetSteps += 1;
                    applyTransform(false);
                }
                updateDots();
                isAnimating = false;
            }, 500);
        }

        function goNext() { step(1); }
        function goPrev() { step(-1); }

        updateDots();

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                const targetIdx = parseInt(dot.dataset.pkgIndex, 10);
                const realIdx   = mod(pointer - 1, total);
                let diff        = targetIdx - realIdx;
                if (diff > total / 2) diff -= total;
                if (diff < -total / 2) diff += total;
                let remaining = diff;
                const runStep = () => {
                    if (remaining === 0) return;
                    const dir = remaining > 0 ? 1 : -1;
                    step(dir);
                    remaining -= dir;
                    setTimeout(runStep, 520);
                };
                runStep();
                resetAuto();
=======
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                initPkgSwipers();
                initDestSwipers();
>>>>>>> origin/master
            });
        });
    }

        btnPrev?.addEventListener('click', () => { goPrev(); resetAuto(); });
        btnNext?.addEventListener('click', () => { goNext(); resetAuto(); });

        function startAuto() { autoTimer = setInterval(goNext, 4000); }
        function resetAuto() { clearInterval(autoTimer); startAuto(); }

        document.addEventListener('visibilitychange', () => {
            if (document.hidden) clearInterval(autoTimer);
            else resetAuto();
        });

        let touchStartX = 0;
        let touchDeltaX = 0;

        wrap.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; clearInterval(autoTimer); }, { passive: true });
        wrap.addEventListener('touchmove',  e => { touchDeltaX = e.touches[0].clientX - touchStartX; }, { passive: true });
        wrap.addEventListener('touchend',   () => {
            if (Math.abs(touchDeltaX) > 50) (touchDeltaX < 0 ? goNext() : goPrev());
            touchDeltaX = 0;
            startAuto();
        });

        let isMouseDown = false;
        let mouseStartX = 0;
        let mouseDeltaX = 0;

        wrap.addEventListener('mousedown', e => {
            isMouseDown = true; mouseStartX = e.clientX; mouseDeltaX = 0;
            clearInterval(autoTimer); wrap.style.cursor = 'grabbing'; e.preventDefault();
        });
        window.addEventListener('mousemove', e => { if (!isMouseDown) return; mouseDeltaX = e.clientX - mouseStartX; });
        window.addEventListener('mouseup', () => {
            if (!isMouseDown) return;
            isMouseDown = false; wrap.style.cursor = 'grab';
            if (Math.abs(mouseDeltaX) > 50) (mouseDeltaX < 0 ? goNext() : goPrev());
            mouseDeltaX = 0; startAuto();
        });
        window.addEventListener('mouseleave', () => {
            if (!isMouseDown) return;
            isMouseDown = false; wrap.style.cursor = 'grab';
            if (Math.abs(mouseDeltaX) > 50) (mouseDeltaX < 0 ? goNext() : goPrev());
            mouseDeltaX = 0; startAuto();
        });

        wrap.style.cursor = 'grab';
        updateDots();
        startAuto();
    });

})();

/* ══════════════════════════════════════════
   DESTINATIONS — infinite loop slider
   ══════════════════════════════════════════ */
(function () {
    'use strict';

    document.querySelectorAll('[data-dest-slider]').forEach(section => {
        const sectionId = section.dataset.destSlider;
        const track     = document.getElementById(sectionId + '_track');
        const wrap      = document.getElementById(sectionId + '_track_wrap');
        const btnPrev   = document.getElementById(sectionId + '_prev');
        const btnNext   = document.getElementById(sectionId + '_next');
        const dots      = document.querySelectorAll('#' + sectionId + '_dots .tbg-dest-dot');

        if (!track || !wrap) return;

        const cards = Array.from(track.querySelectorAll('.tbg-dest-card'));
        const total = cards.length;
        if (total === 0) return;

        if (total === 1) {
            track.style.flexWrap = 'wrap';
            if (btnPrev) btnPrev.style.display = 'none';
            if (btnNext) btnNext.style.display = 'none';
            const dotsWrap = document.getElementById(sectionId + '_dots');
            if (dotsWrap) dotsWrap.style.display = 'none';
            return;
        }

        let pointer     = 0;
        let offsetSteps = 0;
        let isAnimating = false;
        let autoTimer   = null;

        cards.forEach(c => track.insertBefore(c.cloneNode(true), track.firstChild));
        cards.forEach(c => track.appendChild(c.cloneNode(true)));

        const allCards   = Array.from(track.querySelectorAll('.tbg-dest-card'));
        const sourceHTML = cards.map(c => c.innerHTML);

        function mod(n, m) { return ((n % m) + m) % m; }

        let cachedCardWidth = 0;

        function getTrackGap() {
            const style = getComputedStyle(track);
            const gap   = parseFloat(style.columnGap || style.gap || '0');
            return Number.isNaN(gap) ? 0 : gap;
        }

        function measureCardWidth() {
            const w = allCards[0].getBoundingClientRect().width;
            if (w === 0) return false;
            cachedCardWidth = w + getTrackGap();
            return true;
        }

        function applyTransform(animate) {
            if (cachedCardWidth === 0) return;
            track.style.transition = animate ? 'transform 500ms ease-in-out' : 'none';
            track.style.transform  = `translateX(-${total * cachedCardWidth + offsetSteps * cachedCardWidth}px)`;
        }

        function initPosition() {
            if (!measureCardWidth()) return;
            applyTransform(false);
        }

        initPosition();
<<<<<<< HEAD
        requestAnimationFrame(() => {
            if (!measureCardWidth()) return;
            applyTransform(false);
        });
        window.addEventListener('load', () => {
            if (!measureCardWidth()) return;
            applyTransform(false);
        }, { once: true });
=======
        requestAnimationFrame(initPosition);
        window.addEventListener('load', initPosition, { once: true });
>>>>>>> origin/master

        let resizeTimer = null;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(initPosition, 100);
        });

        function updateDots() {
            const realIdx = mod(pointer - 1, total);
            dots.forEach((d, i) => {
                d.classList.toggle('!w-4',                      i === realIdx);
                d.classList.toggle('!bg-[var(--color-accent)]', i === realIdx);
                d.classList.toggle('bg-[var(--color-border)]',  i !== realIdx);
            });
        }

        function step(dir) {
            if (isAnimating) return;
            isAnimating = true;
            offsetSteps += dir;
            applyTransform(true);
            setTimeout(() => {
                if (dir > 0) {
                    pointer++;
                    const idx = mod(pointer - 1, total);
                    const firstEl = track.firstElementChild;
                    firstEl.innerHTML = sourceHTML[idx];
                    track.appendChild(firstEl);
                    offsetSteps -= 1;
                    applyTransform(false);
                } else {
                    pointer--;
                    const idx = mod(pointer, total);
                    const lastEl = track.lastElementChild;
                    lastEl.innerHTML = sourceHTML[idx];
                    track.insertBefore(lastEl, track.firstElementChild);
                    offsetSteps += 1;
                    applyTransform(false);
                }
                updateDots();
                isAnimating = false;
            }, 500);
        }

        function goNext() { step(1); }
        function goPrev() { step(-1); }

        updateDots();

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                const targetIdx = parseInt(dot.dataset.destIndex ?? '0', 10);
                const realIdx   = mod(pointer - 1, total);
                let diff        = targetIdx - realIdx;
                if (diff > total / 2) diff -= total;
                if (diff < -total / 2) diff += total;
                let remaining = diff;
                const runStep = () => {
                    if (remaining === 0) return;
                    const dir = remaining > 0 ? 1 : -1;
                    step(dir);
                    remaining -= dir;
                    setTimeout(runStep, 520);
                };
                runStep();
                resetAuto();
            });
        });

        btnPrev?.addEventListener('click', () => { goPrev(); resetAuto(); });
        btnNext?.addEventListener('click', () => { goNext(); resetAuto(); });

        function startAuto() { autoTimer = setInterval(goNext, 4000); }
        function resetAuto() { clearInterval(autoTimer); startAuto(); }

        document.addEventListener('visibilitychange', () => {
            if (document.hidden) clearInterval(autoTimer);
            else resetAuto();
        });

        let touchStartX = 0;
        let touchDeltaX = 0;

        wrap.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; clearInterval(autoTimer); }, { passive: true });
        wrap.addEventListener('touchmove',  e => { touchDeltaX = e.touches[0].clientX - touchStartX; }, { passive: true });
        wrap.addEventListener('touchend',   () => {
            if (Math.abs(touchDeltaX) > 50) (touchDeltaX < 0 ? goNext() : goPrev());
            touchDeltaX = 0;
            startAuto();
        });

        let isMouseDown = false;
        let mouseStartX = 0;
        let mouseDeltaX = 0;

        wrap.addEventListener('mousedown', e => {
            isMouseDown = true; mouseStartX = e.clientX; mouseDeltaX = 0;
            clearInterval(autoTimer); wrap.style.cursor = 'grabbing'; e.preventDefault();
        });
        window.addEventListener('mousemove', e => { if (!isMouseDown) return; mouseDeltaX = e.clientX - mouseStartX; });
        window.addEventListener('mouseup', () => {
            if (!isMouseDown) return;
            isMouseDown = false; wrap.style.cursor = 'grab';
            if (Math.abs(mouseDeltaX) > 50) (mouseDeltaX < 0 ? goNext() : goPrev());
            mouseDeltaX = 0; startAuto();
        });
        window.addEventListener('mouseleave', () => {
            if (!isMouseDown) return;
            isMouseDown = false; wrap.style.cursor = 'grab';
            if (Math.abs(mouseDeltaX) > 50) (mouseDeltaX < 0 ? goNext() : goPrev());
            mouseDeltaX = 0; startAuto();
        });

        wrap.style.cursor = 'grab';
        startAuto();
    });

})();

/* ══════════════════════════════════════════
   GALLERY — scroll reveal + lightbox
   ══════════════════════════════════════════ */
(function () {
    'use strict';
<<<<<<< HEAD

    const grid = document.getElementById('tbgGrid');
=======
    const grid  = document.getElementById('tbgGrid');
>>>>>>> origin/master
    if (!grid) return;

    const items = Array.from(grid.querySelectorAll('button[data-index]'));
    if (!items.length) return;

    const lb    = document.getElementById('tbgLb');
    const lbImg = document.getElementById('tbgLbImg');
    const lbLbl = document.getElementById('tbgLbLabel');
    const lbCtr = document.getElementById('tbgLbCounter');
    if (!lb || !lbImg) return;

    let current = 0;

    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReduced) {
        items.forEach(el => { el.classList.remove('opacity-0', 'translate-y-4'); el.classList.add('opacity-100', 'translate-y-0'); });
    } else if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                const el  = entry.target;
                const idx = parseInt(el.dataset.index, 10);
                setTimeout(() => {
                    el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    el.classList.remove('opacity-0', 'translate-y-4');
                    el.classList.add('opacity-100', 'translate-y-0');
                }, (idx % 6) * 60);
                io.unobserve(el);
            });
        }, { threshold: 0.08 });
        items.forEach(el => io.observe(el));
    } else {
        items.forEach(el => { el.classList.remove('opacity-0', 'translate-y-4'); el.classList.add('opacity-100', 'translate-y-0'); });
    }

    function openLb(index) {
        current = ((index % items.length) + items.length) % items.length;
        const img = items[current].querySelector('img');
        lbImg.style.opacity = '0';
<<<<<<< HEAD
        lbImg.src           = img.src;
        lbImg.alt           = img.alt;
=======
        lbImg.src = img.src;
        lbImg.alt = img.alt;
>>>>>>> origin/master
        if (lbLbl) lbLbl.textContent = img.alt ? img.alt.replace(/[-_]/g, ' ').replace(/\b\w/g, c => c.toUpperCase()) : '';
        if (lbCtr) lbCtr.textContent = (current + 1) + ' / ' + items.length;
        lbImg.onload = null;
        lbImg.onload = () => { lbImg.style.opacity = '1'; };
        if (lbImg.complete && lbImg.naturalWidth) lbImg.style.opacity = '1';
        lb.removeAttribute('hidden');
        requestAnimationFrame(() => lb.classList.add('opacity-100'));
        document.body.style.overflow = 'hidden';
    }

    function closeLb() {
        lb.classList.remove('opacity-100');
        lb.addEventListener('transitionend', () => {
            lb.setAttribute('hidden', '');
            lbImg.onload = null;
            lbImg.src    = '';
            document.body.style.overflow = '';
        }, { once: true });
    }

    items.forEach((btn, i) => btn.addEventListener('click', () => openLb(i)));
    document.getElementById('tbgLbClose')?.addEventListener('click', closeLb);
    document.getElementById('tbgLbPrev')?.addEventListener('click', e => { e.stopPropagation(); openLb(current - 1); });
    document.getElementById('tbgLbNext')?.addEventListener('click', e => { e.stopPropagation(); openLb(current + 1); });
    lb.addEventListener('click', e => { if (e.target === lb) closeLb(); });
<<<<<<< HEAD

=======
>>>>>>> origin/master
    document.addEventListener('keydown', e => {
        if (lb.hasAttribute('hidden')) return;
        if (e.key === 'Escape')     closeLb();
        if (e.key === 'ArrowLeft')  openLb(current - 1);
        if (e.key === 'ArrowRight') openLb(current + 1);
    });
<<<<<<< HEAD

=======
>>>>>>> origin/master
    let touchStartX = 0;
    lb.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].clientX; }, { passive: true });
    lb.addEventListener('touchend',   e => {
        const dx = e.changedTouches[0].clientX - touchStartX;
        if (Math.abs(dx) > 50) openLb(dx < 0 ? current + 1 : current - 1);
    });

})();

/* ══════════════════════════════════════════
   TRIP DETAIL — gallery lightbox (vanilla)
   ══════════════════════════════════════════ */
(function () {
    'use strict';

    const style = document.createElement('style');
    style.id    = 'tbg-trip-lb-style';
    style.textContent = `
<<<<<<< HEAD
        .tbg-trip-lb {
            position: fixed; inset: 0; z-index: 9999;
            background: rgba(0,0,0,.92);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transition: opacity 220ms ease;
            pointer-events: none;
        }
        .tbg-trip-lb.is-open { opacity: 1; pointer-events: auto; }
        .tbg-trip-lb__body {
            max-width: 900px; width: 100%;
            padding: 0 4rem; box-sizing: border-box;
            display: flex; flex-direction: column; align-items: center;
        }
        .tbg-trip-lb__img {
            max-width: 100%; max-height: 80vh;
            object-fit: contain; border-radius: 8px;
            opacity: 0; transition: opacity 180ms ease;
        }
        .tbg-trip-lb__img.loaded { opacity: 1; }
        .tbg-trip-lb__counter { color: rgba(255,255,255,.5); font-size: 13px; text-align: center; margin-top: 12px; margin-bottom: 0; }
        .tbg-trip-lb__close {
            position: absolute; top: 16px; right: 16px;
            background: none; border: none; cursor: pointer;
            color: rgba(255,255,255,.7); font-size: 24px; line-height: 1; padding: 8px;
            transition: color 150ms ease;
        }
        .tbg-trip-lb__close:hover { color: #fff; }
        .tbg-trip-lb__nav {
            position: absolute; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: rgba(255,255,255,.7); font-size: 32px; line-height: 1; padding: 12px;
            transition: color 150ms ease;
        }
        .tbg-trip-lb__nav:hover { color: #fff; }
        .tbg-trip-lb__nav--prev { left: 8px; }
        .tbg-trip-lb__nav--next { right: 8px; }
        @media (max-width: 640px) {
            .tbg-trip-lb__body { padding: 0 3rem; }
            .tbg-trip-lb__nav--prev { left: 2px; }
            .tbg-trip-lb__nav--next { right: 2px; }
        }
=======
        .tbg-trip-lb{position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.92);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity 220ms ease;pointer-events:none;}
        .tbg-trip-lb.is-open{opacity:1;pointer-events:auto;}
        .tbg-trip-lb__body{max-width:900px;width:100%;padding:0 4rem;box-sizing:border-box;display:flex;flex-direction:column;align-items:center;}
        .tbg-trip-lb__img{max-width:100%;max-height:80vh;object-fit:contain;border-radius:8px;opacity:0;transition:opacity 180ms ease;}
        .tbg-trip-lb__img.loaded{opacity:1;}
        .tbg-trip-lb__counter{color:rgba(255,255,255,.5);font-size:13px;text-align:center;margin-top:12px;}
        .tbg-trip-lb__close{position:absolute;top:16px;right:16px;background:none;border:none;cursor:pointer;color:rgba(255,255,255,.7);font-size:24px;line-height:1;padding:8px;transition:color 150ms ease;}
        .tbg-trip-lb__close:hover{color:#fff;}
        .tbg-trip-lb__nav{position:absolute;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:rgba(255,255,255,.7);font-size:32px;line-height:1;padding:12px;transition:color 150ms ease;}
        .tbg-trip-lb__nav:hover{color:#fff;}
        .tbg-trip-lb__nav--prev{left:8px;}
        .tbg-trip-lb__nav--next{right:8px;}
        @media(max-width:640px){.tbg-trip-lb__body{padding:0 3rem;}.tbg-trip-lb__nav--prev{left:2px;}.tbg-trip-lb__nav--next{right:2px;}}
>>>>>>> origin/master
    `;
    document.head.appendChild(style);

    const lb = document.createElement('div');
    lb.id        = 'tbg-trip-lb';
    lb.className = 'tbg-trip-lb';
    lb.setAttribute('role', 'dialog');
    lb.setAttribute('aria-modal', 'true');
    lb.setAttribute('aria-label', 'Photo gallery');
    lb.innerHTML = `
        <button class="tbg-trip-lb__close" id="tbg-trip-lb-close" aria-label="Close gallery"><i class="ti ti-x" aria-hidden="true"></i></button>
        <button class="tbg-trip-lb__nav tbg-trip-lb__nav--prev" id="tbg-trip-lb-prev" aria-label="Previous photo"><i class="ti ti-chevron-left" aria-hidden="true"></i></button>
        <div class="tbg-trip-lb__body">
            <img id="tbg-trip-lb-img" src="" alt="" class="tbg-trip-lb__img">
            <p class="tbg-trip-lb__counter" id="tbg-trip-lb-counter"></p>
        </div>
        <button class="tbg-trip-lb__nav tbg-trip-lb__nav--next" id="tbg-trip-lb-next" aria-label="Next photo"><i class="ti ti-chevron-right" aria-hidden="true"></i></button>
    `;
    document.body.appendChild(lb);

    const lbImg     = lb.querySelector('#tbg-trip-lb-img');
    const lbCounter = lb.querySelector('#tbg-trip-lb-counter');
    const lbClose   = lb.querySelector('#tbg-trip-lb-close');
    const lbPrev    = lb.querySelector('#tbg-trip-lb-prev');
    const lbNext    = lb.querySelector('#tbg-trip-lb-next');

    let images = [], current = 0;

    function openLb(index) {
        current = ((index % images.length) + images.length) % images.length;
        lbImg.classList.remove('loaded');
        lbImg.onload = () => lbImg.classList.add('loaded');
        lbImg.src    = images[current];
        lbImg.alt    = `Photo ${current + 1} of ${images.length}`;
        lbCounter.textContent = `${current + 1} / ${images.length}`;
        lbPrev.style.display = images.length > 1 ? '' : 'none';
        lbNext.style.display = images.length > 1 ? '' : 'none';
        lb.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeLb() {
        lb.classList.remove('is-open');
        setTimeout(() => { lbImg.classList.remove('loaded'); lbImg.onload = null; lbImg.src = ''; document.body.style.overflow = ''; }, 220);
    }

    function isOpen() { return lb.classList.contains('is-open'); }

    document.addEventListener('click', function (e) {
        const btn = e.target.closest('[data-trip-img-index]');
        if (!btn) return;
        const wrap = btn.closest('#tbg-trip-gallery');
        if (!wrap) return;
        try { images = JSON.parse(wrap.dataset.images || '[]'); } catch (_) { return; }
        openLb(parseInt(btn.dataset.tripImgIndex, 10));
    });

    lbClose.addEventListener('click', closeLb);
    lbPrev.addEventListener('click', e => { e.stopPropagation(); openLb(current - 1); });
    lbNext.addEventListener('click', e => { e.stopPropagation(); openLb(current + 1); });
    lb.addEventListener('click', e => { if (e.target === lb) closeLb(); });
<<<<<<< HEAD

=======
>>>>>>> origin/master
    document.addEventListener('keydown', e => {
        if (!isOpen()) return;
        if (e.key === 'Escape')     closeLb();
        if (e.key === 'ArrowLeft')  openLb(current - 1);
        if (e.key === 'ArrowRight') openLb(current + 1);
    });
<<<<<<< HEAD

    let touchStartX = 0;
    lb.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].clientX; }, { passive: true });
    lb.addEventListener('touchend',   e => {
        const dx = e.changedTouches[0].clientX - touchStartX;
        if (Math.abs(dx) > 50) openLb(dx < 0 ? current + 1 : current - 1);
    });
=======
    let touchStartX = 0;
    lb.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].clientX; }, { passive: true });
    lb.addEventListener('touchend',   e => { const dx = e.changedTouches[0].clientX - touchStartX; if (Math.abs(dx) > 50) openLb(dx < 0 ? current + 1 : current - 1); });
>>>>>>> origin/master

})();