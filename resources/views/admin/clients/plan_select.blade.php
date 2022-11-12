@extends('admin.clients.clients_panel')
@section('tab_financeiro','active')

@section('content_client')

<div class='form'>
    <form action="" method="post">
        @csrf
        <div class="form-row">
            <div class="col-md-4">
                <label for="">Selecione o Plano</label>
                <x-select name="plan" selected="" :options="$plans" :required="true" />
            </div>
        </div>
        <br>
        <div class="form-row">
            <div class="col-md-4">
                <label for="">Selecione Forma de Pagamento</label>
                <x-select name="meio" selected="" :options="['cartao_credito'=>'Cartão Credito','PIX'=>'PIX','dinheiro'=>'dinheiro','deposito'=>'Depósito']" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-2">
                <label for="">&nbsp;</label>
                <input value="Ativar" class="form-control btn btn-primary" type="submit">
            </div>
        </div>

    </form>
</div>


@endsection