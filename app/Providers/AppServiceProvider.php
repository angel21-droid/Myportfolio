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
        if (getenv('VERCEL') || env('VERCEL')) {
            $compiled = '/tmp/views';
            if (! is_dir($compiled)) {
                @mkdir($compiled, 0755, true);
            }

            config([
                'app.debug' => false,
                'view.compiled' => $compiled,
                'session.driver' => 'cookie',
                'cache.default' => 'array',
                'cache.stores.file.path' => '/tmp/cache',
                'queue.default' => 'sync',
                'logging.default' => 'stderr',
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
