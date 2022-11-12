<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoletosModel;
use App\Models\ClientsModel;
use App\Models\ParametersModel;
use App\Src\Transactions\Import;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller {
    private $data = [];

    public function index() {
        $this->data['pays'] = BoletosModel::where('status', 'confirmado')
            ->with('user')
            ->latest()->limit(10)->get();
        $this->data['lasts'] = ClientsModel::latest()->limit(10)->get();
        return view('admin.home_admin', $this->data);
    }

    public function sobre() {
        $param = ParametersModel::find(1);
        return view('admin.sobre', compact('param'));
    }

    public function sobre_store(Request $request) {
        ParametersModel::find(1)->update(['sobre' => $request->sobre]);
        return redirect('admin/sobre');
    }

    public function termos() {
        $param = ParametersModel::find(1);
        return view('admin.termos', compact('param'));
    }

    public function termos_store(Request $request) {
        ParametersModel::find(1)->update(['termo_compra' => $request->termos]);
        return redirect('admin/termos');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function imp(Import $import) {
        $import->start();
    }

    public function estrategia() {
        return view('admin.estrategia');
    }
}
