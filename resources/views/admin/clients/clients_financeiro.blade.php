@extends('admin.clients.clients_panel')
@section('tab_financeiro','active')

@section('content_client')

<div class="card">
    <div class="card-body">
        <h4>Pagamentos</h4>
        <div class='table-responsive'>
            <table class='table table-bordered table-striped '>
                <thead>
                    <tr>
                        <th>#</th>
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
                    <td>{{ $boleto->id }}</td>
                    <td>{{ $boleto->status }}</td>
                    <td>@money($boleto->valor)</td>
                    <td>{{ $boleto->created_at->format('d/m/Y - H:i:s') }}</td>
                    <td>{{ $boleto->dataConfirmacao != '' ? $boleto->dataConfirmacao->format('d/m/Y - H:i:s') :$boleto->dataConfirmacao }}</td>
                    <td>{{ $boleto->meioPagamento }}</td>
                    <td>
                        <a href="{{ url('admin/clients/financeiro/'. $boleto->client_id.'/' .$boleto->id ) }}" class="btn btn-light btn-sm">
                            <span class="bx bx-edit"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

    </div>
</div>



@endsection