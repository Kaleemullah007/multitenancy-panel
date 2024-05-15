<?php

namespace App\Services\Compaign;

use App\Jobs\EmailOrSmsJob;
use App\Models\Placeholder;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class changeTemplateContent
{
    /**
     * Create a new class instance.
     */
    // public function __construct()
    // {
    //     //
    // }

    public function prepareData($template, $data)
    {

        // dd($data['published_at']);
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

        // foreach ($users as $user) {
        //     // $user->givePermissionTo([$request->name]);
        // }

        $this->changeMessage($template, $users, $totalDuration);
        return true;
    }
    public function changeMessage($template, $users, $totalDuration)
    {

        // $template = "Hello : {full_name} <br> Firstname: {first_name} <br>
        // Last Name: {last_name}
        // <br>
        // Contact Phone: {contact_phone}
        // <br>
        // website : {website}
        // <br>
        // contact_us_link : {contact_us_link}
        // <br>

        // logo-link : {logo_link}
        // <br>
        // message : {message}
        // <br>
        // footer-message : {footer_message}
        // <br>
        // header-heading: {header_heading}
        // <br>


        // ";

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

            dispatch(new EmailOrSmsJob($temp, $user, $template, auth()->id()))->delay(Carbon::now()->addSeconds($totalDuration));;
        }
    }
}
