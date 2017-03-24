<?php

use Illuminate\Database\Migrations\Migration;
use LaravelEnso\Core\App\Classes\StructureManager\StructureSupport;

class CreateStructureForNotifications extends Migration
{
    use StructureSupport;

    private $permissionsGroup = [
        'name' => 'system.notifications', 'description' => 'Notifications Permissions Group',
    ];

    private $permissions = [
        ['name' => 'core.notifications.getCount', 'description' => 'Get Users Notifications Count', 'type' => 1],
        ['name' => 'core.notifications.getList', 'description' => 'Get Users Notifications List', 'type' => 0],
        ['name' => 'core.notifications.markAsRead', 'description' => 'Set All notifications as Read', 'type' => 0],
        ['name' => 'core.notifications.clearAll', 'description' => 'Clear all notifications', 'type' => 1],
    ];

    private $menu;
    private $parentMenu;
    private $roles;
}
