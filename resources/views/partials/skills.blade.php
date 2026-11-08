@php($skills = $portfolio['skills'])
<section id="skills" class="section-pad section-anchor">
    <div class="container-wide">
        <header class="section-head section-head--split reveal">
            <div>
                <span class="section-index">02 / Toolkit</span>
                <h2 class="section-title">Skills &amp; <em>Technologies</em></h2>
            </div>
            <p class="section-lead">The skills and tools I use to learn, design, and build projects. No invented skill levels — just the areas I actively work with.</p>
        </header>

        <div class="skills-grid">
            @foreach ($skills as $group)
                <article class="skill-card reveal" style="--reveal-delay: {{ $loop->index * 70 }}ms">
                    <header class="skill-card-head">
                        <span class="skill-icon" aria-hidden="true">
                            @if ($group['icon'] === 'pen')
                                <svg viewBox="0 0 24 24"><path d="m4 20 4.5-1 10-10a2.1 2.1 0 0 0-3-3l-10 10L4 20Z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="m13.5 7.5 3 3" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
                            @elseif ($group['icon'] === 'code')
                                <svg viewBox="0 0 24 24"><path d="m8 7-4 5 4 5M16 7l4 5-4 5M13.5 5l-3 14" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            @elseif ($group['icon'] === 'tools')
                                <svg viewBox="0 0 24 24"><path d="m14.5 5.5 4 4m-9.9 2.4 5.4-5.4a3 3 0 0 1 4.2 4.2l-5.4 5.4m-4.2-4.2L5 15.3a2.4 2.4 0 0 0 3.4 3.4l3.6-3.6m-4.2-4.2 4.2 4.2" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            @else
                                <svg viewBox="0 0 24 24"><path d="M12 3.5 13.8 9l5.7 1.8-5.7 1.8L12 18.3l-1.8-5.7L4.5 10.8 10.2 9 12 3.5Z" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M18.5 15.5 19.3 18l2.5.8-2.5.8-.8 2.4-.8-2.4-2.4-.8 2.4-.8.8-2.5Z" fill="currentColor" opacity=".55"/></svg>
                            @endif
                        </span>
                        <div>
                            <p class="skill-num" aria-hidden="true">{{ $group['number'] }}</p>
                            <h3 class="skill-title">{{ $group['title'] }}</h3>
                        </div>
                    </header>

                    <p class="skill-summary">{{ $group['summary'] }}</p>

                    @if ($group['layout'] === 'tools')
                        <ul class="tool-grid">
                            @foreach ($group['items'] as $item)
                                <li class="tool-chip">
                                    <span class="tool-mark" aria-hidden="true">{{ $item['mark'] }}</span>
                                    <span class="tool-name">{{ $item['name'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <ul class="tag-row skill-tags">
                            @foreach ($group['items'] as $item)
                                <li class="tag">{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>
