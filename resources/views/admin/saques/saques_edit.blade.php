@extends('admin.index_admin')
@section('title', 'Saques')

@section('actions')
    <a href='{{ route('saques.pendentes') }}' class='btn btn-primary'>
        Voltar
</a>@endsection

@section('content')

    <div class='card'>
        <div class='card-body'>
            <div class='col-md-12'>
                <div class='form-horizontal'>

                    <div class='form-row'>
                        <div class='col-md-4'>
                            <label>Cliente</label>
                            <input type='text' disabled name='cliente_id'
                                value='{{ $saques->client->name ?? old('cliente_id') }}' class='form-control shadow'>
                        </div>
                        <div class='col-md-4'>
                            <label>CPF</label>
                            <input type='text' disabled name='cliente_id'
                                value='{{ $saques->client->cpf ?? old('cliente_id') }}' class='form-control shadow'>
                        </div>
                    </div>
                    <br>
                    <div class='form-row'>
                        <div class='col-md-4'>
                            <label>Valor</label>
                            <input type='text' readonly name='valor' value='@money($saques->valor)'
                                class='form-control shadow'>
                        </div>
                        <div class='col-md-4'>
                            <label>Status</label>
                            <input type='text' readonly name='status' value='{{ $saques->status ?? old('status') }}'
                                class='form-control shadow'>
                        </div>
                    </div>
                    <br>
                    <div class='form-row'>
                        <div class='col-md-8'>
                            <label for="Banco">Banco Selecionado</label>
                            @dump($bank)
                        </div>
                    </div>
                    <form action="{{ route('saques.confirm', $saques->id) }}" method='post'>
                        @csrf
                        <div class='form-row'>
                            <div class='col-md-2'>
                                <label>&nbsp;</label>
                                <input type='hidden' name='saque_id' value='{{ $saques->id }}' class='form-control'>
                                <button type='submit' class='btn btn-primary rounded'>
                                    Confirmar Pagamento
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
