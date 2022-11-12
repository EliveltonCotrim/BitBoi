<?php

namespace App\Src\Asaas;

use App\Models\BoletosModel;
use App\Src\Plans\PlanClient;
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

            $deposit = BoletosModel::where('transaction_id', $id)
                ->with('plan')
                ->first();

            if ($deposit && $deposit->dataConfirmacao == '') {
                $update = [
                    'dataConfirmacao' => Carbon::now(),
                    'status' => 'confirmado',
                ];
                $deposit->update($update);

                // $client_id = $deposit->client_id;
                // $planClient = new PlanClient();
                // $plan_client = $planClient->get($client_id);
                // $client_plan_id = $plan_client['cliente_plano_id'];
                // $days_to_add = $deposit->plan->days;
                // $planClient->update($client_plan_id, $days_to_add);
            }
        }

        return response()->json([''], 200);
    }
}
