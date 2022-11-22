<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaquesModel extends Model
{
    use HasFactory;

    protected $table = 'saques';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'valor',
        'banco',
        'moeda',
        'status',
        'comprovante',
        'data_pagamento',
        'banco'
    ];
    protected $date = ['created_at', 'updated_at'];

    public function scopeTotalPendentes($query, $user_id, $moeda)
    {
        return $query
            ->where('status', 'pendente')
            ->where('user_id', $user_id)
            ->where('moeda', $moeda)
            ->sum('valor');
    }

    public function client()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
