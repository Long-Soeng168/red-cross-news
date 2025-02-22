<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KohaSearchController extends Controller
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = env('KOHA_API_BASE_URL');
        $this->apiKey = env('KOHA_API_KEY');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get("{$this->baseUrl}/biblios", [
            'q' => $query,
        ]);

        return response()->json($response->json());
    }
}
