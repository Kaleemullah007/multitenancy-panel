<?php

namespace App\Jobs;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stancl\Tenancy\Exceptions\TenantDatabaseDoesNotExistException;

class UpdateTenantJob implements ShouldQueue
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
        $database = $this->tenant->database()->getName();
        if (!$this->tenant->database()->manager()->databaseExists($this->tenant->tenancy_db_name)) {

            info('No database created Yet' .  $database);
        } else {
            $this->tenant->run(function () {
                $user = User::where('email', $this->tenant->email)->first();
                if (!is_null($user)) {

                    $user->update([
                        'password' => $this->tenant->password,
                        'status' => $this->tenant->status,
                        'name' => $this->tenant->name,
                    ]);
                }
            });
        }
    }
}