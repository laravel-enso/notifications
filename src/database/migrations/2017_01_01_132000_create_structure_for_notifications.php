<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForNotifications extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'core.notifications', 'description' => 'Notifications permissions group',
    ];

    protected $permissions = [
        ['name' => 'core.notifications.index', 'description' => 'Notifications index', 'type' => 0, 'is_default' => true],
        ['name' => 'core.notifications.getCount', 'description' => 'Get users notifications count', 'type' => 1, 'is_default' => true],
        ['name' => 'core.notifications.getList', 'description' => 'Get users notifications list', 'type' => 0, 'is_default' => true],
        ['name' => 'core.notifications.markAsRead', 'description' => 'Mark notification as read', 'type' => 1, 'is_default' => true],
        ['name' => 'core.notifications.markAllAsRead', 'description' => 'Mark all notifications as read', 'type' => 1, 'is_default' => true],
        ['name' => 'core.notifications.clear', 'description' => 'Clear a notification', 'type' => 1, 'is_default' => true],
        ['name' => 'core.notifications.clearAll', 'description' => 'Clear all notifications', 'type' => 1, 'is_default' => true],
    ];
}
