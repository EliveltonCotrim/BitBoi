@extends('client.index_client')

@section('title','Saques de Rendimento')
@section('menu_saque','active')

@section('content')

<div class="card">

    <div class="card-body">


        <div class='row'>
            <div class='col-md-2'>
                <a href="{{ url('client/saques/rendimento') }}" class="btn btn-primary btn-sm rounded">
                    Saque de Rendimento
                </a>
            </div>
            <div class='col-md-2'>
                <a href="{{ url('client/saques/indicacao') }}" class="btn btn-light btn-sm rounded">
                    Saque de Indicação
                </a>
            </div>
            <div class='col-md-8'>
                <a href="{{ url('client/saque/rendimento') }}" class="btn btn-success btn-lg rounded pull-right">
                    Solicitar Saque
                </a>
            </div>
        </div>




        <hr>
        <table class='table table-bordered table-striped table-sm'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Valor</th>
                    <th>Moeda</th>
                    <th>Status</th>
                    <th>Data Solicitação</th>
                    <th>Data Depósito</th>
                </tr>
            </thead>
            @foreach($saques as $extract)
            <tr>
                <td>{{ $extract->id }}</td>
                <td>@money($extract->valor)</td>
                <td>{{ $extract->moeda }}</td>
                <td>{{ $extract->status }}</td>
                <td>{{ $extract->created_at->format('d/m/Y') }}</td>
                <td>{{ $extract->data_pagamento }}</td>
            </tr>
            @endforeach
        </table>


    </div>
</div>

@endsection