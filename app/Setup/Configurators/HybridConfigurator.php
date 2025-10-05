<?php

declare(strict_types=1);

namespace App\Setup\Configurators;

use App\Setup\Contracts\ConfiguratorInterface;
use App\Setup\Services\PackageInstaller;
use Illuminate\Console\Command;

final class HybridConfigurator implements ConfiguratorInterface
{
    private PackageInstaller $installer;

    private WebConfigurator $webConfigurator;

    private ApiConfigurator $apiConfigurator;

    public function __construct(
        private readonly Command $command
    ) {
        $this->installer = new PackageInstaller($command);
        $this->webConfigurator = new WebConfigurator($command);
        $this->apiConfigurator = new ApiConfigurator($command);
    }

    public function configure(array $selections): void
    {
        $this->command->components->info('🔄 Configuring Hybrid Application (API + Web)...');
        $this->command->newLine();

        // Step 1: Configure Web (Inertia + frontend)
        $this->command->components->info('📱 Setting up Web Application...');
        $this->webConfigurator->configure($selections);

        $this->command->newLine();

        // Step 2: Ensure API routes are present (Web configurator includes Sanctum)
        $this->command->components->info('🔌 Ensuring API routes...');
        $this->ensureApiRoutes();

        // Step 3: Configure API versioning
        $this->setupApiVersioning();

        // Step 4: Configure CORS for both web and external API clients
        $this->configureCors();

        $this->command->newLine();
        $this->command->components->info('✅ Hybrid Application configured!');
        $this->command->newLine();
        $this->command->components->info('💡 You have:');
        $this->command->components->task('Web app (Inertia) on /');
        $this->command->components->task('API on /api/v1');
    }

    public function getRequiredPackages(): array
    {
        return [
            'inertiajs/inertia-laravel',
            'laravel/sanctum',
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
            'spatie/laravel-query-builder',
        ];
    }

    private function ensureApiRoutes(): void
    {
        $this->command->components->task('Creating API routes', function () {
            $apiRoutesPath = base_path('routes/api.php');

            if (! file_exists($apiRoutesPath)) {
                $apiRoutes = <<<'PHP'
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});

PHP;

                file_put_contents($apiRoutesPath, $apiRoutes);
            }

            return true;
        });
    }

    private function setupApiVersioning(): void
    {
        $this->command->components->task('Setting up API versioning', function () {
            // Create v1 directory
            $v1Dir = app_path('Http/Controllers/Api/V1');
            if (! is_dir($v1Dir)) {
                mkdir($v1Dir, 0755, true);
            }

            // Create example controller
            $exampleController = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class ExampleController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'version' => 'v1',
            'message' => 'API is working!',
        ]);
    }
}
PHP;

            file_put_contents($v1Dir.'/ExampleController.php', $exampleController);

            return true;
        });
    }

    private function configureCors(): void
    {
        $this->command->components->task('Configuring CORS', function () {
            $corsPath = config_path('cors.php');

            if (file_exists($corsPath)) {
                $content = file_get_contents($corsPath);

                // Allow both web app and external API clients
                $content = str_replace(
                    "'paths' => ['api/*', 'sanctum/csrf-cookie'],",
                    "'paths' => ['api/*', 'sanctum/csrf-cookie', 'broadcasting/auth'],",
                    $content
                );

                file_put_contents($corsPath, $content);
            }

            return true;
        });
    }
}
