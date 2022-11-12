<?php

namespace App\Src\Utils;

class Google2fa {

    public static function check($key, $token) {
        $window = 8;
        $google2fa = app('pragmarx.google2fa');
        return $google2fa->verifyKey($key, $token, $window);
    }

    public static function generateSecretKey() {
        $google2fa = app('pragmarx.google2fa');
        return $google2fa->generateSecretKey();
    }

    public static function getQRCodeInline($cliente_email, $secret_key) {
        $google2fa = app('pragmarx.google2fa');
        return $google2fa->getQRCodeInline(
            config('app.name'),
            $cliente_email,
            $secret_key
        );
    }
}
