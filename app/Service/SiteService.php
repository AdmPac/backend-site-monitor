<?php

namespace App\Service;

use App\Models\Site;
use Illuminate\Support\Facades\Http;

class SiteService
{
    public function check(Site $site): array
    {
        $response = Http::get($site->url);
        return [
            // Группа «Здоровье и Статус»
            'successful' => $response->successful(), // true если статус код 200-299
            'status' => $response->status(), // статус код
            'failed' => $response->failed(), // true если статус код не 200-299(>=400)
            'serverError' => $response->serverError(), // true если статус код 500-599
            'reason' => $response->reason(), // текстовое описание статуса
            
            // Группа «Глубокий сетевой анализ» (Киллер-фичи)
            'handlerStats' => $response->handlerStats(), // массив с информацией о обработчике запроса
            'effectiveUri' => $response->effectiveUri(), // URL после всех редиректов
            'redirect' => $response->redirect(), // массив с информацией о редиректах

            // Группа «Проверка контента и Безопасность»
            'headers' => $response->headers(), // список всех заголовков
            'cookies' => $response->cookies(), // список всех куков
        ];
    }
}