<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateFiles;
use App\Http\Controllers\Controller;
use App\Models\FilesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FilesController extends Controller {

    private $dados;
    private $files;

    public function __construct(FilesModel $files) {
        $this->files = $files;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->dados['files'] = $this->files->paginate(10);
        return view('admin.files.files_list', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->dados['titulo'] = 'files';
        return view('admin.files.files_create', $this->dados);
    }

    public function store(Request $request) {

        $file = $request->file('file');
        $file_name = $file->store('arquivos');

        $data = [
            'name' => $request->name,
            'file' => $file_name,
        ];
        $this->files->create($data);
        return redirect('admin/files');
    }

    public function show($id) {
        if (!$files = $this->files->find($id)) {
            return redirect()->back();
        }

        $this->dados['titulo'] = 'files';
        $this->dados['files'] = $files;
        return view('admin.files.files_show', $this->dados);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{files}Model  $files
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $files = $this->files->find($id);
        $this->dados['files'] = $files;
        $this->dados['titulo'] = 'files';
        return view('admin.files.files_edit', $this->dados);
    }

    public function update(Request $request, $id) {
        $this->files->find($id)->update($request->all());
        return redirect('admin/files');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            filesModel::where('id', $id)->delete();
            return redirect('/admin/files');
        } else {
            $files = filesModel::where('id', $id)->first();
            $this->dados['files'] = $files;
            $this->dados['titulo'] = 'files';
            return view('admin/files.files_delete', $this->dados);
        }
    }

    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $filters = $request->only('name');

        $files = $this->files
            ->where(function ($query) use ($request) {
                if ($request->name) {
                    $query->where('name', $request->name);
                }
            })
            ->latest()
            ->paginate();

        return view('admin.files.files_list', compact('files', 'filters'));
    }
}
