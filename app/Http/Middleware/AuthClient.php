<?php

namespace App\Http\Middleware;

use App\Models\UsersModel;
use Closure;
use Illuminate\Http\Request;

class AuthClient {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (auth()->user()->type != 'client') {
            // auth()->logout();
            return redirect('/');
        }

        if (auth()->user()->status == 'bloqueado') {
            auth()->logout();
            return redirect('/')->with('alert', 'Falha no login');
        }

        return $next($request);
    }
}
