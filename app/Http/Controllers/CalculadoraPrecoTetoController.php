<?php

namespace App\Http\Controllers;

use App\Services\StockPriceService;
use App\Services\DividendYieldService;
use App\Services\HistoricalIndicatorsService;
use App\Services\StockInformationService;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\HistoricalData;

class CalculadoraPrecoTetoController extends Controller
{
    protected $stockPriceService;
    protected $dividendYieldService;
    protected $historicalIndicatorsService;
    protected $stockInformationService;

    public function __construct(
        StockPriceService $stockPriceService,
        DividendYieldService $dividendYieldService,
        HistoricalIndicatorsService $historicalIndicatorsService,
        StockInformationService $stockInformationService
    ) {
        $this->stockPriceService = $stockPriceService;
        $this->dividendYieldService = $dividendYieldService;
        $this->historicalIndicatorsService = $historicalIndicatorsService;
        $this->stockInformationService = $stockInformationService;
    }

    public function index()
    {
        return view('calculadoraPrecoTeto.index');
    }

    public function basinCellingPriceList()
    {
        return view('basin-celling-price.index');
    }

    public function stockPrices($userId)
    {
        $stockData = $this->stockPriceService->getStockPrices($userId);
        return response()->json($stockData);
    }

    public function dividendYield($userId)
    {
        $dividendData = $this->dividendYieldService->getDividendYield($userId);
        return response()->json($dividendData);
    }

    public function historicalIndicators($userId)
    {
        $indicatorData = $this->historicalIndicatorsService->getHistoricalIndicators($userId);
        return response()->json($indicatorData);
    }

    public function precoJustoGraham()
    {
        return view('graham-fair-price.index');
    }

    public function getStockBasicInformation($search)
    {
        $stockInfo = $this->stockInformationService->getStockBasicInformation($search);
        return response()->json($stockInfo);
    }
}