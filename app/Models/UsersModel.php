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
        'remember_token', 'type', 'cpf', 'sponsor'
    ];
    protected $date = ['created_at', 'updated_at'];

    public function client() {
        return $this->hasOne(ClientsModel::class, 'id', 'client_id');
    }
}
