// Gothic anime portfolio interactions

document.addEventListener('DOMContentLoaded', () => {
    // Mobile nav toggle
    const toggle = document.getElementById('nav-toggle');
    const menu = document.getElementById('mobile-menu');

    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            const isHidden = menu.classList.contains('hidden');
            menu.classList.toggle('hidden');
            toggle.setAttribute('aria-expanded', String(isHidden));
        });

        menu.querySelectorAll('.mobile-link').forEach((link) => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    // Smooth scrolling for in-page anchor links (fixed-header aware via scroll-margin)
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', (e) => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Scroll-reveal animations
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.14 }
    );
    document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));

    // Active section highlighting in the nav
    const sections = ['home', 'about', 'education', 'projects', 'github']
        .map((id) => document.getElementById(id))
        .filter(Boolean);
    const navAnchors = Array.from(
        document.querySelectorAll('#nav-links a, #mobile-menu a')
    ).filter((a) => a.getAttribute('href') && a.getAttribute('href').startsWith('#') && !a.classList.contains('gothic-btn-primary'));

    const activeObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const id = entry.target.id;
                    navAnchors.forEach((a) => {
                        a.classList.toggle('nav-active', a.getAttribute('href') === '#' + id);
                    });
                }
            });
        },
        { rootMargin: '-45% 0px -50% 0px', threshold: 0 }
    );
    sections.forEach((s) => activeObserver.observe(s));
});
