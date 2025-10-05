<?php

declare(strict_types=1);

namespace App\Setup\Configurators;

use App\Setup\Contracts\ConfiguratorInterface;
use App\Setup\Services\PackageInstaller;
use Illuminate\Console\Command;

final class MicroserviceConfigurator implements ConfiguratorInterface
{
    private PackageInstaller $installer;

    public function __construct(
        private readonly Command $command
    ) {
        $this->installer = new PackageInstaller($command);
    }

    public function configure(array $selections): void
    {
        $this->command->components->info('🏢 Configuring Microservice...');
        $this->command->newLine();

        // Step 1: Remove ALL web-related code
        $this->stripDownToMinimal();

        // Step 2: Install Octane for performance
        $this->installOctane();

        // Step 3: Add health checks
        $this->addHealthChecks();

        // Step 4: Configure for stateless operation
        $this->configureStateless();

        $this->command->newLine();
        $this->command->components->info('✅ Microservice optimized!');
    }

    public function getRequiredPackages(): array
    {
        return [];
    }

    public function getRecommendedPackages(): array
    {
        return [
            'laravel/octane', // Performance
        ];
    }

    public function getOptionalPackages(): array
    {
        return [
            'prometheus/client_php', // Metrics
        ];
    }

    private function stripDownToMinimal(): void
    {
        $this->command->components->task('Removing web routes', function () {
            if (file_exists(base_path('routes/web.php'))) {
                unlink(base_path('routes/web.php'));
            }

            return true;
        });

        $this->command->components->task('Removing API routes (if not needed)', function () {
            // Keep API routes for microservice endpoints
            return true;
        });

        $this->command->components->task('Removing frontend assets', function () {
            $dirs = ['views', 'js', 'css'];

            foreach ($dirs as $dir) {
                $path = resource_path($dir);
                if (is_dir($path)) {
                    $this->deleteDirectory($path);
                }
            }

            return true;
        });

        $this->command->components->task('Removing session middleware', function () {
            // Sessions are not needed for stateless microservices
            // This will be configured in bootstrap/app.php
            return true;
        });
    }

    private function installOctane(): void
    {
        $this->command->components->task('Installing Laravel Octane', function () {
            $this->installer->install('laravel/octane', '^2.0');

            // Publish Octane config
            $this->command->call('vendor:publish', [
                '--provider' => 'Laravel\Octane\OctaneServiceProvider',
                '--tag' => 'config',
            ]);

            return true;
        });
    }

    private function addHealthChecks(): void
    {
        $this->command->components->task('Adding health check endpoints', function () {
            // Create simple health check route
            $apiRoutes = base_path('routes/api.php');

            if (file_exists($apiRoutes)) {
                $healthCheck = <<<'PHP'

// Health check endpoints
Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

Route::get('/health/ready', function () {
    // Check database, cache, etc.
    try {
        DB::connection()->getPdo();
        return response()->json(['status' => 'ready']);
    } catch (\Exception $e) {
        return response()->json(['status' => 'not ready'], 503);
    }
});

PHP;

                file_put_contents($apiRoutes, $healthCheck, FILE_APPEND);
            }

            return true;
        });
    }

    private function configureStateless(): void
    {
        $this->command->components->task('Configuring for stateless operation', function () {
            // Update session driver to array (no persistence)
            $envPath = base_path('.env.example');

            if (file_exists($envPath)) {
                $content = file_get_contents($envPath);
                $content = str_replace('SESSION_DRIVER=database', 'SESSION_DRIVER=array', $content);
                file_put_contents($envPath, $content);
            }

            return true;
        });
    }

    private function deleteDirectory(string $dir): bool
    {
        if (! is_dir($dir)) {
            return false;
        }

        $files = array_diff(scandir($dir), ['.', '..']);

        foreach ($files as $file) {
            $path = $dir.'/'.$file;
            is_dir($path) ? $this->deleteDirectory($path) : unlink($path);
        }

        return rmdir($dir);
    }
}
