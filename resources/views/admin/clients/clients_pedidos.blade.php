@extends('admin.clients.clients_panel')
@section('tab_compras','active')

@section('content_client')

@foreach($pedidos as $pedido)
<div class="card shadow">
    <div class='table-responsive p-2'>
        <h4>Pedido</h4>
        <table class='table table-bordered table-striped table-sm table-xs m-2'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Placas</th>
                    <th>Conversores</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Data Confirmação</th>
                </tr>
            </thead>
            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->name }}</td>
                <td>{{ $pedido->email }}</td>
                <td>{{ $pedido->placas }}</td>
                <td>{{ $pedido->conversor }}</td>
                <td>@money($pedido->total)</td>
                <td>{{ $pedido->created_at->format('d/m/Y H:s:i') }}</td>
                <td>{{ $pedido->dataConfirmacao }}</td>
            </tr>
        </table>
        <h4>Comissões</h4>
        <div class='table-responsive'>
            <table class='table table-bordered table-striped table-sm'>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Valor</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($pedido->comissoes as $comissao)
                <tr>
                    <td>{{ $comissao->client->user }}</td>
                    <td>@money($comissao->value)</td>
                    <td>{{ $comissao->reference }}</td>
                    <td>{{ $comissao->observation }}</td>
                    <td>{{ $comissao->reference }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endforeach


@endsection