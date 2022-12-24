<?php

namespace App\Console\Commands;

use App\Models\BoletosModel;
use App\Models\Purchases;
use App\Models\Rendimentos;
use App\Models\RendimentosPagos;
use App\Src\Transactions\Balance;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LancarRendimentos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lancar:rendimentos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'comando para lançar diariamente os rendimentos de investimentos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dataAtual = date('Y-d-m');
        $dia = date('d', strtotime($dataAtual));
        $rendimentoTotal = 0;
        $rendimento = 0;


        $dataAtual = date('2023-01-25');

        $dia = date('d', strtotime('2023-01-24'));

        $rendimentosPago = Rendimentos::where('dt_lacamento', $dataAtual)->count();


        if ($rendimentosPago != 0) {
            Log::info('cron jobs - comando: lancar:rendimentos, msg: Rendimentos já lançados para o dia ' . $dataAtual);
        } else {
            $boletos = BoletosModel::where('status', 'confirmado')->whereDay('dataConfirmacao', $dia)->get();

            foreach ($boletos as $key => $boleto) {
                // Calcular o tempo de investimento
                $timeInvestment = Carbon::parse($boleto->dataConfirmacao)->DiffInMonths($dataAtual);

                // Histórico de rendimentos do investimento
                $historicoPagamento = RendimentosPagos::join('boletos', 'rendimentos_pagos.boleto_id', 'boletos.id')
                        ->where('rendimentos_pagos.boleto_id', $boleto->id)
                        ->count();

                if ($historicoPagamento == $boleto->purchase->time_pri) {
                } else {
                    if ($timeInvestment > $historicoPagamento) {
                        if ($boleto->purchase->coin_id) {
                            $percentualRendimento = $boleto->purchase->coin->profit_percentage;
                        } else {
                            $percentualRendimento = $boleto->purchase->plan->coin->profit_percentage;
                        }

                        $rendimentoTotal += ($boleto->valor * $percentualRendimento) / 100;
                    }
                }
            }

            $storeRendimentos = Rendimentos::create([
                'dt_lacamento' => $dataAtual,
                'valor_total' => $rendimentoTotal,
            ]);

            foreach ($boletos as $key => $boleto) {
                $timeInvestment = Carbon::parse($boleto->dataConfirmacao)->DiffInMonths($dataAtual);

                $historicoPagamento = RendimentosPagos::join('boletos', 'rendimentos_pagos.boleto_id', 'boletos.id')
                    ->where('rendimentos_pagos.boleto_id', $boleto->id)
                    ->count();

                if ($historicoPagamento == $boleto->purchase->time_pri) {
                    BoletosModel::where('id', $boleto->id)->update([
                        'status' => 'encerrado',
                        'dt_encerramento' => $dataAtual,
                    ]);

                    Purchases::where('id', $boleto->purchase->id)->update([
                        'status' => 'encerrada',
                        'dt_encerramento' => $dataAtual,
                    ]);

                    if ($boleto->purchase->coin_id) {
                        $moeda = $boleto->purchase->coin->name;
                    } else {
                        $moeda = $boleto->purchase->plan->coin->name;
                    }

                    $balance = new Balance();

                    $balance->credit($boleto->user_id, $boleto->valor, 'investimento_encerrado', $moeda);
                    $balance->debit($boleto->user_id, $boleto->valor, 'investimento', $moeda);

                    $rendimentosPagos = RendimentosPagos::where('boleto_id', $boleto->id)->sum('valor');

                    $balance->credit($boleto->user_id, $rendimentosPagos, 'rendimento', $moeda);
                } else {
                    if ($timeInvestment > $historicoPagamento) {
                        if ($boleto->purchase->coin_id) {
                            $percentualRendimento = $boleto->purchase->coin->profit_percentage;
                        } else {
                            $percentualRendimento = $boleto->purchase->plan->coin->profit_percentage;
                        }

                        $rendimento = ($boleto->valor * $percentualRendimento) / 100;

                        $dataRendimentoPago = [
                            'rendimentos_id' => $storeRendimentos->id,
                            'boleto_id' => $boleto->id,
                            'valor' => $rendimento,
                        ];

                        RendimentosPagos::create($dataRendimentoPago);

                        if ($boleto->purchase->coin_id) {
                            $moeda = $boleto->purchase->coin->name;
                        } else {
                            $moeda = $boleto->purchase->plan->coin->name;
                        }

                        $historicoPagamento = RendimentosPagos::join('boletos', 'rendimentos_pagos.boleto_id', 'boletos.id')
                        ->where('rendimentos_pagos.boleto_id', $boleto->id)
                        ->count();

                        if ($historicoPagamento == $boleto->purchase->time_pri) {
                            BoletosModel::where('id', $boleto->id)->update([
                                'status' => 'encerrado',
                                'dt_encerramento' => $dataAtual,

                            ]);

                            Purchases::where('id', $boleto->purchase->id)->update([
                                'status' => 'encerrada',
                                'dt_encerramento' => $dataAtual,

                            ]);

                            if ($boleto->purchase->coin_id) {
                                $moeda = $boleto->purchase->coin->name;
                            } else {
                                $moeda = $boleto->purchase->plan->coin->name;
                            }

                            $balance = new Balance();

                            $balance->credit($boleto->user_id, $boleto->valor, 'investimento_encerrado', $moeda);
                            $balance->debit($boleto->user_id, $boleto->valor, 'investimento', $moeda);

                            $rendimentosPagos = RendimentosPagos::where('boleto_id', $boleto->id)->sum('valor');

                            $balance->credit($boleto->user_id, $rendimentosPagos, 'rendimento', $moeda);
                        }
                    }
                }
            }
        }

        $this->info('Lançando rendimentos...');
        $this->info('Rendimentos lançados com sucesso!');
        return Command::SUCCESS;
    }
}
