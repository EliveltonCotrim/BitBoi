<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprasModel extends Model {
    use HasFactory;

    protected $table = 'compras';
    protected $primaryKey = 'id';

    protected $fillable = ['ciclo_id', 'client_id', 'data', 'quantidade', 'valor_token', 'valor_total', 'status',];
    protected $date = ['created_at', 'updated_at'];

    public function ciclo() {
        return $this->hasOne(CiclosModel::class, 'id', 'ciclo_id');
    }

    public function cliente() {
        return $this->hasOne(ClientsModel::class, 'id', 'client_id');
    }
}
