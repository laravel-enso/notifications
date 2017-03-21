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
            __DIR__.'/../resources/assets/js/components/core' => base_path('resources/assets/js/components/core'),
        ], 'notifications-component');

        $this->publishes([
            __DIR__.'/../resources/views/partials' => base_path('resources/views/partials'),
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
