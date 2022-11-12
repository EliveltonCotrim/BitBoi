<?php

namespace App\Src\Plans;

use App\Models\Client_planModel;
use Carbon\Carbon;

class PlanClient {

    public function get($client_id) {
        $dados = [];

        $cliente_plano = Client_planModel::where('client_id', $client_id)
            ->first();
        if (!$cliente_plano) {
            $plan_id = Client_planModel::insertGetId(['client_id' => $client_id, 'created_at' => now(),]);
            $cliente_plano = Client_planModel::find($plan_id);
        }

        $cliente_plano_id =  $cliente_plano->id;

        $dados = [
            'cliente_plano_id' => $cliente_plano_id,
            'status' => 'inativo',
            'renovation' => '',
            'expiration' => '',
            'days_remaining' => '',
        ];

        if ($cliente_plano->expiration != '') {
            if ($cliente_plano->expiration->lte(now())) {
                $dados['status'] = 'inativo';
                $dados['renovation'] = $cliente_plano->renovation;
                $dados['expiration'] = $cliente_plano->expiration;
            } else {
                $dados['status'] = 'ativo';
                $dados['renovation'] = $cliente_plano->renovation;
                $dados['expiration'] = $cliente_plano->expiration;
                $dados['days_remaining'] = Carbon::now()
                    ->diffInDays($cliente_plano->expiration->format('Y/m/d 23:59:59'), false);
            }
        }

        return $dados;
    }

    public function update($client_plan_id, $days_to_add) {
        $client_plan = Client_planModel::find($client_plan_id);


        if ($client_plan->expiration == '') {
            $update = [
                'renovation' => now(),
                'expiration' => now()->addDays($days_to_add),
                'status' => 'renovado',
            ];
        } else {
            if ($client_plan->expiration->gt(now())) {
                $update = [
                    'renovation' => now(),
                    'expiration' => $client_plan->expiration->addDays($days_to_add),
                    'status' => 'renovado',
                ];
            } else {
                $update = [
                    'renovation' => now(),
                    'expiration' => now()->addDays($days_to_add),
                    'status' => 'renovado',
                ];
            }
        }
        $client_plan->update($update);
    }
}
