<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\BoletosModel;
use App\Models\ClientsModel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class DepositoController extends Controller {

    private $dados = [];

    public function pay(BoletosModel $boletosModel, $boleto_id_crypt) {
        $boleto_id = Crypt::decrypt($boleto_id_crypt);
        $this->dados['boleto'] = $boletosModel->find($boleto_id);
        return view('client.deposits.deposit_pay', $this->dados);
    }

    public function pay_store(Request $request, BoletosModel $boletosModel, $id_compra_crypt) {
        $id_compra = Crypt::decrypt($id_compra_crypt);

        $comprovante = $request->file('comprovante');
        if (!$comprovante) {
            return redirect()->back();
        }
        $comprovante->store('comprovantes');

        $update_compra = [
            'status' =>  'comprovante_enviado',
            'meioPagamento' =>  'boleto',
            'ticket' =>  $comprovante->hashName(),
        ];
        $boletosModel->find($id_compra)->update($update_compra);

        return redirect('client/meu_plano')->with('alert', 'Comprovante Enviado, Aguarde a Confirmação');
    }
}
