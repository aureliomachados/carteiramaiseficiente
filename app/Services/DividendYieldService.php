<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DividendYieldService
{
    public function getDividendYield($userId)
    {
        $user = User::find($userId);
        $stocks = $user->stocks->pluck('codigo')->toArray();

        $cacheKey = 'dividend_yield';
        $cacheDuration = 60;

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $stockData = [];
        foreach ($stocks as $stock) {
            $apiDividendUrl = "https://investidor10.com.br/api/dividendos/chart/{$stock}/3650/ano/";
            $response = Http::withOptions(['verify' => false])->get($apiDividendUrl);

            if ($response->successful()) {
                $dividends = $response->json();
                $stockData[$stock] = [];

                foreach ($dividends as $dividend) {
                    $stockData[$stock][] = [
                        'created_at' => $dividend['created_at'] ?? null,
                        'price' => $dividend['price'] ?? null,
                    ];
                }
            } else {
                $stockData[$stock] = [
                    'error' => 'Failed to fetch data'
                ];
            }
        }

        Cache::put($cacheKey, $stockData, $cacheDuration);

        return $stockData;
    }
}