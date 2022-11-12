<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdatePayments;
use App\Http\Controllers\Controller;
use App\Models\PaymentsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PaymentsController extends Controller {

    private $dados;
    private $payments;

    public function __construct(PaymentsModel $payments) {
        $this->payments = $payments;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $filters = $request->except('_token');
        $this->dados['filters'] = $filters;

        $payments = $this->payments
            ->where(function ($query) use ($request) {
                if ($request->name) {
                    $query->where('name', $request->name);
                }
            })
            ->latest()
            ->paginate();

        $this->dados['payments'] = $payments;
        return view('admin.payments.payments_list', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->dados['titulo'] = 'payments';
        return view('admin.payments.payments_create', $this->dados);
    }

    public function store(Request $request) {
        $this->payments->create($request->all());
        return redirect('admin/payments');
    }

    public function show($id) {
        if (!$payments = $this->payments->find($id)) {
            return redirect()->back();
        }

        $this->dados['titulo'] = 'payments';
        $this->dados['payments'] = $payments;
        return view('admin.payments.payments_show', $this->dados);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{payments}Model  $payments
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $payments = $this->payments->find($id);
        $this->dados['payments'] = $payments;
        $this->dados['titulo'] = 'payments';
        return view('admin.payments.payments_edit', $this->dados);
    }

    public function update(Request $request, $id) {
        $this->payments->find($id)->update($request->all());
        return redirect('admin/payments');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            paymentsModel::where('id', $id)->delete();
            return redirect('/admin/payments');
        } else {
            $payments = paymentsModel::where('id', $id)->first();
            $this->dados['payments'] = $payments;
            $this->dados['titulo'] = 'payments';
            return view('admin/payments.payments_delete', $this->dados);
        }
    }
}
