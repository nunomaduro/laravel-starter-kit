<?php

declare(strict_types=1);

namespace App\Setup\Configurators;

use App\Setup\Contracts\ConfiguratorInterface;
use App\Setup\Services\PackageInstaller;
use Illuminate\Console\Command;

final class McpConfigurator implements ConfiguratorInterface
{
    private PackageInstaller $installer;

    public function __construct(
        private readonly Command $command
    ) {
        $this->installer = new PackageInstaller($command);
    }

    public function configure(array $selections): void
    {
        $this->command->components->info('🔧 Configuring MCP Server...');
        $this->command->newLine();

        // Step 1: Install Laravel MCP
        $this->installMcp();

        // Step 2: Remove ALL web/API code (MCP only needs console)
        $this->removeHttpCode();

        // Step 3: Add AI tools if selected
        if ($this->hasCapability($selections, 'ai')) {
            $this->installAiTools();
        }

        // Step 4: Create example MCP tools
        $this->createExampleTools();

        $this->command->newLine();
        $this->command->components->info('✅ MCP Server ready!');
        $this->command->newLine();
        $this->command->components->info('💡 Test with: php artisan mcp:serve');
    }

    public function getRequiredPackages(): array
    {
        return [
            'laravel/mcp', // Official Laravel MCP
        ];
    }

    public function getRecommendedPackages(): array
    {
        return [];
    }

    public function getOptionalPackages(): array
    {
        return [
            'echolabsdev/prism', // If AI tools needed
        ];
    }

    private function installMcp(): void
    {
        $this->command->components->task('Installing Laravel MCP', function () {
            $this->installer->install('laravel/mcp');

            // Publish MCP config
            $this->command->call('vendor:publish', [
                '--provider' => 'Laravel\Mcp\McpServiceProvider',
            ]);

            return true;
        });
    }

    private function removeHttpCode(): void
    {
        $this->command->components->task('Removing web routes', function () {
            if (file_exists(base_path('routes/web.php'))) {
                unlink(base_path('routes/web.php'));
            }

            return true;
        });

        $this->command->components->task('Removing API routes', function () {
            if (file_exists(base_path('routes/api.php'))) {
                unlink(base_path('routes/api.php'));
            }

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

        $this->command->components->task('Updating bootstrap/app.php', function () {
            $bootstrapPath = base_path('bootstrap/app.php');
            $content = file_get_contents($bootstrapPath);

            // Remove web and API routing
            $content = preg_replace(
                "/->withRouting\((.*?)\)/s",
                '->withRouting(
        commands: __DIR__.\'/../routes/console.php\',
    )',
                $content
            );

            file_put_contents($bootstrapPath, $content);

            return true;
        });
    }

    private function installAiTools(): void
    {
        $this->command->components->task('Installing Prism PHP (AI tools)', function () {
            $this->installer->install('echolabsdev/prism');

            return true;
        });
    }

    private function createExampleTools(): void
    {
        $this->command->components->task('Creating example MCP tools', function () {
            // MCP tools will be auto-discovered by Laravel MCP
            // Example: app/Mcp/Tools/ExampleTool.php

            $toolsDir = app_path('Mcp/Tools');
            if (! is_dir($toolsDir)) {
                mkdir($toolsDir, 0755, true);
            }

            $exampleTool = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\Mcp\Tools;

use Laravel\Mcp\Tool;

class ExampleTool extends Tool
{
    public string $name = 'example_tool';

    public string $description = 'An example MCP tool';

    public function execute(array $arguments): array
    {
        return [
            'message' => 'Hello from MCP!',
            'arguments' => $arguments,
        ];
    }
}
PHP;

            file_put_contents($toolsDir.'/ExampleTool.php', $exampleTool);

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
