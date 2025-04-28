<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('stocks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:stocks',
            'nome' => 'required',
            'logo_url' => 'nullable|url',
        ]);

        Stock::create($request->all());

        return redirect()->route('stocks.index')->with('success', 'Stock created successfully.');
    }

    public function show(Stock $stock)
    {
        return view('stocks.show', compact('stock'));
    }

    public function edit(Stock $stock)
    {
        return view('stocks.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'codigo' => 'required|unique:stocks,codigo,' . $stock->id,
            'nome' => 'required',
            'logo_url' => 'nullable|url',
            'id_investidor10' => 'required',
        ]);

        $stock->update($request->all());

        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully.');
    }

    public function autocomplete($term)
    {
        $stocks = Stock::where('codigo', 'LIKE', '%' . $term . '%')
                        ->orWhere('nome', 'LIKE', '%' . $term . '%')
                        ->get();

        return response()->json($stocks);
    }
}