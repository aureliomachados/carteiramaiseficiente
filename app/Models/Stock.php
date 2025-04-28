<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nome',
        'logo_url',
        'id_investidor10'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_stocks');
    }
}
