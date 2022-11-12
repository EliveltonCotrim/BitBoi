<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateFaqs;
use App\Http\Controllers\Controller;
use App\Models\FaqsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FaqsController extends Controller {

    private $dados;
    private $faqs;

    public function __construct(FaqsModel $faqs) {
        $this->faqs = $faqs;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->dados['faqs'] = $this->faqs->paginate(10);
        return view('admin.faqs.faqs_list', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->dados['titulo'] = 'faqs';
        return view('admin.faqs.faqs_create', $this->dados);
    }

    public function store(Request $request) {
        $this->faqs->create($request->all());
        return redirect('admin/faqs');
    }

    public function show($id) {
        if (!$faqs = $this->faqs->find($id)) {
            return redirect()->back();
        }

        $this->dados['titulo'] = 'faqs';
        $this->dados['faqs'] = $faqs;
        return view('admin.faqs.faqs_show', $this->dados);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{faqs}Model  $faqs
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $faqs = $this->faqs->find($id);
        $this->dados['faqs'] = $faqs;
        $this->dados['titulo'] = 'faqs';
        return view('admin.faqs.faqs_edit', $this->dados);
    }

    public function update(Request $request, $id) {
        $this->faqs->find($id)->update($request->all());
        return redirect('admin/faqs');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            faqsModel::where('id', $id)->delete();
            return redirect('/admin/faqs');
        } else {
            $faqs = faqsModel::where('id', $id)->first();
            $this->dados['faqs'] = $faqs;
            $this->dados['titulo'] = 'faqs';
            return view('admin/faqs.faqs_delete', $this->dados);
        }
    }

    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $filters = $request->only('pergunta');

        $faqs = $this->faqs
            ->where(function ($query) use ($request) {
                if ($request->pergunta) {
                    $query->where('pergunta', $request->pergunta);
                }
            })
            ->latest()
            ->paginate();

        return view('admin.faqs.faqs_list', compact('faqs', 'filters'));
    }
}
