<?php

namespace LaravelEnso\Notifications\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Index extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->user()
            ->notifications()
            ->skip($request->get('offset'))
            ->take($request->get('paginate'))
            ->get();
    }
}
