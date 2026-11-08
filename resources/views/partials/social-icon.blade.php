@php($icon = $icon ?? 'link')
@if ($icon === 'github')
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3a9 9 0 0 0-2.8 17.5c.4.1.6-.2.6-.5v-1.8c-2.5.5-3-1.1-3-1.1-.4-1-1-1.3-1-1.3-.8-.6.1-.6.1-.6.9.1 1.4.9 1.4.9.8 1.4 2.1 1 2.6.8.1-.6.3-1 .6-1.2-2-.2-4.1-1-4.1-4.5 0-1 .4-1.8 1-2.4-.1-.3-.4-1.3.1-2.7 0 0 .8-.3 2.6 1a9 9 0 0 1 4.8 0c1.8-1.3 2.6-1 2.6-1 .5 1.4.2 2.4.1 2.7.6.6 1 1.4 1 2.4 0 3.5-2.1 4.3-4.1 4.5.3.3.6.8.6 1.7v2.5c0 .3.2.6.6.5A9 9 0 0 0 12 3Z" fill="currentColor"/></svg>
@elseif ($icon === 'facebook')
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14.5 8.5h2.2V5.6h-2.5c-2.3 0-3.8 1.4-3.8 3.9v1.6H8.2v3h2.2V21h3.2v-6.9h2.4l.4-3h-2.8V9.7c0-.9.4-1.2 1-1.2Z" fill="currentColor"/></svg>
@elseif ($icon === 'mail')
    <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="5.5" width="17" height="13" rx="2.4" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="m4.5 7 7.5 6 7.5-6" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
@else
    <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M12 8v8M8 12h8" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
@endif
