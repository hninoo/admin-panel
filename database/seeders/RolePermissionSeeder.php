<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        /**
         * Enable these options if you need same role and other permission for User Model
         * Else, please follow the below steps for admin guard
         */

        // Permission List as array
        $permissions = [
            [
                'group_name' => 'Dashboard',
                'permissions' => [
                    [
                        'name' => 'Dashboard',
                        'route' => 'dashboard'
                    ],
                ]
            ],
            [
                'group_name' => 'Admin',
                'permissions' => [
                    [
                        'name' => 'Admin View Button',
                        'route' => 'admins.index'
                    ],
                    [
                        'name' => 'Admin Add Button',
                        'route' => 'admins.create'
                    ],
                    [
                        'name' => 'Admin Add Action',
                        'route' => 'admins.store'
                    ],
                    [
                        'name' => 'Admin Update Button',
                        'route' => 'admins.edit'
                    ],
                    [
                        'name' => 'Admin Update Action',
                        'route' => 'admins.update'
                    ],
                    [
                        'name' => 'Admin Delete Button',
                        'route' => 'admins.destroy'
                    ]
                ]
            ],
            [
                'group_name' => 'Role',
                'permissions' => [
                    [
                        'name' => 'Role View Button',
                        'route' => 'roles.index'
                    ],
                    [
                        'name' => 'Role Add Button',
                        'route' => 'roles.create'
                    ],
                    [
                        'name' => 'Role Add Action',
                        'route' => 'roles.store'
                    ],
                    [
                        'name' => 'Role Update Button',
                        'route' => 'roles.edit'
                    ],
                    [
                        'name' => 'Role Update Action',
                        'route' => 'roles.update'
                    ],
                    [
                        'name' => 'Role Delete Button',
                        'route' => 'roles.destroy'
                    ]
                ]
            ],
            [
                'group_name' => 'User',
                'permissions' => [
                    [
                        'name' => 'User View Button',
                        'route' => 'users.index'
                    ],
                    [
                        'name' => 'User Add Button',
                        'route' => 'users.create'
                    ],
                    [
                        'name' => 'User Add Action',
                        'route' => 'users.store'
                    ],
                    [
                        'name' => 'User Update Button',
                        'route' => 'users.edit'
                    ],
                    [
                        'name' => 'User Update Action',
                        'route' => 'users.update'
                    ],
                    [
                        'name' => 'User Delete Button',
                        'route' => 'users.destroy'
                    ]
                ]
            ],
            [
                'group_name' => 'Log',
                'permissions' => [
                    [
                        'name' => 'Log View Button',
                        'route' => 'log.index'
                    ],
                ]
            ],
        ];

        // Do same for the admin guard for tutorial purposes
        $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);

        // Create and Assign Permissions
        foreach($permissions as $permission) {
            $permissionGroup = $permission['group_name'];
            foreach($permission['permissions'] as $per) {
                $permission = Permission::create(['name' => $per['route'], 'group_name' => $permissionGroup, 'alter_name' => $per['name'], 'guard_name' => 'admin']);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }

        // Assign super admin role permission to superadmin user
        $admin = Admin::where('username', 'superadmin')->first();
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }

        // assign admin gurad role
        DB::table('model_has_roles')->insert([
            [
                'role_id' => '1',
                'model_type' => 'App\\Models\\Admin',
                'model_id' => '1',
            ],
        ]);
    }
}
