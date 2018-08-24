<?php

namespace LaravelEnso\Notifications\app\Commands;

use Illuminate\Console\Command;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;

class AddMissingPermissions extends Command
{
    private const Permissions = [
        'core.notifications.index', 'core.notifications.clear',
    ];

    protected $signature = 'enso:notifications:add-missing-permissions';

    protected $description = 'Add permissions for notifications index & notification clear';

    public function handle()
    {
        collect(self::Permissions)->each(function ($permission) {
            $this->create($permission);
        });
    }

    public function create($permission)
    {
        if (Permission::whereName($permission)->first() !== null) {
            $this->info('The `'.$permission.'` permission was already added');

            return;
        }

        $permission = Permission::create([
            'permission_group_id' => PermissionGroup::whereName('core.notifications')
                                        ->first()->id,
            'name' => $permission,
            'description' => 'Write role configuration file',
            'type' => 1,
            'is_default' => true,
        ]);

        $permission->roles()->attach(Role::pluck('id'));

        $this->info('The `'.$permission->name.'` permission was successfully added');
    }
}
