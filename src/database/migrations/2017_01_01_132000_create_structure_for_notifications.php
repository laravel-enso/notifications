<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForNotifications extends StructureMigration
{
    protected $permissions = [
        ['name' => 'core.notifications.index', 'description' => 'Notifications index', 'type' => 0, 'is_default' => true],
        ['name' => 'core.notifications.count', 'description' => 'Get users notifications count', 'type' => 1, 'is_default' => true],
        ['name' => 'core.notifications.update', 'description' => 'Mark notification as read', 'type' => 1, 'is_default' => true],
        ['name' => 'core.notifications.updateAll', 'description' => 'Mark all notifications as read', 'type' => 1, 'is_default' => true],
        ['name' => 'core.notifications.destroy', 'description' => 'Clear a notification', 'type' => 1, 'is_default' => true],
        ['name' => 'core.notifications.destroyAll', 'description' => 'Clear all notifications', 'type' => 1, 'is_default' => true],
    ];
}
