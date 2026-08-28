<section id="home" class="relative min-h-screen flex items-center pt-32 pb-20">
    <div class="max-w-6xl mx-auto px-6 lg:px-8 w-full">
        {{-- Floating decorative sparkles / hearts around hero --}}
        <div class="hero-sparkles" aria-hidden="true">
            <span class="hero-sparkle-item" style="top:-40px; left:8%; font-size:1.4rem;">✧</span>
            <span class="hero-heart-float" style="top:15px; right:6%; font-size:1.6rem;">♡</span>
            <span class="hero-sparkle-item" style="bottom:20%; left:-14px; font-size:1.2rem;">✦</span>
            <span class="hero-heart-float" style="bottom:8%; right:10%; font-size:1.3rem;">♥</span>
            <span class="hero-sparkle-item" style="top:30%; left:46%; font-size:1rem;">✧</span>
        </div>

        <div class="gothic-card reveal gothic-card-hero grid lg:grid-cols-2 gap-10 items-center p-8 lg:p-14">
            {{-- Text side --}}
            <div class="order-2 lg:order-1 text-center lg:text-left relative z-10">
                <p class="gothic-eyebrow mb-4"><span class="gothic-card-ribbon">♡</span> Welcome to my little corner of the internet</p>

                <h1 class="gothic-title mb-3">
                    {{ $portfolio['basic']['name'] }}
                    <span class="inline-block animate-float" aria-hidden="true">🖤</span>
                </h1>

                <p class="gothic-role-badge inline-flex mb-6">
                    <span class="badge-heart">♥</span> {{ $portfolio['basic']['course'] }}
                </p>

                <p class="gothic-text mb-8 max-w-md mx-auto lg:mx-0 text-lg">
                    "{{ $portfolio['basic']['bio'] }}"
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="#projects" class="gothic-btn-primary">
                        ✦ View My Projects
                    </a>
                    <a href="#about" class="gothic-btn-ghost">
                        About Me ♡
                    </a>
                </div>
            </div>

            {{-- Photo side --}}
            <div class="order-1 lg:order-2 flex justify-center">
                <div class="gothic-portrait">
                    <div class="gothic-portrait-frame">
                        <img src="{{ asset($portfolio['basic']['profile_pic']) }}"
                             alt="Angel Bio profile picture"
                             class="w-full h-full object-cover object-top"
                             loading="lazy"
                             onerror="this.style.display='none'; document.getElementById('portrait-fallback').style.display='flex';">
                        <div id="portrait-fallback" class="gothic-portrait-fallback hidden">
                            <span class="gothic-hand">♡</span>
                        </div>
                    </div>
                    <div class="gothic-portrait-ribbon" aria-hidden="true"></div>
                </div>
            </div>
        </div>
    </div>
</section>
