<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client_planModel extends Model {
    use HasFactory;

    protected $table = 'client_plan';
    protected $primaryKey = 'id';

    protected $fillable = ['client_id', 'plan_id', 'renovation', 'expiration', 'status',];
    protected $dates = ['created_at', 'updated_at', 'renovation', 'expiration'];

    public function client() {
        return $this->hasOne(ClientsModel::class, 'id', 'client_id');
    }
}
