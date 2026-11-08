<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $portfolio['basic']['name'] }} — {{ $portfolio['basic']['title'] }}. Portfolio of projects, skills, certificates, education, and experience.">
    <meta name="theme-color" content="#12142C">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <title>{{ $portfolio['basic']['name'] }} — {{ $portfolio['basic']['title'] }}</title>

    <script>
        // Resolve the theme before first paint: saved choice wins, otherwise the
        // visitor's system preference is honoured, with dark as the fallback.
        (function () {
            var key = 'portfolio-theme';
            var stored = null;
            try { stored = window.localStorage.getItem(key); } catch (error) {}

            var theme = stored;

            if (theme !== 'light' && theme !== 'dark') {
                theme = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches
                    ? 'light'
                    : 'dark';
            }

            document.documentElement.dataset.theme = theme;
            document.documentElement.style.colorScheme = theme;

            var meta = document.querySelector('meta[name="theme-color"]');

            if (meta) {
                meta.setAttribute('content', theme === 'dark' ? '#12142C' : '#FAF9FF');
            }
        })();
    </script>
    <script>document.documentElement.classList.add('js');</script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fonts
</head>
<body class="site-body antialiased">
    <a href="#home" class="skip-link">Skip to content</a>

    <div class="page-texture" aria-hidden="true"></div>
    <div id="cursor-glow" class="cursor-glow" aria-hidden="true"></div>
    <div id="scroll-progress" class="scroll-progress" aria-hidden="true"></div>

    @include('partials.nav', ['portfolio' => $portfolio])

    <main id="top">
        @include('partials.hero', ['portfolio' => $portfolio])

        <div class="section-divider" aria-hidden="true"></div>
        @include('partials.about', ['portfolio' => $portfolio])

        <div class="section-divider" aria-hidden="true"></div>
        @include('partials.skills', ['portfolio' => $portfolio])

        <div class="section-divider" aria-hidden="true"></div>
        @include('partials.projects', ['portfolio' => $portfolio])

        <div class="section-divider" aria-hidden="true"></div>
        @include('partials.certificates', ['portfolio' => $portfolio])

        <div class="section-divider" aria-hidden="true"></div>
        @include('partials.education', ['portfolio' => $portfolio])

        <div class="section-divider" aria-hidden="true"></div>
        @include('partials.experience', ['portfolio' => $portfolio])

        <div class="section-divider" aria-hidden="true"></div>
        @include('partials.contact', ['portfolio' => $portfolio])
    </main>

    @include('partials.footer', ['portfolio' => $portfolio])

    <div id="toast-stack" class="toast-stack" aria-live="polite" aria-atomic="false"></div>
</body>
</html>
