<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Sleep;
use Illuminate\Support\Str;
use Tests\TestCase;

pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->beforeEach(function (): void {
        Str::createRandomStringsNormally();
        Str::createUuidsNormally();
        Http::preventStrayRequests();
        Process::preventStrayProcesses();
        Sleep::fake();

        $this->freezeTime();
    })
    ->in('Browser', 'Feature', 'Unit');

expect()->extend('toBeOne', fn () => $this->toBe(1));

pest()->presets()->custom('strictWithoutProtectedMethods', function (array $userNamespaces): array {
    return [
        ...array_map(fn (string $namespace): Pest\Arch\Contracts\ArchExpectation => expect($namespace)->toUseStrictTypes(), $userNamespaces),
        ...array_map(fn (string $namespace): Pest\Arch\Contracts\ArchExpectation => expect($namespace)->toUseStrictEquality(), $userNamespaces),
        ...array_map(fn (string $namespace): Pest\Arch\Contracts\ArchExpectation => expect($namespace)->classes()->not->toBeAbstract(), $userNamespaces),
        ...array_map(fn (string $namespace): Pest\Arch\Contracts\ArchExpectation => expect($namespace)->classes()->toBeFinal(), $userNamespaces),
        expect(['sleep', 'usleep'])->not->toBeUsed(),
    ];
});

function something(): void
{
    // ..
}
