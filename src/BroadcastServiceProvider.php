<?php

namespace LaravelEnso\Notifications;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    private static string $channel;

    public function boot()
    {
        Broadcast::channel(
            $this->channel(),
            fn ($user, $id) => (int) $user->id === (int) $id
        );
    }

    private function channel()
    {
        return self::$channel ??= Collection::wrap(
            explode('\\', Config::get('auth.providers.users.model'))
        )->push('{id}')->implode('.');
    }
}
