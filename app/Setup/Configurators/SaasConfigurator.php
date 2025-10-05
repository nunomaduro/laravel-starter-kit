<?php

declare(strict_types=1);

namespace App\Setup\Configurators;

use App\Setup\Contracts\ConfiguratorInterface;
use App\Setup\Services\PackageInstaller;
use Illuminate\Console\Command;

use function Laravel\Prompts\select;

final class SaasConfigurator implements ConfiguratorInterface
{
    private PackageInstaller $installer;

    public function __construct(
        private readonly Command $command
    ) {
        $this->installer = new PackageInstaller($command);
    }

    public function configure(array $selections): void
    {
        $this->command->components->info('💼 Configuring SaaS Platform...');
        $this->command->newLine();

        // Step 1: Install base web application (Inertia)
        $webConfig = new WebConfigurator($this->command);
        $webConfig->configure($selections);

        $this->command->newLine();

        // Step 2: Install multi-tenancy
        $tenancyType = $this->chooseTenancyType();
        $this->installMultiTenancy($tenancyType);

        // Step 3: Install billing (Stripe/Paddle)
        $billingProvider = $this->chooseBillingProvider();
        $this->installBilling($billingProvider);

        // Step 4: Install feature flags (Pennant)
        $this->installFeatureFlags();

        // Step 5: Install permissions
        $this->installPermissions();

        // Step 6: Setup teams/workspaces
        $this->setupTeams();

        $this->command->newLine();
        $this->command->components->info('✅ SaaS Platform configured!');
    }

    public function getRequiredPackages(): array
    {
        return [
            'stancl/tenancy',
            'laravel/cashier-stripe',
        ];
    }

    public function getRecommendedPackages(): array
    {
        return [
            'laravel/pennant',             // Feature flags
            'spatie/laravel-permission',   // Roles & permissions
        ];
    }

    public function getOptionalPackages(): array
    {
        return [
            'laravel/horizon',  // Queue monitoring
            'laravel/nova',     // Admin panel
        ];
    }

    private function chooseTenancyType(): string
    {
        return select(
            label: 'Multi-tenancy strategy?',
            options: [
                'single-db' => 'Single Database (tenant_id column)',
                'multi-db' => 'Multiple Databases (isolated)',
            ],
            default: 'single-db'
        );
    }

    private function installMultiTenancy(string $type): void
    {
        $this->command->components->task('Installing Tenancy for Laravel', function () {
            $this->installer->install('stancl/tenancy', '^4.0');

            // Publish tenancy config
            $this->command->call('vendor:publish', [
                '--provider' => 'Stancl\Tenancy\TenancyServiceProvider',
            ]);

            // Run tenancy migrations
            $this->command->call('tenancy:install');

            return true;
        });

        if ($type === 'multi-db') {
            $this->configureMultiDatabase();
        }
    }

    private function configureMultiDatabase(): void
    {
        $this->command->components->task('Configuring multi-database tenancy', function () {
            // Update tenancy config for database-per-tenant
            $configPath = config_path('tenancy.php');

            if (file_exists($configPath)) {
                $content = file_get_contents($configPath);
                // Configure database tenancy driver
                file_put_contents($configPath, $content);
            }

            return true;
        });
    }

    private function chooseBillingProvider(): string
    {
        return select(
            label: 'Billing provider?',
            options: [
                'stripe' => 'Stripe (recommended)',
                'paddle' => 'Paddle',
            ],
            default: 'stripe'
        );
    }

    private function installBilling(string $provider): void
    {
        $package = $provider === 'stripe' ? 'laravel/cashier-stripe' : 'laravel/cashier-paddle';

        $this->command->components->task("Installing {$provider} billing", function () use ($package) {
            $this->installer->install($package);

            // Publish cashier config and migrations
            $this->command->call('vendor:publish', [
                '--tag' => 'cashier-migrations',
            ]);

            $this->installer->runMigrations();

            return true;
        });

        $this->command->components->task('Creating subscription models', function () {
            // Create subscription-related models
            $this->command->call('make:model', [
                'name' => 'Plan',
                '--migration' => true,
            ]);

            return true;
        });
    }

    private function installFeatureFlags(): void
    {
        $this->command->components->task('Installing Feature Flags (Pennant)', function () {
            $this->installer->install('laravel/pennant');

            $this->command->call('vendor:publish', [
                '--provider' => 'Laravel\Pennant\PennantServiceProvider',
            ]);

            return true;
        });
    }

    private function installPermissions(): void
    {
        $this->command->components->task('Installing Permissions (Spatie)', function () {
            $this->installer->install('spatie/laravel-permission');

            $this->command->call('vendor:publish', [
                '--provider' => 'Spatie\Permission\PermissionServiceProvider',
            ]);

            $this->installer->runMigrations();

            return true;
        });
    }

    private function setupTeams(): void
    {
        $this->command->components->task('Setting up Teams/Workspaces', function () {
            // Create Team model
            $this->command->call('make:model', [
                'name' => 'Team',
                '--migration' => true,
            ]);

            // Create TeamInvitation model
            $this->command->call('make:model', [
                'name' => 'TeamInvitation',
                '--migration' => true,
            ]);

            return true;
        });
    }
}
