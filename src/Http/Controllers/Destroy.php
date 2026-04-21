<?php

namespace LaravelEnso\Notifications\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Routing\Controller;

class Destroy extends Controller
{
    public function __invoke(Request $request, DatabaseNotification $notification)
    {
        abort_unless(
            $notification->notifiable_id === $request->user()->getKey(),
            404
        );

        $notification->delete();
    }
}
