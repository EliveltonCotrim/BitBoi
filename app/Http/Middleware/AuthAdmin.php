<?php

namespace App\Http\Middleware;

use App\Models\UsersModel;
use Closure;
use Illuminate\Http\Request;

class AuthAdmin {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        $user_id = auth()->user()->id;
        $user = UsersModel::find($user_id);

        if ($user->type != 'admin') {
            // auth()->logout();
            return redirect('client');
        }
        return $next($request);
    }
}
