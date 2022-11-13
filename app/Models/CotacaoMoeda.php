<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotacaoMoeda extends Model
{
    use HasFactory;
    protected  $table = 'cotacao_moedas';
    protected $fillable = [
        'id_coin',
        'value',
        'status',
    ];

    protected $date = [
        'created_at',
        'updated_at',
    ];

    public function coin()
    {
        return $this->belongsTo(Coins::class, 'id_coin');
    }
}
