<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentsModel extends Model {
    use HasFactory;

    protected $table = 'documents';
    protected $primaryKey = 'id';

    protected $fillable = ['cliente_id', 'tipo', 'arquivo', 'status'];
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

    public function getDocumento($id_cliente, $tipo) {
        return $this
            ->where('cliente_id', $id_cliente)
            ->where('tipo', $tipo)
            ->first();
    }

    public function client() {
        return $this->hasOne(ClientsModel::class, 'id', 'cliente_id');
    }
}
