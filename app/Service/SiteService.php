<?php

namespace App\Service;

use App\DTO\MainData;
use App\Models\Site;
use App\ValueObjects\DomainName;
use Illuminate\Support\Facades\Http;

class SiteService
{
    public function getData(Site $site): MainData
    {
        $domain = new DomainName($site->full_url);
        $response = Http::get($domain->getFullUrl());
        $mainData = MainData::createFromHttp($response);
        return $mainData;
    }
}