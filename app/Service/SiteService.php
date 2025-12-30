<?php

namespace App\Service;

use App\DTO\MainData;
use App\Models\Site;
use App\ValueObjects\DomainName;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class SiteService
{
    public function getData(Site $site): MainData
    {
        try {
            $domain = new DomainName($site->full_url);
            $response = Http::timeout(5)->get($domain->getFullUrl());
            $mainData = MainData::createFromHttp($response);
            return $mainData;
        } catch (\Throwable $e) {
            return new MainData(
                successful: false,
                status: 0,
                failed: true,
                serverError: true,
                reason: '',
                handlerStats: [],
                effectiveUri: null,
                redirect: false,
                headers: [],
            );
        }
    }
}