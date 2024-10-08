<?php

namespace App\Console\Commands;

use App\Mail\StatusNotification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Days7ReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reminder-7';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Your package is going to expire after 7 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::select(['id', 'email', 'name'])->addSelect(DB::raw("DATEDIFF(`end_date`, `start_date`) AS date_difference"))
            ->groupBy('id', 'email', 'name', DB::raw("DATEDIFF(`end_date`, `start_date`)"))
            ->havingRaw('date_difference = 7')
            ->get();

        foreach ($users as $user) {

            $day = 7;
            Mail::to($user->email)->send(new StatusNotification($user, $day));
            // info('Your package is going to expire after 7 days ' . $user->name);
        }
    }
}