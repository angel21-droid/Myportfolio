<section id="education" class="py-20 scroll-mt-28">
    {{-- decorative separator --}}
    <div class="gothic-section-head reveal">
        <span class="gothic-hand text-3xl">❦</span>
        <h2 class="gothic-heading">Educational Background</h2>
        <span class="gothic-divider"><i></i><span>♥</span><i></i></span>
    </div>

    <div class="max-w-4xl mx-auto px-6 lg:px-8">
        <div class="edu-track reveal">
            @foreach ($portfolio['education'] as $edu)
                <div class="edu-node">
                    <div class="edu-box">
                        <article class="gothic-card gothic-edu-card">
                            <div class="gothic-edu-level">{{ $edu['level'] }}</div>
                            <h3 class="gothic-edu-school">{{ $edu['school'] }}</h3>
                            <p class="gothic-edu-location">✧ {{ $edu['location'] }}</p>
                            <p class="gothic-edu-years">♡ {{ $edu['years'] }}</p>
                            @if (!empty($edu['degree']))
                                <p class="gothic-edu-degree">{{ $edu['degree'] }}</p>
                            @endif
                        </article>
                    </div>
                    <div class="edu-dot" aria-hidden="true">✧</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
