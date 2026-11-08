@php($projects = $portfolio['projects'])
@php($categories = collect($projects)->pluck('category')->filter()->unique()->values())
<section id="projects" class="section-pad projects-section section-anchor">
    <div class="container-wide">
        <header class="section-head section-head--split reveal">
            <div>
                <span class="section-index section-index--light">03 / Arsenal</span>
                <h2 class="section-title section-title--light">Featured <em>Projects</em></h2>
            </div>
            <p class="section-lead section-lead--light">Selected work from my academic projects and personal builds. Open a project to view its full screenshots and details.</p>
        </header>

        <div class="project-toolbar reveal">
            <div class="filter-bar filter-bar--light" role="group" aria-label="Filter projects by category">
                <button type="button" class="filter-btn is-active" data-project-filter="all" aria-pressed="true">All</button>
                @foreach ($categories as $category)
                    <button type="button" class="filter-btn" data-project-filter="{{ \Illuminate\Support\Str::slug($category) }}" aria-pressed="false">{{ $category }}</button>
                @endforeach
            </div>
            <span class="filter-count filter-count--light"><span data-project-count>{{ count($projects) }}</span> projects</span>
        </div>

        <div class="projects-list">
            @foreach ($projects as $project)
                @php($reverse = $loop->iteration % 2 === 0)
                @php($portrait = ($project['orientation'] ?? 'wide') === 'portrait')
                <article class="project-feature {{ $reverse ? 'project-feature--reverse' : '' }} {{ $portrait ? 'project-feature--portrait' : '' }} reveal"
                         data-project-card
                         data-category="{{ \Illuminate\Support\Str::slug($project['category']) }}">
                    <div class="project-visual">
                        @if ($portrait)
                            <div class="phone-stack" aria-label="{{ $project['name'] }} screenshots">
                                @foreach (array_slice($project['images'], 0, 3) as $image)
                                    <figure class="phone-frame">
                                        <img src="{{ asset($image) }}" alt="{{ $project['name'] }} screen {{ $loop->iteration }}" loading="lazy">
                                    </figure>
                                @endforeach
                            </div>
                        @else
                            <figure class="project-shot">
                                <img src="{{ asset($project['images'][0]) }}" alt="{{ $project['name'] }} preview" loading="lazy">
                                <figcaption>{{ count($project['images']) }} screens</figcaption>
                            </figure>
                            @if (count($project['images']) > 1)
                                <figure class="project-shot-aside" aria-hidden="true">
                                    <img src="{{ asset($project['images'][1]) }}" alt="" loading="lazy">
                                </figure>
                            @endif
                        @endif
                    </div>

                    <div class="project-content">
                        <div class="project-meta">
                            <span class="project-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="project-category">{{ $project['category'] }}</span>
                        </div>

                        <h3 class="project-title">{{ $project['name'] }}</h3>
                        <p class="project-desc">{{ $project['description'] }}</p>

                        @if (!empty($project['technologies']))
                            <ul class="tag-row tag-row--tight project-tech" aria-label="Technologies used">
                                @foreach ($project['technologies'] as $tech)
                                    <li class="tag tag--ghost">{{ $tech }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if (!empty($project['role']))
                            <p class="project-role"><strong>My role:</strong> {{ $project['role'] }}</p>
                        @endif

                        <div class="project-actions">
                            <button type="button" class="btn btn-lavender" data-modal-open="project-{{ $loop->index }}">
                                View project
                                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>

                            @if (!empty($project['live']))
                                <a href="{{ $project['live'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-light">
                                    Live demo
                                    <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M7 5h8v8M15 5 5 15" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            @endif

                            @if (!empty($project['github']))
                                <a href="{{ $project['github'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-text-light">
                                    <span class="btn-icon">@include('partials.social-icon', ['icon' => 'github'])</span>
                                    GitHub
                                </a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <p class="project-empty" data-project-empty hidden>No projects in this category yet.</p>

        <div class="projects-footer reveal">
            <p>More work and experiments on GitHub.</p>
            <a href="{{ $portfolio['github']['url'] }}" target="_blank" rel="noopener noreferrer" class="link-arrow link-arrow--light">
                Visit {{ '@' . $portfolio['github']['username'] }}
                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>
    </div>

    @foreach ($projects as $project)
        @include('partials.project-modal', ['project' => $project, 'index' => $loop->index])
    @endforeach
</section>
