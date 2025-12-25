<?php

declare(strict_types=1);

it('has welcome page', function (): void {
    $page = visit('/auth/login');

    $page->assertSee('Login');
});
