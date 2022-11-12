<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateBalances;
use App\Http\Controllers\Controller;
use App\Models\BalancesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BalancesController extends Controller {

    private $dados;
    private $balances;

    public function __construct(BalancesModel $balances) {
        $this->balances = $balances;
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->dados['balances'] = $this->balances->paginate(10);
        return view('admin.balances.balances_list', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
         $this->dados['titulo'] = 'balances';
         return view('admin.balances.balances_create', $this->dados);
    }
    
    public function store(StoreUpdateBalances $request) {
            $this->balances->create($request->all());
            return redirect('admin/balances');
    }

  public function show($id)
    {
        if (!$balances = $this->balances->find($id)) {
            return redirect()->back();
        }

       $this->dados['titulo'] = 'balances';
       $this->dados['balances'] = $balances;
        return view('admin.balances.balances_show', $this->dados);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{balances}Model  $balances
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
            $balances = $this->balances->find($id);
            $this->dados['balances'] = $balances;
            $this->dados['titulo'] = 'balances';
            return view('admin.balances.balances_edit', $this->dados);
    }
    
    public function update(StoreUpdateBalances $request, $id) {
            $this->balances->find($id)->update($request->all());
            return redirect('admin/balances');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            balancesModel::where('id', $id)->delete();
            return redirect('/admin/balances');
        } else {
            $balances = balancesModel::where('id', $id)->first();
            $this->dados['balances'] = $balances;
            $this->dados['titulo'] = 'balances';
            return view('admin/balances.balances_delete', $this->dados);
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

        $balances = $this->balances
                            ->where(function($query) use ($request) {
                                if ($request->cliente_id) {
                                    $query->where('cliente_id', $request->cliente_id);
                                }
                            })
                            ->latest()
                            ->paginate();

        return view('admin.balances.balances_list', compact('balances', 'filters'));
    }
    }