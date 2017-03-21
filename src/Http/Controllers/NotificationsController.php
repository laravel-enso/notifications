<?php

namespace LaravelEnso\Notifications\Http\Controllers;

use App\Http\Controllers\Controller;
use Jenssegers\Date\Date;

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

        return Date::now();
    }

    public function clearAll()
    {
        request()->user()->notifications()->delete();
    }
}
