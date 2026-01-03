<?php

use App\Jobs\PingProccess;
use App\Models\Site;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {
    Site::query()->chunkById(100, function ($sites) {
        foreach ($sites as $site) {
            PingProccess::dispatch($site);
        }
    });
})->everyFiveSeconds();