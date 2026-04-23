<?php

namespace LaravelEnso\Notifications\Commands;

use Illuminate\Console\Command;
use LaravelEnso\Notifications\Jobs\PurgeDeprecatedNotifications as Job;

class PurgeDeprecatedNotifications extends Command
{
    protected $signature = 'enso:purge:notifications {days}';

    protected $description = 'Purge deprecated notifications';

    public function handle()
    {
        Job::dispatch($this->argument('days'));
    }
}
