@php($basic = $portfolio['basic'])
@php($socials = $basic['socials'])
<footer class="site-footer">
    <div class="container-wide">
        <div class="footer-top">
            <div class="footer-brand">
                <a href="#home" class="brand brand--footer" aria-label="{{ $basic['name'] }} — home">
                    <span class="brand-name">ANGEL<span class="brand-dot">.</span></span>
                </a>
                <p class="footer-tagline">{{ $basic['tagline'] }}</p>

                <div class="footer-socials" aria-label="Social links">
                    @foreach ($socials as $social)
                        @if (!empty($social['url']))
                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="footer-social" aria-label="{{ $social['label'] }}">
                                @include('partials.social-icon', ['icon' => $social['icon']])
                            </a>
                        @endif
                    @endforeach
                    <a href="mailto:{{ $basic['email'] }}" class="footer-social" aria-label="Email {{ $basic['name'] }}">
                        <svg viewBox="0 0 24 24"><path d="M3 8l7.9 5.3a2 2 0 0 0 2.2 0L21 8M5 19h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
            </div>

            <nav class="footer-nav" aria-label="Footer navigation">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#skills">Skills</a>
                <a href="#projects">Projects</a>
                <a href="#certificates">Certificates</a>
                <a href="#education">Education</a>
                <a href="#experience">Experience</a>
                <a href="#contact">Contact</a>
            </nav>

            <div class="footer-contact">
                <span class="footer-label">Get in touch</span>
                <a href="mailto:{{ $basic['email'] }}" class="footer-email">{{ $basic['email'] }}</a>
                <span class="footer-location">{{ $basic['location'] }}</span>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ $basic['name'] }}. All rights reserved.</p>
            <a href="#home" class="back-to-top">
                Back to top
                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M10 16V5m0 0L5.5 9.5M10 5l4.5 4.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>
    </div>
</footer>
