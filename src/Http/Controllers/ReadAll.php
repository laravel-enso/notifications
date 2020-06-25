<?php

namespace LaravelEnso\Notifications\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReadAll extends Controller
{
    public function __invoke(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();
    }
}
