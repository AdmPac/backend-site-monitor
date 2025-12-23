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

    public static function fromHandlerStats(array $stats): self
    {
        return new self(
            totalTimeMs: round($stats['total_time'] * 1000, 2), // общее время запроса
            dnsTimeMs: round($stats['namelookup_time'] * 1000, 2), // время DNS-запроса
            connectionTimeMs: round($stats['connect_time'] * 1000, 2), // время соединения
            sslHandshakeMs: round(($stats['appconnect_time'] - $stats['connect_time']) * 1000, 2), // время SSL-handshake
            ttfbMs: round($stats['starttransfer_time'] * 1000, 2), // время до первого байта
            downloadSizeBytes: (int) $stats['size_download'], // размер загруженных данных
            ip: $stats['primary_ip'] ?? '0.0.0.0' // IP-адрес сервера
        );
    }
}