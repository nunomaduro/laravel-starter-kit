<?php

declare(strict_types=1);

test('command is registered', function () {
    $commands = Artisan::all();

    expect($commands)->toHaveKey('app:configure');
});

test('can configure api application', function () {
    $this->artisan('app:configure --dry-run')
        ->expectsOutputToContain('🚀 Laravel Starter Kit - Interactive Setup')
        ->expectsOutputToContain('DRY RUN MODE - No changes will be made')
        ->expectsQuestion('What is the PRIMARY purpose of this application?', 'api')
        ->expectsQuestion('What capabilities does your application need?', ['mobile', 'ai'])
        ->expectsQuestion('Select additional features:', ['auth-sanctum', 'ai-prism'])
        ->expectsQuestion('Database?', 'pgsql')
        ->expectsQuestion('Cache?', 'redis')
        ->expectsQuestion('Queue?', 'redis')
        ->expectsQuestion('File Storage (production)?', 's3')
        ->expectsOutputToContain('📋 Configuration Summary')
        ->expectsConfirmation('Proceed with this configuration?', 'yes')
        ->expectsOutputToContain('✅ Setup Complete! 🎉')
        ->assertExitCode(0);
});

test('can configure web application', function () {
    $this->artisan('app:configure --dry-run')
        ->expectsQuestion('What is the PRIMARY purpose of this application?', 'web')
        ->expectsQuestion('What capabilities does your application need?', ['real-time'])
        ->expectsQuestion('Select additional features:', ['websockets-reverb', 'permissions'])
        ->expectsQuestion('Database?', 'mysql')
        ->expectsQuestion('Cache?', 'redis')
        ->expectsQuestion('Queue?', 'redis')
        ->expectsQuestion('File Storage (production)?', 's3')
        ->expectsConfirmation('Proceed with this configuration?', 'yes')
        ->assertExitCode(0);
});

test('can configure saas application', function () {
    $this->artisan('app:configure --dry-run')
        ->expectsQuestion('What is the PRIMARY purpose of this application?', 'saas')
        ->expectsQuestion('What capabilities does your application need?', ['web-app', 'saas'])
        ->expectsQuestion('Select additional features:', ['payment-stripe', 'permissions'])
        ->expectsQuestion('Database?', 'pgsql')
        ->expectsQuestion('Cache?', 'redis')
        ->expectsQuestion('Queue?', 'redis')
        ->expectsQuestion('File Storage (production)?', 's3')
        ->expectsConfirmation('Proceed with this configuration?', 'yes')
        ->assertExitCode(0);
});

test('can configure microservice application', function () {
    $this->artisan('app:configure --dry-run')
        ->expectsQuestion('What is the PRIMARY purpose of this application?', 'microservice')
        ->expectsQuestion('What capabilities does your application need?', ['real-time'])
        ->expectsQuestion('Select additional features:', ['perf-octane'])
        ->expectsQuestion('Database?', 'pgsql')
        ->expectsQuestion('Cache?', 'redis')
        ->expectsQuestion('Queue?', 'redis')
        ->expectsQuestion('File Storage (production)?', 'local')
        ->expectsConfirmation('Proceed with this configuration?', 'yes')
        ->assertExitCode(0);
});

test('can configure ai-powered application', function () {
    $this->artisan('app:configure --dry-run')
        ->expectsQuestion('What is the PRIMARY purpose of this application?', 'ai-powered')
        ->expectsQuestion('What capabilities does your application need?', ['ai'])
        ->expectsQuestion('Select additional features:', ['ai-prism', 'ai-vector'])
        ->expectsQuestion('Database?', 'pgsql')
        ->expectsQuestion('Cache?', 'redis')
        ->expectsQuestion('Queue?', 'redis')
        ->expectsQuestion('File Storage (production)?', 's3')
        ->expectsConfirmation('Proceed with this configuration?', 'yes')
        ->assertExitCode(0);
});

test('can configure mcp server', function () {
    $this->artisan('app:configure --dry-run')
        ->expectsQuestion('What is the PRIMARY purpose of this application?', 'mcp')
        ->expectsQuestion('What capabilities does your application need?', ['ai'])
        ->expectsQuestion('Select additional features:', ['ai-prism'])
        ->expectsQuestion('Database?', 'pgsql')
        ->expectsQuestion('Cache?', 'redis')
        ->expectsQuestion('Queue?', 'redis')
        ->expectsQuestion('File Storage (production)?', 'local')
        ->expectsConfirmation('Proceed with this configuration?', 'yes')
        ->assertExitCode(0);
});

test('can skip optional multiselect prompts', function () {
    $this->artisan('app:configure --dry-run')
        ->expectsQuestion('What is the PRIMARY purpose of this application?', 'api')
        ->expectsQuestion('What capabilities does your application need?', [])
        ->expectsQuestion('Select additional features:', [])
        ->expectsQuestion('Database?', 'pgsql')
        ->expectsQuestion('Cache?', 'redis')
        ->expectsQuestion('Queue?', 'redis')
        ->expectsQuestion('File Storage (production)?', 's3')
        ->expectsConfirmation('Proceed with this configuration?', 'yes')
        ->assertExitCode(0);
});

test('can cancel configuration at confirmation', function () {
    $this->artisan('app:configure --dry-run')
        ->expectsQuestion('What is the PRIMARY purpose of this application?', 'api')
        ->expectsQuestion('What capabilities does your application need?', [])
        ->expectsQuestion('Select additional features:', [])
        ->expectsQuestion('Database?', 'sqlite')
        ->expectsQuestion('Cache?', 'file')
        ->expectsQuestion('Queue?', 'database')
        ->expectsQuestion('File Storage (production)?', 'local')
        ->expectsConfirmation('Proceed with this configuration?', 'no')
        ->assertExitCode(0);
});

test('displays configuration summary', function () {
    $this->artisan('app:configure --dry-run')
        ->expectsQuestion('What is the PRIMARY purpose of this application?', 'api')
        ->expectsQuestion('What capabilities does your application need?', [])
        ->expectsQuestion('Select additional features:', [])
        ->expectsQuestion('Database?', 'pgsql')
        ->expectsQuestion('Cache?', 'redis')
        ->expectsQuestion('Queue?', 'redis')
        ->expectsQuestion('File Storage (production)?', 's3')
        ->expectsOutputToContain('📋 Configuration Summary')
        ->expectsOutputToContain('Base Type')
        ->expectsOutputToContain('Database')
        ->expectsOutputToContain('Cache')
        ->expectsOutputToContain('Queue')
        ->expectsOutputToContain('Storage')
        ->expectsConfirmation('Proceed with this configuration?', 'yes')
        ->assertExitCode(0);
});

test('displays next steps after completion', function () {
    $this->artisan('app:configure --dry-run')
        ->expectsQuestion('What is the PRIMARY purpose of this application?', 'api')
        ->expectsQuestion('What capabilities does your application need?', [])
        ->expectsQuestion('Select additional features:', [])
        ->expectsQuestion('Database?', 'pgsql')
        ->expectsQuestion('Cache?', 'redis')
        ->expectsQuestion('Queue?', 'redis')
        ->expectsQuestion('File Storage (production)?', 's3')
        ->expectsConfirmation('Proceed with this configuration?', 'yes')
        ->expectsOutputToContain('🚀 Next Steps:')
        ->expectsOutputToContain('cp .env.example .env')
        ->expectsOutputToContain('php artisan migrate')
        ->assertExitCode(0);
});
