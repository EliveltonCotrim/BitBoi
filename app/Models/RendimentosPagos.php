<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendimentosPagos extends Model
{
    use HasFactory;

    protected $table = 'rendimentos_pagos';
    protected $primaryKey = 'id';
    protected $fillable = ['valor', 'boleto_id', 'rendimentos_id'];


    public function boleto()
    {
        return $this->belongsTo(BoletosModel::class, 'boleto_id', 'id');
    }

    public function rendimentos()
    {
        return $this->belongsTo(Rendimentos::class, 'rendimentos_id', 'id');
    }
}
