<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdatePlans;
use App\Http\Controllers\Controller;
use App\Models\Client_planModel;
use App\Models\PlansModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PlansController extends Controller {

    private $dados;
    private $plans;

    public function __construct(PlansModel $plans) {
        $this->plans = $plans;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $filters = $request->except('_token');
        $this->dados['filters'] = $filters;

        $plans = $this->plans
            ->where(function ($query) use ($request) {
                if ($request->name) {
                    $query->where('name', $request->name);
                }
            })
            ->latest()
            ->paginate();

        $this->dados['plans'] = $plans;
        return view('admin.plans.plans_list', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->dados['titulo'] = 'plans';
        return view('admin.plans.plans_create', $this->dados);
    }

    public function store(StoreUpdatePlans $request) {
        $this->plans->create($request->all());
        return redirect('admin/plans');
    }

    public function show($id) {
        if (!$plans = $this->plans->find($id)) {
            return redirect()->back();
        }

        $this->dados['titulo'] = 'plans';
        $this->dados['plans'] = $plans;
        return view('admin.plans.plans_show', $this->dados);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{plans}Model  $plans
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $plans = $this->plans->find($id);
        $this->dados['plans'] = $plans;
        $this->dados['titulo'] = 'plans';
        return view('admin.plans.plans_edit', $this->dados);
    }

    public function update(StoreUpdatePlans $request, $id) {
        $this->plans->find($id)->update($request->all());
        return redirect('admin/plans');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            plansModel::where('id', $id)->delete();
            return redirect('/admin/plans');
        } else {
            $plans = plansModel::where('id', $id)->first();
            $this->dados['plans'] = $plans;
            $this->dados['titulo'] = 'plans';
            return view('admin/plans.plans_delete', $this->dados);
        }
    }

    public function status(Request $request) {
        $filters = $request->except('_token');

        if (!isset($filters['status'])) {
            $filters['status'] = 'ativo';
        }

        $plans = Client_planModel::with('client');

        if ($filters['status'] == 'ativo') {
            $plans->where('expiration', '>=', now());
        } elseif ($filters['status'] == 'inativo') {
            $plans->where('expiration', '<', now());
        }

        $this->dados['filters'] = $filters;
        $this->dados['plans'] = $plans->paginate();
        return view('admin/plans.plans_status', $this->dados);
    }
}
