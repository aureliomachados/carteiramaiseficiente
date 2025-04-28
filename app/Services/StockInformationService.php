<?php

namespace App\Services;

use App\Models\Stock;
use Illuminate\Support\Facades\Http;

class StockInformationService
{
    public function getStockBasicInformation($search)
    {
        $stockFromDatabase = Stock::where('codigo', strtoupper($search))->first();

        if ($stockFromDatabase != null && $stockFromDatabase->count() > 0) {
            if ($stockFromDatabase->logo_url == null) {
                $response = $this->fetchBrapiData($search);

                if ($response->successful()) {
                    $data = $response->json();
                    $stockFromDatabase->logo_url = $data['results'][0]['logourl'];
                    $stockFromDatabase->nome = $data['results'][0]['shortName'];
                    $stockFromDatabase->save();
                }
            }
            return ['error' => 'Stock já cadastrada'];
        } else {
            $response = $this->fetchBrapiData($search);

            if ($response->successful()) {
                $data = $response->json();
                $logoUrl = $data['results'][0]['logourl'];
                $shortName = $data['results'][0]['shortName'];
                return ['logo_url' => $logoUrl, 'nome' => strtoupper($shortName)];
            } else {
                return ['error' => 'Failed to fetch data'];
            }
        }
    }

    protected function fetchBrapiData($stock)
    {
        return Http::withOptions(['verify' => false])->get("https://brapi.dev/api/quote/{$stock}?token=" . env('BRAPI_KEY'));
    }
}