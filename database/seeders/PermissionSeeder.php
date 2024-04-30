<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['name' => 'user_create', 'guard_name' => 'web'],
            ['name' => 'user_view', 'guard_name' => 'web'],
            ['name' => 'user_edit', 'guard_name' => 'web'],
            ['name' => 'user_delete', 'guard_name' => 'web'],
            ['name' => 'user_force_delete', 'guard_name' => 'web'],
            ['name' => 'user_restore', 'guard_name' => 'web'],
            ['name' => 'user_export:csv', 'guard_name' => 'web'],
            ['name' => 'user_export:pdf', 'guard_name' => 'web'],
            ['name' => 'user_export:excel', 'guard_name' => 'web'],
            ['name' => 'manage_permissions', 'guard_name' => 'web'],
            // roles
            ['name' => 'roles_create', 'guard_name' => 'web'],
            ['name' => 'roles_view', 'guard_name' => 'web'],
            ['name' => 'roles_edit', 'guard_name' => 'web'],
            ['name' => 'roles_delete', 'guard_name' => 'web'],
            ['name' => 'roles_force_delete', 'guard_name' => 'web'],
            ['name' => 'roles_restore', 'guard_name' => 'web'],
            ['name' => 'roles_export:csv', 'guard_name' => 'web'],
            ['name' => 'roles_export:pdf', 'guard_name' => 'web'],
            ['name' => 'roles_export:excel', 'guard_name' => 'web'],

            // permission
            ['name' => 'permissions_create', 'guard_name' => 'web'],
            ['name' => 'permissions_view', 'guard_name' => 'web'],
            ['name' => 'permissions_edit', 'guard_name' => 'web'],
            ['name' => 'permissions_delete', 'guard_name' => 'web'],
            ['name' => 'permissions_force_delete', 'guard_name' => 'web'],
            ['name' => 'permissions_restore', 'guard_name' => 'web'],
            ['name' => 'permissions_export:csv', 'guard_name' => 'web'],
            ['name' => 'permissions_export:pdf', 'guard_name' => 'web'],
            ['name' => 'permissions_export:excel', 'guard_name' => 'web']



        ]);
        Role::insert([
            ['name' => 'SuperAdmin', 'guard_name' => 'web'],
            ['name' => 'Admin', 'guard_name' => 'web'],
            ['name' => 'User', 'guard_name' => 'web'],
            ['name' => 'Tester', 'guard_name' => 'web'],
            ['name' => 'Developer', 'guard_name' => 'web'],
            ['name' => 'Account', 'guard_name' => 'web']
        ]);
    }
}
