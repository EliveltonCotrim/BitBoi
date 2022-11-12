<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateUsers;
use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller {

    private $dados;
    private $users;

    public function __construct(UsersModel $users) {
        $this->users = $users;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->dados['users'] = $this->users
            ->where('type', 'admin')
            ->paginate(10);
        return view('admin.users.users_list', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->dados['titulo'] = 'users';
        return view('admin.users.users_create', $this->dados);
    }

    public function store(Request $request) {
        $insert = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'admin',
        ];
        $this->users->create($insert);
        return redirect('admin/users');
    }

    public function show($id) {
        if (!$users = $this->users->find($id)) {
            return redirect()->back();
        }

        $this->dados['titulo'] = 'users';
        $this->dados['users'] = $users;
        return view('admin.users.users_show', $this->dados);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{users}Model  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $users = $this->users->find($id);
        $this->dados['users'] = $users;
        $this->dados['titulo'] = 'users';
        return view('admin.users.users_edit', $this->dados);
    }

    public function update(Request $request, $id) {
        $update = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->password != '') {
            $update['password'] = Hash::make($request->password);
        }
        $this->users->find($id)->update($update);
        return redirect('admin/users');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            usersModel::where('id', $id)->delete();
            return redirect('/admin/users');
        } else {
            $users = usersModel::where('id', $id)->first();
            $this->dados['users'] = $users;
            $this->dados['titulo'] = 'users';
            return view('admin/users.users_delete', $this->dados);
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

        $users = $this->users
            ->where(function ($query) use ($request) {
                if ($request->name) {
                    $query->where('name', $request->name);
                }
            })
            ->latest()
            ->paginate();

        return view('admin.users.users_list', compact('users', 'filters'));
    }
}
