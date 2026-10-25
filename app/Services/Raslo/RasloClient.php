<?php

namespace App\Services\Raslo;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class RasloClient
{
    public function __construct(private RasloEndpoint $endpoint) {}

    public function request(string $key, string $method, string $path, array $payload = [], ?string $idempotency = null): Response
    {
        $http = Http::withToken($key)->acceptJson()->asJson()->timeout(20)->connectTimeout(5)->withOptions($this->endpoint->options());
        if ($idempotency) {
            $http = $http->withHeaders(['Idempotency-Key' => $idempotency]);
        }

        return $method === 'POST' ? $http->post($this->endpoint->base().$path, $payload) : $http->get($this->endpoint->base().$path);
    }
}
