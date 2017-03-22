<?php

use LaravelEnso\Core\Models\Role;
use Illuminate\Database\Migrations\Migration;
use LaravelEnso\Core\Models\Permission;
use LaravelEnso\Core\Models\PermissionsGroup;

class InsertPermissionsForNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissionsGroup = PermissionsGroup::whereName('core.notifications')->first();

        if ($permissionsGroup) {
            return;
        }

        \DB::transaction(function () {
            $permissionsGroup = new PermissionsGroup([
                'name'        => 'core.notifications',
                'description' => 'Notifications Permissions Group',
            ]);

            $permissionsGroup->save();

            $permissions = [
                [
                    'name'        => 'core.notifications.getCount',
                    'description' => 'Set All notifications as Read',
                    'type'        => 1,
                ],
                [
                    'name'        => 'core.notifications.getList',
                    'description' => 'Get Users Notifications Count',
                    'type'        => 0,
                ],
                [
                    'name'        => 'core.notifications.markAsRead',
                    'description' => 'Get Users Notifications List',
                    'type'        => 0,
                ],
                [
                    'name'        => 'core.notifications.setIsRead',
                    'description' => 'Set Notifications as Read',
                    'type'        => 1,
                ],
            ];

            $adminRole = Role::whereName('admin')->first();

            foreach ($permissions as $permission) {
                $permission = new Permission($permission);
                $permissionsGroup->permissions()->save($permission);
                $adminRole->permissions()->save($permission);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::transaction(function () {
            $permissionsGroup = PermissionsGroup::whereName('core.notifications')->first();
            $permissionsGroup->permissions->each->delete();
            $permissionsGroup->delete();
        });
    }
}
