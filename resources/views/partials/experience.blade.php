@php($ojt = $portfolio['experience']['ojt'])
<section id="experience" class="section-pad experience-section section-anchor">
    <div class="container-wide">
        <header class="section-head section-head--split reveal">
            <div>
                <span class="section-index">06 / Practice</span>
                <h2 class="section-title">Experience</h2>
            </div>
            <p class="section-lead">My current On-the-Job Training at the Land Registration Authority (LRA).</p>
        </header>

        <article class="ojt-card ojt-card--solo reveal">
            <div class="ojt-head">
                <span class="exp-kicker">On-the-Job Training</span>
                <span class="exp-badge"><span class="status-dot status-dot--pulse" aria-hidden="true"></span> Current</span>
            </div>

            <h3 class="ojt-org">{{ $ojt['organization'] }}</h3>
            <p class="ojt-position">{{ $ojt['position'] }}</p>
            <p class="ojt-desc">{{ $ojt['description'] }}</p>

            <div class="ojt-meta">
                <div>
                    <span class="exp-label">Duration</span>
                    <span class="exp-value">{{ $ojt['duration'] }}</span>
                </div>
            </div>

            <div class="ojt-responsibilities">
                <span class="exp-label">Responsibilities</span>
                <ul class="responsibility-list">
                    @foreach ($ojt['responsibilities'] as $responsibility)
                        <li>
                            <span class="resp-index" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <span>{{ $responsibility }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <span class="ojt-mark" aria-hidden="true">OJT</span>
        </article>
    </div>
</section>
