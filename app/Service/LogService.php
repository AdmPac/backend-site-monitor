<?php

namespace App\Service;

use App\DTO\MainData;
use App\Models\Log;
use App\Models\Site;

class LogService
{
    public function log(Site $site, MainData $mainData) {
        $site->logs()->create([
            'status_code' => $mainData->status,
            'response_time' => $mainData->handlerStats['total_time'],
        ]);
        // TODO: Добавить json в MongoDB
    }
}