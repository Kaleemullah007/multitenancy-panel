<?php

namespace Database\Seeders\Tenant;

use App\Models\Placeholder;
use App\Models\Setting;
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
            ['name' => 'user_export_csv', 'guard_name' => 'web'],
            ['name' => 'user_export_pdf', 'guard_name' => 'web'],
            ['name' => 'user_export_excel', 'guard_name' => 'web'],
            ['name' => 'user_import_csv', 'guard_name' => 'web'],

            ['name' => 'manage_permissions', 'guard_name' => 'web'],
            // roles
            ['name' => 'roles_create', 'guard_name' => 'web'],
            ['name' => 'roles_view', 'guard_name' => 'web'],
            ['name' => 'roles_edit', 'guard_name' => 'web'],
            ['name' => 'roles_delete', 'guard_name' => 'web'],
            ['name' => 'roles_force_delete', 'guard_name' => 'web'],
            ['name' => 'roles_restore', 'guard_name' => 'web'],
            ['name' => 'roles_export_csv', 'guard_name' => 'web'],
            ['name' => 'roles_export_pdf', 'guard_name' => 'web'],
            ['name' => 'roles_export_excel', 'guard_name' => 'web'],
            ['name' => 'roles_import_csv', 'guard_name' => 'web'],

            // permissions
            ['name' => 'permissions_create', 'guard_name' => 'web'],
            ['name' => 'permissions_view', 'guard_name' => 'web'],
            ['name' => 'permissions_edit', 'guard_name' => 'web'],
            ['name' => 'permissions_delete', 'guard_name' => 'web'],
            ['name' => 'permissions_force_delete', 'guard_name' => 'web'],
            ['name' => 'permissions_restore', 'guard_name' => 'web'],
            ['name' => 'permissions_export_csv', 'guard_name' => 'web'],
            ['name' => 'permissions_export_pdf', 'guard_name' => 'web'],
            ['name' => 'permissions_export_excel', 'guard_name' => 'web'],
            ['name' => 'permissions_import_csv', 'guard_name' => 'web'],


            // Placeholders
            ['name' => 'placeholders_create', 'guard_name' => 'web'],
            ['name' => 'placeholders_view', 'guard_name' => 'web'],
            ['name' => 'placeholders_edit', 'guard_name' => 'web'],
            ['name' => 'placeholders_delete', 'guard_name' => 'web'],
            ['name' => 'placeholders_force_delete', 'guard_name' => 'web'],
            ['name' => 'placeholders_restore', 'guard_name' => 'web'],
            ['name' => 'placeholders_export_csv', 'guard_name' => 'web'],
            ['name' => 'placeholders_export_pdf', 'guard_name' => 'web'],
            ['name' => 'placeholders_export_excel', 'guard_name' => 'web'],
            ['name' => 'placeholders_import_csv', 'guard_name' => 'web'],



            // emailtemplate_templates
            ['name' => 'emailtemplates_create', 'guard_name' => 'web'],
            ['name' => 'emailtemplates_view', 'guard_name' => 'web'],
            ['name' => 'emailtemplates_edit', 'guard_name' => 'web'],
            ['name' => 'emailtemplates_delete', 'guard_name' => 'web'],
            ['name' => 'emailtemplates_force_delete', 'guard_name' => 'web'],
            ['name' => 'emailtemplates_restore', 'guard_name' => 'web'],
            ['name' => 'emailtemplates_export_csv', 'guard_name' => 'web'],
            ['name' => 'emailtemplates_export_pdf', 'guard_name' => 'web'],
            ['name' => 'emailtemplates_export_excel', 'guard_name' => 'web'],
            ['name' => 'emailtemplates_import_csv', 'guard_name' => 'web'],


            // email or sms  schedule
            ['name' => 'emailtemplates_schedule', 'guard_name' => 'web'],
            ['name' => 'sms_schedule', 'guard_name' => 'web'],



            // Campaign message
            ['name' => 'campaigns_create', 'guard_name' => 'web'],
            ['name' => 'campaigns_view', 'guard_name' => 'web'],
            ['name' => 'campaigns_edit', 'guard_name' => 'web'],
            ['name' => 'campaigns_delete', 'guard_name' => 'web'],
            ['name' => 'campaigns_force_delete', 'guard_name' => 'web'],
            ['name' => 'campaigns_restore', 'guard_name' => 'web'],
            ['name' => 'campaigns_export_csv', 'guard_name' => 'web'],
            ['name' => 'campaigns_export_pdf', 'guard_name' => 'web'],
            ['name' => 'campaigns_export_excel', 'guard_name' => 'web'],
            ['name' => 'campaigns_import_csv', 'guard_name' => 'web'],
            ['name' => 'campaigns_secdule_message', 'guard_name' => 'web'],



        ]);
        Role::insert([
            ['name' => 'SuperAdmin', 'guard_name' => 'web'],
            ['name' => 'Admin', 'guard_name' => 'web'],
            ['name' => 'User', 'guard_name' => 'web'],
            ['name' => 'Tester', 'guard_name' => 'web'],
            ['name' => 'Developer', 'guard_name' => 'web'],
            ['name' => 'Account', 'guard_name' => 'web']
        ]);

        Setting::insert([
            ['name' => 't1', 'setting_type' => 'timezone', 'value' => 'Asia/Karachi'],
            ['name' => 't2', 'setting_type' => 'timezone', 'value' => 'America/Lima'],
            ['name' => 't3', 'setting_type' => 'timezone', 'value' => 'Asia/Dubai'],


            ['name' => 'd1', 'setting_type' => 'date_format', 'value' => 'Y-m-d'],
            ['name' => 'd2', 'setting_type' => 'date_format', 'value' => 'Y/m/d'],
            ['name' => 'd3', 'setting_type' => 'date_format', 'value' => 'Y:m:y'],
            ['name' => 'd4', 'setting_type' => 'date_format', 'value' => 'd/m/Y'],
            ['name' => 'd5', 'setting_type' => 'date_format', 'value' => 'd-m-Y'],
            ['name' => 'd6', 'setting_type' => 'date_format', 'value' => 'd:m:Y'],
        ]);

        Placeholder::insert([
            ['name' => 'Full Name', 'key_name' => '{full_name}', 'status' => 1],
            ['name' => 'Phone', 'key_name' => '{phone}', 'status' => 1],
            ['name' => 'Contact Email', 'key_name' => '{contact_email}', 'status' => 1],
            ['name' => 'Contact Phone', 'key_name' => '{contact_phone}', 'status' => 1],
            ['name' => 'Contact website', 'key_name' => '{contact_website}', 'status' => 1],
            ['name' => 'First Name', 'key_name' => '{first_name}', 'status' => 1],
            ['name' => 'Last Name', 'key_name' => '{last_name}', 'status' => 1],
            ['name' => 'Logo Link', 'key_name' => '{logo_link}', 'status' => 1],
            ['name' => 'Website', 'key_name' => '{website}', 'status' => 1],
            ['name' => 'Contact us Link', 'key_name' => '{contact_us_link}', 'status' => 1],
            ['name' => 'Message Link', 'key_name' => '{message}', 'status' => 1],
            ['name' => 'Header Heading', 'key_name' => '{header_heading}', 'status' => 1],
            ['name' => 'Footer Message', 'key_name' => '{footer_message}', 'status' => 1],

        ]);
    }
}
