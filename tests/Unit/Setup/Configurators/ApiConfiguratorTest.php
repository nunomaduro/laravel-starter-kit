<?php

declare(strict_types=1);

use App\Setup\Configurators\ApiConfigurator;
use App\Setup\Contracts\ConfiguratorInterface;
use Illuminate\Console\Command;

test('implements configurator interface', function () {
    $command = mock(Command::class)->makePartial();
    $configurator = new ApiConfigurator($command);

    expect($configurator)->toBeInstanceOf(ConfiguratorInterface::class);
});

test('returns required packages', function () {
    $command = mock(Command::class)->makePartial();
    $configurator = new ApiConfigurator($command);

    $packages = $configurator->getRequiredPackages();

    expect($packages)
        ->toBeArray()
        ->toContain('laravel/sanctum');
});

test('returns recommended packages', function () {
    $command = mock(Command::class)->makePartial();
    $configurator = new ApiConfigurator($command);

    $packages = $configurator->getRecommendedPackages();

    expect($packages)->toBeArray();
});

test('returns optional packages', function () {
    $command = mock(Command::class)->makePartial();
    $configurator = new ApiConfigurator($command);

    $packages = $configurator->getOptionalPackages();

    expect($packages)
        ->toBeArray()
        ->toContain('dedoc/scramble')
        ->toContain('spatie/laravel-query-builder')
        ->toContain('league/fractal');
});

test('has configure method', function () {
    $command = mock(Command::class)->makePartial();
    $configurator = new ApiConfigurator($command);

    expect(method_exists($configurator, 'configure'))->toBeTrue();
});
