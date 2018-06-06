<?php

namespace LaravelEnso\Notifications\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index(Request $request, int $offset, int $paginate)
    {
        return $request->user()
            ->notifications()
            ->skip($offset)
            ->take($paginate)
            ->get();
    }

    public function getCount(Request $request)
    {
        return $request->user()
            ->unreadNotifications()
            ->count();
    }

    public function markAsRead(DatabaseNotification $notification)
    {
        return tap($notification)
            ->markAsRead();
    }

    public function markAllAsRead(Request $request)
    {
        $request->user()
            ->unreadNotifications
            ->markAsRead();
    }

    public function clearAll(Request $request)
    {
        $request->user()
            ->notifications()
            ->delete();
    }
}
