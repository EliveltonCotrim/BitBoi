<?php

namespace App\Src\Asaas;

use App\Models\ParametersModel;
use Exception;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;

class AsaasClient {

    public function create($name, $email, $phone, $cpf) {
        $param = ParametersModel::find(1);
        $url = $param->assas_url . '/api/v3/customers';

        //         $body = '{
        //   "name": "' . $name . '",
        //   "email": "' . $email . '",
        //   "phone": "' . $phone . '",
        //   "mobilePhone": "' . $phone . '",
        //   "cpfCnpj": "' . $cpf . '"

        // }';

        $body = [
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "mobilePhone" =>  $phone,
            "cpfCnpj" =>  $cpf
        ];

        $httpClient = new Client();
        try {
            $response = $httpClient->post(
                $url,
                [
                    'body' => json_encode($body),
                    RequestOptions::HEADERS => [
                        'Content-Type' => 'application/json',
                        'access_token' => $param->assas_token,
                    ]
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $response = $e->getResponse();
            $response_data = ($response->getBody()->getContents());

            Log::notice($response_data);
            throw new Exception($response_data, 1);
        }
    }
}
