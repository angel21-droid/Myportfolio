# Angel Bio — Personal Portfolio Website

A personal portfolio website developed by an Information Technology student to showcase technical skills, academic background, projects, certificates, and professional experience. It is built with **Laravel 13**, **Blade**, **Tailwind CSS v4**, and lightweight vanilla JavaScript, and designed as a premium midnight-navy × lavender editorial site with a dark/light theme switcher.

## Project Overview

This is a **single-page, static-content** Laravel portfolio for **Angel V. Bio** (IT Student | Aspiring Web Developer, Salnec, Bucay, Abra). All portfolio content is rendered from one PHP configuration file through Blade — there is no database, no migrations, no Eloquent models, no authentication, and no admin panel.

The site is prepared for local development and for **Vercel deployment** via the `vercel-php` community runtime. On Vercel, runtime state is kept off the read-only filesystem (cookie sessions, array cache, sync queue, stderr logging, and compiled Blade views in `/tmp/views`).

## Features

- Responsive portfolio design across desktop, laptop, tablet, and mobile.
- **Light Mode and Dark Mode** — dark by default, sun/moon toggle, `localStorage` persistence (`portfolio-theme`), first-visit system preference fallback, and pre-paint theme boot to avoid flash.
- Interactive navigation — sticky blurred bar, smooth scrolling, active-section highlighting, always-visible desktop links down to 900px, and a hamburger/mobile menu on smaller screens.
- **Hero and About** sections with real profile information, a balanced hero layout, a downloadable resume, and GitHub/Facebook links.
- **Skills & Technologies** grouped into Design, Development, Tools & Technologies, and Other Skills (no percentage bars).
- **Featured Projects** with category filters, project detail modals, screenshot galleries, and real GitHub/Live Demo links (P.E EMIS, Bangued-Ka-Fuel, AbraQuest, Task Manager, My Portfolio).
- **Certificate Gallery** (newest first) with category filters, real preview images, and a large preview/PDF modal.
- **Education Timeline** for tertiary and secondary education.
- **LRA OJT Experience** — Land Registration Authority (LRA), Intern, Currently Ongoing — until OJT completion; responsibilities: File Management, Encoding.
- **Contact Form** — validated `POST /contact` with name/email/subject/message, a honeypot field, rate limiting, and `Mail::raw` delivery.
- **Resume Download** — `Download My Resume` links to `public/resume/AngelBio_resume.pdf`.

No features are claimed beyond what is implemented and covered by the test suite.

## Technologies Used

Technologies actually used in this implementation:

- **Laravel 13.29** (PHP `^8.3`; developed with PHP 8.5 / Herd Lite) — routing, validation, mail, Blade rendering.
- **Blade** — layout component, reusable partials, and static data rendering.
- **Tailwind CSS v4** via `@tailwindcss/vite` — design tokens and styling.
- **Vite 8** + `laravel-vite-plugin` — asset bundling and font manifest generation.
- **Vanilla JavaScript** (`resources/js/app.js`) — theme switching, navigation/scroll state, reveals, project/certificate modals and galleries, filters, toasts, and contact-form submit state.
- **Fonts**: Instrument Sans, Instrument Serif, JetBrains Mono (loaded through the Vite Bunny font integration; `@fonts` in the layout).
- **Community runtime for Vercel**: `vercel-php@0.9.0` (PHP 8.5), pinned in `vercel.json`.

Not used: database/SQLite in production, migrations, Eloquent models, authentication/admin packages, or other frontend frameworks.

## Project Structure

```text
api/index.php                        # Vercel serverless entry -> public/index.php
vercel.json                          # Vercel runtime, routes, install/build, output dir
.vercelignore                        # excludes vendor/node_modules/env/logs from upload
routes/web.php                       # GET / (home) and POST /contact (validated mail)
app/Providers/AppServiceProvider.php # Vercel: /tmp views + cookie/array/sync/stderr
bootstrap/app.php                    # trusts proxy headers for HTTPS on Vercel
resources/views/
├── portfolio.blade.php              # loads config data and assembles sections
├── components/app-layout.blade.php  # HTML shell, theme boot, @vite/@fonts, toasts
└── partials/
    ├── config.php                   # ALL real portfolio content
    ├── nav.blade.php                # sticky nav + theme toggle + mobile menu
    ├── hero.blade.php               # hero with resume download and socials
    ├── about.blade.php              # about/story/background/interests/goals
    ├── skills.blade.php             # design/development/tools/other skills
    ├── projects.blade.php           # project filters and feature cards
    ├── project-modal.blade.php      # project detail modal + gallery
    ├── certificates.blade.php       # newest-first certificates and filters
    ├── certificate-modal.blade.php  # certificate preview/PDF modal
    ├── education.blade.php          # education timeline
    ├── experience.blade.php         # LRA OJT experience only
    ├── contact.blade.php            # contact links + validated form
    ├── footer.blade.php             # footer, nav, socials, back-to-top
    └── social-icon.blade.php        # GitHub/Facebook icon partial
resources/css/app.css                # Tailwind v4 tokens + midnight/lavender design
resources/js/app.js                  # theme/nav/reveals/modals/filters/form behavior
vite.config.js                       # Tailwind + Bunny fonts
public/image/Prof_photo.jpg          # portrait
public/resume/AngelBio_resume.pdf    # downloadable resume
public/certificate/                  # original certificate PDFs
public/certificate/previews/         # generated JPG previews
public/{emis,fuel,abraquest,gtrack}_project/ # project screenshots
tests/Feature/                       # portfolio, contact, Vercel deployment tests
```

## Installation and Setup

Prerequisites: **PHP 8.3+** (PHP 8.5 recommended; the project is tested with Herd Lite PHP 8.5), **Composer**, **Node.js**, and **npm**.

### 1. Clone the repository

```bash
git clone https://github.com/angel21-droid/Myportfolio.git
cd Myportfolio
```

### 2. Install PHP dependencies

```bash
composer install
```

If you have multiple PHP versions, run Composer with the intended PHP binary (see AGENTS.md for the Herd Lite example on Windows).

### 3. Install frontend dependencies

```bash
npm install
```

> `.npmrc` sets `ignore-scripts=true`, so npm lifecycle hooks do not run. Build assets explicitly with `npm run build`.

### 4. Configure `.env`

```bash
copy .env.example .env   # Windows PowerShell/CMD
# or: cp .env.example .env
php artisan key:generate
```

This portfolio does **not** require a database. Keep (or set) these values:

```env
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
MAIL_MAILER=log
```

### 5. Database and migrations

**Not required.** The portfolio is static and stores no application data in a database. Tests use in-memory SQLite as configured in `phpunit.xml`; you do not need to create a database file or run migrations.

### 6. Build frontend assets

```bash
npm run build            # production build -> public/build
# or: npm run dev        # Vite dev server for local development
```

### 7. Start the local development server

```bash
php artisan serve
```

Open `http://127.0.0.1:8000`. Local contact-form submissions are written to `storage/logs/laravel.log` when `MAIL_MAILER=log`.

### Tests

```bash
php artisan test
```

## Environment Variables

Documented names only — **do not commit real values, passwords, or API keys**. `.env` is gitignored.

| Name | Purpose |
| --- | --- |
| `APP_NAME` | Application name. |
| `APP_ENV` | Environment (`local`, `production`). |
| `APP_KEY` | Laravel encryption key (generate with `php artisan key:generate --show`). **Required in production/Vercel.** |
| `APP_DEBUG` | Debug mode (`false` in production). |
| `APP_URL` | Base URL (local or deployed domain). |
| `SESSION_DRIVER` | `file` locally; Vercel runtime forces `cookie` when `VERCEL=1`. |
| `CACHE_STORE` | `file` locally; Vercel runtime forces `array` when `VERCEL=1`. |
| `QUEUE_CONNECTION` | `sync` locally; Vercel runtime forces `sync` when `VERCEL=1`. |
| `LOG_CHANNEL` | Logging channel; Vercel uses `stderr`. |
| `VIEW_COMPILED_PATH` | Optional; Vercel runtime uses `/tmp/views`. |
| `MAIL_MAILER` | Mail transport (`log` locally; set a real mailer to receive contact messages). |
| `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD` | SMTP credentials for real contact-form delivery (keep secret). |
| `MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME` | Sender identity. |
| `VITE_APP_NAME` | Frontend app name reference. |

No database credentials are required for the current static portfolio.

## Vercel Deployment

The repository is configured for import into Vercel from GitHub.

### Deployment configuration

- `vercel.json` pins `vercel-php@0.9.0` (PHP 8.5), sets `framework: null`, `outputDirectory: public`, runs `npm ci` + `npm run build`, and routes `/`, `/index.php`, `/.htaccess`, and all non-file requests to `api/index.php`.
- `api/index.php` forwards requests to Laravel's `public/index.php`.
- `bootstrap/app.php` trusts proxy headers so generated URLs use HTTPS behind Vercel.
- `app/Providers/AppServiceProvider.php` detects `VERCEL=1` and applies read-only-filesystem-safe runtime settings.
- `GET /up` is the health check route.

### Step-by-step import

1. Push the project to `https://github.com/angel21-droid/Myportfolio.git` (or your target branch).
2. Open [vercel.com/new](https://vercel.com/new) and import the GitHub repository.
3. Framework preset: **Other**. Root directory: `./`. Keep the default commands/output — `vercel.json` provides them.
4. Add environment variables (Project → Settings → Environment Variables):
   - `APP_KEY` — value from `php artisan key:generate --show`
   - `APP_ENV` — `production`
   - `APP_DEBUG` — `false`
   - `APP_URL` — your Vercel deployment URL or custom domain
5. Deploy. The build runs `npm ci`, `npm run build`, and Composer install for the PHP function.
6. Verify `https://<your-project>.vercel.app/` loads and `https://<your-project>.vercel.app/up` returns HTTP 200.

### Contact form on Vercel

`MAIL_MAILER=log` only writes to Vercel runtime logs; it does not deliver email. To receive contact messages, configure a real mail service (for example SMTP, Resend, or another supported mailer) in Vercel environment variables and redeploy. Keep credentials in Vercel, not in Git.

### External services

No external database or queue worker is required. The only optional external service is a mail provider for real contact-form delivery.

### Limitations

- Vercel's filesystem is read-only except `/tmp`; sessions/cache/compiled views are handled accordingly.
- `vercel-php` is a community runtime (pinned version). If Vercel platform behavior changes, keep PHP 8.5+ for Laravel 13 compatibility.

## Project Screenshots

Screenshots are not committed as separate README preview images in this repository. The portfolio itself renders real project screenshots and certificate previews from the `public/` assets listed above.

## Author

**Angel V. Bio**

- GitHub: [https://github.com/angel21-droid](https://github.com/angel21-droid)
- Email: [bioangel29@gmail.com](mailto:bioangel29@gmail.com)

## License

No `LICENSE` file is currently present in this repository. No license is claimed or invented here. Laravel (the framework dependency) is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).
