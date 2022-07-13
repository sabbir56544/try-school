<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            [
                'group_name' => 'Dashboard',
                'permissions' => [
                    'dashboard-view',
                ]
            ],
            [
                'group_name' => 'Roles',
                'permissions' => [
                    'role-management',
                ]
            ],
            [
                'group_name' => 'Roles',
                'permissions' => [
                    'role-create',
                    'role-list',
                    'role-edit',
                    'role-delete',
                ]
            ],
            [
                'group_name' => 'Permissions',
                'permissions' => [
                    'permission-list',
                    'permission-create',
                    'permission-edit',
                    'permission-delete',
                ]
            ],
            [
                'group_name' => 'Users',
                'permissions' => [
                    'user-list',
                    'user-create',
                    'user-edit',
                    'user-delete',
                ]
            ],
        ];


        $roleSuperAdmin = Role::create(['name' => 'Super Admin']);
        $roleUser = Role::create(['name' => 'User']);


        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup, 'guard_name' => 'web']);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }

        // Assign super admin role permission to superadmin user
        $admin = User::where('email', 'superadmin@gmail.com')->first();
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }
    }
}