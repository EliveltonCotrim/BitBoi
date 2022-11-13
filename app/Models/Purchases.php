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
        'quantity',
        'value_coin',
        'value_total',
        'plan_id',
        'coin_id',
        'percentual_rendimento',
        'dt_purchase',
        'status',
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
        return $this->belongsTo(PlansModel::class, 'plan_id');
    }

    public function coin()
    {
        return $this->belongsTo(Coins::class, 'coin_id');
    }
}
