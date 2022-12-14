<?php

namespace App\Src\Asaas;

use App\Models\BoletosModel;
use App\Models\Purchases;
use App\Src\Plans\PlanClient;
use App\Src\Transactions\Balance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AsaasReceived {

    public function index(Request $request) {
        $post = $request->all();

        Log::notice(['assas', $post]);

        if (isset($post['event']) && ($post['event'] == 'PAYMENT_RECEIVED' || $post['event'] == 'PAYMENT_CONFIRMED')) {

            $id = $post['payment']['id'];
            $status = $post['payment']['status'];
            // $id = 2;

            $deposit = BoletosModel::with('purchase')->where('transaction_id', $id)->first();

            $update = [
                'dataConfirmacao' => now(),
                'status' => 'confirmado',
            ];

            $dataPurchase = [
                'status' => 'confirmada',
            ];

            $resultDeposit = $deposit->update($update);

            if ($resultDeposit) {
                Purchases::where('id', $deposit->purchase_id)->update($dataPurchase);
                $value = $deposit->valor;

                if ($deposit->purchase->plan_id) {
                    $coin = $deposit->purchase->plan->coin->name;
                } else {
                    $coin = $deposit->purchase->coin->name;
                }

                Balance::credit($deposit->user_id, $value, 'investimento', $coin);
            }


            // $deposit = BoletosModel::where('transaction_id', 1)
            //     // ->with('plan')
            //     ->first();

            // if ($deposit && $deposit->dataConfirmacao == '') {
            //     $update = [
            //         'dataConfirmacao' => Carbon::now(),
            //         'status' => 'confirmado',
            //     ];
            //     $deposit->update($update);

            //     // $client_id = $deposit->client_id;
            //     // $planClient = new PlanClient();
            //     // $plan_client = $planClient->get($client_id);
            //     // $client_plan_id = $plan_client['cliente_plano_id'];
            //     // $days_to_add = $deposit->plan->days;
            //     // $planClient->update($client_plan_id, $days_to_add);
            // }
        }

        return response()->json([''], 200);
    }
}
