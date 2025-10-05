<?php

declare(strict_types=1);

namespace App\Setup\Configurators;

use App\Setup\Contracts\ConfiguratorInterface;
use App\Setup\Services\PackageInstaller;
use Illuminate\Console\Command;

final class ApiConfigurator implements ConfiguratorInterface
{
    private PackageInstaller $installer;

    public function __construct(
        private readonly Command $command
    ) {
        $this->installer = new PackageInstaller($command);
    }

    public function configure(array $selections): void
    {
        $this->command->components->info('🔌 Configuring API application...');
        $this->command->newLine();

        // Step 1: Use Laravel's native install:api command
        $this->installApi();

        // Step 2: Remove web-related code
        $this->removeWebCode();

        // Step 3: Optimize for API
        $this->optimizeForApi();

        $this->command->newLine();
        $this->command->components->info('✅ API configuration complete!');
    }

    public function getRequiredPackages(): array
    {
        return [
            'laravel/sanctum', // Installed via install:api
        ];
    }

    public function getRecommendedPackages(): array
    {
        return [];
    }

    public function getOptionalPackages(): array
    {
        return [
            'dedoc/scramble',              // API documentation
            'spatie/laravel-query-builder', // Advanced filtering
            'league/fractal',              // API transformers
        ];
    }

    private function installApi(): void
    {
        // Use Laravel's native command - it installs Sanctum + creates API routes
        $this->installer->runNativeCommand('install:api');
    }

    private function removeWebCode(): void
    {
        $this->command->components->task('Removing web routes', function () {
            if (file_exists(base_path('routes/web.php'))) {
                unlink(base_path('routes/web.php'));
            }

            return true;
        });

        $this->command->components->task('Removing views directory', function () {
            if (is_dir(resource_path('views'))) {
                $this->deleteDirectory(resource_path('views'));
            }

            return true;
        });
    }

    private function optimizeForApi(): void
    {
        $this->command->components->task('Optimizing for API', function () {
            // Update bootstrap/app.php to remove web routes
            $bootstrapPath = base_path('bootstrap/app.php');
            $content = file_get_contents($bootstrapPath);

            // Remove web routing if exists
            $content = preg_replace(
                "/->withRouting\((.*?)web:(.*?),/s",
                '->withRouting(',
                $content
            );

            file_put_contents($bootstrapPath, $content);

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
