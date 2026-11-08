<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Vercel's serverless filesystem is read-only apart from /tmp, so
        // every writable Laravel path has to be redirected when the app runs
        // there. These are runtime-only, non-secret defaults; APP_KEY and mail
        // credentials still come from Vercel's environment variables.
        $isVercel = getenv('VERCEL') || getenv('NOW_REGION') || isset($_SERVER['VERCEL']) || env('VERCEL');

        if ($isVercel) {
            $compiled = env('VIEW_COMPILED_PATH', '/tmp/storage/framework/views');
            $cache = '/tmp/storage/framework/cache/data';

            foreach ([$compiled, $cache, '/tmp/storage/framework/sessions'] as $dir) {
                if (! is_dir($dir)) {
                    @mkdir($dir, 0755, true);
                }
            }

            config([
                'app.debug' => false,
                'app.env' => env('APP_ENV', 'production'),
                'view.compiled' => $compiled,
                'session.driver' => 'cookie',
                'cache.default' => 'array',
                'cache.stores.file.path' => $cache,
                'cache.stores.database.connection' => null,
                'queue.default' => 'sync',
                'queue.connections.database.connection' => null,
                'logging.default' => 'stderr',
                'logging.channels.single.path' => '/tmp/storage/logs/laravel.log',
                'logging.channels.daily.path' => '/tmp/storage/logs/laravel.log',
                'logging.channels.stack.channels' => ['stderr'],
            ]);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
