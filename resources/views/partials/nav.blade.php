@php($basic = $portfolio['basic'])
<header id="site-header" class="site-header">
    <nav class="nav-shell" aria-label="Main navigation">
        <a href="#home" class="brand" aria-label="{{ $basic['name'] }} — home">
            <span class="brand-name">ANGEL<span class="brand-dot">.</span></span>
            <span class="brand-sub">Portfolio</span>
        </a>

        <ul id="nav-links" class="nav-links">
            <li><a href="#home" class="nav-link">Home</a></li>
            <li><a href="#about" class="nav-link">About</a></li>
            <li><a href="#skills" class="nav-link">Skills</a></li>
            <li><a href="#projects" class="nav-link">Projects</a></li>
            <li><a href="#certificates" class="nav-link">Certificates</a></li>
            <li><a href="#education" class="nav-link">Education</a></li>
            <li><a href="#experience" class="nav-link">Experience</a></li>
        </ul>

        <div class="nav-actions">
            <button id="theme-toggle" class="theme-toggle" type="button" aria-label="Switch to light theme" aria-pressed="true" title="Switch to light theme">
                <span class="theme-toggle-track" aria-hidden="true">
                    <svg class="theme-icon theme-icon--moon" viewBox="0 0 24 24"><path d="M20 14.4A8.2 8.2 0 0 1 9.6 4a8.4 8.4 0 1 0 10.4 10.4Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
                    <svg class="theme-icon theme-icon--sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4.2" fill="none" stroke="currentColor" stroke-width="1.7"/><path d="M12 2.8v2.4M12 18.8v2.4M2.8 12h2.4M18.8 12h2.4M5.5 5.5l1.7 1.7M16.8 16.8l1.7 1.7M18.5 5.5l-1.7 1.7M7.2 16.8l-1.7 1.7" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                </span>
            </button>

            <a href="#contact" class="nav-cta" data-nav-cta>
                Contact Me
                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>

            <button id="nav-toggle" class="nav-toggle" aria-label="Toggle navigation" aria-controls="mobile-menu" aria-expanded="false">
                <span class="nav-toggle-bars" aria-hidden="true"><i></i><i></i></span>
            </button>
        </div>
    </nav>

    <div id="mobile-menu" class="mobile-menu" aria-hidden="true">
        <ul>
            <li><a href="#home" class="mobile-link">Home</a></li>
            <li><a href="#about" class="mobile-link">About</a></li>
            <li><a href="#skills" class="mobile-link">Skills</a></li>
            <li><a href="#projects" class="mobile-link">Projects</a></li>
            <li><a href="#certificates" class="mobile-link">Certificates</a></li>
            <li><a href="#education" class="mobile-link">Education</a></li>
            <li><a href="#experience" class="mobile-link">Experience</a></li>
        </ul>
        <a href="#contact" class="mobile-cta mobile-link">Contact Me</a>
    </div>
</header>
