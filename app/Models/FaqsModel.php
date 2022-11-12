<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class FaqsModel extends Model {  use HasFactory;

    protected $table = 'faqs';
    protected $primaryKey = 'id';
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';

    protected $fillable =[ 'pergunta', 'resposta', 'status',];
    protected $date =['created_at','updated_at'];

    public function scopeGetAll($query, $post) {
        if ($post->input('pergunta') != '') {
            $query->where('pergunta', 'LIKE', '%' . $post->input('pergunta') . '%');
        }

        $dados =  $query
            ->orderBy('pergunta')
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
            $result[$dado->id] = $dado->pergunta;
        }

        return $result;
    }
}
