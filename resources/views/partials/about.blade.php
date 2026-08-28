<section id="about" class="py-20 scroll-mt-28">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
        <div class="gothic-section-head reveal">
            <span class="gothic-hand text-3xl">♡</span>
            <h2 class="gothic-heading">About Me</h2>
            <span class="gothic-divider"><i></i><span>♥</span><i></i></span>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="gothic-contact-card reveal">
                <div class="gothic-contact-icon">✉</div>
                <span class="contact-label">Email</span>
                <a href="mailto:{{ $portfolio['basic']['email'] }}" class="contact-value">{{ $portfolio['basic']['email'] }}</a>
            </div>

            <div class="gothic-contact-card reveal">
                <div class="gothic-contact-icon">☎</div>
                <span class="contact-label">Phone</span>
                <a href="tel:{{ $portfolio['basic']['phone'] }}" class="contact-value">{{ $portfolio['basic']['phone'] }}</a>
            </div>

            <div class="gothic-contact-card reveal">
                <div class="gothic-contact-icon">⚑</div>
                <span class="contact-label">Location</span>
                <span class="contact-value">{{ $portfolio['basic']['location'] }}</span>
            </div>

            <div class="gothic-contact-card reveal">
                <div class="gothic-contact-icon">✦</div>
                <span class="contact-label">Course</span>
                <span class="contact-value">{{ $portfolio['basic']['course'] }}</span>
            </div>
        </div>
    </div>
</section>
