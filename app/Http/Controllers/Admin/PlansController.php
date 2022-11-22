<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdatePlans;
use App\Http\Controllers\Controller;
use App\Models\Client_planModel;
use App\Models\Coins;
use App\Models\PlansModel;
use App\Src\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use function GuzzleHttp\Promise\all;

class PlansController extends Controller
{
    private $dados;
    private $plans;

    public function __construct(PlansModel $plans)
    {
        $this->plans = $plans;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->except('_token');


        $this->dados['filters'] = $filters;

        $plans = $this->plans
            ->where(function ($query) use ($request) {
                if ($request->name) {
                    $query->where('name', 'like', '%'. $request->name . '%');
                }
            })
            ->latest()
            ->paginate(10);

        $this->dados['plans'] = $plans;
        return view('admin.plans.plans_list', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->dados['coins'] = Coins::with('latestCotacao')
            ->where('status', 'active')
            ->orderBy('name', 'ASC')
            ->get();

        $this->dados['titulo'] = 'plans';
        return view('admin.plans.plans_create', $this->dados);
    }

    public function store(StoreUpdatePlans $request)
    {
        $dataPlan = [
            'name' => $request->name,
            'quantity' => $request->quantity,
            'value' => Utils::moeda($request->value),
            'percentual_rendimento' => Utils::moeda($request->percentual_rendimento),
            'coin_id' => $request->coin,
            'details' => $request->details,
            'status' => 'active',
            'time_pri' => $request->time_pri,
        ];

        $this->plans->create($dataPlan);

        return redirect('admin/plans')->with('success', 'Pacote cadastrado com sucesso!');
    }

    public function show($id)
    {
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
    public function edit(Request $request, $id)
    {
        $this->dados['coins'] = Coins::with('latestCotacao')
            ->where('status', 'active')
            ->orderBy('name', 'ASC')
            ->get();

        $plans = $this->plans->find($id);
        $this->dados['plan'] = $plans;
        $this->dados['titulo'] = 'plans';

        return view('admin.plans.plans_edit', $this->dados);
    }

    public function update(StoreUpdatePlans $request, $id)
    {
        $dataPlan = [
            'name' => $request->name,
            'quantity' => $request->quantity,
            'value' => Utils::moeda($request->value),
            'percentual_rendimento' => Utils::moeda($request->percentual_rendimento),
            'coin_id' => $request->coin,
            'details' => $request->details,
            'status' => $request->status,
            'time_pri' => $request->time_pri,
        ];

        $this->plans->find($id)->update($dataPlan);

        return redirect('admin/plans')->with('success', 'Pacote atualizado com sucesso!');
    }

    public function delete(Request $request, $id)
    {
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

    public function status(Request $request)
    {
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
