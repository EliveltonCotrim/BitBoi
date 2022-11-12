<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParametersModel;
use App\Src\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ParametersController extends Controller {

    private $dados;
    private $parameters;

    public function __construct(ParametersModel $parameters) {
        $this->parameters = $parameters;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        $parameters = $this->parameters->find(1);
        $this->dados['parameters'] = $parameters;
        $this->dados['titulo'] = 'parameters';
        return view('admin.parameters.parameters_edit', $this->dados);
    }

    public function index2() {
        $this->dados['parameters'] = $this->parameters->paginate(10);
        return view('admin.parameters.parameters_list', $this->dados);
    }

    public function store(Request $request) {
        $data = [
            'taxa_saque' => Utils::moeda($request->taxa_saque),
        ];
        $this->parameters->create($data);
        return redirect('admin/parameters');
    }

    public function show($id) {
        if (!$parameters = $this->parameters->find($id)) {
            return redirect()->back();
        }

        $this->dados['titulo'] = 'parameters';
        $this->dados['parameters'] = $parameters;
        return view('admin.parameters.parameters_show', $this->dados);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{parameters}Model  $parameters
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request) {
        $update = [
            'taxa_saque' => Utils::moeda($request->taxa_saque),
            'pix_client_id' => $request->pix_client_id,
            'pix_client_secret' => $request->pix_client_secret,
            'pix_url_gerencianet' => $request->pix_url_gerencianet,
            'gerencianet_chave_pix' => $request->gerencianet_chave_pix,
            'percent_indicacao' => $request->percent_indicacao,
            'usa_indicacao' => $request->usa_indicacao,
            'assas_token' => $request->assas_token,
            'assas_url' => $request->assas_url,
        ];

        $pix_key_file = $request->file('pix_key_file');
        if ($pix_key_file) {
            $pix_key_file->store('keys');
            $update['pix_key_file'] = $pix_key_file->hashName();
        }

        $pix_crt_file = $request->file('pix_crt_file');
        if ($pix_crt_file) {
            $pix_crt_file->store('keys');
            $update['pix_crt_file'] = $pix_crt_file->hashName();
        }

        $this->parameters->find(1)->update($update);
        return redirect('admin/parameters');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            parametersModel::where('id', $id)->delete();
            return redirect('/admin/parameters');
        } else {
            $parameters = parametersModel::where('id', $id)->first();
            $this->dados['parameters'] = $parameters;
            $this->dados['titulo'] = 'parameters';
            return view('admin/parameters.parameters_delete', $this->dados);
        }
    }

    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $filters = $request->only('title');

        $parameters = $this->parameters
            ->where(function ($query) use ($request) {
                if ($request->title) {
                    $query->where('title', $request->title);
                }
            })
            ->latest()
            ->paginate();

        return view('admin.parameters.parameters_list', compact('parameters', 'filters'));
    }
}
