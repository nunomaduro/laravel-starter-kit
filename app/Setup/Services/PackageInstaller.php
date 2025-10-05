<?php

declare(strict_types=1);

namespace App\Setup\Services;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

final class PackageInstaller
{
    public function __construct(
        private readonly Command $command
    ) {}

    /**
     * Install a package via composer require.
     */
    public function install(string $package, ?string $version = null): bool
    {
        $packageWithVersion = $version ? "{$package}:{$version}" : $package;

        $this->command->components->task(
            "Installing {$packageWithVersion}",
            fn () => $this->runComposerRequire($packageWithVersion)
        );

        return true;
    }

    /**
     * Install multiple packages.
     *
     * @param  array<string>  $packages
     */
    public function installMultiple(array $packages): void
    {
        foreach ($packages as $package) {
            $this->install($package);
        }
    }

    /**
     * Run a native Laravel install command (e.g., install:api).
     */
    public function runNativeCommand(string $command, array $options = []): bool
    {
        $this->command->components->task(
            "Running {$command}",
            fn () => $this->command->call($command, $options)
        );

        return true;
    }

    /**
     * Run composer update after all packages are added.
     */
    public function update(): bool
    {
        $this->command->components->task(
            'Running composer update',
            fn () => Process::run(['composer', 'update', '--no-interaction'])->successful()
        );

        return true;
    }

    /**
     * Publish package config if needed.
     */
    public function publishConfig(string $provider): void
    {
        $this->command->call('vendor:publish', [
            '--provider' => $provider,
            '--tag' => 'config',
        ]);
    }

    /**
     * Run package migrations.
     */
    public function runMigrations(): void
    {
        $this->command->call('migrate', ['--force' => true]);
    }

    /**
     * Execute composer require command.
     */
    private function runComposerRequire(string $package): bool
    {
        $result = Process::run([
            'composer',
            'require',
            $package,
            '--no-interaction',
            '--prefer-dist',
            '--no-update', // Don't run composer update, just add to composer.json
        ]);

        return $result->successful();
    }
}
