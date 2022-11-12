<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\BoletosModel;
use App\Models\ClientsModel;
use App\Src\Gerencianet\PixCobCreate;
use App\Src\Gerencianet\PixConsult;
use App\Src\Utils\Utils;
use App\Transactions\Balance;
use App\Transactions\Comissao;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class GerencianetController extends Controller {

    public function pix_create(Request $request, $deposit_id_crypt) {
        $deposit_id = Crypt::decrypt($deposit_id_crypt);
        $deposit = BoletosModel::find($deposit_id);
        $valor = number_format($deposit->valor, 2, '.', '');

        $client_id = $deposit->client_id;
        $cliente = ClientsModel::find($client_id);
        $cpf = Utils::soNumeros($cliente->cpf);

        try {
            $pix_api = new PixCobCreate();
            $result = $pix_api->create($valor, $cliente->nome, $cpf, 'Deposito');

            // dd($result);

            $update = [
                'tipo' => 'deposito',
                'meioPagamento' => 'pix',
                'transaction_id' => $result['txid'],
                'json' => json_encode($result),
            ];
            $deposit->update($update);

            return redirect('client/gerencianet/pix/pay/' . $deposit_id_crypt);
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('alert', 'Não foi possível gerar a cobrança PIX');
        }
    }

    public function pix_pay($deposit_id_crypt) {
        $deposit_id = Crypt::decrypt($deposit_id_crypt);
        $deposit = BoletosModel::find($deposit_id);
        $valor = number_format($deposit->valor, 2, '.', '');

        $dados_pix = json_decode($deposit->json, true);

        $recebedor = 'G';
        $cidade = 'Cuiaba';

        $location = $dados_pix['loc']['location'];

        $qrcode_text = "" .
            "00" . "02" .  "01" .
            "26" . $this->tamanho("0014br.gov.bcb.pix2561" . $dados_pix['loc']['location']) .
            "00" . "14" . "br.gov.bcb.pix" .
            "25" . $this->tamanho($location) . $location .
            "52" . "04" . "8999" .
            "53" . "03" . "986" .
            "58" . "02" . "BR" .
            "59" . $this->tamanho($recebedor) . $recebedor .
            "60" . $this->tamanho($cidade) . $cidade .
            "62" . "07" . "0503***" .
            "63" . "04";

        $checksum = $this->crcChecksum($qrcode_text);
        $qrcode_text .= $checksum;

        $qrcode = $qrcode_text;

        return view('client.deposits.gerencianet_pix_pay', compact('deposit', 'qrcode'));
    }

    private function tamanho($tx) {
        if (strlen($tx) > 99) {
            die("Tamanho máximo deve ser 99, inválido: $tx possui " . strlen($tx) . " caracteres.");
        }
        return str_pad(strlen($tx), 2, "0", STR_PAD_LEFT);
    }

    private function crcChecksum($str) {
        function charCodeAt($str, $i) {
            return ord(substr($str, $i, 1));
        }

        $crc = 0xFFFF;
        $strlen = strlen($str);
        for ($c = 0; $c < $strlen; $c++) {
            $crc ^= charCodeAt($str, $c) << 8;
            for ($i = 0; $i < 8; $i++) {
                if ($crc & 0x8000) {
                    $crc = ($crc << 1) ^ 0x1021;
                } else {
                    $crc = $crc << 1;
                }
            }
        }
        $hex = $crc & 0xFFFF;
        $hex = dechex($hex);
        $hex = strtoupper($hex);
        $hex = str_pad($hex, 4, '0', STR_PAD_LEFT);

        return $hex;
    }

    public function consult(Request $request) {
        if (!$deposit_id = Crypt::decrypt($request->compra)) {
            echo '';
            return;
        }

        $deposit = BoletosModel::find($deposit_id);
        if ($deposit->transaction_id == '') {
            echo '';
            return;
        }

        if ($deposit->status == 'pendente') {
            $tx_id = $deposit->transaction_id;
            $result = PixConsult::consult($tx_id);

            $status = $result['status'];
            if ($status == 'CONCLUIDA') {

                $update = [
                    'dataConfirmacao' => Carbon::now(),
                    'status' => 'confirmado',
                ];
                $deposit->update($update);

                $value = $deposit->valor;
                Balance::credit($deposit->client_id, $value, 'rs', 'credito');

                $comissao = new Comissao();
                $comissao->comissao_direta($deposit->client_id, $value);

                echo 'pago';
                return;
            } else {
                echo '';
                return;
            }
            echo '';
            return;
        } elseif ($deposit->state == 'confirmado') {
            echo 'pago';
            return;
        } else {
            echo '';
            return;
        }
        return;
    }
}
