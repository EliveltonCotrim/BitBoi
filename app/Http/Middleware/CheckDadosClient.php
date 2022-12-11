<?php

namespace App\Http\Middleware;

use App\Models\ClientsModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckDadosClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $client = ClientsModel::where('user_id', $user->id)->first();
        // dd($client, $user);
        // dd('name',$user->name == null,  'cpf',$user->cpf == null, 'banks',$client->phone == null, 'phone',$client->phone === null);

        if ($user->name == null || $user->cpf == null || $client->phone == null || $client->phone == null) {
            return redirect()->back()->with('alert', 'Você precisa cadastrar seus dados pessoais e bancários para continuar.');
        }

        return $next($request);
    }
}
