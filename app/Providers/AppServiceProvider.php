<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->bootPasswordDefaults();
    }

    /**
     * @codeCoverageIgnore
     */
    private function bootPasswordDefaults(): void
    {
        if ($this->app->isProduction()) {
            Password::defaults(fn () => Password::min(12)->max(255)->uncompromised());
        }
    }
}
