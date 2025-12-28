<?php

namespace App\Service;

use App\DTO\MainData;
use App\Models\Log;
use App\Models\Site;
use App\ValueObjects\DomainName;
use Illuminate\Support\ItemNotFoundException;

class LogService
{
    public function log(MainData $response) {
        // dd($response);
        $url = $response->handlerStats['url'];
        // dd($url);
        $pureDomain = (new DomainName($url))->getBaseUrl();
        // TODO: добавить pureDomain в таблицу, где будет отекать разный вид одного url
        $site = Site::where('url', $url)->first();
        if (!$site) throw new ItemNotFoundException("Not found url: $url");
        // $siteId;
        //TODO: добавить логирование(логгер не должен создавать записи - только логировать/выводить ошибки)
        // $newLog = new Log;
        // // $newLog->
        // Log::add();
    }
}