<?php

namespace App\Jobs;

use App\Models\ScheduleMessageHistory;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Throwable;


class EmailOrSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     */

    public $tries = 1;

    public  $historyobj;
    public function __construct(public $temp, public $user, public $template, public $loggedUser_id, public $campaign)
    {

        $this->user = $user;
        $this->temp = $temp;
        $this->template = $template;
        $this->loggedUser_id = $loggedUser_id;
        $this->campaign = $campaign;
        // $this->historyobj = null;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // throw new Exception("Error Processing Request", 1);

        if ($this->template->template_type->value == 1)
            info($this->temp . 'SMS ');
        else if ($this->template->template_type->value == 0)
            info($this->temp . 'Email ');

        // For sending email or SMS
        ScheduleMessageHistory::where('job_id', $this->job->getJobId())->update(['sent' => 'Y', 'message' => $this->temp]);
        echo $this->job->getJobId();
    }

    public function failed(Exception $e)
    {


        // Avaialble Functions
        // https://github.com/illuminate/queue/blob/master/Jobs/DatabaseJob.php
        Queue::failing(function (JobFailed $event) {
            // $event->connectionName
            // $event->job
            // echo "<pre>";
            // $data  = $event->job->payload()['data']['command'];

            ScheduleMessageHistory::where('job_id', $event->job->getJobRecord()->id)->update(['sent' => 'N', 'message' => 'Not sent to user']);



            // $event->exception
        });

        // Perform actions with the job ID (e.g., sending a notification)
    }

    // public function fail(Throwable $ex)
    // {
    //     dd($this->historyobj);
    //     $uuid = $this->historyobj->job_id;

    //     info("Job UUID: " . $uuid);


    //     // dd($this->template->title);
    //     // try {
    //     //     Log::debug('MyNotification failed');
    //     // } catch (Exception $e) {
    //     //     Log::debug($e->getMessage());
    //     // }
    // }
}
