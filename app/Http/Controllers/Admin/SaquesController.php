<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateSaques;
use App\Http\Controllers\Controller;
use App\Models\ClientsModel;
use App\Models\ParametersModel;
use App\Models\SaquesModel;
use App\Src\Transactions\Balance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SaquesController extends Controller
{
    private $dados;
    private $saques;

    public function __construct(SaquesModel $saques)
    {
        $this->saques = $saques;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dados['saques'] = $this->saques->paginate(10);
        return view('admin.saques.saques_list', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->dados['titulo'] = 'saques';
        return view('admin.saques.saques_create', $this->dados);
    }

    // public function store(StoreUpdateSaques $request) {
    //     $this->saques->create($request->all());
    //     return redirect('admin/saques');
    // }

    public function show($id)
    {
        if (!$saques = $this->saques->find($id)) {
            return redirect()->back();
        }

        $this->dados['titulo'] = 'saques';
        $this->dados['saques'] = $saques;
        return view('admin.saques.saques_show', $this->dados);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{saques}Model  $saques
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $saques = $this->saques->find($id);
        $id_client = ClientsModel::where('user_id', $saques->user_id)->first()->id;
        $bank = ClientsModel::GetBancos($id_client);

        $this->dados['saques'] = $saques;
        $this->dados['titulo'] = 'saques';
        $this->dados['bank'] = $bank[$saques->banco];

        return view('admin.saques.saques_edit', $this->dados);
    }

    // public function update(StoreUpdateSaques $request, $id) {
    //     $this->saques->find($id)->update($request->all());
    //     return redirect('admin/saques');
    // }

    public function delete(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            saquesModel::where('id', $id)->delete();
            return redirect('/admin/saques');
        } else {
            $saques = saquesModel::where('id', $id)->first();
            $this->dados['saques'] = $saques;
            $this->dados['titulo'] = 'saques';
            return view('admin/saques.saques_delete', $this->dados);
        }
    }

    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('cliente_id');

        $saques = $this->saques
            ->where(function ($query) use ($request) {
                if ($request->cliente_id) {
                    $query->where('cliente_id', $request->cliente_id);
                }
            })
            ->latest()
            ->paginate();

        return view('admin.saques.saques_list', compact('saques', 'filters'));
    }

    public function pendentes()
    {
        $saques = $this->saques
            ->with('client')
            ->where('status', 'pendente')
            ->get();
        $this->dados['saques'] = $saques;
        return view('admin/saques.saques_pendentes', $this->dados);
    }

    public function confirm($saque_id)
    {
        $parametros = ParametersModel::find(1);

        $saque = $this->saques->find($saque_id);
        $user_id = $saque->user_id;
        $valor_solicitado = $saque->valor;
        $moeda = $saque->moeda;
        $status = $saque->status;

        $taxa_saque_percent = $parametros->taxa_saque;
        $taxa_saque_valor = round(($valor_solicitado * $taxa_saque_percent) / 100, 2);


        $valor_receber = $valor_solicitado - $taxa_saque_valor;

        $balance = new Balance();
        $balance->debit($user_id, $valor_receber, $moeda, 'saque', 'saque id: ' . $saque_id);
        $balance->debit($user_id, $taxa_saque_valor, $moeda, 'taxa_saque', 'saque id: ' . $saque_id);

        $data = [
            'data_pagamento' => Carbon::now(),
            'status' => 'pago',
        ];

        $saque->update($data);
        return redirect()->route('saques.pendentes')->with('success', 'Saque Lançado');
    }
}
