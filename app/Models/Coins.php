<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coins extends Model
{
    use HasFactory;

    protected $table = 'coins';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'description', 'porcentual_lucro', 'status',];
    protected $date = ['created_at', 'updated_at'];

    public function cotacaoMoeda()
    {
        return $this->hasMany(CotacaoMoeda::class, 'id_coin');
    }

    public function purchases()
    {
        return $this->hasMany(Purchases::class, 'coin_id');
    }
}
