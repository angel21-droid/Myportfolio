# Angel Bio — BSIT 4 Portfolio

A cute gothic anime–inspired portfolio website built with **Laravel 13** and **Blade** templates. Created as the **BSIT 4 Midterm** project.

## Description

This is a personal portfolio website that presents my information, educational background, projects, and GitHub repositories in a polished, dark-romantic gothic style. The site is a **static website** — all content is rendered from a single static configuration file using Laravel Blade, with **no database, migrations, Eloquent models, or authentication**.

## Purpose

The project demonstrates the use of the Laravel framework and the Blade templating engine to build a clean, professional, and visually distinctive personal portfolio — showcasing my journey as a BSIT student and my coding projects.

## Technologies Used

- **Laravel 13** (PHP ^8.3) — web framework and routing
- **Blade templates** — all views and sections
- **Tailwind CSS v4** — styling, via the `@tailwindcss/vite` plugin
- **Vite** — asset bundling (`laravel-vite-plugin`)
- **PHP 8.3+** — backend runtime
- **JavaScript** — small amount of vanilla JS for navigation, smooth scrolling, scroll-reveal, and active-link highlighting

## Laravel & Blade Usage

- A single web route (`routes/web.php`) maps `/` to the `portfolio` view.
- `resources/views/portfolio.blade.php` loads static data and renders a base layout.
- `resources/views/components/app-layout.blade.php` provides the HTML skeleton.
- Section content lives in reusable partials under `resources/views/partials/`.
- All site content is centralized in `resources/views/partials/config.php` (a plain PHP array returned to Blade) — no database is involved.

## Architecture: Static Website (No Database)

The portfolio intentionally avoids dynamic data storage:

- **No database** — content comes from a static config file (`config.php`)
- **No migrations**
- **No Eloquent models** used by the application
- **No authentication / admin panel**
- **No unnecessary packages** beyond the Laravel/Vite defaults

This keeps the project simple, fast, and readable while still exercising Laravel's routing and view layer.

## Main Portfolio Sections

Each section is rendered from the static data and laid out in a single-page design with smooth scrolling:

- **Hero / Home** — prominently displays the name, course (BSIT 4), short bio, and a profile picture framed in a decorative gothic frame, with hearts, stars/sparkles, ribbons, glow, and subtle animations
- **About** — contact information cards (email, phone, location, course)
- **Education** — a gothic timeline listing Elementary, Junior High School, Senior High School, and College (school, location, years, and degree when available)
- **Projects** — project cards with name, description, technology, and a GitHub repository button
- **GitHub** — a clear, clickable link to the GitHub profile and featured repository
- **Footer** — name, course, copyright, and a back-to-top link

## Design

The site uses a **cute gothic anime–inspired** aesthetic with a dark romantic mood:

- Near-black background with deep **crimson red** and **soft pink** accents, plus white/light-gray/muted-red support colors
- Gothic decorative elements: elegant ribbons, cute hearts, small stars/sparkles, decorative borders, and soft glow effects
- Attractive cards with subtle hover animations and gentle section fade/slide-in reveals
- Responsive on desktop, tablet, and mobile, with a working mobile navigation menu
- Respects `prefers-reduced-motion` for accessibility
- The design is an original, general gothic aesthetic — no copyrighted characters or artwork are used

## How to Run Locally

Prerequisites: **PHP 8.3+** and **Composer** (both ship with XAMPP), **Node.js** and **npm**.

### 1. Install PHP dependencies

```bash
composer install
```

### 2. Set up the environment

```bash
copy .env.example .env   # Windows
php artisan key:generate
```

### 3. Install and build frontend assets

```bash
npm install
npm run build            # or: npm run dev   (Vite watch for local development)
```

### 4. Run the development server

```bash
php artisan serve
```

Then open `http://localhost:8000` in your browser.

> Tip: `composer run setup` performs the full bootstrap (dependencies, `.env`, app key, npm build) if you prefer a one-command setup. Do not run `composer run setup` twice unnecessarily — it copies `.env` only if it does not already exist.

### Tests

```bash
composer run test        # runs the Laravel test suite
```

## Project Structure (relevant parts)

```
resources/views/
├── portfolio.blade.php              # root view (loads data, renders layout)
├── components/
│   └── app-layout.blade.php         # HTML skeleton (head, nav, main, footer)
└── partials/
    ├── config.php                   # ALL static site content lives here
    ├── nav.blade.php                # navigation bar (+ mobile menu)
    ├── hero.blade.php               # hero / home section
    ├── about.blade.php              # contact info cards
    ├── education.blade.php          # gothic education timeline
    ├── projects.blade.php           # project cards
    ├── github.blade.php             # GitHub links section
    └── footer.blade.php             # footer

resources/
├── css/app.css                      # Tailwind v4 theme + gothic styles
└── js/app.js                        # nav toggle, smooth scroll, reveals

routes/web.php                       # single route: / -> portfolio view
public/image/profile.jpg             # profile picture (referenced via asset())
```

## License

This is a personal educational project. Laravel itself is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).
