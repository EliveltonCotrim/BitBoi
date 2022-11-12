<?php

namespace App\Http\Livewire;

use App\Models\BoletosModel;
use App\Models\ClientsModel;
use App\Models\NumbersModel;
use App\Src\Asaas\AsaasClient;
use App\Src\Asaas\AsaasPayments;
use App\Src\Plans\PlanClient;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Cartaopay extends Component {

    public $message;

    public $parcela = 1;
    public $parcelas = [];

    public $name;
    public $email;
    public $telefone;
    public $cep;
    public $cpf;

    public $card_number;
    public $date;
    public $cvv;
    public $endereco;

    public $valor;

    public $deposit_id;

    public function mount($deposit_id_crypt) {
        $this->deposit_id = $deposit_id_crypt;

        $deposit_id = Crypt::decrypt($this->deposit_id);

        $deposit = BoletosModel::find($deposit_id);
        $this->valor = $deposit->valor;

        $valor_parcela = $this->valor;

        $parcelas = $this->valor < 200 ? 1 : 12;
        for ($i = 1; $i <= $parcelas; $i++) {
            $valor_parcela = $this->round_up($this->valor / $i, 2);
            $this->parcelas[$i] = ['quantidade' => $i, 'valor' => $valor_parcela];
        }
    }

    private function round_up($value, $precision) {
        $pow = pow(10, $precision);
        return (ceil($pow * $value) + ceil($pow * $value - ceil($pow * $value))) / $pow;
    }

    public function render() {
        return view('client.deposits.cartaopay')->layout('layouts.blank');
    }

    public function process(AsaasClient $asaasClient, AsaasPayments $asaasPayments) {
        $this->message = '';
        if ($this->name == '') {
            $this->message = 'Informe o Nome';
            return;
        }

        if ($this->cpf == '') {
            $this->message = 'Informe o CPF';
            return;
        }

        if ($this->card_number == '') {
            $this->message = 'Informe o Nº do Cartão';
            return;
        }

        if ($this->date == '') {
            $this->message = 'Informe a Validade do Cartão';
            return;
        }

        if ($this->cvv == '') {
            $this->message = 'Informe o código de 3 dígitos do verso do Cartão';
            return;
        }

        $deposit_id = Crypt::decrypt($this->deposit_id);

        $deposit = BoletosModel::find($deposit_id);
        $valor = $deposit->valor;

        $client_id = $deposit->client_id;
        $cliente = ClientsModel::find($client_id);

        $client_id = $deposit->client_id;
        $cliente = ClientsModel::find($client_id);
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
                $this->message = 'Falha';
                return;
            }
        } else {
            $assas_id = $cliente->codigo_assas;
        }

        try {
            $validade = explode('/', $this->date);

            $body_array = [
                'customer' => $assas_id,
                'dueDate' => now()->format('Y-m-d'),
                'value' => $valor,
                'description' => 'Pagamento de Plano',
                'billingType' => 'CREDIT_CARD',
                "installmentCount" => $this->parcela,
                // "installmentValue" => $valor,
                "installmentValue" => $this->parcelas[$this->parcela]['valor'],
                "creditCard" => [
                    "holderName" => $this->name,
                    "number" => $this->card_number,
                    "expiryMonth" => $validade[0],
                    "expiryYear" => $validade[1],
                    "ccv" => $this->cvv
                ],
                "creditCardHolderInfo" => [
                    "name" => $this->name,
                    "cpfCnpj" => $this->cpf,
                    "email" => $this->email,
                    "postalCode" => $this->cep,
                    "address" => $this->endereco,
                    "addressNumber" => '0',
                    "addressComplement" => '',
                    "phone" => $this->telefone,
                    "mobilePhone" => $this->telefone
                ],
            ];

            $result = $asaasPayments->create($body_array);
            if ($result['status'] == 'CONFIRMED') {
                if ($deposit && $deposit->dataConfirmacao == '') {
                    $update = [
                        'tipo' => 'cartao_credito',
                        'meioPagamento' => 'cartao_credito',
                        'transaction_id' => $result['id'],
                        'json' => json_encode($result),
                        'dataConfirmacao' => now(),
                        'status' => 'confirmado',
                    ];
                    $deposit->update($update);

                    $client_id = $deposit->client_id;
                    $planClient = new PlanClient();
                    $plan_client = $planClient->get($client_id);
                    $client_plan_id = $plan_client['cliente_plano_id'];
                    $days_to_add = $deposit->plan->days;
                    $planClient->update($client_plan_id, $days_to_add);
                }
            }

            $this->message = 'Transação Confirmada';
            return redirect('client/meu_plano')->with('alert', 'Pagamento Confirmado');
        } catch (Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $erros_result = '';

            foreach ($errors['errors'] as $erro) {
                $erros_result .= $erro['description'] . '<br>';
            }
            $this->message = $erros_result;
            return;
        }
    }
}
