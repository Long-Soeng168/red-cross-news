<?php

namespace App\\Services;

use Illuminate\\Support\\Facades\\Http;

class KohaService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.koha.base_url');
        $this->apiKey = config('services.koha.api_key');
    }

    public function searchBooks($query)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get("{$this->baseUrl}/biblios", [
            'q' => $query,
        ]);

        return $response->json();
    }
}
