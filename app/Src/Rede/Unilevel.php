<?php

namespace App\Src\Rede;

use App\Models\ClientsModel;
use App\Src\PlanoCliente;

class Unilevel {

    private $rede = [];

    public function getAll($id_cliente) {
        $diretos = ClientsModel::where('indicado', $id_cliente)
            ->with('patrocinador')
            ->get();
        foreach ($diretos as $direto) {
            $this->rede[] = [
                'id' => $direto->id,
                'user' => $direto->user,
                'name' => $direto->name,
                'patrocinador' => $direto->patrocinador->user,
                'patrocinador_telefone' => $direto->patrocinador->phone,
                'nivel' => 1,
            ];
            $this->getChild($direto->id, 2);
        }

        $collection = collect($this->rede);
        $sorted = $collection->sortBy('nivel');
        return $sorted->values()->all();
    }

    private function getChild($id_cliente, $nivel) {
        $diretos = ClientsModel::where('indicado', $id_cliente)
            ->with('patrocinador')
            ->get();
        foreach ($diretos as $direto) {
            $this->rede[] = [
                'id' => $direto->id,
                'user' => $direto->user,
                'name' => $direto->name,
                'patrocinador' => $direto->patrocinador->user,
                'patrocinador_telefone' => $direto->patrocinador->phone,
                'nivel' => $nivel,
            ];
            $this->getChild($direto->id, $nivel + 1);
        }
    }

    public function diretos($id_cliente) {
        $diretos = ClientsModel::where('indicado', $id_cliente)->get();

        $diretos_list = [];
        foreach ($diretos as $direto) {
            $diretos_list[] = [
                'id' => $direto->id,
                'user' => $direto->user,
                'name' => $direto->name,
                'patrocinador' => $direto->patrocinador->user,
                'patrocinador_telefone' => $direto->patrocinador->phone,
                'nivel' => 1,
            ];
        }

        return $diretos_list;
    }

    public function reverseNetwork($id_cliente) {
        $cliente = ClientsModel::find($id_cliente);
        $id_patrocinador = $cliente->indicado;

        $new_client = ClientsModel::find($id_patrocinador);

        $plano = new PlanoCliente();

        $level = 1;
        $network = [];
        while ($id_patrocinador != 1) {

            $plano_client = $plano->status($id_patrocinador);

            $network[] = [
                'id' => $id_patrocinador,
                'user' => $new_client->user,
                // 'position' => $new_client->position,
                'level' => $level,

            ]
                + $plano_client;

            $id_patrocinador = $new_client->indicado;
            $new_client = ClientsModel::find($id_patrocinador);
            $level++;
        }

        return $network;
    }
}
