<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class StockService
{
    protected $apiKey = "CZFFRE0SCN6EY5NS";
    protected $apiUrl = 'https://brapi.dev/api/quote/';

    public function getStockData($stock)
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->apiUrl}{$stock}?token=" . env('BRAPI_KEY'));
        return $response->json();
    }
}