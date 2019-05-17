<?php

namespace LaravelEnso\Notifications\app\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Notifications\DatabaseNotification;

class Destroy extends Controller
{
    public function __invoke(DatabaseNotification $notification)
    {
        $notification->delete();
    }
}
