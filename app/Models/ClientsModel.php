<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsModel extends Model {
    use HasFactory;

    protected $table = 'clients';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'position',
        'indicado',
        'email', 'user', 'cpf', 'password', 'phone',
        'uf', 'rg', 'city', 'logradouro',
        'number', 'bairro', 'cep', 'avatar', 'status',
        'country',
        'emailValidated',
        'conta_metamask',
        'carteira_btc',
        'parent_nome',
        'parent_cpf',
        'parent_rg',
        'parent_email',
        'parent_parentesco',
        'parent_nascimento',
        'parent_phone',
        'codigo_assas'
    ];

    protected $casts = [
        'banks' => 'array'
    ];

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

    public function scopeGetBancosList($query, $client_id) {
        $result = [];
        $bancos = $query->find($client_id)->banks;

        if ($bancos) {
            foreach ($bancos as $k => $banco) {
                $result[$k] =
                    "Pix: " . $banco['pix'] .
                    " - Banco: " . $banco['banco'] .
                    " - Agência: " . $banco['agencia'] .
                    " - Conta: " . $banco['conta'] .
                    " - CPF: " . $banco['cpf'];
            }
        }
        return $result;
    }

    public function scopeGetBancos($query, $client_id) {
        $result = [];
        $bancos = $query->find($client_id)->banks;
        if ($bancos) {
            foreach ($bancos as $k => $banco) {
                $result[$k] = [
                    "pix" => $banco['pix'],
                    "banco" => $banco['banco'],
                    "agencia" => $banco['agencia'],
                    "conta" => $banco['conta'],
                    "cpf" => $banco['cpf'],
                ];
            }
        }
        return $result;
    }

    public function patrocinador() {
        return $this->hasOne(ClientsModel::class, 'id', 'indicado');
    }

    public function plan() {
        return $this->hasOne(Client_planModel::class, 'client_id', 'id');
    }
}
