<?php

namespace App\Services\Compaign;

use App\Jobs\EmailOrSmsJob;
use App\Models\Placeholder;
use App\Models\ScheduleMessageHistory;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class changeTemplateContent
{

    // Set Queue for sending email and sms to users

    public function prepareData($template, $data, $campaign)
    {

        $startTime = Carbon::parse($data['published_at']);
        $finishTime = Carbon::parse(now());
        $totalDuration = (int)$finishTime->diffInSeconds($startTime);
        $users = User::whereHas("roles", function ($q) use ($data) {
            $q->Where(function ($query)  use ($data) {

                if (in_array('All', $data['user_type'])) {

                    $query->whereIn("name", Role::all()->pluck('name'));
                } else {
                    $query->whereIn("name", $data['user_type']);
                }
            });
        })->where('status', 1)->get();

        $this->changeMessage($template, $users, $totalDuration, $campaign);
        return true;
    }

    // Change placeholders to Acutally Values of user details
    public function changeMessage($template, $users, $totalDuration, $campaign)
    {


        $placeholders = Placeholder::where('status', 1)->get();

        foreach ($users as $user) {
            $temp = $template->body;
            foreach ($placeholders as $placeholder) {



                if ($placeholder->key_name == '{first_name}')
                    $temp = str_replace($placeholder->key_name, $user->name, $temp);
                else if ($placeholder->key_name == '{last_name}')
                    $temp = str_replace($placeholder->key_name, $user->name, $temp);
                else if ($placeholder->key_name == '{contact_phone}')
                    $temp = str_replace($placeholder->key_name, $user->name, $temp);
                else if ($placeholder->key_name == '{website}')
                    $temp = str_replace($placeholder->key_name, $user->name, $temp);
                else if ($placeholder->key_name == '{contact_us_link}')
                    $temp = str_replace($placeholder->key_name, $user->name, $temp);
                else if ($placeholder->key_name == '{logo_link}')
                    $temp = str_replace($placeholder->key_name, $user->name, $temp);
                else if ($placeholder->key_name == '{message}')
                    $temp = str_replace($placeholder->key_name, $user->name, $temp);
                else if ($placeholder->key_name == '{footer_message}')
                    $temp = str_replace($placeholder->key_name, $user->name, $temp);
                else if ($placeholder->key_name == '{header_heading}')
                    $temp = str_replace($placeholder->key_name, $user->name, $temp);
                else if ($placeholder->key_name == '{full_name}')
                    $temp = str_replace($placeholder->key_name, $user->name, $temp);
            }

            // $id =  dispatch(new EmailOrSmsJob($temp, $user, $template, auth()->id(), $campaign))->delay(Carbon::now()->addSeconds($totalDuration));


            $job = (new EmailOrSmsJob($temp, $user, $template, auth()->id(), $campaign))->delay($totalDuration);
            $job_id =  app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch($job);
            $this->campaignHistory($totalDuration, $user, $template, auth()->id(), $campaign, $job_id);

            // $id  = EmailOrSmsJob::dispatch($temp, $user, $template, auth()->id(), $campaign)->delay(Carbon::now()->addSeconds($totalDuration))->getJobId();
        }
    }


    function campaignHistory($totalDuration,  $user,  $template,  $loggedUser_id,  $campaign, $job_id)
    {

        $history = [
            'is_sent' => now()->subSeconds($totalDuration),
            'sent_at' => now()->addSeconds($totalDuration),
            'receiver_id' => $user->id,
            'email_template_id' => $template->id,
            'user_id' => $loggedUser_id,
            'job_id' => $job_id,
            'campaign_id' => $campaign->id,
            'sent' => 'N'

        ];

        return ScheduleMessageHistory::create($history);
    }

    protected function dummyTemplate(): string
    {
        return '
        Hello : {full_name}
        <br> Firstname: {first_name} <br>
        Last Name: {last_name}
        <br>
        Contact Phone: {contact_phone}
        <br>
        website : {website}
        <br>
        contact_us_link : {contact_us_link}
        <br>

        logo-link : {logo_link}
        <br>
        message : {message}
        <br>
        footer-message : {footer_message}
        <br>
        header-heading: {header_heading}
        ';
    }
}
