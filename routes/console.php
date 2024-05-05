<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();



Schedule::command('make:user-disable')->everyMinute()->at('23:59');
Schedule::command('user:reminder-1')->daily()->at('23:59');
Schedule::command('user:reminder-7')->weekly()->sundays()->at("23:59");
Schedule::command('user:reminder-15')->weekly()->mondays()
    ->when(function () {
        return date('W') % 2;
    })->at("23:59");
Schedule::command('user:reminder-30')->monthly();