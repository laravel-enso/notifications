<?php

namespace LaravelEnso\Notifications\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class NotificationsController extends Controller
{
    public function getCount()
    {
        return [
            'unread' => request()->user()->unreadNotifications->count(),
            'total'  => request()->user()->notifications->count(),
        ];
    }

    public function getList()
    {
        return request()->user()->notifications;
    }

    public function markAsRead()
    {
        request()->user()->unreadNotifications->markAsRead();

        return Carbon::now();
    }

    public function clearAll()
    {
        request()->user()->notifications()->delete();
    }
}
