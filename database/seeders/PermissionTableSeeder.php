<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $userPermissions = [
            // Role Permissions
            'role_management_permissions_for_admin_users' => [
                ['name' => 'view.user.role', 'display_name' => 'View Role', 'guard_name' => 'admin-user', 'key_name' => 'role'],
                ['name' => 'create.user.role', 'display_name' => 'Create Role', 'guard_name' => 'admin-user', 'key_name' => 'role'],
                ['name' => 'edit.user.role', 'display_name' => 'Edit Role', 'guard_name' => 'admin-user', 'key_name' => 'role'],
                ['name' => 'delete.user.role', 'display_name' => 'Delete Role', 'guard_name' => 'admin-user', 'key_name' => 'role'],
                ['name' => 'export.user.role', 'display_name' => 'Export Roles', 'guard_name' => 'admin-user', 'key_name' => 'role'],
            ],

            // Designation Permissions
            'designation_permissions_for_admin_users' => [
                ['name' => 'view.user.designation', 'display_name' => 'View Designation', 'guard_name' => 'admin-user', 'key_name' => 'designation'],
                ['name' => 'create.user.designation', 'display_name' => 'Create Designation', 'guard_name' => 'admin-user', 'key_name' => 'designation'],
                ['name' => 'edit.user.designation', 'display_name' => 'Edit Designation', 'guard_name' => 'admin-user', 'key_name' => 'designation'],
                ['name' => 'delete.user.designation', 'display_name' => 'Delete Designation', 'guard_name' => 'admin-user', 'key_name' => 'designation'],
                ['name' => 'export.user.designation', 'display_name' => 'Export Designation', 'guard_name' => 'admin-user', 'key_name' => 'designation'],
            ],

            // User Permissions
            'user_management_permissions_for_admin_users' => [
                ['name' => 'view.user', 'display_name' => 'View User', 'guard_name' => 'admin-user', 'key_name' => 'user'],
                ['name' => 'create.user', 'display_name' => 'Create User', 'guard_name' => 'admin-user', 'key_name' => 'user'],
                ['name' => 'edit.user', 'display_name' => 'Edit User', 'guard_name' => 'admin-user', 'key_name' => 'user'],
                ['name' => 'delete.user', 'display_name' => 'Delete User', 'guard_name' => 'admin-user', 'key_name' => 'user'],
                ['name' => 'export.user', 'display_name' => 'Export Users', 'guard_name' => 'admin-user', 'key_name' => 'user'],
                ['name' => 'switch.user.portal', 'display_name' => 'Switch User Portal', 'guard_name' => 'admin-user', 'key_name' => 'user'],
            ],
        ];

        foreach ($userPermissions as $permissions) {

            foreach ($permissions as $permission) {

                Permission::firstOrCreate($permission);

            }
        }
    }
}
