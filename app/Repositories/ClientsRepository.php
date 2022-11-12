<?php

namespace App\Repositories;

use App\Models\ClientsModel;

class ClientsRepository {

    private $clients;

    function __construct(ClientsModel $clients) {
        $this->clients = $clients;
    }

    public function getByStatus($filters) {
        $data = $this->clients
            ->whereHas('plan', function ($q) use ($filters) {
                if (isset($filters['status']) && $filters['status'] == 'ativos') {
                    $q->whereDate('expiration', '>=', now());
                } elseif (isset($filters['status']) && $filters['status'] == 'inativos') {
                    $q->whereDate('expiration', '<', now());
                } elseif (isset($filters['status']) && $filters['status'] == 'nao_pagos') {
                    $q->whereNull('expiration');
                }
            })
            ->where(function ($query) use ($filters) {
                if (isset($filters['name']) && $filters['name'] != '')
                    $query->where('name', 'like',  "%" . $filters['name'] . "%");

                if (isset($filters['user']) && $filters['user'] != '')
                    $query->where('user', 'like',  "%" . $filters['user'] . "%");

                if (isset($filters['email']) && $filters['email'] != '')
                    $query->where('email', 'like',  "%" . $filters['email'] . "%");

                if (isset($filters['id']) && $filters['id'] != '')
                    $query->where('id', $filters['id']);

                if (isset($filters['cpf']) && $filters['cpf'] != '')
                    $query->where('cpf', $filters['cpf']);
            })
            ->with('plan')
            ->orderBy('name');

        return $data;
    }
}
