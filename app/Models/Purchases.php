<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    use HasFactory;

    protected  $table = 'purchases';
    protected $primaryKey = 'id';

    protected $fillable = [
        'client_user_id',
        'plan_id',
        'coin_id',
        'quantity_coin',
        'value_coin',
        'value_total',
        'valor_multa',
        'valor_recebido',
        'percentual_rendimento',
        'dt_purchase',
        'quantity_boi',
        'status',
        'time_pri',
        'dt_encerramento'
    ];

    protected $date = [
        'created_at',
        'updated_at',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_user_id');
    }

    public function plan()
    {
        return $this->belongsTo(PlansModel::class, 'plan_id', 'id');
    }

    public function coin()
    {
        return $this->belongsTo(Coins::class, 'coin_id');
    }

    public function boletos()
    {
        return $this->hasOne(BoletosModel::class, 'purchase_id', 'id');
    }


}
