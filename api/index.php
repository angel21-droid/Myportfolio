<?php

/**
 * Vercel serverless entry point.
 *
 * Vercel expects functions to live inside the `api/` directory, while Laravel
 * only exposes `public/index.php` as its front controller. Forward every
 * request there so the project root stays private.
 */
$compiled = '/tmp/views';
if (! is_dir($compiled)) {
    @mkdir($compiled, 0755, true);
}

require __DIR__.'/../public/index.php';
