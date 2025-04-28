<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStockController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userStocks = $user->stocks; // Usando a relação definida no modelo User

        return view('user.stocks.index', compact('userStocks'));
    
    }

    public function store(Request $request)
    {
        $request->validate([
            'stocks' => 'required|array',
            'stocks.*' => 'exists:stocks,id',
        ]);

        $user = Auth::user();
        foreach ($request->stocks as $stockId) {
            if (!$user->stocks->contains($stockId)) {
                $user->stocks()->attach($stockId);
            }
        }

        return redirect()->route('user.stocks.index')->with('success', 'Stocks adicionadas com sucesso.');
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $user->stocks()->detach($id);

            return response()->json(['success' => 'Stock removida com sucesso.']);
        }

        return redirect()->route('user.stocks.index')->with('success', 'Stock removida com sucesso.');
    }
}