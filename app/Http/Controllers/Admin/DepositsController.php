<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateDeposits;
use App\Http\Controllers\Controller;
use App\Models\DepositsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DepositsController extends Controller {

    private $dados;
    private $deposits;

    public function __construct(DepositsModel $deposits) {
        $this->deposits = $deposits;
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->dados['deposits'] = $this->deposits->paginate(10);
        return view('admin.deposits.deposits_list', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
         $this->dados['titulo'] = 'deposits';
         return view('admin.deposits.deposits_create', $this->dados);
    }
    
    public function store(StoreUpdateDeposits $request) {
            $this->deposits->create($request->all());
            return redirect('admin/deposits');
    }

  public function show($id)
    {
        if (!$deposits = $this->deposits->find($id)) {
            return redirect()->back();
        }

       $this->dados['titulo'] = 'deposits';
       $this->dados['deposits'] = $deposits;
        return view('admin.deposits.deposits_show', $this->dados);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{deposits}Model  $deposits
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
            $deposits = $this->deposits->find($id);
            $this->dados['deposits'] = $deposits;
            $this->dados['titulo'] = 'deposits';
            return view('admin.deposits.deposits_edit', $this->dados);
    }
    
    public function update(StoreUpdateDeposits $request, $id) {
            $this->deposits->find($id)->update($request->all());
            return redirect('admin/deposits');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            depositsModel::where('id', $id)->delete();
            return redirect('/admin/deposits');
        } else {
            $deposits = depositsModel::where('id', $id)->first();
            $this->dados['deposits'] = $deposits;
            $this->dados['titulo'] = 'deposits';
            return view('admin/deposits.deposits_delete', $this->dados);
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

        $deposits = $this->deposits
                            ->where(function($query) use ($request) {
                                if ($request->cliente_id) {
                                    $query->where('cliente_id', $request->cliente_id);
                                }
                            })
                            ->latest()
                            ->paginate();

        return view('admin.deposits.deposits_list', compact('deposits', 'filters'));
    }
    }