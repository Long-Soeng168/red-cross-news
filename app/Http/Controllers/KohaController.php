<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KohaController extends Controller
{
    public function getBiblios()
    {
        $apiUrl = env('KOHA_API_URL') . '/biblios';
        $clientId = env('KOHA_CLIENT_ID');
        $secret = env('KOHA_SECRET');

        $response = Http::withBasicAuth($clientId, $secret)
                        ->get($apiUrl);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Unable to fetch data'], $response->status());
    }
}

