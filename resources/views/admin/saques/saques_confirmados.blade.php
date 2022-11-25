@extends('admin.saques.saques')
@section('sac_confirmadas', 'active')

@section('content_admin')
    <div class="table-responsive">
        <table class='table table-bordered table-striped table-hover table-sm'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor Total</th>
                    <th>Moeda</th>
                    <th>Data de Pagemento</th>
                    <th>Status</th>
                </tr>
            </thead>
            @foreach ($saques as $saque)
                <tr>
                    <td>{{ $saque->id }}</td>
                    <td>@money($saque->valor)</td>
                    <td>{{ $saque->moeda }}</td>
                    <td>{{ date('d-m-Y H:i:s', strtotime($saque->data_pagamento)) }}</td>
                    <td>{{ $saque->status }}</td>
                </tr>
            @endforeach
        </table>
        {{ $saques->links() }}
    </div>
@endsection
