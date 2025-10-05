<?php

declare(strict_types=1);

namespace App\Setup\Configurators;

use App\Setup\Contracts\ConfiguratorInterface;
use App\Setup\Services\PackageInstaller;
use Illuminate\Console\Command;

use function Laravel\Prompts\multiselect;

final class AiPoweredConfigurator implements ConfiguratorInterface
{
    private PackageInstaller $installer;

    public function __construct(
        private readonly Command $command
    ) {
        $this->installer = new PackageInstaller($command);
    }

    public function configure(array $selections): void
    {
        $this->command->components->info('🤖 Configuring AI-Powered Application...');
        $this->command->newLine();

        // Step 1: Choose base (API or Web)
        $baseType = $selections['base_type'] ?? 'api';
        if ($baseType === 'web') {
            $webConfig = new WebConfigurator($this->command);
            $webConfig->configure($selections);
        } else {
            $apiConfig = new ApiConfigurator($this->command);
            $apiConfig->configure($selections);
        }

        $this->command->newLine();

        // Step 2: Install Prism PHP (universal AI SDK)
        $this->installPrism();

        // Step 3: Choose AI providers
        $providers = $this->chooseAiProviders();
        $this->configureProviders($providers);

        // Step 4: Install vector database if needed
        if ($this->needsVectorDb($selections)) {
            $this->installVectorDb();
        }

        // Step 5: Create example AI actions
        $this->createExampleActions();

        // Step 6: Setup rate limiting for AI calls
        $this->setupAiRateLimiting();

        $this->command->newLine();
        $this->command->components->info('✅ AI-Powered Application configured!');
    }

    public function getRequiredPackages(): array
    {
        return [
            'echolabsdev/prism', // Universal AI SDK
        ];
    }

    public function getRecommendedPackages(): array
    {
        return [
            'pgvector/pgvector-php', // Vector embeddings
        ];
    }

    public function getOptionalPackages(): array
    {
        return [
            'predis/predis', // Redis for caching AI responses
        ];
    }

    private function installPrism(): void
    {
        $this->command->components->task('Installing Prism PHP', function () {
            $this->installer->install('echolabsdev/prism');

            return true;
        });
    }

    private function chooseAiProviders(): array
    {
        return multiselect(
            label: 'Which AI providers to configure?',
            options: [
                'openai' => 'OpenAI (GPT-4, GPT-3.5)',
                'anthropic' => 'Anthropic (Claude)',
                'google' => 'Google (Gemini)',
                'ollama' => 'Ollama (Local LLMs)',
            ],
            default: ['openai', 'anthropic'],
            hint: 'Prism supports all of these with the same API'
        );
    }

    private function configureProviders(array $providers): void
    {
        $this->command->components->task('Configuring AI providers', function () use ($providers) {
            $envPath = base_path('.env.example');
            $envContent = file_exists($envPath) ? file_get_contents($envPath) : '';

            $envAdditions = "\n# AI Configuration\n";

            foreach ($providers as $provider) {
                $envAdditions .= match ($provider) {
                    'openai' => "OPENAI_API_KEY=your-openai-key\n",
                    'anthropic' => "ANTHROPIC_API_KEY=your-anthropic-key\n",
                    'google' => "GOOGLE_API_KEY=your-google-key\n",
                    'ollama' => "OLLAMA_URL=http://localhost:11434\n",
                    default => '',
                };
            }

            file_put_contents($envPath, $envContent.$envAdditions);

            return true;
        });
    }

    private function needsVectorDb(array $selections): bool
    {
        // Check if embeddings/vector search capability is selected
        return in_array('vector-search', $selections['features'] ?? []);
    }

    private function installVectorDb(): void
    {
        $this->command->components->task('Installing pgvector (PostgreSQL extension)', function () {
            $this->installer->install('pgvector/pgvector-php');

            // Add instructions for enabling pgvector
            $this->command->warn('⚠️  Remember to enable pgvector extension in PostgreSQL:');
            $this->command->line('   CREATE EXTENSION IF NOT EXISTS vector;');

            return true;
        });
    }

    private function createExampleActions(): void
    {
        $this->command->components->task('Creating example AI actions', function () {
            $actionsDir = app_path('Actions/AI');
            if (! is_dir($actionsDir)) {
                mkdir($actionsDir, 0755, true);
            }

            // Create ChatWithAI action
            $chatAction = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\Actions\AI;

use EchoLabs\Prism\Prism;

final readonly class ChatWithAI
{
    public function execute(string $message, string $provider = 'anthropic'): string
    {
        $response = Prism::text()
            ->using($provider, 'claude-3-5-sonnet-20241022')
            ->withPrompt($message)
            ->generate();

        return $response->text;
    }
}
PHP;

            file_put_contents($actionsDir.'/ChatWithAI.php', $chatAction);

            // Create GenerateEmbedding action
            $embeddingAction = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\Actions\AI;

use EchoLabs\Prism\Prism;

final readonly class GenerateEmbedding
{
    public function execute(string $text): array
    {
        $response = Prism::embeddings()
            ->using('openai', 'text-embedding-3-small')
            ->fromText($text)
            ->generate();

        return $response->embeddings[0]->embedding;
    }
}
PHP;

            file_put_contents($actionsDir.'/GenerateEmbedding.php', $embeddingAction);

            return true;
        });
    }

    private function setupAiRateLimiting(): void
    {
        $this->command->components->task('Setting up AI rate limiting', function () {
            // Add rate limiting for AI endpoints
            $apiRoutes = base_path('routes/api.php');

            if (file_exists($apiRoutes)) {
                $rateLimiting = <<<'PHP'

// AI endpoints with strict rate limiting
Route::middleware(['auth:sanctum', 'throttle:10,1'])->prefix('ai')->group(function () {
    Route::post('/chat', function (Request $request) {
        $response = app(\App\Actions\AI\ChatWithAI::class)
            ->execute($request->input('message'));

        return response()->json(['response' => $response]);
    });
});

PHP;

                file_put_contents($apiRoutes, $rateLimiting, FILE_APPEND);
            }

            return true;
        });
    }
}
