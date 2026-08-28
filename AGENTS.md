# Myportfolio

Laravel 13 portfolio app (PHP ^8.3). Runs under **XAMPP** at `C:\xampp\htdocs\Myportfolio`, served by Apache. Laravel Boost is *referenced* in repo docs but NOT yet installed — run the setup below before changing app code.

## Dev environment (Windows / XAMPP)

- PHP + Composer ship with XAMPP; verify with `php -v` / `composer -V`.
- Serve with `php artisan serve` (Apache is optional for local dev).
- Local DB is **SQLite** (`database/database.sqlite` already exists). Tests ignore it and use in-memory SQLite (see `phpunit.xml`), so tests do not require migrations.

## Commands

```sh
composer run setup      # full bootstrap: composer install, .env, key, migrate, npm, vite build
composer run dev        # runs `php artisan dev` (server + queue + vite)
composer run test       # config:clear then `php artisan test`
npm run dev             # vite dev server (watch)
npm run build           # vite production build
vendor/bin/pint         # code style (default Laravel preset; no pint.json)
```

Verify with `composer run test` (runs `tests/Feature` + `tests/Unit`). Run a single test via `php artisan test --filter=ExampleTest`.

## Gotchas

- `.npmrc` sets `ignore-scripts=true`, so npm lifecycle hooks never run. Postinstall work must be done explicitly (`npm run build` etc.), never rely on `npm install` hooks.
- Frontend is **Tailwind CSS v4** via `@tailwindcss/vite`. Vite inputs are `resources/css/app.css` and `resources/js/app.js`. `resources/css/app.css` defines custom `@theme` (Instrument Sans font) plus `@source` directives — keep those when editing styles.
- `resources/views/welcome.blade.php` has an inline compiled-Tailwind fallback used whenever `public/build/manifest.json` (or `public/hot`) is absent. After changing the app's CSS, rebuild with `npm run build` or the fallback shows stale/stock styling.
- `routes/web.php` currently defines only `/` → `welcome`. No auth scaffold is installed (no Breeze/Fortify), yet the welcome view references `auth`, `login`, `register` routes that don't exist under `Route::has(...)` guards.
- `app/Models/User.php` uses modern PHP 8 `#[Fillable]` / `#[Hidden]` attributes instead of classic `$fillable`/`$hidden` arrays — follow that pattern for new models.

## Agent setup (Laravel Boost)

Before making application changes, install Boost from the repo root:

```sh
composer require laravel/boost --dev
php artisan boost:install
```

Then re-read `AGENTS.md` and continue using the generated guidelines.
