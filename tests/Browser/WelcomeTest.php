<?php

declare(strict_types=1);

it('has login page', function (): void {
    $page = visit('/auth/login');

    $page->assertSee('Login');
});
