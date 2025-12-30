<?php

namespace App\DTO;

use Illuminate\Http\Client\Response;
use \Psr\Http\Message\UriInterface;

readonly class MainData
{
    public function __construct(
        public bool $successful,
        public int $status,
        public bool $failed,
        public bool $serverError,
        public string $reason,
        
        // Группа «Глубокий сетевой анализ» (Киллер-фичи)
        public array $handlerStats,
        public ?UriInterface $effectiveUri,
        public bool $redirect,

        // Группа «Проверка контента и Безопасность»
        public array $headers,
    ){}

    public static function createFromHttp(Response $response)
    {
        return new self(
            successful: $response->successful(), // true если статус код 200-299
            status: $response->status(), // статус код
            failed: $response->failed(), // true если статус код не 200-299(>=400)
            serverError: $response->serverError(), // true если статус код 500-599
            reason: $response->reason(), // текстовое описание статуса
            
            // Группа «Глубокий сетевой анализ» (Киллер-фичи)
            handlerStats: $response->handlerStats(), // массив с информацией о обработчике запроса
            effectiveUri: $response->effectiveUri(), // URL после всех редиректов
            redirect: $response->redirect(), // массив с информацией о редиректах

            // Группа «Проверка контента и Безопасность»
            headers: $response->headers(), // список всех заголовков
        );
    }
}