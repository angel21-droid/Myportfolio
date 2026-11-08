// Midnight × lavender portfolio interactions.
// Vanilla JS only — no extra dependencies.

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const ready = (callback) => {
    if (document.readyState !== 'loading') {
        callback();
    } else {
        document.addEventListener('DOMContentLoaded', callback);
    }
};

ready(() => {
    const header = document.getElementById('site-header');
    const progress = document.getElementById('scroll-progress');

    /* ------------------------------------------------------------
       Theme switcher (dark default, saved choice, system fallback)
       ------------------------------------------------------------ */
    const root = document.documentElement;
    const themeToggle = document.getElementById('theme-toggle');
    const themeMeta = document.querySelector('meta[name="theme-color"]');
    const themeKey = 'portfolio-theme';
    const systemTheme = window.matchMedia('(prefers-color-scheme: light)');

    const readSavedTheme = () => {
        try {
            return window.localStorage.getItem(themeKey);
        } catch (error) {
            return null;
        }
    };

    const applyTheme = (theme, persist = false) => {
        const next = theme === 'light' ? 'light' : 'dark';
        const isDark = next === 'dark';

        root.dataset.theme = next;
        root.style.colorScheme = next;

        if (persist) {
            try {
                window.localStorage.setItem(themeKey, next);
            } catch (error) {
                // Private mode or blocked storage: the theme still applies for
                // this session, it just will not be remembered.
            }
        }

        if (themeToggle) {
            const label = isDark ? 'Switch to light theme' : 'Switch to dark theme';
            themeToggle.setAttribute('aria-pressed', String(isDark));
            themeToggle.setAttribute('aria-label', label);
            themeToggle.setAttribute('title', label);
        }

        if (themeMeta) {
            themeMeta.setAttribute('content', isDark ? '#12142C' : '#FAF9FF');
        }
    };

    applyTheme(root.dataset.theme);

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            applyTheme(root.dataset.theme === 'dark' ? 'light' : 'dark', true);
        });
    }

    const handleSystemTheme = (event) => {
        if (!readSavedTheme()) {
            applyTheme(event.matches ? 'light' : 'dark');
        }
    };

    if (typeof systemTheme.addEventListener === 'function') {
        systemTheme.addEventListener('change', handleSystemTheme);
    } else if (typeof systemTheme.addListener === 'function') {
        systemTheme.addListener(handleSystemTheme);
    }

    /* ------------------------------------------------------------
       Sticky header, scroll progress, active section
       ------------------------------------------------------------ */
    const navLinks = Array.from(document.querySelectorAll('.nav-link, .mobile-link'));
    const navCtas = Array.from(document.querySelectorAll('[data-nav-cta]'));
    const sections = ['home', 'about', 'skills', 'projects', 'certificates', 'education', 'experience', 'contact']
        .map((id) => document.getElementById(id))
        .filter(Boolean);

    let activeId = null;

    const setActiveSection = (id) => {
        if (id === activeId) return;
        activeId = id;

        navLinks.forEach((link) => {
            const isActive = link.getAttribute('href') === `#${id}`;

            link.classList.toggle('is-active', isActive);

            if (isActive) {
                link.setAttribute('aria-current', 'location');
            } else {
                link.removeAttribute('aria-current');
            }
        });

        navCtas.forEach((cta) => {
            const isActive = id === 'contact';
            cta.classList.toggle('is-active', isActive);

            if (isActive) {
                cta.setAttribute('aria-current', 'location');
            } else {
                cta.removeAttribute('aria-current');
            }
        });
    };

    const updateActiveSection = () => {
        if (!sections.length) return;

        const probe = Math.min(window.innerHeight * 0.36, 260);
        let current = sections[0].id;

        sections.forEach((section) => {
            if (section.getBoundingClientRect().top <= probe) {
                current = section.id;
            }
        });

        const doc = document.documentElement;
        const atBottom = window.innerHeight + window.scrollY >= doc.scrollHeight - 6;

        if (atBottom) {
            current = sections[sections.length - 1].id;
        }

        setActiveSection(current);
    };

    let scrollFrame = null;

    const updateScrollState = () => {
        const y = window.scrollY || window.pageYOffset;

        if (header) {
            header.classList.toggle('is-scrolled', y > 12);
        }

        if (progress) {
            const max = document.documentElement.scrollHeight - window.innerHeight;
            const ratio = max > 0 ? Math.min(y / max, 1) : 0;
            progress.style.width = `${ratio * 100}%`;
        }

        updateActiveSection();
        scrollFrame = null;
    };

    const requestScrollUpdate = () => {
        if (scrollFrame === null) {
            scrollFrame = window.requestAnimationFrame(updateScrollState);
        }
    };

    updateScrollState();
    window.addEventListener('scroll', requestScrollUpdate, { passive: true });
    window.addEventListener('resize', requestScrollUpdate);

    /* ------------------------------------------------------------
       Mobile menu
       ------------------------------------------------------------ */
    const toggle = document.getElementById('nav-toggle');
    const menu = document.getElementById('mobile-menu');

    const setMenu = (open) => {
        if (!toggle || !menu) return;

        menu.classList.toggle('is-open', open);
        toggle.classList.toggle('is-open', open);
        toggle.setAttribute('aria-expanded', String(open));
        toggle.setAttribute('aria-label', open ? 'Close navigation' : 'Open navigation');
        menu.setAttribute('aria-hidden', String(!open));
    };

    const isMenuOpen = () => Boolean(menu && menu.classList.contains('is-open'));

    if (toggle && menu) {
        toggle.addEventListener('click', () => setMenu(!isMenuOpen()));

        menu.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => setMenu(false));
        });

        document.addEventListener('click', (event) => {
            if (!isMenuOpen()) return;
            if (menu.contains(event.target) || toggle.contains(event.target)) return;
            setMenu(false);
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 900) setMenu(false);
        });
    }

    /* ------------------------------------------------------------
       Reveal on scroll
       ------------------------------------------------------------ */
    const revealElements = document.querySelectorAll('.reveal');

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        revealElements.forEach((el) => el.classList.add('is-visible'));
    } else {
        const revealObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                });
            },
            { threshold: 0.08, rootMargin: '0px 0px -4% 0px' }
        );

        revealElements.forEach((el) => revealObserver.observe(el));
    }

    /* ------------------------------------------------------------
       Toasts
       ------------------------------------------------------------ */
    const toastStack = document.getElementById('toast-stack');

    const showToast = (message, variant = 'info') => {
        if (!toastStack || !message) return;

        const toast = document.createElement('div');
        toast.className = `toast toast--${variant}`;
        toast.setAttribute('role', 'status');

        const dot = document.createElement('span');
        dot.className = 'toast-dot';
        dot.setAttribute('aria-hidden', 'true');

        const text = document.createElement('span');
        text.className = 'toast-message';
        text.textContent = message;

        toast.append(dot, text);
        toastStack.appendChild(toast);

        while (toastStack.children.length > 3) {
            toastStack.firstElementChild.remove();
        }

        let removed = false;
        const remove = () => {
            if (removed) return;
            removed = true;
            toast.classList.add('is-leaving');
            toast.addEventListener('animationend', () => toast.remove(), { once: true });
            window.setTimeout(() => toast.remove(), 600);
        };

        toast.addEventListener('click', remove);
        window.setTimeout(remove, 5200);
    };

    document.querySelectorAll('[data-toast]').forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            showToast(trigger.dataset.toast);
        });
    });

    const serverSuccess = document.querySelector('.form-success');
    if (serverSuccess && serverSuccess.textContent.trim()) {
        showToast(serverSuccess.textContent.trim(), 'success');
    }

    /* ------------------------------------------------------------
       Modals (project + certificate)
       ------------------------------------------------------------ */
    let lastFocused = null;

    const resetGallery = (modal) => {
        const gallery = modal.querySelector('[data-gallery]');
        if (!gallery) return;

        const main = gallery.querySelector('[data-gallery-main]');
        const firstThumb = gallery.querySelector('[data-gallery-thumb]');
        if (!main || !firstThumb) return;

        main.src = firstThumb.dataset.src;
        if (firstThumb.dataset.alt) main.alt = firstThumb.dataset.alt;

        gallery.querySelectorAll('[data-gallery-thumb]').forEach((thumb) => {
            thumb.classList.toggle('is-active', thumb === firstThumb);
        });

        gallery.querySelector('.gallery-thumbs')?.scrollTo({ left: 0 });
    };

    const openModal = (id) => {
        const modal = document.getElementById(id);
        if (!modal) return;

        setMenu(false);
        resetGallery(modal);

        lastFocused = document.activeElement;
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');

        const panel = modal.querySelector('.modal-panel');
        if (panel) panel.scrollTop = 0;

        const closeButton = modal.querySelector('.modal-close');
        if (closeButton) {
            window.setTimeout(() => closeButton.focus(), 90);
        }
    };

    const closeModal = (modal) => {
        if (!modal) return;

        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');

        if (!document.querySelector('.modal.is-open')) {
            document.body.classList.remove('modal-open');
        }

        if (lastFocused && typeof lastFocused.focus === 'function') {
            lastFocused.focus();
            lastFocused = null;
        }
    };

    document.addEventListener('click', (event) => {
        const opener = event.target.closest('[data-modal-open]');

        if (opener) {
            event.preventDefault();
            openModal(opener.dataset.modalOpen);
            return;
        }

        const closer = event.target.closest('[data-modal-close]');

        if (closer) {
            event.preventDefault();
            closeModal(closer.closest('.modal'));
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            const openModalEl = document.querySelector('.modal.is-open');

            if (openModalEl) {
                closeModal(openModalEl);
            } else {
                setMenu(false);
            }
            return;
        }

        if (event.key !== 'Tab') return;

        const activeModal = document.querySelector('.modal.is-open');
        if (!activeModal) return;

        const focusable = Array.from(
            activeModal.querySelectorAll(
                'a[href], button:not([disabled]), input:not([disabled]), textarea:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'
            )
        ).filter((el) => el.offsetParent !== null);

        if (!focusable.length) return;

        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    });

    /* ------------------------------------------------------------
       Project screenshot gallery
       ------------------------------------------------------------ */
    document.addEventListener('click', (event) => {
        const thumb = event.target.closest('[data-gallery-thumb]');
        if (!thumb) return;

        const gallery = thumb.closest('[data-gallery]');
        const main = gallery?.querySelector('[data-gallery-main]');
        if (!main) return;

        event.preventDefault();

        main.src = thumb.dataset.src;
        if (thumb.dataset.alt) main.alt = thumb.dataset.alt;

        gallery.querySelectorAll('[data-gallery-thumb]').forEach((item) => {
            item.classList.toggle('is-active', item === thumb);
        });
    });

    /* ------------------------------------------------------------
       Filters (projects + certificates)
       ------------------------------------------------------------ */
    const initFilterGroup = ({ buttons, cards, countEl, emptyEl, allValue }) => {
        if (!buttons.length || !cards.length) return;

        buttons.forEach((button, index) => {
            if (!button.hasAttribute('aria-pressed')) {
                button.setAttribute('aria-pressed', String(index === 0));
            }
        });

        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                const filter = button.dataset.projectFilter ?? button.dataset.filter ?? allValue;
                let visible = 0;

                buttons.forEach((btn) => {
                    const isActive = btn === button;
                    btn.classList.toggle('is-active', isActive);
                    btn.setAttribute('aria-pressed', String(isActive));
                });

                cards.forEach((card) => {
                    const match = filter === allValue || card.dataset.category === filter;
                    card.classList.toggle('is-filtered-out', !match);
                    if (match) {
                        visible += 1;
                        card.classList.add('is-visible');
                    }
                });

                if (countEl) countEl.textContent = String(visible);
                if (emptyEl) emptyEl.hidden = visible > 0;
            });
        });
    };

    initFilterGroup({
        buttons: Array.from(document.querySelectorAll('[data-project-filter]')),
        cards: Array.from(document.querySelectorAll('[data-project-card]')),
        countEl: document.querySelector('[data-project-count]'),
        emptyEl: document.querySelector('[data-project-empty]'),
        allValue: 'all',
    });

    initFilterGroup({
        buttons: Array.from(document.querySelectorAll('[data-filter]')),
        cards: Array.from(document.querySelectorAll('[data-cert-card]')),
        countEl: document.querySelector('[data-cert-count]'),
        emptyEl: document.querySelector('[data-cert-empty]'),
        allValue: 'all',
    });

    /* ------------------------------------------------------------
       Contact form submit state
       ------------------------------------------------------------ */
    document.querySelectorAll('[data-contact-form]').forEach((form) => {
        const button = form.querySelector('button[type="submit"]');
        const label = form.querySelector('[data-submit-label]');

        form.addEventListener('submit', () => {
            if (!form.checkValidity()) return;

            if (button) button.disabled = true;
            if (label) label.textContent = 'Sending…';
        });

        window.addEventListener('pageshow', () => {
            if (button) button.disabled = false;
            if (label) label.textContent = 'Send message';
        });
    });

    /* ------------------------------------------------------------
       Cursor glow (desktop, fine pointers only)
       ------------------------------------------------------------ */
    const glow = document.getElementById('cursor-glow');

    if (glow && window.matchMedia('(pointer: fine)').matches && !prefersReducedMotion) {
        let frame = null;
        let pointerX = window.innerWidth / 2;
        let pointerY = window.innerHeight / 2;

        const paint = () => {
            glow.style.transform = `translate3d(${pointerX}px, ${pointerY}px, 0) translate(-50%, -50%)`;
            frame = null;
        };

        window.addEventListener(
            'pointermove',
            (event) => {
                pointerX = event.clientX;
                pointerY = event.clientY;
                glow.classList.add('is-active');

                if (!frame) frame = window.requestAnimationFrame(paint);
            },
            { passive: true }
        );

        document.addEventListener('mouseleave', () => glow.classList.remove('is-active'));
    }
});
