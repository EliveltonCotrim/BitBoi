@extends('client.index_client')

@section('title','Extrato R$')
@section('menu_extrato','active')

@section('content')

<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item"> <a class="nav-link active" href="{{ url('client/extrato_rs') }}">R$</a> </li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('client/extrato_coin') }}">FMCoin</a> </li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('client/extrato/indicacao') }}">Indicação</a> </li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('client/extrato/rendimento') }}">Rendimentos</a> </li>
        </ul>
    </div>
    <div class="card-body">

        <table class='table table-bordered table-striped table-sm'>
            <thead>
                <tr>
                    <th>D/C</th>
                    <th>Operação</th>
                    <th>Moeda</th>
                    <th>Valor</th>
                    <th>Obs</th>
                    <th>Data</th>
                </tr>
            </thead>
            @foreach($extracts as $extract)
            <tr>
                <td>{{ $extract->operation }}</td>
                <td>{{ $extract->reference }}</td>
                <td>{{ $extract->coin }}</td>
                <td>@money($extract->value)</td>
                <td>{{ $extract->observation }}</td>
                <td>{{ $extract->created_at->format('d/m/Y H:s:i') }}</td>
            </tr>
            @endforeach
        </table>


    </div>
</div>

@endsection