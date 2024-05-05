<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);
        // Tenant
        Permission::insert([
            ['name' => 'tenant_create', 'guard_name' => 'web'],
            ['name' => 'tenant_view', 'guard_name' => 'web'],
            ['name' => 'tenant_edit', 'guard_name' => 'web'],
            ['name' => 'tenant_delete', 'guard_name' => 'web'],
            ['name' => 'tenant_force_delete', 'guard_name' => 'web'],
            ['name' => 'tenant_restore', 'guard_name' => 'web'],
            ['name' => 'tenant_export:csv', 'guard_name' => 'web'],
            ['name' => 'tenant_export:pdf', 'guard_name' => 'web'],
            ['name' => 'tenant_export:excel', 'guard_name' => 'web'],
            // Plan
            ['name' => 'plan_create', 'guard_name' => 'web'],
            ['name' => 'plan_view', 'guard_name' => 'web'],
            ['name' => 'plan_edit', 'guard_name' => 'web'],
            ['name' => 'plan_delete', 'guard_name' => 'web'],
            ['name' => 'plan_force_delete', 'guard_name' => 'web'],
            ['name' => 'plan_restore', 'guard_name' => 'web'],
            ['name' => 'plan_export:csv', 'guard_name' => 'web'],
            ['name' => 'plan_export:pdf', 'guard_name' => 'web'],
            ['name' => 'plan_export:excel', 'guard_name' => 'web']

        ]);

        Role::insert([
            ['name' => 'ownerproduct', 'guard_name' => 'web']
        ]);
        $user->assignRole(['ownerproduct']);
        $permissions = Permission::get()->pluck('name')->toArray();
        $user->givePermissionTo($permissions);


        Plan::insert([
            ['name' => 'Plan1', 'price' => '1000', 'description' => 'description1', 'validity_month' => 12, 'status' => 1],
            ['name' => 'Plan2', 'price' => '2000', 'description' => 'description2', 'validity_month' => 24, 'status' => 1]

        ]);

        // $this->call([
        //     PermissionSeeder::class
        // ]);
    }
}