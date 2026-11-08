@php($basic = $portfolio['basic'])
@php($contact = $portfolio['contact'])
@php($socials = $basic['socials'])
<section id="contact" class="section-pad contact-section section-anchor">
    <div class="contact-glow contact-glow--one" aria-hidden="true"></div>
    <div class="contact-glow contact-glow--two" aria-hidden="true"></div>

    <div class="container-wide contact-layout">
        <div class="contact-intro reveal">
            <span class="section-index section-index--light">07 / Contact</span>
            <h2 class="contact-title">{!! $contact['heading_html'] !!}</h2>
            <p class="contact-lead">{{ $contact['message'] }}</p>

            <div class="contact-direct">
                <a href="mailto:{{ $basic['email'] }}" class="contact-email">
                    {{ $basic['email'] }}
                    <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M7 5h8v8M15 5 5 15" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>

                <div class="contact-socials" aria-label="Social links">
                    @foreach ($socials as $social)
                        @if (!empty($social['url']))
                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="contact-social">
                                <span class="contact-social-icon" aria-hidden="true">@include('partials.social-icon', ['icon' => $social['icon']])</span>
                                <span>{{ $social['label'] }}</span>
                                <svg class="contact-social-arrow" viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        @endif
                    @endforeach
                </div>

                <div class="contact-details">
                    <span>{{ $basic['location'] }}</span>
                    <span class="meta-divider" aria-hidden="true"></span>
                    <a href="tel:{{ $basic['phone'] }}">{{ $basic['phone'] }}</a>
                </div>
            </div>
        </div>

        <div class="contact-panel reveal reveal-delay-1">
            <div class="contact-form-head">
                <span class="form-kicker">Send a message</span>
                <span class="form-availability"><span class="status-dot status-dot--pulse" aria-hidden="true"></span> {{ $basic['status'] }}</span>
            </div>

            <form method="POST" action="{{ route('contact.send') }}" class="contact-form" data-contact-form>
                @csrf
                <div class="hp-field" aria-hidden="true">
                    <label for="company">Company</label>
                    <input type="text" id="company" name="company" tabindex="-1" autocomplete="off">
                </div>

                @if (session('contact_status'))
                    <div class="form-success" role="status">
                        <span class="form-success-dot" aria-hidden="true"></span>
                        {{ session('contact_status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="form-alert" role="alert">Please check the highlighted fields and try again.</div>
                @endif

                <div class="form-row">
                    <div class="form-field">
                        <label for="name" class="form-label">Your name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="100"
                               class="form-input @error('name') is-invalid @enderror" placeholder="Your name" autocomplete="name">
                        @error('name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-field">
                        <label for="email" class="form-label">Email address</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="150"
                               class="form-input @error('email') is-invalid @enderror" placeholder="you@example.com" autocomplete="email">
                        @error('email')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="form-field">
                    <label for="subject" class="form-label">Subject <span>optional</span></label>
                    <input id="subject" name="subject" type="text" value="{{ old('subject') }}" maxlength="150"
                           class="form-input @error('subject') is-invalid @enderror" placeholder="What would you like to talk about?">
                    @error('subject')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-field">
                    <label for="message" class="form-label">Message</label>
                    <textarea id="message" name="message" rows="5" required minlength="10" maxlength="3000"
                              class="form-input form-textarea @error('message') is-invalid @enderror"
                              placeholder="Tell me a little about the idea, project, or opportunity.">{{ old('message') }}</textarea>
                    @error('message')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="btn btn-lavender contact-submit">
                    <span data-submit-label>Send message</span>
                    <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>

                <p class="form-hint">Your message goes to {{ $basic['email'] }}.</p>
            </form>
        </div>
    </div>
</section>
