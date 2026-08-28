<section id="github" class="py-20 scroll-mt-28">
    <div class="gothic-section-head reveal">
        <span class="gothic-hand text-3xl">☆</span>
        <h2 class="gothic-heading">GitHub</h2>
        <span class="gothic-divider"><i></i><span>♥</span><i></i></span>
    </div>

    <div class="max-w-4xl mx-auto px-6 lg:px-8">
        <div class="gothic-card reveal gothic-github-card">
            <p class="gothic-text mb-8 max-w-xl mx-auto">
                Find my projects and repositories on GitHub. Every link opens safely in a new tab.
            </p>

            {{-- Prominent profile button --}}
            <a href="{{ $portfolio['github']['url'] }}" target="_blank" rel="noopener noreferrer"
               class="gothic-btn-github mb-8">
                <span class="gothic-github-icon">≋</span> {{ '@'.$portfolio['github']['username'] }} on GitHub
            </a>

            <div class="gothic-divider mb-8"><i></i><span>✧</span><i></i></div>

            {{-- Featured repository link --}}
            <h3 class="gothic-heading text-2xl mb-6">Featured Repository</h3>
            <div class="grid gap-4 justify-items-center">
                @foreach ($portfolio['github']['links'] as $label => $url)
                    @if ($url !== $portfolio['github']['url'])
                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                           class="gothic-btn-ghost">
                            ★ {{ $label }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
