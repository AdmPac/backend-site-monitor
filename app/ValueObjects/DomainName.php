<?php

namespace App\ValueObjects;

use InvalidArgumentException;

final class DomainName
{
    private string $base_url;

    public function __construct(private readonly string $full_url)
    {
        if (!filter_var($this->full_url, FILTER_VALIDATE_URL)) throw new InvalidArgumentException('Некорректная ссылка');
    }

    public function getFullUrl(): string
    {
        return $this->full_url;
    }

    public function getBaseUrl(): string
    {
        if ($this->base_url) return $this->base_url;
        
        $host = parse_url($this->full_url, PHP_URL_HOST) ?? $this->full_url;

        // Убираем www
        $host = preg_replace('/^www\./', '', $host);

        // Убираем доменную зону (.com, .ru, .com.ua и т.д.)
        $pureDomain = preg_replace('/\.[^.]+$/', '', $host);
        
        return $pureDomain;
    }
}