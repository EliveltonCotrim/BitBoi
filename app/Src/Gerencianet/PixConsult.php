<?php

namespace App\Src\Gerencianet;

use App\Models\ParametersModel;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PixConsult {

    public static function consult($tx_id) {
        $parametros = ParametersModel::find(1);

        $url = $parametros->pix_url_gerencianet;
        $pix_client_id = $parametros->pix_client_id;
        $pix_client_secret = $parametros->pix_client_secret;

        $path_key = storage_path('app/keys/') . $parametros->pix_key_file;
        $path_crt = storage_path('app/keys/') . $parametros->pix_crt_file;

        $token = PixGetToken::get(
            $url,
            $path_key,
            $path_crt,
            $pix_client_id,
            $pix_client_secret
        );

        try {
            $result = Http::accept('application/json')
                ->withOptions(['cert' => $path_crt, 'ssl_key' => $path_key,])
                ->withHeaders(['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $token,])
                ->get($url . 'v2/cob/' . $tx_id);

            return json_decode($result->body(), true);
        } catch (Exception $e) {
            Log::notice($e->getMessage());
            throw new Exception("Error Processing Request", 1);
        }
    }
}
