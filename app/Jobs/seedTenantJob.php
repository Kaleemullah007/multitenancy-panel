<?php

namespace App\Jobs;

use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class seedTenantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $tenant;
    public function __construct(Tenant $tenant)
    {
        $this->tenant  = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // for admin each tenant
        $this->tenant->run(function () {
            $user = User::create([
                'name' => $this->tenant->name,
                'email' => $this->tenant->email,
                'password' => $this->tenant->password,
                'file' => $this->tenant->file,
                'status' => true
            ]);
            $user->assignRole(['admin']);
            $permissions = Permission::get()->pluck('name')->toArray();
            $user->syncPermissions($permissions);

            // for super admin each tenant
            $user = User::create([
                'name' => 'Super admin',
                'email' => 'kadinumber804imrankhan@gmail.com', // Super admin
                'password' => 'password',  //
                'status' => true
            ]);
            $user->assignRole(['SuperAdmin']);
            $permissions = Permission::get()->pluck('name')->toArray();
            $user->syncPermissions($permissions);
        });
    }
}
