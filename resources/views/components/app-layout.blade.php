<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A cute gothic anime-inspired portfolio of a BSIT student.">

    <title>{{ $portfolio['basic']['name'] }} — Portfolio</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="gothic-body antialiased">

    {{-- Decorative floating background elements --}}
    <div class="gothic-ambiance" aria-hidden="true">
        <span class="float-orb orb-1"></span>
        <span class="float-orb orb-2"></span>
        <span class="float-orb orb-3"></span>
    </div>

    @include('partials.nav', ['portfolio' => $portfolio])

    <main id="top">
        @include('partials.hero', ['portfolio' => $portfolio])
        @include('partials.about', ['portfolio' => $portfolio])
        @include('partials.education', ['portfolio' => $portfolio])
        @include('partials.projects', ['portfolio' => $portfolio])
        @include('partials.github', ['portfolio' => $portfolio])
    </main>

    @include('partials.footer', ['portfolio' => $portfolio])

</body>
</html>
