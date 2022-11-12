<?php

namespace App\Src\Gerencianet;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PixGetToken {

    public static function get($url, $path_key, $path_crt, $pix_client_id, $pix_client_secret) {
        if (Cache::has('token_gerencianet')) {
            $token = json_decode(Cache::get('token_gerencianet'), true);
            return $token['access_token'];
        } else {
            $end_point = $url . 'oauth/token';
            $body_json = '{"grant_type": "client_credentials"}';
            try {
                $result = Http::accept('application/json')
                    ->withBasicAuth($pix_client_id, $pix_client_secret)
                    ->withOptions(['cert' => $path_crt, 'ssl_key' => $path_key,])
                    ->withHeaders(['Content-Type' => 'application/json',])
                    ->withBody($body_json, 'json')
                    ->post($end_point);

                Cache::put('token_gerencianet', $result->body(), 3200);
                return $result->json()['access_token'];
            } catch (Exception $e) {
                Log::notice($e->getMessage());
                throw new Exception("Error Processing Request", 1);
            }
        }
    }
}
