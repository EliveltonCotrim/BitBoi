<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaquesModel extends Model {
    use HasFactory;

    protected $table = 'saques';
    protected $primaryKey = 'id';

    protected $fillable = [
        'cliente_id', 'valor',
        'banco',
        'moeda', 'status', 'comprovante', 'data_pagamento',
        'banco'
    ];
    protected $date = ['created_at', 'updated_at'];

    public function scopeTotalPendentes($query, $client_id, $moeda) {
        return $query
            ->where('status', 'pendente')
            ->where('cliente_id', $client_id)
            ->where('moeda', $moeda)
            ->sum('valor');
    }

    public function client() {
        return $this->hasOne(ClientsModel::class, 'id', 'cliente_id');
    }
}
