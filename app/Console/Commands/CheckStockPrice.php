<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\StockNotification;

class CheckStockPrice extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:check';

    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the stock price and notify if the change percent is ${$this->targetStockPercent} or lower.';
    
    protected $targetStockPercent = -1;

    protected $stocks = [
        'VALE3','CMIG3','PETR3','SAPR3','CMIN3','BBSE3','PRIO3','BBAS3','ITSA3','TAEE3','WEGE3','ITUB3','AGRO3','ROXO34', 'GOGL34', 'MSFT34' ,'AMZO34', 'NVDC34', 'M1TA34'
    ];

    //todo calcular preço teto da ação

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $notifications = [];

        foreach ($this->stocks as $stock) {
            $response = Http::withOptions(['verify' => false])->get("https://brapi.dev/api/quote/{$stock}?token=uTxATBGRBafGRpaoocJ8PH");
            $data = $response->json();

            if (isset($data['results'][0]['regularMarketChangePercent'])) {
                $changePercent = $data['results'][0]['regularMarketChangePercent'];
                $logoUrl = $data['results'][0]['logoUrl'] ?? '';

                // Log the regularMarketChangePercent for each stock
                Log::channel('stock')->info("Stock: {$stock}, Regular Market Change Percent: {$changePercent}");

                if ($changePercent <= $this->targetStockPercent) {
                    $notifications[] = [
                        'symbol' => $stock,
                        'changePercent' => $changePercent,
                        'logoUrl' => $logoUrl
                    ];
                }
            }else{
                 // Log if the regularMarketChangePercent is not found
                 Log::channel('stock')->warning("Stock: {$stock}, Regular Market Change Percent not found in response.");
            }
        }

        if (!empty($notifications)) {
            $this->notifyUser($notifications);
        }
    }

    protected function notifyUser($notifications)
    {
        Mail::to('aurelioguedessouza@gmail.com')->send(new StockNotification($notifications));

        $this->info('Notification sent.');
    }
}
