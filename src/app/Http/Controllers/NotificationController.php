<?php

namespace LaravelEnso\Notifications\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index(int $offset, int $paginate)
    {
        return request()->user()->notifications()
            ->skip($offset)
            ->take($paginate)
            ->get();
    }

    public function getCount()
    {
        return request()->user()->unreadNotifications()->count();
    }

    public function markAsRead(DatabaseNotification $notification)
    {
        return tap($notification)->markAsRead();
    }

    public function markAllAsRead()
    {
        request()->user()->unreadNotifications->markAsRead();
    }

    public function clearAll()
    {
        request()->user()->notifications()->delete();
    }
}
