<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coins extends Model
{
    use HasFactory;

    protected $table = 'coins';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'description', 'profit_percentage', 'status', 'time_pri', 'qtd_boi'];
    protected $date = ['created_at', 'updated_at'];

    public function cotacoes()
    {
        return $this->hasMany(CotacaoMoeda::class, 'id_coin', 'id');
    }

    /**
    * Get the user's most recent order.
    */
    public function latestCotacao()
    {
        return $this->hasOne(CotacaoMoeda::class, 'id_coin', 'id')->latestOfMany();
    }

    public function purchases()
    {
        return $this->hasMany(Purchases::class, 'coin_id', 'id');
    }

    public function plans()
    {
        return $this->hasMany(PlansModel::class, 'coin_id', 'id');
    }
}
