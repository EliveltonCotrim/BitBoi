<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateClient_plan;
use App\Http\Controllers\Controller;
use App\Models\Client_planModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Client_planController extends Controller {

    private $dados;
    private $client_plan;

    public function __construct(Client_planModel $client_plan) {
        $this->client_plan = $client_plan;
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $filters = $request->except('_token');
        $this->dados['filters'] =$filters;

        $client_plan = $this->client_plan
                            ->where(function($query) use ($request) {
                                if ($request->client_id) {
                                    $query->where('client_id', $request->client_id);
                                }
                            })
                            ->latest()
                            ->paginate();

        $this->dados['client_plan'] = $client_plan;
        return view('admin.client_plan.client_plan_list', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
         $this->dados['titulo'] = 'client_plan';
         return view('admin.client_plan.client_plan_create', $this->dados);
    }
    
    public function store(StoreUpdateClient_plan $request) {
            $this->client_plan->create($request->all());
            return redirect('admin/client_plan');
    }

  public function show($id)
    {
        if (!$client_plan = $this->client_plan->find($id)) {
            return redirect()->back();
        }

       $this->dados['titulo'] = 'client_plan';
       $this->dados['client_plan'] = $client_plan;
        return view('admin.client_plan.client_plan_show', $this->dados);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{client_plan}Model  $client_plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
            $client_plan = $this->client_plan->find($id);
            $this->dados['client_plan'] = $client_plan;
            $this->dados['titulo'] = 'client_plan';
            return view('admin.client_plan.client_plan_edit', $this->dados);
    }
    
    public function update(StoreUpdateClient_plan $request, $id) {
            $this->client_plan->find($id)->update($request->all());
            return redirect('admin/client_plan');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            client_planModel::where('id', $id)->delete();
            return redirect('/admin/client_plan');
        } else {
            $client_plan = client_planModel::where('id', $id)->first();
            $this->dados['client_plan'] = $client_plan;
            $this->dados['titulo'] = 'client_plan';
            return view('admin/client_plan.client_plan_delete', $this->dados);
        }
    }

  
    }