<?php

namespace LaravelEnso\Notifications\app\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Notifications\DatabaseNotification;

class Read extends Controller
{
    public function __invoke(DatabaseNotification $notification)
    {
        return tap($notification)
            ->markAsRead();
    }
}
