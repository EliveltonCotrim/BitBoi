<?php

namespace App\Transactions;

use App\Models\BalancesModel;
use App\Models\BoletosModel;
use App\Models\SaquesModel;
use Carbon\Carbon;

class Balance {

    public function balance($cliente_id, $coin) {
        return $this->balances($cliente_id, $coin)['saldo_disponivel'];
    }

    public function balances($cliente_id, $coin) {
        $last = BalancesModel::getLast($cliente_id, $coin);
        $saldo_atual = isset($last->courentBalance) ? $last->courentBalance : 0;
        $saldo_anterior = isset($last->previousBalance) ? $last->previousBalance : 0;

        // dd($coin);
        // dd(SaquesModel::totalPendentes($cliente_id, $coin));

        $total_saques_pendentes = SaquesModel::totalPendentes($cliente_id, $coin);

        // $vendas_pendentes = MercadoModel::getTotalPendente($this->id_cliente, 'venda', $this->moeda, '');
        // $total_vendas_pendentes = $vendas_pendentes->total ?? 0;

        $total_vendas_pendentes = 0;

        $saldoDisponivel = $saldo_atual - $total_saques_pendentes - $total_vendas_pendentes;
        $totais = [
            'saldo_disponivel' => $saldoDisponivel,
            'saldo_atual' => $saldo_atual,
            'saldo_anterior' => $saldo_anterior,
            'saque_pendente' => $total_saques_pendentes,
            'total_vendas_pendentes' => $total_vendas_pendentes,
        ];
        return $totais;
    }

    public static function credit($cliente_id, $value, $coin, $reference, $observation = '', $pedido_id = '') {
        $balance = BalancesModel::getLast($cliente_id, $coin);

        if ($balance->count() == 0) {
            $courentBalance = 0;
            $newBalance = $value;
        } else {
            $courentBalance = $balance->courentBalance;
            $newBalance = $courentBalance + $value;
        }

        $insert = [
            'client_id' => $cliente_id,
            'reference' => $reference,
            'operation' => 'c',
            'coin' => $coin,
            'value' => $value,
            'courentBalance' => $newBalance,
            'previousBalance' => $courentBalance,
            'observation' => $observation,
            'created_at' => Carbon::now(),
        ];

        if ($pedido_id != '') {
            $insert['pedido_id'] = $pedido_id;
        }

        return BalancesModel::create($insert);
    }

    public static function debit($cliente_id, $value, $coin, $reference, $observation = '') {
        $balance = BalancesModel::getLast($cliente_id, $coin);

        if ($balance->count() == 0) {
            $courentBalance = 0;
            $newBalance = $value;
        } else {
            $courentBalance = $balance->courentBalance;
            $newBalance = $courentBalance - $value;
        }

        $insert = [
            'client_id' => $cliente_id,
            'reference' => $reference,
            'operation' => 'd',
            'coin' => $coin,
            'value' => $value,
            'courentBalance' => $newBalance,
            'previousBalance' => $courentBalance,
            'observation' => $observation,
            'created_at' => Carbon::now(),
        ];

        return BalancesModel::insertGetId($insert);
    }
}
