<?php

namespace Tests\Feature;

use Tests\TestCase;

class VercelDeploymentTest extends TestCase
{
    public function test_vercel_configuration_targets_the_laravel_public_directory(): void
    {
        $config = json_decode(
            file_get_contents(base_path('vercel.json')),
            true,
            flags: JSON_THROW_ON_ERROR,
        );

        $this->assertSame('public', $config['outputDirectory']);
        $this->assertSame('npm run build', $config['buildCommand']);
        $this->assertSame('vercel-php@0.9.0', $config['functions']['api/index.php']['runtime']);
    }

    public function test_vercel_routes_hide_php_entry_points_and_serve_static_files_first(): void
    {
        $config = json_decode(
            file_get_contents(base_path('vercel.json')),
            true,
            flags: JSON_THROW_ON_ERROR,
        );

        $routes = $config['routes'];
        $sources = array_column($routes, 'src');

        // / and /index.php must reach PHP so the raw front controller is never
        // served as a static file from the public output directory.
        $this->assertContains('/', $sources);
        $this->assertContains('/index\\.php', $sources);

        $filesystemIndex = null;
        $catchAllIndex = null;

        foreach ($routes as $index => $route) {
            if (($route['handle'] ?? null) === 'filesystem') {
                $filesystemIndex = $index;
            }

            if (($route['src'] ?? null) === '/(.*)') {
                $catchAllIndex = $index;
            }
        }

        $this->assertNotNull($filesystemIndex);
        $this->assertNotNull($catchAllIndex);
        $this->assertLessThan($catchAllIndex, $filesystemIndex);
    }

    public function test_serverless_entry_point_forwards_to_laravel(): void
    {
        $entry = base_path('api/index.php');

        $this->assertFileExists($entry);
        $this->assertStringContainsString("public/index.php", file_get_contents($entry));
    }
}
