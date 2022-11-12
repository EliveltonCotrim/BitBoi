<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsModel extends Model {
    use HasFactory;

    protected $table = 'payments';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'slug', 'logo', 'methods', 'status', 'token', 'data',];
    protected $date = ['created_at', 'updated_at'];
}
