<?php

namespace LaravelEnso\Notifications;

use Illuminate\Support\ServiceProvider;

class NotificationsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'notifications');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'notifications-migration');

        $this->publishes([
            __DIR__.'/../resources/assets/js/components' => resource_path('assets/js/components/laravel-enso'),
        ], 'notifications-component');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-enso/notifications'),
        ], 'notifications-partial');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
