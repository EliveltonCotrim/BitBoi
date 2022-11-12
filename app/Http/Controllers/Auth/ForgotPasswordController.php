<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ClientesModel;
use App\Models\ClientsModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller {
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showForgetPasswordForm() {
        return view('auth.forgetPassword');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:clients',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // dd($request->email);

        Mail::send('mails.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Recuperar Senha');
        });

        return back()->with('message', 'Enviamos por e-mail o link de redefinição de senha!');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($token) {
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:clients',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('alert', 'Invalid token!');
        }

        ClientsModel::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('login')->with('alert', 'Sua senha foi alterada!');
    }
}
