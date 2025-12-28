<?php

namespace App\DTO;

readonly class TimeResponse
{
    public function __construct(
        public float $totalTimeMs, // общее время запроса
        public float $dnsTimeMs, // время DNS-запроса
        public float $connectionTimeMs, // время соединения
        public float $sslHandshakeMs, // время SSL-handshake
        public float $ttfbMs, // время до первого байта
        public int $downloadSizeBytes, // размер загруженных данных
        public string $ip // IP-адрес сервера
    ) {}

    public static function fromHandlerStats(array $handlerStats): self
    {
        return new self(
            totalTimeMs: round($handlerStats['total_time'] * 1000, 2), // общее время запроса
            dnsTimeMs: round($handlerStats['namelookup_time'] * 1000, 2), // время DNS-запроса
            connectionTimeMs: round($handlerStats['connect_time'] * 1000, 2), // время соединения
            sslHandshakeMs: round(($handlerStats['appconnect_time'] - $handlerStats['connect_time']) * 1000, 2), // время SSL-handshake
            ttfbMs: round($handlerStats['starttransfer_time'] * 1000, 2), // время до первого байта
            downloadSizeBytes: (int) $handlerStats['size_download'], // размер загруженных данных
            ip: $handlerStats['primary_ip'] ?? '0.0.0.0' // IP-адрес сервера
        );
    }
}