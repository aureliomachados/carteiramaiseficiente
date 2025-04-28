<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class StockPriceService
{
    public function getStockPrices($userId)
    {
        $userStocks = User::find($userId);
        $stocks = $userStocks->stocks;
        $stockSymbols = $stocks->pluck('codigo')->toArray();

        $cacheKey = 'stock_prices_' . $userId;
        $cacheDuration = 60;

        if (Cache::has($cacheKey)) {
            $cachedData = Cache::get($cacheKey);
            $cachedStockSymbols = $cachedData['symbols'] ?? [];

            if (empty(array_diff($stockSymbols, $cachedStockSymbols))) {
                return $cachedData['data'];
            }
        }

        $stockData = [];
        foreach ($stockSymbols as $stock) {
            $response = $this->fetchBrapiData($stock);
            if ($response->successful()) {
                $data = $response->json();
                $stockData[] = [
                    'stock' => $stock,
                    'logoUrl' => $data['results'][0]['logourl'] ?? '',
                    'regularMarketPrice' => $data['results'][0]['regularMarketPrice'] ?? null,
                ];
            } else {
                $stockData[] = [
                    'stock' => $stock,
                    'error' => 'Failed to fetch data'
                ];
            }
        }

        Cache::put($cacheKey, ['symbols' => $stockSymbols, 'data' => $stockData], $cacheDuration);

        return $stockData;
    }

    protected function fetchBrapiData($stock)
    {
        return Http::withOptions(['verify' => false])->get("https://brapi.dev/api/quote/{$stock}?token=" . env('BRAPI_KEY'));
    }
}