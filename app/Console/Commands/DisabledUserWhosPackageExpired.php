<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DisabledUserWhosPackageExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user-disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Disabled whose package is expired.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::with('tenant')->ExpiredUsers()->get();
        if ($users->count()) {
            foreach ($users as $user) {

                $user->actioned = 1; // Taken Actioned plan is expired
                $user->status = 0;   // Check status is 0, 1,2
                $user->save();
                $tenant = $user->tenant;
                $tenant->update(['status' => 3]);
                // $tenant->save();
            }
            info('User expired today ' . $users->count());
        } else {
            info('No User expired today');
        }
        die();
    }
}