<?php

declare(strict_types=1);

use App\Setup\Configurators\AiPoweredConfigurator;
use App\Setup\Configurators\ApiConfigurator;
use App\Setup\Configurators\HybridConfigurator;
use App\Setup\Configurators\McpConfigurator;
use App\Setup\Configurators\MicroserviceConfigurator;
use App\Setup\Configurators\MobileBackendConfigurator;
use App\Setup\Configurators\SaasConfigurator;
use App\Setup\Configurators\WebConfigurator;
use App\Setup\Contracts\ConfiguratorInterface;
use Illuminate\Console\Command;

dataset('configurators', [
    'ApiConfigurator' => [ApiConfigurator::class],
    'WebConfigurator' => [WebConfigurator::class],
    'HybridConfigurator' => [HybridConfigurator::class],
    'MobileBackendConfigurator' => [MobileBackendConfigurator::class],
    'MicroserviceConfigurator' => [MicroserviceConfigurator::class],
    'SaasConfigurator' => [SaasConfigurator::class],
    'AiPoweredConfigurator' => [AiPoweredConfigurator::class],
    'McpConfigurator' => [McpConfigurator::class],
]);

test('all configurators implement ConfiguratorInterface', function (string $configuratorClass) {
    $command = mock(Command::class)->makePartial();
    $configurator = new $configuratorClass($command);

    expect($configurator)->toBeInstanceOf(ConfiguratorInterface::class);
})->with('configurators');

test('all configurators have getRequiredPackages method that returns array', function (string $configuratorClass) {
    $command = mock(Command::class)->makePartial();
    $configurator = new $configuratorClass($command);

    expect($configurator->getRequiredPackages())->toBeArray();
})->with('configurators');

test('all configurators have getRecommendedPackages method that returns array', function (string $configuratorClass) {
    $command = mock(Command::class)->makePartial();
    $configurator = new $configuratorClass($command);

    expect($configurator->getRecommendedPackages())->toBeArray();
})->with('configurators');

test('all configurators have getOptionalPackages method that returns array', function (string $configuratorClass) {
    $command = mock(Command::class)->makePartial();
    $configurator = new $configuratorClass($command);

    expect($configurator->getOptionalPackages())->toBeArray();
})->with('configurators');

test('all configurators have configure method', function (string $configuratorClass) {
    $command = mock(Command::class)->makePartial();
    $configurator = new $configuratorClass($command);

    expect(method_exists($configurator, 'configure'))->toBeTrue();
})->with('configurators');

test('ApiConfigurator has correct required packages', function () {
    $command = mock(Command::class)->makePartial();
    $configurator = new ApiConfigurator($command);

    expect($configurator->getRequiredPackages())
        ->toContain('laravel/sanctum');
});

test('WebConfigurator has correct required packages', function () {
    $command = mock(Command::class)->makePartial();
    $configurator = new WebConfigurator($command);

    expect($configurator->getRequiredPackages())
        ->toContain('inertiajs/inertia-laravel');
});

test('MicroserviceConfigurator has correct recommended packages', function () {
    $command = mock(Command::class)->makePartial();
    $configurator = new MicroserviceConfigurator($command);

    expect($configurator->getRecommendedPackages())
        ->toContain('laravel/octane');
});

test('AiPoweredConfigurator has correct required packages', function () {
    $command = mock(Command::class)->makePartial();
    $configurator = new AiPoweredConfigurator($command);

    expect($configurator->getRequiredPackages())
        ->toContain('echolabsdev/prism');
});

test('McpConfigurator has correct required packages', function () {
    $command = mock(Command::class)->makePartial();
    $configurator = new McpConfigurator($command);

    expect($configurator->getRequiredPackages())
        ->toContain('laravel/mcp');
});

test('SaasConfigurator has correct required packages', function () {
    $command = mock(Command::class)->makePartial();
    $configurator = new SaasConfigurator($command);

    expect($configurator->getRequiredPackages())
        ->toContain('stancl/tenancy')
        ->toContain('laravel/cashier-stripe');
});

test('MobileBackendConfigurator has correct required packages', function () {
    $command = mock(Command::class)->makePartial();
    $configurator = new MobileBackendConfigurator($command);

    expect($configurator->getRequiredPackages())
        ->toContain('laravel/sanctum');

    expect($configurator->getRecommendedPackages())
        ->toContain('intervention/image');
});

test('HybridConfigurator has correct required packages', function () {
    $command = mock(Command::class)->makePartial();
    $configurator = new HybridConfigurator($command);

    expect($configurator->getRequiredPackages())
        ->toContain('inertiajs/inertia-laravel')
        ->toContain('laravel/sanctum');
});
