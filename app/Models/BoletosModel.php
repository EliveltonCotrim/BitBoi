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
        'user_id', 'plan_id', 'tipo', 'valor', 'meioPagamento', 'ticket', 'status',
        'dataConfirmacao', 'obs', 'json', 'transaction_id', 'forwardingTransaction_id',
        'quantity',
    ];
    protected $dates = ['created_at', 'updated_at', 'dataConfirmacao'];

    public function user() {
        return $this->hasOne(UsersModel::class, 'id', 'user_id');
    }

    public function plan() {
        return $this->hasOne(PlansModel::class, 'id', 'plan_id');
    }
}
