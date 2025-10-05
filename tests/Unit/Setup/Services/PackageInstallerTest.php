<?php

declare(strict_types=1);

use App\Setup\Services\PackageInstaller;
use Illuminate\Console\Command;

test('can be instantiated', function () {
    $command = mock(Command::class)->makePartial();
    $installer = new PackageInstaller($command);

    expect($installer)->toBeInstanceOf(PackageInstaller::class);
});

test('has install method', function () {
    $command = mock(Command::class)->makePartial();
    $installer = new PackageInstaller($command);

    expect(method_exists($installer, 'install'))->toBeTrue();
});

test('has runNativeCommand method', function () {
    $command = mock(Command::class)->makePartial();
    $installer = new PackageInstaller($command);

    expect(method_exists($installer, 'runNativeCommand'))->toBeTrue();
});

test('has publishConfig method', function () {
    $command = mock(Command::class)->makePartial();
    $installer = new PackageInstaller($command);

    expect(method_exists($installer, 'publishConfig'))->toBeTrue();
});

test('has runMigrations method', function () {
    $command = mock(Command::class)->makePartial();
    $installer = new PackageInstaller($command);

    expect(method_exists($installer, 'runMigrations'))->toBeTrue();
});
