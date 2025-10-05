<?php

declare(strict_types=1);

namespace App\Setup\Configurators;

use App\Setup\Contracts\ConfiguratorInterface;
use App\Setup\Services\PackageInstaller;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

use function Laravel\Prompts\select;

final class WebConfigurator implements ConfiguratorInterface
{
    private PackageInstaller $installer;

    public function __construct(
        private readonly Command $command
    ) {
        $this->installer = new PackageInstaller($command);
    }

    public function configure(array $selections): void
    {
        $this->command->components->info('🌐 Configuring Web Application...');
        $this->command->newLine();

        // Step 1: Choose frontend stack
        $frontend = $this->chooseFrontend();

        // Step 2: Install Inertia + chosen stack
        $this->installInertia($frontend);

        // Step 3: Install authentication
        $this->installAuth();

        // Step 4: Configure SSR if chosen
        if ($this->shouldEnableSsr()) {
            $this->enableSsr($frontend);
        }

        // Step 5: Setup frontend tooling
        $this->setupFrontend($frontend);

        $this->command->newLine();
        $this->command->components->info('✅ Web Application configured!');
        $this->command->newLine();
        $this->command->components->info('💡 Next: npm install && npm run dev');
    }

    public function getRequiredPackages(): array
    {
        return [
            'inertiajs/inertia-laravel',
        ];
    }

    public function getRecommendedPackages(): array
    {
        return [
            'laravel/sanctum', // For API auth if needed
        ];
    }

    public function getOptionalPackages(): array
    {
        return [
            'spatie/laravel-permission',
            'laravel/socialite',
        ];
    }

    private function chooseFrontend(): string
    {
        return select(
            label: 'Which frontend framework?',
            options: [
                'react' => 'React (recommended)',
                'vue' => 'Vue 3',
                'svelte' => 'Svelte',
            ],
            default: 'react'
        );
    }

    private function installInertia(string $frontend): void
    {
        $this->command->components->task('Installing Inertia.js', function () {
            $this->installer->install('inertiajs/inertia-laravel');

            return true;
        });

        $this->command->components->task("Setting up {$frontend} stack", function () use ($frontend) {
            // Install appropriate frontend package
            $packages = [
                'react' => '@inertiajs/react react react-dom',
                'vue' => '@inertiajs/vue3 vue@^3',
                'svelte' => '@inertiajs/svelte svelte',
            ];

            Process::run('npm install '.$packages[$frontend].' --save');

            return true;
        });

        $this->command->components->task('Publishing Inertia middleware', function () {
            $this->command->call('inertia:middleware');

            return true;
        });
    }

    private function installAuth(): void
    {
        $this->command->components->task('Installing Sanctum (API auth)', function () {
            $this->installer->runNativeCommand('install:api');

            return true;
        });
    }

    private function shouldEnableSsr(): bool
    {
        return false; // Can ask user later
    }

    private function enableSsr(string $frontend): void
    {
        $this->command->components->task('Enabling SSR', function () {
            // SSR setup differs by framework
            // This would configure SSR for production

            return true;
        });
    }

    private function setupFrontend(string $frontend): void
    {
        $this->command->components->task('Creating app.jsx/app.vue', function () use ($frontend) {
            $jsDir = resource_path('js');
            if (! is_dir($jsDir)) {
                mkdir($jsDir, 0755, true);
            }

            // Create main app file based on framework
            $appContent = $this->getAppTemplate($frontend);
            $extension = $frontend === 'react' ? 'jsx' : ($frontend === 'vue' ? 'vue' : 'svelte');

            file_put_contents($jsDir."/app.{$extension}", $appContent);

            return true;
        });

        $this->command->components->task('Updating vite.config.js', function () use ($frontend) {
            $viteConfig = base_path('vite.config.js');

            $plugin = match ($frontend) {
                'react' => "import react from '@vitejs/plugin-react';",
                'vue' => "import vue from '@vitejs/plugin-vue';",
                'svelte' => "import { svelte } from '@sveltejs/vite-plugin-svelte';",
            };

            $inputFile = match ($frontend) {
                'react' => 'resources/js/app.jsx',
                'vue' => 'resources/js/app.js',
                'svelte' => 'resources/js/app.js',
            };

            $pluginCall = $frontend;

            $content = <<<JS
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
{$plugin}

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', '{$inputFile}'],
            refresh: true,
        }),
        {$pluginCall}(),
    ],
});
JS;

            file_put_contents($viteConfig, $content);

            return true;
        });
    }

    private function getAppTemplate(string $frontend): string
    {
        return match ($frontend) {
            'react' => <<<'JSX'
import { createInertiaApp } from '@inertiajs/react'
import { createRoot } from 'react-dom/client'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true })
    return pages[`./Pages/${name}.jsx`]
  },
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />)
  },
})
JSX,
            'vue' => <<<'VUE'
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})
VUE,
            'svelte' => <<<'SVELTE'
import { createInertiaApp } from '@inertiajs/svelte'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.svelte', { eager: true })
    return pages[`./Pages/${name}.svelte`]
  },
  setup({ el, App, props }) {
    new App({ target: el, props })
  },
})
SVELTE,
        };
    }
}
