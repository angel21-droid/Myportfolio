@php($basic = $portfolio['basic'])
@php($socials = $basic['socials'])
@php($ojt = $portfolio['experience']['ojt'])
@php($heroChips = collect($ojt['responsibilities'])->merge($basic['intro_focus'])->unique(fn ($item) => strtolower($item))->values())
<section id="home" class="hero section-anchor">
    <div class="container-wide hero-inner">
        <div class="hero-copy">
            <div class="hero-kicker reveal">
                <span class="status-pill">
                    <span class="status-dot status-dot--pulse" aria-hidden="true"></span>
                    {{ $basic['status'] }}
                </span>
                <span class="hero-role">{{ $basic['title'] }}</span>
            </div>

            <h1 class="hero-name reveal reveal-delay-1">
                <span class="hero-name-line">{{ $basic['name'] }}</span>
            </h1>

            <p class="hero-headline reveal reveal-delay-2">{!! $basic['headline_html'] !!}</p>

            <div class="hero-story reveal reveal-delay-2">
                <p>{{ $basic['intro'] }}</p>
            </div>

            <div class="hero-focus-block reveal reveal-delay-3" aria-label="Current focus">
                <span class="hero-focus-label">Current focus</span>
                <ul class="hero-focus">
                    @foreach ($heroChips as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="hero-actions reveal reveal-delay-4">
                <a href="#projects" class="btn btn-primary">
                    Explore My Work
                    <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>

                @if (!empty($basic['resume']))
                    <a href="{{ asset($basic['resume']) }}" class="btn btn-outline" download>
                        <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M10 3v9m0 0 3.5-3.5M10 12 6.5 8.5M4 15.5h12" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Download My Resume
                    </a>
                @else
                    <button type="button" class="btn btn-outline" data-toast="Resume not uploaded yet. Add it in public/resume/ and set the path in config.php.">
                        <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M10 3v9m0 0 3.5-3.5M10 12 6.5 8.5M4 15.5h12" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Download My Resume
                    </button>
                @endif

                @if (!empty($portfolio['github']['url']))
                    <a href="{{ $portfolio['github']['url'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-ghost">
                        <span class="btn-icon" aria-hidden="true">@include('partials.social-icon', ['icon' => 'github'])</span>
                        GitHub
                    </a>
                @endif
            </div>

            <div class="hero-meta reveal reveal-delay-5">
                <div class="hero-socials" aria-label="Social links">
                    @foreach ($socials as $social)
                        @if (!empty($social['url']))
                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="social-pill" aria-label="{{ $social['label'] }}">
                                @include('partials.social-icon', ['icon' => $social['icon']])
                                <span>{{ $social['label'] }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>

                <span class="hero-location">
                    <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M10 17s5-4.4 5-8.5A5 5 0 0 0 5 8.5C5 12.6 10 17 10 17Z" fill="none" stroke="currentColor" stroke-width="1.5"/><circle cx="10" cy="8.5" r="1.8" fill="currentColor"/></svg>
                    {{ $basic['location'] }}
                </span>
            </div>
        </div>

        <div class="hero-visual reveal reveal-delay-1" aria-hidden="false">
            <div class="portrait-shell">
                <span class="portrait-accent portrait-accent--ring"></span>
                <span class="portrait-accent portrait-accent--block"></span>

                <figure class="portrait-card">
                    <img src="{{ asset($basic['profile_pic']) }}"
                         alt="Portrait of {{ $basic['name'] }}"
                         class="portrait-img"
                         loading="eager"
                         onerror="this.style.display='none'; document.getElementById('hero-portrait-fallback').hidden = false;">
                    <span id="hero-portrait-fallback" class="portrait-fallback" hidden>{{ $basic['initials'] }}</span>
                </figure>

                <div class="portrait-note portrait-note--ojt">
                    <span class="portrait-note-label">On-the-Job Training</span>
                    <strong>{{ $ojt['organization'] }}</strong>
                    <span>{{ $ojt['position'] }}</span>
                </div>

                <div class="portrait-note portrait-note--availability">
                    <span class="status-dot status-dot--pulse" aria-hidden="true"></span>
                    <span>Open to learning &amp; opportunities</span>
                </div>
            </div>
        </div>
    </div>
</section>
