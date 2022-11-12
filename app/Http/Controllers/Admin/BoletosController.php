<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoletosModel;
use App\Models\Client_planModel;
use App\Src\Plans\PlanClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

class BoletosController extends Controller {

    private $dados;
    private $boletos;

    public function __construct(BoletosModel $boletos) {
        $this->boletos = $boletos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $filters = $request->except('_token');

        if (!isset($filters['start'])) {
            $filters['start'] = date('Y-m-') . '01';
        }

        if (!isset($filters['end'])) {
            $filters['end'] = date('Y-m-d');
        }



        $boletos = $this->boletos
            ->where(function ($query) use ($request, $filters) {
                if ($request->name)
                    $query->where('name', $request->name);

                if ($request->status) {
                    $query->where('status', $request->status);
                } else {
                    $query->where('status', 'confirmado');
                }

                $query->whereDate('dataConfirmacao', '>=', $filters['start']);
                $query->whereDate('dataConfirmacao', '<=', $filters['end']);
            })
            ->latest();

        $this->dados['filters'] = $filters;
        $this->dados['valor_total'] = $boletos->sum('valor');
        $this->dados['boletos'] = $boletos->paginate(20);
        return view('admin.boletos.boletos_list', $this->dados);
    }


    public function pendentes() {
        $boletos = $this->boletos
            ->with('user')
            ->whereIn('status', ['pendente', 'comprovante_enviado'])
            ->latest()
            ->get();
        $this->dados['boletos'] = $boletos;
        return view('admin/boletos.boletos_pendentes', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->dados['titulo'] = 'boletos';
        return view('admin.boletos.boletos_create', $this->dados);
    }

    public function store(Request $request) {
        $this->boletos->create($request->all());
        return redirect('admin/boletos');
    }

    public function show($id) {
        if (!$boletos = $this->boletos->find($id)) {
            return redirect()->back();
        }

        $this->dados['titulo'] = 'boletos';
        $this->dados['boletos'] = $boletos;
        return view('admin.boletos.boletos_show', $this->dados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{boletos}Model  $boletos
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $boletos = $this->boletos->find($id);
        $this->dados['boletos'] = $boletos;
        $this->dados['titulo'] = 'boletos';
        return view('admin.boletos.boletos_edit', $this->dados);
    }

    public function update(Request $request, $id) {
        $this->boletos->find($id)->update($request->all());
        return redirect('admin/boletos');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            boletosModel::where('id', $id)->delete();
            return redirect('/admin/boletos');
        } else {
            $boletos = boletosModel::where('id', $id)->first();
            $this->dados['boletos'] = $boletos;
            $this->dados['titulo'] = 'boletos';
            return view('admin/boletos.boletos_delete', $this->dados);
        }
    }

    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $filters = $request->only('client_id');

        $boletos = $this->boletos
            ->where(function ($query) use ($request) {
                if ($request->client_id) {
                    $query->where('client_id', $request->client_id);
                }
            })
            ->latest()
            ->paginate();

        return view('admin.boletos.boletos_list', compact('boletos', 'filters'));
    }

    public function confirm($boleto_id) {
        $boleto = $this->boletos
            ->with('user')
            // ->where('status', 'comprovante_enviado')
            ->find($boleto_id);
        $this->dados['boleto'] = $boleto;
        return view('admin/boletos.boletos_confirm', $this->dados);
    }

    public function confirm_store($boleto_id) {
        $deposit = BoletosModel::where('id', $boleto_id)
            ->with('plan')
            ->first();

        $update = [
            'dataConfirmacao' => now(),
            'status' => 'confirmado',
        ];
        $deposit->update($update);

        $client_id = $deposit->user_id;
        $client_plan = Client_planModel::where('user_id', $client_id)->first();

        return redirect('admin/boletos')->with('alert', 'Plano Ativado');
    }

    public function pdf(Request $request) {
        $filters = $request->except('_token');

        if (!isset($filters['start'])) {
            $filters['start'] = date('Y-m-') . '01';
        }

        if (!isset($filters['end'])) {
            $filters['end'] = date('Y-m-d');
        }

        $boletos = $this->boletos
            ->where(function ($query) use ($request, $filters) {
                if ($request->name)
                    $query->where('name', $request->name);

                if ($request->status) {
                    $query->where('status', $request->status);
                } else {
                    $query->where('status', 'confirmado');
                }

                $query->whereDate('dataConfirmacao', '>=', $filters['start']);
                $query->whereDate('dataConfirmacao', '<=', $filters['end']);
            })
            ->latest();

        $this->dados['filters'] = $filters;
        $this->dados['valor_total'] = $boletos->sum('valor');
        $this->dados['boletos'] = $boletos->get();


        $html = view('admin.boletos.boletos_pdf', $this->dados)->render();

        return PDF::setOptions(['isRemoteEnabled' => true])
            ->loadHTML($html)
            ->setPaper('a4')
            ->setWarnings(true)
            ->stream();
    }
}
