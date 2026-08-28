<header class="fixed top-0 inset-x-0 z-50">
    <nav class="max-w-5xl mx-auto mt-4 mx-4 lg:mx-auto flex items-center justify-between px-5 py-3 rounded-2xl gothic-glass" aria-label="Main navigation">
        <a href="#home" class="gothic-logo">
            <span class="logo-heart">♥</span>
            <span>{{ $portfolio['basic']['name'] }}</span>
        </a>

        <ul id="nav-links" class="hidden md:flex items-center gap-6 gothic-nav">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#education">Education</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#about" class="gothic-btn-primary">Contact</a></li>        </ul>

        <button id="nav-toggle" class="md:hidden gothic-icon-btn" aria-label="Toggle navigation" aria-expanded="false">
            <span class="gothic-hand">☾</span>
        </button>
    </nav>

    {{-- Mobile menu --}}
    <ul id="mobile-menu" class="md:hidden hidden mx-4 mt-2 rounded-2xl gothic-glass gothic-nav p-4 space-y-3">
        <li><a href="#home" class="mobile-link block">Home</a></li>
        <li><a href="#about" class="mobile-link block">About</a></li>
        <li><a href="#education" class="mobile-link block">Education</a></li>
        <li><a href="#projects" class="mobile-link block">Projects</a></li>
        <li><a href="#about" class="gothic-btn-primary mobile-link block text-center">Contact</a></li>
    </ul>
</header>
