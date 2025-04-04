<?php

namespace LaravelEnso\Notifications;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Notifications\Commands\PurgeDeprecatedNotifications;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->commands(PurgeDeprecatedNotifications::class);
    }
}
