<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportBoletos;
use App\Http\Controllers\Controller;
use App\Models\BoletosModel;
use App\Models\ClientsModel;
use App\Models\Coins;
use App\Models\ParametersModel;
use App\Models\Purchases;
use App\Models\Rendimentos;
use App\Models\RendimentosPagos;
use App\Models\SaquesModel;
use App\Models\User;
use App\Src\Transactions\Balance;
use App\Src\Transactions\Import;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    private $data = [];

    public function index()
    {
        // pagamento do dia e mes;;
        $dia = date('d');
        $dateAtual = date('Y-m-d');
        $pagadomentoDia = 0;
        $rendimentosPrevisto = 0;
        $valorTotalPagamentoMes = 0;

        $ultimosClients = User::orderBy('name', 'ASC')->limit(5)->get();
        // $boletos = BoletosModel::where('status', 'confirmado')->whereDay('dataConfirmacao', $day)->get();

        // foreach ($boletos as $key => $boleto) {
        //     $timeInvestment = Carbon::parse($boleto->dataConfirmacao)->DiffInMonths($dataAtual);

        //     if ($timeInvestment >= $boleto->purchase->time_pri) {
        //         $valorTotalPagamentoDia += (($boleto->valor * $boleto->purchase->percentual_rendimento) / 100);
        //     }
        // }

        $boletosDia = BoletosModel::where('status', 'confirmado')->whereDay('dataConfirmacao', $dia)->get();
        $boletos = BoletosModel::where('status', 'confirmado')->get();

        foreach ($boletos as $key => $boleto) {
            if ($boleto->purchase->coin_id) {
                $percentualRendimento = $boleto->purchase->coin->profit_percentage;
            } else {
                $percentualRendimento = $boleto->purchase->plan->coin->profit_percentage;
            }

            $rendimentosPrevisto +=  (($boleto->valor * $percentualRendimento) / 100) * $boleto->purchase->time_pri;
        }

        foreach ($boletosDia as $key => $boleto) {
            $timeInvestment = Carbon::parse($boleto->dataConfirmacao)->DiffInMonths($dateAtual);
            $historicoPagamento = RendimentosPagos::where('rendimentos_pagos.boleto_id', $boleto->id)
            ->get();

            $totaLancado = $historicoPagamento->count();
            $dt_lancadas = [];
            foreach ($historicoPagamento as $key => $historico) {
                $dt_lancadas[$key] = date('Y-m-d', strtotime($historico->created_at));
            }

            if ($timeInvestment > $totaLancado) {
                if (in_array($dateAtual, $dt_lancadas)) {
                } else {
                    if ($boleto->purchase->coin_id) {
                        $percentualRendimento = $boleto->purchase->coin->profit_percentage;
                    } else {
                        $percentualRendimento = $boleto->purchase->plan->coin->profit_percentage;
                    }

                    $pagadomentoDia += ($boleto->valor * $percentualRendimento) / 100;
                }
            }
        }

        $this->data['pays'] = BoletosModel::where('status', 'confirmado')
            ->with('user')
            ->latest()->limit(10)->get();

        $this->data['clients'] = $ultimosClients;
        $this->data['valorPagamentoDia'] = $pagadomentoDia;
        $this->data['rendimentosPrevisto'] = $rendimentosPrevisto;

        return view('admin.home_admin', $this->data);
    }

    public function sobre()
    {
        $param = ParametersModel::find(1);
        return view('admin.sobre', compact('param'));
    }

    public function sobre_store(Request $request)
    {
        ParametersModel::find(1)->update(['sobre' => $request->sobre]);
        return redirect('admin/sobre');
    }

    public function termos()
    {
        $param = ParametersModel::find(1);
        return view('admin.termos', compact('param'));
    }

    public function termos_store(Request $request)
    {
        $data = $request->all();

        $data = [
            'termo_compra' => $request->termos
        ];

        // ParametersModel::find(1)->update(['termo_compra' => $request->termos]);

        ParametersModel::where('id', 1)->update($data);

        return redirect('admin/termos');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function imp(Import $import)
    {
        $import->start();
    }

    public function estrategia()
    {
        return view('admin.estrategia');
    }

    public function lastPaysSearch(Request $request)
    {
        $dia = date('d');
        $dateAtual = date('Y-m-d');
        $pagadomentoDia = 0;

        $boletosDia = BoletosModel::where('status', 'confirmado')->whereDay('dataConfirmacao', $dia)->get();
        foreach ($boletosDia as $key => $boleto) {
            $timeInvestment = Carbon::parse($boleto->dataConfirmacao)->DiffInMonths($dateAtual);
            $historicoPagamento = RendimentosPagos::where('rendimentos_pagos.boleto_id', $boleto->id)
            ->get();

            $totaLancado = $historicoPagamento->count();
            $dt_lancadas = [];
            foreach ($historicoPagamento as $key => $historico) {
                $dt_lancadas[$key] = date('Y-m-d', strtotime($historico->created_at));
            }

            if ($totaLancado == $boleto->purchase->time_pri) {
                BoletosModel::where('id', $boleto->id)->update([
                    'status' => 'encerrado',
                    'dt_encerramento' => $dateAtual,
                ]);

                Purchases::where('id', $boleto->purchase->id)->update([
                    'status' => 'encerrada',
                    'dt_encerramento' => $dateAtual,
                ]);
            } else {
                if ($timeInvestment > $totaLancado) {
                    if (in_array($dateAtual, $dt_lancadas)) {
                    } else {
                        $pagadomentoDia += ($boleto->valor * $boleto->purchase->percentual_rendimento) / 100;
                    }
                }
            }
        }

        $this->data['filters'] = $request->all();

        $this->data['pays'] = BoletosModel::whereHas('user', function ($query) use ($request) {
            if ($request->name) {
                $query->where('name', 'LIKE', "%{$request->client_boleto}%");
            }
        })->where('status', 'confirmado')
            ->latest()
            ->limit(10)
            ->get();

        $this->data['clients'] = User::orderBy('name', 'ASC')->limit(5)->get();

        $this->data['valorPagamentoDia'] = $pagadomentoDia;

        return view('admin.home_admin', $this->data);
    }

    public function lastCadastSearch(Request $request)
    {
        $dia = date('d');
        $dateAtual = date('Y-m-d');
        $pagadomentoDia = 0;

        $boletosDia = BoletosModel::where('status', 'confirmado')->whereDay('dataConfirmacao', $dia)->get();
        foreach ($boletosDia as $key => $boleto) {
            $timeInvestment = Carbon::parse($boleto->dataConfirmacao)->DiffInMonths($dateAtual);
            $historicoPagamento = RendimentosPagos::where('rendimentos_pagos.boleto_id', $boleto->id)
            ->get();

            $totaLancado = $historicoPagamento->count();
            $dt_lancadas = [];
            foreach ($historicoPagamento as $key => $historico) {
                $dt_lancadas[$key] = date('Y-m-d', strtotime($historico->created_at));
            }

            if ($totaLancado == $boleto->purchase->time_pri) {
                BoletosModel::where('id', $boleto->id)->update([
                    'status' => 'encerrado',
                    'dt_encerramento' => $dateAtual,
                ]);

                Purchases::where('id', $boleto->purchase->id)->update([
                    'status' => 'encerrada',
                    'dt_encerramento' => $dateAtual,
                ]);
            } else {
                if ($timeInvestment > $totaLancado) {
                    if (in_array($dateAtual, $dt_lancadas)) {
                    } else {
                        $pagadomentoDia += ($boleto->valor * $boleto->purchase->percentual_rendimento) / 100;
                    }
                }
            }
        }

        $this->data['filters'] = $request->all();

        $this->data['pays'] = BoletosModel::where('status', 'confirmado')
        ->with('user')
        ->latest()->limit(10)->get();
        $this->data['clients'] = User::where(function ($query) use ($request) {
            if ($request->name) {
                $query->where('name', 'LIKE', "%{$request->name}%");
            }
        })->orderBy('name', 'ASC')->limit(5)->get();

        $this->data['valorPagamentoDia'] = $pagadomentoDia;

        return view('admin.home_admin', $this->data);
    }

    public function investimentos()
    {
        $boletos = BoletosModel::where('status', 'confirmado')->get();
        $parametrizacao = ParametersModel::first();
        $dt_atual = date('Y-m-d');
        $valor_total = 0;

        foreach ($boletos as $key => $boleto) {
            $dt_confirmacao = date('Y-m-d', strtotime($boleto->dataConfirmacao));

            $timeInvestment = Carbon::parse($dt_confirmacao)->DiffInMonths($dt_atual);
            dd($timeInvestment);
            if ($timeInvestment >= $parametrizacao->investiment_cycle) {
                $this->dados['boletos'][$key] = $boleto;
                $valor_total  +=  $boleto->valor;
            }
        }

        $this->dados['valor_total'] = $valor_total;

        return view('admin.boletos.lancar_investimentos', $this->dados);
    }

    public function lancarInvestimentos(Request $request)
    {
        $this->dados['filters'] = $request->all();
        $rendimentoTotal = 0;
        $hitoricoRendimento = Rendimentos::where('dt_lacamento', $request->dt_lancamento)
        ->count();



        if ($hitoricoRendimento > 0) {
            return redirect()->back()->with('alert', 'Já existe um lançamento para essa data!');
        }

        if (empty($request->dt_lancamento)) {
            $day = date('d');
        } else {
            $day = date('d', strtotime($request->dt_lancamento));
        }

        $pays_day = [];
        $dt_atual = date('Y-m-d');
        $qtd_coin = 0;

        if ($hitoricoRendimento) {
            return redirect()->back()->with('error', 'Já existe um lançamento para essa data');
        }

        $boletos = BoletosModel::where('status', 'confirmado')->whereDay('dataConfirmacao', $day)->get();

        foreach ($boletos as $key1 => $boleto) {
            // Tempo de investimento
            $timeInvestment = Carbon::parse($boleto->dataConfirmacao)->DiffInMonths($dt_atual);
            $historicoPagamento = RendimentosPagos::where('boleto_id', $boleto->id)->get();

            $totaLancado = $historicoPagamento->count();

            if ($timeInvestment > $totaLancado) {
                if ($boleto->purchase->coin_id) {
                    $percentualRendimento = $boleto->purchase->coin->profit_percentage;
                } else {
                    $percentualRendimento = $boleto->purchase->plan->coin->profit_percentage;
                }

                $rendimentoTotal += round(($boleto->valor * $percentualRendimento) / 100, 2);
                $rendimentoAtual = round(($boleto->valor * $percentualRendimento) / 100, 2);

                $qtd_coin += $boleto->purchase->quantity_coin;
                $boleto['rendimento_atual'] = $rendimentoAtual;
                $pays_day[$key1] = $boleto;
            }
        }

        $this->dados['rendimentoTotal'] = $rendimentoTotal;
        $this->dados['qtd_coin'] = $qtd_coin;
        $this->dados['pays_day'] = $pays_day;


        return view('admin.boletos.lancar_pagamentos', $this->dados);
    }

    public function lancar(Request $request, Balance $balance)
    {
        $data = Crypt::decrypt($request->dt);
        $rendimentosPago = Rendimentos::where('dt_lacamento', $request->dt)->count();
        $day = date('d', strtotime($data));
        $rendimentoTotal = 0;
        $rendimento = 0;

        // $data = date('2023-02-13');

        // $day = date('d', strtotime('2023-01-12'));

        if ($rendimentosPago != 0) {
            return redirect()->back()->with('erro', 'Já foi lançado os rendimentos para está data!');
        } else {
            $boletos = BoletosModel::where('status', 'confirmado')->whereDay('dataConfirmacao', $day)->get();

            foreach ($boletos as $key => $boleto) {
                // Calcular o tempo de investimento
                $timeInvestment = Carbon::parse($boleto->dataConfirmacao)->DiffInMonths($data);

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
                'dt_lacamento' => date('Y-m-d h:i:s'),
                'valor_total' => $rendimentoTotal,
            ]);

            if ($storeRendimentos) {
                foreach ($boletos as $key => $boleto) {
                    $timeInvestment = Carbon::parse($boleto->dataConfirmacao)->DiffInMonths($data);

                    $historicoPagamento = RendimentosPagos::join('boletos', 'rendimentos_pagos.boleto_id', 'boletos.id')
                        ->where('rendimentos_pagos.boleto_id', $boleto->id)
                        ->count();

                    if ($historicoPagamento == $boleto->purchase->time_pri) {
                        BoletosModel::where('id', $boleto->id)->update([
                            'status' => 'encerrado',
                            'dt_encerramento' => $data,

                        ]);

                        Purchases::where('id', $boleto->purchase->id)->update([
                            'status' => 'encerrada',
                            'dt_encerramento' => $data,

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

                            // $balance->credit(
                            //     $boleto->user_id,
                            //     $rendimento,
                            //     'rendimento',
                            //     $moeda,
                            // );

                            $historicoPagamento = RendimentosPagos::join('boletos', 'rendimentos_pagos.boleto_id', 'boletos.id')
                            ->where('rendimentos_pagos.boleto_id', $boleto->id)
                            ->count();

                            if ($historicoPagamento == $boleto->purchase->time_pri) {
                                BoletosModel::where('id', $boleto->id)->update([
                                    'status' => 'encerrado',
                                    'dt_encerramento' => $data,

                                ]);

                                Purchases::where('id', $boleto->purchase->id)->update([
                                    'status' => 'encerrada',
                                    'dt_encerramento' => $data,

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

                return redirect()->route('boletos.index')->with('success', 'Rendimentos lançados com sucesso!');
            } else {
                return redirect()->back()->with('error', 'Erro ao lançar os rendimentos!');
            }
        }
    }

    public function paymentDay()
    {
        $day = date('d');
        $dt_atual = date('Y-m-d');
        $pays_day = [];
        $rendimentoTotal = 0;
        $qtd_coin = 0;

        // $dt_atual = date('2023-02-13');

        // $day = date('d', strtotime('2023-01-12'));

        $boletos = BoletosModel::where('status', 'confirmado')->whereDay('dataConfirmacao', $day)->get();

        foreach ($boletos as $key1 => $boleto) {
            $timeInvestment = Carbon::parse($boleto->dataConfirmacao)->DiffInMonths($dt_atual);
            $historicoPagamento = RendimentosPagos::where('rendimentos_pagos.boleto_id', $boleto->id)
                    ->get();

            $totaLancado = $historicoPagamento->count();
            $dt_lancadas = [];

            foreach ($historicoPagamento as $key2 => $historico) {
                $dt_lancadas[$key2] = date('Y-m-d', strtotime($historico->created_at));
            }

            if ($timeInvestment > $totaLancado) {
                if (in_array($dt_atual, $dt_lancadas)) {
                } else {
                    if ($boleto->purchase->coin_id != null) {
                        $percentualRendimento = $boleto->purchase->coin->profit_percentage;
                    } else {
                        $percentualRendimento = $boleto->purchase->plan->coin->profit_percentage;
                    }

                    $rendimentoTotal += ($boleto->valor * $percentualRendimento) / 100;
                    $rendimentoBoleto = ($boleto->valor * $percentualRendimento) / 100;

                    $qtd_coin += $boleto->purchase->quantity_coin;
                    $boleto['rendimento_atual'] = $rendimentoBoleto;
                    $pays_day[$key1] = $boleto;
                }
            }
        }

        $this->dados['rendimentoTotal'] = $rendimentoTotal;
        $this->dados['qtd_coin'] = $qtd_coin;
        $this->dados['dt_atual'] = $dt_atual;
        $this->dados['pays_day'] = $pays_day;

        return view('admin.boletos.pagamentos_do_dia', $this->dados);
    }

    // public function termosIndex()
    // {
    //     return view('admin.termos');
    // }

    // public function termosStore(Request $request)
    // {
    //     $data = $request->all();
    //     dd($data);
    //     // return view('admin.termos');
    // }

    public function sacsPendentes(Request $request, SaquesModel $saques)
    {
        $this->dados['filters'] = $request->except('_token');


        $this->dados['saques'] = $saques->whereHas('client', function ($query) use ($request) {
            if ($request->name) {
                $query->where('name', 'LIKE', "%{$request->name}%");
            }
        })->where('status', 'pendente')->paginate(10);


        return view('admin.saques.saques_pendentes', $this->dados);
    }

    public function sacsConfirmados(Request $request, SaquesModel $saques)
    {
        $this->dados['filters'] = $request->except('_token');


        $this->dados['saques'] = $saques->whereHas('client', function ($query) use ($request) {
            if ($request->name) {
                $query->where('name', 'LIKE', "%{$request->name}%");
            }
        })->where('status', 'pago')->paginate(10);

        return view('admin.saques.saques_confirmados', $this->dados);
    }

    public function ajaxValueCoin(Request $request)
    {
        $coin_value = [];

        $coin = Coins::with('latestCotacao')
        ->where('id', $request->id_coin)
        ->where('status', 'active')->first();

        $coin_value['coin'] = $coin->name;
        $coin_value['value'] = $coin->latestCotacao->value;

        return response()->json($coin_value);
    }

    // Exportar Boletos
    public function exportBoletos()
    {
        return Excel::download(new ExportBoletos(), 'boletos_confirmados.xlsx');
    }


    public function rendimentos(Request $request, RendimentosPagos $rendimentos)
    {
        $this->dados['filters'] = $request->except('_token');

        $this->dados['rendimentos'] = $rendimentos->whereHas('boleto', function ($query) use ($request) {
            if ($request->name) {
                $query->whereHas('user', function ($query) use ($request) {
                    $query->where('name', 'LIKE', "%{$request->name}%");
                });
            }
        })->wherehas('rendimentos', function ($query) use ($request) {
            if ($request->data) {
                $query->where('dt_lacamento', $request->data);
            }
        })->paginate(10);



        return view('admin.rendimentos.rendimentos_list', $this->dados);
    }
}
