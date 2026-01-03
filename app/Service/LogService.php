<?php

namespace App\Service;

use App\DTO\MainData;
use App\Models\Site;
use App\Models\SiteLog;
use Illuminate\Support\Facades\DB;

class LogService
{
    public function log(Site $site, MainData $mainData) {
        DB::transaction(function () use ($site, $mainData) {
            $log = $site->logs()->create([
                'status_code' => $mainData->status,
                'response_time' => data_get($mainData->handlerStats, 'total_time', 0),
            ]);
        
            DB::afterCommit(function () use ($log, $site, $mainData) {
                SiteLog::create([
                    'log_id' => $log->id,
                    'site_id' => $site->id,
                    'data' => $mainData->toArray(),
                ]);
            });
        });
    }
}