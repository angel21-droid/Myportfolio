@php($cover = $project['images'][0] ?? null)
<div id="project-{{ $index }}" class="modal" role="dialog" aria-modal="true" aria-labelledby="project-title-{{ $index }}" aria-hidden="true">
    <div class="modal-backdrop" data-modal-close></div>

    <div class="modal-panel modal-panel--wide project-modal">
        <button type="button" class="modal-close" data-modal-close aria-label="Close project details">
            <svg viewBox="0 0 20 20" aria-hidden="true"><path d="m5 5 10 10M15 5 5 15" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
        </button>

        <p class="modal-kicker">{{ $project['category'] }}</p>
        <h2 id="project-title-{{ $index }}" class="modal-title">{{ $project['name'] }}</h2>
        <p class="modal-lead">{{ $project['description'] }}</p>

        @if ($cover)
            <div class="project-gallery" data-gallery>
                <figure class="gallery-stage">
                    <img src="{{ asset($cover) }}"
                         alt="{{ $project['name'] }} — screenshot 1"
                         class="gallery-main"
                         data-gallery-main>
                </figure>

                @if (count($project['images']) > 1)
                    <div class="gallery-thumbs" role="group" aria-label="Project screenshots">
                        @foreach ($project['images'] as $image)
                            <button type="button"
                                    class="gallery-thumb {{ $loop->first ? 'is-active' : '' }}"
                                    data-gallery-thumb
                                    data-src="{{ asset($image) }}"
                                    data-alt="{{ $project['name'] }} — screenshot {{ $loop->iteration }}"
                                    aria-label="View screenshot {{ $loop->iteration }}">
                                <img src="{{ asset($image) }}" alt="" loading="lazy">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

        <div class="project-modal-meta">
            @if (!empty($project['role']))
                <div class="modal-block">
                    <h3>My role</h3>
                    <p>{{ $project['role'] }}</p>
                </div>
            @endif

            @if (!empty($project['technologies']))
                <div class="modal-block">
                    <h3>Built with</h3>
                    <ul class="tag-row tag-row--tight">
                        @foreach ($project['technologies'] as $tech)
                            <li class="tag">{{ $tech }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="modal-actions">
            @if (!empty($project['live']))
                <a href="{{ $project['live'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                    Open live demo
                    <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M7 5h8v8M15 5 5 15" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            @endif

            @if (!empty($project['github']))
                <a href="{{ $project['github'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline">
                    <span class="btn-icon">@include('partials.social-icon', ['icon' => 'github'])</span>
                    View repository
                </a>
            @endif

            @if (empty($project['live']) && empty($project['github']))
                <span class="modal-note">Source and demo links are not available for this project.</span>
            @endif
        </div>
    </div>
</div>
