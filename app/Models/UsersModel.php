<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model {
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'user', 'email_verified_at', 'password',
        'remember_token', 'type', 'cpf', 'sponsor', 'termo_compra', 'status_termo', 'dt_termo'
    ];

    protected $date = ['created_at', 'updated_at'];

    public function client() {
        return $this->hasOne(ClientsModel::class, 'user_id', 'id');
    }
}
