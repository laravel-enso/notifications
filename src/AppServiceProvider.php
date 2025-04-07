<?php

namespace LaravelEnso\Notifications;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use LaravelEnso\Notifications\Commands\PurgeDeprecatedNotifications;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load()
            ->publish()
            ->command();
    }

    private function load(): self
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        return $this;
    }

    private function publish(): self
    {
        $this->publishes([
            __DIR__.'/../config' => config_path('enso'),
        ], ['notifications-config', 'enso-config']);

        return $this;
    }

    private function command()
    {
        $this->commands(PurgeDeprecatedNotifications::class);

        $days = Config::get('enso.notifications.purge.maxDays');

        $this->app->booted(fn () => $this->app->make(Schedule::class)
            ->command("enso:purge:notifications {$days}")->daily());
    }
}
