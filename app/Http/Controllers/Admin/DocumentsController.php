<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateDocuments;
use App\Http\Controllers\Controller;
use App\Models\ClientsModel;
use App\Models\DocumentsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DocumentsController extends Controller {

    private $dados;
    private $documents;

    public function __construct(DocumentsModel $documents) {
        $this->documents = $documents;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->dados['documents'] = $this->documents
            ->select('cliente_id')
            ->groupBy('cliente_id')
            ->with('client')
            ->where('status', 'enviado')
            ->get();
        return view('admin.documents.documents_list', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->dados['titulo'] = 'documents';
        return view('admin.documents.documents_create', $this->dados);
    }

    public function store(StoreUpdateDocuments $request) {
        $this->documents->create($request->all());
        return redirect('admin/documents');
    }

    public function show($id) {
        if (!$documents = $this->documents->find($id)) {
            return redirect()->back();
        }

        $this->dados['titulo'] = 'documents';
        $this->dados['documents'] = $documents;
        return view('admin.documents.documents_show', $this->dados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{documents}Model  $documents
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $documents = $this->documents->find($id);
        $this->dados['documents'] = $documents;
        $this->dados['titulo'] = 'documents';
        return view('admin.documents.documents_edit', $this->dados);
    }

    public function update(StoreUpdateDocuments $request, $id) {
        $this->documents->find($id)->update($request->all());
        return redirect('admin/documents');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            documentsModel::where('id', $id)->delete();
            return redirect('/admin/documents');
        } else {
            $documents = documentsModel::where('id', $id)->first();
            $this->dados['documents'] = $documents;
            $this->dados['titulo'] = 'documents';
            return view('admin/documents.documents_delete', $this->dados);
        }
    }

    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $filters = $request->only('cliente_id');

        $documents = $this->documents
            ->where(function ($query) use ($request) {
                if ($request->cliente_id) {
                    $query->where('cliente_id', $request->cliente_id);
                }
            })
            ->latest()
            ->paginate();

        return view('admin.documents.documents_list', compact('documents', 'filters'));
    }

    public function avaliation(Request $request, $client_id) {
        $documents = $this->documents
            ->where('cliente_id', $client_id)->get();
        $this->dados['documents'] = $documents;
        $this->dados['client'] = ClientsModel::find($client_id);
        $this->dados['client_id'] = $client_id;
        return view('admin.documents.documents_edit', $this->dados);
    }

    public function active(Request $request, $client_id) {
        ClientsModel::find($client_id)->update(['status' => $request->status]);
        return redirect('admin/clients/home/' . $client_id);
    }

    public function status(Request $request) {
        DocumentsModel::find($request->doc_id)->update(['status' => $request->status]);
        return redirect('admin/documents/avaliation/' . $request->client_id)->with('alert', 'Status do documento alterado');
    }
}
