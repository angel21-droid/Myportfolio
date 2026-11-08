@php($basic = $portfolio['basic'])
@php($about = $portfolio['about'])
<section id="about" class="section-pad section-anchor">
    <div class="container-wide">
        <header class="section-head section-head--split reveal">
            <div>
                <span class="section-index">01 / Profile</span>
                <h2 class="section-title">About</h2>
            </div>
            <p class="section-lead">{{ $about['headline'] }}</p>
        </header>

        <div class="about-grid">
            <article class="about-story-card reveal">
                <span class="mini-heading">Personal story</span>
                <div class="about-story">
                    @foreach ($about['paragraphs'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>

                <div class="about-block">
                    <span class="mini-heading">Interests</span>
                    <ul class="tag-row" aria-label="Interests">
                        @foreach ($about['interests'] as $interest)
                            <li class="tag">{{ $interest }}</li>
                        @endforeach
                    </ul>
                </div>

                <blockquote class="about-goal">
                    <span class="quote-mark" aria-hidden="true">&ldquo;</span>
                    <p>{{ $about['goals'] }}</p>
                    <footer>Goal</footer>
                </blockquote>
            </article>

            <aside class="about-aside reveal reveal-delay-1">
                <div class="info-card">
                    <span class="mini-heading">Contact information</span>
                    <dl class="info-list">
                        <div>
                            <dt>Name</dt>
                            <dd>{{ $basic['name'] }}</dd>
                        </div>
                        <div>
                            <dt>Course</dt>
                            <dd>{{ $basic['course'] }}</dd>
                        </div>
                        <div>
                            <dt>Email</dt>
                            <dd><a href="mailto:{{ $basic['email'] }}">{{ $basic['email'] }}</a></dd>
                        </div>
                        <div>
                            <dt>Phone</dt>
                            <dd><a href="tel:{{ $basic['phone'] }}">{{ $basic['phone'] }}</a></dd>
                        </div>
                        <div>
                            <dt>Location</dt>
                            <dd>{{ $basic['location'] }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="info-card info-card--soft">
                    <span class="mini-heading">Background</span>
                    <div class="background-stack">
                        @foreach ($about['background'] as $item)
                            <div class="background-row">
                                <span class="background-label">{{ $item['label'] }}</span>
                                <span class="background-value">{{ $item['value'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
