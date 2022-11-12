<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\BoletosModel;
use App\Models\ClientsModel;
use App\Models\UsersModel;
use App\Src\Asaas\AsaasClient;
use App\Src\Asaas\AsaasPayments;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class AsaasController extends Controller {

    public function pix_create(
        AsaasClient $asaasClient,
        AsaasPayments $asaasPayments,
        $deposit_id_crypt
    ) {
        $deposit_id = Crypt::decrypt($deposit_id_crypt);
        $deposit = BoletosModel::find($deposit_id);
        $valor = $deposit->valor;

        $client_id = $deposit->user_id;
        $cliente = UsersModel::find($client_id);

        // dd($deposit_id, $valor, $client_id);

        if ($cliente->codigo_assas == '') {
            try {
                $result_client = $asaasClient->create(
                    $cliente->name,
                    $cliente->email,
                    $cliente->phone,
                    $cliente->cpf
                );

                $assas_id = $result_client['id'];
                $cliente->update(['codigo_assas' => $assas_id]);
            } catch (Exception $e) {
                $errors = json_decode($e->getMessage(), true);
                $erros_result = '';

                if (isset($errors['errors'])) {
                    foreach ($errors['errors'] as $erro) {
                        $erros_result .= $erro['description'] . '<br>';
                    }
                    $message = $erros_result;
                } else {
                    $message = json_encode($errors);
                }

                return redirect()->back()->with('alert', 'Falha ao gerar PIX -  ' . $message);
            }
        } else {
            $assas_id = $cliente->codigo_assas;
        }

        $body_array = [
            'billingType' => 'PIX',
            'customer' => $assas_id,
            'dueDate' => now()->format('Y-m-d'),
            'value' => $valor,
            'description' => 'Pagamento de Plano',
        ];

        try {
            $result = $asaasPayments->create($body_array);

            $url_pay = $result['invoiceUrl'];
            $update = [
                'tipo' => 'pagamento',
                'meioPagamento' => 'PIX',
                'transaction_id' => $result['id'],
                'json' => json_encode($result),
            ];
            $deposit->update($update);

            return redirect('client/asaas/pix/pay/' . Crypt::encrypt($deposit_id));
        } catch (Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $erros_result = '';

            if (isset($errors['errors'])) {
                foreach ($errors['errors'] as $erro) {
                    $erros_result .= $erro['description'] . '<br>';
                }
                $message = $erros_result;
            } else {
                $message = json_encode($errors);
            }

            return redirect()->back()->with('alert', 'Falha ao gerar PIX -  ' . $message);
        }
    }

    public function pix_pay(AsaasPayments $asaasPayments, $deposit_id_crypt) {
        $deposit_id = Crypt::decrypt($deposit_id_crypt);

        $deposit = BoletosModel::find($deposit_id);
        $dados_pix = json_decode($deposit->json, true);

        try {
            $result = $asaasPayments->pixQrCode($deposit->transaction_id);
            // $assas_id = $result_client['id'];
        } catch (Exception $e) {
            dd($e->getMessage());
        }

        return view('client.deposits.asaas_pix_pay', compact('deposit', 'result'));
    }

    public function consult(Request $request) {
        if (!$deposit_id = Crypt::decrypt($request->compra)) {
            echo '';
            return;
        }

        $deposit = BoletosModel::find($deposit_id);
        if ($deposit->transaction_id == ''  && $deposit->methoh != 'pix') {
            echo '';
            return;
        }

        if ($deposit->status == 'pendente') {
            $tx_id = $deposit->transaction_id;
            if ($deposit->status == 'confirmado') {
                echo 'pago';
                return;
            } else {
                echo '';
                return;
            }
            echo '';
            return;
        } elseif ($deposit->status == 'confirmado') {
            echo 'pago';
            return;
        } else {
            echo '';
            return;
        }
        echo '';
        return;
    }


    public function boleto_create(
        AsaasClient $asaasClient,
        AsaasPayments $asaasPayments,
        $deposit_id_crypt
    ) {

        $deposit_id = Crypt::decrypt($deposit_id_crypt);
        $deposit = BoletosModel::find($deposit_id);
        $valor = $deposit->valor;

        $client_id = $deposit->client_id;
        $cliente = ClientsModel::find($client_id);

        // dd($deposit_id, $valor, $client_id);

        if ($cliente->codigo_assas == '') {
            try {
                $result_client = $asaasClient->create(
                    $cliente->name,
                    $cliente->email,
                    $cliente->phone,
                    $cliente->cpf
                );

                $assas_id = $result_client['id'];

                $cliente->update(['codigo_assas' => $assas_id]);
            } catch (Exception $e) {
                dd($e->getMessage());
            }
        } else {
            $assas_id = $cliente->codigo_assas;
        }

        try {
            $result =   $asaasPayments->create(
                'BOLETO',
                $assas_id,
                date('Y-m-d'),
                $valor,
                'Deposito ',
                rand(100, 1000)
            );

            $update = [
                'tipo' => 'deposito',
                'meioPagamento' => 'boleto',
                'transaction_id' => $result['id'],
                'json' => json_encode($result),
            ];
            $deposit->update($update);

            return redirect('client/asaas/boleto/pay/' . $deposit_id_crypt);
        } catch (Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('alerts', 'Falha ao gerar Boleto -  ' . $e->getMessage());
        }
    }

    public function boleto_pay(AsaasPayments $asaasPayments, $deposit_id_crypt) {
        $deposit_id = Crypt::decrypt($deposit_id_crypt);

        $deposit = BoletosModel::find($deposit_id);
        $dados_asaas = json_decode($deposit->json, true);

        $boleto_url = $dados_asaas['bankSlipUrl'];

        return view('client.deposits.asaas_boleto_pay', compact('deposit', 'boleto_url'));
    }
}
