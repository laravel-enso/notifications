<?php

namespace LaravelEnso\Notifications;

use Illuminate\Support\ServiceProvider;

class NotificationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishesAll();
        $this->loadDependencies();
    }

    private function publishesAll()
    {
        $this->publishes([
            __DIR__.'/resources/assets/js/components' => resource_path('assets/js/vendor/laravel-enso/components'),
        ], 'notifications-component');

        $this->publishes([
            __DIR__.'/resources/assets/js/components' => resource_path('assets/js/vendor/laravel-enso/components'),
        ], 'enso-update');
    }

    public function loadDependencies()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-enso/notifications');
    }

    public function register()
    {
        //
    }
}
