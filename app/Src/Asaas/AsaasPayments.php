<?php

namespace App\Src\Asaas;

use App\Models\ParametersModel;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;

class AsaasPayments {
    /*
        $body_array = [
            'customer' => $costumer,
            'dueDate' => $date,
            'value' => $value,
            'description' => $description,
            'billingType' => $type
        ];
    */
    public function create($body) {
        $param = ParametersModel::find(1);
        $url = $param->assas_url . '/api/v3/payments';

        $body = json_encode($body);
        $httpClient = new Client();
        try {
            $response = $httpClient->post(
                $url,
                [
                    'body' => $body,
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

    public function pixQrCode($id) {
        $param = ParametersModel::find(1);
        $url = $param->assas_url . '/api/v3/payments/' . $id . '/pixQrCode';

        $httpClient = new Client();
        $response = $httpClient->get(
            $url,
            [RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
                'access_token' => $param->assas_token,
            ]]
        );

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents(), true);
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }
}
