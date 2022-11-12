<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateVendas;
use App\Http\Controllers\Controller;
use App\Models\VendasModel;
use App\Transactions\Balance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class VendasController extends Controller {

    private $dados;
    private $vendas;

    public function __construct(VendasModel $vendas) {
        $this->vendas = $vendas;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->dados['vendas'] = $this->vendas
            ->with('cliente')
            ->with('ciclo_venda')
            ->paginate(10);
        return view('admin.vendas.vendas_list', $this->dados);
    }

    public function pendings() {
        $this->dados['vendas'] = $this->vendas
            ->with('cliente')
            ->with('ciclo_venda')
            ->where('status', 'pendente')
            ->get();
        return view('admin.vendas.vendas_pendings', $this->dados);
    }

    public function confirm($venda_id) {
        $venda = $this->vendas
            ->with('ciclo_venda')
            ->find($venda_id);

        $ciclo_nome = $venda->ciclo_venda->nome;

        $total = $venda->valor_total;
        $client_id = $venda->client_id;
        $balance = new Balance();

        // dd($venda->toArray(), $total, $ciclo_nome);
        $balance->credit($client_id, $total, 'rs', 'venda_token', 'ciclo - ' . $ciclo_nome);

        $venda->update([
            'status' => 'confirmada',
            'data_compra' => Carbon::now(),
        ]);

        return redirect('admin/vendas/pendings')->with('alert', 'Venda Confirmada');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->dados['titulo'] = 'vendas';
        return view('admin.vendas.vendas_create', $this->dados);
    }

    public function store(StoreUpdateVendas $request) {
        $this->vendas->create($request->all());
        return redirect('admin/vendas');
    }

    public function show($id) {
        if (!$vendas = $this->vendas->find($id)) {
            return redirect()->back();
        }

        $this->dados['titulo'] = 'vendas';
        $this->dados['vendas'] = $vendas;
        return view('admin.vendas.vendas_show', $this->dados);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{vendas}Model  $vendas
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $vendas = $this->vendas->find($id);
        $this->dados['vendas'] = $vendas;
        $this->dados['titulo'] = 'vendas';
        return view('admin.vendas.vendas_edit', $this->dados);
    }

    public function update(StoreUpdateVendas $request, $id) {
        $this->vendas->find($id)->update($request->all());
        return redirect('admin/vendas');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            vendasModel::where('id', $id)->delete();
            return redirect('/admin/vendas');
        } else {
            $vendas = vendasModel::where('id', $id)->first();
            $this->dados['vendas'] = $vendas;
            $this->dados['titulo'] = 'vendas';
            return view('admin/vendas.vendas_delete', $this->dados);
        }
    }

    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $filters = $request->only('client_compra_id');

        $vendas = $this->vendas
            ->where(function ($query) use ($request) {
                if ($request->client_compra_id) {
                    $query->where('client_compra_id', $request->client_compra_id);
                }
            })
            ->latest()
            ->paginate();

        return view('admin.vendas.vendas_list', compact('vendas', 'filters'));
    }
}
