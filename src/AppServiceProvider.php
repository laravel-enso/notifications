<?php

namespace LaravelEnso\Notifications;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Notifications\app\Commands\AddMissingPermission;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            AddMissingPermission::class,
        ]);

        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/resources/assets/js' => resource_path('assets/js'),
        ], 'notifications-assets');

        $this->publishes([
            __DIR__.'/resources/assets/js' => resource_path('assets/js'),
        ], 'enso-assets');
    }

    public function register()
    {
        //
    }
}
