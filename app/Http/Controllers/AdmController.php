<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmController extends Controller {

    private $dados = [];

    public function index(Request $request) {
        return view('site.login_adm', $this->dados);
    }

    public function logar_adm(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = UsersModel::where('email', $request->email)->first();
            if ($user->type != 'admin') {
                auth()->logout();
            }

            $request->session()->regenerate();
            // return redirect()->intended('admin');
            return redirect('admin');
        }
        return redirect()->back()->with('alert', 'Dados Incorretos!');
    }
}
