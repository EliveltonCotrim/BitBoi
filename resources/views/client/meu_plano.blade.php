@extends('client.index_client')
@section('title','Minhas Compras')

@section('content')

<div class="card">
    <div class="card-body">
        <div class='table-responsive'>
            <a href="{{ url('client/plan/select') }}" class="btn btn-primary mb-2">
                <span class="bx bx-cart"></span>
                Comprar
            </a>
            <table class='table table-bordered table-striped '>
                <thead>
                    <tr>
                        <th>Tokens</th>
                        <th>Status</th>
                        <th>Valor</th>
                        <th>Data Criação</th>
                        <th>Data Pagamento</th>
                        <th>Meio</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($boletos as $boleto)
                <tr>
                    <td>{{ $boleto->quantity }}</td>
                    <td>{{ $boleto->status }}</td>
                    <td>@money($boleto->valor)</td>
                    <td>{{ $boleto->created_at->format('d/m/Y - H:i:s') }}</td>
                    <td>{{ $boleto->dataConfirmacao != '' ? $boleto->dataConfirmacao->format('d/m/Y - H:i:s') :$boleto->dataConfirmacao }}</td>
                    <td>{{ $boleto->meioPagamento }}</td>
                    <td>
                        @if($boleto->status == 'pending')
                        <a href="{{ url('client/plan/boleto/pay', Crypt::encrypt($boleto->id)) }}" class="btn btn-primary btn-sm">
                            Pay
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

    </div>
</div>



@endsection