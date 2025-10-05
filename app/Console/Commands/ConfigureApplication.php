<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\info;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;
use function Laravel\Prompts\spin;
use function Laravel\Prompts\warning;

final class ConfigureApplication extends Command
{
    protected $signature = 'app:configure
                            {--dry-run : Show what would be done without making changes}';

    protected $description = 'Interactive setup wizard to configure your Laravel application';

    private array $selections = [];

    public function handle(): int
    {
        $this->displayWelcome();

        if ($this->option('dry-run')) {
            warning('DRY RUN MODE - No changes will be made');
        }

        // Safety: Create git tag for rollback
        $this->createSafetyBackup();

        // Step 1: Choose base type (single select)
        $this->selections['base_type'] = $this->chooseBaseType();

        // Step 2: Choose capabilities (multiselect)
        $this->selections['capabilities'] = $this->chooseCapabilities();

        // Step 3: Choose features (multiselect)
        $this->selections['features'] = $this->chooseFeatures();

        // Step 4: Infrastructure choices
        $this->selections['infrastructure'] = $this->chooseInfrastructure();

        // Step 5: Show summary and confirm
        $this->showSummary();

        if (! confirm('Proceed with this configuration?', default: true)) {
            info('Configuration cancelled.');

            return self::SUCCESS;
        }

        // Step 6: Execute configuration
        if (! $this->option('dry-run')) {
            $this->executeConfiguration();
        }

        $this->displaySuccess();

        return self::SUCCESS;
    }

    private function displayWelcome(): void
    {
        $this->newLine();
        $this->components->twoColumnDetail(
            '<fg=cyan>🚀 Laravel Starter Kit - Interactive Setup</>',
        );
        $this->newLine();

        $this->components->info('Build your perfect Laravel app by selecting features!');
        $this->components->info('Juniors-friendly: focus on business logic, we handle infra 🎯');
        $this->newLine();
    }

    private function createSafetyBackup(): void
    {
        $tagName = 'pre-setup-'.date('Y-m-d-His');

        spin(
            function () use ($tagName) {
                // Check if tag already exists
                $existingTag = shell_exec("git tag -l {$tagName}") ?? '';
                if (empty(mb_trim($existingTag))) {
                    shell_exec("git tag {$tagName}");
                }

                return true;
            },
            'Creating safety backup...'
        );

        $this->components->info('✓ Git tag created for rollback');
        $this->newLine();
    }

    private function chooseBaseType(): string
    {
        return select(
            label: 'What is the PRIMARY purpose of this application?',
            options: [
                'api' => '🔌 Backend API (no frontend)',
                'web' => '🌐 Web Application (Inertia.js)',
                'hybrid' => '🔄 Hybrid (API + Web)',
                'mobile-backend' => '📱 Mobile Backend (iOS, Android, React Native)',
                'microservice' => '🏢 Microservice (minimal, optimized)',
                'saas' => '💼 SaaS Platform (multi-tenant, billing)',
                'ai-powered' => '🤖 AI-Powered (LLM integration)',
                'mcp' => '🔧 MCP Server (Model Context Protocol)',
            ],
            default: 'api',
            hint: 'This determines the base configuration'
        );
    }

    private function chooseCapabilities(): array
    {
        $capabilities = [
            'mobile' => '📱 Mobile Backend (iOS, Android, React Native)',
            'web-app' => '💻 Web Application (Inertia.js)',
            'real-time' => '⚡ Real-time (WebSockets via Reverb)',
            'ai' => '🤖 AI-Powered (LLM integration)',
            'saas' => '💼 SaaS Features (multi-tenant, billing)',
            'graphql' => '📊 GraphQL API',
        ];

        // Filter based on base type
        $filtered = match ($this->selections['base_type']) {
            'api' => array_filter($capabilities, fn ($key) => in_array($key, ['mobile', 'real-time', 'ai', 'graphql']), ARRAY_FILTER_USE_KEY),
            'microservice' => ['real-time' => $capabilities['real-time']],
            'mcp' => ['ai' => $capabilities['ai']],
            default => $capabilities,
        };

        if (empty($filtered)) {
            return [];
        }

        return multiselect(
            label: 'What capabilities does your application need?',
            options: $filtered,
            hint: 'Space to select, Enter to continue',
            required: false
        );
    }

    private function chooseFeatures(): array
    {
        $features = [
            // Authentication
            'auth-sanctum' => '🔐 API Authentication (Sanctum)',
            'auth-passport' => '🔐 OAuth2 (Passport)',
            'auth-social' => '👥 Social Login (Google, Apple, etc)',
            'auth-2fa' => '🔒 Two-Factor Authentication',

            // Real-time (if selected)
            'websockets-reverb' => '🌊 WebSockets (Reverb)',

            // File handling
            'file-intervention' => '🖼️  Image Processing (Intervention)',
            'file-media-library' => '📁 Media Library (Spatie)',

            // Performance
            'perf-octane' => '⚡ Laravel Octane (10-50x faster)',

            // Payments (if SaaS)
            'payment-stripe' => '💳 Stripe Payments',
            'payment-paddle' => '💳 Paddle Payments',

            // Permissions
            'permissions' => '👮 Roles & Permissions (Spatie)',

            // Monitoring
            'monitoring-telescope' => '🔭 Telescope (dev)',
            'monitoring-pulse' => '📊 Pulse (prod)',
            'monitoring-sentry' => '🐛 Sentry (error tracking)',

            // AI (if selected)
            'ai-prism' => '🧠 Prism PHP (universal AI SDK)',
            'ai-vector' => '🔢 Vector DB (embeddings)',

            // Utilities
            'backup' => '💾 Automated Backups (Spatie)',
        ];

        // Smart filtering based on previous selections
        $filtered = $this->filterFeatures($features);

        return multiselect(
            label: 'Select additional features:',
            options: $filtered,
            hint: 'Space to select, Enter to continue. Smart defaults will be suggested.',
            required: false
        );
    }

    private function filterFeatures(array $features): array
    {
        $baseType = $this->selections['base_type'];
        $capabilities = $this->selections['capabilities'] ?? [];

        // Remove features that don't make sense
        $filtered = $features;

        // If not API/mobile, remove some auth options
        if (! in_array('mobile', $capabilities) && $baseType !== 'api') {
            unset($filtered['auth-sanctum']);
        }

        // If no real-time capability, remove websockets
        if (! in_array('real-time', $capabilities)) {
            unset($filtered['websockets-reverb']);
        }

        // If no AI capability, remove AI features
        if (! in_array('ai', $capabilities)) {
            unset($filtered['ai-prism'], $filtered['ai-vector']);
        }

        // If not SaaS, remove payments
        if (! in_array('saas', $capabilities)) {
            unset($filtered['payment-stripe'], $filtered['payment-paddle']);
        }

        // If microservice, remove heavy features
        if ($baseType === 'microservice') {
            unset(
                $filtered['file-intervention'],
                $filtered['file-media-library'],
                $filtered['monitoring-telescope'],
            );
        }

        return $filtered;
    }

    private function chooseInfrastructure(): array
    {
        $infra = [];

        // Database
        $infra['database'] = select(
            label: 'Database?',
            options: [
                'pgsql' => 'PostgreSQL (recommended)',
                'mysql' => 'MySQL',
                'sqlite' => 'SQLite (dev only)',
            ],
            default: 'pgsql'
        );

        // Cache
        $infra['cache'] = select(
            label: 'Cache?',
            options: [
                'redis' => 'Redis (recommended)',
                'memcached' => 'Memcached',
                'file' => 'File (simple)',
            ],
            default: 'redis'
        );

        // Queue
        $infra['queue'] = select(
            label: 'Queue?',
            options: [
                'redis' => 'Redis',
                'database' => 'Database',
                'sqs' => 'AWS SQS',
            ],
            default: 'redis'
        );

        // Storage
        $infra['storage'] = select(
            label: 'File Storage (production)?',
            options: [
                's3' => 'Amazon S3',
                'spaces' => 'DigitalOcean Spaces',
                'r2' => 'Cloudflare R2',
                'local' => 'Local only',
            ],
            default: 's3'
        );

        return $infra;
    }

    private function showSummary(): void
    {
        $this->newLine();
        $this->components->twoColumnDetail('<fg=yellow>📋 Configuration Summary</>');
        $this->newLine();

        $this->components->twoColumnDetail('Base Type', $this->selections['base_type']);
        $this->components->twoColumnDetail('Capabilities', implode(', ', $this->selections['capabilities'] ?? []));
        $this->components->twoColumnDetail('Features', count($this->selections['features'] ?? []).' selected');
        $this->components->twoColumnDetail('Database', $this->selections['infrastructure']['database']);
        $this->components->twoColumnDetail('Cache', $this->selections['infrastructure']['cache']);
        $this->components->twoColumnDetail('Queue', $this->selections['infrastructure']['queue']);
        $this->components->twoColumnDetail('Storage', $this->selections['infrastructure']['storage']);

        $this->newLine();
    }

    private function executeConfiguration(): void
    {
        $this->components->info('⚙️  Configuring application...');
        $this->newLine();

        // Get appropriate configurator based on base type
        $configurator = $this->getConfigurator($this->selections['base_type']);

        // Execute configuration
        $configurator->configure($this->selections);
    }

    private function getConfigurator(string $baseType): object
    {
        // Map base types to configurators
        $configuratorMap = [
            'api' => 'ApiConfigurator',
            'web' => 'WebConfigurator',
            'hybrid' => 'HybridConfigurator',
            'mobile-backend' => 'MobileBackendConfigurator',
            'microservice' => 'MicroserviceConfigurator',
            'saas' => 'SaasConfigurator',
            'ai-powered' => 'AiPoweredConfigurator',
            'mcp' => 'McpConfigurator',
        ];

        $configuratorName = $configuratorMap[$baseType] ?? str($baseType)->studly().'Configurator';
        $configuratorClass = 'App\\Setup\\Configurators\\'.$configuratorName;

        if (! class_exists($configuratorClass)) {
            $this->components->error("Configurator not found: {$configuratorClass}");
            $this->components->warn('Available: '.implode(', ', array_values($configuratorMap)));
            exit(1);
        }

        return new $configuratorClass($this);
    }

    private function displaySuccess(): void
    {
        $this->newLine();
        $this->components->info('✅ Setup Complete! 🎉');
        $this->newLine();

        $this->components->info('🚀 Next Steps:');
        $this->components->task('cp .env.example .env');
        $this->components->task('Edit .env with your credentials');
        $this->components->task('php artisan migrate');
        $this->components->task('composer run dev');

        $this->newLine();
    }
}
