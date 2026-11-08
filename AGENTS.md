# Myportfolio

Laravel 13 portfolio app (PHP `^8.3`) at `C:\xampp\htdocs\Myportfolio`. It is a **static site**: one route renders Blade partials whose content comes from `resources/views/partials/config.php`. There is **no database, no migrations, no Eloquent models, no authentication, and no admin panel**.

> `CLAUDE.md` is a leftover Laravel Boost bootstrap stub. Ignore it and do **not** install Boost. This file is the source of truth for agents.

## Runtime: use PHP 8.5 (Herd Lite)

| Location | Version | Status |
| --- | --- | --- |
| `C:\Users\HP\.config\herd-lite\bin\php.exe` | **8.5.0** | ✅ Use this — `php.ini` loaded, required extensions enabled |
| `C:\xampp\php\php.exe` | 8.2.12 | ❌ Too old for Laravel 13 |
| `C:\php\php.exe` | 8.4.27 | ❌ No `php.ini`; missing `openssl`, `mbstring`, `pdo_sqlite`, `curl` |

```powershell
php -v   # must report 8.5.x
```

If `php -v` reports 8.2, prepend Herd Lite for the current shell:

```powershell
$env:PATH = "C:\Users\HP\.config\herd-lite\bin;" + $env:PATH
```

Run Composer with the same PHP explicitly so it never falls back to XAMPP:

```powershell
$php = "C:\Users\HP\.config\herd-lite\bin\php.exe"
& $php "C:\Users\HP\.config\herd-lite\bin\composer.phar" install
```

## Local environment

- `.env` is gitignored and required. It uses `SESSION_DRIVER=file`, `CACHE_STORE=file`, and `QUEUE_CONNECTION=sync` so the app runs without a database.
- If `.env` is missing: `Copy-Item .env.example .env`, then `php artisan key:generate`, then set those three values to `file` / `file` / `sync`.
- Do not commit `.env` and do not add a database just to satisfy the default `.env.example` values.
- Serve: `php artisan serve` → http://127.0.0.1:8000

## Commands

```sh
php artisan serve        # local dev server
php artisan test         # Feature + Unit tests
php artisan config:clear # clear cached config after .env changes
npm install              # frontend dependencies (see .npmrc gotcha)
npm run dev              # vite dev server (watch)
npm run build            # production assets -> public/build
vendor/bin/pint          # code style (default Laravel preset; no pint.json)
```

- Tests use in-memory SQLite from `phpunit.xml`; no migrations or database file are needed.
- Run one test: `php artisan test --filter=ExampleTest`.
- Prefer the manual steps above over `composer run setup`: its `migrate` step expects a SQLite file that does not exist here.
- `composer run dev` runs `php artisan dev`; `composer run test` runs `config:clear` then the tests.

## Architecture

```text
routes/web.php                      # GET / -> portfolio, POST /contact -> validated mail
resources/views/portfolio.blade.php # assembles the page partials
resources/views/components/app-layout.blade.php
resources/views/partials/nav|hero|about|skills|projects|project-modal|certificates|certificate-modal|education|experience|contact|footer.blade.php
resources/views/partials/social-icon.blade.php # reusable social icon partial
resources/views/partials/config.php # ALL content (profile, skills, projects, certificates, education, experience, contact)
resources/views/welcome.blade.php   # unused Laravel default; not rendered
public/image/Prof_photo.jpg         # hero/about portrait (referenced as image/Prof_photo.jpg)
public/resume/AngelBio_resume.pdf   # real downloadable resume (referenced as resume/AngelBio_resume.pdf)
public/certificate/                 # original certificate PDFs
public/certificate/previews/        # JPG previews generated from those PDFs
public/{emis,fuel,abraquest,gtrack}_project/ # project screenshots
resources/css/app.css               # Tailwind v4 midnight/lavender design system
resources/js/app.js                 # nav, reveals, modals, gallery, filters, toasts, form state
vite.config.js                      # Tailwind + Instrument Sans + Instrument Serif + JetBrains Mono
```

## Design

- Midnight navy × lavender editorial theme with a real light/dark switch. Light mode is the CSS base (`#FAF9FF` page, `#E9E7F5` pale surfaces, `#171A35` dark bands, `#5356A6` indigo interactions, `#A99BFF` lavender accents, `#5c5d75` muted text); `[data-theme='dark']` re-maps every section, control, and modal to the midnight palette. Dark is the default.
- Typography: Instrument Sans (body), Instrument Serif (italic editorial display accents), JetBrains Mono (labels and micro-copy). All three load through `bunny()` in `vite.config.js`.
- Layout: asymmetric hero with "Currently studying" status and OJT responsibility chips, split section headers, editorial alternating project features, dark projects/contact bands, editorial education timeline, OJT experience layout, and a portrait phone stack for the Android project.
- Section order: Home, About, Skills, Projects, Certificates, Education, Experience, Contact, Footer.
- Content is real where provided (Angel Bio, contact details, education, OJT, 4 projects, 3 certificates, GitHub, Facebook, resume). The Experience activities list is an explicit placeholder — never invent achievements, URLs, or project details.
- Interactive pieces: sticky nav with active-section state, always-visible desktop links (the hamburger only appears at 900px and below), sun/moon theme toggle, reveal-on-scroll, project detail modals with screenshot gallery, certificate preview modals, project/certificate category filters, toasts for missing links, scroll progress, and a validated contact form.
- Theme boot: the static `<html data-theme="dark">` plus the inline head script in `app-layout.blade.php` resolve the theme before first paint. Keep that script inline and above the stylesheets (it reads `localStorage['portfolio-theme']`, otherwise prefers system light, otherwise dark); removing it causes a light/dark flash. `resources/js/app.js` owns the toggle, ARIA state, `meta[name="theme-color"]`, and live system-preference changes when nothing is saved.
- Keep the existing sections, palette, theme behavior, and portrait when making changes; avoid adding packages for effects that vanilla CSS/JS can handle.


## Deployment (Vercel)

- `api/index.php` is the serverless entry that requires `public/index.php`; `vercel.json` pins `vercel-php@0.9.0` (PHP 8.5), sets `outputDirectory: public`, runs `npm ci` + `npm run build`, guards `/`, `/index.php`, and `/.htaccess`, then serves existing files before the Laravel catch-all.
- Vercel's filesystem is read-only except `/tmp`. `AppServiceProvider::register()` detects `VERCEL=1` and redirects compiled views to `/tmp/views` while forcing cookie sessions, array cache, sync queue, and stderr logging. Do not switch these to file/database drivers for production.
- `bootstrap/app.php` trusts all proxy headers (`trustProxies(at: '*')`) so `https` URLs are generated behind Vercel's TLS terminator.
- `APP_KEY` (and optional SMTP credentials) must be set in Vercel's encrypted environment variables — never commit a production key. `GET /up` is the deployment health check.
- `MAIL_MAILER=log` only writes to runtime logs on Vercel; configure SMTP/Resend to receive contact messages.
- `vercel-php` is a community runtime. If it is replaced, keep the PHP version at 8.5+ (Laravel 13 / Symfony 8 need it) and keep the `/tmp` view path and static-file-first routing.
- `tests/Feature/VercelDeploymentTest.php` guards the entry point, runtime pin, and route ordering.

## Gotchas

- `.npmrc` sets `ignore-scripts=true`, so npm lifecycle hooks never run. Run `npm run build` explicitly; never rely on postinstall.
- Frontend is **Tailwind CSS v4** via `@tailwindcss/vite`. Keep the `@theme` tokens (fonts + palette aliases) and `@source` directives in `resources/css/app.css`.
- Fonts configured with `bunny()` are emitted through `fonts-manifest.json`, not inside `app.css`. Keep `@fonts` next to `@vite(...)` in `app-layout.blade.php` or no `@font-face` rules will load.
- Reveal animations are scoped to `html.js`; the inline script in the layout head adds that class. Without it, no-JS visitors would see permanently hidden content. The same head must keep the theme boot script before the CSS link.
- Theme CSS order matters: keep the base light styles first, the `[data-theme='dark']` override block after them, and the `prefers-reduced-motion` block last. Dark overrides intentionally leave Projects, Contact, and Footer dark in both themes.
- `resources/views/welcome.blade.php` contains an inline compiled-Tailwind fallback used when `public/build/manifest.json` (or `public/hot`) is absent. It is not rendered by `/`, but run `npm run build` after CSS changes anyway.
- The contact form posts to `POST /contact` (`throttle:6,1`, honeypot `company`) and uses `Mail::raw`. `MAIL_MAILER=log` locally writes messages to `storage/logs/laravel.log`; configure SMTP to receive real mail.
- There is no `app/Models` directory. If a model is ever added, use PHP 8 `#[Fillable]` / `#[Hidden]` attributes instead of `$fillable` / `$hidden`.
- `routes/web.php` has no auth routes, and no Breeze/Fortify is installed.

## Documentation convention

- `PROMPT_LOG.md` is the running task log. For each requested task, append a new `### Task: ...` entry containing the full prompt and a short result summary. Never edit or remove previous entries.
