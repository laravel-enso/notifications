<?php

namespace LaravelEnso\Notifications;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Broadcast::channel($this->channel(), function ($user, $id) {
            return (int) $user->id === (int) $id;
        });
    }

    private function channel()
    {
        return collect(
            explode('\\', config('auth.providers.users.model'))
        )->push('{id}')->implode('.');
    }
}
