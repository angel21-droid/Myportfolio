<section id="projects" class="py-20 scroll-mt-28">
    <div class="gothic-section-head reveal">
        <span class="gothic-hand text-3xl">⚜</span>
        <h2 class="gothic-heading">My Projects</h2>
        <span class="gothic-divider"><i></i><span>♥</span><i></i></span>
    </div>

    <div class="max-w-6xl mx-auto px-6 lg:px-8">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($portfolio['projects'] as $project)
                <article class="gothic-card reveal gothic-project-card">
                    <div class="flex items-start justify-between mb-3">
                        <span class="gothic-hand text-2xl gothic-accent">⚜</span>
                        <span class="gothic-mini-badge">project</span>
                    </div>

                    <h3 class="gothic-project-name">{{ $project['name'] }}</h3>

                    @if (!empty($project['technology']))
                        <p class="gothic-tech">
                            <span class="gothic-chip-icon">⚙</span> {{ $project['technology'] }}
                        </p>
                    @endif

                    <p class="gothic-text text-sm mb-5">{{ $project['description'] }}</p>

                    <a href="{{ $project['github'] }}" target="_blank" rel="noopener noreferrer"
                       class="gothic-btn-github w-full">
                        <span class="gothic-github-icon">≋</span> View Repository ★
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>
