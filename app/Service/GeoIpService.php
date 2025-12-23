<?php

namespace App\Service;

use GeoIp2\Database\Reader;

class GeoIpService
{
    private Reader $reader;
    private string $dbPath;

    public function __construct(?string $dbPath = null)
    {
        $this->dbPath = $dbPath ?? env('GEOIP2_DB_PATH', storage_path('app/GeoIP2-City.mmdb'));
        if (!is_file($this->dbPath)) {
            throw new \InvalidArgumentException("GeoIP2 database not found at {$this->dbPath}");
        }
        $this->reader = new Reader($this->dbPath, ['ru', 'en']);
    }

    public function lookup(string $ip): array
    {
        $record = $this->reader->city($ip);

        return [
            'ip' => $record->traits->ipAddress ?? $ip,
            'continent_name' => $record->continent->name,
            'country_name' => $record->country->name,
            'country_geoname_id' => $record->country->geonameId,
            'subdivision_name' => $record->mostSpecificSubdivision->name,
            'subdivision_geoname_id' => $record->mostSpecificSubdivision->geonameId,
            'city_name' => $record->city->name,
            'city_geoname_id' => $record->city->geonameId,
            'postal_code' => $record->postal->code,
            'latitude' => $record->location->latitude,
            'longitude' => $record->location->longitude,
            'time_zone' => $record->location->timeZone,
            'accuracy_radius' => $record->location->accuracyRadius,
            'network' => $record->traits->network,
        ];
    }
}

