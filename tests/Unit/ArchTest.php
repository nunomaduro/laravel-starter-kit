<?php

declare(strict_types=1);

arch()->preset()->php();
arch()->preset()->strictWithoutProtectedMethods();
arch()->preset()->security();

arch('controllers')
    ->expect('App\Http\Controllers')
    ->not->toBeUsed();

//
