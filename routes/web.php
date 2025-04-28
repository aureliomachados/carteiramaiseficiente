<?php
require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CalculadoraPrecoTetoController;
use App\Http\Controllers\UserStockController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HistoricalDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/preco-teto-basin', [CalculadoraPrecoTetoController::class, 'basinCellingPriceList'])->name('preco-teto-basin.index');
    Route::get('/stock-prices/{userId}', [CalculadoraPrecoTetoController::class, 'stockPrices'])->name('stock-prices');
    Route::get('/dividend-yield/{userId}', [CalculadoraPrecoTetoController::class, 'dividendYield'])->name('dividend-yield');
    Route::get('/historical-indicators/{userId}', [CalculadoraPrecoTetoController::class, 'historicalIndicators'])->name('historical-indicators');
    Route::get('/preco-justo-graham', [CalculadoraPrecoTetoController::class, 'precoJustoGraham'])->name('preco-justo-graham');
    Route::resource('stocks', StockController::class);
    Route::get('user/stocks', [UserStockController::class, 'index'])->name('user.stocks.index');
    Route::post('user/stocks', [UserStockController::class, 'store'])->name('user.stocks.store');
    Route::get('/stocks/autocomplete/{term}', [StockController::class, 'autocomplete'])->name('stocks.autocomplete');
    Route::delete('user/stocks/{id}', [UserStockController::class, 'destroy'])->name('user.stocks.destroy');
    Route::get('/calculadoraPrecoTeto', function(){
        return view('stock.index');
    });
    Route::get('/getstock-basicinfo/{search}', [CalculadoraPrecoTetoController::class, 'getStockBasicInformation'])->name('getstock-basicinfo');
    Route::post('/savehistoricaldata', [HistoricalDataController::class, 'saveHistoricalData'])->name('saveHistoricalData');
    Route::get('/historical-data', [HistoricalDataController::class, 'index'])->name('historicalData.index');
});