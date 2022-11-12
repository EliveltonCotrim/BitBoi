@extends('client.index_client')

@section('title','Depósitos R$')
@section('menu_depositos','active')

@section('actions')
<a href="{{ url('client/depositar') }}" class="btn btn-primary btn-rounded">
    Depositar
</a>
@endsection

@section('content')

<div class="card text-center">

    <div class="card-body">

        <table class='table table-bordered table-striped table-sm'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor</th>
                    <th>Data Depósito</th>
                    <th>Data Confirmação</th>
                </tr>
            </thead>
            @foreach($depositos as $extract)
            <tr>
                <td>{{ $extract->id }}</td>
                <td>@money($extract->valor)</td>
                <td>{{ $extract->created_at->format('d/m/Y H:s:i') }}</td>
                <td>{{ $extract->dataConfirmacao }}</td>
                <td>
                    @if($extract->status =='pendente')
                    <a href="{{ url('client/gerencianet/pix/pay/'. Crypt::encrypt($extract->id)) }}" class="btn btn-primary btn-xs p-2">
                        Pagar
                    </a>
                    @elseif($extract->state =='enviado')

                    @else
                    <span class="badge  w-70 round-success">{{ $extract->status }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection