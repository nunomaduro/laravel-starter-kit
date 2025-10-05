<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Application Types Package Requirements
    |--------------------------------------------------------------------------
    |
    | Define required, recommended, and optional packages for each application type.
    |
    */

    'application-types' => [
        'mobile-backend' => [
            'required' => ['laravel/sanctum'],
            'recommended' => ['laravel/reverb', 'intervention/image'],
            'optional' => ['spatie/laravel-permission', 'laravel/socialite', 'laravel/cashier-stripe'],
        ],

        'api-only' => [
            'required' => ['laravel/sanctum'],
            'recommended' => [],
            'optional' => ['dedoc/scramble', 'spatie/laravel-query-builder', 'league/fractal'],
        ],

        'microservice' => [
            'required' => [],
            'recommended' => ['laravel/octane'],
            'optional' => ['prometheus/client_php', 'grpc/grpc'],
        ],

        'saas' => [
            'required' => ['laravel/cashier-stripe', 'stancl/tenancy'],
            'recommended' => ['laravel/pennant', 'spatie/laravel-permission'],
            'optional' => ['laravel/horizon', 'laravel/nova'],
        ],

        'full-stack' => [
            'required' => ['inertiajs/inertia-laravel'],
            'recommended' => ['laravel/sanctum'],
            'optional' => ['spatie/laravel-permission', 'laravel/socialite'],
        ],

        'ai-powered' => [
            'required' => ['echolabsdev/prism'], // ✅ Prism PHP - Universal AI SDK
            'recommended' => ['pgvector/pgvector-php'], // Vector embeddings
            'optional' => ['predis/predis'], // Redis for caching AI responses
        ],

        'mcp-server' => [
            'required' => ['laravel/mcp'], // ✅ Laravel MCP official package
            'recommended' => [],
            'optional' => ['echolabsdev/prism'], // If AI tools needed
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Feature Packages
    |--------------------------------------------------------------------------
    |
    | Individual feature packages that can be added to any application type.
    |
    */

    'features' => [
        'authentication' => [
            'sanctum' => [
                'package' => 'laravel/sanctum',
                'version' => '^4.0',
                'config' => true,
                'migrations' => true,
                'middleware' => ['api' => ['auth:sanctum']],
            ],
            'passport' => [
                'package' => 'laravel/passport',
                'version' => '^13.0',
                'config' => true,
                'migrations' => true,
            ],
            'socialite' => [
                'package' => 'laravel/socialite',
                'version' => '^5.0',
                'config' => true,
            ],
        ],

        'real-time' => [
            'reverb' => [
                'package' => 'laravel/reverb',
                'version' => '^1.0',
                'config' => true,
                'requires' => ['broadcasting'],
            ],
            'pusher' => [
                'package' => 'pusher/pusher-php-server',
                'version' => '^7.0',
                'config' => true,
            ],
        ],

        'performance' => [
            'octane' => [
                'package' => 'laravel/octane',
                'version' => '^2.0',
                'config' => true,
                'options' => ['frankenphp', 'swoole', 'roadrunner'],
            ],
        ],

        'file-processing' => [
            'intervention' => [
                'package' => 'intervention/image',
                'version' => '^3.0',
                'config' => true,
            ],
            'media-library' => [
                'package' => 'spatie/laravel-medialibrary',
                'version' => '^11.0',
                'migrations' => true,
                'config' => true,
            ],
        ],

        'payments' => [
            'stripe' => [
                'package' => 'laravel/cashier-stripe',
                'version' => '^15.0',
                'migrations' => true,
                'config' => true,
            ],
            'paddle' => [
                'package' => 'laravel/cashier-paddle',
                'version' => '^2.0',
                'migrations' => true,
                'config' => true,
            ],
        ],

        'monitoring' => [
            'telescope' => [
                'package' => 'laravel/telescope',
                'version' => '^5.0',
                'config' => true,
                'migrations' => true,
                'env' => 'local',
            ],
            'pulse' => [
                'package' => 'laravel/pulse',
                'version' => '^1.0',
                'config' => true,
                'migrations' => true,
            ],
            'sentry' => [
                'package' => 'sentry/sentry-laravel',
                'version' => '^4.0',
                'config' => true,
            ],
        ],

        'permissions' => [
            'spatie' => [
                'package' => 'spatie/laravel-permission',
                'version' => '^6.0',
                'migrations' => true,
                'config' => true,
            ],
        ],

        'backup' => [
            'spatie-backup' => [
                'package' => 'spatie/laravel-backup',
                'version' => '^9.0',
                'config' => true,
            ],
        ],

        'ai' => [
            'prism' => [
                'package' => 'echolabsdev/prism', // ✅ Prism PHP
                'version' => '^0.1',
                'config' => true,
                'description' => 'Universal AI SDK - OpenAI, Claude, Gemini, Ollama',
            ],
            'vector-db' => [
                'package' => 'pgvector/pgvector-php',
                'version' => '^0.1',
                'description' => 'PostgreSQL vector embeddings for AI',
            ],
        ],

        'mcp' => [
            'laravel-mcp' => [
                'package' => 'laravel/mcp', // ✅ Laravel MCP official
                'version' => '^0.1',
                'config' => true,
                'description' => 'Model Context Protocol server for Laravel',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Native Laravel Commands
    |--------------------------------------------------------------------------
    |
    | Laravel provides install commands that set up features properly.
    | We should use these instead of manual package installation when available.
    |
    */

    'native-commands' => [
        'api' => [
            'command' => 'install:api',
            'description' => 'Install Sanctum/Passport + API routes',
            'options' => ['--passport' => 'Use Passport instead of Sanctum'],
        ],
        'broadcasting' => [
            'command' => 'install:broadcasting',
            'description' => 'Install broadcasting + reverb',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Package Dependencies
    |--------------------------------------------------------------------------
    |
    | Define dependencies between packages. When a package is installed,
    | its dependencies will also be installed.
    |
    */

    'dependencies' => [
        'laravel/reverb' => ['broadcasting'],
        'inertiajs/inertia-laravel' => ['laravel/sanctum'],
    ],
];
