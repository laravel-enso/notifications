<?php

namespace LaravelEnso\Notifications\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Routing\Controller;

class Read extends Controller
{
    public function __invoke(DatabaseNotification $notification)
    {
        return tap($notification)->markAsRead();
    }
}
