<?php

/**
 * Vercel serverless entry point.
 *
 * Vercel expects functions to live inside the `api/` directory, while Laravel
 * only exposes `public/index.php` as its front controller. Forward every
 * request there so the project root stays private.
 */
$isVercel = getenv('VERCEL') || getenv('NOW_REGION') || isset($_SERVER['VERCEL']);

if ($isVercel) {
    // Vercel's filesystem is read-only except /tmp. Create writable runtime
    // directories before Laravel boots, and set safe defaults so config never
    // falls back to database/file drivers that need local storage.
    $dirs = [
        '/tmp/storage',
        '/tmp/storage/framework',
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/testing',
        '/tmp/storage/logs',
        '/tmp/bootstrap/cache',
    ];

    foreach ($dirs as $dir) {
        if (! is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }

    $defaults = [
        'APP_ENV' => 'production',
        'APP_DEBUG' => 'false',
        'LOG_CHANNEL' => 'stderr',
        'LOG_LEVEL' => 'error',
        'VIEW_COMPILED_PATH' => '/tmp/storage/framework/views',
        'SESSION_DRIVER' => 'cookie',
        'CACHE_STORE' => 'array',
        'CACHE_DRIVER' => 'array',
        'QUEUE_CONNECTION' => 'sync',
    ];

    foreach ($defaults as $key => $value) {
        if (getenv($key) === false && ! isset($_ENV[$key], $_SERVER[$key])) {
            putenv("{$key}={$value}");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

require __DIR__.'/../public/index.php';
