@extends('client.index_client')

@section('title', 'Saques de Rendimento')
@section('menu_saque', 'active')

@section('content')

    <div class="card">

        <div class="card-body">
            <div class='row'>
                <div class='col-md-2'>
                    <a href="{{ route('solicitar.saques.rendimentos') }}" class="btn btn-primary btn-sm">
                        Saque de Rendimentos
                    </a>
                </div>
                <div class='col-md-2'>
                    <a href="{{ route('saques.investimentos') }}" class="btn btn-primary btn-sm">
                        Saque de Investimentos
                    </a>
                </div>
                <div class='col-md-2 align-self-end'>
                    <a href="{{ route('sacar.rendimento') }}" class="btn btn-success btn-lg  pull-right">
                        Solicitar Saque
                    </a>
                </div>
            </div>
            <hr>
            <h5>Saques</h5>
            <table class='table table-bordered table-striped table-sm'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Valor</th>
                        <th>Data Lolicitação</th>
                        <th>Status</th>
                        <th>Data Lançamento</th>
                    </tr>
                </thead>
                @foreach ($saques as $saque)
                    <tr>
                        <td>{{ $saque->id }}</td>
                        <td>@money($saque->valor)</td>
                        <td>{{ date('d-m-Y H:i:s', strtotime($saque->created_at))  }}</td>
                        <td>{{ $saque->status }}</td>
                        <td>{{ $saque->data_pagamento != null ? date('d-m-Y', strtotime($saque->data_pagamento)) : '' }}
                        </td>
                    </tr>
                @endforeach
            </table>


        </div>
    </div>

@endsection
