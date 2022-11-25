<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoletosModel extends Model {
    use HasFactory;

    protected $table = 'boletos';
    protected $primaryKey = 'id';
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';

    protected $fillable = [
        'user_id', 'purchase_id', 'tipo', 'valor', 'meioPagamento', 'ticket', 'status',
        'dataConfirmacao', 'obs', 'json', 'transaction_id', 'forwardingTransaction_id',
        'quantity', 'dt_encerramento'
    ];

    protected $dates = ['created_at', 'updated_at', 'dataConfirmacao'];

    public function user() {
        return $this->hasOne(UsersModel::class, 'id', 'user_id');
    }

    public function purchase() {
        return $this->hasOne(Purchases::class, 'id', 'purchase_id');
    }

    public function rendimentosPagos() {
        return $this->hasMany(RendimentosPagos::class, 'boleto_id', 'id');
    }



}
