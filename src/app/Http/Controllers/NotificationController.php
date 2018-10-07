<?php

namespace LaravelEnso\Notifications\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()
            ->notifications()
            ->skip($request->get('offset'))
            ->take($request->get('limit'))
            ->get();
    }

    public function count(Request $request)
    {
        return [
            'count' => $request->user()
                ->unreadNotifications()
                ->count(),
        ];
    }

    public function update(DatabaseNotification $notification)
    {
        return tap($notification)
            ->markAsRead();
    }

    public function updateAll(Request $request)
    {
        $request->user()
            ->unreadNotifications
            ->markAsRead();
    }

    public function destroy(DatabaseNotification $notification)
    {
        $notification->delete();
    }

    public function destroyAll(Request $request)
    {
        $request->user()
            ->notifications()
            ->delete();
    }
}
