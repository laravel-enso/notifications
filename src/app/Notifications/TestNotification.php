<?php

namespace LaravelEnso\Notifications\app\Notifications;

use Illuminate\Notifications\Notification;

class TestNotification extends Notification
{
    public function __construct($body)
    {
        $this->body = $body;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'body' => $this->body,
        ];
    }
}
