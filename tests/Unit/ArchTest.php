<?php

declare(strict_types=1);

arch()->preset()->php();
arch()->preset()->strict()->ignoring([
    // Laravel 12's casts() + scopeXxx() are designed as protected methods.
    // The strict preset's "no protected methods" rule conflicts.
    'App\Models',
]);
arch()->preset()->security()->ignoring([
    'assert',
]);

arch('controllers')
    ->expect('App\Http\Controllers')
    ->not->toBeUsed();
