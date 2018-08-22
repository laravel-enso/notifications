<?php

namespace LaravelEnso\Notifications\app\Commands;

use Illuminate\Console\Command;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;

class AddMissingPermission extends Command
{
    private const Permission = 'core.notifications.index';

    protected $signature = 'enso:notifications:add-missing-permission';

    protected $description = 'Add permission for notifications index';

    public function handle()
    {
        if (Permission::whereName(self::Permission)->first() !== null) {
            $this->info('The `'.self::Permission.'` permission was already added');

            return;
        }

        $permission = Permission::create([
            'permission_group_id' => PermissionGroup::whereName('core.notifications')
                                        ->first()->id,
            'name' => self::Permission,
            'description' => 'Write role configuration file',
            'type' => 1,
            'is_default' => true,
        ]);

        $permission->roles()->attach(Role::pluck('id'));

        $this->info('The `'.self::Permission.'` permission was successfully added');
    }
}
