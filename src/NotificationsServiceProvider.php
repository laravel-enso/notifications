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
        $this->publishesAll();

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-enso/notifications');
    }

    private function publishesAll()
    {
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'notifications-migrations');

        $this->publishes([
            __DIR__.'/resources/assets/js/components' => resource_path('assets/js/vendor/laravel-enso/components'),
        ], 'notifications-component');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/laravel-enso/notifications'),
        ], 'notifications-view');

        $this->publishes([
            __DIR__.'/resources/assets/js/components' => resource_path('assets/js/vendor/laravel-enso/components'),
        ], 'update');
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
