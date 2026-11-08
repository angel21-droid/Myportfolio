@php($education = $portfolio['education'])
<section id="education" class="section-pad education-section section-anchor">
    <div class="container-wide">
        <header class="section-head section-head--split reveal">
            <div>
                <span class="section-index">05 / Journey</span>
                <h2 class="section-title">Education</h2>
            </div>
            <p class="section-lead">My academic path, from secondary education to my current BSIT journey.</p>
        </header>

        <div class="edu-timeline">
            @foreach ($education as $item)
                <article class="edu-item reveal" style="--reveal-delay: {{ $loop->index * 80 }}ms">
                    <div class="edu-rail" aria-hidden="true">
                        <span class="edu-dot"></span>
                        <span class="edu-line"></span>
                    </div>

                    <div class="edu-year">
                        <span class="edu-range">{{ $item['years'] }}</span>
                        <span class="edu-status">{{ $item['status'] }}</span>
                    </div>

                    <div class="edu-card">
                        <span class="edu-level">{{ $item['level'] }} Education</span>
                        <h3 class="edu-school">{{ $item['school'] }}</h3>
                        <p class="edu-program">{{ $item['program'] }}</p>
                        <p class="edu-location">
                            <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M10 17s5-4.4 5-8.5A5 5 0 0 0 5 8.5C5 12.6 10 17 10 17Z" fill="none" stroke="currentColor" stroke-width="1.5"/><circle cx="10" cy="8.5" r="1.8" fill="currentColor"/></svg>
                            {{ $item['location'] }}
                        </p>
                    </div>

                    <div class="edu-index" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                </article>
            @endforeach
        </div>
    </div>
</section>
