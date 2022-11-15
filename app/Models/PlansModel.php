<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlansModel extends Model {
    use HasFactory;

    protected $table = 'plans';
    protected $primaryKey = 'id';
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';

    protected $fillable = ['name', 'value', 'quantity', 'percentual_rendimento', 'coin_id', 'details', 'status'];
    protected $date = ['created_at', 'updated_at'];

    public function scopeGetAll($query, $post) {
        if ($post->input('name') != '') {
            $query->where('name', 'LIKE', '%' . $post->input('name') . '%');
        }

        $dados =  $query
            ->orderBy('name')
            ->paginate(10);
        return $dados;
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return []
     */
    public function scopeGetArray($query) {
        $dados =  $query->get();

        $result = [];
        $result[''] = 'Selecione!';
        foreach ($dados as $dado) {
            $result[$dado->id] = $dado->name;
        }

        return $result;
    }

    public function purchaces() {
        return $this->hasMany(Purchases::class, 'plan_id');
    }

    public function coin() {
        return $this->belongsTo(Coins::class, 'coin_id', 'id');
    }
}
