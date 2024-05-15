<?php

namespace App\Jobs;

use App\Models\ScheduleMessageHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EmailOrSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $temp, public $user, public $template, public $loggedUser_id)
    {
        $this->user = $user;
        $this->temp = $temp;
        $this->template = $template;
        $this->loggedUser_id = $loggedUser_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        if ($this->template->template_type->value == 1)
            info($this->temp . 'SMS ');
        else if ($this->template->template_type->value == 0)
            info($this->temp . 'Email ');

        $history = [
            'is_sent' => now()->subSeconds(10),
            'sent_at' => now()->addSeconds(10),
            'receiver_id' => $this->user->id,
            'email_template_id' => $this->template->id,
            'user_id' => $this->loggedUser_id

        ];
        ScheduleMessageHistory::create($history);
    }
}
