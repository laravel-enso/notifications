<?php

use LaravelEnso\Core\app\Classes\StructureManager\StructureMigration;

class CreateStructureForNotifications extends StructureMigration
{
    protected $permissionsGroup = [
        'name' => 'core.notifications', 'description' => 'Notifications Permissions Group',
    ];

    protected $permissions = [
        ['name' => 'core.notifications.getCount', 'description' => 'Get Users Notifications Count', 'type' => 1, 'default' => true],
        ['name' => 'core.notifications.getList', 'description' => 'Get Users Notifications List', 'type' => 0, 'default' => true],
        ['name' => 'core.notifications.markAsRead', 'description' => 'Mark notification as Read', 'type' => 1, 'default' => true],
        ['name' => 'core.notifications.markAllAsRead', 'description' => 'Marl All notifications as Read', 'type' => 1, 'default' => true],
        ['name' => 'core.notifications.clearAll', 'description' => 'Clear all notifications', 'type' => 1, 'default' => true]
    ];
}
