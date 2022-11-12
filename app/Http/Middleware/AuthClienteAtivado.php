<?php

namespace App\Http\Middleware;

use App\Models\ClientsModel;
use App\Src\Plans\PlanClient;
use Closure;
use Illuminate\Http\Request;

class AuthClienteAtivado {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        // $id_cliente = $request->session()->get('id');
        $id_cliente = auth()->user()->client_id;

        $planCliente = new PlanClient();
        $plan_client = $planCliente->get($id_cliente);

        if ($plan_client['status'] != 'ativo') {
            return redirect('client/ativacao')->with('alert', 'Seu Plano não está ativo');
        }

        return $next($request);
    }
}
