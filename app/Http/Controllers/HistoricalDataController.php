<?php 
namespace App\Http\Controllers;

use App\Models\HistoricalData;
use Illuminate\Http\Request;
use App\Models\Stock;

class HistoricalDataController extends Controller
{
    public function index()
    {
        // Fetch all historical data with related stock data
        $historicalData = HistoricalData::with('stock')->get();

        // Pass the raw data to the view
        return view('historicalData.index', compact('historicalData'));
    }

   public function saveHistoricalData(Request $request)
    {
        try {
            // Directly access the incoming JSON data
            $dataArray = $request->all();

            // Iterate over each entry in the JSON array
            foreach ($dataArray as $data) {
                // Find the stock_id using the codigo
                $stock = Stock::where('codigo', $data['stock_id'])->first();

                if ($stock) {
                    // Use updateOrCreate to update existing records or create new ones
                    HistoricalData::updateOrCreate(
                        [
                            'user_id' => $data['user_id'],
                            'stock_id' => $stock->id,
                            'date' => $data['date'],
                        ],
                        [
                            'preco_justo' => $data['preco_justo'],
                            'preco_atual' => $data['preco_atual'],
                            'potencial_valorizacao' => $data['potencial_valorizacao'],
                        ]
                    );
                } else {
                    // Handle the case where the stock is not found
                    throw new \Exception("Stock with codigo {$data['codigo']} not found.");
                }
            }

            // Return a success response
            return response()->json(['message' => 'Data saved successfully!'], 201);

        } catch (\Exception $e) {
            // Return a generic error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}