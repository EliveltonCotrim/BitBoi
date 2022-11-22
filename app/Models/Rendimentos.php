<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendimentos extends Model
{
    use HasFactory;

    protected $table = 'rendimentos';
    protected $primaryKey = 'id';
    protected $fillable = ['dt_lacamento', 'valor_total'];

    public function rendimentosPago(){
        return $this->hasMany(RendimentosPagos::class, 'rendimentos_id', 'id');
    }
}
