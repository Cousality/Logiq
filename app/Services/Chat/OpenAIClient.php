<?php

namespace App\Services\Chat;

use Illuminate\Support\Facades\Http;

class OpenAIClient
{
    public function chat(array $payload): array
    {
        $key = config('services.openai.key');
        $base = rtrim(config('services.openai.base'), '/');

        $resp = Http::withToken($key)
            ->acceptJson()
            ->asJson()
            ->post($base . '/chat/completions', $payload);

        if (!$resp->ok()) {
            throw new \RuntimeException('OpenAI error: ' . $resp->status() . ' ' . $resp->body());
        }

        return $resp->json();
    }
}