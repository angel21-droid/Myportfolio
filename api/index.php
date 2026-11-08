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
    $storagePath = '/tmp/storage';
    $dirs = [
        $storagePath,
        $storagePath.'/app',
        $storagePath.'/app/public',
        $storagePath.'/framework',
        $storagePath.'/framework/views',
        $storagePath.'/framework/cache',
        $storagePath.'/framework/sessions',
        $storagePath.'/framework/testing',
        $storagePath.'/logs',
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
        'APP_STORAGE' => $storagePath,
        'VIEW_COMPILED_PATH' => $storagePath.'/framework/views',
        'APP_CONFIG_CACHE' => '/tmp/config.php',
        'APP_EVENTS_CACHE' => '/tmp/events.php',
        'APP_PACKAGES_CACHE' => '/tmp/packages.php',
        'APP_ROUTES_CACHE' => '/tmp/routes.php',
        'APP_SERVICES_CACHE' => '/tmp/services.php',
        'SESSION_DRIVER' => 'cookie',
        'CACHE_STORE' => 'array',
        'CACHE_DRIVER' => 'array',
        'QUEUE_CONNECTION' => 'sync',
    ];

    foreach ($defaults as $key => $value) {
        putenv("{$key}={$value}");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

// TEMPORARY RUNTIME DEBUG (remove after diagnosing Vercel 500): surface the
// real/underlying exception in the response/logs instead of a blank 500.
try {
    require __DIR__.'/../public/index.php';
} catch (\Throwable $e) {
    $root = $e->getPrevious() ?: $e;
    $message = htmlspecialchars($root->getMessage(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $file = htmlspecialchars($root->getFile(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $line = (int) $root->getLine();
    $trace = htmlspecialchars($root->getTraceAsString(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $wrapper = $root !== $e ? htmlspecialchars($e->getMessage(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : null;

    error_log('[Vercel Laravel bootstrap error] '.$root->getMessage().' @ '.$root->getFile().':'.$root->getLine());
    if (! headers_sent()) {
        http_response_code(500);
        header('Content-Type: text/plain; charset=UTF-8');
    }

    echo "Laravel bootstrap exception (temporary debug)\n\n";
    echo $message."\n\n";
    echo $file.':'.$line."\n\n";
    if ($wrapper !== null) {
        echo "Wrapper: ".$wrapper."\n\n";
    }
    echo $trace;
}
