@extends('client.index_client')

@section('title', 'Saques de Investimentos')
@section('menu_saque', 'active')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class='row'>
                <div class='col-md-3'>
                    <a href="{{ route('solicitar.saques.rendimentos') }}"
                        class="btn btn-primary btn-lg rounded btn-block m-2">
                        Saque Rendimentos
                    </a>
                </div>
                <div class='col-md-3'>
                    <a href="{{ route('saques.investimentos') }}" class="btn btn-primary btn-lg rounded btn-block m-2">
                        Saque Investimentos
                    </a>
                </div>
                <div class="col-md-3"></div>
                <div class='col-md-3'>
                    <a href="{{ route('sacar.investimento') }}"
                        class="btn btn-success btn-lg rounded pull-right btn-block m-2">
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
                        <th>Moeda</th>
                        <th>Data Lançamento</th>
                        <th>Status</th>
                    </tr>
                </thead>
                @foreach ($saquesInvestimento as $saque)
                    <tr>
                        <td>{{ $saque->id }}</td>
                        <td>@money($saque->valor)</td>
                        <td>{{ $saque->moeda }}</td>
                        <td>{{ date('d-m-Y', strtotime($saque->created_at)) }}</td>
                        <td>{{ $saque->status }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection
