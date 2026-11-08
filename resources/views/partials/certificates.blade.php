@php($certificates = $portfolio['certificates'])
@php($categories = collect($certificates)->pluck('category')->filter()->unique()->values())
<section id="certificates" class="section-pad certificates-section section-anchor">
    <div class="container-wide">
        <header class="section-head section-head--split reveal">
            <div>
                <span class="section-index">04 / Credentials</span>
                <h2 class="section-title">Certificates &amp; <em>Achievements</em></h2>
            </div>
            <p class="section-lead">Actual certificates shown newest first. Open any credential to view the full preview or PDF.</p>
        </header>

        <div class="cert-toolbar reveal">
            <div class="filter-bar" role="group" aria-label="Filter certificates by category">
                <button type="button" class="filter-btn is-active" data-filter="all" aria-pressed="true">All</button>
                @foreach ($categories as $category)
                    <button type="button" class="filter-btn" data-filter="{{ \Illuminate\Support\Str::slug($category) }}" aria-pressed="false">{{ $category }}</button>
                @endforeach
            </div>
            <span class="filter-count"><span data-cert-count>{{ count($certificates) }}</span> credentials</span>
        </div>

        <div class="cert-grid">
            @foreach ($certificates as $cert)
                <article class="cert-card reveal" data-cert-card data-category="{{ \Illuminate\Support\Str::slug($cert['category']) }}" style="--reveal-delay: {{ $loop->index * 60 }}ms">
                    <button type="button" class="cert-preview" data-modal-open="cert-{{ $loop->index }}" aria-label="Preview {{ $cert['title'] }}">
                        @if (!empty($cert['image']))
                            <img src="{{ asset($cert['image']) }}" alt="{{ $cert['title'] }} certificate preview" class="cert-image" loading="lazy">
                        @else
                            <span class="cert-placeholder" aria-hidden="true">
                                <svg viewBox="0 0 64 64"><rect x="12" y="9" width="40" height="46" rx="4" fill="none" stroke="currentColor" stroke-width="2"/><path d="M21 21h22M21 29h22M21 37h13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="42" cy="45" r="6" fill="none" stroke="currentColor" stroke-width="2"/><path d="m39 50-2 6 5-3 5 3-2-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                                <span>Preview coming soon</span>
                            </span>
                        @endif
                        <span class="cert-category">{{ $cert['category'] }}</span>
                        <span class="cert-zoom" aria-hidden="true">
                            <svg viewBox="0 0 20 20"><circle cx="9" cy="9" r="5.5" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M13.2 13.2 17 17M9 6.8v4.4M6.8 9h4.4" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                        </span>
                    </button>

                    <div class="cert-body">
                        <p class="cert-date">{{ $cert['date'] }}</p>
                        <h3 class="cert-title">{{ $cert['title'] }}</h3>
                        <p class="cert-issuer">{{ $cert['issuer'] }}</p>

                        <div class="cert-actions">
                            <button type="button" class="btn btn-outline cert-open" data-modal-open="cert-{{ $loop->index }}">View certificate</button>
                            @if (!empty($cert['pdf']))
                                <a href="{{ asset($cert['pdf']) }}" target="_blank" rel="noopener noreferrer" class="cert-pdf">
                                    Open PDF
                                    <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M7 5h8v8M15 5 5 15" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </article>

                @include('partials.certificate-modal', ['cert' => $cert, 'index' => $loop->index])
            @endforeach
        </div>

        <p class="cert-empty" data-cert-empty hidden>No certificates in this category yet.</p>
    </div>
</section>
