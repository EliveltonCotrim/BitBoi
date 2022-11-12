<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BalancesModel extends Model {
    use HasFactory;

    protected $table = 'balances';
    protected $primaryKey = 'id';

    protected $fillable = [
        'client_id', 'reference', 'operation',
        'coin', 'value', 'courentBalance', 'previousBalance', 'observation', 'status',
        'pedido_id',
    ];
    protected $date = ['created_at', 'updated_at'];

    public function scopeGetAll($query, $post) {
        if ($post->input('cliente_id') != '') {
            $query->where('cliente_id', 'LIKE', '%' . $post->input('cliente_id') . '%');
        }

        $dados =  $query
            ->orderBy('cliente_id')
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
            $result[$dado->id] = $dado->cliente_id;
        }

        return $result;
    }

    public function scopeGetLast($query, $cliente_id, $coin) {
        return $query
            ->where('client_id', $cliente_id)
            ->where('coin', $coin)
            ->orderBy('id', 'desc')
            ->first();
    }

    public function scopeTotalGanhos($query, $id_client) {
        return $query
            ->select([
                // 'value',
                DB::raw('IFNULL((select sum(value)), 0) AS ganhos')
            ])
            ->where('client_id', $id_client)
            ->where('coin',  'comissao')
            // ->groupBy('coin')
            ->first();
    }

    public function client() {
        return $this->hasOne(ClientsModel::class, 'id', 'client_id');
    }
}
