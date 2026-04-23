<?php

namespace LaravelEnso\Notifications\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PurgeDeprecatedNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private int $days)
    {
        $this->queue = 'heavy';
    }

    public function handle()
    {
        DatabaseNotification::query()
            ->where('created_at', '<', Carbon::now()->subDays($this->days))
            ->delete();
    }
}
