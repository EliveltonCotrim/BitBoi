<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientsModel;
use App\Models\DocumentsModel;
use Illuminate\Http\Request;


class DocClientController extends Controller {

    private $dados = [];
    private $clientesmodel;
    private $documentsModel;

    function __construct(ClientsModel $clientesmodel, DocumentsModel $documentsModel) {
        $this->clientesmodel = $clientesmodel;
        $this->documentsModel = $documentsModel;
    }

    public function ativacao(DocumentsModel $documentsModel) {
        $id_cliente = session('id');

        // $this->dados['doc_verso'] = $documentsModel->getDocumento($id_cliente, 'verso');
        $this->dados['doc_frente'] = $documentsModel->getDocumento($id_cliente, 'doc_frente');
        $this->dados['doc_selfie'] = $documentsModel->getDocumento($id_cliente, 'doc_selfie');
        $this->dados['doc_endereco'] = $documentsModel->getDocumento($id_cliente, 'doc_endereco');

        $this->dados['client'] = $this->clientesmodel->find($id_cliente);
        return view('client.ativacao', $this->dados);
    }

    public function ativacao_store(Request $request, DocumentsModel $documentsModel) {
        $tipo = $request->tipo;
        $id_cliente = session('id');

        $doc = $request->file('doc');
        $file_name = $doc->store('documentos');

        if ($tipo == 'doc_frente') {
            $doc = $documentsModel->getDocumento($id_cliente, 'doc_frente');
            if (!$doc) {
                $this->insert('doc_frente', $file_name);
            } else {
                $this->update($doc->id, $file_name);
            }
        } elseif ($tipo == 'doc_selfie') {
            $doc = $documentsModel->getDocumento($id_cliente, 'doc_selfie');
            if (!$doc) {
                $this->insert('doc_selfie', $file_name);
            } else {
                $this->update($doc->id, $file_name);
            }
        } elseif ($tipo == 'doc_endereco') {
            $doc = $documentsModel->getDocumento($id_cliente, 'doc_endereco');
            if (!$doc) {
                $this->insert('doc_endereco', $file_name);
            } else {
                $this->update($doc->id, $file_name);
            }
        }

        return redirect('client/ativacao')->with('alert', 'Documento enviado para avaliação');
    }

    private function insert($tipo, $file_name) {
        $id_cliente = session('id');
        $insert = [
            'cliente_id' => $id_cliente,
            'tipo' => $tipo,
            'arquivo' => $file_name,
            'status' => 'enviado',
        ];
        $this->documentsModel->create($insert);
    }

    private function update($doc_id, $file_name) {
        $update = ['arquivo' => $file_name, 'status' => 'enviado',];
        $this->documentsModel->find($doc_id)->update($update);
    }
}
