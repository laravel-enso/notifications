<?php

use LaravelEnso\Migrator\App\Database\Migration;
use LaravelEnso\Permissions\App\Enums\Types;

class CreateStructureForNotifications extends Migration
{
    protected $permissions = [
        ['name' => 'core.notifications.index', 'description' => 'Notifications index', 'type' => Types::Read, 'is_default' => true],
        ['name' => 'core.notifications.count', 'description' => 'Get users notifications count', 'type' => Types::Write, 'is_default' => true],
        ['name' => 'core.notifications.read', 'description' => 'Mark notification as read', 'type' => Types::Write, 'is_default' => true],
        ['name' => 'core.notifications.readAll', 'description' => 'Mark all notifications as read', 'type' => Types::Write, 'is_default' => true],
        ['name' => 'core.notifications.destroy', 'description' => 'Clear a notification', 'type' => Types::Write, 'is_default' => true],
        ['name' => 'core.notifications.destroyAll', 'description' => 'Clear all notifications', 'type' => Types::Write, 'is_default' => true],
    ];
}
