<?php

declare(strict_types=1);

namespace App\Setup\Configurators;

use App\Setup\Contracts\ConfiguratorInterface;
use App\Setup\Services\PackageInstaller;
use Illuminate\Console\Command;

final class MobileBackendConfigurator implements ConfiguratorInterface
{
    private PackageInstaller $installer;

    public function __construct(
        private readonly Command $command
    ) {
        $this->installer = new PackageInstaller($command);
    }

    public function configure(array $selections): void
    {
        $this->command->components->info('📱 Configuring Mobile Backend...');
        $this->command->newLine();

        // Step 1: Install API foundation (Sanctum)
        $this->installApi();

        // Step 2: Install WebSockets if needed
        if ($this->hasCapability($selections, 'real-time')) {
            $this->installRealTime();
        }

        // Step 3: Install file processing
        $this->installFileProcessing();

        // Step 4: Remove web code (keep API only)
        $this->removeWebCode();

        // Step 5: Configure CORS for mobile
        $this->configureCors();

        $this->command->newLine();
        $this->command->components->info('✅ Mobile Backend configured!');
    }

    public function getRequiredPackages(): array
    {
        return [
            'laravel/sanctum',
        ];
    }

    public function getRecommendedPackages(): array
    {
        return [
            'laravel/reverb',      // Real-time
            'intervention/image',  // Image processing
        ];
    }

    public function getOptionalPackages(): array
    {
        return [
            'spatie/laravel-permission',
            'laravel/socialite',
            'spatie/laravel-medialibrary',
        ];
    }

    private function installApi(): void
    {
        $this->installer->runNativeCommand('install:api');
    }

    private function installRealTime(): void
    {
        $this->command->components->task('Installing WebSockets (Reverb)', function () {
            // Use native broadcasting install
            $this->installer->runNativeCommand('install:broadcasting');

            return true;
        });
    }

    private function installFileProcessing(): void
    {
        $this->command->components->task('Installing image processing', function () {
            $this->installer->install('intervention/image', '^3.0');

            return true;
        });
    }

    private function removeWebCode(): void
    {
        $this->command->components->task('Removing web routes', function () {
            if (file_exists(base_path('routes/web.php'))) {
                unlink(base_path('routes/web.php'));
            }

            return true;
        });

        $this->command->components->task('Removing views', function () {
            if (is_dir(resource_path('views'))) {
                $this->deleteDirectory(resource_path('views'));
            }

            return true;
        });
    }

    private function configureCors(): void
    {
        $this->command->components->task('Configuring CORS for mobile', function () {
            $corsPath = config_path('cors.php');

            if (file_exists($corsPath)) {
                $content = file_get_contents($corsPath);

                // Update CORS config for mobile apps
                $content = str_replace(
                    "'allowed_origins' => [env('FRONTEND_URL', 'http://localhost:3000')],",
                    "'allowed_origins' => ['*'], // Mobile apps",
                    $content
                );

                file_put_contents($corsPath, $content);
            }

            return true;
        });
    }

    private function hasCapability(array $selections, string $capability): bool
    {
        return in_array($capability, $selections['capabilities'] ?? []);
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
