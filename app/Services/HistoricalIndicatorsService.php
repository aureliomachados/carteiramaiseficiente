<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HistoricalIndicatorsService
{
    public function getHistoricalIndicators($userId)
    {
        $user = User::find($userId);

        $cacheKey = 'historical_indicators_' . $userId;
        $cacheDuration = 12 * 60;

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $results = [];
        foreach ($user->stocks as $stock) {
            $endpoint = "https://investidor10.com.br/api/historico-indicadores/{$stock->id_investidor10}/1";
            $response = Http::withOptions(['verify' => false])->get($endpoint);
            $data = json_decode($response->getBody(), true);

            $vpa = null;
            $lpa = null;

            if (isset($data['VPA'])) {
                foreach ($data['VPA'] as $vpaData) {
                    if ($vpaData['year'] === 'Atual') {
                        $vpa = $vpaData['value'];
                        break;
                    }
                }
            }

            if (isset($data['LPA'])) {
                foreach ($data['LPA'] as $lpaData) {
                    if ($lpaData['year'] === 'Atual') {
                        $lpa = $lpaData['value'];
                        break;
                    }
                }
            }

            $results[$stock->codigo] = [
                'VPA' => $vpa,
                'LPA' => $lpa,
            ];
        }

        Cache::put($cacheKey, $results, $cacheDuration);

        return $results;
    }
}