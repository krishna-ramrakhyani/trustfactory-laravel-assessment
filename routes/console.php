<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Runs every day at 23:00 (11 PM)
Schedule::job(new \App\Jobs\DailySalesReportJob)->dailyAt('23:00');
