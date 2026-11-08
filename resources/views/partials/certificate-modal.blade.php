<div id="cert-{{ $index }}" class="modal" role="dialog" aria-modal="true" aria-labelledby="cert-title-{{ $index }}" aria-hidden="true">
    <div class="modal-backdrop" data-modal-close></div>

    <div class="modal-panel modal-panel--cert">
        <button type="button" class="modal-close" data-modal-close aria-label="Close certificate preview">
            <svg viewBox="0 0 20 20" aria-hidden="true"><path d="m5 5 10 10M15 5 5 15" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
        </button>

        <p class="modal-kicker">{{ $cert['category'] }} · {{ $cert['date'] }}</p>
        <h2 id="cert-title-{{ $index }}" class="modal-title">{{ $cert['title'] }}</h2>
        <p class="modal-lead">{{ $cert['issuer'] }}</p>

        <div class="cert-modal-preview">
            @if (!empty($cert['image']))
                <img src="{{ asset($cert['image']) }}" alt="{{ $cert['title'] }} certificate" class="cert-modal-image">
            @else
                <div class="cert-placeholder cert-placeholder--large" aria-hidden="true">
                    <svg viewBox="0 0 64 64"><rect x="12" y="9" width="40" height="46" rx="4" fill="none" stroke="currentColor" stroke-width="2"/><path d="M21 21h22M21 29h22M21 37h13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="42" cy="45" r="6" fill="none" stroke="currentColor" stroke-width="2"/><path d="m39 50-2 6 5-3 5 3-2-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                    <span>Add a certificate image to <code>public/certificate/</code> and link it in <code>config.php</code>.</span>
                </div>
            @endif
        </div>

        <div class="modal-actions">
            @if (!empty($cert['pdf']))
                <a href="{{ asset($cert['pdf']) }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                    Open PDF
                    <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M7 5h8v8M15 5 5 15" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            @endif

            @if (!empty($cert['verify']))
                <a href="{{ $cert['verify'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline">Verify certificate</a>
            @else
                <span class="modal-note">Verification link not provided.</span>
            @endif
        </div>
    </div>
</div>
