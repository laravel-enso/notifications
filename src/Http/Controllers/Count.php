<?php

namespace LaravelEnso\Notifications\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Count extends Controller
{
    public function __invoke(Request $request)
    {
        return ['count' => $request->user()->unreadNotifications()->count()];
    }
}
