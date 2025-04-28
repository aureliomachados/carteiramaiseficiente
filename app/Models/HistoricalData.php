<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricalData extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'stock_id', 'date', 'preco_justo', 'potencial_valorizacao', 'preco_atual'];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}